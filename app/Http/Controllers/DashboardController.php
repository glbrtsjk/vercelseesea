<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Community;
use App\Models\Funfact;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Comment;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');

         $this->middleware(function ($request, $next) {
        if (Auth::check()) {
            // Memperbarui timestamp terakhir aktif pengguna
            Auth::user()->updateLastActive();
            // Memperbarui sesi
            $request->session()->regenerate();
        }
        return $next($request);
    });
    }

    /**
     * Menampilkan halaman beranda dashboard pengguna.
     */

public function index()
{

     $user = User::find(Auth::id());

      if(!$user) {
        return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses dashboard.');
      }

    // Mendapatkan artikel pengguna dengan statistiknya
    $articles = Article::where('user_id', $user->user_id)
        ->withCount(['comments', 'reactions'])
        ->orderBy('tgl_upload', 'desc')
        ->take(5)
        ->get();

    // Mendapatkan komunitas pengguna
    $communities = $user->communities()
        ->withCount('users')
        ->orderBy('pivot_tg_gabung', 'desc')
        ->take(5)
        ->get();

    // Mendapatkan total reaksi yang diterima pada artikel pengguna
    $reactionsCount = Article::where('user_id', $user->user_id)
        ->withCount('reactions')
        ->get()
        ->sum('reactions_count');

    // Membuat timeline aktivitas terbaru
    $recentActivity = $this->getRecentActivityTimeline($user);

    return view('dashboard.index', compact(
        'user',
        'articles',
        'communities',
        'reactionsCount',
        'recentActivity'
    ));
}

/**
 * Membuat timeline aktivitas terbaru untuk pengguna
 */
private function getRecentActivityTimeline($user)
{
    $activities = [];

    // Menambahkan artikel terbaru
    foreach ($user->articles()->latest('tgl_upload')->take(3)->get() as $article) {
        $activities[] = [
            'type' => 'article',
            'time' => $article->tgl_upload->diffForHumans(),
            'description' => 'Anda mempublikasikan artikel: <a href="' . route('articles.show', $article) . '" class="font-medium text-blue-600 hover:text-blue-800">' . Str::limit($article->judul, 40) . '</a>',
            'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
            'bg_color' => 'bg-blue-100',
            'icon_color' => 'text-blue-600',
            'date' => $article->tgl_upload,
        ];
    }

    // Menambahkan komentar terbaru
    foreach ($user->comments()->latest('tgl_komentar')->take(3)->get() as $comment) {
        $activities[] = [
            'type' => 'comment',
            'time' => $comment->tgl_komentar->diffForHumans(),
            'description' => 'Anda berkomentar pada <a href="' . route('articles.show', $comment->article_id) . '" class="font-medium text-blue-600 hover:text-blue-800">' . Str::limit($comment->article->judul, 40) . '</a>',
            'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
            'bg_color' => 'bg-green-100',
            'icon_color' => 'text-green-600',
            'date' => $comment->tgl_komentar

            ,
        ];
    }

    // Menambahkan komunitas yang baru diikuti
    $communityActivities = $user->communities()
        ->orderBy('pivot_tg_gabung', 'desc')
        ->take(2)
        ->get()
        ->map(function ($community) {
            $joinDate = \Carbon\Carbon::parse($community->pivot->tg_gabung);
            return [
                'type' => 'community',
                'time' => $joinDate->diffForHumans(),
                'description' => 'Anda bergabung dengan komunitas <a href="' . route('communities.show', $community) . '" class="font-medium text-blue-600 hover:text-blue-800">' . $community->nama . '</a>',
                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                'bg_color' => 'bg-purple-100',
                'icon_color' => 'text-purple-600',
                'date' => $joinDate,
            ];
        })->toArray();

    $activities = array_merge($activities, $communityActivities);

    // Mengurutkan berdasarkan tanggal (terbaru terlebih dahulu)
    usort($activities, function ($a, $b) {
        return $b['date']->timestamp - $a['date']->timestamp;
    });

    // Batasi hingga 8 aktivitas
    return array_slice($activities, 0, 8);
}

    /**
     * Menampilkan halaman profil pengguna.
     */

     private function getRecommendedCommunities($userId)
{
    // Dapatkan komunitas yang sudah diikuti oleh pengguna
    $userCommunitiesIds = User::find($userId)->communities()
        ->pluck('communities.community_id')
        ->toArray();
    
    // Dapatkan komunitas yang belum diikuti pengguna, urutkan berdasarkan jumlah anggota (populer)
    $recommendedCommunities = Community::whereNotIn('community_id', $userCommunitiesIds)
        ->where('is_active', true)
        ->withCount('users as members_count')
        ->orderBy('members_count', 'desc')
        ->take(3)
        ->get();
    
    return $recommendedCommunities;
}
    public function profile()
    {
        $user = Auth::user();

        // Mendapatkan artikel terbaru pengguna
        $recentArticles = Article::where('user_id', $user->user_id)
            ->orderBy('tgl_upload', 'desc')
            ->take(3)
            ->get();

        // Mendapatkan komunitas pengguna
        $communities = $user->communities()
            ->withCount('users as members_count')
            ->orderBy('pivot_tg_gabung', 'desc')
            ->take(4)
            ->get();

        // Mendapatkan statistik pengguna
        $stats = [
            'articles' => Article::where('user_id', $user->user_id)->count(),
            'comments' => $user->comments()->count(),
            'communities' => $user->communities()->count()
        ];

        return view('dashboard.profil', compact('user', 'recentArticles', 'communities', 'stats'));
    }

    /**
     * Menampilkan formulir edit profil pengguna.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('dashboard.edit-profil', compact('user'));
    }

    /**
     * Memperbarui informasi profil pengguna.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Memvalidasi data permintaan
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

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Menampilkan formulir ganti kata sandi.
     */
    public function changePassword()
    {
        return view('dashboard.changepassword');
    }

    /**
     * Memperbarui kata sandi pengguna.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Memvalidasi data permintaan
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Memverifikasi kata sandi saat ini
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Kata sandi saat ini salah');
        }

        // Memperbarui kata sandi
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Kata sandi berhasil diubah!');
    }

    /**
     * Menampilkan artikel pengguna.
     */
    public function articles()
    {
        $articles = Article::where('user_id', Auth::id())
            ->withCount(['comments', 'reactions'])
            ->orderBy('tgl_upload', 'desc')
            ->paginate(10);

        return view('dashboard.article', compact('articles'));
    }

    /**
     * Menampilkan komunitas pengguna.
     */
    public function communities(Request $request)
    {
        $user = Auth::user();
        $communities = $user->communities()
            ->withCount('users as members_count')
            ->orderBy('pivot_tg_gabung', 'desc')
            ->paginate(12);



    // Tambahkan logika pencarian
    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_komunitas', 'LIKE', "%{$search}%")
              ->orWhere('deskripsi', 'LIKE', "%{$search}%")
              ->orWhere('kategori', 'LIKE', "%{$search}%");
        });
    }

        $totalDiscussions = $user->communities()
        ->withCount('messages')
        ->get()
        ->sum('messages_count');

    // Menambahkan rekomendasi komunitas
    $recommendedCommunities = $this->getRecommendedCommunities($user->user_id);

    return view('dashboard.community', compact(
        'communities',
        'totalDiscussions',
        'recommendedCommunities'
    ));
}
}
