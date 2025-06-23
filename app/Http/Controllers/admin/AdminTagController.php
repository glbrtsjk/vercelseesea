<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Menampilkan daftar tag.
     */
    public function index(Request $request)
    {
        $query = Tag::query()->withCount('articles');

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

        $tags = $query->paginate(20);

        return view('admin.dashboard.tag', compact('tags'));
    }

    /**
     * Menampilkan form untuk membuat tag baru.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Menyimpan tag baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:50|unique:tags,nama_tag',
            'deskripsi' => 'nullable|string|max:500'
        ]);

        $slug = Str::slug($request->nama_tag);

        // Memeriksa apakah slug sudah ada
        $count = 0;
        $originalSlug = $slug;
        while (Tag::where('slug', $slug)->exists()) {
            $count++;
            $slug = $originalSlug . '-' . $count;
        }

        Tag::create([
            'nama_tag' => $request->nama_tag,
            'slug' => $slug,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil dibuat.');
    }

    /**
     * Menampilkan form untuk mengedit tag tertentu.
     */
    public function edit(Tag $tag)
    {
       $tag->loadCount(['articles', 'users']);
    return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Memperbarui tag tertentu dalam penyimpanan.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:50|unique:tags,nama_tag,' . $tag->tag_id . ',tag_id',
            'deskripsi' => 'nullable|string|max:500'
        ]);

        // Hanya memperbarui slug jika nama telah berubah
        if ($tag->nama_tag != $request->nama_tag) {
            $slug = Str::slug($request->nama_tag);

            // Memeriksa apakah slug sudah ada
            $count = 0;
            $originalSlug = $slug;
            while (Tag::where('slug', $slug)->where('tag_id', '!=', $tag->tag_id)->exists()) {
                $count++;
                $slug = $originalSlug . '-' . $count;
            }

            $tag->slug = $slug;
        }

        $tag->nama_tag = $request->nama_tag;
        $tag->deskripsi = $request->deskripsi;
        $tag->save();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil diperbarui.');
    }

    /**
     * Menghapus tag tertentu dari penyimpanan.
     */
    public function destroy(Tag $tag)
    {
        // Kami akan menangani tag dengan artikel - cukup lepaskan hubungannya sebelum menghapus
        // Ini akan mempertahankan artikel tetapi menghapus asosiasi tag
        $articleCount = $tag->articles()->count();
        $userCount = $tag->users()->count();

        if ($articleCount > 0) {
            // Melepaskan semua hubungan artikel
            $tag->articles()->detach();
        }

        if ($userCount > 0) {
            // Melepaskan semua hubungan pengguna
            $tag->users()->detach();
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag berhasil dihapus. Tag telah dihapus dari ' . $articleCount . ' artikel dan ' . $userCount . ' langganan pengguna.');
    }

    /**
     * Menggabungkan tag sumber ke dalam tag target
     */
    public function merge(Request $request)
    {
        $request->validate([
            'source_tag_id' => 'required|exists:tags,tag_id',
            'target_tag_id' => 'required|exists:tags,tag_id|different:source_tag_id'
        ]);

        $sourceTag = Tag::findOrFail($request->source_tag_id);
        $targetTag = Tag::findOrFail($request->target_tag_id);

        $articleIds = $sourceTag->articles()->pluck('articles.article_id')->toArray();

        $targetTag->articles()->syncWithoutDetaching($articleIds);


        $userIds = $sourceTag->users()->pluck('users.user_id')->toArray();

        $targetTag->users()->syncWithoutDetaching($userIds);


        $articleCount = count($articleIds);
        $userCount = count($userIds);
        $sourceTag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', "Tag '{$sourceTag->nama_tag}' telah digabungkan ke '{$targetTag->nama_tag}'. Memindahkan {$articleCount} artikel dan {$userCount} langganan pengguna.");
    }
}