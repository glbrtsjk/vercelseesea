<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Funfact;
use App\Models\Category;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FunfactController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        // Only index and show are accessible without auth
        $this->middleware('auth')->except(['index', 'show']);
        // Only admin can create, edit, delete
        $this->middleware('is.admin')->except(['index', 'show']);
    }

    /**
     * Display a listing of funfacts.
     * Shows random funfacts by default or search results.
     */
    public function index(Request $request)
    {
        // Get categories for filtering
        $categories = Category::orderBy('nama_kategori')->get();

        // Build the query for funfacts with eager loading of articles
        $query = Funfact::with('article.category');

        // Filter by search keyword
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->search($keyword);
        }

        // Filter by article category
        if ($request->filled('category')) {
            $categoryId = $request->category;
            $query->whereHas('article', function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        // Filter by article
        if ($request->filled('article')) {
            $articleId = $request->article;
            $query->byArticle($articleId);
        }

        // If there are any filters, show latest. Otherwise, show random
        if ($request->filled('keyword') || $request->filled('category') || $request->filled('article')) {
            $funfacts = $query->latest()->paginate(12)->withQueryString();
        } else {
            // For first page, include some highlighted funfacts if any
            if ($request->page === null || $request->page == 1) {
                $highlighted = Funfact::where('is_highlighted', true)
                    ->with('article.category')
                    ->take(3)
                    ->get();

                // If we have highlighted funfacts, exclude them from random selection
                if ($highlighted->count() > 0) {
                    $highlightedIds = $highlighted->pluck('funfact_id');
                    $randomFunfacts = Funfact::with('article.category')
                        ->whereNotIn('funfact_id', $highlightedIds)
                        ->inRandomOrder()
                        ->paginate(9)
                        ->withQueryString();

                    // Merge collections
                    $mergedCollection = $highlighted->concat($randomFunfacts);

                    // Create a new paginator with merged results
                    $funfacts = new \Illuminate\Pagination\LengthAwarePaginator(
                        $mergedCollection,
                        $randomFunfacts->total() + $highlighted->count(),
                        $randomFunfacts->perPage(),
                        $randomFunfacts->currentPage(),
                        ['path' => $request->url(), 'query' => $request->query()]
                    );
                } else {
                    $funfacts = $query->inRandomOrder()->paginate(12)->withQueryString();
                }
            } else {
                $funfacts = $query->inRandomOrder()->paginate(12)->withQueryString();
            }
        }

        // Related articles for filtering dropdown (limit to popular or recent)
        $relatedArticles = Article::where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get(['article_id', 'judul']);

        return view('funfacts.index', compact('funfacts', 'categories', 'relatedArticles'));
    }

    /**
     * Show the form for creating a new funfact.
     */
    public function create()
    {
        $articles = Article::where('is_approved', true)
            ->orderBy('judul', 'asc')
            ->get();

        return view('funfacts.create', compact('articles'));
    }

    /**
     * Store a newly created funfact in storage.
     */
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan_animasi' => 'required|integer|min:1',
            'article_id' => 'nullable|exists:articles,article_id',
            'is_highlighted' => 'nullable|boolean'
        ]);

        // Process image if uploaded
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'funfacts');
        }

        // Create funfact
        Funfact::create([
            'judul' => $request->judul,
            'deskripsi_id' => $request->deskripsi_id,
            'deskripsi_en' => $request->deskripsi_en,
            'gambar' => $imagePath,
            'urutan_animasi' => $request->urutan_animasi,
            'article_id' => $request->article_id,
            'is_highlighted' => $request->has('is_highlighted')
        ]);

        return redirect()->route('funfacts.index')
            ->with('success', 'Funfact created successfully');
    }

    /**
     * Display the specified funfact.
     */
    public function show(Funfact $funfact)
    {
        // Get related funfacts (same article or random if no article)
        if ($funfact->article_id) {
            $relatedFunfacts = Funfact::where('article_id', $funfact->article_id)
                ->where('funfact_id', '!=', $funfact->funfact_id)
                ->take(4)
                ->get();

            // If not enough related funfacts, add random ones
            if ($relatedFunfacts->count() < 4) {
                $additionalCount = 4 - $relatedFunfacts->count();
                $excludeIds = $relatedFunfacts->pluck('funfact_id')->push($funfact->funfact_id)->toArray();

                $additionalFunfacts = Funfact::whereNotIn('funfact_id', $excludeIds)
                    ->inRandomOrder()
                    ->take($additionalCount)
                    ->get();

                $relatedFunfacts = $relatedFunfacts->concat($additionalFunfacts);
            }
        } else {
            $relatedFunfacts = Funfact::where('funfact_id', '!=', $funfact->funfact_id)
                ->inRandomOrder()
                ->take(4)
                ->get();
        }

        return view('funfacts.show', compact('funfact', 'relatedFunfacts'));
    }

    /**
     * Show the form for editing the specified funfact.
     */
    public function edit(Funfact $funfact)
    {
        $articles = Article::where('is_approved', true)
            ->orderBy('judul', 'asc')
            ->get();

        return view('funfacts.edit', compact('funfact', 'articles'));
    }

    /**
     * Update the specified funfact in storage.
     */
    public function update(Request $request, Funfact $funfact)
    {
        // Validate request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_id' => 'required|string',
            'deskripsi_en' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan_animasi' => 'required|integer|min:1',
            'article_id' => 'nullable|exists:articles,article_id',
            'is_highlighted' => 'nullable|boolean'
        ]);

        // Process image if uploaded
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($funfact->gambar) {
                Storage::delete($funfact->gambar);
            }
            $funfact->gambar = $this->fileUploadService->uploadFile($request->file('gambar'), 'funfacts');
        }

        // Update funfact details
        $funfact->judul = $request->judul;
        $funfact->deskripsi_id = $request->deskripsi_id;
        $funfact->deskripsi_en = $request->deskripsi_en;
        $funfact->urutan_animasi = $request->urutan_animasi;
        $funfact->article_id = $request->article_id;
        $funfact->is_highlighted = $request->has('is_highlighted');
        $funfact->save();

        return redirect()->route('funfacts.index')
            ->with('success', 'Funfact updated successfully');
    }

    /**
     * Remove the specified funfact from storage.
     */
    public function destroy(Funfact $funfact)
    {
        // Delete image if exists
        if ($funfact->gambar) {
            Storage::delete($funfact->gambar);
        }

        $funfact->delete();

        return redirect()->route('funfacts.index')
            ->with('success', 'Funfact deleted successfully');
    }

    /**
     * Update the animation order of funfacts.
     * Using standard form submission instead of AJAX
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'funfact' => 'required|array',
            'funfact.*.id' => 'required|exists:funfacts,funfact_id',
            'funfact.*.order' => 'required|integer|min:1'
        ]);

        // Begin transaction to ensure all updates succeed or none
        \DB::beginTransaction();

        try {
            foreach ($request->funfact as $item) {
                Funfact::where('funfact_id', $item['id'])
                    ->update(['urutan_animasi' => $item['order']]);
            }

            \DB::commit();

            return redirect()->back()->with('success', 'Funfact order updated successfully');
        } catch (\Exception $e) {
            \DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update funfact order: ' . $e->getMessage());
        }
    }

    /**
     * Toggle the highlighted status of a funfact
     */
    public function toggleHighlight(Funfact $funfact)
    {
        $funfact->is_highlighted = !$funfact->is_highlighted;
        $funfact->save();

        $status = $funfact->is_highlighted ? 'highlighted' : 'removed from highlights';

        return redirect()->back()->with('success', "Funfact {$status} successfully");
    }
}
