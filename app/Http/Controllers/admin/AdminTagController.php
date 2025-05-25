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
     * Display a listing of tags.
     */
    public function index(Request $request)
    {
        $query = Tag::query()->withCount('articles');

        // Handle search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_tag', 'LIKE', "%{$search}%")
                 ->orWhere('deskripsi', 'LIKE', "%{$search}%");
        }

        // Handle sorting
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

        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new tag.
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created tag in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:50|unique:tags,nama_tag',
            'deskripsi' => 'nullable|string|max:500'
        ]);

        $slug = Str::slug($request->nama_tag);

        // Check if slug exists
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
            ->with('success', 'Tag created successfully.');
    }

    /**
     * Show the form for editing the specified tag.
     */
    public function edit(Tag $tag)
    {
        $tag->loadCount(['articles', 'users']);
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified tag in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'nama_tag' => 'required|string|max:50|unique:tags,nama_tag,' . $tag->tag_id . ',tag_id',
            'deskripsi' => 'nullable|string|max:500'
        ]);

        // Only update slug if the name has changed
        if ($tag->nama_tag != $request->nama_tag) {
            $slug = Str::slug($request->nama_tag);

            // Check if slug exists
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

        return redirect()->route('admin.tags.edit', $tag)
            ->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified tag from storage.
     */
    public function destroy(Tag $tag)
    {
        // We'll handle tags with articles - just detach them before deleting
        // This will keep articles but remove the tag association
        $articleCount = $tag->articles()->count();
        $userCount = $tag->users()->count();

        if ($articleCount > 0) {
            // Detach all article relationships
            $tag->articles()->detach();
        }

        if ($userCount > 0) {
            // Detach all user relationships
            $tag->users()->detach();
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully. It has been removed from ' . $articleCount . ' articles and ' . $userCount . ' user subscriptions.');
    }

    /**
     * Merge a source tag into a target tag
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
            ->with('success', "Tag '{$sourceTag->nama_tag}' has been merged into '{$targetTag->nama_tag}'. Moved {$articleCount} articles and {$userCount} user subscriptions.");
    }
}
