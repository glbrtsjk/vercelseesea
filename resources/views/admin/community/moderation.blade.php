@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-100 to-teal-50 relative overflow-hidden pb-12">
    <!-- Elemen latar belakang tema laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/10 via-blue-600/10 to-teal-700/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-64 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header yang ditingkatkan -->
        <div class="bg-gradient-to-r from-blue-600/90 to-cyan-600/90 rounded-xl p-6 shadow-lg backdrop-blur-sm mb-6 mt-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-white mb-2 flex items-center">
                        <i class="fas fa-shield-alt mr-3 text-cyan-300"></i>
                        Dasbor Moderasi Komunitas: {{ $community->nama_komunitas }}
                    </h1>
                    <p class="text-cyan-100 mb-0">Kelola anggota, moderasi konten, dan jaga standar komunitas</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('communities.show', $community) }}" class="btn btn-outline-light">
                        <i class="fas fa-eye mr-2"></i>
                        Lihat Komunitas
                    </a>
                    <a href="{{ route('communities.chat', $community) }}" class="btn btn-outline-light">
                        <i class="fas fa-comments mr-2"></i>
                        Ke Obrolan
                    </a>
                </div>
            </div>
        </div>

        <!-- Ikhtisar Statistik Komunitas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Kartu statistik tetap sama -->
            <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-md border border-blue-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 mr-4 bg-blue-100 text-blue-600">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $members->count() }}</h3>
                        <p class="text-gray-500">Total Anggota</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-md border border-blue-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 mr-4 bg-red-100 text-red-600">
                        <i class="fas fa-ban"></i>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $BanUserss->count() }}</h3>
                        <p class="text-gray-500">Pengguna Diblokir</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-md border border-blue-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 mr-4 bg-yellow-100 text-yellow-600">
                        <i class="fas fa-microphone-slash"></i>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800">{{ $MuteUserss->count() }}</h3>
                        <p class="text-gray-500">Pengguna Dibisukan</p>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-sm rounded-xl p-4 shadow-md border border-blue-100">
                <div class="flex items-center">
                    <div class="rounded-full p-3 mr-4 bg-{{ $isChatLocked ? 'red' : 'green' }}-100 text-{{ $isChatLocked ? 'red' : 'green' }}-600">
                        <i class="fas fa-{{ $isChatLocked ? 'lock' : 'lock-open' }}"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">{{ $isChatLocked ? 'Terkunci' : 'Aktif' }}</h3>
                        <p class="text-gray-500">Status Obrolan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Kolom Kiri: Tindakan Moderasi -->
            <div class="lg:col-span-1">
                <!-- Tindakan Moderasi -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md border border-blue-100 mb-6">
                    <div class="border-b border-blue-100 p-4">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-shield-alt mr-2 text-blue-600"></i>
                            Tindakan Moderasi
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="flex flex-col space-y-4">

                            <div class="w-full border border-amber-200 rounded-lg overflow-hidden shadow-sm">
                                <div class="bg-gradient-to-r from-amber-500 to-orange-600 py-2 px-4 text-white">
                                    <h3 class="font-semibold flex items-center">
                                        <i class="fas fa-microphone-slash mr-2"></i>Bisukan Pengguna
                                    </h3>
                                </div>
                                <div class="p-4 bg-amber-50">
                                    <form method="POST" action="{{ route('communities.mute-user-form', $community) }}" id="quickMuteForm">
                                        @csrf
                                      <div class="mb-3">
    <label for="quick_user_select" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pengguna</label>
    <div class="relative">
        <select class="w-full px-3 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
            id="quick_user_select" name="user_id" required>
            <option value="">-- Pilih Pengguna --</option>
            @foreach($members as $member)
             @php

                    $isAlreadyMuted = \App\Models\MuteUsers::where('community_id', $community->community_id)
                        ->where('user_id', $member->user_id)
                        ->where('unmute_at', '>', now())
                        ->exists();
                    @endphp
                @if($member->pivot->role !== 'admin' && $member->user_id !== Auth::id() && !$isAlreadyMuted)
                    <option value="{{ $member->user_id }}">{{ $member->nama }} ({{ $member->email }})</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
                                        <div class="mb-3">
                                            <label for="quick_duration" class="block text-sm font-medium text-gray-700 mb-1">Durasi (menit)</label>
                                            <input type="number" class="w-full px-3 py-2 border border-amber-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                                                id="quick_duration" name="duration" value="30" min="5" max="1440" required>
                                        </div>
                                        <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white py-2 px-4 rounded-lg transition flex items-center justify-center">
                                            <i class="fas fa-check mr-2"></i>Terapkan
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Form Blokir Pengguna -->
                            <div class="w-full border border-red-200 rounded-lg overflow-hidden shadow-sm">
                                <div class="bg-gradient-to-r from-red-600 to-rose-700 py-2 px-4 text-white">
                                    <h3 class="font-semibold flex items-center">
                                        <i class="fas fa-ban mr-2"></i>Blokir Pengguna
                                    </h3>
                                </div>
                                <div class="p-4 bg-red-50">
                                    <form id="quickBanForm" method="POST" action="{{ route('communities.ban-user-form', $community) }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="quick_ban_user" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pengguna</label>
    <div class="relative">
        <select class="w-full px-3 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
            id="quick_ban_user" name="user_id" required>
            <option value="">-- Pilih Pengguna --</option>
            @foreach($members as $member)
                @if($member->pivot->role !== 'admin' && $member->user_id !== Auth::id())
                    <option value="{{ $member->user_id }}">{{ $member->nama }} ({{ $member->email }})</option>
                @endif
            @endforeach
        </select>
    </div>

                                        </div>
                                        <div class="mb-3">
                                            <label for="quick_ban_reason" class="block text-sm font-medium text-gray-700 mb-1">Alasan Pemblokiran</label>
                                            <input type="text" class="w-full px-3 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                                id="quick_ban_reason" name="reason" placeholder="Alasan singkat..." required>
                                        </div>
                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg transition flex items-center justify-center">
                                            <i class="fas fa-check mr-2"></i>Terapkan
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md border border-blue-100 mb-6">
    <div class="border-b border-blue-100 p-4">
        <h2 class="text-xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-microphone-slash mr-2 text-yellow-600"></i>
            Pengguna Dibisukan
        </h2>
    </div>
    <div class="p-4">
        @if($MuteUserss->count() > 0)
            <div class="space-y-3">
                @foreach($MuteUserss as $mute)
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-8 w-8 overflow-hidden rounded-full">
                @if($mute->user && $mute->user->foto_profil)
        <img src="{{ asset('storage/' . $mute->user->foto_profil) }}"
             class="h-full w-full object-cover"
             alt="{{ $mute->user->nama ?? 'Pengguna' }}">
          @else
        <div class="h-full w-full bg-yellow-200 text-yellow-600 rounded-full flex items-center justify-center">
            {{ substr($mute->user->nama ?? '?', 0, 1) }}
        </div>
             @endif
              </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">{{ $mute->user->nama ?? 'Pengguna Tidak Dikenal' }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ $mute->user->email ?? 'Email tidak tersedia' }} •
                                    Bisu hingga: {{ $mute->unmute_at->format('H:i, d M Y') }}
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('communities.unmute-user', [$community, $mute->user_id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-blue-600 hover:text-blue-900 flex items-center">
                                <i class="fas fa-volume-up mr-1"></i> Batalkan Bisu
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-blue-50 text-blue-700 p-3 rounded-lg">
                <i class="fas fa-info-circle mr-2"></i>
                Tidak ada pengguna yang sedang dibisukan di komunitas ini.
            </div>
        @endif
    </div>
</div>

                            <!-- Form Kunci/Buka Obrolan -->
                            <div class="w-full border border-blue-200 rounded-lg overflow-hidden shadow-sm">
                                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 py-2 px-4 text-white">
                                    <h3 class="font-semibold flex items-center">
                                        <i class="fas fa-{{ $isChatLocked ? 'lock' : 'lock-open' }} mr-2"></i>
                                        {{ $isChatLocked ? 'Buka Kunci Obrolan' : 'Kunci Obrolan' }}
                                    </h3>
                                </div>
                                <div class="p-4 bg-blue-50">
                                    <form action="{{ route('communities.lock-chat', $community) }}" method="POST">
                                        @csrf
                                        @if($isChatLocked)
                                            <div class="mb-3">
                                                <p class="text-sm text-gray-600 mb-3">Obrolan saat ini <span class="font-semibold text-red-600">terkunci</span>. Buka kunci untuk memungkinkan semua anggota mengirim pesan.</p>
                                                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg transition flex items-center justify-center">
                                                    <i class="fas fa-lock-open mr-2"></i>Buka Kunci
                                                </button>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <label for="quick_lock_reason" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penguncian</label>
                                                <input type="text" class="w-full px-3 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                    id="quick_lock_reason" name="reason" placeholder="Alasan singkat..." required>
                                            </div>
                                            <input type="hidden" name="lockType" value="indefinite">
                                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition flex items-center justify-center">
                                                <i class="fas fa-lock mr-2"></i>Kunci Sekarang
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md border border-blue-100 mb-6">
    <div class="border-b border-blue-100 p-4">
        <h2 class="text-xl font-bold text-gray-800 flex items-center">
            <i class="fas fa-ban mr-2 text-red-600"></i>
            Pengguna Diblokir
        </h2>
    </div>
    <div class="p-4">
        @if($BanUserss->count() > 0)
            <div class="space-y-3">
                @foreach($BanUserss as $ban)
                    @php

                        $bannedUser = \App\Models\User::find($ban->user_id);
                    @endphp
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <div class="flex items-center">

                    <div class="flex-shrink-0 h-10 w-10 overflow-hidden rounded-full">
                               @if($bannedUser && $bannedUser->foto_profil)
              <img src="{{ asset('storage/' . $bannedUser->foto_profil) }}"
             class="h-full w-full object-cover"
             alt="{{ $bannedUser->nama ?? 'Pengguna' }}">
               @else
                    <div class="h-full w-full bg-red-200 text-red-600 rounded-full flex items-center justify-center">
            {{ $bannedUser ? substr($bannedUser->nama, 0, 1) : 'U' }}
                   </div>
                      @endif
                            </div>
                            <div class="ml-3">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $bannedUser ? $bannedUser->nama : 'Pengguna Tidak Dikenal' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $bannedUser ? $bannedUser->email : 'Email tidak tersedia' }} •
                                    Diblokir: {{App\Helpers\IndonesiaTimeHelper::diffForHumans($ban->banned_at)}}
                                </div>
                                @if($ban->reason)
                                    <div class="text-xs text-red-500 mt-1">
                                        Alasan: {{ $ban->reason }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center">
                            <form action="{{ route('communities.unban-user-form', [$community, $ban->user_id]) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-blue-900 flex items-center">
                                    <i class="fas fa-undo mr-1"></i> Batalkan Blokir
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-blue-50 text-blue-700 p-3 rounded-lg">
                <i class="fas fa-info-circle mr-2"></i>
                Tidak ada pengguna yang diblokir di komunitas ini.
            </div>
        @endif
    </div>
</div>
            </div>

            <!-- Kolom Tengah dan Kanan: Manajemen Pengguna dan Moderasi Konten -->
            <div class="lg:col-span-2">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md border border-blue-100 mb-6">
                    <div class="border-b border-blue-100 p-4">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-user-shield mr-2 text-blue-600"></i>
                            Manajemen Anggota
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-blue-100">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-blue-50 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Pengguna</th>
                                        <th class="px-6 py-3 bg-blue-50 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Peran</th>
                                        <th class="px-6 py-3 bg-blue-50 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Bergabung</th>
                                        <th class="px-6 py-3 bg-blue-50 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-blue-50">
                                    @foreach($members as $member)
                                        <tr class="hover:bg-blue-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 overflow-hidden rounded-full">
                                  @if($member->foto_profil)
                           <img src="{{ asset('storage/' . $member->foto_profil) }}"
                                 class="h-full w-full object-cover border-2 {{ $member->pivot->role == 'admin' ? 'border-red-300' : ($member->pivot->role == 'moderator' ? 'border-green-300' : 'border-gray-200') }}"
                                 alt="{{ $member->nama }}">
                              @else
                               <div class="h-full w-full {{ $member->pivot->role == 'admin' ? 'bg-red-500' : ($member->pivot->role == 'moderator' ? 'bg-green-500' : 'bg-blue-500') }} text-white flex items-center justify-center font-medium">
                             {{ strtoupper(substr($member->nama, 0, 1)) }}
                                 </div>
                                @endif
                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $member->nama }}</div>
                                                        <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                           <td class="px-6 py-4 whitespace-nowrap">
                @php
                    $isSystemAdmin = Auth::user()->role === 'admin' && $member->user_id === Auth::id();
                
                    $userIsSystemAdmin = $member->role === 'admin';
                    $displayRole = ($userIsSystemAdmin || ($isSystemAdmin && $member->user_id === Auth::id()))
                        ? 'admin'
                        : $member->pivot->role;
                @endphp
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                    {{ $displayRole === 'admin' ? 'bg-red-100 text-red-800' :
                       ($displayRole === 'moderator' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                    {{ $displayRole === 'admin' ? 'Admin' :
                       ($displayRole === 'moderator' ? 'Moderator' : 'Anggota') }}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ isset($member->pivot->tg_gabung) ? App\Helpers\IndonesiaTimeHelper::diffForHumans($member->pivot->tg_gabung) : 'Tidak diketahui' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                <div class="flex gap-2">
                    @if((in_array($userRole, ['admin']) || $isSystemAdmin) && $member->user_id != Auth::id())
                        @if($member->pivot->role === 'member')
                            <form action="{{ route('communities.promote-moderator', [$community, $member->user_id]) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-blue-900" title="Jadikan Moderator">
                                    <i class="fas fa-level-up-alt"></i>
                                </button>
                            </form>
                        @elseif($member->pivot->role === 'moderator')
                            <form action="{{ route('communities.demote-moderator', [$community, $member->user_id]) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:text-yellow-900" title="Jadikan Anggota Biasa">
                                    <i class="fas fa-level-down-alt"></i>
                                </button>
                            </form>
                        @endif
                    @endif

                    @if($member->pivot->role !== 'admin' && $member->user_id !== Auth::id())
                        @php
                            $isAlreadyMuted = \App\Models\MuteUsers::where('community_id', $community->community_id)
                                ->where('user_id', $member->user_id)
                                ->where('unmute_at', '>', now())
                                ->exists();

                            $isAlreadyBanned = \App\Models\BanUsers::where('community_id', $community->community_id)
                                ->where('user_id', $member->user_id)
                                ->exists();
                        @endphp

                        @if(!$isAlreadyMuted)
                            <form action="{{ route('communities.mute-user-form', $community) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $member->user_id }}">
                                <input type="hidden" name="duration" value="30">
                                <input type="hidden" name="reason" value="Pelanggaran kebijakan">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin membisukan pengguna ini selama 30 menit?')"
                                    class="text-yellow-600 hover:text-yellow-900" title="Bisukan Pengguna">
                                    <i class="fas fa-microphone-slash"></i>
                                </button>
                            </form>
                        @endif

                        @if(!$isAlreadyBanned)
                            <form action="{{ route('communities.ban-user-form', $community) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $member->user_id }}">
                                <input type="hidden" name="reason" value="Pelanggaran kebijakan komunitas">
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin memblokir pengguna ini dari komunitas?')"
                                    class="text-red-600 hover:text-red-900" title="Blokir Pengguna">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </form>
                        @endif
                    @endif
                </div>
            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Alat Moderasi Konten -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md border border-blue-100 mb-6">
                    <div class="border-b border-blue-100 p-4">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <i class="fas fa-gavel mr-2 text-blue-600"></i>
                            Moderasi Konten
                        </h2>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Kontrol Kunci Obrolan -->
                            <div class="border border-blue-100 rounded-lg p-4 bg-blue-50/50">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Kontrol Kunci Obrolan</h3>

                                @if($isChatLocked)
                                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-lock mr-2"></i>
                                            <div>
                                                <p class="font-medium">Obrolan saat ini terkunci</p>
                                                <p class="text-sm">Dikunci oleh: {{ $lockInfo->lockedBy->nama ?? 'Tidak Diketahui' }}</p>
                                                <p class="text-sm">Alasan: {{ $lockInfo->reason ?? 'Tidak ada alasan yang diberikan' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{ route('communities.lock-chat', $community) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg">
                                            <i class="fas fa-lock-open mr-2"></i> Buka Kunci Obrolan
                                        </button>
                                    </form>
                                @else
                                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-lock-open mr-2"></i>
                                            <div>
                                                <p class="font-medium">Obrolan saat ini terbuka</p>
                                                <p class="text-sm">Semua anggota dapat mengirim pesan</p>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" data-bs-toggle="modal" data-bs-target="#lockChatModal" class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-lg">
                                        <i class="fas fa-lock mr-2"></i> Kunci Obrolan
                                    </button>
                                @endif
                            </div>

                            <!-- Manajemen Pesan -->
                            <div class="border border-blue-100 rounded-lg p-4 bg-blue-50/50">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Manajemen Pesan</h3>

                                <div class="mb-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-700">Total Pesan:</span>
                                        <span class="font-semibold">{{ $messageStats->sum('count') ?? 0 }}</span>
                                    </div>

                                    <div class="flex items-center justify-between mt-2">
                                        <span class="text-gray-700">Pesan Dilaporkan:</span>
                                        <span class="font-semibold">0</span> <!-- Bisa dinamis di masa depan -->
                                    </div>
                                </div>

                                <a href="{{ route('communities.chat', $community) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                                    <i class="fas fa-eye mr-2"></i> Lihat Riwayat Obrolan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Tema laut styling */
.ocean-waves {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%2306b6d4' fill-opacity='0.2' d='M0,64L48,80C96,96,192,128,288,160C384,192,480,224,576,224C672,224,768,192,864,176C960,160,1056,160,1152,186.7C1248,213,1344,267,1392,293.3L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    background-position: center;
    animation: wave-animation 20s linear infinite alternate;
}

.floating-particles {
    background-image:
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.2) 1px, transparent 1px),
        radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.2) 1px, transparent 1px),
        radial-gradient(circle at 60% 20%, rgba(255, 255, 255, 0.2) 1px, transparent 1px),
        radial-gradient(circle at 30% 65%, rgba(255, 255, 255, 0.2) 1px, transparent 1px);
    background-size: 100px 100px;
    animation: float-animation 15s linear infinite;
}

@keyframes wave-animation {
    0% { background-position: 0px 0px; }
    100% { background-position: 1000px 0px; }
}

@keyframes float-animation {
    0% { background-position: 0px 0px; }
    100% { background-position: 100px 100px; }
}

.btn-outline-light {
    color: #ffffff;
    border-color: #ffffff;
    background-color: transparent;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-outline-light:hover {
    background-color: rgba(255, 255, 255, 0.15);
    border-color: #ffffff;
    color: #ffffff;
}

/* Styling kartu */
.card {
    background-color: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 1rem;
    border: 1px solid rgba(59, 130, 246, 0.2);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
}

/* Kustomisasi modal */
.modal-content {
    border: none;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.alert {
    border-radius: 0.5rem;
}

/* Form kontrol yang ditingkatkan */
.form-control {
    padding: 0.75rem 1rem;
}

.form-control:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
}

/* Kustomisasi tombol */
.btn {
    padding: 0.5rem 1.25rem;
    border-radius: 0.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.btn-primary:hover {
    background-color: #2563eb;
    border-color: #2563eb;
}

.btn-danger {
    background-color: #ef4444;
    border-color: #ef4444;
}

.btn-danger:hover {
    background-color: #dc2626;
    border-color: #dc2626;
}

.btn-warning {
    background-color: #f59e0b;
    border-color: #f59e0b;
}

.btn-warning:hover {
    background-color: #d97706;
    border-color: #d97706;
}

.btn-secondary {
    background-color: #9ca3af;
    border-color: #9ca3af;
}

.btn-secondary:hover {
    background-color: #6b7280;
    border-color: #6b7280;
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form Bisukan Pengguna - Menangani slider range dan pemilihan pengguna
    const muteRangeSlider = document.getElementById('muteRangeSlider');
    const muteDuration = document.getElementById('muteDuration');
    const muteUserForm = document.getElementById('muteUserForm');

    if (muteRangeSlider && muteDuration) {
        // Sinkronisasi slider range dengan input angka
        muteRangeSlider.addEventListener('input', function() {
            muteDuration.value = this.value;
        });

        // Sinkronisasi input angka dengan slider range
        muteDuration.addEventListener('input', function() {
            muteRangeSlider.value = this.value;
        });
    }

    // Menangani pengiriman form bisukan pengguna
    if (muteUserForm) {
        muteUserForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const userId = document.getElementById('user_select').value;
            if (!userId) {
                // Tampilkan pesan kesalahan dengan animasi
                const select = document.getElementById('user_select');
                select.classList.add('border-red-500');
                select.classList.add('animate-pulse');

                setTimeout(() => {
                    select.classList.remove('animate-pulse');
                }, 1000);

                return;
            }

            // Ganti placeholder di URL aksi dengan ID pengguna yang dipilih
            const formAction = muteUserForm.getAttribute('action');
            muteUserForm.action = formAction.replace('PLACEHOLDER', userId);

            // Kirimkan formulir
            this.submit();
        });

    }



document.addEventListener('DOMContentLoaded', function() {
    // Form Bisukan Pengguna - Menangani slider range dan pemilihan pengguna
    const muteRangeSlider = document.getElementById('muteRangeSlider');
    const muteDuration = document.getElementById('muteDuration');
    const muteUserForm = document.getElementById('muteUserForm');

    if (muteRangeSlider && muteDuration) {
        // Sinkronisasi slider range dengan input angka
        muteRangeSlider.addEventListener('input', function() {
            muteDuration.value = this.value;
        });

        // Sinkronisasi input angka dengan slider range
        muteDuration.addEventListener('input', function() {
            muteRangeSlider.value = this.value;
        });
    }

    // Menangani pengiriman form bisukan pengguna
    if (muteUserForm) {
        muteUserForm.addEventListener('submit', function(e) {
            const userId = document.getElementById('user_select')?.value;
            if (!userId) {
                e.preventDefault();
                // Tampilkan pesan kesalahan dengan animasi
                const select = document.getElementById('user_select');
                if (select) {
                    select.classList.add('border-red-500');
                    select.classList.add('animate-pulse');

                    setTimeout(() => {
                        select.classList.remove('animate-pulse');
                    }, 1000);
                }
                return false;
            }
            return true;
        });
    }

    // Form cepat Bisukan Pengguna - make sure this only appears once
    const quickMuteForm = document.getElementById('quickMuteForm');
    if (quickMuteForm) {
        quickMuteForm.addEventListener('submit', function(e) {
            const userId = document.getElementById('quick_user_select').value;
            if (!userId) {
                e.preventDefault();
                alert('Harap pilih pengguna terlebih dahulu');
                return false;
            }

            if (!confirm('Apakah Anda yakin ingin membisukan pengguna ini?')) {
                e.preventDefault();
                return false;
            }

            return true;
        });
    }

    // Form cepat Blokir Pengguna
    const quickBanForm = document.getElementById('quickBanForm');
    if (quickBanForm) {
        quickBanForm.addEventListener('submit', function(e) {
            const userId = document.getElementById('quick_ban_user').value;
            if (!userId) {
                e.preventDefault();
                alert('Harap pilih pengguna terlebih dahulu');
                return false;
            }

            // Konfirmasi pemblokiran
            if (!confirm('Apakah Anda yakin ingin memblokir pengguna ini dari komunitas?')) {
                e.preventDefault();
                return false;
            }

            return true;
        });
    }

    // Menangani modal blokir pengguna
    const banUserModal = document.getElementById('banUserModal');
    if (banUserModal) {
        banUserModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const userId = button.getAttribute('data-user-id');
            const userName = button.getAttribute('data-user-name');

            document.getElementById('banUserName').textContent = userName || 'Pengguna Tidak Dikenal';

            // Perbaiki URL aksi formulir
            const form = document.getElementById('banUserForm');
            form.action = "{{ route('communities.ban-user', [$community, '__USER_ID__']) }}".replace('__USER_ID__', userId);
        });
    }

    // Animasi untuk kartu statistik
    const animateCounters = () => {
        const counters = document.querySelectorAll('.animate-counter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const count = parseInt(counter.innerText);
            const speed = 200; // kecepatan animasi

            if (count < target) {
                counter.innerText = Math.ceil(count + target/speed);
                setTimeout(() => animateCounters(), 1);
            } else {
                counter.innerText = target;
            }
        });
    };

    // Inisialisasi animasi penghitung
    animateCounters();

    // Form cepat Bisukan Pengguna
    const quickMuteForm = document.getElementById('quickMuteForm');
    if (quickMuteForm) {
        quickMuteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const userId = document.getElementById('quick_user_select').value;
            if (!userId) {
                alert('Harap pilih pengguna terlebih dahulu');
                return;
            }

            // Ganti placeholder di URL
            const formAction = quickMuteForm.getAttribute('action');
            quickMuteForm.action = formAction.replace('PLACEHOLDER', userId);

            // Kirim formulir
            this.submit();
        });
    }

    // Form cepat Blokir Pengguna
    const quickBanForm = document.getElementById('quickBanForm');
    if (quickBanForm) {
        quickBanForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const userId = document.getElementById('quick_ban_user').value;
            if (!userId) {
                alert('Harap pilih pengguna terlebih dahulu');
                return;
            }

            // Konfirmasi pemblokiran
            if (!confirm('Apakah Anda yakin ingin memblokir pengguna ini dari komunitas?')) {
                return;
            }

            // Ganti placeholder di URL
            const formAction = quickBanForm.getAttribute('action');
            quickBanForm.action = formAction.replace('PLACEHOLDER', userId);

            // Kirim formulir
            this.submit();
        });
    }
});
</script>
@endsection
