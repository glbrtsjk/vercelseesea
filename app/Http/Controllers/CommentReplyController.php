<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created comment reply in storage.
     */
    public function store(Request $request, Comment $comment)
    {
        // Validate request
        $request->validate([
            'konten' => 'required|string'
        ]);

        // Create reply
        CommentReply::create([
            'isi_balasan' => $request->konten,
            'tgl_balasan' => now(),
            'comment_id' => $comment->comment_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('articles.show', $comment->article_id)
            ->with('success', 'Reply posted successfully')
            ->fragment('comment-' . $comment->comment_id);
    }

    /**
     * Update the specified comment reply in storage.
     */
    public function update(Request $request, Comment $comment, CommentReply $reply)
    {
        // Check if user is authorized to update
        if (Auth::id() != $reply->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        // Validate request
        $request->validate([
            'konten' => 'required|string',
        ]);

        // Update reply
        $reply->isi_balasan = $request->konten;
        $reply->save();

        return redirect()->route('articles.show', $comment->article_id)
            ->with('success', 'Reply updated successfully')
            ->fragment('comment-' . $comment->comment_id);
    }

    /**
     * Remove the specified comment reply from storage.
     */
    public function destroy(Comment $comment, CommentReply $reply)
    {
        // Check if user is authorized to delete
        if (Auth::id() != $reply->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $reply->delete();

        return redirect()->route('articles.show', $comment->article_id)
            ->with('success', 'Reply deleted successfully')
            ->fragment('comment-' . $comment->comment_id);
    }
}