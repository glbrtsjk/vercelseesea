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
     * Menyimpan komentar baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        // Validasi data permintaan
        $request->validate([
            'article_id' => 'required|exists:articles,article_id',
            'konten' => 'required|string|max:1000',
        ]);

        // Membuat komentar
        $comment = Comment::create([
            'isi_komentar' => $request->konten,
            'tgl_komentar' => now(),
            'user_id' => Auth::id(),
            'article_id' => $request->article_id,
        ]);
        $article = Article::findOrFail($request->article_id);

        // Mengalihkan ke artikel menggunakan parameter slug yang sesuai
        return redirect()->route('articles.show', $article->slug)->withFragment('comments');
    }

    /**
     * Memperbarui komentar tertentu di dalam penyimpanan.
     */
    public function update(Request $request, Comment $comment)
    {
        // Memeriksa apakah pengguna berwenang untuk memperbarui
        if (Auth::id() != $comment->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        // Validasi permintaan
        $request->validate([
            'konten' => 'required|string',
        ]);

        // Memperbarui komentar
        $comment->isi_komentar = $request->konten;
        $comment->save();
        $article = Article::findOrFail($comment->article_id);

        // Mengalihkan ke artikel menggunakan parameter slug yang sesuai
        return redirect()->route('articles.show', $article->slug)->withFragment('comments');
    }

    /**
     * Menghapus komentar tertentu dari penyimpanan.
     */
    public function destroy(Comment $comment)
    {
        // Memeriksa apakah pengguna berwenang untuk menghapus
        if (Auth::id() != $comment->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $articleId = $comment->article_id;
        $comment->delete();

        $article = Article::findOrFail($articleId);

        // Mengalihkan ke artikel menggunakan parameter slug yang sesuai
        return redirect()->route('articles.show', $article->slug)->withFragment('comments');
    }
}