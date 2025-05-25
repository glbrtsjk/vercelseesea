<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Community;
use App\Models\Funfact;
use App\Models\Users;
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
    }

    /**
     * Display user dashboard homepage.
     */

public function index()
{
    $user = Auth::user();

    // Get user's articles with their statistics
    $articles = Article::where('user_id', $user->user_id)
        ->withCount(['comments', 'reactions'])
        ->orderBy('tgl_upload', 'desc')
        ->take(5)
        ->get();

    // Get user's communities
    $communities = $user->communities()
        ->withCount('users')
        ->orderBy('pivot_tg_gabung', 'desc')
        ->take(5)
        ->get();

    // Get total reactions received on user's articles
    $reactionsCount = Article::where('user_id', $user->user_id)
        ->withCount('reactions')
        ->get()
        ->sum('reactions_count');

    // Generate recent activity timeline
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
 * Generate recent activity timeline for user
 */
private function getRecentActivityTimeline($user)
{
    $activities = [];

    // Add recent articles
    foreach ($user->articles()->latest('tgl_upload')->take(3)->get() as $article) {
        $activities[] = [
            'type' => 'article',
            'time' => $article->tgl_upload->diffForHumans(),
            'description' => 'You published an article: <a href="' . route('articles.show', $article) . '" class="font-medium text-blue-600 hover:text-blue-800">' . Str::limit($article->judul, 40) . '</a>',
            'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
            'bg_color' => 'bg-blue-100',
            'icon_color' => 'text-blue-600',
            'date' => $article->tgl_upload,
        ];
    }

    // Add recent comments
    foreach ($user->comments()->latest('tgl_komen')->take(3)->get() as $comment) {
        $activities[] = [
            'type' => 'comment',
            'time' => $comment->tgl_komen->diffForHumans(),
            'description' => 'You commented on <a href="' . route('articles.show', $comment->article_id) . '" class="font-medium text-blue-600 hover:text-blue-800">' . Str::limit($comment->article->judul, 40) . '</a>',
            'icon' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
            'bg_color' => 'bg-green-100',
            'icon_color' => 'text-green-600',
            'date' => $comment->tgl_komen,
        ];
    }

    // Add recently joined communities
    $communityActivities = $user->communities()
        ->orderBy('pivot_tg_gabung', 'desc')
        ->take(2)
        ->get()
        ->map(function ($community) {
            $joinDate = \Carbon\Carbon::parse($community->pivot->tg_gabung);
            return [
                'type' => 'community',
                'time' => $joinDate->diffForHumans(),
                'description' => 'You joined the community <a href="' . route('communities.show', $community) . '" class="font-medium text-blue-600 hover:text-blue-800">' . $community->nama . '</a>',
                'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
                'bg_color' => 'bg-purple-100',
                'icon_color' => 'text-purple-600',
                'date' => $joinDate,
            ];
        })->toArray();

    $activities = array_merge($activities, $communityActivities);

    // Sort by date (most recent first)
    usort($activities, function ($a, $b) {
        return $b['date']->timestamp - $a['date']->timestamp;
    });

    // Limit to 8 activities
    return array_slice($activities, 0, 8);
}

    /**
     * Display user profile page.
     */
    public function profile()
    {
        $user = Auth::user();

        // Get user's recent articles
        $recentArticles = Article::where('user_id', $user->user_id)
            ->orderBy('tgl_upload', 'desc')
            ->take(3)
            ->get();

        // Get user's communities
        $communities = $user->communities()
            ->withCount('users as members_count')
            ->orderBy('pivot_tg_gabung', 'desc')
            ->take(4)
            ->get();

        // Get user stats
        $stats = [
            'articles' => Article::where('user_id', $user->user_id)->count(),
            'comments' => $user->comments()->count(),
            'communities' => $user->communities()->count()
        ];

        return view('dashboard.profil', compact('user', 'recentArticles', 'communities', 'stats'));
    }

    /**
     * Display user profile edit form.
     */
    public function editProfile()
    {
        $user = Auth::user();
        return view('dashboard.edit-profile', compact('user'));
    }

    /**
     * Update user profile information.
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

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Display change password form.
     */
    public function changePassword()
    {
        return view('dashboard.change-password');
    }

    /**
     * Update user's password.
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

        return redirect()->route('user.profile')->with('success', 'Password changed successfully!');
    }

    /**
     * Display user's articles.
     */
    public function articles()
    {
        $articles = Article::where('user_id', Auth::id())
            ->withCount(['comments', 'reactions'])
            ->orderBy('tgl_upload', 'desc')
            ->paginate(10);

        return view('dashboard.articles', compact('articles'));
    }

    /**
     * Display user's communities.
     */
    public function communities()
    {
        $user = Auth::user();
        $communities = $user->communities()
            ->withCount('users as members_count')
            ->orderBy('pivot_tg_gabung', 'desc')
            ->paginate(12);

        return view('dashboard.communities', compact('communities'));
    }
}
