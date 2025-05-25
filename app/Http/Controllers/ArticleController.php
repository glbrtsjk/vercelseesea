<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\FileUploadService;
use Illuminate\Routing\Controller;

class ArticleController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    /**
     * Display a listing of articles.
     */
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
            ->with(['user', 'category', 'tags', 'reactions']);

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by tag if provided
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use($request) {
                $q->where('tags.tag_id', $request->tag);
            });
        }

        // Get articles ordered by upload date
        $articles = $query->orderBy('tgl_upload', 'desc')->paginate(12);

        // Get categories and popular tags for filters
        $categories = Category::all();
        $tags = Tag::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->take(10)
            ->get();

        return view('articles.index', compact('articles', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'konten_isi_artikel' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,tag_id',
        ]);

        try {
            // Process image if uploaded
            $imagePath = null;
            if ($request->hasFile('gambar')) {
                $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'articles');
            }

            // Create slug from title
            $slug = Str::slug($request->judul);
            $uniqueSlug = $this->createUniqueSlug($slug);

            // Create article with appropriate status
            // Admin-created articles are immediately published, user articles go to pending
            $status = Auth::user()->isAdmin() ? 'published' : 'pending';

            $article = Article::create([
                'judul' => $request->judul,
                'slug' => $uniqueSlug,
                'konten_isi_artikel' => $request->konten_isi_artikel,
                'gambar' => $imagePath,
                'tgl_upload' => now(),
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'status' => $status,
                'is_featured' => false,
            ]);

            // Sync tags if selected
            if ($request->has('tags')) {
                $article->tags()->sync($request->tags);
            }

            $message = Auth::user()->isAdmin()
                ? 'Article published successfully!'
                : 'Article submitted successfully! It will be reviewed by our editors before publication.';

            return redirect()->route('dashboard.articles')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating article: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // If article is not published and user is not admin or the owner
        if ($article->status !== 'published' && (!Auth::check() || (Auth::id() != $article->user_id && !Auth::user()->isAdmin()))) {
            abort(404);
        }

        $article->load(['user', 'category', 'tags', 'comments.user', 'comments.replies.user', 'funfacts']);

        // Get related articles by category or tags
        $relatedArticles = Article::where('status', 'published')
            ->where('article_id', '!=', $article->article_id)
            ->where(function ($query) use ($article) {
                $query->where('category_id', $article->category_id)
                    ->orWhereHas('tags', function ($q) use ($article) {
                        $q->whereIn('tags.tag_id', $article->tags->pluck('tag_id'));
                    });
            })
            ->with(['user', 'category'])
        ->latest('tgl_upload')
        ->take(5)
        ->get();

    $categories = Category::all();

    $tags = Tag::withCount('articles')
        ->orderBy('articles_count', 'desc')
        ->take(10)
        ->get();

    // Load article relationships
    $article->load([
        'user',
        'category',
        'tags',
        'funfacts',
        'comments' => function ($query) {
            $query->latest();
        },
        'comments.user',
        'comments.replies.user',
    ]);

    // Current URL for redirect after actions
    $currentUrl = url()->current();

    return view('articles.show', compact(
        'article',
        'categories',
        'tags',
        'relatedArticles',
        'currentUrl'
    ));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        // Check if user is authorized to edit
        if (Auth::id() != $article->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified article in storage.
     */
    public function update(Request $request, Article $article)
    {
        // Check if user is authorized to update
        if (Auth::id() != $article->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate request
        $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'konten_isi_artikel' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,tag_id',
        ]);

        try {
            // Update slug if title changed
            if ($article->judul !== $request->judul) {
                $slug = Str::slug($request->judul);
                $uniqueSlug = $this->createUniqueSlug($slug, $article->article_id);
                $article->slug = $uniqueSlug;
            }

            // Process image if new one uploaded
            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($article->gambar) {
                    Storage::delete($article->gambar);
                }
                $article->gambar = $this->fileUploadService->uploadFile($request->file('gambar'), 'articles');
            }

            // Update article details
            $article->judul = $request->judul;
            $article->konten_isi_artikel = $request->konten_isi_artikel;
            $article->category_id = $request->category_id;

            // Handle status update based on user role
            if (Auth::user()->isAdmin()) {
                // Admin can update status and featured flag
                if ($request->has('status')) {
                    $article->status = $request->status;
                }

                if ($request->has('is_featured')) {
                    $article->is_featured = (bool)$request->is_featured;
                }
            } else {
                // Regular user's edits go back to pending, unless it's already a draft
                if ($article->status !== 'draft') {
                    $article->status = 'pending';
                }
            }

            $article->save();

            // Sync tags
            if ($request->has('tags')) {
                $article->tags()->sync($request->tags);
            } else {
                $article->tags()->detach();
            }

            $message = Auth::user()->isAdmin()
                ? 'Article updated successfully!'
                : 'Article updated successfully! It will be reviewed before publication.';

            return redirect()->route(Auth::user()->isAdmin() ? 'admin.articles.index' : 'dashboard.articles')
                ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating article: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        // Check if user is authorized to delete
        if (Auth::id() != $article->user_id && !Auth::user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Delete image if exists
            if ($article->gambar) {
                Storage::delete($article->gambar);
            }

            $article->delete();

            return redirect()->back()->with('success', 'Article deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting article: ' . $e->getMessage());
        }
    }

/**
 * Search for articles based on query and optional category filter
 */
public function search(Request $request)
{
    $query = $request->input('query');
    $categoryId = $request->input('category');
    $categoryName = null;

    // Start with a base query - FIXED to use status='published'
    $articlesQuery = Article::where('status', 'published')
                          ->where(function($q) use ($query) {
                              $q->where('judul', 'like', "%{$query}%")
                                ->orWhere('konten_isi_artikel', 'like', "%{$query}%");
                          })
                          ->with(['user', 'category', 'tags', 'reactions']);

    // Apply category filter if provided
    if ($categoryId) {
        $articlesQuery->where('category_id', $categoryId);
        $categoryName = Category::find($categoryId)->nama_category ?? null;
    }

    // Get paginated results
    $articles = $articlesQuery->latest('tgl_upload')->paginate(12);

    // Get categories for the filter dropdown
    $categories = Category::orderBy('nama_category')->get();

    // Get related tags based on the search query
    $searchTerm = $request->input('query');
    $relatedTags = Tag::whereHas('articles', function($q) use ($searchTerm) {
        $q->where('judul', 'like', "%{$searchTerm}%")
          ->orWhere('konten_isi_artikel', 'like', "%{$searchTerm}%");
    })
    ->take(10)
    ->get();

    return view('articles.search', compact(
        'articles',
        'categories',
        'relatedTags',
        'categoryName'
    ));
}


    /**
     * Create a unique slug
     */
    private function createUniqueSlug($slug, $ignoreId = null)
    {
        $originalSlug = $slug;
        $count = 1;

        // Check if the slug exists
        while (true) {
            // If we're updating an article, ignore its ID
            $query = Article::where('slug', $slug);
            if ($ignoreId) {
                $query->where('article_id', '!=', $ignoreId);
            }

            $exists = $query->exists();

            if (!$exists) {
                break;
            }

            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
