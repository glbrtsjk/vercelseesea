
@extends('layouts.app')

@section('title', $community->nama_komunitas . ' - ' . 'Obrolan')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Latar Belakang Animasi Laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/10 via-blue-600/10 to-teal-700/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
    </div>

    <div class="container mx-auto px-4 py-6 relative z-10">
        <!-- Header Banner Komunitas -->
        <div class="mb-6 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl shadow-xl overflow-hidden">
            <div class="relative">
                <!-- Gelombang SVG untuk bagian atas banner -->
                <div class="absolute top-0 left-0 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-12 opacity-20">
                        <path fill="#ffffff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,224C1248,203,1344,181,1392,170.7L1440,160L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
                    </svg>
                </div>

                <div class="px-6 py-10 flex flex-col md:flex-row items-center justify-between relative z-10">
                    <div class="flex items-center mb-4 md:mb-0">
                        @if($community->gambar)
                            <img src="{{ asset('storage/' . $community->gambar) }}" class="h-16 w-16 rounded-full border-4 border-white shadow-lg" alt="{{ $community->nama_komunitas }}">
                        @else
                            <div class="h-16 w-16 rounded-full bg-white text-blue-600 flex items-center justify-center text-xl font-bold border-4 border-white shadow-lg">
                                {{ strtoupper(substr($community->nama_komunitas, 0, 1)) }}
                            </div>
                        @endif
                        <div class="ml-4 text-white">
                            <h1 class="text-2xl font-bold flex items-center">
                                {{ $community->nama_komunitas }}
                                @if(isset($isChatLocked) && $isChatLocked)
                                    <span class="ml-2 bg-amber-400 text-amber-800 text-xs px-2 py-1 rounded-full flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                        Terkunci
                                    </span>
                                @endif
                            </h1>
                            <p class="text-blue-100">{{ Str::limit(strip_tags($community->deskripsi), 80) }}</p>
                            <p class="text-xs text-blue-100 mt-1">{{ $members->count() }} anggota · Dibuat {{ \App\Helpers\IndonesiaTimeHelper::diffForHumans($community->created_at) }}</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('communities.show', $community) }}" class="bg-gradient-to-b from-sky-500 to-blue-600 bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Kembali ke Komunitas
                        </a>

                        @if(isset($canModerate) && $canModerate)
                            <a href="{{ route('communities.moderation', $community) }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50 transition duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Moderasi
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Gelombang SVG untuk bagian bawah banner -->
                <div class="absolute bottom-0 left-0 w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-16 opacity-20">
                        <path fill="#ffffff" fill-opacity="1" d="M0,96L48,128C96,160,192,224,288,240C384,256,480,224,576,213.3C672,203,768,213,864,202.7C960,192,1056,160,1152,160C1248,160,1344,192,1392,208L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Area Konten Utama -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Kolom Chat Utama -->
            <div class="lg:w-2/3 flex flex-col">
                <!-- Kontainer Chat -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border border-blue-100 flex flex-col h-[600px]">
                    <!-- Panel Kontrol Moderasi (hanya untuk moderator) -->
                    @if(isset($canModerate) && $canModerate)
                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 px-4 py-3 border-b border-blue-100">
                            <div class="flex flex-wrap items-center justify-between gap-2">
                                <div class="flex items-center">
                                    <span class="text-blue-700 font-medium mr-2">Panel Moderator:</span>

                                    <!-- Toggle Lock Chat Button -->
                                    <form action="{{ route('communities.lock-chat', $community) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="{{ $isChatLocked ? 'bg-amber-500 hover:bg-amber-600' : 'bg-blue-500 hover:bg-blue-600' }} text-white px-3 py-1.5 rounded-lg text-sm transition flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $isChatLocked ? 'Buka Kunci Obrolan' : 'Kunci Obrolan' }}
                                        </button>
                                    </form>
                                </div>

                                @if($isChatLocked && isset($lockInfo))
                                    <div class="text-sm text-amber-700 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        <span>Dikunci oleh {{ $lockInfo->lockedBy->nama ?? 'Admin' }} ({{ \App\Helpers\IndonesiaTimeHelper::formatDate($lockInfo->locked_at)}})</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Area Pesan Chat -->
                    <div id="messagesContainer" class="flex-grow overflow-y-auto p-4 space-y-4" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZmZmZmZmIj48L3JlY3Q+CjxwYXRoIGQ9Ik0wIDVMNSAwWk02IDRMNCA2Wk0tMSAxTDEgLTFaIiBzdHJva2U9IiNmMGY3ZmYiIHN0cm9rZS13aWR0aD0iMSI+PC9wYXRoPgo8L3N2Zz4='); background-repeat: repeat;">
                        @forelse($messages as $message)
                            <div class="chat-message {{ $message->user_id == Auth::id() ? 'ml-auto' : '' }} max-w-[85%]">
                                <div class="flex items-start {{ $message->user_id == Auth::id() ? 'flex-row-reverse' : '' }} gap-2">
                                    <!-- Avatar -->
                                    <div class="flex-shrink-0">
                                        @if($message->user && $message->user->foto_profil)
                                            <img src="{{ asset('storage/' . $message->user->foto_profil) }}" class="h-10 w-10 rounded-full border-2 {{ $message->user_id == Auth::id() ? 'border-blue-200' : 'border-blue-100' }}" alt="{{ $message->user->nama }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full {{ $message->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700' }} flex items-center justify-center font-medium border-2 {{ $message->user_id == Auth::id() ? 'border-blue-200' : 'border-blue-100' }}">
                                                {{ strtoupper(substr($message->user ? $message->user->nama : 'U', 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Konten Pesan -->
                                    <div class="{{ $message->user_id == Auth::id() ? 'mr-2' : 'ml-2' }}">
                                        <!-- Header pesan -->
                                        <div class="flex items-center {{ $message->user_id == Auth::id() ? 'justify-end' : '' }} mb-1">
                                            @if($message->user_id != Auth::id())
                                                <span class="font-semibold text-sm text-gray-800 mr-2">{{ $message->user ? $message->user->nama : 'Pengguna tidak ditemukan' }}</span>
                                            @endif

                                            @if($members->where('user_id', $message->user_id)->first()?->pivot?->role === 'moderator')
                                                <span class="bg-green-100 text-green-800 text-xs px-1.5 py-0.5 rounded mr-1">Moderator</span>
                                            @elseif($members->where('user_id', $message->user_id)->first()?->pivot?->role === 'admin')
                                                <span class="bg-red-100 text-red-800 text-xs px-1.5 py-0.5 rounded mr-1">Admin</span>
                                            @endif
                                         <span class="text-xs text-gray-500 message-timestamp" data-timestamp="{{ $message->tgl_pesan->timestamp }}">
                                             {{ \Carbon\Carbon::parse($message->tgl_pesan)->format('H:i') }}
                                             </span>
                                    @if($message->user_id == Auth::id())
                                                <span class="font-semibold text-sm text-gray-800 ml-2">{{ $message->user ? $message->user->nama : 'Anda' }}</span>
                                            @endif
                                        </div>

                                        <!-- Bubble pesan -->
                                        <div class="{{ $message->user_id == Auth::id() ? 'bg-gradient-to-r from-blue-500 to-cyan-600 text-white' : 'bg-gray-100 text-gray-800' }} p-3 rounded-xl shadow-sm">
                                            <div class="whitespace-pre-wrap break-words">{!! nl2br(e($message->isi_pesan)) !!}</div>

                                            <!-- Lampiran -->
                                            @if(isset($message->lampiran) && $message->lampiran)
                                                <div class="mt-2 pt-2 {{ $message->user_id == Auth::id() ? 'border-t border-blue-400' : 'border-t border-gray-200' }}">
                                                    @if($message->lampiran_tipe == 'image')
                                                        <a href="{{ asset('storage/' . $message->lampiran) }}" target="_blank" class="block">
                                                            <img src="{{ asset('storage/' . $message->lampiran) }}" class="rounded max-h-40 max-w-full object-cover border {{ $message->user_id == Auth::id() ? 'border-blue-300' : 'border-gray-300' }}" alt="Lampiran">
                                                        </a>
                                                    @else
                                                        <a href="{{ asset('storage/' . $message->lampiran) }}" target="_blank" class="{{ $message->user_id == Auth::id() ? 'bg-blue-400 hover:bg-blue-300' : 'bg-white hover:bg-gray-50' }} flex items-center gap-2 px-3 py-2 rounded transition-colors">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                                            </svg>
                                                            <span class="text-sm truncate max-w-[200px]">{{ $message->lampiran_nama ?? 'Unduh lampiran' }}</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
@if(($message->user_id == Auth::id() && $message->tgl_pesan->diffInMinutes(now()) < 30) ||
    (isset($canModerate) && $canModerate) ||
    (Auth::check() && Auth::user()->isAdmin()) ||
    (isset($memberRecord) && isset($memberRecord->pivot) && $memberRecord->pivot->role === 'moderator'))
    <div class="mt-1 flex gap-2 {{ $message->user_id == Auth::id() ? 'justify-end' : '' }}">
        <form action="{{ route('communities.messages.delete', [$community, $message]) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="text-xs {{ $message->user_id == Auth::id() ? 'bg-red-500 hover:bg-red-600' : 'bg-orange-500 hover:bg-orange-600' }} text-white px-2 py-1 rounded transition"
                onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>

        @if(isset($canModerate) && $canModerate && $message->user_id != Auth::id())
            <div class="relative inline-block" x-data="{ open: false }">
                <button @click="open = !open" class="text-xs text-gray-500 hover:text-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" class="absolute z-10 {{ $message->user_id == Auth::id() ? 'right-0' : 'left-0' }} mt-1 w-48 bg-white rounded-md shadow-lg border border-gray-200">
                    @php
                      $messageUserRole = isset($messageUserRoles[$message->id]) ? $messageUserRoles[$message->id] : 'member';
                      $isSystemAdmin = isset($isSystemAdmin) ? $isSystemAdmin : (Auth::check() && Auth::user()->role === 'admin');
                      $isCurrentlyMuted = \App\Models\MuteUsers::where('community_id', $community->community_id)
                     ->where('user_id', $message->user_id)
                    ->where('unmute_at', '>', now())
                   ->exists();
                    @endphp

                    @if(isset($canMuteUser) && $canMuteUser)
                        @if($isCurrentlyMuted)
                    <form action="{{ route('communities.unmute-user', [$community, $message->user_id]) }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd" />
                                    </svg>
                                    Buka Bisu Pengguna
                                </button>
                            </form>
                        @else
                            <a href="javascript:void(0)" onclick="document.getElementById('muteUserForm{{ $message->user_id }}').classList.toggle('hidden')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM12.293 7.293a1 1 0 011.414 0L15 8.586l1.293-1.293a1 1 0 111.414 1.414L16.414 10l1.293 1.293a1 1 0 01-1.414 1.414L15 11.414l-1.293 1.293a1 1 0 01-1.414-1.414L13.586 10l-1.293-1.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Bisukan Pengguna
                            </a>
                        @endif
                    @endif

                    @php
                        $isCurrentlyBanned = \App\Models\BanUsers::where('community_id', $community->community_id)
                   ->where('user_id', $message->user_id)
                    ->exists();
                    @endphp

                    @if(isset($canBanUser) && $canBanUser)
                        @if($isCurrentlyBanned)
                            <form action="{{ route('communities.unban-user', [$community, $message->user_id]) }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L10 9.586 7.707 7.293a1 1 0 00-1.414 1.414L8.586 11l-2.293 2.293a1 1 0 101.414 1.414L10 12.414l2.293 2.293a1 1 0 001.414-1.414L11.414 11l2.293-2.293z" clip-rule="evenodd" />
                                    </svg>
                                    Buka Blokir Pengguna
                                </button>
                            </form>
                        @else
                            <a href="javascript:void(0)" onclick="document.getElementById('banUserForm{{ $message->user_id }}').classList.toggle('hidden')" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                                </svg>
                                Blokir Pengguna
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        @endif
    </div>
@endif

<!-- Mute User Form -->
<div id="muteUserForm{{ $message->user_id }}" class="hidden mt-2 bg-white rounded-lg shadow-lg border border-gray-200 p-3">
    <form action="{{ route('communities.mute-user-form', $community) }}" method="POST" class="flex flex-col gap-2">
        @csrf
        <input type="hidden" name="user_id" value="{{ $message->user_id }}">
        <input type="hidden" name="message_id" value="{{ $message->id }}">

        @php

            $messageUserRole = isset($messageUserRoles[$message->id]) ? $messageUserRoles[$message->id] : 'member';
            $isSystemAdmin = isset($isSystemAdmin) ? $isSystemAdmin : (Auth::check() && Auth::user()->role === 'admin');
            $currentUserRole = isset($currentUserRole) ? $currentUserRole : 'member';
        @endphp

        @if($messageUserRole === 'admin' && !$isSystemAdmin && $currentUserRole !== 'admin')
            <div class="bg-red-50 border-l-4 border-red-500 p-2 mb-2 text-xs text-red-700">
                <p>❌ Tidak diizinkan: Anda tidak dapat membisukan admin komunitas.</p>
            </div>
        @elseif($messageUserRole === 'admin' && ($currentUserRole === 'admin' || $isSystemAdmin))
            <div class="bg-amber-50 border-l-4 border-amber-500 p-2 mb-2 text-xs text-amber-700">
                <p>⚠️ Perhatian: Anda akan membisukan admin lain dari komunitas ini.</p>
            </div>
        @endif

        <label class="text-xs text-gray-600">Durasi</label>
        <select name="duration" class="text-sm rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
            <option value="15">15 menit</option>
            <option value="60">1 jam</option>
            <option value="360">6 jam</option>
            <option value="1440">1 hari</option>
            <option value="4320">3 hari</option>
            <option value="10080">1 minggu</option>
        </select>
        <input type="text" name="reason" placeholder="Alasan pembisuan (opsional)" class="text-sm rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
        <div class="flex gap-2">
            <button type="submit" class="text-xs bg-amber-500 hover:bg-amber-600 text-white px-2 py-1 rounded transition"
                @if($messageUserRole === 'admin' && !$isSystemAdmin && $currentUserRole !== 'admin') disabled @endif>
                Bisukan Pengguna
            </button>
            <button type="button" class="text-xs text-gray-600 hover:text-gray-800" onclick="document.getElementById('muteUserForm{{ $message->user_id }}').classList.add('hidden')">
                Batal
            </button>
        </div>
    </form>
</div>

<div id="banUserForm{{ $message->user_id }}" class="hidden mt-2 bg-white rounded-lg shadow-lg border border-gray-200 p-3">
    <form action="{{ route('communities.ban-user',  [$community, 'user' => $message->user_id]) }}" method="POST" class="flex flex-col gap-2">
        @csrf
        <input type="hidden" name="user_id" value="{{ $message->user_id }}">
        <input type="hidden" name="message_id" value="{{ $message->id }}">

        @php

            $messageUserRole = isset($messageUserRoles[$message->id]) ? $messageUserRoles[$message->id] : 'member';
            $isSystemAdmin = isset($isSystemAdmin) ? $isSystemAdmin : (Auth::check() && Auth::user()->role === 'admin');
            $currentUserRole = isset($currentUserRole) ? $currentUserRole : 'member';
        @endphp

        @if($messageUserRole === 'admin' && !$isSystemAdmin)
            <div class="bg-red-50 border-l-4 border-red-500 p-2 mb-2 text-xs text-red-700">
                <p>❌ Tidak diizinkan: Anda tidak dapat memblokir admin komunitas.</p>
            </div>
        @elseif($messageUserRole === 'moderator' && $currentUserRole !== 'admin' && !$isSystemAdmin)
            <div class="bg-red-50 border-l-4 border-red-500 p-2 mb-2 text-xs text-red-700">
                <p>❌ Tidak diizinkan: Hanya admin yang dapat memblokir moderator.</p>
            </div>
        @endif

        <label class="text-xs text-gray-600">Alasan Pemblokiraan (opsional)</label>
        <input type="text" name="reason" placeholder="Alasan pemblokiran" class="text-sm rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
        <div class="flex gap-2">
            <button type="submit" class="text-xs bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded transition"
                @if(($messageUserRole === 'admin' && !$isSystemAdmin) || ($messageUserRole === 'moderator' && $currentUserRole !== 'admin' && !$isSystemAdmin)) disabled @endif>
                Blokir Pengguna
            </button>
            <button type="button" class="text-xs text-gray-600 hover:text-gray-800" onclick="document.getElementById('banUserForm{{ $message->user_id }}').classList.add('hidden')">
                Batal
            </button>
        </div>
    </form>
</div>

                                   </div>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center h-full">
                                <div class="relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-blue-100" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute bottom-0 right-0 h-8 w-8 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="mt-3 text-gray-500 text-center">Belum ada pesan. Jadilah yang pertama memulai percakapan!</p>
                                <p class="mt-1 text-blue-400 text-sm">Bergabunglah dalam diskusi tentang konservasi laut</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Input Pesan -->
                    <div class="border-t border-blue-100 bg-gradient-to-r from-blue-50 to-cyan-50 p-4">
                        @if(isset($isMuted) && $isMuted && Auth::user()->role !== 'admin')
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">Anda sedang dibisukan dalam obrolan ini.</p>
                                    </div>
                                </div>
                            </div>
                        @elseif(!isset($isChatLocked) || !$isChatLocked || (isset($canModerate) && $canModerate))
                            <form action="{{ route('communities.messages.store', $community) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <div class="relative">
                                    <textarea name="konten" rows="3" class="block w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pr-20 resize-none" placeholder="Bagikan pemikiran Anda tentang konservasi laut..." required></textarea>

                                    <div class="absolute right-2 bottom-2 flex">
                                        <label for="lampiran" class="cursor-pointer bg-blue-100 hover:bg-blue-200 text-blue-600 p-2 rounded-lg transition-colors mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                            </svg>
                                        </label>
                                        <input type="file" id="lampiran" name="lampiran" class="hidden" accept="image/jpeg,image/png,image/gif,application/pdf,text/plain,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>
                                </div>

                                <!-- Preview untuk lampiran yang dipilih -->
                                <div id="attachmentPreview" class=" bg-blue-50 rounded-lg p-3 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                        </svg>
                                        <span id="attachmentName" class="text-sm text-blue-700 truncate max-w-xs"></span>
                                    </div>
                                    <button type="button" id="removeAttachment" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="flex items-center justify-between">
                                    <small class="text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                        Dukung konservasi laut
                                    </small>

                                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg transition-colors flex items-center shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                                        </svg>
                                        Kirim
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <p class="text-gray-600">Obrolan saat ini dikunci oleh moderator.</p>
                                @if(isset($lockInfo) && isset($lockInfo->lockedBy))
                                    <p class="text-sm text-gray-500 mt-1">Dikunci oleh: {{ $lockInfo->lockedBy->nama }}</p>
                                    <p class="text-sm text-gray-500">({{ $lockInfo->locked_at->diffForHumans() }})</p>
                                    @if($lockInfo->reason)
                                        <p class="text-sm text-gray-600 mt-2 font-medium">Alasan: {{ $lockInfo->reason }}</p>
                                    @endif
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3">
                <!-- Anggota Komunitas -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border border-blue-100">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-4">
                        <h3 class="font-bold text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Anggota Komunitas ({{ $members->count() }})
                        </h3>
                    </div>

                    <!-- Search -->
                    <div class="p-3 border-b border-gray-200 bg-gray-50">
                        <div class="relative">
                            <input type="text" id="memberSearch" class="w-full rounded-lg border-gray-300 pl-10 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Cari anggota...">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="max-h-[400px] overflow-y-auto p-2" id="membersList">
@foreach($members->sortByDesc(function($member) {
    $rolePriority = [
        'admin' => 3,
        'moderator' => 2,
        'member' => 1
    ];
    return $rolePriority[$member->pivot->role] ?? 0;
}) as $member)
<div class="member-item p-2 hover:bg-blue-50 rounded-lg transition-colors flex items-center justify-between">
    <div class="flex items-center">
        @if($member->foto_profil)
            <img src="{{ asset('storage/' . $member->foto_profil) }}" class="h-10 w-10 rounded-full object-cover border-2 {{ $member->pivot->role == 'admin' ? 'border-red-300' : ($member->pivot->role == 'moderator' ? 'border-green-300' : 'border-gray-200') }}" alt="{{ $member->nama }}">
        @else
            <div class="h-10 w-10 rounded-full {{ $member->pivot->role == 'admin' ? 'bg-red-500' : ($member->pivot->role == 'moderator' ? 'bg-green-500' : 'bg-blue-500') }} text-white flex items-center justify-center font-medium">
                {{ strtoupper(substr($member->nama ?? $member->name ?? 'U', 0, 1)) }}
            </div>
        @endif

        <div class="ml-3">
            @php
                $memberName = $member->nama ?? $member->name ?? $member->username ?? 'Unknown';
                $isSystemAdmin = $member->role === 'admin';
            @endphp
            <p class="text-sm font-medium text-gray-900 member-name">{{ $memberName }}</p>
            <div class="flex items-center">
                @if($member->pivot->role == 'admin' || $isSystemAdmin)
                    <span class="bg-red-100 text-red-800 text-xs px-1.5 py-0.5 rounded mr-1">Admin</span>
                @elseif($member->pivot->role == 'moderator')
                    <span class="bg-green-100 text-green-800 text-xs px-1.5 py-0.5 rounded mr-1">Moderator</span>
                @endif

                @if($member->user_id == Auth::id())
                    <span class="bg-blue-100 text-blue-800 text-xs px-1.5 py-0.5 rounded">Anda</span>
                @endif
            </div>
        </div>
    </div>
    <div class="inline-flex items-center gap-1 text-xs text-gray-500">
        @php

            $isOnline = false;
            if ($member->pivot->aktif_flag == 1 && $member->pivot->terakhir_aktif) {
                $lastActive = \Carbon\Carbon::parse($member->pivot->terakhir_aktif);
                $isOnline = $lastActive->gt(now()->subMinutes(15));


                if ($member->user_id == Auth::id()) {
                    $isOnline = true;
                }
            }
        @endphp

        @if($isOnline)
            <div class="h-2 w-2 rounded-full bg-green-500"></div>
            <span class="user-status">Online</span>
        @else
            <div class="h-2 w-2 rounded-full bg-gray-300"></div>
            <span class="user-status">Offline</span>
        @endif
    </div>
</div>
@endforeach
                    </div>
                </div>

                <!-- Informasi Komunitas -->
                <div class="mt-6 bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border border-blue-100">
                    <div class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white p-4">
                        <h3 class="font-bold text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tentang Komunitas
                        </h3>
                    </div>

                    <div class="p-4">
                        <div class="prose prose-sm max-w-none">
                            <p>{{ Str::limit(strip_tags($community->deskripsi), 150) }}</p>
                            <a href="{{ route('communities.show', $community) }}" class="text-cyan-600 hover:text-cyan-800 font-medium flex items-center mt-2">
                                Baca lebih lanjut
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg p-3 text-center">
                                    <p class="text-sm text-gray-500">Dibuat pada</p>
                                    <p class="font-medium text-blue-700">
                                      {{ \App\Helpers\IndonesiaTimeHelper::formatDate($community->created_at ) }}
                                    </p>
                                </div>
                                <div class="bg-gradient-to-r from-cyan-50 to-teal-50 rounded-lg p-3 text-center">
                                    <p class="text-sm text-gray-500">Pesan</p>
                                    <p class="font-medium text-teal-700">{{ $messages->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Peraturan Komunitas -->
                <div class="mt-6 bg-white/90 backdrop-blur-sm rounded-xl shadow-lg overflow-hidden border border-blue-100">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white p-4">
                        <h3 class="font-bold text-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Peraturan Komunitas
                        </h3>
                    </div>

                    <div class="p-4">
                        <ul class="list-disc list-inside space-y-2 text-sm">
                            <li>Hormati semua anggota komunitas</li>
                            <li>Jangan mengirim konten spam atau iklan</li>
                            <li>Konten harus relevan dengan konservasi laut</li>
                            <li>Hindari bahasa kasar atau perilaku tidak pantas</li>
                            <li>Mentaati semua keputusan moderator</li>
                            <li>Pengguna yang melanggar peraturan dapat dibisukan atau diblokir</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.getElementById('messagesContainer');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    formatMessageTimestamps();

    updateUserActivity();

    setInterval(updateUserActivity, 60000);

    setInterval(formatMessageTimestamps, 60000);

    document.addEventListener('click', updateUserActivity);
    document.addEventListener('keydown', updateUserActivity);

    setInterval(function() {
        refreshMemberStatus();
    }, 15000);

    updateCurrentUserStatusDisplay();

    const memberSearch = document.getElementById('memberSearch');
    if (memberSearch) {
        memberSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const memberItems = document.querySelectorAll('#membersList .member-item');

            memberItems.forEach(item => {
                const memberName = item.querySelector('.member-name');
                if (memberName) {
                    const name = memberName.textContent.toLowerCase();
                    if (name.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                }
            });
        });
    }

    const attachmentInput = document.getElementById('lampiran');
    const attachmentPreview = document.getElementById('attachmentPreview');
    const attachmentName = document.getElementById('attachmentName');
    const removeAttachment = document.getElementById('removeAttachment');

    if (attachmentInput && attachmentPreview && attachmentName && removeAttachment) {
        attachmentPreview.style.display = 'none';

        attachmentInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                attachmentName.textContent = this.files[0].name;
                attachmentPreview.style.display = '';
                updateUserActivity();
            } else {
                attachmentPreview.style.display = 'none';
            }
        });

        removeAttachment.addEventListener('click', function() {
            attachmentInput.value = '';
            attachmentPreview.style.display = 'none';
        });
    }

    const sendButton = document.querySelector('button[type="submit"]');
    if (sendButton) {
        sendButton.addEventListener('click', updateUserActivity);
    }

    const messageForm = document.querySelector('form[action*="messages.store"]');
    if (messageForm) {
        messageForm.addEventListener('submit', function(e) {
            updateUserActivity();
        });
    }
});

function formatMessageTimestamps() {
    const timestamps = document.querySelectorAll('.message-timestamp');
    const now = new Date();

    timestamps.forEach(element => {
        const timestamp = parseInt(element.getAttribute('data-timestamp')) * 1000;
        const date = new Date(timestamp);

        if (isSameDay(date, now)) {
            element.textContent = formatTime(date);
        } else {
            element.textContent = formatDate(date) + ' ' + formatTime(date);
        }
    });
}

function isSameDay(date1, date2) {
    return date1.getFullYear() === date2.getFullYear() &&
           date1.getMonth() === date2.getMonth() &&
           date1.getDate() === date2.getDate();
}

function formatTime(date) {
    const hours = date.getHours().toString().padStart(2, '0');
    const minutes = date.getMinutes().toString().padStart(2, '0');
    return `${hours}:${minutes}`;
}

function formatDate(date) {
    const day = date.getDate().toString().padStart(2, '0');
    const month = (date.getMonth() + 1).toString().padStart(2, '0');
    const year = date.getFullYear().toString().slice(-2);
    return `${day}/${month}/${year}`;
}

function updateUserActivity() {
    fetch('{{ route('communities.update-activity', $community) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        }
        throw new Error('Network response was not ok');
    })
    .then(data => {
        if (data.status === 'success') {
            updateCurrentUserStatusDisplay();
        }
    })
    .catch(error => console.error('Error updating activity status:', error));
}

function updateCurrentUserStatusDisplay() {
    const memberItems = document.querySelectorAll('#membersList .member-item');
    let currentUserFound = false;

    memberItems.forEach(item => {
        const youBadge = item.querySelector('.bg-blue-100.text-blue-800');
        if (youBadge && youBadge.textContent.trim() === 'Anda') {
            currentUserFound = true;
            const statusText = item.querySelector('.user-status');
            const statusDot = item.querySelector('.rounded-full');

            if (statusText) {
                statusText.textContent = 'Online';
            }

            if (statusDot) {
                statusDot.classList.remove('bg-gray-300');
                statusDot.classList.add('bg-green-500');
            }
        }
    });

    if (!currentUserFound) {
        console.log('Current user not found in member list, trying again...');
        setTimeout(updateCurrentUserStatusDisplay, 1000);
    }
}

function refreshMemberStatus() {
    fetch('{{ route('communities.chat', $community) }}?refresh=members', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');

        const newMembersList = doc.getElementById('membersList');
        if (newMembersList) {
            const currentMembersList = document.getElementById('membersList');
            if (currentMembersList) {
                currentMembersList.innerHTML = newMembersList.innerHTML;

                const memberSearch = document.getElementById('memberSearch');
                if (memberSearch && memberSearch.value) {
                    const searchTerm = memberSearch.value.toLowerCase();
                    const memberItems = document.querySelectorAll('#membersList .member-item');

                    memberItems.forEach(item => {
                        const memberName = item.querySelector('.member-name');
                        if (memberName) {
                            const name = memberName.textContent.toLowerCase();
                            if (name.includes(searchTerm)) {
                                item.style.display = '';
                            } else {
                                item.style.display = 'none';
                            }
                        }
                    });
                }

                updateCurrentUserStatusDisplay();
            }
        }
    })
    .catch(error => console.error('Error refreshing member status:', error));
}

let lastMessageCount = {{ $messages->count() }};

setInterval(function() {
    fetch('{{ route('communities.chat', $community) }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newMessages = doc.querySelectorAll('.chat-message');

        if (newMessages.length > lastMessageCount) {
            // New messages available, refresh page
            window.location.reload();
        }
    })
    .catch(error => console.error('Error checking for new messages:', error));
}, 30000);

// Add these functions to your existing scripts section
function toggleDropdown(messageId) {
    const dropdown = document.getElementById('dropdown' + messageId);
    if (dropdown) {
        dropdown.classList.toggle('hidden');

        // Close all other dropdowns
        document.querySelectorAll('.message-dropdown').forEach(item => {
            if (item.id !== 'dropdown' + messageId && !item.classList.contains('hidden')) {
                item.classList.add('hidden');
            }
        });
    }
}

function showMuteUserForm(userId) {
    document.getElementById('muteUserForm' + userId).classList.remove('hidden');
    document.getElementById('dropdown' + userId).classList.add('hidden');
}

function showBanUserForm(userId) {
    document.getElementById('banUserForm' + userId).classList.remove('hidden');
    document.getElementById('dropdown' + userId).classList.add('hidden');
}
</script>
@endsection

<!-- Style tambahan untuk animasi -->
@section('styles')
<style>
    .floating-particles {
        background-image: radial-gradient(circle, rgba(255,255,255,0.3) 2px, transparent 2px);
        background-size: 50px 50px;
        animation: floatParticles 60s infinite linear;
    }

    .ocean-waves {
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(4,169,237,0.2) 100%);
        transform-origin: bottom center;
        animation: waveAnimation 8s infinite linear;
    }

    .ocean-bubbles::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle, rgba(255,255,255,0.6) 1px, transparent 1px),
                        radial-gradient(circle, rgba(255,255,255,0.4) 2px, transparent 2px),
                        radial-gradient(circle, rgba(255,255,255,0.3) 1.5px, transparent 1.5px);
        background-size: 30px 30px, 80px 80px, 50px 50px;
        background-position: 0 0, 30px 30px, 60px 60px;
        animation: bubbleAnimation 30s infinite linear;
    }

    @keyframes waveAnimation {
        0% {
            transform: translateY(0) scaleY(1);
        }
        50% {
            transform: translateY(-20px) scaleY(1.1);
        }
        100% {
            transform: translateY(0) scaleY(1);
        }
    }

    @keyframes floatParticles {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 500px 500px;
        }
    }

    @keyframes bubbleAnimation {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(-500px);
        }
    }
</style>

@endsection
