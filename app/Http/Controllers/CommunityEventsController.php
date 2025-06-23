<?php


namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\CommunityEvent;
use App\Models\BanUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommunityEventsController extends Controller
{
    /**
     * Membuat instance controller baru
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'showEvents']);
    }

    /**
     * Menampilkan semua acara komunitas
     */
    public function showEvents(Community $community)
    {
        // Memeriksa apakah pengguna diblokir dari komunitas ini
        if (Auth::check()) {
            $isBanned = BanUsers::where('community_id', $community->community_id)
                ->where('user_id', Auth::id())
                ->exists();

            if ($isBanned) {
                return redirect()->route('communities.index')
                    ->with('error', __('Kamu telah diblokir dari komunitas ini.'));
            }
        }

        // Memeriksa izin pengguna
        $isMember = false;
        $isModeratorOrAdmin = false;

        if (Auth::check()) {
            $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();
            $isMember = $memberRecord ? true : false;

            if ($memberRecord && isset($memberRecord->pivot->role)) {
                $isModerator = in_array($memberRecord->pivot->role, ['moderator', 'admin']);
                $isModeratorOrAdmin = $isModerator || Auth::user()->role === 'admin';
            } elseif (Auth::user()->role === 'admin') {
                $isModeratorOrAdmin = true;
            }
        }

        // Memfilter acara berdasarkan permintaan
        $eventsQuery = $community->events();

        // Memfilter berdasarkan bulan jika disediakan
        if (request()->has('month')) {
            $month = explode('-', request('month'));
            if (count($month) == 2) {
                $year = $month[0];
                $monthNum = $month[1];
                $eventsQuery->whereYear('event_date', $year)
                          ->whereMonth('event_date', $monthNum);
            }
        }

        // Memfilter berdasarkan status acara (akan datang, telah lewat, semua)
        if (request('filter') == 'upcoming') {
            $eventsQuery->where('event_date', '>=', now()->toDateString());
        } elseif (request('filter') == 'past') {
            $eventsQuery->where('event_date', '<', now()->toDateString());
        }

        // Mengurutkan berdasarkan tanggal
        $eventsQuery->orderBy('event_date', request('filter') == 'past' ? 'desc' : 'asc');

        // Membagi hasil
        $events = $eventsQuery->paginate(9)->withQueryString();

        return view('community.events', compact(
            'community',
            'events',
            'isMember',
            'isModeratorOrAdmin'
        ));
    }

    public function create(Community $community)
    {
        // Memeriksa apakah pengguna memiliki izin
        if (!$this->isModeratorOrAdmin(Auth::id(), $community)) {
            return redirect()->route('communities.events', $community)
                ->with('error', 'Kamu tidak memiliki izin untuk membuat acara.');
        }

        return view('community.event-create', compact('community'));
    }
    /**
     * Menampilkan acara spesifik
     */
    public function show(Community $community, CommunityEvent $event)
    {
        // Memeriksa apakah acara ini milik komunitas ini
        if ($event->community_id !== $community->community_id) {
            abort(404);
        }

        // Memeriksa izin pengguna
        $isModeratorOrAdmin = false;

        if (Auth::check()) {
            $memberRecord = $community->users()->where('users.user_id', Auth::id())->first();

            if ($memberRecord && isset($memberRecord->pivot->role)) {
                $isModerator = in_array($memberRecord->pivot->role, ['moderator', 'admin']);
                $isModeratorOrAdmin = $isModerator || Auth::user()->role === 'admin';
            } elseif (Auth::user()->role === 'admin') {
                $isModeratorOrAdmin = true;
            }
        }

        return view('community.events', compact('community', 'event', 'isModeratorOrAdmin'));
    }

    /**
     * Menyimpan acara komunitas baru
     */
    public function store(Request $request, Community $community)
    {
        // Validasi permintaan
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'start_time' => 'nullable|string|max:10',
            'end_time' => 'nullable|string|max:10',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Memeriksa apakah pengguna memiliki izin
        if (!$this->isModeratorOrAdmin(Auth::id(), $community)) {
            return redirect()->back()->with('error', 'Kamu tidak memiliki izin untuk membuat acara.');
        }

        // Menyiapkan data
        $data = $request->only(['title', 'description', 'event_date', 'start_time', 'end_time', 'location']);
        $data['community_id'] = $community->community_id;

        // Menangani unggahan gambar
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        // Membuat acara
        CommunityEvent::create($data);

        // Mengalihkan berdasarkan dari mana permintaan berasal
        if ($request->has('source') && $request->source === 'events_page') {
            return redirect()->route('communities.events', $community)->with('success', 'Acara berhasil dibuat!');
        }

        return redirect()->route('communities.show', $community)->with('success', 'Acara berhasil dibuat!');
    }

    public function edit(Community $community, CommunityEvent $event)
    {
        // Memeriksa apakah acara ini milik komunitas ini
        if ($event->community_id !== $community->community_id) {
            abort(404);
        }

        // Memeriksa apakah pengguna memiliki izin
        if (!$this->isModeratorOrAdmin(Auth::id(), $community)) {
            return redirect()->back()->with('error', 'Kamu tidak memiliki izin untuk mengedit acara.');
        }

        return view('community.event-edit', compact('community', 'event'));
    }

    public function update(Request $request, Community $community, $eventId)
    {
        // Validasi permintaan
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'start_time' => 'nullable|string|max:10',
            'end_time' => 'nullable|string|max:10',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Memeriksa apakah pengguna memiliki izin
        if (!$this->isModeratorOrAdmin(Auth::id(), $community)) {
            return redirect()->back()->with('error', 'Kamu tidak memiliki izin untuk mengedit acara.');
        }

        // Mencari acara
        $event = CommunityEvent::findOrFail($eventId);
        
        // Memeriksa apakah acara ini milik komunitas ini
        if ($event->community_id !== $community->community_id) {
            return redirect()->back()->with('error', 'Acara tidak termasuk dalam komunitas ini.');
        }

        // Memperbarui kolom
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date = $request->event_date;
        $event->start_time = $request->start_time;
        $event->end_time = $request->end_time;
        $event->location = $request->location;

        // Menangani unggahan gambar
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            // Menyimpan gambar baru
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        // Mengalihkan berdasarkan dari mana permintaan berasal
        if ($request->has('source') && $request->source === 'events_page') {
            return redirect()->route('communities.events', $community)->with('success', 'Acara berhasil diperbarui!');
        }

        return redirect()->route('communities.show', $community)->with('success', 'Acara berhasil diperbarui!');
    }

    /**
     * Menghapus acara komunitas
     */
    public function delete(Community $community, CommunityEvent $event)
    {
        // Memeriksa apakah pengguna memiliki izin
        if (!$this->isModeratorOrAdmin(Auth::id(), $community)) {
            return redirect()->back()->with('error', 'Kamu tidak memiliki izin untuk menghapus acara.');
        }

        // Memverifikasi bahwa acara termasuk dalam komunitas ini
        if ($event->community_id !== $community->community_id) {
            return redirect()->back()->with('error', 'Acara tidak termasuk dalam komunitas ini.');
        }

        // Menghapus gambar jika ada
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            Storage::disk('public')->delete($event->image);
        }

        // Menghapus acara
        $event->delete();

        // Menentukan ke mana akan dialihkan berdasarkan HTTP_REFERER
        if (request()->headers->get('referer') && strpos(request()->headers->get('referer'), 'events') !== false) {
            return redirect()->route('communities.events', $community)->with('success', 'Acara berhasil dihapus!');
        }

        return redirect()->route('communities.show', $community)->with('success', 'Acara berhasil dihapus!');
    }

    /**
     * Mengekspor acara komunitas sebagai file iCal/ICS
     */
    public function exportCalendar(Community $community)
    {
        $events = $community->events()->where('event_date', '>=', now()->toDateString())->get();

        // Menghasilkan konten iCal
        $ical = "BEGIN:VCALENDAR\r\n";
        $ical .= "VERSION:2.0\r\n";
        $ical .= "PRODID:-//Bagan//Ocean Community Events//ID\r\n";
        $ical .= "CALSCALE:GREGORIAN\r\n";
        $ical .= "X-WR-CALNAME:Acara {$community->nama_komunitas}\r\n";

        foreach ($events as $event) {
            $ical .= "BEGIN:VEVENT\r\n";
            $ical .= "UID:" . md5($event->event_id . $event->title) . "@bagan.com\r\n";
            $ical .= "SUMMARY:" . $this->escapeString($event->title) . "\r\n";

            if ($event->description) {
                $ical .= "DESCRIPTION:" . $this->escapeString($event->description) . "\r\n";
            }

            if ($event->location) {
                $ical .= "LOCATION:" . $this->escapeString($event->location) . "\r\n";
            }

            // Format tanggal dengan atau tanpa waktu
            $dtstart = date('Ymd', strtotime($event->event_date));
            $dtend = date('Ymd', strtotime($event->event_date));

            if ($event->start_time && $event->end_time) {
                $dtstart .= 'T' . str_replace(':', '', $event->start_time) . '00';
                $dtend .= 'T' . str_replace(':', '', $event->end_time) . '00';
            } else {
                // Acara sepanjang hari
                $dtend = date('Ymd', strtotime($event->event_date . ' +1 day'));
            }

            $ical .= "DTSTART:" . $dtstart . "\r\n";
            $ical .= "DTEND:" . $dtend . "\r\n";
            $ical .= "DTSTAMP:" . date('Ymd\THis\Z') . "\r\n";
            $ical .= "END:VEVENT\r\n";
        }

        $ical .= "END:VCALENDAR";

        // Mengatur header yang tepat untuk unduhan file
        return response($ical)
            ->header('Content-Type', 'text/calendar; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $community->slug . '-events.ics"');
    }

    /**
     * Metode pembantu untuk escape string iCal
     */
    private function escapeString($string)
    {
        $string = str_replace(array("\r\n", "\n"), "\\n", $string);
        $string = str_replace("\\", "\\\\", $string);
        $string = str_replace(",", "\\,", $string);
        $string = str_replace(";", "\\;", $string);
        return $string;
    }

    /**
     * Metode pembantu untuk memeriksa apakah pengguna adalah moderator atau admin komunitas
     */
    private function isModeratorOrAdmin($userId, $community)
    {
        // Admin sistem selalu memiliki izin
        if (Auth::user()->role === 'admin') {
            return true;
        }

        $memberRecord = $community->users()->where('users.user_id', $userId)->first();
        if (!$memberRecord) return false;

        return in_array($memberRecord->pivot->role, ['moderator', 'admin']);
    }
}