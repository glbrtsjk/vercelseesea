<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menyimpan reaksi baru atau memperbarui yang sudah ada menggunakan pengiriman formulir standar.
     */
    public function store(Request $request)
    {
        // Memvalidasi data permintaan
        $request->validate([
            'reactionable_id' => 'required|integer',
            'reactionable_type' => 'required|string|in:App\\Models\\Article,App\\Models\\Comment,App\\Models\\CommentReply',
            'jenis_reaksi' => 'required|string|in:like,love,laugh,sad,angry,wow',
            'redirect_url' => 'required|string',
        ]);

        // Memeriksa apakah objek yang dapat direaksikan ada
        $reactionableType = $request->reactionable_type;
        $reactionableId = $request->reactionable_id;

        $exists = $reactionableType::find($reactionableId);
        if (!$exists) {
            return redirect()->back()
                ->with('error', 'Konten yang ingin Anda beri reaksi tidak ada.');
        }

        // Mencari reaksi yang sudah ada dari pengguna ini untuk konten ini
        $existingReaction = Reaction::where('user_id', Auth::id())
            ->where('reactionable_id', $reactionableId)
            ->where('reactionable_type', $reactionableType)
            ->first();

        $message = '';

        if ($existingReaction) {
            // Jika reaksi sama, hapus (nonaktifkan)
            if ($existingReaction->jenis_reaksi == $request->jenis_reaksi) {
                $existingReaction->delete();
                $message = ucfirst($request->jenis_reaksi) . ' reaksi dihapus.';
            } else {
                // Jika reaksi berbeda, perbarui
                $existingReaction->jenis_reaksi = $request->jenis_reaksi;
                $existingReaction->save();
                $message = 'Reaksi diubah menjadi ' . $request->jenis_reaksi . '.';
            }
        } else {
            // Buat reaksi baru
            Reaction::create([
                'jenis_reaksi' => $request->jenis_reaksi,
                'user_id' => Auth::id(),
                'reactionable_id' => $reactionableId,
                'reactionable_type' => $reactionableType,
            ]);
            $message = ucfirst($request->jenis_reaksi) . ' reaksi ditambahkan.';
        }

        // Alihkan kembali dengan pesan sukses
        return redirect($request->redirect_url)
            ->with('success', $message)
            ->withFragment(isset($request->fragment) ? $request->fragment : '');
    }

    /**
     * Menampilkan jumlah reaksi untuk suatu item.
     */
    public function show(Request $request, $type, $id)
    {
        // Memetakan parameter URL ke kelas model
        $modelMap = [
            'article' => Article::class,
            'comment' => Comment::class,
            'reply' => CommentReply::class,
        ];

        if (!isset($modelMap[$type])) {
            abort(404);
        }

        $modelClass = $modelMap[$type];
        $item = $modelClass::findOrFail($id);

        // Mendapatkan pengguna yang memberi reaksi pada item ini, dikelompokkan berdasarkan jenis reaksi
        $reactionsByType = $item->reactions()
            ->with('user')
            ->get()
            ->groupBy('jenis_reaksi');

        return view('articles.reaction', [
            'item' => $item,
            'itemType' => $type,
            'reactionsByType' => $reactionsByType
        ]);
    }

    /**
     * Menghapus reaksi tertentu.
     */
    public function destroy(Request $request)
    {
        // Memvalidasi data permintaan
        $request->validate([
            'reactionable_id' => 'required|integer',
            'reactionable_type' => 'required|string|in:App\\Models\\Article,App\\Models\\Comment,App\\Models\\CommentReply',
            'redirect_url' => 'required|string',
        ]);

        // Menghapus reaksi
        Reaction::where('user_id', Auth::id())
            ->where('reactionable_id', $request->reactionable_id)
            ->where('reactionable_type', $request->reactionable_type)
            ->delete();

        return redirect($request->redirect_url)
            ->with('success', 'Reaksi berhasil dihapus')
            ->withFragment(isset($request->fragment) ? $request->fragment : '');
    }
}