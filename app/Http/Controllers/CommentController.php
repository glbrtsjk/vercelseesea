<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'article_id' => 'required|exists:articles,article_id',
            'konten' => 'required|string',
        ]);

        // Create comment
        Comment::create([
            'konten' => $request->konten,
            'tgl_komen' => now(),
            'user_id' => Auth::id(),
            'article_id' => $request->article_id,
        ]);

        return redirect()->route('articles.show', $request->article_id)
            ->with('success', 'Comment posted successfully')
            ->fragment('comments');
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        // Check if user is authorized to update
        if (Auth::id() != $comment->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        // Validate request
        $request->validate([
            'konten' => 'required|string',
        ]);

        // Update comment
        $comment->konten = $request->konten;
        $comment->save();

        return redirect()->route('articles.show', $comment->article_id)
            ->with('success', 'Comment updated successfully')
            ->fragment('comments');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        // Check if user is authorized to delete
        if (Auth::id() != $comment->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $articleId = $comment->article_id;
        $comment->delete();

        return redirect()->route('articles.show', $articleId)
            ->with('success', 'Comment deleted successfully')
            ->fragment('comments');
    }
}