<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Message;
use App\Models\CommunityMember;
use App\Models\CommunityLock;
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
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of communities.
     */
    public function index(Request $request)
    {
        $query = Community::withCount('users');

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_komunitas', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $communities = $query->orderBy('users_count', 'desc')
            ->paginate(12)
            ->withQueryString();

        return view('community.index', compact('communities'));
    }

    /**
     * Display the specified community.
     */
    public function show(Community $community)
    {
        $community->load('users', 'messages');

        // Check if user is a member of this community
        $isMember = false;
        $isModerator = false;
        $isModeratorOrAdmin = false;
        $memberRecord = null;

        if (Auth::check()) {
            // Define memberRecord before using it
            $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
            $isMember = $memberRecord ? true : false;

            // Check if user is banned from this community
            $isBanned = BanUsers::where('community_id', $community->community_id)
                ->where('user_id', Auth::id())
                ->exists();

            if ($isBanned) {
                return redirect()->route('communities.index')
                    ->with('error', __('You have been banned from this community.'));
            }

            if ($memberRecord && isset($memberRecord->pivot->role)) {
                $isModerator = in_array($memberRecord->pivot->role, ['moderator', 'admin']);
                // Check if user is either a community moderator or a system admin
                $isModeratorOrAdmin = $isModerator || Auth::user()->role === 'admin';
            } elseif (Auth::check() && Auth::user()->role === 'admin') {
                // System admin who is not a community member yet
                $isModeratorOrAdmin = true;
            }
        }

        // Check if chat is locked
        $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();
        $messages = $community->messages()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('community.show', compact(
            'community',
            'isMember',
            'isModerator',
            'isModeratorOrAdmin',
            'isChatLocked',
            'messages'
        ));
    }

    /**
     * Create a new community
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'nama_komunitas' => 'required|string|max:255|unique:communities,nama_komunitas',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Process image if uploaded
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'communities');
        }

        // Create slug from name
        $slug = Str::slug($request->nama_komunitas);
        $uniqueSlug = $this->createUniqueSlug($slug);

        // Create community
        $community = Community::create([
            'nama_komunitas' => $request->nama_komunitas,
            'slug' => $uniqueSlug,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        // Auto-join the creator to the community as a moderator
        $community->users()->attach(Auth::id(), [
            'tg_gabung' => now(),
            'role' => 'moderator'  // Set the creator as a moderator
        ]);

        return redirect()->route('communities.show', $community)
            ->with('success', __('messages.community_created'));
    }

    /**
     * Generate a unique slug for the community
     */
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

    /**
     * Show form to join a community
     */
    public function showJoinForm(Community $community)
    {
        // Check if user is banned from this community
        if (Auth::check()) {
            $isBanned = BanUsers::where('community_id', $community->community_id)
                ->where('user_id', Auth::id())
                ->exists();

            if ($isBanned) {
                return redirect()->route('communities.index')
                    ->with('error', __('You have been banned from this community.'));
            }

            // Check if already a member
            $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
            if ($isMember) {
                return redirect()->route('communities.show', $community)
                    ->with('info', __('You are already a member of this community.'));
            }
        }

        return view('community.join', compact('community'));
    }

    /**
     * Join a community
     */
    public function join(Request $request, Community $community)
    {
        // Check if user is banned
        $isBanned = BanUsers::where('community_id', $community->community_id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($isBanned) {
            return redirect()->route('communities.index')
                ->with('error', __('You have been banned from this community.'));
        }

        // Check if already a member
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
            'role' => 'member'  // Set default role
        ]);

        return redirect()->route('communities.show', $community)
            ->with('success', __('You have successfully joined this community.'));
    }

    /**
     * Display the chat for a community
 * Display the chat for a community
 */
public function chat(Community $community)
{
    // Check if user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')
            ->with('error', __('You need to log in to access the chat.'));
    }

    // Check if user is banned from this community
    $isBanned = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->exists();

    if ($isBanned) {
        return redirect()->route('communities.index')
            ->with('error', __('You have been banned from this community.'));
    }

    $isSystemAdmin = Auth::user()->role === 'admin';

    // Check if user is a member or system admin
    $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
    $isMember = $memberRecord ? true : false;

    if (!$isMember && !$isSystemAdmin) {
        return redirect()->route('communities.show', $community)
            ->with('error', __('You must be a member to access the chat.'));
    }

    // Get user role in this community
    $userRole = $memberRecord?->pivot?->role ?? 'member';

    // Determine if user has moderation privileges
    $canModerate = in_array($userRole, ['admin', 'moderator']) || $isSystemAdmin;

    // Check if user is currently muted
    $isMuted = MuteUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->where('unmute_at', '>', now())
        ->exists();

    // Get community messages with their authors
    $messages = Message::where('community_id', $community->community_id)
        ->with('user')
        ->orderBy('tgl_pesan', 'asc')
        ->get();

    // Get community members with their roles
    $members = $community->users()
        ->withPivot('role')
        ->orderByPivot('role', 'asc')
        ->get();

    // Check if chat is locked and get lock information
    $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();
    $lockInfo = null;

    if ($isChatLocked) {
        $lockInfo = CommunityLock::where('community_id', $community->community_id)
            ->with('lockedBy')
            ->first();
    }

    // Get slow mode setting (default to 0 - disabled)
    $isSlowMode = 0; // You should replace this with actual lookup of slow mode settings

    // Return the view with all required data, regardless of user role
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
        'isSlowMode'
    ));
}

/**
 * Store a new message in the chat
 */
public function storeMessage(Request $request, Community $community)
{
    // Validate the request
    $request->validate([
        'konten' => 'required|string|max:1000',
        'attachment' => 'nullable|file|max:10240', // 10MB max
    ]);

    // Check if user is banned
    $isBanned = BanUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->exists();

    if ($isBanned) {
        return redirect()->route('communities.index')
            ->with('error', __('You have been banned from this community.'));
    }

    // Check if user is muted
    $isMuted = MuteUsers::where('community_id', $community->community_id)
        ->where('user_id', Auth::id())
        ->where('unmute_at', '>', now())
        ->first();

    if ($isMuted && Auth::user()->role !== 'admin') {
        $timeRemaining = now()->diffInMinutes($isMuted->unmute_at);
        return redirect()->route('communities.chat', $community)
            ->with('error', __('You are muted for :minutes more minutes.', ['minutes' => $timeRemaining]));
    }

    // Check if user is a member or admin
    $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
    if (!$isMember && Auth::user()->role !== 'admin') {
        return redirect()->route('communities.show', $community)
            ->with('error', __('You must be a member to post in this chat.'));
    }

    // Check if the chat is locked
    $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();

    if ($isChatLocked) {
        // Check if user has permissions to post in locked chat (moderators and admins only)
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $userRole = $memberRecord?->pivot?->role ?? 'member';
        $canModerate = in_array($userRole, ['admin', 'moderator']) || Auth::user()->role === 'admin';

        if (!$canModerate) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('Chat is currently locked. Only moderators can post messages.'));
        }
    }

    // Initialize attachment fields
    $attachmentPath = null;
    $attachmentName = null;
    $attachmentType = null;

    // Handle file upload if present
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');

        if ($file->isValid()) {
            $fileName = time() . '_' . $file->getClientOriginalName();
            $attachmentPath = $file->storeAs('attachments/messages', $fileName, 'public');
            $attachmentName = $file->getClientOriginalName();

            // Determine attachment type
            if (str_starts_with($file->getMimeType(), 'image/')) {
                $attachmentType = 'image';
            } else {
                $attachmentType = 'file';
            }
        }
    }

    // Store the message
    $message = new Message();
    $message->konten = $request->konten;
    $message->user_id = Auth::id();
    $message->community_id = $community->community_id;
    $message->tgl_pesan = now();

    if ($attachmentPath) {
        $message->attachment = $attachmentPath;
        $message->attachment_name = $attachmentName;
        $message->attachment_type = $attachmentType;
    }

    $message->save();

    return redirect()->route('communities.chat', $community);
}

    /**
     * Delete a message from the chat
     */
    public function deleteMessage(Community $community, Message $message)
    {
        // Check if user owns the message or has moderation privileges
        $isOwner = $message->user_id === Auth::id();

        if (!$isOwner) {
            // Check if user has moderation rights
            $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
            $userRole = $memberRecord?->pivot?->role ?? 'member';
            $canModerate = in_array($userRole, ['admin', 'moderator']) || Auth::user()->role === 'admin';

            if (!$canModerate) {
                return redirect()->route('communities.chat', $community)
                    ->with('error', __('You do not have permission to delete this message.'));
            }
        }

        // Delete the message
        $message->delete();

        return redirect()->route('communities.chat', $community)
            ->with('success', __('Message deleted successfully.'));
    }

    /**
     * Lock or unlock the chat
     */
    public function lockChat(Request $request, Community $community)
    {
        // Check if user has moderation privileges
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $userRole = $memberRecord?->pivot?->role ?? 'member';
        $canModerate = in_array($userRole, ['admin', 'moderator']) || Auth::user()->role === 'admin';

        if (!$canModerate) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to perform this action.'));
        }

        // Check if chat is already locked
        $isLocked = CommunityLock::where('community_id', $community->community_id)->exists();

        if ($isLocked) {
            // Unlock the chat
            CommunityLock::where('community_id', $community->community_id)->delete();
            return redirect()->route('communities.chat', $community)
                ->with('success', __('Chat has been unlocked successfully.'));
        } else {
            // Lock the chat
            CommunityLock::create([
                'community_id' => $community->community_id,
                'locked_by' => Auth::id(),
                'locked_at' => now(),
                'reason' => $request->input('reason')
            ]);

            return redirect()->route('communities.chat', $community)
                ->with('success', __('Chat has been locked successfully.'));
        }
    }

    /**
     * Ban a user from a community
     */
    public function BanUsers(Request $request, Community $community, User $user)
    {
        // Check if the current user has permission to ban
        if (!BanUsers::canBan(Auth::user(), $community) && Auth::user()->role !== 'admin') {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to ban users.'));
        }

        // Check if the target user is a moderator/admin (cannot ban them)
        $targetMember = $community->users()->where('users.user_id', $user->user_id)->first();
        if ($targetMember && in_array($targetMember->pivot->role, ['moderator', 'admin'])) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You cannot ban a moderator or admin.'));
        }

        // Ban the user
        BanUsers::create([
            'community_id' => $community->community_id,
            'user_id' => $user->user_id,
            'banned_by' => Auth::id(),
            'banned_at' => now(),
            'reason' => $request->input('reason')
        ]);

        // If the user was a member, remove them from the community
        $community->users()->detach($user->user_id);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been banned successfully.'));
    }

    /**
     * Unban a user from a community
     */
    public function unBanUsers(Community $community, User $user)
    {
        // Check if the current user has permission to unban
        if (!BanUsers::canBan(Auth::user(), $community) && Auth::user()->role !== 'admin') {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to unban users.'));
        }

        // Remove the ban
        BanUsers::where('community_id', $community->community_id)
            ->where('user_id', $user->user_id)
            ->delete();

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been unbanned successfully.'));
    }

    /**
     * Mute a user in a community
     */
    public function MuteUsers(Request $request, Community $community, User $user)
    {
        // Check if the current user has permission to mute
        if (!MuteUsers::canMute(Auth::user(), $community) && Auth::user()->role !== 'admin') {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to mute users.'));
        }

        // Check if the target user is a moderator/admin (cannot mute them)
        $targetMember = $community->users()->where('users.user_id', $user->user_id)->first();
        if ($targetMember && in_array($targetMember->pivot->role, ['moderator', 'admin'])) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You cannot mute a moderator or admin.'));
        }

        // Get mute duration from request
        $minutes = $request->input('duration', 30);

        // Mute the user
        MuteUsers::create([
            'community_id' => $community->community_id,
            'user_id' => $user->user_id,
            'muted_by' => Auth::id(),
            'muted_at' => now(),
            'unmute_at' => now()->addMinutes($minutes)
        ]);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been muted for :minutes minutes.', ['minutes' => $minutes]));
    }

    /**
     * Unmute a user in a community
     */
    public function unMuteUsers(Community $community, User $user)
    {
        // Check if the current user has permission to unmute
        if (!MuteUsers::canMute(Auth::user(), $community) && Auth::user()->role !== 'admin') {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to unmute users.'));
        }

        // Remove the mute by updating unmute_at to now
        MuteUsers::where('community_id', $community->community_id)
            ->where('user_id', $user->user_id)
            ->update(['unmute_at' => now()]);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been unmuted successfully.'));
    }

    /**
     * Promote a user to moderator
     */
    public function promoteModerator(Community $community, User $user)
    {
        // Check if current user is admin of the community or system admin
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $isAdmin = ($memberRecord && $memberRecord->pivot->role === 'admin') || Auth::user()->role === 'admin';

        if (!$isAdmin) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to promote users.'));
        }

        // Update the user's role to moderator
        $community->users()->updateExistingPivot($user->user_id, [
            'role' => 'moderator'
        ]);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been promoted to moderator.'));
    }

    /**
     * Demote a user from moderator to regular member
     */
    public function demoteModerator(Community $community, User $user)
    {
        // Check if current user is admin of the community or system admin
        $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
        $isAdmin = ($memberRecord && $memberRecord->pivot->role === 'admin') || Auth::user()->role === 'admin';

        if (!$isAdmin) {
            return redirect()->route('communities.chat', $community)
                ->with('error', __('You do not have permission to demote users.'));
        }

        // Update the user's role to member
        $community->users()->updateExistingPivot($user->user_id, [
            'role' => 'member'
        ]);

        return redirect()->route('communities.chat', $community)
            ->with('success', __('User has been demoted to member.'));
    }

    /**
     * Leave a community
     */
    public function leave(Community $community)
    {
        // Check if member
        $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
        if (!$isMember) {
            return redirect()->route('communities.index')
                ->with('error', __('You are not a member of this community.'));
        }

        // Check if last admin/moderator
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

        // Leave the community
        $community->users()->detach(Auth::id());

        // Redirect to communities index page with success message
        return redirect()->route('communities.index')
            ->with('success', __('You have successfully left the community.'));
    }

    /**
     * Display the moderation dashboard for a community
     */
    public function moderation(Community $community)
    {
        // Check if user has moderation privileges
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

        // Get members with their roles
        $members = $community->users()
            ->withPivot('role', 'tg_gabung')
            ->get();

        // Get banned users
        $BanUserss = BanUsers::where('community_id', $community->community_id)
            ->with(['user', 'bannedBy'])
            ->get();

        // Get muted users
        $MuteUserss = MuteUsers::where('community_id', $community->community_id)
            ->where('unmute_at', '>', now())
            ->with(['user', 'mutedBy'])
            ->get();

        // Get message statistics
        $messageStats = Message::where('community_id', $community->community_id)
            ->selectRaw('user_id, COUNT(*) as count')
            ->groupBy('user_id')
            ->with('user')
            ->get();

        // Get chat lock status
        $isChatLocked = CommunityLock::where('community_id', $community->community_id)->exists();
        $lockInfo = null;

        if ($isChatLocked) {
            $lockInfo = CommunityLock::where('community_id', $community->community_id)
                ->with('lockedBy')
                ->first();
        }

        return view('community.moderation', compact(
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
}
