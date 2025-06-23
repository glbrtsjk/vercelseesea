<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search', 'cloud', 'getPopular']);
    }

    /**
     * Menampilkan daftar semua tag.
     */
     public function index(Request $request)
    {
        $query = Tag::query()->withCount('articles');
        $isAdmin = Auth::check() && Auth::user()->isAdmin();

        // Menangani filter dan pencarian khusus admin
        if ($isAdmin) {
            // Menangani pencarian
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('nama_tag', 'LIKE', "%{$search}%")
                     ->orWhere('deskripsi', 'LIKE', "%{$search}%");
            }

            // Menangani pengurutan
            $sort = $request->sort ?? 'name';

            switch ($sort) {
                case 'name_desc':
                    $query->orderBy('nama_tag', 'desc');
                    break;
                case 'articles':
                    $query->orderBy('articles_count', 'desc');
                    break;
                case 'created':
                    $query->orderBy('created_at', 'desc');
                    break;
                default:
                    $query->orderBy('nama_tag', 'asc');
            }
        } else {
            // Pengurutan default untuk pengguna biasa
            $query->orderBy('nama_tag');
        }

        // Menggunakan ukuran paginasi berbeda tergantung jenis pengguna
        $perPage = $isAdmin ? 20 : 32;
        $tags = $query->paginate($perPage);

        return view('tag.index', compact('tags', 'isAdmin'));
    }


    /**
     * Menampilkan tag tertentu dan artikelnya.
     */
    public function show(Tag $tag)
    {
        $tag->loadCount('articles');

        $articles = Article::whereHas('tags', function($query) use ($tag) {
                $query->where('tags.tag_id', $tag->tag_id);
            })
            ->where('status', 'published')
            ->with(['user', 'category', 'tags'])
            ->orderBy('tgl_upload', 'desc')
            ->paginate(12);

        return view('tag.show', compact('tag', 'articles'));
    }

    /**
     * Mencari tag berdasarkan nama
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $tags = Tag::where('nama_tag', 'LIKE', "%{$query}%")
            ->orWhere('deskripsi', 'LIKE', "%{$query}%")
            ->withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->paginate(20);

        return view('tag.search', compact('tags', 'query'));
    }

public function getPopular(Request $request)
{
    $limit = $request->input('limit', 10);
    $tags = Tag::withCount('articles')
        ->having('articles_count', '>', 0)
        ->orderBy('articles_count', 'desc')
        ->limit($limit)
        ->get();

    return view('tag.popular', compact('tags'));
}

    /**
     * Menampilkan visualisasi awan tag
     */
    public function cloud()
    {
        $tags = Tag::withCount('articles')
            ->having('articles_count', '>', 0)
            ->orderBy('articles_count', 'desc')
            ->limit(100)
            ->get();

        return view('tag.cloudtag', compact('tags'));
    }

    /**
     * Mengikuti tag oleh pengguna saat ini
     */
    public function follow(Tag $tag)
    {
        Auth::user()->tags()->attach($tag->tag_id);
        return redirect()->back()->with('success', "Anda sekarang mengikuti tag: {$tag->nama_tag}");
    }

    /**
     * Berhenti mengikuti tag oleh pengguna saat ini
     */
    public function unfollow(Tag $tag)
    {
        Auth::user()->tags()->detach($tag->tag_id);
        return redirect()->back()->with('success', "Anda telah berhenti mengikuti tag: {$tag->nama_tag}");
    }

    /**
     * Menyarankan tag berdasarkan konten artikel untuk penandaan otomatis
     */
    public function suggestTags(Request $request)
    {
        $content = $request->input('content');
        $title = $request->input('title');

        if (empty($content) && empty($title)) {
            return redirect()->back();
        }

        // Mendapatkan semua tag yang ada
        $allTags = Tag::all()->pluck('nama_tag')->toArray();

        // Menggabungkan judul dan konten
        $text = $title . ' ' . $content;

        // Pendekatan sederhana: memeriksa apakah nama tag muncul dalam teks
        $suggestions = [];
        foreach ($allTags as $tag) {
            // Lewati tag yang sangat pendek untuk mencegah hasil positif palsu
            if (strlen($tag) < 3) {
                continue;
            }

            // Pencarian tidak peka huruf besar/kecil
            if (stripos($text, $tag) !== false) {
                $suggestions[] = $tag;
            }
        }

        // Batasi hingga 10 saran
        $suggestions = array_slice($suggestions, 0, 10);

        return view('tag.suggesttag', compact('suggestions', 'title', 'content'));
    }
}