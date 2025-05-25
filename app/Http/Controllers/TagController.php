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
     * Display a listing of all tags.
     */
    public function index()
    {
        $tags = Tag::withCount('articles')
            ->orderBy('nama_tag')
            ->paginate(32);

        return view('tag.index', compact('tags'));
    }

    /**
     * Display the specified tag and its articles.
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
     * Search for tags by name
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
     * Display a tag cloud visualization
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
     * Follow a tag by the current user
     */
    public function follow(Tag $tag)
    {
        Auth::user()->tags()->attach($tag->tag_id);
        return redirect()->back()->with('success', "You are now following tag: {$tag->nama_tag}");
    }

    /**
     * Unfollow a tag by the current user
     */
    public function unfollow(Tag $tag)
    {
        Auth::user()->tags()->detach($tag->tag_id);
        return redirect()->back()->with('success', "You have unfollowed tag: {$tag->nama_tag}");
    }

    /**
     * Suggest tags based on article content for auto-tagging
     */
    public function suggestTags(Request $request)
    {
        $content = $request->input('content');
        $title = $request->input('title');

        if (empty($content) && empty($title)) {
            return redirect()->back();
        }

        // Get all existing tags
        $allTags = Tag::all()->pluck('nama_tag')->toArray();

        // Combine title and content
        $text = $title . ' ' . $content;

        // Simple approach: check if tag names appear in the text
        $suggestions = [];
        foreach ($allTags as $tag) {
            // Skip very short tags to prevent false positives
            if (strlen($tag) < 3) {
                continue;
            }

            // Case-insensitive search
            if (stripos($text, $tag) !== false) {
                $suggestions[] = $tag;
            }
        }

        // Limit to 10 suggestions
        $suggestions = array_slice($suggestions, 0, 10);

        return view('tag.suggesttag', compact('suggestions', 'title', 'content'));
    }
}
