<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\FileUploadService;

class MessageController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');
    }

    /**
     * Store a newly created message in storage.
     */
    public function store(Request $request, Community $community)
    {
        // Validate that user is a member of the community
        $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
        if (!$isMember) {
            abort(403, 'You must join the community to send messages');
        }

        // Validate request data
        $request->validate([
            'isi_pesan' => 'required_without:gambar|string|nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tagged_users' => 'nullable|array',
            'tagged_users.*' => 'exists:users,user_id',
        ]);

        // Process image if uploaded
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'messages');
        }

        // Create message
        $message = Message::create([
            'isi_pesan' => $request->isi_pesan,
            'gambar' => $imagePath,
            'tgl_pesan' => now(),
            'user_id' => Auth::id(),
            'community_id' => $community->community_id,
        ]);

        // Sync tagged users
        if ($request->has('tagged_users')) {
            $message->taggedUsers()->sync($request->tagged_users);
        }

        // Return a partial view for AJAX requests or redirect back
        if ($request->ajax()) {
            $message->load(['user', 'taggedUsers']);
            return view('partials.message', compact('message'))->render();
        }

        return redirect()->back()->with('success', __('messages.message_sent'));
    }

    /**
     * Update the specified message in storage.
     */
    public function update(Request $request, Message $message)
    {
        // Check if user is authorized to update
        if (Auth::id() != $message->user_id) {
            abort(403);
        }

        // Validate request
        $request->validate([
            'isi_pesan' => 'required_without:gambar|string|nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tagged_users' => 'nullable|array',
            'tagged_users.*' => 'exists:users,user_id',
        ]);

        // Process image if new one uploaded
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($message->gambar) {
                Storage::delete($message->gambar);
            }
            $message->gambar = $this->fileUploadService->uploadFile($request->file('gambar'), 'messages');
        }

        // Update message
        $message->isi_pesan = $request->isi_pesan;
        $message->save();

        // Sync tagged users
        if ($request->has('tagged_users')) {
            $message->taggedUsers()->sync($request->tagged_users);
        } else {
            $message->taggedUsers()->detach();
        }

        return redirect()->back()->with('success', 'Message updated successfully');
    }

    /**
     * Remove the specified message from storage.
     */
    public function destroy(Message $message)
    {
        // Check if user is authorized to delete
        if (Auth::id() != $message->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        // Delete image if exists
        if ($message->gambar) {
            Storage::delete($message->gambar);
        }

        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully');
    }

    /**
     * Load more messages for a community
     */
    public function loadMore(Request $request, Community $community)
    {
        // Validate that user is a member of the community
        $isMember = $community->users()->where('users.user_id', Auth::id())->exists();
        if (!$isMember) {
            abort(403, 'You must join the community to view messages');
        }

        $page = $request->input('page', 1);
        $messages = Message::where('community_id', $community->community_id)
            ->with(['user', 'taggedUsers'])
            ->orderBy('tgl_pesan', 'desc')
            ->paginate(20, ['*'], 'page', $page);

        return view('partials.messages', compact('messages'))->render();
    }
}
