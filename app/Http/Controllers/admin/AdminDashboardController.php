<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
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
     * Display the admin dashboard.
     */
    public function index()
    {
        // Statistics for dashboard cards
        $totalArticles = Article::count();
        $pendingArticlesCount = Article::where('status', 'pending')->count();
        $totalUsers = User::count();
        $totalCommunities = Community::count();

        // Get recent pending articles
        $recentArticles = Article::where('status', 'pending')
            ->with('user')
            ->latest('tgl_upload')
            ->paginate(6);

        // Get recent funfacts
        $recentFunfacts = Funfact::latest()
            ->take(5)
            ->get();

        // Get popular tags with article count
        $popularTags = Tag::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        // Get recent users with article count
        $recentUsers = User::withCount('articles')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
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
     * Display admin profile page.
     */
    public function profile()
    {
        $user = Auth::user();

        // Get admin's stats
        $stats = [
            'articles_approved' => Article::where('status', 'published')->count(),
            'articles_rejected' => Article::where('status', 'rejected')->count(),
            'users_count' => User::count(),
            'admin_since' => $user->created_at->format('M Y')
        ];

        return view('admin.dashboard.profil', compact('user', 'stats'));
    }

    /**
     * Display admin profile edit form.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('admin.edit-profile', compact('user'));
    }

    /**
     * Update admin profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->user_id . ',user_id',
            'bio' => 'nullable|string|max:500',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;

        // Process profile photo if uploaded
        if ($request->hasFile('foto_profil')) {
            // Delete old photo if exists
            if ($user->foto_profil) {
                Storage::delete($user->foto_profil);
            }
            $user->foto_profil = $this->fileUploadService->uploadFile($request->file('foto_profil'), 'profiles');
        }

        $user->save();

        return redirect()->route('admin.dashboard.profil')->with('success', 'Profile updated successfully!');
    }

    /**
     * Display change password form.
     */
    public function changePassword()
    {
        return view('admin.dashboard.changepassword');
    }

    /**
     * Update admin's password.
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validate request data
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

       return redirect()->route('admin.dashboard.profil')->with('success', 'Password changed successfully!');
    }

    public function articles()
    {
        $articles = Article::with(['user', 'category'])
            ->withCount(['comments', 'reactions'])
            ->orderBy('tgl_upload', 'desc')
            ->paginate(10);

        return view('admin.dashboard.article', compact('articles'));
    }

public function community(Request $request)
{
    // Get the current admin
    $admin = Auth::user();

    // Get query parameters for filtering and sorting
    $search = $request->input('search');
    $sort = $request->input('sort', 'newest');

    // Base query - get communities created by this admin
    $communityQuery = Community::where('created_by', $admin->user_id)
        ->withCount('users');

    // Apply search filter if provided
    if ($search) {
        $communityQuery->where(function($query) use ($search) {
            $query->where('nama_komunitas', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
        });
    }

    // Apply sorting
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

    // Get paginated results
    $communities = $communityQuery->paginate(10);

    // Get statistics for cards
    $totalCommunities = Community::where('created_by', $admin->user_id)->count();
    $activeCommunities = Community::where('created_by', $admin->user_id)
        ->where('is_active', true)
        ->count();

    // Get total members across all admin's communities
    $totalMembers = DB::table('community_user_pivots')
        ->join('communities', 'community_user_pivots.community_id', '=', 'communities.community_id')
        ->where('communities.created_by', $admin->user_id)
        ->count();

    $newThisMonth = Community::where('created_by', $admin->user_id)
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

    // Get recent member activity in admin's communities (joins)
    $communityIds = Community::where('created_by', $admin->user_id)->pluck('community_id');

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
            DB::raw("'joined' as action")
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
                'action' => 'joined',
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
