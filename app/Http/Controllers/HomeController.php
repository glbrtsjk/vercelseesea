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
     * Display the homepage with featured content.
     */
    public function index()
    {
        // Get latest published articles
        $latestArticles = Article::where('status', 'published')
            ->with(['user', 'category', 'tags', 'reactions'])
            ->orderBy('tgl_upload', 'desc')
            ->take(6)
            ->get();

        // Get popular articles based on reaction count
        $popularArticles = Article::where('status', 'published')
            ->withCount('reactions')
            ->with(['user', 'category', 'tags'])
            ->orderBy('reactions_count', 'desc')
            ->take(4)
            ->get();

        // Get random funfacts
        $funfacts = Funfact::inRandomOrder()->take(3)->get();

        // Get all categories
        $categories = Category::withCount('articles')->get();

        // Get statistics for the metrics section
        $stats = [
            'publishedArticles' => Article::where('status', 'published')->count(),
            'activeUsers' => User::where('last_active_at', '>', now()->subDays(30))->count(),            'totalUsers' => User::count(),
            'funfactCount' => Funfact::count(),
            'reactionCount' => DB::table('reactions')->count(),
            'commentCount' => DB::table('comments')->count() // Using DB facade for simple count
        ];

        return view('home', compact(
            'latestArticles',
            'popularArticles',
            'funfacts',
            'categories',
            'stats'
        ));
    }

    /**
     * Search for articles based on query
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');

        // Base query for approved articles
        $articlesQuery = Article::where('is_approved', true);

        // Apply search term if provided
        if ($query) {
            $articlesQuery->where(function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                  ->orWhere('konten_isi_artikel', 'like', "%{$query}%");
            });
        }

        if ($categoryId) {
            $articlesQuery->where('category_id', $categoryId);
        }

        // Get search results with related data
        $articles = $articlesQuery->with(['user', 'category', 'tags'])
            ->orderBy('tgl_upload', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('articles.search', compact('articles', 'categories', 'query', 'categoryId'));
    }
}
