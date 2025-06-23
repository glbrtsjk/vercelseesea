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
        // Hanya index dan show yang dapat diakses tanpa autentikasi
        $this->middleware('auth')->except(['index', 'show']);
        // Hanya admin yang dapat membuat, mengedit, dan menghapus
        $this->middleware('isadmin')->except(['index', 'show']);
    }

    /**
     * Menampilkan daftar fakta menarik.
     * Menampilkan fakta menarik secara acak secara default atau hasil pencarian.
     */
    public function index(Request $request)
    {
        // Mendapatkan kategori untuk filter
        $categories = Category::orderBy('nama_kategori')->get();

        // Membangun query untuk fakta menarik dengan eager loading dari artikel
        $query = Funfact::with('article.category');

        // Filter berdasarkan kata kunci pencarian
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->search($keyword);
        }

        // Filter berdasarkan kategori artikel
        if ($request->filled('category')) {
            $categoryId = $request->category;
            $query->whereHas('article', function($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });
        }

        // Filter berdasarkan artikel
        if ($request->filled('article')) {
            $articleId = $request->article;
            $query->byArticle($articleId);
        }

        // Jika ada filter, tampilkan terbaru. Jika tidak, tampilkan secara acak
        if ($request->filled('keyword') || $request->filled('category') || $request->filled('article')) {
            $funfacts = $query->latest()->paginate(12)->withQueryString();
        } else {
            // Untuk halaman pertama, sertakan beberapa fakta menarik yang disorot jika ada
            if ($request->page === null || $request->page == 1) {
                $highlighted = Funfact::where('is_highlighted', true)
                    ->with('article.category')
                    ->take(3)
                    ->get();

                // Jika kita memiliki fakta menarik yang disorot, kecualikan dari pemilihan acak
                if ($highlighted->count() > 0) {
                    $highlightedIds = $highlighted->pluck('funfact_id');
                    $randomFunfacts = Funfact::with('article.category')
                        ->whereNotIn('funfact_id', $highlightedIds)
                        ->inRandomOrder()
                        ->paginate(9)
                        ->withQueryString();

                    // Menggabungkan koleksi
                    $mergedCollection = $highlighted->concat($randomFunfacts);

                    // Membuat paginator baru dengan hasil gabungan
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

        // Artikel terkait untuk dropdown filter (batasi ke yang populer atau terbaru)
        $relatedArticles = Article::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get(['article_id', 'judul']);

        return view('admin.funfact.index', compact('funfacts', 'categories', 'relatedArticles'));
    }

    /**
     * Menampilkan formulir untuk membuat fakta menarik baru.
     */
    public function create()
    {
        $articles = Article::where('status', 'published')
            ->orderBy('judul', 'asc')
            ->get();
        $nextOrder = Funfact::max('urutan_animasi') + 1;

        $tags = \App\Models\Tag::orderBy('nama_tag')->get();

        return view('admin.funfact.create', compact('articles', 'nextOrder', 'tags'));
    }

    /**
     * Menyimpan fakta menarik baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        // Memvalidasi data permintaan
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan_animasi' => 'required|integer|min:1',
            'article_id' => 'nullable|exists:articles,article_id',
            'is_highlighted' => 'nullable|boolean'
        ]);

        // Memproses gambar jika diunggah
        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'funfacts');
        }

        // Membuat fakta menarik
        Funfact::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imagePath,
            'urutan_animasi' => $request->urutan_animasi,
            'article_id' => $request->article_id,
            'is_highlighted' => $request->has('is_highlighted')
        ]);

        return redirect()->route('admin.dashboard.funfacts')
            ->with('success', 'Fakta menarik berhasil dibuat');
    }

    /**
     * Menampilkan fakta menarik tertentu.
     */
    public function show(Funfact $funfact)
    {
        // Mendapatkan fakta menarik terkait (artikel yang sama atau acak jika tidak ada artikel)
        if ($funfact->article_id) {
            $relatedFunfacts = Funfact::where('article_id', $funfact->article_id)
                ->where('funfact_id', '!=', $funfact->funfact_id)
                ->take(4)
                ->get();

            // Jika tidak cukup fakta menarik terkait, tambahkan yang acak
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
        $nextOrder = Funfact::max('urutan_animasi') + 1;

        return view('admin.funfact.show', compact('funfact', 'relatedFunfacts', 'nextOrder'));
    }

    /**
     * Menampilkan formulir untuk mengedit fakta menarik tertentu.
     */
    public function edit(Funfact $funfact)
    {
        $articles = Article::where('status', 'published')
            ->orderBy('judul', 'asc')
            ->get();

        return view('admin.funfact.edit', compact('funfact', 'articles'));
    }

    /**
     * Memperbarui fakta menarik tertentu di dalam penyimpanan.
     */
    public function update(Request $request, Funfact $funfact)
    {
        // Memvalidasi data permintaan
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan_animasi' => 'required|integer|min:1',
            'article_id' => 'nullable|exists:articles,article_id',
            'is_highlighted' => 'nullable|boolean'
        ]);

        // Memproses gambar jika diunggah
        if ($request->hasFile('gambar')) {
            // Menghapus gambar lama jika ada
            if ($funfact->gambar) {
                Storage::delete($funfact->gambar);
            }
            $funfact->gambar = $this->fileUploadService->uploadFile($request->file('gambar'), 'funfacts');
        }

        // Memperbarui detail fakta menarik
        $funfact->judul = $request->judul;
        $funfact->deskripsi = $request->deskripsi;
        $funfact->urutan_animasi = $request->urutan_animasi;
        $funfact->article_id = $request->article_id;
        $funfact->is_highlighted = $request->has('is_highlighted');
        $funfact->save();

        return redirect()->route('admin.dashboard.funfacts')
            ->with('success', 'Fakta menarik berhasil diperbarui');
    }

    /**
     * Menghapus fakta menarik tertentu dari penyimpanan.
     */
    public function destroy(Funfact $funfact)
    {
        // Menghapus gambar jika ada
        if ($funfact->gambar) {
            Storage::delete($funfact->gambar);
        }

        $funfact->delete();

        return redirect()->route('admin.dashboard.funfacts')
            ->with('success', 'Fakta menarik berhasil dihapus');
    }

    /**
     * Memperbarui urutan animasi fakta menarik.
     * Menggunakan pengiriman form standar alih-alih AJAX
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'funfact' => 'required|array',
            'funfact.*.id' => 'required|exists:funfacts,funfact_id',
            'funfact.*.order' => 'required|integer|min:1'
        ]);

        // Memulai transaksi untuk memastikan semua pembaruan berhasil atau tidak sama sekali
        \DB::beginTransaction();

        try {
            foreach ($request->funfact as $item) {
                Funfact::where('funfact_id', $item['id'])
                    ->update(['urutan_animasi' => $item['order']]);
            }

            \DB::commit();

            return redirect()->back()->with('success', 'Urutan fakta menarik berhasil diperbarui');
        } catch (\Exception $e) {
            \DB::rollBack();

            return redirect()->back()->with('error', 'Gagal memperbarui urutan fakta menarik: ' . $e->getMessage());
        }
    }

    /**
     * Mengubah status sorotan sebuah fakta menarik
     */
    public function toggleHighlight(Funfact $funfact)
    {
        $funfact->is_highlighted = !$funfact->is_highlighted;
        $funfact->save();

        $status = $funfact->is_highlighted ? 'disorot' : 'dihapus dari sorotan';

        return redirect()->back()->with('success', "Fakta menarik berhasil {$status}");
    }
}