<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Message;
use App\Models\BannedUser;
use App\Models\MutedUser;
use App\Models\CommunityLock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\FileUploadService;

class AdminCommunityController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of communities.
     */
    public function index()
    {
        $communities = Community::withCount('users')
            ->latest()
            ->paginate(15);

        return view('admin.community.index', compact('communities'));
    }

    /**
     * Show the form for creating a new community.
     */
    public function create()
    {
        return view('admin.community.create');
    }

    /**
     * Store a newly created community in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_komunitas' => 'required|string|max:255|unique:communities,nama_komunitas',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'communities');
        }

        $slug = Str::slug($request->nama_komunitas);
        $uniqueSlug = $this->createUniqueSlug($slug);

        $community = Community::create([
            'nama_komunitas' => $request->nama_komunitas,
            'slug' => $uniqueSlug,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imagePath,
            'created_by' => Auth::id(),

        ]);

        return redirect()->route('admin.communities.index')
            ->with('success', 'Community created successfully');
    }

    /**
     * Display the specified community.
     */
    public function show(Community $community)
    {
        $community->load(['users', 'messages']);

        return view('admin.community.show', compact('community'));
    }

    /**
     * Show community chat.
     */


    /**
     * Show the form for editing the specified community.
     */
    public function edit(Community $community)
    {
        return view('admin.community.edit', compact('community'));
    }

    /**
     * Update the specified community in storage.
     */
    public function update(Request $request, Community $community)
    {
        $request->validate([
            'nama_komunitas' => 'required|string|max:255|unique:communities,nama_komunitas,' . $community->community_id . ',community_id',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($community->nama_komunitas !== $request->nama_komunitas) {
            $slug = Str::slug($request->nama_komunitas);
            $uniqueSlug = $this->createUniqueSlug($slug, $community->community_id);
            $community->slug = $uniqueSlug;
        }

        if ($request->hasFile('gambar')) {
            if ($community->gambar) {
                Storage::delete($community->gambar);
            }
            $community->gambar = $this->fileUploadService->uploadFile($request->file('gambar'), 'communities');
        }

        $community->nama_komunitas = $request->nama_komunitas;
        $community->deskripsi = $request->deskripsi;
        $community->save();

        return redirect()->route('admin.communities.index')
            ->with('success', 'Community updated successfully');
    }

    /**
     * Remove the specified community from storage.
     */
    public function destroy(Community $community)
    {
        if ($community->gambar) {
            Storage::delete($community->gambar);
        }

        $community->delete();

        return redirect()->route('admin.communities.index')
            ->with('success', 'Community deleted successfully');
    }

    /**
     * Show moderation dashboard for a community
     */
}
    