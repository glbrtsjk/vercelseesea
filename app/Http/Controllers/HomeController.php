<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Funfact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan konten unggulan.
     */
    public function index()
    {
        // Mendapatkan artikel terbaru yang dipublikasikan
        $latestArticles = Article::where('status', 'published')
            ->with(['user', 'category', 'tags', 'reactions'])
            ->orderBy('tgl_upload', 'desc')
            ->take(6)
            ->get();

        // Mendapatkan artikel populer berdasarkan jumlah reaksi
        $popularArticles = Article::where('status', 'published')
            ->withCount('reactions')
            ->with(['user', 'category', 'tags'])
            ->orderBy('reactions_count', 'desc')
            ->take(4)
            ->get();

        // Mendapatkan fakta menarik secara acak
        $funfacts = Funfact::inRandomOrder()->take(3)->get();

        // Mendapatkan semua kategori
        $categories = Category::withCount('articles')->get();

        // Mendapatkan statistik untuk bagian metrik
        $stats = [
            'publishedArticles' => Article::where('status', 'published')->count(),
            'activeUsers' => User::where('last_active_at', '>', now()->subDays(30))->count(),
            'totalUsers' => User::count(),
            'funfactCount' => Funfact::count(),
            'reactionCount' => DB::table('reactions')->count(),
            'commentCount' => DB::table('comments')->count() // Menggunakan facade DB untuk penghitungan sederhana
        ];

        return view('home1', compact(
            'latestArticles',
            'popularArticles',
            'funfacts',
            'categories',
            'stats'
        ));
    }

    /**
     * Mencari artikel berdasarkan kueri
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');

        // Kueri dasar untuk artikel yang disetujui
        $articlesQuery = Article::where('is_approved', true);

        // Menerapkan kata pencarian jika disediakan
        if ($query) {
            $articlesQuery->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                  ->orWhere('konten_isi_artikel', 'like', "%{$query}%");
            });
        }

        if ($categoryId) {
            $articlesQuery->where('category_id', $categoryId);
        }

        // Mendapatkan hasil pencarian dengan data terkait
        $articles = $articlesQuery->with(['user', 'category', 'tags'])
            ->orderBy('tgl_upload', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('articles.search', compact('articles', 'categories', 'query', 'categoryId'));
    }
}