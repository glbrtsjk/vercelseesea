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

    private function createUniqueSlug($slug, $exceptId = null)
{
    $originalSlug = $slug;
    $count = 1;

    // Memeriksa apakah slug sudah ada
    $query = Community::where('slug', $slug);

    // Jika kita sedang memperbarui, kecualikan komunitas saat ini
    if ($exceptId) {
        $query->where('community_id', '!=', $exceptId);
    }

    // Jika slug sudah ada, tambahkan angka sampai kita mendapatkan slug yang unik
    while ($query->exists()) {
        $slug = $originalSlug . '-' . $count++;
        $query = Community::where('slug', $slug);
        if ($exceptId) {
            $query->where('community_id', '!=', $exceptId);
        }
    }

    return $slug;
}

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Menampilkan daftar komunitas.
     */
public function index()
{
    $communities = Community::withCount('users')
        ->latest()
        ->paginate(15);

    $initiatives = \App\Models\CommunityInitiative::with('community')
    ->inRandomOrder()
    ->take(4)
    ->get();

    return view('admin.community.index', compact('communities', 'initiatives'));
}

    /**
     * Menampilkan formulir untuk membuat komunitas baru.
     */
    public function create()
    {
        return view('admin.community.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nama_komunitas' => 'required|string|max:255|unique:communities,nama_komunitas',
        'deskripsi' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'initiatives.*.judul' => 'required|string|max:255',
        'initiatives.*.deskripsi' => 'required|string',
        'initiatives.*.icon' => 'nullable|string',
        'initiatives.*.prioritas' => 'nullable|integer',
    ]);

    $imagePath = null;
    if ($request->hasFile('gambar')) {
        $imagePath = $this->fileUploadService->uploadFile($request->file('gambar'), 'communities');
    }

    $slug = Str::slug($request->nama_komunitas);
    $uniqueSlug = $this->createUniqueSlug($slug);

    $currentUser = Auth::user();

    $community = Community::create([
        'nama_komunitas' => $request->nama_komunitas,
        'slug' => $uniqueSlug,
        'deskripsi' => $request->deskripsi,
        'gambar' => $imagePath,
        'created_by' => $currentUser->user_id,
        'is_active' => true

    ]);

        \Log::info('Komunitas dibuat: ID=' . $community->community_id . ', dibuat_oleh=' . $community->created_by);


    // Menyimpan inisiatif
    if ($request->has('initiatives')) {
        foreach ($request->initiatives as $index => $initiativeData) {
            $community->initiatives()->create([
                'judul' => $initiativeData['judul'],
                'deskripsi' => $initiativeData['deskripsi'],
                'icon' => $initiativeData['icon'] ?? 'fas fa-water',
                'urutan_prioritas' => $initiativeData['order'] ?? $index
            ]);
        }
    }

    return redirect()->route('admin.dashboard.community')
        ->with('success', 'Komunirtas Berhasil dibuat');
}

// Pada metode update:
public function update(Request $request, Community $community)
{
    $request->validate([
        'nama_komunitas' => 'required|string|max:255|unique:communities,nama_komunitas,' . $community->community_id . ',community_id',
        'deskripsi' => 'required|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'initiative.*.judul' => 'required|string|max:255',
        'initiative.*.deskripsi' => 'required|string',
        'initiative.*.icon' => 'nullable|string',
        'initiative.*.prioritas' => 'nullable|integer',
        'initiative.*.id' => 'nullable|exists:community_initiative,id',
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


    $keepInitiativeIds = [];

    if ($request->has('initiative')) {
        foreach ($request->initiative as $index => $initiativeData) {
            if (isset($initiativeData['id'])) {
                // Memperbarui inisiatif yang sudah ada
                $initiative = $community->initiative()->find($initiativeData['id']);
                if ($initiative) {
                    $initiative->update([
                        'judul' => $initiativeData['judul'],
                        'deskripsi' => $initiativeData['deskripsi'],
                        'icon' => $initiativeData['icon'] ?? 'fas fa-water',
                        'urutan_prioritas' => $initiativeData['prioritas'] ?? $index
                    ]);
                    $keepInitiativeIds[] = $initiative->id;
                }
            } else {
                // Membuat inisiatif baru
                $initiative = $community->initiatives()->create([
                    'judul' => $initiativeData['judul'],
                    'deskripsi' => $initiativeData['deskripsi'],
                    'icon' => $initiativeData['icon'] ?? 'fas fa-water',
                    'urutan_prioritas' => $initiativeData['prioritas'] ?? $index, 'd' => $initiativeData['order'] ?? $index
                ]);
                $keepInitiativeIds[] = $initiative->id;
            }
        }
    }

    // Menghapus inisiatif yang tidak ada dalam daftar pembaruan
    $community->initiatives()->whereNotIn('id', $keepInitiativeIds)->delete();

    return redirect()->route('admin.dashboard.community')
        ->with('success', 'Komunitas Berhasil Diupdate');
}

public function edit(Community $community)
{

    $community->load('initiatives', 'users', 'messages');

    return view('admin.community.edit', compact('community'));
}

    public function destroy(Community $community)
    {
        if ($community->gambar) {
            Storage::delete($community->gambar);
        }

        $community->delete();

        return redirect()->route('admin.dashboard.community')
            ->with('success', 'Komuniatas berhasil dihapus');
    }

/**
 * Menampilkan formulir untuk membuat inisiatif baru untuk komunitas
 */
public function createInitiative(Community $community)
{
    return view('admin.community.initiative.create', compact('community'));
}

/**
 * Menyimpan inisiatif yang baru dibuat ke dalam penyimpanan
 */
public function storeInitiative(Request $request, Community $community)
{
    $request->validate([
        'initiatives.*.judul' => 'required|string|max:255',
        'initiatives.*.deskripsi' => 'required|string',
        'initiatives.*.icon' => 'nullable|string',
        'initiatives.*.prioritas' => 'nullable|integer',
    ]);

    if ($request->has('initiatives')) {
        foreach ($request->initiatives as $index => $initiativeData) {
            $community->initiatives()->create([
                'judul' => $initiativeData['judul'],
                'deskripsi' => $initiativeData['deskripsi'],
                'icon' => $initiativeData['icon'] ?? 'fas fa-water',
                'urutan_prioritas' => $initiativeData['prioritas'] ?? $index
            ]);
        }
    }
    $community->load('initiatives');

    return redirect()->route('communities.show', $community)
        ->with('success', 'Initiative added successfully');
}

/**
 * Menampilkan formulir untuk mengedit inisiatif tertentu
 */
public function editInitiative(Community $community, $initiative)
{
    $initiative = $community->initiatives()->findOrFail($initiative);
    return view('admin.community.initiative.edit', compact('community', 'initiative'));
}

/**
 * Memperbarui inisiatif tertentu dalam penyimpanan
 */
public function updateInitiative(Request $request, Community $community, $initiative)
{
    $initiative = $community->initiatives()->findOrFail($initiative);

    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'icon' => 'nullable|string',
        'urutan_prioritas' => 'nullable|integer',
    ]);

    $initiative->update([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'icon' => $request->icon ?? 'fas fa-water',
        'urutan_prioritas' => $request->urutan_prioritas ?? 0
    ]);

    return redirect()->route('communities.show', $community)
        ->with('success', 'Initiative updated successfully');
}

/**
 * Menghapus inisiatif tertentu dari penyimpanan
 */
public function destroyInitiative(Community $community, $initiative)
{
    $initiative = $community->initiatives()->findOrFail($initiative);
    $initiative->delete();

    return redirect()->route('communities.show', $community)
        ->with('success', 'Initiative deleted successfully');
}

}
