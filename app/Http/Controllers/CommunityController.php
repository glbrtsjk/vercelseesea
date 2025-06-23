<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Message;
use App\Models\CommunityMember;
use App\Models\CommunityLock;
use App\Models\CommunityEvent;
use App\Models\MuteUsers;
use App\Models\BanUsers;
use App\Services\FileUploadService;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CommunityController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('checkban')->except(['index','show', 'store', 'join', 'showJoinForm']);
        $this->fileUploadService = $fileUploadService;
    }


public function index(Request $request)
{
    $query = Community::withCount('users');

    if ($request->has('search') && !empty($request->search)) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('nama_komunitas', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }


    $sortBy = $request->get('sort', 'users_count');
    $sortOrder = $request->get('order', 'desc');

    switch ($sortBy) {
        case 'name':
            $query->orderBy('nama_komunitas', $sortOrder);
            break;
        case 'created':
            $query->orderBy('created_at', $sortOrder);
            break;
        case 'activity':
            $query->withCount('messages')
                  ->orderBy('messages_count', $sortOrder);
            break;
        default:
            $query->orderBy('users_count', $sortOrder);
    }

    $perPage = $request->get('per_page', 12);
    $perPage = in_array($perPage, [6, 12, 24, 48]) ? $perPage : 12;

    $communities = $query->paginate($perPage)
        ->withQueryString();

    $trendingCommunities = Community::withCount(['messages' => function($query) {
            $query->where('tgl_pesan', '>=', now()->subDays(30));
        }])
        ->having('messages_count', '>', 0)
        ->orderBy('messages_count', 'desc')
        ->take(3)
        ->get();

    $newestCommunities = Community::withCount('users')
        ->orderBy('created_at', 'desc')
        ->take(3)
        ->get();

     $initiatives = \App\Models\CommunityInitiative::with('community')
    ->inRandomOrder()
    ->take(4)
    ->get();


$stats = [
    'total_communities' => Community::count(),
    'total_members' => \DB::table('community_user_pivots')->count(),
    'active_today' => Community::whereHas('messages', function($query) {
        $query->whereDate('tgl_pesan', today());
    })->count(),
    'new_this_month' => Community::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count(),
    'total_moderators' => \DB::table('community_user_pivots')
        ->where('role', 'moderator')
        ->count(),
    'total_admins' => \DB::table('community_user_pivots')
        ->where('role', 'admin')
        ->count(),
    'regular_members' => \DB::table('community_user_pivots')
        ->where('role', 'member')
        ->count()
];

    return view('community.index1', compact(
        'communities',
        'trendingCommunities',
        'newestCommunities',
        'stats',
        'initiatives'
    ));
}


public function show(Community $community)
{
    $community->load(['users', 'messages', 'initiatives']);



    $isMember = false;
    $isModerator = false;
    $isModeratorOrAdmin = false;
    $memberRecord = null;

    if (Auth::check()) {
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $isMember = $memberRecord ? true : false;

        $isBanned = BanUsers::where('community_id', $community->community_id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($isBanned) {
            return redirect()->route('communities.index')
                ->with('error', __('You have been banned from this community.'));
        }

        if ($memberRecord && isset($memberRecord->pivot->role)) {
            $isModerator = in_array($memberRecord->pivot->role, ['moderator', 'admin']);
            $isModerator = in_array($memberRecord->pivot->role, ['moderator', 'admin']);
            $isModeratorOrAdmin = $isModerator || Auth::user()->role === 'admin';
        } elseif (Auth::check() && Auth::user()->role === 'admin') {
            $isModeratorOrAdmin = true;
        }

        if ($isMember) {
            $community->users()->updateExistingPivot(Auth::id(), [
                'aktif_flag' => 1,
                'terakhir_aktif' => now()
            ]);
        }
    }

    $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();
    $messages = $community->messages()
        ->with('user')
        ->latest()
        ->paginate(10);

    $events = $community->events()
        ->where('event_date', '>=', now()->toDateString())
        ->orderBy('event_date')
        ->take(3)
        ->get();


         $latestMessages = Message::where('community_id', $community->community_id)
        ->with('user')
        ->latest('tgl_pesan')
        ->take(3)
        ->get();

    return view('community.show3', compact(
        'community',
        'isMember',
        'isModerator',
        'isModeratorOrAdmin',
        'isChatLocked',
        'messages',
        'events',
        'latestMessages'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'nama_komunitas' => 'required|string|max:255|unique:communities,nama_komunitas',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'communities');
        }

        $slug = Str::slug($request->nama_komunitas);
        $uniqueSlug = $this->createUniqueSlug($slug);

        $community = Community::create([
            'nama_komunitas' => $request->nama_komunitas,
            'slug' => $uniqueSlug,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        $community->users()->attach(Auth::id(), [
            'tg_gabung' => now(),
            'role' => 'moderator'
        ]);

        return redirect()->route('communities.show', $community)
            ->with('success', __('messages.community_created'));
    }

    protected function createUniqueSlug($slug)
    {
        $original = $slug;
        $count = 1;

        while (Community::where('slug', $slug)->exists()) {
            $slug = "{$original}-{$count}";
            $count++;
        }

        return $slug;
    }


    public function showJoinForm(Community $community)
    {
        if (Auth::check()) {
            $isBanned = BanUsers::where('community_id', $community->community_id)
                ->where('user_id', Auth::id())
                ->exists();

            if ($isBanned) {
                return redirect()->route('communities.index')
                    ->with('error', __('You have been banned from this community.'));
            }
                $community->load(['initiatives', 'users']);

            $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
            if ($isMember) {
                return redirect()->route('communities.show', $community)
                    ->with('info', __('You are already a member of this community.'));
            }
        }

        return view('community.join', compact('community'));
    }

    public function join(Request $request, Community $community)
    {
        $isBanned = BanUsers::where('community_id', $community->community_id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($isBanned) {
            return redirect()->route('communities.index')
                ->with('error', __('You have been banned from this community.'));
        }

        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();

        if ($memberRecord) {
            if($memberRecord->pivot->role === 'admin' || $memberRecord->pivot->role === 'moderator') {
                return redirect()->route('communities.show', $community)
                    ->with('info', __('You are already a moderator of this community.'));
            }
            return redirect()->route('communities.show', $community)
                ->with('info', __('You are already a member of this community.'));
        }

        // Join the community
        $community->users()->attach(Auth::id(), [
        'tg_gabung' => now(),
        'role' => 'member',
        'aktif_flag' => 1,
        'terakhir_aktif' => now()
        ]);


        return redirect()->route('communities.show', $community)
            ->with('success', __('You have successfully joined this community.'));
    }



public function chat(Request $request, Community $community)
{
    if (!Auth::check()) {
        return redirect()->route('login')
            ->with('error', __('kamu harus login untuk mengakses chat komunitas.'));
    }
    $isBanned = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->exists();

    if ($isBanned) {
        return redirect()->route('communities.index')
            ->with('error', __('kamu telah diban dari komunitas ini.'));
    }

    $isSystemAdmin = Auth::user()->role === 'admin';

    $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
    $isMember = $memberRecord ? true : false;

    if (!$isMember && !$isSystemAdmin) {
        return redirect()->route('communities.show', $community)
            ->with('error', __('kamu harus member untuk mengakses chat.'));
    }

    if ($isMember) {
        $community->users()->updateExistingPivot(Auth::id(), [
            'aktif_flag' => 1,
            'terakhir_aktif' => now()
        ]);
    }

    if ($request->ajax()) {
        $members = $community->users()
            ->withPivot('role', 'aktif_flag', 'terakhir_aktif')
            ->orderByPivot('role', 'desc')
            ->get();

        return view('community.chat._members_list', compact('members', 'community'));
    }

    $userRole = $memberRecord?->pivot?->role ?? 'member';

    $canModerate = in_array($userRole, ['admin', 'moderator']) || $isSystemAdmin;

    $isMuted = MuteUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->where('unmute_at', '>', now())
        ->exists();

    $messages = Message::where('community_id', $community->community_id)
        ->with('user')
        ->orderBy('tgl_pesan', 'asc')
        ->get();

    $members = $community->users()
        ->withPivot('role', 'aktif_flag', 'terakhir_aktif')
        ->orderByPivot('role', 'desc')
        ->get();

    $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();
    $lockInfo = null;

    if ($isChatLocked) {
        $lockInfo = CommunityLock::where('community_id', $community->community_id)
            ->with('lockedBy')
            ->first();
    }

    $messageUserRoles = [];
    $mutedUsers = [];
    $bannedUsers = [];
    $currentUserRole = $memberRecord?->pivot?->role ?? 'member';
    $canMuteUser = true;
    $canBanUser = true;

    foreach ($messages as $message) {
        $messageUser = $members->where('user_id', $message->user_id)->first();

        $messageUserRoles[$message->id] = $messageUser && isset($messageUser->pivot) && isset($messageUser->pivot->role)
            ? $messageUser->pivot->role
            : 'member';

        $mutedUsers[$message->id] = MuteUsers::where('community_id', $community->community_id)
            ->where('user_id', $message->user_id)
            ->where('unmute_at', '>', now())
            ->exists();

        $bannedUsers[$message->id] = BanUsers::where('community_id', $community->community_id)
            ->where('user_id', $message->user_id)
            ->exists();
    }

    $rolePriority = [
        'admin' => 3,
        'moderator' => 2,
        'member' => 1
    ];

    // Set some flags based on user role
    $hasModPermissions = $isSystemAdmin || in_array($currentUserRole, ['admin', 'moderator']);

    return view('community.chat.index', compact(
        'community',
        'messages',
        'members',
        'userRole',
        'canModerate',
        'isChatLocked',
        'lockInfo',
        'isSystemAdmin',
        'isMuted',
        'messageUserRoles',
        'currentUserRole',
        'rolePriority',
        'mutedUsers',
        'bannedUsers',
        'canMuteUser',
        'canBanUser',
        'hasModPermissions'
    ));
}


public function members(Request $request, Community $community)
{
    if (!Auth::check()) {
        return redirect()->route('login')
            ->with('error', __('Anda harus login untuk melihat daftar anggota.'));
    }

    $isBanned = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->exists();

    if ($isBanned) {
        return redirect()->route('communities.index')
            ->with('error', __('Anda telah diblokir dari komunitas ini.'));
    }
  $isSystemAdmin = Auth::user()->role === 'admin';

$communityAdmins = $community->users()->where('community_user_pivots.role', 'admin')->count();
    $systemAdmins = $community->users()
        ->where('users.role', 'admin')
        ->where(function($q) {
            $q->where('community_user_pivots.role', '!=', 'admin')
              ->orWhereNull('community_user_pivots.role');
        })
        ->count();

    $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
    $isMember = $memberRecord ? true : false;
    $isModeratorOrAdmin = $isSystemAdmin || ($memberRecord && in_array($memberRecord->pivot->role, ['moderator', 'admin']));

    if (!$isMember && !$isSystemAdmin) {
        return redirect()->route('communities.show', $community)
            ->with('error', __('Anda harus menjadi anggota untuk melihat daftar anggota.'));
    }

    $membersQuery = $community->users()
        ->withPivot('role', 'tg_gabung', 'aktif_flag', 'terakhir_aktif')
        ->when($request->has('search') && $request->search, function($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        })
      ->when($request->has('role') && $request->role, function($query) use ($request) {
            if ($request->role === 'admin') {
                // Include both system admins and community admins
                $query->where(function($q) {
                    $q->where('community_user_pivots.role', 'admin')
                      ->orWhere('users.role', 'admin');
                });
            } else {
                $query->where('community_user_pivots.role', $request->role);
            }
        });


    switch ($request->get('sort', 'newest')) {
        case 'oldest':
            $membersQuery->orderBy('community_user_pivots.tg_gabung', 'asc');
            break;
        case 'name_asc':
            $membersQuery->orderBy('nama', 'asc');
            break;
        case 'name_desc':
            $membersQuery->orderBy('nama', 'desc');
            break;
        case 'newest':
        default:
            $membersQuery->orderBy('community_user_pivots.tg_gabung', 'desc');
            break;
    }

    $members = $membersQuery->paginate(24)->withQueryString();

    $onlineMembers = $community->users()
        ->withPivot('role', 'aktif_flag', 'terakhir_aktif')
        ->where('community_user_pivots.aktif_flag', 1)
        ->whereNotNull('community_user_pivots.terakhir_aktif')
        ->where('community_user_pivots.terakhir_aktif', '>', now()->subMinutes(15))
        ->get();

       $communityAdmins = $community->users()->where('community_user_pivots.role', 'admin')->count();
    $systemAdmin = $community->users()->where('users.role', 'admin')
        ->where(function($q) {
            // Only count system admins that aren't already community admins
            $q->where('community_user_pivots.role', '!=', 'admin')
              ->orWhereNull('community_user_pivots.role');
        })
        ->count();

    $admins = $communityAdmins + $systemAdmin;
    $moderators = $community->users()->wherePivot('role', 'moderator')->count();
    $regularMembers = $community->users()
        ->where('community_user_pivots.role', 'member')
        ->where('users.role', '!=', 'admin')
        ->count();

    if ($isMember) {
        $community->users()->updateExistingPivot(Auth::id(), [
            'aktif_flag' => 1,
            'terakhir_aktif' => now()
        ]);
    }

     $hasSearch = $request->has('search') && !empty($request->search);
    $searchQuery = $request->search;

    return view('community.anggota', compact(
        'community',
        'members',
        'onlineMembers',
        'admins',
        'moderators',
        'regularMembers',
        'isModeratorOrAdmin',
        'hasSearch',
        'searchQuery'
    ));
}

Public function updateActivity(Request $request, Community $community)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $user = Auth::user();

    $community->users()->updateExistingPivot($user->id, [
        'aktif_flag' => 1,
        'terakhir_aktif' => now()
    ]);

    $updatedMember = $community->users()
        ->where('users.user_id', $user->id)
        ->first();

    return response()->json([
        'status' => 'success',
        'user_id' => $user->id,
        'aktif_flag' => $updatedMember->pivot->aktif_flag,
        'terakhir_aktif' => $updatedMember->pivot->terakhir_aktif,
        'is_online' => ($updatedMember->pivot->aktif_flag == 1 &&
                       $updatedMember->pivot->terakhir_aktif > now()->subMinutes(15))
    ]);
}


public function storeMessage(Request $request, Community $community)
{

    $request->validate([
        'konten' => 'required|string|max:1000',
        'lampiran' => 'nullable|file|max:10240',
    ]);

    $isBanned = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->exists();

    if ($isBanned) {
        return redirect()->route('communities.index')
            ->with('error', __('You have been banned from this community.'));
    }

    $isMuted = MuteUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->where('unmute_at', '>', now())
        ->first();

    if ($isMuted && Auth::user()->role !== 'admin') {
        $timeRemaining = now()->diffInMinutes($isMuted->unmute_at);
        return redirect()->route('communities.chat', $community)
            ->with('error', __('You are muted for :minutes more minutes.', ['minutes' => $timeRemaining]));
    }

    $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
    if (!$isMember && Auth::user()->role !== 'admin') {
        return redirect()->route('communities.show', $community)
            ->with('error', __('You must be a member to post in this chat.'));
    }

    $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();

    if ($isChatLocked) {
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $userRole = $memberRecord?->pivot?->role ?? 'member';
        $canModerate = in_array($userRole, ['admin', 'moderator']) || Auth::user()->role === 'admin';

        if (!$canModerate) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('Chat is currently locked. Only moderators can post messages.'));
        }
    }

    $lampiranPath = null;
    $lampiranNama = null;
    $lampiranTipe = null;

    if ($request->hasFile('lampiran')) {
        $file = $request->file('lampiran');

        if ($file->isValid()) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $lampiranPath = $file->storeAs('lampiran/messages', $fileName, 'public');
            $lampiranNama = $file->getClientOriginalName();

            if (str_starts_with($file->getMimeType(), 'image/')) {
                $lampiranTipe = 'image';
            } else {
                $lampiranTipe = 'file';
            }
        }
    }

    $message = new Message();
    $message->isi_pesan= $request->konten;
    $message->user_id = Auth::id();
    $message->community_id = $community->community_id;
    $message->tgl_pesan = now();

    if ($lampiranPath) {
        $message->lampiran = $lampiranPath;
        $message->lampiran_nama = $lampiranNama;
        $message->lampiran_tipe = $lampiranTipe;
    }

    $message->save();

   $community->users()->updateExistingPivot(Auth::id(), [
        'aktif_flag' => 1,
        'terakhir_aktif' => now()
    ]);

    return redirect()->route('communities.chat', $community);
}


    public function deleteMessage(Community $community, Message $message)
    {
        $isOwner = $message->user_id === Auth::id();

        if (!$isOwner) {
            $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
            $userRole = $memberRecord?->pivot?->role ?? 'member';
            $canModerate = in_array($userRole, ['admin', 'moderator']) || Auth::user()->role === 'admin';

            if (!$canModerate) {
                return redirect()->route('communities.chat', $community)
                    ->with('error', __('You do not have permission to delete this message.'));
            }
        }

        $message->delete();

        return redirect()->route('communities.chat', $community)
            ->with('success', __('Message deleted successfully.'));
    }


    public function lockChat(Request $request, Community $community)
    {

        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $userRole = $memberRecord?->pivot?->role ?? 'member';
        $canModerate = in_array($userRole, ['admin', 'moderator']) || Auth::user()->role === 'admin';

        if (!$canModerate) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to perform this action.'));
        }


        $isLocked = CommunityLock::where('community_id', $community->community_id)->exists();

        if ($isLocked) {

            CommunityLock::where('community_id', $community->community_id)->delete();
            return redirect()->route('communities.chat', $community)
                ->with('success', __('Chat Sudah Dikunci.'));
        } else {

            CommunityLock::create([
                'community_id' => $community->community_id,
                'locked_by' => Auth::id(),
                'locked_at' => now(),
                'reason' => $request->input('reason')
            ]);

            return redirect()->route('communities.chat', $community)
                ->with('success', __('Chat sudah diKunci.'));
        }
    }


    public function BanUsers(Request $request, Community $community, User $user)
    {
        if (!BanUsers::canBan(Auth::user(), $community) && Auth::user()->role !== 'admin') {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to ban users.'));
        }

        $existingBan = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', $user->user_id)
        ->first();


        $targetMember = $community->users()->where('users.user_id', $user->user_id)->first();
        if ($targetMember && in_array($targetMember->pivot->role, ['moderator', 'admin'])) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You cannot ban a moderator or admin.'));
        }

        if ($existingBan) {
        return redirect()->back()->with('info', 'Pengguna sudah dalam keadaan diblokir sejak ' .
            $existingBan->banned_at->format('H:i, d M Y'));

    }

     $currentMember = $community->users()
        ->where('users.user_id', Auth::id())
        ->first();

     $isSystemAdmin = Auth::user()->role === 'admin';
    $isCommAdmin = $currentMember && $currentMember->pivot->role === 'admin';
    $isModerator = $currentMember && ($currentMember->pivot->role === 'moderator' || $currentMember->pivot->role === 'admin');

      if (!$isModerator && !$isSystemAdmin) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memblokir pengguna.');
    }


        BanUsers::create([
            'community_id' => $community->community_id,
            'user_id' => $user->user_id,
            'banned_by' => Auth::id(),
            'banned_at' => now(),
            'reason' => $request->input('reason')
        ]);

        $community->users()->detach($user->user_id);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('user telah diban.'));
    }



public function unban(Community $community, $userId)
{
    // Find the user
    $user = User::find($userId);
    if (!$user) {
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }

    // Check if the current user has permission to unban
    $currentMember = $community->users()->where('users.user_id', Auth::id())->first();
    $isSystemAdmin = Auth::user()->role === 'admin';
    $isCommAdmin = $currentMember && $currentMember->pivot->role === 'admin';
    $isModerator = $currentMember && ($currentMember->pivot->role === 'moderator' || $currentMember->pivot->role === 'admin');

    if (!$isModerator && !$isSystemAdmin) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk membatalkan blokir pengguna.');
    }

    // Remove the ban
    $ban = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', $userId)
        ->first();

    if ($ban) {
        $ban->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dibatalkan blokirnya.');
    } else {
        return redirect()->back()->with('info', 'Pengguna tidak sedang diblokir.');
    }
}

public function unBanUsers(Community $community, User $user = null, Request $request)
{
    if (!$user && $request && $request->has('user_id')) {
        $userId = $request->user_id;
        $user = User::find($userId);
    }

    if (!$user) {
        return redirect()->route('communities.chat', $community)
            ->with('error', __('User not found.'));
    }

    $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
    $userRole = $memberRecord?->pivot?->role ?? 'member';
    $isAdmin = $userRole === 'admin' || Auth::user()->role === 'admin';

    if (!$isAdmin) {
        return redirect()->route('communities.chat', $community)
            ->with('error', __('You do not have permission to unban users.'));
    }

    BanUsers::where('community_id', $community->community_id)
        ->where('user_id', $user->user_id)
        ->delete();

    return redirect()->route('communities.chat', $community)
        ->with('success', __('User has been unbanned successfully.'));
}

    public function MuteUsers(Request $request, Community $community, User $user)
    {

        if (!Auth::user()->can('mute_users', $community) && Auth::user()->role !== 'admin') {
        return redirect()->route('communities.chat', $community)
            ->with('error', 'Anda tidak memiliki izin untuk membisukan pengguna.');
    }


    $targetMember = $community->users()->where('users.user_id', $user->user_id)->first();
    if ($targetMember && in_array($targetMember->pivot->role, ['moderator', 'admin'])) {
        return redirect()->route('communities.chat', $community)
            ->with('error', __('You cannot mute a moderator or admin.'));
    }

    $minutes = $request->input('duration', 30);

    // Mute the user
    MuteUsers::create([
        'community_id' => $community->community_id,
        'user_id' => $user->user_id,
        'muted_by' => Auth::id(),
        'muted_at' => now(),
        'unmute_at' => now()->addMinutes($minutes),
        'reason' => $request->input('reason')
    ]);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been muted for :minutes minutes.', ['minutes' => $minutes]));
    }


public function unMuteUsers(Community $community, User $user = null, Request $request = null)
{
    if (!$user && $request && $request->has('user_id')) {
        $userId = $request->user_id;
        $user = User::find($userId);
    } else if (!$user && isset($userId)) {
        $user = User::find($userId);
    }

    if (!$user) {
        return redirect()->route('communities.chat', $community)
            ->with('error', __('User not found.'));
    }

    $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
    $userRole = $memberRecord?->pivot?->role ?? 'member';
    $canModerate = in_array($userRole, ['admin', 'moderator']) || Auth::user()->role === 'admin';

    if (!$canModerate) {
        return redirect()->route('communities.chat', $community)
            ->with('error', __('You do not have permission to unmute users.'));
    }

    MuteUsers::where('community_id', $community->community_id)
        ->where('user_id', $user->user_id)
        ->update(['unmute_at' => now()]);

    return redirect()->route('communities.chat', $community)
        ->with('success', __('User has been unmuted successfully.'));
}

public function unmute(Community $community, User $user)
{
    // Find the user
    $userObj = User::find($user);
    if (!$userObj) {
        return redirect()->route('communities.chat', $community)
            ->with('error', __('User tidak ditemukan.'));
    }

    $isSystemAdmin = Auth::user()->role === 'admin';
    $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
    $userRole = $memberRecord?->pivot?->role ?? 'member';
    $canModerate = in_array($userRole, ['admin', 'moderator']) || $isSystemAdmin;

    if (!$canModerate) {
        return redirect()->route('communities.chat', $community)
            ->with('error', __('You do not have permission to unmute users.'));
    }

    $mute = MuteUsers::where('community_id', $community->community_id)
        ->where('user_id', $user)
        ->first();

    if ($mute) {
        $mute->unmute_at = now();
        $mute->save();
        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been unmuted successfully.'));
    } else {
        return redirect()->route('communities.chat', $community)
            ->with('info', __('User is not currently muted.'));
    }
}
   public function promoteModerator(Community $community, User $user)
    {
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $isAdmin = ($memberRecord && $memberRecord->pivot->role === 'admin') || Auth::user()->role === 'admin';

        if (!$isAdmin) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to promote users.'));
        }

        $community->users()->updateExistingPivot($user->user_id, [
            'role' => 'moderator'
        ]);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been promoted to moderator.'));
    }

       public function demoteModerator(Community $community, User $user)
    {
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $isAdmin = ($memberRecord && $memberRecord->pivot->role === 'admin') || Auth::user()->role === 'admin';

        if (!$isAdmin) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to demote users.'));
        }

        $community->users()->updateExistingPivot($user->user_id, [
            'role' => 'member'
        ]);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been demoted to member.'));
    }


    public function leave(Community $community)
    {
        $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
        if (!$isMember) {
            return redirect()->route('communities.index')
                ->with('error', __('You are not a member of this community.'));
        }

        $userRole = $community->users()->where('users.user_id', Auth::id())->first()->pivot->role ?? 'member';

        if (in_array($userRole, ['admin', 'moderator'])) {
            $adminCount = $community->users()
                ->wherePivotIn('role', ['admin', 'moderator'])
                ->count();

            if ($adminCount <= 1) {
                return redirect()->route('communities.show', $community)
                    ->with('error', __('You cannot leave as you are the only moderator. Assign another moderator first.'));
            }
        }

        $community->users()->detach(Auth::id());

        return redirect()->route('communities.index')
            ->with('success', __('You have successfully left the community.'));
    }


    public function moderation(Community $community)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', __('You need to log in to access this page.'));
        }

        $isSystemAdmin = Auth::user()->role === 'admin';
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $userRole = $memberRecord?->pivot?->role ?? 'member';
        $canModerate = in_array($userRole, ['admin', 'moderator']) || $isSystemAdmin;

        if (!$canModerate) {
            return redirect()->route('communities.show', $community)
                ->with('error', __('You do not have permission to access the moderation dashboard.'));
        }

        $members = $community->users()
            ->withPivot('role', 'tg_gabung')
            ->get();

        $BanUserss = BanUsers::where('community_id', $community->community_id)
            ->with(['user', 'bannedBy'])
            ->get();

        $MuteUserss = MuteUsers::where('community_id', $community->community_id)
            ->where('unmute_at', '>', now())
            ->with(['user', 'mutedBy'])
            ->get();

        $messageStats = Message::where('community_id', $community->community_id)
            ->selectRaw('user_id, COUNT(*) as count')
            ->groupBy('user_id')
            ->with('user')
            ->get();

        $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();
        $lockInfo = null;

        if ($isChatLocked) {
            $lockInfo = CommunityLock::where('community_id', $community->community_id)
                ->with('lockedBy')
                ->first();
        }

        return view('admin.community.moderation', compact(
            'community',
            'members',
            'BanUserss',
            'MuteUserss',
            'messageStats',
            'isChatLocked',
            'lockInfo',
            'userRole',
            'isSystemAdmin'
        ));
    }



public function muteUser(Request $request, Community $community)
{
    $request->validate([
        'user_id' => 'required|exists:users,user_id',
        'duration' => 'required|integer|min:1|max:10080',
        'reason' => 'nullable|string|max:255',
    ]);

    $userId = $request->user_id;
    $duration = (int)$request->duration;
    $reason = $request->reason;
    $unmuteAt = now()->addMinutes($duration);


     MuteUsers::updateOrCreate(
        [
            'community_id' => $community->community_id,
            'user_id' => $userId
        ],
        [
            'muted_by' => Auth::id(),
            'reason' => $reason,
            'unmute_at' => $unmuteAt
        ]
    );

     $existingMute = MuteUsers::where('community_id', $community->community_id)
        ->where('user_id', $userId)
        ->where('unmute_at', '>', now())
        ->first();

    if ($existingMute) {
        return redirect()->back()->with('info', 'Pengguna sudah dalam keadaan dibisukan sampai ' .
            $existingMute->unmute_at->format('H:i, d M Y'));
    }

     $targetUser = User::find($userId);
    if (!$targetUser) {
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }

    if ($targetUser->role === 'admin') {
        return redirect()->back()->with('error', 'Anda tidak dapat membisukan administrator sistem.');
    }

    $targetMember = $community->users()
        ->where('users.user_id', $userId)
        ->first();

    $currentMember = $community->users()
        ->where('users.user_id', Auth::id())
        ->first();

    $isSystemAdmin = Auth::user()->role === 'admin';
    $isCommAdmin = $currentMember && $currentMember->pivot->role === 'admin';
    $isModerator = $currentMember && ($currentMember->pivot->role === 'moderator' || $currentMember->pivot->role === 'admin');

    if (!$isModerator && !$isSystemAdmin) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk membisukan pengguna.');
    }

    if ($targetMember && $targetMember->pivot->role === 'admin' && !$isSystemAdmin && !$isCommAdmin) {
        return redirect()->back()->with('error', 'Anda tidak dapat membisukan admin komunitas.');
    }

    $unmuteAt = now()->addMinutes($duration);


    if ($existingMute) {
        $existingMute->unmute_at = $unmuteAt;
        $existingMute->muted_by = Auth::id();
        $existingMute->reason = $reason;
        $existingMute->save();

        return redirect()->back()->with('success', 'Durasi bisu pengguna telah diperbarui.');
    }

    $mute = new MuteUsers();
    $mute->community_id = $community->community_id;
    $mute->user_id = $userId;
    $mute->muted_by = Auth::id();
    $mute->reason = $reason;
    $mute->unmute_at = $unmuteAt;
    $mute->save();

    return redirect()->back()->with('success', 'Pengguna telah dibisukan hingga ' . $unmuteAt->format('H:i, d M Y'));
}

public function banUser(Request $request, Community $community)
{
    $request->validate([
        'user_id' => 'required|exists:users,user_id',
        'reason' => 'nullable|string|max:255',
    ]);

    $userId = $request->user_id;
    $reason = $request->reason;


    $targetUser = User::find($userId);
    if (!$targetUser) {
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
    }


    $existingBan = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', $userId)
        ->first();

    if ($existingBan) {
        return redirect()->back()->with('info', 'Pengguna sudah dalam keadaan diblokir sejak ' .
            $existingBan->banned_at->format('H:i, d M Y'));
    }


    $targetMember = $community->users()->where('users.user_id', $userId)->first();
    $currentMember = $community->users()->where('users.user_id', Auth::id())->first();

    $isSystemAdmin = Auth::user()->role === 'admin';
    $isCommAdmin = $currentMember && $currentMember->pivot->role === 'admin';
    $isModerator = $currentMember && ($currentMember->pivot->role === 'moderator' || $currentMember->pivot->role === 'admin');

    if (!$isModerator && !$isSystemAdmin) {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk memblokir pengguna.');
    }

    if ($targetMember && $targetMember->pivot->role === 'admin' && !$isSystemAdmin) {
        return redirect()->back()->with('error', 'Anda tidak dapat memblokir admin komunitas.');
    }

    if ($targetMember && $targetMember->pivot->role === 'moderator' && !$isSystemAdmin && !$isCommAdmin) {
        return redirect()->back()->with('error', 'Anda tidak dapat memblokir moderator komunitas.');
    }

    BanUsers::create([
        'community_id' => $community->community_id,
        'user_id' => $userId,
        'banned_by' => Auth::id(),
        'banned_at' => now(),
        'reason' => $request->reason
    ]);

    $community->users()->detach($userId);

    return redirect()->back()->with('success', 'Pengguna telah berhasil diblokir dari komunitas.');
}

}
