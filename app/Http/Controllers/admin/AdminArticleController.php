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
     * Menampilkan daftar artikel.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Article::query()->with(['user', 'category']);

        // Filter berdasarkan status jika disediakan
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori jika disediakan
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Fungsi pencarian
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten_isi_artikel', 'like', "%{$search}%");
            });
        }

        // Opsi pengurutan
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
     * Menampilkan formulir untuk membuat artikel baru.
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
     * Menyimpan artikel yang baru dibuat ke dalam penyimpanan.
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
            // Menghasilkan slug
            $slug = Str::slug($request->judul);
            $uniqueSlug = $this->createUniqueSlug($slug);

            // Memproses gambar jika diunggah
            $imagePath = null;
            if ($request->hasFile('gambar')) {
                $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'articles');
            }

            // Membuat artikel
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

            // Jika langsung dipublikasikan, tetapkan detail persetujuan
            if ($request->status == 'published') {
                $article->approved_by = Auth::id();
                $article->approved_at = now();
                $article->save();
            }

            // Melampirkan tag jika ada
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
     * Menampilkan artikel yang ditentukan.
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
     * Menampilkan formulir untuk mengedit artikel yang ditentukan.
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
     * Memperbarui artikel yang ditentukan dalam penyimpanan.
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
            // Memperbarui slug jika judul berubah
            if ($article->judul !== $request->judul) {
                $slug = Str::slug($request->judul);
                $uniqueSlug = $this->createUniqueSlug($slug, $article->article_id);
                $article->slug = $uniqueSlug;
            }

            // Memproses gambar jika yang baru diunggah
            if ($request->hasFile('gambar')) {
                // Menghapus gambar lama jika ada
                if ($article->gambar) {
                    Storage::delete($article->gambar);
                }
                $article->gambar = $this->fileUploadService->uploadFile($request->file('gambar'), 'articles');
            }

            // Memperbarui detail artikel
            $article->judul = $request->judul;
            $article->konten_isi_artikel = $request->konten_isi_artikel;
            $article->category_id = $request->category_id;
            $article->is_featured = $request->has('is_featured');

            // Menangani perubahan status
            $oldStatus = $article->status;
            $newStatus = $request->status;

            if ($oldStatus != $newStatus && $newStatus == 'published') {
                // Jika berubah menjadi diterbitkan, tetapkan detail persetujuan
                $article->approved_by = Auth::id();
                $article->approved_at = now();
            }

            $article->status = $newStatus;
            $article->save();

            // Menyinkronkan tag
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
     * Menghapus artikel yang ditentukan dari penyimpanan.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            // Menghapus gambar jika ada
            if ($article->gambar) {
                Storage::delete($article->gambar);
            }

            // Menghapus artikel
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
        ->orderBy('tgl_upload', 'asc')  // Yang terlama dulu
        ->paginate(15);

    return view('admin.articles.pending', compact('articles'));
}

/**
 * Menyetujui artikel
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

    // Mengirim notifikasi kepada penulis (Anda bisa mengimplementasikan ini nanti)

    return redirect()->back()->with('success', 'Article telah berhasil disetujui!');
}

/**
 * Menolak artikel dengan umpan balik
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



    return redirect()->back()->with('success', 'Article telah berhasil ditolak!');
}

    /**
     * Membuat slug yang unik
     */
    private function createUniqueSlug($slug, $ignoreId = null)
    {
        $originalSlug = $slug;
        $count = 1;

        // Memeriksa apakah slug sudah ada
        while (true) {
            // Jika kita sedang memperbarui artikel, abaikan ID-nya
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
