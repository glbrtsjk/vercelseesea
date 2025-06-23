<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Community;
use App\Models\Message;
use App\Models\CommunityEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
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
        $this->middleware('checkban')->except(['index', 'show', 'search']);
    }

    /**
     * Menampilkan daftar artikel.
     */
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
            ->with(['user', 'category']);

        // Menambahkan relasi tags hanya jika tabel pivot ada
        try {
            // Memeriksa apakah tabel article_tag_pivot ada
            if (DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                $query->with('tags');
            }
        } catch (\Exception $e) {
            // Jika terjadi error saat memeriksa tabel, lanjutkan tanpa tags
        }

        // Menambahkan relasi reactions hanya jika tabel ada
        try {
            if (DB::getSchemaBuilder()->hasTable('reactions')) {
                $query->with('reactions');
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa reactions jika tabel tidak ada
        }

        // Filter berdasarkan kategori jika disediakan
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter berdasarkan tag jika disediakan dan tabel pivot ada
        if ($request->has('tag') && $request->tag) {
            try {
                if (DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                    $query->whereHas('tags', function($q) use($request) {
                        $q->where('tags.tag_id', $request->tag);
                    });
                }
            } catch (\Exception $e) {
                // Lewati filter tag jika ada error
            }
        }

        // Mendapatkan artikel yang diurutkan berdasarkan tanggal unggah
        $articles = $query->orderBy('tgl_upload', 'desc')->paginate(12);

        // Mendapatkan kategori dengan aman
        $categories = Category::all();

        // Mendapatkan tag populer dengan aman
        $tags = collect(); // Koleksi kosong default
        try {
            if (DB::getSchemaBuilder()->hasTable('tags') && DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                $tags = Tag::select('tags.*')
                    ->join('article_tag_pivot', 'tags.tag_id', '=', 'article_tag_pivot.tag_id')
                    ->groupBy('tags.tag_id', 'tags.nama_tag', 'tags.created_at', 'tags.updated_at')
                    ->orderByRaw('COUNT(article_tag_pivot.article_id) DESC')
                    ->take(10)
                    ->get();
            }
        } catch (\Exception $e) {
            // Lanjutkan dengan koleksi tag kosong
            $tags = collect();
        }

        // Mendapatkan artikel unggulan dengan aman
        $featuredArticle = null;
        try {
            $featuredArticle = Article::where('status', 'published')
                ->where('is_featured', true)
                ->with(['user', 'category'])
                ->first();

            // Jika tidak ada artikel unggulan, ambil artikel terbaru
            if (!$featuredArticle) {
                $featuredArticle = Article::where('status', 'published')
                    ->with(['user', 'category'])
                    ->latest('tgl_upload')
                    ->first();
            }

            // Memuat tags dan reactions dengan aman untuk artikel unggulan
            if ($featuredArticle) {
                try {
                    if (DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                        $featuredArticle->load('tags');
                    }
                } catch (\Exception $e) {
                    // Lanjutkan tanpa tags
                }

                try {
                    if (DB::getSchemaBuilder()->hasTable('reactions')) {
                        $featuredArticle->load('reactions');
                    }
                } catch (\Exception $e) {
                    // Lanjutkan tanpa reactions
                }
            }
        } catch (\Exception $e) {
            $featuredArticle = null;
        }

        return view('articles.index', compact('articles', 'categories', 'tags', 'featuredArticle'));
    }

    /**
     * Menampilkan formulir untuk membuat artikel baru.
     */
    public function create()
    {
        $categories = Category::all();

        // Mendapatkan tags dengan aman
        $tags = collect();
        try {
            if (DB::getSchemaBuilder()->hasTable('tags')) {
                $tags = Tag::all();
            }
        } catch (\Exception $e) {
            $tags = collect();
        }

        return view('articles.create', compact('categories', 'tags'));
    }

    /**
     * Menyimpan artikel yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        // Validasi data request
        $validationRules = [
            'judul' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'konten_isi_artikel' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Menambahkan validasi tags hanya jika tabel tags ada
        try {
            if (DB::getSchemaBuilder()->hasTable('tags')) {
                $validationRules['tags'] = 'nullable|array';
                $validationRules['tags.*'] = 'exists:tags,tag_id';
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa validasi tags
        }

        $request->validate($validationRules);

        try {
            // Proses gambar jika diunggah
            $imagePath = null;
            if ($request->hasFile('gambar')) {
                $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'articles');
            }

            // Membuat slug dari judul
            $slug = Str::slug($request->judul);
            $uniqueSlug = $this->createUniqueSlug($slug);

            // Membuat artikel dengan status yang sesuai
            $status = (Auth::check() && Auth::user()->role === 'admin') ? 'published' : 'pending';

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

            // Sinkronisasi tags jika dipilih dan tabel pivot ada
            if ($request->has('tags') && !empty($request->tags)) {
                try {
                    if (DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                        $article->tags()->sync($request->tags);
                    }
                } catch (\Exception $e) {
                    // Lanjutkan tanpa sinkronisasi tags
                }
            }

            $message = (Auth::check() && Auth::user()->role === 'admin')
                ? 'Artikel berhasil dipublikasikan!'
                : 'Artikel berhasil dikirim! Artikel akan ditinjau oleh editor kami sebelum dipublikasikan.';

            return redirect()->route('articles.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saat membuat artikel: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan artikel tertentu.
     */
    public function show(Article $article)
    {
        // Memeriksa otorisasi
        if ($article->status !== 'published' && (!Auth::check() || (Auth::id() != $article->user_id && Auth::user()->role !== 'admin'))) {
            abort(404);
        }

        // Memuat relasi dasar
        $article->load(['user', 'category']);

        // Memuat relasi opsional dengan aman
        try {
            if (DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                $article->load('tags');
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa tags
        }

        try {
            if (DB::getSchemaBuilder()->hasTable('comments')) {
                $article->load(['comments.user']);

                // Memuat balasan komentar jika tabel ada
                if (DB::getSchemaBuilder()->hasTable('comment_replies')) {
                    $article->load(['comments.replies.user']);
                }
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa komentar
        }

        try {
            if (DB::getSchemaBuilder()->hasTable('funfacts')) {
                $article->load('funfacts');
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa funfacts
        }

        // Mendapatkan artikel terkait
        $relatedArticles = collect();
        try {
            $relatedQuery = Article::where('status', 'published')
                ->where('article_id', '!=', $article->article_id)
                ->with(['user', 'category']);

            // Menambahkan filter berdasarkan kategori atau tag
            $relatedQuery->where(function ($query) use ($article) {
                $query->where('category_id', $article->category_id);

                // Menambahkan filter berdasarkan tag jika memungkinkan
                try {
                    if (DB::getSchemaBuilder()->hasTable('article_tag_pivot') && $article->tags && $article->tags->count() > 0) {
                        $query->orWhereHas('tags', function ($q) use ($article) {
                            $q->whereIn('tags.tag_id', $article->tags->pluck('tag_id'));
                        });
                    }
                } catch (\Exception $e) {
                    // Lanjutkan hanya dengan filter kategori
                }
            });

            $relatedArticles = $relatedQuery->latest('tgl_upload')->take(5)->get();
        } catch (\Exception $e) {
            $relatedArticles = collect();
        }

      $categories = Category::withCount(['articles' => function($query) {
           $query->where('status', 'published');
          }])->get();

        // Mendapatkan tags dengan aman
        $tags = collect();
        try {
            if (DB::getSchemaBuilder()->hasTable('tags') && DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                $tags = Tag::select('tags.*')
                    ->join('article_tag_pivot', 'tags.tag_id', '=', 'article_tag_pivot.tag_id')
                    ->groupBy('tags.tag_id', 'tags.nama_tag', 'tags.created_at', 'tags.updated_at')
                    ->orderByRaw('COUNT(article_tag_pivot.article_id) DESC')
                    ->take(10)
                    ->get();
            }
        } catch (\Exception $e) {
            $tags = collect();
        }

        $currentUrl = url()->current();

        return view('articles.show ', compact(
            'article',
            'categories',
            'tags',
            'relatedArticles',
            'currentUrl'
        ));
    }

    /**
     * Menampilkan formulir untuk mengedit artikel tertentu.
     */
    public function edit(Article $article)
    {
        // Memeriksa otorisasi
        if (Auth::id() != $article->user_id && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403, 'Tindakan tidak diizinkan.');
        }

        $categories = Category::all();

        // Mendapatkan tags dengan aman
        $tags = collect();
        try {
            if (DB::getSchemaBuilder()->hasTable('tags')) {
                $tags = Tag::all();
            }
        } catch (\Exception $e) {
            $tags = collect();
        }

        return view('articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Memperbarui artikel tertentu di database.
     */
    public function update(Request $request, Article $article)
    {
        // Memeriksa otorisasi
        if (Auth::id() != $article->user_id && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403, 'Tindakan tidak diizinkan.');
        }

        // Validasi request
        $validationRules = [
            'judul' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'konten_isi_artikel' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Menambahkan validasi tags hanya jika tabel tags ada
        try {
            if (DB::getSchemaBuilder()->hasTable('tags')) {
                $validationRules['tags'] = 'nullable|array';
                $validationRules['tags.*'] = 'exists:tags,tag_id';
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa validasi tags
        }

        $request->validate($validationRules);

        try {
            // Perbarui slug jika judul berubah
            if ($article->judul !== $request->judul) {
                $slug = Str::slug($request->judul);
                $uniqueSlug = $this->createUniqueSlug($slug, $article->article_id);
                $article->slug = $uniqueSlug;
            }

            // Proses gambar jika yang baru diunggah
            if ($request->hasFile('gambar')) {
                if ($article->gambar) {
                    Storage::delete($article->gambar);
                }
                $article->gambar = $this->fileUploadService->uploadFile($request->file('gambar'), 'articles');
            }

            // Perbarui detail artikel
            $article->judul = $request->judul;
            $article->konten_isi_artikel = $request->konten_isi_artikel;
            $article->category_id = $request->category_id;

            // Menangani pembaruan status berdasarkan peran pengguna
            if (Auth::check() && Auth::user()->role === 'admin') {
                if ($request->has('status')) {
                    $article->status = $request->status;
                }
                if ($request->has('is_featured')) {
                    $article->is_featured = (bool)$request->is_featured;
                }
            } else {
                if ($article->status !== 'draft') {
                    $article->status = 'pending';
                }
            }

            $article->save();

            // Sinkronisasi tags jika tabel pivot ada
            try {
                if (DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                    if ($request->has('tags')) {
                        $article->tags()->sync($request->tags);
                    } else {
                        $article->tags()->detach();
                    }
                }
            } catch (\Exception $e) {
                // Lanjutkan tanpa sinkronisasi tags
            }

            $message = (Auth::check() && Auth::user()->role === 'admin')
                ? 'Artikel berhasil diperbarui!'
                : 'Artikel berhasil diperbarui! Artikel akan ditinjau sebelum dipublikasikan.';

            return redirect()->route('articles.index')->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saat memperbarui artikel: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menghapus artikel tertentu dari database.
     */
    public function destroy(Article $article)
    {
        // Memeriksa otorisasi
        if (Auth::id() != $article->user_id && (!Auth::check() || Auth::user()->role !== 'admin')) {
            abort(403, 'Tindakan tidak diizinkan.');
        }

        try {
            // Hapus gambar jika ada
            if ($article->gambar) {
                Storage::delete($article->gambar);
            }

            $article->delete();

            return redirect()->back()->with('success', 'Artikel berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saat menghapus artikel: ' . $e->getMessage());
        }
    }

    /**
     * Pencarian artikel berdasarkan query dan filter kategori opsional
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');
        $categoryName = null;

        // Mulai dengan query dasar
        $articlesQuery = Article::where('status', 'published')
            ->where(function($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                  ->orWhere('konten_isi_artikel', 'like', "%{$query}%");
            })
            ->with(['user', 'category']);

        // Tambahkan tags dan reactions dengan aman
        try {
            if (DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                $articlesQuery->with('tags');
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa tags
        }

        try {
            if (DB::getSchemaBuilder()->hasTable('reactions')) {
                $articlesQuery->with('reactions');
            }
        } catch (\Exception $e) {
            // Lanjutkan tanpa reactions
        }

        // Terapkan filter kategori jika disediakan
        if ($categoryId) {
            $articlesQuery->where('category_id', $categoryId);
            $category = Category::find($categoryId);
            $categoryName = $category ? $category->nama_kategori : null;
        }

        // Dapatkan hasil yang dipaginasi
        $articles = $articlesQuery->latest('tgl_upload')->paginate(12);

        // Dapatkan kategori untuk dropdown filter
        $categories = Category::orderBy('nama_kategori')->get();

        // Dapatkan tag terkait dengan aman
        $relatedTags = collect();
        try {
            if (DB::getSchemaBuilder()->hasTable('tags') && DB::getSchemaBuilder()->hasTable('article_tag_pivot')) {
                $searchTerm = $request->input('query');
                $relatedTags = Tag::whereHas('articles', function($q) use ($searchTerm) {
                    $q->where('judul', 'like', "%{$searchTerm}%")
                      ->orWhere('konten_isi_artikel', 'like', "%{$searchTerm}%");
                })
                ->take(10)
                ->get();
            }
        } catch (\Exception $e) {
            $relatedTags = collect();
        }

        return view('articles.search', compact(
            'articles',
            'categories',
            'relatedTags',
            'categoryName'
        ));
    }

    /**
     * Membuat slug unik
     */
    private function createUniqueSlug($slug, $ignoreId = null)
    {
        $originalSlug = $slug;
        $count = 1;

        while (true) {
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
