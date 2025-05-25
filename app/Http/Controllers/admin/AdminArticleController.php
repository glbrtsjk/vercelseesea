<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminArticleController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Article::query()->with(['user', 'category']);

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category if provided
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten_isi_artikel', 'like', "%{$search}%");
            });
        }

        // Sort options
        $sort = $request->sort ?? 'newest';
        switch ($sort) {
            case 'oldest':
                $query->oldest('tgl_upload');
                break;
            case 'reactions':
                $query->withCount('reactions')->orderBy('reactions_count', 'desc');
                break;
            case 'title':
                $query->orderBy('judul', 'asc');
                break;
            default:
                $query->latest('tgl_upload');
        }

        $articles = $query->paginate(10);
        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten_isi_artikel' => 'required',
            'category_id' => 'required|exists:categories,category_id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,tag_id',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,pending,published'
        ]);

        try {
            // Generate slug
            $slug = Str::slug($request->judul);
            $uniqueSlug = $this->createUniqueSlug($slug);

            // Process image if uploaded
            $imagePath = null;
            if ($request->hasFile('gambar')) {
                $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'articles');
            }

            // Create article
            $article = Article::create([
                'judul' => $request->judul,
                'slug' => $uniqueSlug,
                'konten_isi_artikel' => $request->konten_isi_artikel,
                'tgl_upload' => now(),
                'category_id' => $request->category_id,
                'user_id' => Auth::id(),
                'gambar' => $imagePath,
                'status' => $request->status,
                'is_featured' => $request->has('is_featured'),
            ]);

            // If published directly, set approval details
            if ($request->status == 'published') {
                $article->approved_by = Auth::id();
                $article->approved_at = now();
                $article->save();
            }

            // Attach tags if any
            if ($request->has('tags')) {
                $article->tags()->attach($request->tags);
            }

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating article: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $article->load(['user', 'category', 'tags', 'comments.user']);

        return view('admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $article->tags->pluck('tag_id')->toArray();

        return view('admin.articles.edit', compact('article', 'categories', 'tags', 'selectedTags'));
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten_isi_artikel' => 'required',
            'category_id' => 'required|exists:categories,category_id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,tag_id',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,pending,published'
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
            $article->is_featured = $request->has('is_featured');

            // Handle status change
            $oldStatus = $article->status;
            $newStatus = $request->status;

            if ($oldStatus != $newStatus && $newStatus == 'published') {
                // If changing to published, set approval details
                $article->approved_by = Auth::id();
                $article->approved_at = now();
            }

            $article->status = $newStatus;
            $article->save();

            // Sync tags
            if ($request->has('tags')) {
                $article->tags()->sync($request->tags);
            } else {
                $article->tags()->detach();
            }

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating article: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified article from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            // Delete image if exists
            if ($article->gambar) {
                Storage::delete($article->gambar);
            }

            // Delete the article
            $article->delete();

            return redirect()->route('admin.articles.index')
                ->with('success', 'Article deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting article: ' . $e->getMessage());
        }
    }

    public function pending()
{
    $articles = Article::where('status', 'pending')
        ->with(['user', 'category'])
        ->orderBy('tgl_upload', 'asc')  // Oldest first
        ->paginate(15);

    return view('admin.articles.pending', compact('articles'));
}

/**
 * Approve an article
 *
 * @param Article $article
 * @return \Illuminate\Http\Response
 */
public function approve(Article $article)
{
    $article->status = 'published';
    $article->approved_by = Auth::id();
    $article->approved_at = now();
    $article->save();

    // Send notification to the author (you can implement this later)

    return redirect()->back()->with('success', 'Article has been approved successfully!');
}

/**
 * Reject an article with feedback
 *
 * @param Request $request
 * @param Article $article
 * @return \Illuminate\Http\Response
 */
public function reject(Request $request, Article $article)
{
    $request->validate([
        'rejection_reason' => 'required|string|min:10',
    ]);

    $article->status = 'rejected';
    $article->rejection_reason = $request->rejection_reason;
    $article->save();

    // Send notification to the author (you can implement this later)

    return redirect()->back()->with('success', 'Article has been rejected successfully!');
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
