<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use App\Models\Community;
use App\Models\Funfact;
use App\Models\Tag;
use App\Models\Reaction;
use App\Models\Comment;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Menampilkan dashboard admin.
     */
    public function index()
    {
        // Statistik untuk kartu dashboard
        $totalArticles = Article::count();
        $pendingArticlesCount = Article::where('status', 'pending')->count();
        $totalUsers = User::count();
        $totalCommunities = Community::count();

        // Mendapatkan artikel yang tertunda terbaru
        $recentArticles = Article::where('status', 'pending')
            ->with('user')
            ->latest('tgl_upload')
            ->paginate(6);

        // Mendapatkan fakta menarik terbaru
        $recentFunfacts = Funfact::latest()
            ->take(5)
            ->get();

        // Mendapatkan tag populer dengan jumlah artikel
        $popularTags = Tag::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        // Mendapatkan pengguna terbaru dengan jumlah artikel
        $recentUsers = User::withCount('articles')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index1', compact(
            'totalArticles',
            'pendingArticlesCount',
            'totalUsers',
            'totalCommunities',
            'recentArticles',
            'recentFunfacts',
            'popularTags',
            'recentUsers'
        ));
    }

    /**
     * Menampilkan halaman profil admin.
     */
    public function profile()
    {
        $user = Auth::user();

        // Mendapatkan statistik admin
        $stats = [
            'articles_approved' => Article::where('status', 'published')->count(),
            'articles_rejected' => Article::where('status', 'rejected')->count(),
            'users_count' => User::count(),
            'admin_since' => $user->created_at->format('M Y')
        ];

        return view('admin.dashboard.profil.index', compact('user', 'stats'));
    }

    /**
     * Menampilkan formulir edit profil admin.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.dashboard.profil.edit-profil', compact('user'));
    }

    /**
     * Memperbarui informasi profil admin.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validasi data permintaan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'bio' => 'nullable|string|max:500',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Memperbarui detail pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        // Memproses foto profil jika diunggah
        if ($request->hasFile('foto_profil')) {
            // Menghapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::delete($user->foto_profil);
            }
            $user->foto_profil = $this->fileUploadService->uploadFile($request->file('foto_profil'), 'profiles');
        }

        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Menampilkan formulir ubah kata sandi.
     */
    public function changePassword()
    {
        return view('admin.dashboard.profil.changepassword');
    }

    /**
     * Memperbarui kata sandi admin.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi data permintaan
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verifikasi kata sandi saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Kata sandi saat ini salah');
        }

        // Memperbarui kata sandi
        $user->password = Hash::make($request->password);
        $user->save();

       return redirect()->route('admin.dashboard.profil')->with('success', 'Kata sandi berhasil diubah!');
    }

    public function articles(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_filter');
        $statusFilter = $request->input('status');

        $articleQuery = Article::with(['user', 'category'])
            ->withCount(['comments', 'reactions']);

        // Menerapkan filter pencarian jika disediakan
        if ($search) {
            $articleQuery->where(function($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('konten_isi_artikel', 'like', '%' . $search . '%');
            });
        }

        // Menerapkan filter kategori jika disediakan
        if ($categoryFilter) {
            $articleQuery->where('category_id', $categoryFilter);
        }

        // Menerapkan filter status jika disediakan
        if ($statusFilter) {
            $articleQuery->where('status', $statusFilter);
        }

        $articleQuery->orderBy('tgl_upload', 'desc');

        // Mendapatkan hasil yang dipaginasi
        $articles = $articleQuery->paginate(10)->withQueryString();

        $categories = Category::all();

        return view('admin.dashboard.article', compact('articles', 'categories'));
    }

    public function funfacts(Request $request)
    {
        // Mendapatkan parameter query untuk filter dan pengurutan
        $search = $request->input('search');
        $sort = $request->input('sort', 'latest');

        // Query dasar
        $funfactQuery = Funfact::query();

        // Menerapkan filter pencarian jika disediakan
        if ($search) {
            $funfactQuery->where(function($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Menerapkan pengurutan
        switch ($sort) {
            case 'oldest':
                $funfactQuery->orderBy('created_at', 'asc');
                break;
            case 'title_asc':
                $funfactQuery->orderBy('judul', 'asc');
                break;
            case 'title_desc':
                $funfactQuery->orderBy('judul', 'desc');
                break;
            case 'latest':
            default:
                $funfactQuery->orderBy('created_at', 'desc');
                break;
        }

        // Mendapatkan fakta menarik yang dipaginasi
        $funfacts = $funfactQuery->paginate(12);

        // Mendapatkan statistik untuk kartu
        $totalFunfacts = Funfact::count();
        $addedThisMonth = Funfact::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $withImages = Funfact::whereNotNull('gambar')->count();

        return view('admin.dashboard.funfact', compact(
            'funfacts',
            'totalFunfacts',
            'addedThisMonth',
            'withImages'
        ));
    }

    public function community(Request $request)
    {
        // Mendapatkan admin saat ini
        $admin = Auth::user();

        // Mendapatkan parameter query untuk filter dan pengurutan
        $search = $request->input('search');
        $sort = $request->input('sort', 'newest');

        // Query dasar - mendapatkan komunitas yang dibuat oleh admin ini
        $communityQuery = Community::where(function($query) use ($admin) {
            $query->where('created_by', $admin->user_id)
                ->orWhereNull('created_by');
        })->withCount('users');


        // Menerapkan filter pencarian jika disediakan
        if ($search) {
            $communityQuery->where(function($query) use ($search) {
                $query->where('nama_komunitas', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Menerapkan pengurutan
        switch ($sort) {
            case 'oldest':
                $communityQuery->orderBy('created_at', 'asc');
                break;
            case 'members_high':
                $communityQuery->orderBy('users_count', 'desc');
                break;
            case 'members_low':
                $communityQuery->orderBy('users_count', 'asc');
                break;
            case 'name_asc':
                $communityQuery->orderBy('nama_komunitas', 'asc');
                break;
            case 'name_desc':
                $communityQuery->orderBy('nama_komunitas', 'desc');
                break;
            case 'newest':
            default:
                $communityQuery->orderBy('created_at', 'desc');
                break;
        }

        // Mendapatkan hasil yang dipaginasi
        $communities = $communityQuery->paginate(10);
        $communityIds = Community::where(function($query) use ($admin) {
            $query->where('created_by', $admin->user_id)
                ->orWhereNull('created_by');
        })->pluck('community_id');

        // Mendapatkan statistik untuk kartu
        $totalCommunities = Community::where(function($query) use ($admin) {
            $query->where('created_by', $admin->user_id)
                ->orWhereNull('created_by');
        })->count();

        $activeCommunities = Community::where(function($query) use ($admin) {
            $query->where('created_by', $admin->user_id)
                ->orWhereNull('created_by');
        })->where('is_active', true)->count();


        $totalMembers = DB::table('community_user_pivots')
            ->whereIn('community_id', $communityIds)
            ->count();

        $newThisMonth = Community::where(function($query) use ($admin) {
            $query->where('created_by', $admin->user_id)
                ->orWhereNull('created_by');
        })->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();


        $recentActivity = DB::table('community_user_pivots')
            ->join('users', 'community_user_pivots.user_id', '=', 'users.user_id')
            ->join('communities', 'community_user_pivots.community_id', '=', 'communities.community_id')
            ->whereIn('community_user_pivots.community_id', $communityIds)
            ->select(
                'users.name as user_name',
                'users.foto_profil',
                'users.user_id',
                'communities.nama_komunitas',
                'communities.community_id',
                'community_user_pivots.tg_gabung',
                DB::raw("'bergabung' as action") // Diubah dari 'joined' ke 'bergabung'
            )
            ->orderBy('community_user_pivots.tg_gabung', 'desc')
            ->limit(10)
            ->get()
            ->map(function($item) {
                return (object)[
                    'user' => (object)[
                        'name' => $item->user_name,
                        'foto_profil' => $item->foto_profil,
                        'user_id' => $item->user_id
                    ],
                    'community' => (object)[
                        'nama_komunitas' => $item->nama_komunitas,
                        'community_id' => $item->community_id
                    ],
                    'action' => 'bergabung', // Diubah dari 'joined' ke 'bergabung'
                    'created_at' => \Carbon\Carbon::parse($item->tg_gabung)
                ];
            });

        return view('admin.dashboard.community', compact(
            'communities',
            'totalCommunities',
            'activeCommunities',
            'totalMembers',
            'newThisMonth',
            'recentActivity'
        ));
    }
}
