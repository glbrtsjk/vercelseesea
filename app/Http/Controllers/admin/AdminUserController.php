<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Menampilkan daftar pengguna.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan peran jika disediakan
        if ($request->has('role') && $request->role) {
            $query->where('role', $request->role);
        }

        // Filter berdasarkan status
        if ($request->has('status')) {
            if ($request->status === 'banned') {
                $query->where('is_banned', true);
            } elseif ($request->status === 'active') {
                $query->where('is_banned', false);
            }
        }

        // Fungsi pencarian
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Opsi pengurutan
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

      $totalUsers = User::count();
      $activeUsers = User::where('last_active_at', '>=', now()->subWeek())->count();
      $bannedUsers = User::where('is_banned', true)->count();


        return view('admin.dashboard.users.index', compact('users', 'totalUsers', 'activeUsers', 'bannedUsers'))
            ->with('sort', $sort)
            ->with('search', $request->search);
    }

    /**
     * Menampilkan pengguna tertentu.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(['articles', 'communities']);

        // Mendapatkan statistik aktivitas
        $articles = $user->articles()->latest()->take(5)->get();
        $articleCount = $user->articles()->count();
        $commentCount = $user->comments()->count();
        $communities = $user->communities()->take(4)->get();

        return view('admin.dashboard.users.show', compact('user', 'articles', 'articleCount', 'commentCount', 'communities'));
    }

    /**
     * Menghapus pengguna tertentu dari penyimpanan.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Mencegah penghapusan diri sendiri
        if (Auth::id() === $user->user_id) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        try {
            // Menghapus pengguna
            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    /**
     * Mengalihkan status banned untuk pengguna
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function toggleBan(User $user)
    {
        // Mencegah pembatasan diri sendiri
        if (Auth::id() === $user->user_id) {
            return redirect()->back()->with('error', 'You cannot ban yourself.');
        }

        // Mencegah pembatasan admin lain
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
     * Mengalihkan peran admin untuk pengguna
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function toggleAdmin(User $user)
    {
        // Mencegah mengubah peran diri sendiri
        if (Auth::id() === $user->user_id && User::where('role', 'admin')->count() <= 1) {
            return redirect()->back()->with('error', 'You cannot change your own admin status.');
        }

        try {
            $isCurrentlyAdmin = $user->role === 'admin';

            // Mengubah peran
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
    // Mendapatkan statistik pengguna dasar
    $totalUsers = User::count();
    $bannedUsers = User::where('is_banned', true)->count();
    $newUsers = User::whereMonth('created_at', now()->month)->count();
    $activeToday = User::where('last_active_at', '>=', now()->subDay())->count();

    // Mendapatkan pengguna terbaru
    $recentUsers = User::latest('created_at')
                      ->take(5)
                      ->get();

    // Mendapatkan pengguna yang baru saja dibanned
    $recentBannedUsers = User::where('is_banned', true)
                            ->whereNotNull('banned_at')
                            ->latest('banned_at')
                            ->take(5)
                            ->get();

    // Mendapatkan kontributor terbaik (pengguna dengan artikel terbanyak)
    $topContributors = User::withCount('articles')
                          ->orderByDesc('articles_count')
                          ->take(5)
                          ->get();

    // Mendapatkan komunitas paling aktif
    $activeCommunities = \App\Models\Community::withCount('users as members_count')
                                            ->orderByDesc('members_count')
                                            ->take(5)
                                            ->get();

    // Membuat data pertumbuhan pengguna untuk grafik (6 bulan terakhir)
    $userGrowthData = [];
    $userGrowthLabels = [];

    for ($i = 5; $i >= 0; $i--) {
        $month = now()->subMonths($i);
        $userGrowthLabels[] = $month->format('M Y');

        $userGrowthData[] = User::whereYear('created_at', $month->year)
                               ->whereMonth('created_at', $month->month)
                               ->count();
    }

    // Mendapatkan aktivitas pengguna terbaru (menggabungkan pembuatan artikel, komentar, dll)
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
 * Mendapatkan aktivitas pengguna terbaru di seluruh platform
 *
 * @return \Illuminate\Support\Collection
 */
private function getRecentActivity()
{
    // Mendapatkan artikel terbaru
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

    // Mendapatkan komentar terbaru
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

    // Mendapatkan bergabung komunitas terbaru
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

    // Menggabungkan semua aktivitas, mengurutkan berdasarkan waktu dan mengambil yang terbaru
    return $articles->concat($comments)
                  ->concat($joins)
                  ->sortByDesc('time')
                  ->take(5)
                  ->values();
}

}
