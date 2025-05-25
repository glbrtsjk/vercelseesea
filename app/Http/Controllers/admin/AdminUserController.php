<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role if provided
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status')) {
            if ($request->status === 'banned') {
                $query->where('is_banned', true);
            } elseif ($request->status === 'active') {
                $query->where('is_banned', false);
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Sort options
        $sort = $request->sort ?? 'newest';
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case 'articles_count':
                $query->withCount('articles')->orderBy('articles_count', 'desc');
                break;
            default:
                $query->latest();
        }

        $users = $query->withCount(['articles', 'comments', 'communities'])->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(['articles', 'communities']);

        // Get activity statistics
        $articles = $user->articles()->latest()->take(5)->get();
        $articleCount = $user->articles()->count();
        $commentCount = $user->comments()->count();
        $communities = $user->communities()->take(4)->get();

        return view('admin.users.show', compact('user', 'articles', 'articleCount', 'commentCount', 'communities'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Prevent self-deletion
        if (Auth::id() === $user->user_id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        try {
            // Delete the user
            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    /**
     * Toggle ban status for a user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function toggleBan(User $user)
    {
        // Prevent banning yourself
        if (Auth::id() === $user->user_id) {
            return redirect()->back()->with('error', 'You cannot ban yourself.');
        }

        // Prevent banning another admin
        if ($user->role === 'admin' && Auth::user()->role === 'admin') {
            return redirect()->back()->with('error', 'You cannot ban another admin.');
        }

        try {
            $user->is_banned = !$user->is_banned;
            $user->banned_at = $user->is_banned ? now() : null;
            $user->banned_by = $user->is_banned ? Auth::id() : null;
            $user->banned_reason = $user->is_banned ? request('reason', 'Violation of site rules') : null;
            $user->save();

            $status = $user->is_banned ? 'banned' : 'unbanned';
            return redirect()->back()->with('success', "User has been {$status} successfully.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user ban status: ' . $e->getMessage());
        }
    }

    /**
     * Toggle admin role for a user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function toggleAdmin(User $user)
    {
        // Prevent changing your own role
        if (Auth::id() === $user->user_id && User::where('role', 'admin')->count() <= 1) {
            return redirect()->back()->with('error', 'You cannot change your own admin status.');
        }

        try {
            $isCurrentlyAdmin = $user->role === 'admin';

            // Change role
            $user->role = $isCurrentlyAdmin ? 'user' : 'admin';
            $user->save();

            $action = $isCurrentlyAdmin ? 'removed from' : 'assigned to';

            return redirect()->back()->with('success', "Admin privileges {$action} user successfully.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating user admin status: ' . $e->getMessage());
        }

    }
public function usermanage(Request $request)
{
    // Get basic user statistics
    $totalUsers = User::count();
    $bannedUsers = User::where('is_banned', true)->count();
    $newUsers = User::whereMonth('created_at', now()->month)->count();
    $activeToday = User::where('last_active_at', '>=', now()->subDay())->count();

    // Get recent users
    $recentUsers = User::latest('created_at')
                      ->take(5)
                      ->get();

    // Get recently banned users
    $recentBannedUsers = User::where('is_banned', true)
                            ->whereNotNull('banned_at')
                            ->latest('banned_at')
                            ->take(5)
                            ->get();

    // Get top contributors (users with most articles)
    $topContributors = User::withCount('articles')
                          ->orderByDesc('articles_count')
                          ->take(5)
                          ->get();

    // Get most active communities
    $activeCommunities = \App\Models\Community::withCount('members as members_count')
                                            ->orderByDesc('members_count')
                                            ->take(5)
                                            ->get();

    // Generate user growth data for chart (last 6 months)
    $userGrowthData = [];
    $userGrowthLabels = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = now()->subMonths($i);
        $userGrowthLabels[] = $month->format('M Y');

        $userGrowthData[] = User::whereYear('created_at', $month->year)
                               ->whereMonth('created_at', $month->month)
                               ->count();
    }

    // Get recent user activity (combines article creation, comments, etc)
    $recentActivity = $this->getRecentActivity();

    return view('admin.dashboard.users.usermanage', compact(
        'totalUsers',
        'bannedUsers',
        'newUsers',
        'activeToday',
        'recentUsers',
        'recentBannedUsers',
        'topContributors',
        'activeCommunities',
        'userGrowthData',
        'userGrowthLabels',
        'recentActivity'
    ));
}

/**
 * Get recent user activity across the platform
 *
 * @return \Illuminate\Support\Collection
 */
private function getRecentActivity()
{
    // Get recent articles
    $articles = \App\Models\Article::with('user')
                                 ->latest()
                                 ->take(3)
                                 ->get()
                                 ->map(function($article) {
                                     return [
                                         'type' => 'article',
                                         'user' => $article->user,
                                         'description' => 'published an article: "' . Str::limit($article->judul, 30) . '"',
                                         'time' => $article->created_at
                                     ];
                                 });

    // Get recent comments
    $comments = \App\Models\Comment::with('user')
                                 ->latest()
                                 ->take(3)
                                 ->get()
                                 ->map(function($comment) {
                                     return [
                                         'type' => 'comment',
                                         'user' => $comment->user,
                                         'description' => 'commented on an article',
                                         'time' => $comment->created_at
                                     ];
                                 });

    // Get recent community joins
    $joins = \App\Models\CommunityMember::with('user', 'community')
                                      ->latest()
                                      ->take(3)
                                      ->get()
                                      ->map(function($member) {
                                          return [
                                              'type' => 'join',
                                              'user' => $member->user,
                                              'description' => 'joined a community: "' . $member->community->nama . '"',
                                              'time' => $member->created_at
                                          ];
                                      });

    // Combine all activities, sort by time and take most recent
    return $articles->concat($comments)
                  ->concat($joins)
                  ->sortByDesc('time')
                  ->take(5)
                  ->values();
}

}
