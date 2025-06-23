@extends('layouts.app')

@section('title', $community->nama_komunitas)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Latar Belakang Animasi Laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>


    <header class="relative h-[70vh] overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ asset('storage/' . $community->gambar) }}"
                 alt="{{ $community->nama_komunitas }}"
                 class="w-full h-full object-cover" />
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900/80 via-cyan-800/70 to-teal-900/70"></div>
            <div class="ocean-depth-rays absolute inset-0"></div>
        </div>

        <!-- Notifikasi (Toast Messages) -->
        <div class="container mx-auto px-4 pt-6 relative z-10">
            @if(session('success'))
                <div class="bg-gradient-to-r from-green-500/90 to-emerald-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 notification-toast">
                    <div class="flex items-center p-4">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">{{ session('success') }}</div>
                        <button type="button" class="text-white hover:text-white/80 close-notification">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-gradient-to-r from-red-500/90 to-rose-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 notification-toast">
                    <div class="flex items-center p-4">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">{{ session('error') }}</div>
                        <button type="button" class="text-white hover:text-white/80 close-notification">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-gradient-to-r from-blue-500/90 to-indigo-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 notification-toast">
                    <div class="flex items-center p-4">
                        <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">{{ session('info') }}</div>
                        <button type="button" class="text-white hover:text-white/80 close-notification">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endif
        </div>
            <div class="container mx-auto px-4 h-full flex flex-col xl:pt-6 justify-center relative z-10">
                <div class="max-w-4xl">
                    <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-2 mb-4">
                        <div class="w-2 h-2 bg-cyan-300 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-cyan-100 font-medium">Komunitas Kelautan</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-white words-reveal">
                        <span class="word">{{ $community->nama_komunitas }}</span>
                    </h1>

                    <p class="text-lg text-cyan-100 mb-6 max-w-2xl">
                        {!! Str::limit(strip_tags($community->deskripsi), 150) !!}
                        @if(strlen(strip_tags($community->deskripsi)) > 150)
                            <button data-bs-toggle="modal" data-bs-target="#descriptionModal" class="text-cyan-300 hover:text-white transition-colors font-medium">
                                Baca selengkapnya <i class="fas fa-angle-right ml-1"></i>
                            </button>
                        @endif
                    </p>

                    <div class="flex flex-wrap gap-3 mt-4">
                        <div class="bg-white/90 backdrop-blur-xl text-cyan-700   px-4 py-2 rounded-full flex items-center">
                            <i class="fas fa-users mr-2"></i>
                            <span>{{ $community->users->count() }} anggota</span>
                        </div>
                        <div class="bg-white-50 backdrop-blur-xl text-cyan-700 px-4 py-2 rounded-full flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span>Dibuat {{ App\Helpers\IndonesiaTimeHelper::formatDate($community->created_at)}}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4 items-center mt-8">
                      @auth
    @if(auth()->user() && auth()->user()->is_admin == 0 && auth()->user()->banned_at !== null)
<div class="flex flex-col sm:flex-row gap-8 justify-center">
    <div class="bg-gradient-to-r from-red-100 to-red-50 border-2 border-red-400 text-red-700 px-4 py-2 rounded-2xl font-bold text-center flex items-center justify-center text-xl shadow-lg backdrop-blur-sm">
        <div class="bg-red-200 p- rounded-full mr-4 flex-shrink-0">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <div>
            <div class="text-base">Akun Anda Telah Diblokir</div>
        </div>
    </div>
</div>
    @elseif(Auth::user()->isAdmin())
        <a href="{{ route('admin.communities.edit', $community) }}" class="group bg-gray-100/20 hover:bg-gray-100 backdrop-blur-lg border border-white/50 text-white hover:text-cyan-700 px-6 py-3 rounded-full font-medium transition-all duration-300 flex items-center">
            <i class="fas fa-edit mr-2"></i> Edit Komunitas
        </a>
    @elseif($isMember)
        <form action="{{ route('communities.leave', $community) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar dari komunitas ini?');" class="group bg-red-500/80 hover:bg-red-600/90 backdrop-blur-sm border border-red-400/50 text-white px-6 py-3 rounded-full font-medium transition-all duration-300 flex items-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Keluar dari Komunitas
            </button>
        </form>
    @else
        <a href="{{ route('communities.join.show', $community) }}" class="group bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-8 py-3 rounded-full font-bold transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-cyan-500/25 flex items-center pulse-animation">
            <i class="fas fa-sign-in-alt mr-2"></i> Gabung Komunitas
            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    @endif
@else
    <a href="{{ route('login') }}?redirect=community/{{ $community->community_id }}" class="group bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-8 py-3 rounded-full font-bold transition-all duration-300 shadow-xl flex items-center">
        <i class="fas fa-sign-in-alt mr-2"></i> Login untuk bergabung
    </a>
@endauth
                    </div>
                </div>
            </div>
        <div class="absolute bottom-0 min-h-[20vh] left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                <path fill="#f8fafc" fill-opacity="1" d="M0,160L48,149.3C96,139,192,117,288,122.7C384,128,480,160,576,186.7C672,213,768,235,864,224C960,213,1056,171,1152,154.7C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </header>

    <main class="container mx-auto px-4 py-12 relative z-10">
        @if(Auth::check() && $isModeratorOrAdmin)
    <section class="mb-12 fade-in-up animate-on-scroll">
        <div class="bg-gradient-to-r from-blue-50 to-cyan-100 rounded-2xl p-6 border-l-4 border-blue-500 shadow-lg">
            <h2 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Panel Moderator
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('communities.chat', $community) }}" class="group bg-gradient-to-r from-blue-500 to-cyan-600 hover:from-blue-600 hover:to-cyan-700 text-white px-5 py-4 rounded-xl font-medium transition-all duration-300 shadow-md flex items-center justify-center">
                    <i class="fas fa-comments mr-2"></i> Obrolan Admin
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <a href="{{ route('communities.moderation', $community) }}" class="group bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-5 py-4 rounded-xl font-medium transition-all duration-300 shadow-md flex items-center justify-center">
                    <i class="fas fa-gavel mr-2"></i> Dasbor Moderasi
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>

                <a href="{{ route('admin.communities.initiatives.create', $community) }}" class="group bg-gradient-to-r from-cyan-500 to-teal-500 hover:from-cyan-600 hover:to-teal-600 text-white px-5 py-4 rounded-xl font-medium transition-all duration-300 shadow-md flex items-center justify-center">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Inisiatif
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endif

        <div class="container mx-auto px-4 relative z-10">
       <section class="mb-16">
        <div class="border-b border-gray-200">
            <ul class="flex flex-wrap -mb-px text-lg font-medium text-center" id="communityTabs" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-blue-600 rounded-t-lg text-blue-600 active"
                            id="community-overview-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#community-overview"
                            type="button"
                            role="tab"
                            aria-controls="community-overview"
                            aria-selected="true">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            id="community-events-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#community-events"
                            type="button"
                            role="tab"
                            aria-controls="community-events"
                            aria-selected="false">
                        <i class="fas fa-calendar-alt mr-2"></i> Acara
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            id="community-initiatives-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#community-initiatives"
                            type="button"
                            role="tab"
                            aria-controls="community-initiatives"
                            aria-selected="false">
                        <i class="fas fa-water mr-2"></i> Inisiatif
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            id="community-members-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#community-members"
                            type="button"
                            role="tab"
                            aria-controls="community-members"
                            aria-selected="false">
                        <i class="fas fa-users mr-2"></i> Anggota
                    </button>
                </li>
            </ul>
        </div>
    </section>
</div>


            <div class="tab-content mt-8" id="communityTabContent">
                <div class="tab-pane fade show active" id="community-overview" role="tabpanel" aria-labelledby="community-overview-tab">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-8">
                            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-md p-8 fade-in-up animate-on-scroll">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tentang Komunitas
                                </h2>

                                <div class="prose prose-lg max-w-none text-gray-700">
                                    {!! $community->deskripsi !!}
                                </div>

                                <div class="mt-8 flex flex-wrap gap-4">
                                    <div class="bg-blue-50 rounded-lg px-4 py-3 flex items-center">
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-3">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Dibuat</p>
                                            <p class="font-semibold">{{ App\Helpers\IndonesiaTimeHelper::formatDate($community->created_at)}}</p>
                                        </div>
                                    </div>

                                    <div class="bg-teal-50 rounded-lg px-4 py-3 flex items-center">
                                        <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 mr-3">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Anggota</p>
                                            <p class="font-semibold">{{ $community->users->count() }}</p>
                                        </div>
                                    </div>

                                    <div class="bg-cyan-50 rounded-lg px-4 py-3 flex items-center">
                                        <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-600 mr-3">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Pesan</p>
                                            <p class="font-semibold">{{ $community->messages->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          @if($isMember || $isModeratorOrAdmin)
                            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-md overflow-hidden fade-in-up animate-on-scroll" style="animation-delay: 0.2s">
                                <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-6">
                                    <div class="flex justify-between items-center">
                                        <h2 class="text-2xl font-bold flex items-center">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            Obrolan Komunitas
                                        </h2>

                                        @if($isChatLocked)
                                            <span class="bg-amber-500 text-white text-sm font-bold px-4 py-2 rounded-full flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                                Obrolan Terkunci
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="p-6">
                                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-5 border border-blue-100 mb-6">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="font-semibold text-blue-800">Pesan Terbaru</h3>
                                            <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full flex items-center">
                                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-1 animate-pulse"></span>
                                                Live
                                            </span>
                                        </div>

                                        <div class="space-y-4">
                            @forelse($latestMessages as $message)
                                    <div class="flex items- start animate-fade-in-up">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 flex-shrink-0 {{ ($message->user && $message->user->isAdmin()) ? 'bg-red-200 text-red-700' : 'bg-blue-200 text-blue-600' }}">
                                    @if($message->user && $message->user->foto_profil)
                                                    <img src="{{ asset('storage/' . $message->user->foto_profil) }}" class="w-8 h-8 rounded-full" alt="{{ $message->user->nama }}">
                                            @else
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                                <div class="font-semibold text-sm text-gray-800">{{ $message->user ? $message->user->nama : 'Pengguna tidak ditemukan' }}</div>
                                                <p class="text-sm text-gray-600">{{ $message->isi_pesan }}</p>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">{{ App\Helpers\IndonesiaTimeHelper::diffForHumans($message->tgl_pesan) }} </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500 py-4">
                                        <p>Belum ada pesan dalam komunitas ini.</p>
                                    </div>
                                @endforelse
                                        </div>
                                    </div>

                                    <a href="{{ route('communities.chat', $community) }}" class=" bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white w-full py-3 rounded-xl font-bold transition-all duration-300 shadow-md flex items-center justify-center">
                                        <i class="fas fa-comments mr-2"></i>
                                        Buka Obrolan Komunitas
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-md overflow-hidden fade-in-up animate-on-scroll" style="animation-delay: 0.2s">
                                <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-6">
                                    <h2 class="text-2xl font-bold flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        Bergabunglah untuk Berpartisipasi
                                    </h2>
                                </div>

                                <div class="p-8 text-center">
                                    <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>

                                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Bergabunglah dengan komunitas ini untuk berpartisipasi</h3>
                                    <p class="text-lg text-gray-600 mb-8">Terhubung dengan sesama pecinta laut, ikut diskusi, dan akses sumber daya eksklusif komunitas.</p>

                                 @auth
                            @if(auth()->user() && auth()->user()->is_admin == 0 && auth()->user()->banned_at !== null)
                                <div class="flex flex-col sm:flex-row gap-8 justify-center">
                                    <div class="bg-gradient-to-r from-blue-100 to-blue-50 border-2 border-sky-400 text-blue-700 px-4 py-2 rounded-2xl font-bold text-center flex items-center justify-center text-xl shadow-lg backdrop-blur-sm">
                                        <div class="bg-sky-200 p- rounded-full mr-4 flex-shrink-0">
                                            <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-base">Chat Diblokir</div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('communities.join.show', $community) }}" class="inline-flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all duration-300 shadow-md">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Gabung Sekarang
                                </a>
                            @endif
                        @else
                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="{{ route('login') }}?redirect=community/{{ $community->community_id }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 shadow-md inline-flex items-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login untuk bergabung
                                </a>

                                <a href="{{ route('register') }}?redirect=community/{{ $community->community_id }}" class="bg-white text-blue-600 border-2 border-blue-200 hover:border-blue-400 hover:bg-blue-50 px-6 py-3 rounded-xl font-bold transition-all duration-300 inline-flex items-center">
                                    <i class="fas fa-user-plus mr-2"></i> Daftar
                                </a>
                            </div>
                        @endauth
                         </div>
                            </div>
                            @endif
                        </div>


                        <div class="space-y-8">
                            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-md overflow-hidden fade-in-up animate-on-scroll">
                                <div class="bg-gradient-to-r from-cyan-600 to-sky-600 text-white p-6">
                                    <h3 class="text-xl font-bold flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        Inisiatif Unggulan
                                    </h3>
                                </div>

                                <div class="p-6">
                                    @if($community->initiatives->count() > 0)
                                        @php $featured = $community->initiatives->first(); @endphp
                                        <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-5 border border-purple-100 hover:shadow-md transition-all">
                                            <h4 class="font-bold text-gray-900 text-lg mb-3">{{ $featured->judul }}</h4>
                                            <p class="text-gray-600 mb-4">{{ Str::limit($featured->deskripsi, 120) }}</p>

                                        </div>
                                    @else
                                        <div class="text-center text-gray-500 py-4">
                                            <p>Belum ada inisiatif yang ditambahkan.</p>
                                            @if(Auth::check() && $isModeratorOrAdmin)
                                                <a href="{{ route('admin.communities.initiatives.create', $community) }}" class="inline-flex items-center mt-2 text-indigo-600 hover:text-indigo-800">
                                                    <i class="fas fa-plus-circle mr-1"></i>
                                                    Tambahkan inisiatif
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>


                                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-md overflow-hidden fade-in-up animate-on-scroll" style="animation-delay: 0.2s">
                                    <div class="bg-gradient-to-r from-blue-400 to-teal-500 text-white p-6">
                                        <h3 class="text-xl font-bold flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Acara Mendatang
                                        </h3>
                                    </div>

                                <div class="p-6">
                                    @if($isMember || $isModeratorOrAdmin)
                                    @if($events->count() > 0)
                                        @php $nextEvent = $events->first(); @endphp
                                        <div class="bg-gradient-to-br from-blue-50 to-teal-50 rounded-xl p-5 border border-blue-100 hover:shadow-md transition-all">
                                            <div class="flex items-start">
                                                <div class="bg-gradient-to-br from-blue-400 to-teal-500 text-white rounded-xl w-16 h-16 flex flex-col items-center justify-center mr-4 flex-shrink-0 shadow-md">
                                                    <span class="text-xl font-bold">{{ \Carbon\Carbon::parse($nextEvent->event_date)->format('d') }}</span>
                                                    <span class="text-xs">{{ \Carbon\Carbon::parse($nextEvent->event_date)->format('M') }}</span>
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-gray-900 mb-1">{{ $nextEvent->title }}</h4>
                                                    <p class="text-sm text-gray-600 mb-2">{{ Str::limit($nextEvent->description, 80) }}</p>
                                                    <div class="items-center text-xs text-teal-700 bg-teal-100 px-2 py-1 rounded-full inline-flex">
                                                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $nextEvent->location }}
                                                    </div>
                                                </div>
                                            </div>
                                            <<div class="mt-4 flex justify-end">
                                            <a href="{{ route('communities.events', $community) }}" class="text-teal-600 hover:text-teal-800 font-medium flex items-center text-sm">
                                            Lihat semua acara
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                            </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center text-gray-500 py-4">
                                            <p>Tidak ada acara mendatang.</p>
                                            @if(Auth::check() && $isModeratorOrAdmin)
                                                <a href="{{ route('communities.events.create', $community) }}" class="inline-flex items-center mt-2 text-teal-600 hover:text-teal-800">
                                                    <i class="fas fa-plus-circle mr-1"></i>
                                                    Tambahkan acara
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                             @else
                                   <div class="bg-gradient-to-br from-blue-50 to-teal-50 rounded-xl p-6 border border-blue-100 text-center relative overflow-hidden">

                                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-100 rounded-full opacity-40"></div>
                                            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-100 rounded-full opacity-40"></div>

                                            <div class="w-16 h-16 mx-auto bg-gradient-to-br from-teal-400 to-blue-500 rounded-full flex items-center justify-center mb-4 relative z-10">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                            </div>

                                            <h3 class="text-xl font-bold text-gray-800 mb-2 relative z-10">Konten Eksklusif</h3>
                                            <p class="text-gray-600 mb-6 relative z-10">Gabung dengan komunitas untuk melihat semua acara mendatang</p>

                                            <a href="{{ route('communities.join.show', $community) }}" class="inline-flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-2 rounded-full font-bold transition-all duration-300 shadow-md relative z-10 pulse-animation">
                                                <i class="fas fa-sign-in-alt mr-2"></i> Gabung Komunitas
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                                </div>


                            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-md overflow-hidden fade-in-up animate-on-scroll " style="animation-delay: 0.4s">
                                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6">
                                    <h3 class="text-xl font-bold flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Anggota ({{ $community->users->count() }})
                                    </h3>
                                </div>

                                <div class="p-6">
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach($community->users->take(8) as $member)
                                            <div class="relative group" title="{{ $member->nama }}">
                                                @if($member->foto_profil)
                                                    <img src="{{ asset('storage/' . $member->foto_profil) }}"
                                                         class="w-12 h-12 rounded-full object-cover border-2 border-white"
                                                         alt="{{ $member->nama }}">
                                                @else
                                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white">
                                                        {{ strtoupper(substr($member->nama, 0, 1)) }}
                                                    </div>
                                                @endif
                                                @if($member->isAdmin())
                                                    <div class="absolute -bottom-1 -right-1 bg-red-500 rounded-full w-4 h-4 border-2 border-white"></div>
                                                @elseif($member->pivot->role == 'moderator')
                                                    <div class="absolute -bottom-1 -right-1 bg-amber-500 rounded-full w-4 h-4 border-2 border-white"></div>
                                                @endif
                                            </div>
                                        @endforeach

                                        @if($community->users->count() > 8)
                                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-medium">
                                                +{{ $community->users->count() - 8 }}
                                            </div>
                                        @endif
                                    </div>

                                    <button class="w-full text-center text-indigo-600 hover:text-indigo-800 font-medium py-2" onclick="window.location.href='{{ route('communities.members', $community) }}'">
                                    Lihat semua anggota
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Events Tab -->
            <div class="tab-pane fade" id="community-events" role="tabpanel" aria-labelledby="community-events-tab">
            <div class="tab-pane fade" id="community-events" role="tabpanel" aria-labelledby="community-events-tab">
            <div class="mx-auto py-8">
                    <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Acara Komunitas</h2>

                    @if(Auth::check() && $isModeratorOrAdmin)
                        <a href="{{ route('communities.events.create', $community) }}" class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-4 py-2 rounded-lg font-medium transition-all shadow flex items-center">
                            <i class="fas fa-plus mr-2"></i> Tambah Acara
                        </a>
                    @endif
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($events as $event)
                            <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-lg">

                            <div class="bg-gradient-to-r from-blue-400 to-teal-500 text-white p-5 relative">
                                <div class="flex justify-between items-start">
                                    <div class="flex items-start flex-1 pr-3">
                                        <div class="bg-white/20 backdrop-blur-sm rounded-lg py-2 px-3 text-center mr-3 min-w-[50px]">
                                            <span class="text-xl font-bold block">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                            <span class="text-xs uppercase tracking-wider">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                                        </div>
                                        <h4 class="font-bold text-lg leading-tight break-words">{{ $event->title }}</h4>
                                    </div>

                                    @if(Auth::check() && $isModeratorOrAdmin)
                                    <div class="dropdown flex-shrink-0">
                                        <button class="bg-white/20 rounded-full w-8 h-8 flex items-center justify-center hover:bg-white/30 transition-colors" 
                                            type="button" 
                                            id="eventMenu{{ $event->event_id }}" 
                                            data-bs-toggle="dropdown" 
                                            aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 z-50" aria-labelledby="eventMenu{{ $event->event_id }}">
                                            <li>
                                                <li>
                                                <a href="{{ route('communities.events.edit', ['community' => $community, 'event' => $event]) }}" 
                                                class="dropdown-item flex items-center py-2 px-4">
                                                    <i class="fas fa-edit w-5 text-blue-600"></i> Edit
                                                </a>
                                            </li>
                                            </li>
                                            <li>
                                                <form action="{{ route('communities.events.delete', ['community' => $community, 'event' => $event]) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item flex items-center py-2 px-4 text-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus acara ini?');">
                                                        <i class="fas fa-trash w-5"></i> Hapus
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>

                                <div class="p-5">
                                    <p class="text-gray-600 mb-4">{{ $event->description }}</p>

                                    <div class="flex flex-wrap gap-2 text-sm">
                                        @if($event->start_time && $event->end_time)
                                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full flex items-center">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ $event->start_time }} - {{ $event->end_time }}
                                            </span>
                                        @endif

                                        @if($event->location)
                                            <span class="bg-teal-100 text-teal-700 px-3 py-1 rounded-full flex items-center">
                                                <i class="fas fa-map-marker-alt mr-1"></i>
                                                {{ $event->location }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($isMember || $isModeratorOrAdmin)
                                        <div class="mt-5 flex justify-end">
                                            <button class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all">
                                                <i class="far fa-calendar-plus mr-1"></i> Tambahkan ke Kalender
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-8 text-center">
                                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="far fa-calendar-times text-blue-500 text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-medium text-gray-800 mb-2">Tidak ada acara mendatang</h3>
                                    <p class="text-gray-600">Belum ada acara yang dijadwalkan untuk komunitas ini.</p>

                                    @if(Auth::check() && $isModeratorOrAdmin)
                                        <div class="mt-6">
                                            <a href="{{ route('communities.events.create', $community) }}" class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-5 py-2 rounded-lg font-medium transition-all shadow inline-flex items-center">
                                                <i class="fas fa-plus mr-2"></i> Tambahkan Acara Pertama
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

                <!-- Initiatives Tab -->
             <div class="tab-pane fade py-8" id="community-initiatives" role="tabpanel" aria-labelledby="community-initiatives-tab">
                <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Inisiatif Komunitas</h2>

        @if(Auth::check() && $isModeratorOrAdmin)
            <a href="{{ route('admin.communities.initiatives.create', $community) }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-all shadow flex items-center">
                <i class="fas fa-plus mr-2"></i> Tambah Inisiatif
            </a>
        @endif
    </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-5">
          @forelse($community->initiatives as $initiative)
           <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-lg">
                    @php
                        // Theme-based gradient backgrounds
                        $gradientBg = 'from-cyan-600 to-blue-700'; // Default blue ocean theme
                        
                        // Match icon to appropriate gradient background
                        switch ($initiative->icon) {
                            case 'air':
                                $gradientBg = 'from-cyan-600 to-blue-700'; // Water
                                break;
                            case 'ikan':
                                $gradientBg = 'from-blue-500 to-indigo-600'; // Fish
                                break;
                            case 'terumbuhkarang':
                                $gradientBg = 'from-teal-500 to-emerald-600'; // Coral reef
                                break;
                            case 'alga':
                                $gradientBg = 'from-green-500 to-teal-600'; // Algae
                                break;
                            case 'plankton':
                                $gradientBg = 'from-emerald-400 to-teal-600'; // Plankton
                                break;
                            case 'limbahlaut':
                                $gradientBg = 'from-red-500 to-pink-600'; // Ocean waste
                                break;
                            case 'hewanlangkah':
                                $gradientBg = 'from-indigo-500 to-purple-600'; // Endangered animals
                                break;
                            case 'lautdalam':
                                $gradientBg = 'from-blue-700 to-blue-900'; // Deep ocean
                                break;
                            case 'pesisir':
                                $gradientBg = 'from-amber-500 to-orange-500'; // Coastal
                                break;
                        }
                    @endphp
                    <div class="bg-gradient-to-r {{ $gradientBg }} text-white p-4 relative overflow-hidden">
                        <!-- Decorative elements -->
                        <div class="absolute top-0 right-0 w-16 h-16 bg-white/10 rounded-full -mt-6 -mr-6"></div>
                        <div class="absolute bottom-0 left-0 w-12 h-12 bg-white/10 rounded-full -mb-6 -ml-6"></div>

                        <h4 class="font-bold text-base relative z-10">{{ $initiative->judul }}</h4>
                    </div>

                    <div class="p-4 flex flex-col h-[calc(100%-4rem)]">
                        <div class="flex items-center mb-3">
                            @php
                                $iconClass = 'fas fa-water'; // Default icon
                                $iconBg = 'from-cyan-100 to-blue-100'; // Default background
                                $iconColor = 'text-cyan-600'; // Default icon color
                                
                                // Map initiative icon values to appropriate FontAwesome icons
                                $iconMapping = [
                                    'air' => [
                                        'icon' => 'fas fa-water',
                                        'bg' => 'from-cyan-100 to-blue-100',
                                        'color' => 'text-cyan-600'
                                    ],
                                    'ikan' => [
                                        'icon' => 'fas fa-fish',
                                        'bg' => 'from-blue-100 to-indigo-100',
                                        'color' => 'text-blue-600'
                                    ],
                                    'terumbuhkarang' => [
                                        'icon' => 'fas fa-tree',
                                        'bg' => 'from-teal-100 to-emerald-100',
                                        'color' => 'text-teal-600'
                                    ],
                                    'alga' => [
                                        'icon' => 'fas fa-seedling',
                                        'bg' => 'from-green-100 to-teal-100',
                                        'color' => 'text-green-600'
                                    ],
                                    'plankton' => [
                                        'icon' => 'fas fa-bacteria',
                                        'bg' => 'from-emerald-100 to-teal-100',
                                        'color' => 'text-emerald-600'
                                    ],
                                    'limbahlaut' => [
                                        'icon' => 'fas fa-trash-alt',
                                        'bg' => 'from-red-100 to-pink-100',
                                        'color' => 'text-red-600'
                                    ],
                                    'hewanlangkah' => [
                                        'icon' => 'fas fa-paw',
                                        'bg' => 'from-indigo-100 to-purple-100',
                                        'color' => 'text-indigo-600'
                                    ],
                                    'lautdalam' => [
                                        'icon' => 'fas fa-water',
                                        'bg' => 'from-blue-200 to-blue-100',
                                        'color' => 'text-blue-700'
                                    ],
                                    'pesisir' => [
                                        'icon' => 'fas fa-umbrella-beach',
                                        'bg' => 'from-amber-100 to-orange-100',
                                        'color' => 'text-amber-600'
                                    ],
                                ];
                                
                                // Look up the icon in the mapping if it exists
                                if ($initiative->icon && isset($iconMapping[$initiative->icon])) {
                                    $iconClass = $iconMapping[$initiative->icon]['icon'];
                                    $iconBg = $iconMapping[$initiative->icon]['bg'];
                                    $iconColor = $iconMapping[$initiative->icon]['color'];
                                }
                                
                                // Animation class based on icon type
                                $animationClass = '';
                                if (in_array($initiative->icon, ['air', 'lautdalam'])) {
                                    $animationClass = 'icon-water-animation';
                                } elseif ($initiative->icon == 'ikan') {
                                    $animationClass = 'icon-fish-animation';
                                } elseif (in_array($initiative->icon, ['alga', 'plankton', 'terumbuhkarang'])) {
                                    $animationClass = 'icon-growth-animation';
                                } else {
                                    $animationClass = 'icon-pulse-animation';
                                }
                            @endphp
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br {{ $iconBg }} flex items-center justify-center {{ $iconColor }} mr-3 shadow-sm relative overflow-hidden {{ $animationClass }}">
                                <i class="{{ $iconClass }} text-sm relative z-10"></i>
                            </div>
                            <div>
                                <span class="bg-cyan-100 text-cyan-700 px-2 py-0.5 rounded-full text-xs font-medium inline-flex items-center">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ App\Helpers\IndonesiaTimeHelper::formatDate($initiative->created_at) }}
                                </span>
                            </div>
                        </div>

                        <p class="text-gray-600 text-sm mb-3 ">{{ $initiative->deskripsi }}</p>

                        <div class="flex items-center justify-between mt-auto">
                            @if(Auth::check() && $isModeratorOrAdmin)
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('admin.communities.initiatives.edit', ['community' => $community, 'initiative' => $initiative]) }}" class="text-cyan-600 hover:text-cyan-800 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.communities.initiatives.destroy', ['community' => $community, 'initiative' => $initiative]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors" onclick="return confirm('Apakah Anda yakin ingin menghapus inisiatif ini?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 shadow-inner">
                            <i class="fas fa-water text-blue-500 text-xl"></i>
                        </div>
                        <h3 class="text-xl font-medium text-gray-800 mb-2">Belum ada inisiatif</h3>
                        <p class="text-gray-600 max-w-md mx-auto text-sm">Belum ada inisiatif konservasi laut yang dibuat untuk komunitas ini.</p>

                        @if(Auth::check() && $isModeratorOrAdmin)
                            <div class="mt-5">
                                <a href="{{ route('admin.communities.initiatives.create', $community) }}" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-5 py-2 rounded-lg font-medium transition-all shadow-md inline-flex items-center animate-pulse">
                                    <i class="fas fa-plus mr-2"></i> Tambahkan Inisiatif Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="tab-pane fade py-8" id="community-members" role="tabpanel" aria-labelledby="community-members-tab">
    @if(Auth::check() && ($isMember || $isModeratorOrAdmin))
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach($community->users as $member)
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-4 flex items-center hover:shadow-lg transition-shadow">
                    @if($member->foto_profil)
                        <img src="{{ asset('storage/' . $member->foto_profil) }}" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200 mr-4" alt="{{ $member->nama }}">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white font-bold text-xl mr-4">
                            {{ strtoupper(substr($member->nama, 0, 1)) }}
                        </div>
                    @endif

                    <div class="flex-1">
                        <h4 class="font-bold text-gray-900">{{ $member->nama }}</h4>
                        <p class="text-sm text-gray-500">Bergabung {{ App\Helpers\IndonesiaTimeHelper::formatDate($member->pivot->tg_gabung) }}</p>

                        <div class="mt-2 flex flex-wrap gap-2">
                            @if($member->isAdmin())
                                <div class="absolute -bottom-1 -right-1 bg-red-500 rounded-full w-4 h-4 border-2 border-white"></div>
                            @elseif($member->pivot->role == 'moderator')
                                <div class="absolute -bottom-1 -right-1 bg-amber-500 rounded-full w-4 h-4 border-2 border-white"></div>
                            @endif
                        </div>
                    </div>

                    @if(Auth::check() && $isModeratorOrAdmin && !$member->isAdmin())
                        <div class="dropdown">
                            <button class="text-gray-400 hover:text-gray-600 dropdown-toggle" type="button" id="memberMenu{{ $member->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="memberMenu{{ $member->id }}">
                                @if($member->pivot->role == 'moderator' || $member->pivot->role == 'admin')
                                    <li>
                                        <form action="{{ route('communities.demote-moderator', ['community' => $community, 'user' => $member]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-amber-600" onclick="return confirm('Apakah Anda yakin ingin menghapus moderator ini?');">
                                                <i class="fas fa-user-minus mr-2"></i> Hapus sebagai Moderator
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form action="{{ route('communities.promote-moderator', ['community' => $community, 'user' => $member]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-amber-600">
                                                <i class="fas fa-user-shield mr-2"></i> Jadikan Moderator
                                            </button>
                                        </form>
                                    </li>
                                @endif

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('communities.ban-user', ['community' => $community, 'user' => $member]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-red-600" onclick="return confirm('Apakah Anda yakin ingin mengeluarkan anggota ini dari komunitas?');">
                                            <i class="fas fa-ban mr-2"></i> Keluarkan dari Komunitas
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        @if($community->users->count() > 18)
            <div class="mt-8 flex justify-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item {{ $community->users->currentPage() == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $community->users->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        @for($i = 1; $i <= $community->users->lastPage(); $i++)
                            <li class="page-item {{ $community->users->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $community->users->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="page-item {{ $community->users->currentPage() == $community->users->lastPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $community->users->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    @else
        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-8 text-center">
            <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Konten Eksklusif untuk Anggota</h3>
            <p class="text-lg text-gray-600 mb-8">Daftar anggota hanya tersedia untuk anggota komunitas ini.</p>

            <a href="{{ route('communities.join.show', $community) }}" class="inline-flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all duration-300 shadow-md">
                <i class="fas fa-sign-in-alt mr-2"></i> Gabung Sekarang
            </a>
        </div>
    @endif
</div>
            </div>
        </div>
    </main>
    @endsection
    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.close-notification').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.notification-toast').remove();
                });
            });


            @if(Auth::check() && $isModeratorOrAdmin)
            const editEventModal = document.getElementById('editEventModal');
            if (editEventModal) {
                editEventModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const eventId = button.getAttribute('data-event-id');
                    const eventTitle = button.getAttribute('data-event-title');
                    const eventDescription = button.getAttribute('data-event-description');
                    const eventDate = button.getAttribute('data-event-date');
                    const eventStart = button.getAttribute('data-event-start');
                    const eventEnd = button.getAttribute('data-event-end');
                    const eventLocation = button.getAttribute('data-event-location');

                    const form = document.getElementById('editEventForm');
                    form.action = `/communities/{{ $community->community_id }}/events/${eventId}/update`;

                    document.getElementById('editEventId').value = eventId;
                    document.getElementById('editEventTitle').value = eventTitle;
                    document.getElementById('editEventDescription').value = eventDescription;
                    document.getElementById('editEventDate').value = eventDate;
                    document.getElementById('editEventLocation').value = eventLocation;

                    if (eventStart) document.getElementById('editEventStart').value = eventStart;
                    if (eventEnd) document.getElementById('editEventEnd').value = eventEnd;
                });
            }
            @endif


           const communityTabs = document.querySelectorAll('#communityTabs button');

        communityTabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                const targetTab = this.getAttribute('data-bs-target');
                const tabContent = document.querySelector(targetTab);

                setTimeout(() => {
                    // Smooth scroll to the section
                    tabContent.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start',
                        inline: 'nearest'
                    });
                }, 150);
            });
        });

        if (window.location.hash) {
            const targetTabId = window.location.hash.replace('#', '') + '-tab';
            const targetTab = document.getElementById(targetTabId);

            if (targetTab) {
                setTimeout(() => {
                    targetTab.click();
                }, 300);
            }
        }

        document.querySelectorAll('a[href^="#community-"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1) + '-tab';
                const targetTab = document.getElementById(targetId);

                if (targetTab) {
                    targetTab.click();
                }
            });
        });

        document.querySelectorAll('.close-notification').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.notification-toast').remove();
            });
        });

        @if(Auth::check() && $isModeratorOrAdmin)
        const editEventModal = document.getElementById('editEventModal');
        if (editEventModal) {
            editEventModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const eventId = button.getAttribute('data-event-id');
                const eventTitle = button.getAttribute('data-event-title');
                const eventDescription = button.getAttribute('data-event-description');
                const eventDate = button.getAttribute('data-event-date');
                const eventStart = button.getAttribute('data-event-start');
                const eventEnd = button.getAttribute('data-event-end');
                const eventLocation = button.getAttribute('data-event-location');}
        @endif

        });
    </script>
</div>
@endsection
@section('styles')
<style>
    /* Ocean animations for header background */
    .ocean-depth-rays {
        background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(255,255,255,0.05) 50%);
        background-size: 100% 20px;
        opacity: 0.3;
        animation: rays 8s linear infinite;
    }

    .floating-particles::before,
    .floating-particles::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.2;
    }

    .floating-particles::before {
        animation: floatParticles 20s linear infinite;
    }

    .floating-particles::after {
        background-size: 20px 20px;
        animation: floatParticles 15s linear infinite reverse;
    }

    .ocean-waves {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='rgba(255,255,255,0.2)'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: cover;
        animation: waveAnimation 20s linear infinite alternate;
    }

    .ocean-bubbles {
        background-image: radial-gradient(circle, rgba(255,255,255,0.6) 2px, transparent 2px),
                        radial-gradient(circle, rgba(255,255,255,0.4) 1px, transparent 1px);
        background-size: 50px 50px, 30px 30px;
        animation: bubbleRise 15s linear infinite;
        opacity: 0.2;
    }

    .underwater-current {
        background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0) 100%);
        animation: underwaterCurrent 8s ease-in-out infinite;
    }

    @keyframes rays {
        0% { background-position: 0 0; }
        100% { background-position: 0 20px; }
    }

    @keyframes waveAnimation {
        0% { transform: translateX(-50px); }
        50% { transform: translateY(15px); }
        100% { transform: translateX(50px) translateY(-15px); }
    }

    @keyframes floatParticles {
        0% { transform: translateY(0) translateX(0); }
        25% { transform: translateY(-15px) translateX(15px); }
        50% { transform: translateY(-25px) translateX(0); }
        75% { transform: translateY(-10px) translateX(-15px); }
        100% { transform: translateY(0) translateX(0); }
    }

    @keyframes bubbleRise {
        from { background-position: 0 0, 0 0; }
        to { background-position: 0 -100px, 0 -50px; }
    }

    @keyframes underwaterCurrent {
        0%, 100% { opacity: 0.05; transform: translateX(-100%); }
        50% { opacity: 0.15; transform: translateX(100%); }
    }

    /* Title animation */
    .words-reveal .word {
        display: inline-block;
        animation: fadeInUp 1.2s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Pulse animation for call-to-action buttons */
    .pulse-animation {
        animation: subtle-pulse 2s infinite;
    }

    @keyframes subtle-pulse {
        0% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(14, 165, 233, 0); }
        100% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0); }
    }



    .dropdown {
        position: relative;
    }
    
    .dropdown-menu {
        position: absolute;
        right: 0;
        top: 100%;
        min-width: 10rem;
        padding: 0.5rem 0;
        border-radius: 0.375rem;
        background-color: white;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        z-index: 1000;
        display: none;
    }
    
    .dropdown-menu.show {
        display: block;
    }
    
    .dropdown-item {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 0.5rem 1rem;
        clear: both;
        font-weight: 500;
        text-align: inherit;
        white-space: nowrap;
        border: 0;
        background-color: transparent;
        color: #374151;
        transition: all 0.15s ease;
    }
    
    .dropdown-item:hover, .dropdown-item:focus {
        background-color: rgba(59, 130, 246, 0.1);
        text-decoration: none;
    }
    
    /* Fix event title word break */
    .event-title {
        word-break: break-word;
        max-width: calc(100% - 60px);
    }
    
    /* Adjust flex layout for header to give more space to title */
    .event-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    
    .event-header-title {
        flex: 1;
        min-width: 0; /* Allow title to shrink properly */
        padding-right: 16px; /* Space between title and dropdown */
    }
    
    /* Initiative icon animations */
    .icon-water-animation::before {
        content: '';
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(
            to bottom,
            transparent,
            transparent 3px,
            rgba(255, 255, 255, 0.2) 3px,
            rgba(255, 255, 255, 0.2) 6px
        );
        opacity: 0.3;
        animation: waterWave 5s linear infinite;
    }
    
    @keyframes waterWave {
        0% { transform: translateY(0); }
        100% { transform: translateY(10px); }
    }
    
    .icon-fish-animation::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle, rgba(255, 255, 255, 0.2) 1px, transparent 2px);
        background-size: 6px 6px;
        opacity: 0.3;
        animation: fishBubbles 5s linear infinite;
    }
    
    @keyframes fishBubbles {
        0% { transform: translateY(0); opacity: 0.3; }
        50% { opacity: 0.6; }
        100% { transform: translateY(-10px); opacity: 0.3; }
    }
    
    .icon-growth-animation::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, transparent 30%, rgba(255, 255, 255, 0.2) 70%);
        transform-origin: center;
        opacity: 0.3;
        animation: pulseGrow 2s ease-in-out infinite;
    }
    
    @keyframes pulseGrow {
        0%, 100% { transform: scale(0.8); opacity: 0.2; }
        50% { transform: scale(1.2); opacity: 0.4; }
    }
    
    .icon-pulse-animation::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at center, rgba(255, 255, 255, 0.4), transparent);
        opacity: 0;
        animation: simplePulse 2s ease-in-out infinite;
    }
    
    @keyframes simplePulse {
        0%, 100% { opacity: 0.1; }
        50% { opacity: 0.4; }
    }

</style>
@endsection


@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Manually initialize all dropdowns
        const dropdownToggleList = document.querySelectorAll('.dropdown-toggle');
        const dropdowns = [];
        
        document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                event.stopPropagation();
                
                const dropdownMenu = element.nextElementSibling;
                if (dropdownMenu.classList.contains('show')) {
                    dropdownMenu.classList.remove('show');
                    element.setAttribute('aria-expanded', 'false');
                } else {
                    closeAllDropdowns();
                    
                    // Then open this one
                    dropdownMenu.classList.add('show');
                    element.setAttribute('aria-expanded', 'true');
                }
            });
        });
        
        document.addEventListener('click', function(e) {
            if (!e.target.matches('[data-bs-toggle="dropdown"]') && 
                !e.target.closest('.dropdown-menu') && 
                !e.target.closest('.fa-ellipsis-v')) {
                closeAllDropdowns();
            }
        });
        
        function closeAllDropdowns() {
            document.querySelectorAll('.dropdown-menu.show').forEach(function(menu) {
                menu.classList.remove('show');
                const toggle = menu.previousElementSibling;
                if (toggle) {
                    toggle.setAttribute('aria-expanded', 'false');
                }
            });
        }
        
        document.querySelectorAll('#communityTabs button').forEach(tab => {
            tab.addEventListener('click', function(e) {
                const targetTab = this.getAttribute('data-bs-target');
                const tabContent = document.querySelector(targetTab);
                
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.classList.remove('show', 'active');
                });
                
                tabContent.classList.add('show', 'active');
                
                document.querySelectorAll('#communityTabs button').forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-selected', 'false');
                });
                
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
            });
        });




         const tabButtons = document.querySelectorAll('#communityTabs button');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('data-bs-target');
            
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('show', 'active');
            });
            
            const targetPane = document.querySelector(targetId);
            if (targetPane) {
                targetPane.classList.add('show', 'active');
                
                setTimeout(() => {
                    const yOffset = -80; 
                    const y = targetPane.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({top: y, behavior: 'smooth'});
                }, 50);
            }
            
            tabButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-selected', 'false');
            });
            
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');
        });
    });
    
    if (window.location.hash) {
        const hash = window.location.hash;
        const tabId = hash.replace('#', '') + '-tab';
        const tab = document.getElementById(tabId);
        
        if (tab) {
            setTimeout(() => {
                tab.click();
            }, 300);
        }
    }
    
    document.querySelectorAll('a[href^="#community-"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetTabId = this.getAttribute('href').substring(1) + '-tab';
            const targetTab = document.getElementById(targetTabId);
            
            if (targetTab) {
                targetTab.click();
            }
        });
    });

    });
</script>
@endsection