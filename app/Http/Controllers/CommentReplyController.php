<?php


namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Article;
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
     * Menyimpan balasan komentar baru ke dalam penyimpanan.
     */
    public function store(Request $request, Comment $comment)
    {
        // Validasi permintaan

        //dd($request->all());

        if (Auth::user()->is_banned) {
            return redirect()->route('articles.index')
                ->with('error', 'Akun Kamu telah diblokir. Kamu tidak dapat membuat artikel.');
        }

        $request->validate([
            'isi_balasan' => 'required|string'
        ]);

        // Membuat balasan
        CommentReply::create([
            'isi_balasan' => $request->isi_balasan,
            'tgl_balasan' => now(),
            'comment_id' => $comment->comment_id,
            'user_id' => Auth::id(),
        ]);
        $article = Article::findOrFail($comment->article_id);

        return redirect()->route('articles.show', $article->slug)
            ->with('success', 'Balasan berhasil dibuat')
            ->withFragment('comment-' . $comment->comment_id);
    }

    /**
     * Memperbarui balasan komentar tertentu dalam penyimpanan.
     */
    public function update(Request $request, Comment $comment, CommentReply $reply)
    {
        if (Auth::user()->is_banned) {
            return redirect()->route('articles.index')
                ->with('error', 'Akun Kamu telah diblokir. Kamu tidak dapat mengedit artikel.');
        }

        if (Auth::id() != $reply->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        // Validasi permintaan
        $request->validate([
            'isi_balasan' => 'required|string',
        ]);

        // Memperbarui balasan
        $reply->isi_balasan = $request->isi_balasan;
        $reply->save();
        $article = Article::findOrFail($comment->article_id);

        return redirect()->route('articles.show', $article->slug)
            ->with('success', 'Balasan berhasil diperbarui')
            ->withFragment('comment-' . $comment->comment_id);
    }

    /**
     * Menghapus balasan komentar tertentu dari penyimpanan.
     */
    public function destroy(Comment $comment, CommentReply $reply)
    {
        // Memeriksa apakah pengguna berwenang untuk menghapus
        if (Auth::id() != $reply->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $reply->delete();
        $article = Article::findOrFail($comment->article_id);

        return redirect()->route('articles.show', $article->slug)
            ->with('success', 'Balasan berhasil dihapus')
            ->withFragment('comment-' . $comment->comment_id);
    }
}