
@extends('layouts.app')

@section('title', 'Komunitas Laut')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-100 to-teal-50 relative overflow-hidden">
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <section class="bg-gradient-to-br from-blue-500 via-blue-900 to-teal-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="bg-scroll-right absolute inset-0 bg-cover bg-no-repeat opacity-20" style="background-image: url('{{ asset('home/community.jpg') }}');"></div>
            <div class="deep-sea-bubbles opacity-30"></div>
            <div class="marine-light-rays"></div>
            <div class="floating-particles absolute inset-0"></div>
            <div class="wave-pattern absolute bottom-0 left-0 w-full h-20 opacity-30"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">
                <div class="text-center lg:text-left max-w-2xl">
                    <div class="inline-flex items-center bg-white/15 backdrop-blur-md rounded-full px-8 py-4 mb-8 animate-on-scroll border border-white/20">
                        <div class="w-4 h-4 bg-cyan-300 rounded-full mr-4 animate-pulse"></div>
                        <span class="text-cyan-100 font-semibold text-lg">Menghubungkan Pecinta Laut</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold mb-8 leading-tight text-reveal">
                        <span class="gradient-text-enhanced">Komunitas</span> Laut
                    </h1>

                    <p class="text-xl text-cyan-100 max-w-2xl leading-relaxed mb-10 text-reveal-delay-1">
                        Terhubung dengan komunitas yang berdedikasi untuk konservasi laut, penelitian kelautan, dan praktik berkelanjutan untuk melestarikan lautan kita bagi generasi mendatang.
                    </p>

                    <div class="grid grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-white/10 to-blue-400/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30 hover:border-cyan-300/50 hover:shadow-lg hover:shadow-cyan-300/20 transition-all duration-300 stat-counter overflow-hidden relative group">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-cyan-300/10 rounded-full group-hover:scale-150 transition-all duration-700"></div>
        <div class="text-4xl font-bold text-cyan-300 mb-2 counter" data-target="{{ $stats['total_communities'] }}">{{ $stats['total_communities'] }}</div>
        <div class="flex justify-center *:items-center gap-2">
            <span class="text-cyan-800 font-medium">Komunitas</span>
      </div>
    </div>
    <div class="bg-gradient-to-br from-white/10 to-blue-500/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30 hover:border-blue-300/50 hover:shadow-lg hover:shadow-blue-300/20 transition-all duration-300 stat-counter overflow-hidden relative group">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-blue-300/10 rounded-full group-hover:scale-150 transition-all duration-700"></div>
        <div class="text-4xl font-bold text-blue-300 mb-2 counter" data-target="{{ $stats['total_members'] }}"> {{ $stats['total_members'] }}</div>
        <div class="flex justify-center items-center gap-2">
              <span class="text-cyan-800 font-medium">Anggota</span>
       </div>
    </div>
    <div class="bg-gradient-to-br from-white/10 to-teal-400/20 backdrop-blur-sm rounded-2xl p-6 border border-white/30 hover:border-teal-300/50 hover:shadow-lg hover:shadow-teal-300/20 transition-all duration-300 stat-counter overflow-hidden relative group">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-teal-300/10 rounded-full group-hover:scale-150 transition-all duration-700"></div>
        <div class="text-4xl font-bold text-teal-300 mb-2 counter" data-target="{{ $stats['active_today'] }}"> {{ $stats['active_today'] }}</div>
        <div class="flex justify-center items-center gap-2">
            <span class="text-cyan-800 font-medium">Aktif Hari Ini</span>
        </div>
    </div>
</div>
                </div>

                <div class="flex flex-col gap-6 items-center">
                    @auth
                        <div class="relative backdrop-blur-xl bg-white/10 border border-white/20 p-8 rounded-3xl shadow-2xl w-full max-w-md">
                            <h3 class="text-2xl font-bold mb-6 text-center">Bergabung dengan Gerakan</h3>

                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard.community') }}" class="w-full bg-white/90 hover:bg-white text-blue-700 px-8 py-4 mb-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center group shadow-lg">
                                    <i class="fas fa-cog mr-3"></i>
                                    Kelola Komunitas
                                </a>
                            <a href="{{ route('admin.communities.create') }}" data-bs-toggle="modal" data-bs-target="#createCommunityModal"
                               class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center group shadow-lg shadow-green-500/30 transform hover:scale-105">
                                <i class="fas fa-plus mr-3"></i>
                                Buat Komunitas Anda
                            </a>
                           @endif
                            <div class="mt-6 text-center text-sm text-cyan-100">
                                Mulai membuat dampak untuk lautan kita hari ini
                            </div>
                        </div>
                    @else
                        <div class="relative backdrop-blur-xl bg-white/10 border border-white/20 p-8 rounded-3xl shadow-2xl w-full max-w-md">
                            <h3 class="text-2xl font-bold mb-6 text-center">Jadilah Anggota Komunitas</h3>
                            <p class="text-cyan-100 mb-6 text-center">Masuk untuk membuat komunitas Anda sendiri atau bergabung dengan komunitas yang sudah ada</p>
                            <a href="{{ route('login') }}"
                               class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 flex items-center justify-center shadow-lg shadow-blue-500/30 transform hover:scale-105">
                                <i class="fas fa-sign-in-alt mr-3"></i>
                                Masuk untuk Memulai
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="max-w-6xl mx-auto mb-12 -mt-16 animate-on-scroll">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-blue-100 p-8">
                <form action="{{ route('communities.index') }}" method="GET" class="space-y-6" id="filterForm">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <div class="flex-grow relative">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" class="w-full pl-16 pr-6 py-4 rounded-xl text-gray-800 bg-white/80 backdrop-blur-sm border-0 ring-2 ring-blue-100 focus:ring-4 focus:ring-blue-400/50 transition-all duration-300 text-lg font-medium"
                                   name="search" placeholder="{{ __('Cari komunitas laut...') }}" value="{{ request('search') }}"
                                   id="searchInput">
                        </div>

                        <div class="lg:w-64 relative">
                            <select name="sort" class="appearance-none w-full py-4 px-6 rounded-xl text-gray-800 bg-white/80 backdrop-blur-sm border-0 ring-2 ring-blue-100 focus:ring-4 focus:ring-blue-400/50 transition-all duration-300 text-lg font-medium"
                                    onchange="document.getElementById('filterForm').submit()">
                                <option value="users_count" {{ request('sort') == 'users_count' ? 'selected' : '' }}>{{ __('Anggota Terbanyak') }}</option>
                                <option value="activity" {{ request('sort') == 'activity' ? 'selected' : '' }}>{{ __('Paling Aktif') }}</option>
                                <option value="created" {{ request('sort') == 'created' ? 'selected' : '' }}>{{ __('Terbaru') }}</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('Nama A-Z') }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <button type="button" onclick="changeView('grid')"
                                    class="p-4 rounded-xl bg-white/80 backdrop-blur-sm ring-2 ring-blue-100 hover:bg-blue-50 view-btn active flex items-center justify-center"
                                    data-view="grid">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </button>
                            <button type="button" onclick="changeView('list')"
                                    class="p-4 rounded-xl bg-white/80 backdrop-blur-sm ring-2 ring-blue-100 hover:bg-blue-50 view-btn flex items-center justify-center"
                                    data-view="list">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <button type="button" class="quick-filter-btn active" data-filter="all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ __('Semua Komunitas') }}
                        </button>
                        <button type="button" class="quick-filter-btn" data-filter="trending">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                            {{ __('Populer') }}
                        </button>
                        <button type="button" class="quick-filter-btn" data-filter="new">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            {{ __('Baru') }}
                        </button>
                        @auth
                            <button type="button" class="quick-filter-btn" data-filter="joined">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('Komunitas Saya') }}
                            </button>
                        @endauth
                    </div>

                    <input type="hidden" name="order" value="{{ request('order', 'desc') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 12) }}">
                </form>
            </div>
        </div>

        @if($trendingCommunities->count() > 0 || $newestCommunities->count() > 0)
        <div class="max-w-6xl mx-auto mb-16 animate-on-scroll">
            <div class="text-center mb-8">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-bold">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"></path>
                    </svg>
                    Temukan Komunitas
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                    Temukan <span class="text-blue-600">Komunitas Laut</span> Anda
                </h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Terhubung dengan individu yang memiliki semangat sama tentang konservasi laut dan kehidupan laut
                </p>
            </div>

            <div class="flex items-center justify-center mb-8">
                <div class="inline-flex p-1 bg-gray-100 rounded-full">
                    <button class="carousel-nav-btn rounded-full px-6 py-2 active" onclick="showCarousel('trending')" id="trendingBtn">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                        {{ __('Populer') }}
                    </button>
                    <button class="carousel-nav-btn rounded-full px-6 py-2" onclick="showCarousel('newest')" id="newestBtn">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ __('Terbaru') }}
                    </button>
                </div>
            </div>


<div id="trendingCarousel" class="carousel-content">
    <div class="flex auto-scroll py-6 relative">
        @foreach($trendingCommunities as $community)
            <div class="flex-shrink-0 w-80 h-64 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 card-hover perspective-container bg-gradient-to-br from-cyan-50 to-blue-100 border border-blue-200 relative">
                @auth
                    @php
                        $isBanned = \App\Models\BanUsers::where('community_id', $community->community_id)
                            ->where('user_id', Auth::id())
                            ->first();
                            
                        $isMuted = \App\Models\MuteUsers::where('community_id', $community->community_id)
                            ->where('user_id', Auth::id())
                            ->where('unmute_at', '>', now())
                            ->first();
                    @endphp
                    
                    @if($isBanned || $isMuted)
                        <div class="absolute top-4 left-0 right-0 z-10 flex justify-center pointer-events-none">
                            <div class="{{ $isBanned ? 'bg-red-500/90' : 'bg-amber-500/90' }} text-white text-xs font-bold py-1 px-4 rounded-full shadow-lg border border-white/20 backdrop-blur-sm flex items-center gap-2 transform -rotate-2">
                                @if($isBanned)
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                    <span>Anda dilarang mengakses</span>
                                @else
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.465a5 5 0 001.42 7.072l.354.353a1 1 0 001.414 0l7.072-7.07a1 1 0 000-1.415l-.354-.354a5 5 0 00-7.072-1.42L5.586 15.464z"></path>
                                    </svg>
                                    <span>Anda dibisukan</span>
                                @endif
                            </div>
                        </div>
                    @endif
                @endauth
                
                <div class="p-6 h-full flex flex-col">
                    <div class="flex items-center gap-4 mb-4">
                        @if($community->gambar)
                            <img src="{{ asset('storage/' . $community->gambar) }}" class="w-16 h-16 rounded-2xl object-cover shine-effect" alt="{{ $community->nama_komunitas }}">
                        @else
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-2xl flex items-center justify-center shine-effect">
                                <i class="fas fa-users text-2xl text-white"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="font-bold text-lg text-gray-800 truncate">{{ $community->nama_komunitas }}</h4>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>{{ $community->users_count }} anggota</span>
                            </div>
                        </div>
                    </div>

                    @auth
                        @if(isset($isBanned) && $isBanned)
                            <div class="bg-red-50 border-l-3 border-red-400 px-3 py-2 rounded mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-xs text-red-700">Anda telah dibanned dari komunitas ini</p>
                            </div>
                        @elseif(isset($isMuted) && $isMuted)
                            <div class="bg-amber-50 border-l-3 border-amber-400 px-3 py-2 rounded mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.465a5 5 0 001.42 7.072l.354.353a1 1 0 001.414 0l7.072-7.07a1 1 0 000-1.415l-.354-.354a5 5 0 00-7.072-1.42L5.586 15.464z"></path>
                                </svg>
                                <p class="text-xs text-amber-700">Anda dibisukan hingga {{ $isMuted->unmute_at->format('d/m/Y') }}</p>
                            </div>
                        @else
                            <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                                {{ Str::limit(strip_tags($community->deskripsi), 100) }}
                            </p>
                        @endif
                    @else
                        <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($community->deskripsi), 100) }}
                        </p>
                    @endauth

                    <div class="flex items-center justify-between mt-auto">
                        <div class="flex items-center">
                            <div class="bg-cyan-500 text-white p-1 rounded-full">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-cyan-700 ml-1">Populer</span>
                        </div>

                        <a href="{{ route('communities.show', $community) }}" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md hover:shadow-lg transition-all duration-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            @auth
                                @if(isset($isBanned) && $isBanned)
                                    Detail
                                @else
                                    Lihat
                                @endif
                            @else
                                Lihat
                            @endauth
                        </a>
                    </div>
                    
                    @auth
                        @if(isset($isBanned) && $isBanned)
                            <div class="absolute inset-0 bg-red-900/10 backdrop-blur-[1px] pointer-events-none"></div>
                        @endif
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
</div>

                <div class="flex justify-center mt-6 gap-3">
                    <button class="scroll-button-left bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="scroll-button-right bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="newestCarousel" class="carousel-content hidden">
                <div class="flex auto-scroll py-6 relative">
                    @foreach($newestCommunities as $community)
                        <div class="flex-shrink-0 w-80 h-64 mx-4 rounded-2xl overflow-hidden shadow-2xl transform transition-all duration-500 hover:scale-105 card-hover perspective-container bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200">
                            <div class="p-6 h-full flex flex-col">
                                <div class="flex items-center gap-4 mb-4">
                                    @if($community->gambar)
                                        <img src="{{ asset('storage/' . $community->gambar) }}" class="w-16 h-16 rounded-2xl object-cover shine-effect" alt="{{ $community->nama_komunitas }}">
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center shine-effect">
                                            <i class="fas fa-users text-2xl text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="font-bold text-lg text-gray-800 truncate">{{ $community->nama_komunitas }}</h4>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $community->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>

                                <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                                    {{ Str::limit(strip_tags($community->deskripsi), 100) }}
                                </p>

                                <div class="flex items-center justify-between mt-auto">
                                    <div class="flex items-center">
                                        <div class="bg-emerald-500 text-white p-1 rounded-full">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-xs font-bold text-emerald-700 ml-1">Baru</span>
                                    </div>

                                    <a href="{{ route('communities.show', $community) }}" class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-md hover:shadow-lg transition-all duration-300 flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center mt-6 gap-3">
                    <button class="scroll-button-left bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="scroll-button-right bg-white text-blue-600 rounded-full w-12 h-12 flex items-center justify-center shadow-lg hover:bg-blue-50 transition-all">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="max-w-6xl mx-auto mb-8 text-center">
            <div class="inline-flex items-center bg-cyan-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-bold">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0 2a10 10 0 100-20 10 10 0 000 20zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                </svg>
                Direktori Komunitas Laut
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">
                Jelajahi <span class="text-cyan-600">Semua Komunitas</span>
            </h2>
      <p class="text-lg text-gray-600 max-w-3xl mx-auto">
        Temukan komunitas yang berdedikasi untuk konservasi laut, penelitian, dan keberlanjutan laut
    </p>
</div>

<div class="grid grid-cols-1 mx-auto max-w-7xl md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16 animate-on-scroll">
    @forelse($communities as $community)
        <div class="community-card bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 card-hover perspective-container"
             data-members="{{ $community->users_count ?? $community->users->count() }}"
             data-created="{{ $community->created_at->format('Y-m-d') }}"
             data-name="{{ strtolower($community->nama_komunitas) }}"
             data-joined="{{ Auth::check() && $community->users->contains('user_id', Auth::id()) ? 'true' : 'false' }}">

            <div class="relative h-60 overflow-hidden group">
                @if($community->gambar)
                    <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-300 via-cyan-400 to-teal-500 flex items-center justify-center shine-effect">
                        <svg class="w-24 h-24 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                @endif

                <div class="absolute top-4 right-4">
                    <span class="bg-blue-600/90 backdrop-blur-sm text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-lg border border-white/20 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        {{ $community->users_count ?? $community->users->count() }}
                    </span>
                </div>

                <div class="absolute top-4 left-4">
                    @if($community->messages_count > 5 || $community->created_at->diffInDays() < 14)
                    <span class="bg-green-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-lg border border-white/20 flex items-center">
                        <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                        {{ $community->messages_count > 5 ? 'Aktif' : 'Baru' }}
                    </span>
                    @endif
                </div>

                @auth
                    @php
                        $isBanned = \App\Models\BanUsers::where('community_id', $community->community_id)
                            ->where('user_id', Auth::id())
                            ->first();
                            
                        $isMuted = \App\Models\MuteUsers::where('community_id', $community->community_id)
                            ->where('user_id', Auth::id())
                            ->where('unmute_at', '>', now())
                            ->first();
                    @endphp
                    
                    @if($isBanned)
                        <div class="absolute inset-0 flex items-center justify-center bg-red-900/80 backdrop-blur-sm">
                            <div class="bg-red-800/90 border border-red-600 rounded-xl p-6 max-w-xs text-center transform rotate-6">
                                <div class="w-12 h-12 bg-red-700/80 rounded-full mx-auto mb-3 flex items-center justify-center">
                                    <svg class="w-7 h-7 text-red-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-4a3 3 0 100-6 3 3 0 000 6z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.071 19.071c-4.714 4.714-12.428 4.714-17.142 0-4.714-4.714-4.714-12.428 0-17.142 4.714-4.714 12.428-4.714 17.142 0 4.714 4.714 4.714 12.428 0 17.142z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">Akses Ditolak</h3>
                                <p class="text-red-100 text-sm">Anda telah dibanned dari komunitas ini.</p>
                                @if($isBanned->reason)
                                    <p class="mt-3 text-red-200 text-xs">Alasan: {{ $isBanned->reason }}</p>
                                @endif
                                <p class="mt-2 text-red-200 text-xs">Sejak: {{ $isBanned->banned_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    @elseif($isMuted)
                        <div class="absolute bottom-0 left-0 right-0 bg-amber-700/90 py-2 px-4 backdrop-blur-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-amber-100 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="text-amber-100 text-xs font-bold">Anda dibisukan hingga {{ $isMuted->unmute_at->format('H:i d/m/Y') }}</p>
                                    <p class="text-amber-200 text-xs">Anda dapat melihat tetapi tidak dapat berpartisipasi</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth

                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6">
                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $community->nama_komunitas }}</h3>
                        <p class="text-blue-100 line-clamp-2">{{ Str::limit(strip_tags($community->deskripsi), 80) }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <span class="text-sm text-gray-500 flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ \App\Helpers\IndonesiaTimeHelper::formatDate($community->created_at) }}
                        </span>
                    </div>
                    @auth
                        @if($community->users->contains('user_id', Auth::id()))
                            <span class="bg-cyan-100 text-cyan-700 text-xs py-1 px-3 rounded-full border border-cyan-200">
                                <svg class="w-3 h-3 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Anggota
                            </span>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-600 mb-6 text-sm line-clamp-3 flex-grow">
                    {{ Str::limit(strip_tags($community->deskripsi), 150) }}
                </p>

                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div class="text-xs text-gray-500 flex items-center">
                        @if($community->messages_count > 0)
                            <span class="flex items-center mr-4">
                                <svg class="w-4 h-4 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                {{ $community->messages_count }} postingan
                            </span>
                        @endif
                        @if($community->events_count > 0)
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $community->events_count }} acara
                            </span>
                        @endif
                    </div>

                    <a href="{{ route('communities.show', $community) }}" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-5 py-2 rounded-xl text-sm font-medium shadow-md hover:shadow-lg transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Lihat Komunitas
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full">
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-12 shadow-xl border border-blue-100/50 text-center">
                <div class="w-24 h-24 mx-auto mb-6 relative">
                    <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-25"></div>
                    <div class="relative w-full h-full bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <h3 class="text-2xl font-bold text-gray-800 mb-4">Tidak Ada Komunitas Ditemukan</h3>

                @if(request('search'))
                    <p class="text-lg text-gray-600 mb-8">Kami tidak dapat menemukan komunitas yang sesuai dengan kriteria pencarian Anda.</p>
                    <a href="{{ route('communities.index') }}" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-xl font-bold hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Lihat Semua Komunitas
                    </a>
                @else
                    <p class="text-lg text-gray-600 mb-8">Jadilah yang pertama memulai komunitas laut dan kumpulkan pecinta laut lainnya!</p>

                    @auth
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createCommunityModal" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-xl font-bold hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Buat Komunitas
                        </button>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-xl font-bold hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login untuk Membuat
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    @endforelse
</div>

@if($communities->hasPages())
    <div class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-20 bg-white/70 backdrop-blur-sm rounded-2xl p-4 border border-blue-100/50 shadow-md animate-on-scroll">
        <div class="flex items-center gap-3 text-gray-600">
            <span>Tampilkan:</span>
            <div class="inline-flex rounded-md shadow-sm" role="group">
                @foreach([12, 24, 48, 96] as $perPage)
                    <a href="{{ route('communities.index', ['per_page' => $perPage] + request()->except(['page', 'per_page'])) }}"
                       class="px-4 py-2 text-sm {{ request('per_page', 12) == $perPage ? 'bg-blue-500 text-white font-medium' : 'bg-white text-gray-700 hover:bg-blue-50' }}
                              {{ $loop->first ? 'rounded-l-lg' : '' }} {{ $loop->last ? 'rounded-r-lg' : '' }}
                              border {{ !$loop->last ? 'border-r-0' : '' }} border-blue-200 transition-colors">
                        {{ $perPage }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="pagination-container">
            {{ $communities->withQueryString()->links() }}
        </div>

        <div class="text-sm text-gray-500">
            Menampilkan
            <span class="font-medium text-gray-700">{{ $communities->firstItem() ?? 0 }}</span>
            hingga
            <span class="font-medium text-gray-700">{{ $communities->lastItem() ?? 0 }}</span>
            dari
            <span class="font-medium text-gray-700">{{ $communities->total() }}</span>
            komunitas
        </div>
    </div>
@endif

<div class="relative py-24 mb-12 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-blue-200/90 via-blue-400/90 to-teal-700/95 overflow-hidden">
        <div class="absolute inset-0 opacity-20 mix-blend-overlay animate-drift-slow"
             style="background-image: url('{{ asset('images/ocean-bg.jpg') }}');"></div>
        <div class="deep-sea-bubbles-enhanced absolute inset-0 opacity-20"></div>
        <div class="marine-light-rays-enhanced absolute inset-0"></div>
        <div class="underwater-particles-flow absolute inset-0"></div>

        <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/10 via-blue-600/15 to-teal-800/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 via-transparent to-transparent"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-20 animate-on-scroll">
            <div class="inline-flex items-center bg-gradient-to-r from-cyan-200/20 to-blue-300/20 backdrop-blur-xl text-cyan-200 px-10 py-5 rounded-full mb-10 border border-cyan-300/30 shadow-2xl">
                <div class="relative mr-4">
                    <div class="w-8 h-8 bg-gradient-to-br from-cyan-300 to-sky-500 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroBke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="absolute -inset-1 bg-gradient-to-r from-cyan-400/30 to-blue-500/30 rounded-full animate-ping"></div>
                </div>
                <span class="font-bold text-xl">Bergabunglah dengan Gerakan Laut</span>
            </div>

            <h2 class="text-6xl md:text-7xl font-bold text-white mb-10 underwater-text-effect leading-tight">
                Ciptakan <span class="relative inline-block">
                    <span class="bg-gradient-to-r from-cyan-200 to-blue-300  bg-clip-text text-transparent">Gelombang</span>
                    <div class="absolute -inset-2 bg-gradient-to-r from-cyan-500/20 to-teal-400/20 blur-md rounded-lg animate-pulse"></div>
                </span> Perubahan
            </h2>

            <p class="text-2xl md:text-3xl text-cyan-100 max-w-5xl mx-auto leading-relaxed mb-16 font-light">
                Terhubung dengan pecinta laut yang bersemangat dan berkontribusi pada gerakan global untuk konservasi laut, penelitian, dan pendidikan
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-7xl mx-auto">
                <div class="group relative">
                    <div class="impact-card bg-gradient-to-br from-blue-400/20 via-cyan-300/15 to-blue-500/25 backdrop-blur-xl rounded-3xl p-10 border border-cyan-200/30 text-left marine-conservation-card transform transition-all duration-700 hover:-translate-y-6 hover:rotate-y-12 perspective-1000 shadow-2xl hover:shadow-cyan-500/20">

                        <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-cyan-400/20 to-blue-500/20 rounded-full blur-xl opacity-60 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-6 left-6 w-16 h-16 bg-gradient-to-br from-blue-300/20 to-cyan-400/20 rounded-full blur-lg opacity-40 group-hover:opacity-80 transition-opacity duration-500"></div>

                        <div class="relative mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-400 via-cyan-500 to-blue-600 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-blue-500/30 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                                </svg>
                            </div>
                            <div class="absolute -inset-2 bg-gradient-to-r from-cyan-400/30 to-blue-500/30 rounded-2xl opacity-0 group-hover:opacity-100 animate-pulse transition-opacity duration-500"></div>
                        </div>

                        <h3 class="text-3xl font-bold text-white mb-6 group-hover:text-cyan-100 transition-colors duration-300">Proyek Konservasi</h3>
                        <p class="text-cyan-100 mb-8 text-lg leading-relaxed">
                            Berkolaborasi dalam restorasi terumbu karang, pembersihan pantai, dan inisiatif perlindungan habitat laut yang berkelanjutan
                        </p>

                        <div class="flex items-center mt-auto">
                            <div class="relative">
                                <span class="text-4xl font-bold text-cyan-200 mr-3 counter" data-value="{{ $stats['conservation_projects'] ?? 24 }}">0</span>
                                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-400/20 to-blue-400/20 rounded-lg blur opacity-50"></div>
                            </div>
                            <div>
                                <span class="text-cyan-200 text-lg font-medium">Proyek Aktif</span>
                                <div class="w-12 h-1 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full mt-1"></div>
                            </div>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/10 via-transparent to-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-br from-blue-600/20 to-cyan-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-60 transition-all duration-500 -z-10 transform group-hover:scale-110"></div>
                </div>

                <div class="group relative">
                    <div class="impact-card bg-gradient-to-br from-teal-400/20 via-emerald-300/15 to-green-500/25 backdrop-blur-xl rounded-3xl p-10 border border-emerald-200/30 text-left marine-conservation-card transform transition-all duration-700 hover:-translate-y-6 hover:rotate-y-12 perspective-1000 shadow-2xl hover:shadow-emerald-500/20" style="animation-delay: 0.2s">

                        <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-emerald-400/20 to-teal-500/20 rounded-full blur-xl opacity-60 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-6 left-6 w-16 h-16 bg-gradient-to-br from-teal-300/20 to-emerald-400/20 rounded-full blur-lg opacity-40 group-hover:opacity-80 transition-opacity duration-500"></div>

                        <div class="relative mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-teal-400 via-emerald-500 to-green-600 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-emerald-500/30 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div class="absolute -inset-2 bg-gradient-to-r from-emerald-400/30 to-teal-500/30 rounded-2xl opacity-0 group-hover:opacity-100 animate-pulse transition-opacity duration-500"></div>
                        </div>

                        <h3 class="text-3xl font-bold text-white mb-6 group-hover:text-emerald-100 transition-colors duration-300">Riset & Pemantauan</h3>
                        <p class="text-emerald-100 mb-8 text-lg leading-relaxed">
                            Berpartisipasi dalam program sains warga dan tetap mendapatkan informasi tentang temuan penelitian kelautan terbaru
                        </p>

                        <div class="flex items-center mt-auto">
                            <div class="relative">
                                <span class="text-4xl font-bold text-emerald-200 mr-3 counter" data-value="{{ $stats['research_initiatives'] ?? 36 }}">0</span>
                                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-400/20 to-teal-400/20 rounded-lg blur opacity-50"></div>
                            </div>
                            <div>
                                <span class="text-emerald-200 text-lg font-medium">Inisiatif Penelitian</span>
                                <div class="w-12 h-1 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full mt-1"></div>
                            </div>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/10 via-transparent to-teal-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/20 to-teal-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-60 transition-all duration-500 -z-10 transform group-hover:scale-110"></div>
                </div>

                <div class="group relative">
                    <div class="impact-card bg-gradient-to-br from-indigo-400/20 via-purple-300/15 to-violet-500/25 backdrop-blur-xl rounded-3xl p-10 border border-purple-200/30 text-left marine-conservation-card transform transition-all duration-700 hover:-translate-y-6 hover:rotate-y-12 perspective-1000 shadow-2xl hover:shadow-purple-500/20" style="animation-delay: 0.4s">

                        <div class="absolute top-4 right-4 w-20 h-20 bg-gradient-to-br from-purple-400/20 to-indigo-500/20 rounded-full blur-xl opacity-60 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-6 left-6 w-16 h-16 bg-gradient-to-br from-indigo-300/20 to-purple-400/20 rounded-full blur-lg opacity-40 group-hover:opacity-80 transition-opacity duration-500"></div>

                        <div class="relative mb-8">
                            <div class="w-20 h-20 bg-gradient-to-br from-indigo-400 via-purple-500 to-violet-600 rounded-2xl flex items-center justify-center text-white shadow-2xl shadow-purple-500/30 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                                </svg>
                            </div>
                            <div class="absolute -inset-2 bg-gradient-to-r from-purple-400/30 to-indigo-500/30 rounded-2xl opacity-0 group-hover:opacity-100 animate-pulse transition-opacity duration-500"></div>
                        </div>

                        <h3 class="text-3xl font-bold text-white mb-6 group-hover:text-purple-100 transition-colors duration-300">Edukasi & Penjangkauan</h3>
                        <p class="text-purple-100 mb-8 text-lg leading-relaxed">
                            Berbagi pengetahuan, mengorganisir acara, dan menciptakan kampanye kesadaran untuk menginspirasi pengelolaan laut
                        </p>

                        <div class="flex items-center mt-auto">
                            <div class="relative">
                                <span class="text-4xl font-bold text-purple-200 mr-3 counter" data-value="{{ $stats['education_programs'] ?? 52 }}">0</span>
                                <div class="absolute -inset-1 bg-gradient-to-r from-purple-400/20 to-indigo-400/20 rounded-lg blur opacity-50"></div>
                            </div>
                            <div>
                                <span class="text-purple-200 text-lg font-medium">Program Pendidikan</span>
                                <div class="w-12 h-1 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-full mt-1"></div>
                            </div>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-br from-purple-400/10 via-transparent to-indigo-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-3xl pointer-events-none"></div>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-br from-purple-600/20 to-indigo-600/20 rounded-3xl blur-xl opacity-0 group-hover:opacity-60 transition-all duration-500 -z-10 transform group-hover:scale-110"></div>
                </div>
            </div>

            <div class="mt-20 animate-on-scroll" style="animation-delay: 0.6s;">
                @auth
                    <div class="relative inline-block">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#createCommunityModal"
                                class="inline-flex items-center bg-gradient-to-r from-cyan-500 via-blue-600 to-teal-600 hover:from-cyan-600 hover:via-blue-700 hover:to-teal-700 text-white px-12 py-6 rounded-full font-bold transition-all duration-500 shadow-2xl transform hover:scale-110 group relative overflow-hidden">

                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/20 via-blue-500/20 to-teal-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                            <div class="absolute inset-0 bg-white/10 rounded-full transform scale-0 group-hover:scale-100 transition-transform duration-700 opacity-0 group-hover:opacity-100"></div>

                            <div class="relative flex items-center text-xl">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-4 group-hover:rotate-180 transition-transform duration-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <span class="mr-4">Buat Komunitas Kelautan Anda</span>
                                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </button>

                        <div class="absolute -inset-6 bg-gradient-to-r from-cyan-400/20 to-teal-400/20 rounded-full animate-ping opacity-75"></div>
                        <div class="absolute -inset-3 bg-gradient-to-r from-blue-400/30 to-cyan-400/30 rounded-full animate-pulse"></div>
                    </div>
                @else
                    <div class="relative inline-block">
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center bg-gradient-to-r from-cyan-500 via-blue-600 to-teal-600 hover:from-cyan-600 hover:via-blue-700 hover:to-teal-700 text-white px-12 py-6 rounded-full font-bold transition-all duration-500 shadow-2xl transform hover:scale-110 group relative overflow-hidden">

                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/20 via-blue-500/20 to-teal-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute inset-0 bg-white/10 rounded-full transform scale-0 group-hover:scale-100 transition-transform duration-700 opacity-0 group-hover:opacity-100"></div>

                            <div class="relative flex items-center text-xl">
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-4 group-hover:rotate-180 transition-transform duration-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                </div>
                                <span class="mr-4">Login to Join the Movement</span>
                                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </a>

                        <div class="absolute -inset-6 bg-gradient-to-r from-cyan-400/20 to-teal-400/20 rounded-full animate-ping opacity-75"></div>
                        <div class="absolute -inset-3 bg-gradient-to-r from-blue-400/30 to-cyan-400/30 rounded-full animate-pulse"></div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
            <defs>
                <linearGradient id="oceanWave" x1="0%" y1="0%" x2="0%" y2="100%">
                     <stop offset="0%" style="stop-color:#8cd2f2;stop-opacity:0.9" />
                     <stop offset="25%" style="stop-color:#85cef1;stop-opacity:0.95" />
                     <stop offset="50%" style="stop-color:#81d4fa;stop-opacity:1" />
                    <stop offset="75%" style="stop-color:#b2ebf2;stop-opacity:0.95" />
                    <stop offset="100%" style="stop-color:#e0f7fa;stop-opacity:0.9" />
                </linearGradient>
            </defs>
            <path fill="url(#oceanWave)" d="M0,224L48,213.3C96,203,192,181,288,186.7C384,192,480,224,576,218.7C672,213,768,171,864,165.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</div>


<div class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-cyan-100/80 via-blue-200/70 to-teal-300/60">
        <div class="absolute inset-0 bg-gradient-to-t from-blue-400/20 via-cyan-300/10 to-transparent"></div>
        <div class="ocean-waves-subtle absolute bottom-0 left-0 w-full h-32 opacity-40"></div>
        <div class="floating-particles-enhanced absolute inset-0 opacity-30"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center bg-white/20 backdrop-blur-md text-blue-800 px-8 py-4 rounded-full mb-6 border border-cyan-200/50">
                <div class="w-3 h-3 bg-cyan-500 rounded-full mr-3 animate-pulse"></div>
                <span class="font-bold text-lg">Dampak Komunitas</span>
                <div class="w-3 h-3 bg-blue-500 rounded-full ml-3 animate-pulse" style="animation-delay: 0.5s"></div>
            </div>

            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                <span class="text-gray-800">Komupulan</span>
                <span class="bg-gradient-to-r from-cyan-600 via-blue-600 to-teal-600 bg-clip-text text-transparent">Inisiatif Komunitas</span>
            </h2>

            <p class="text-xl text-gray-700 max-w-4xl mx-auto leading-relaxed">
            Temukan inisiatif konservasi laut yang berdampak dari komunitas aktif kami yang membuat perubahan nyata dalam pelestarian laut            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            @forelse($initiatives as $initiative)
                <div class="group relative">
                    <div class="initiative-card bg-gradient-to-br
                        {{ $loop->iteration % 4 == 0 ? 'from-cyan-50/90 via-sky-50/80 to-blue-100/70 border-sky-200/50' :
                          ($loop->iteration % 4 == 1 ? 'from-cyan-50/90 via-blue-50/80 to-cyan-100/70 border-cyan-200/50' :
                          ($loop->iteration % 4 == 2 ? 'from-emerald-50/90 via-green-50/80 to-emerald-100/70 border-emerald-200/50' :
                          'from-cyan-50/90 via-emerald-50/80 to-teal-100/70 border-teal-200/50')) }}
                        backdrop-blur-xl rounded-2xl shadow-xl border-2 overflow-hidden
                        transform transition-all duration-500 hover:-translate-y-3 hover:shadow-2xl
                        hover:scale-[1.02] perspective-card">

                        <div class="h-2 bg-gradient-to-r
                            {{ $loop->iteration % 4 == 0 ? 'from-blue-400 via-blue-500 to-cyan-600' :
                              ($loop->iteration % 4 == 1 ? 'from-cyan-400 via-blue-500 to-cyan-600' :
                              ($loop->iteration % 4 == 2 ? 'from-sky-400 via-cyan-200 to-cyan-600' :
                              'from-cyan-400 via-emerald-500 to-teal-600')) }}">
                        </div>

                        <div class="p-8">
                            <div class="flex items-start gap-4 mb-6">
                                <div class="relative flex-shrink-0">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center shadow-lg
                                        {{ $loop->iteration % 4 == 0 ? 'bg-gradient-to-br from-cyan-200 to-sky-300 text-sky-700' :
                                          ($loop->iteration % 4 == 1 ? 'bg-gradient-to-br from-cyan-200 to-blue-300 text-cyan-700' :
                                          ($loop->iteration % 4 == 2 ? 'bg-gradient-to-br from-emerald-200 to-green-300 text-emerald-700' :
                                          'bg-gradient-to-br from-cyan-200 to-emerald-300 text-teal-700')) }}">
                                        <i class="{{ $initiative->icon ?? 'fas fa-water' }} text-xl"></i>
                                    </div>
                                    <div class="absolute -inset-1 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300
                                        {{ $loop->iteration % 4 == 0 ? 'bg-gradient-to-r from-cyan-400/20 to-sky-400/20' :
                                          ($loop->iteration % 4 == 1 ? 'bg-gradient-to-r from-cyan-400/20 to-blue-400/20' :
                                          ($loop->iteration % 4 == 2 ? 'bg-gradient-to-r from-emerald-400/20 to-green-400/20' :
                                          'bg-gradient-to-r from-cyan-400/20 to-emerald-400/20')) }}
                                        animate-pulse"></div>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-gray-900 transition-colors">
                                        {{ $initiative->judul }}
                                    </h3>
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full
                                            {{ $loop->iteration % 4 == 0 ? 'bg-blue-500' :
                                              ($loop->iteration % 4 == 1 ? 'bg-cyan-500' :
                                              ($loop->iteration % 4 == 2 ? 'bg-emerald-500' : 'bg-teal-500')) }}">
                                        </div>
                                        <p class="text-sm font-medium text-gray-600 truncate">
                                            {{ $initiative->community->nama_komunitas }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <p class="text-gray-700 leading-relaxed line-clamp-4 text-sm">
                                    {{ Str::limit($initiative->deskripsi, 140) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-200/50">
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold
                                        {{ $loop->iteration % 4 == 0 ? 'bg-cyan-100/80 text-sky-700 border border-blue-200' :
                                          ($loop->iteration % 4 == 1 ? 'bg-cyan-100/80 text-cyan-700 border border-cyan-200' :
                                          ($loop->iteration % 4 == 2 ? 'bg-emerald-100/80 text-emerald-700 border border-emerald-200' :
                                          'bg-cyan-100/80 text-emerald-700 border border-emerald-200')) }}">
                                        <i class="fas fa-flag mr-1.5"></i>
                                        Prioritas {{ $initiative->urutan_prioritas ?? 'Not set' }}
                                    </span>
                                </div>

                                <a href="{{ route('communities.show', $initiative->community) }}"
                                   class="inline-flex items-center px-4 py-2.5 rounded-xl text-sm font-bold
                                   text-white shadow-lg transform transition-all duration-300
                                   hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2
                                   {{ $loop->iteration % 4 == 0 ? 'bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 focus:ring-sky-500' :
                                     ($loop->iteration % 4 == 1 ? 'bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:ring-cyan-500' :
                                     ($loop->iteration % 4 == 2 ? 'bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 focus:ring-emerald-500' :
                                     'bg-gradient-to-r from-cyan-500 to-teal-600 hover:from-cyan-600 hover:to-teal-700 focus:ring-teal-500')) }}">
                                    <span>Kunjungi</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 via-transparent to-white/5
                                    opacity-0 group-hover:opacity-100 transition-all duration-500 pointer-events-none
                                    rounded-2xl"></div>
                    </div>

                    <div class="absolute inset-0 bg-gradient-to-br
                        {{ $loop->iteration % 4 == 0 ? 'from-amber-400/20 to-orange-400/20' :
                          ($loop->iteration % 4 == 1 ? 'from-cyan-400/20 to-blue-400/20' :
                          ($loop->iteration % 4 == 2 ? 'from-emerald-400/20 to-green-400/20' :
                          'from-indigo-400/20 to-purple-400/20')) }}
                        rounded-2xl blur-xl opacity-0 group-hover:opacity-60 transition-all duration-500 -z-10
                        transform group-hover:scale-110"></div>
                </div>
            @empty
                <div class="col-span-4">
                    <div class="bg-gradient-to-br from-blue-50/90 via-cyan-50/80 to-teal-50/70 backdrop-blur-xl
                                rounded-3xl p-12 border-2 border-blue-200/50 text-center shadow-xl">
                        <div class="relative w-24 h-24 mx-auto mb-8">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full animate-pulse opacity-20"></div>
                            <div class="relative w-full h-full bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full
                                        flex items-center justify-center shadow-xl">
                                <i class="fas fa-water text-3xl text-white"></i>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Initiatives Found</h3>
                        <p class="text-lg text-gray-600 mb-8 max-w-md mx-auto">
                      Saat ini tidak ada inisiatif komunitas yang dapat ditampilkan. Jadilah yang pertama membuat proyek yang berdampak!                        </p>

                        @auth
                            @if(Auth::user()->role === 'admin')
                            <button class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-cyan-600
                                           text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105
                                           transition-all duration-300">
                                <i class="fas fa-plus mr-3"></i>
                               Buat inisiatif
                            </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center animate-on-scroll">
            <div class="relative inline-block">
                <a href="{{ route('communities.index') }}"
                   class="inline-flex items-center px-10 py-5 bg-gradient-to-r from-blue-600 via-cyan-500 to-teal-500
                          text-white font-bold rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-105
                          transition-all duration-300 border border-white/20 backdrop-blur-sm group">
                    <div class="flex items-center">
                        <i class="fas fa-users mr-4 text-xl"></i>
                        <span class="text-lg">Jelajahi Semua Komunitas</span>
                        <svg class="w-6 h-6 ml-4 transform group-hover:translate-x-2 transition-transform duration-300"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </a>

                <div class="absolute -inset-4 bg-gradient-to-r from-blue-400/20 to-cyan-400/20 rounded-full
                            animate-ping opacity-75"></div>
                <div class="absolute -inset-2 bg-gradient-to-r from-cyan-400/30 to-teal-400/30 rounded-full
                            animate-pulse"></div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
            <defs>
                <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#f0fdff;stop-opacity:1" />
                    <stop offset="50%" style="stop-color:#e0f7fa;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#f0fdff;stop-opacity:1" />
                </linearGradient>
            </defs>
            <path fill="url(#waveGradient)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</div>

@endsection

@section('styles')
<style>

.marine-light-rays {
    background: linear-gradient(45deg,
        transparent 30%,
        rgba(120, 220, 255, 0.08) 40%,
        rgba(120, 220, 255, 0.04) 50%,
        transparent 60%
    );
    background-size: 300px 300px;
    animation: lightRaysMove 20s ease-in-out infinite;
}

.marine-light-rays-enhanced {
    background: linear-gradient(45deg,
        transparent 30%,
        rgba(120, 220, 255, 0.1) 40%,
        rgba(120, 220, 255, 0.05) 50%,
        transparent 60%
    );
    background-size: 200px 200px;
    animation: lightRaysFlow 15s ease-in-out infinite;
}

.underwater-particles-flow {
    background-image:
        radial-gradient(circle at 10% 20%, rgba(34, 211, 238, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 30% 60%, rgba(59, 130, 246, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 70% 90%, rgba(20, 184, 166, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 90% 30%, rgba(16, 185, 129, 0.1) 1px, transparent 1px);
    background-size: 80px 80px, 120px 120px, 100px 100px, 90px 90px;
    animation: particleFlow 20s linear infinite;
}

.deep-sea-bubbles-enhanced {
    background-image:
        radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
        radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.12) 5px, transparent 5px),
        radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.18) 3px, transparent 3px),
        radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
        radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px);
    background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
    animation: deepBubbleRiseEnhanced 30s linear infinite;
}

.ocean-bubbles {
    background-image:
        radial-gradient(circle at 90% 10%, rgba(255, 255, 255, 0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.7) 1px, transparent 1px),
        radial-gradient(circle at 30% 80%, rgba(255, 255, 255, 0.6) 0.8px, transparent 0.8px);
    background-size: 100px 100px;
    animation: bubbleRise 25s linear infinite;
}

.gradient-text {
    background: linear-gradient(135deg, #0ea5e9, #06b6d4, #0891b2, #0e7490);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    display: inline;
}

.underwater-text-effect {
    text-shadow:
        0 0 10px rgba(120, 220, 255, 0.3),
        0 0 20px rgba(120, 220, 255, 0.2),
        0 0 30px rgba(120, 220, 255, 0.1);
    animation: underwaterGlow 4s ease-in-out infinite alternate;
}

.marine-conservation-card {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.marine-conservation-card:hover {
    transform: translateY(-5px);
    background-color: rgba(255, 255, 255, 0.15);
}

.marine-conservation-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg,
        transparent,
        rgba(255, 255, 255, 0.1),
        transparent
    );
    transform: rotate(45deg);
    transition: all 0.6s ease;
    opacity: 0;
}

.marine-conservation-card:hover::before {
    animation: shimmerEffect 1.5s ease-in-out;
}

.pagination-container nav {
    display: flex;
    justify-content: center;
}

.pagination-container ul {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 0.25rem;
}

.pagination-container li {
    display: flex;
    align-items: stretch;
}

.pagination-container li > * {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem 0.75rem;
    min-width: 2rem;
    border-radius: 0.5rem;
    font-size: 0.875rem;
    line-height: 1.25rem;
}

.pagination-container li span[aria-current="page"] {
    background-color: #0ea5e9;
    color: white;
    font-weight: 600;
}

.pagination-container li a {
    background-color: white;
    color: #1f2937;
    transition: all 0.2s ease;
}

.pagination-container li a:hover {
    background-color: #e0f2fe;
    color: #0284c7;
}

.pagination-container svg {
    width: 1rem;
    height: 1rem;
}

@keyframes lightRaysMove {
    0%, 100% {
        transform: translateX(-100px) translateY(-100px) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateX(100px) translateY(100px) rotate(15deg);
        opacity: 0.8;
    }
}

@keyframes lightRaysFlow {
    0%, 100% {
        transform: translateX(-50px) translateY(-50px) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateX(50px) translateY(50px) rotate(10deg);
        opacity: 0.6;
    }
}

@keyframes deepBubbleRiseEnhanced {
    0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%, 0 100%; }
    100% { background-position: 0 -400px, 0 -500px, 0 -300px, 0 -450px, 0 -250px; }
}

@keyframes particleFlow {
    0% {
        background-position: 0 0, 0 0, 0 0, 0 0;
        transform: translateX(0);
    }
    100% {
        background-position: 80px 80px, -120px 120px, 100px -100px, -90px 90px;
        transform: translateX(20px);
    }
}

@keyframes bubbleRise {
    0% { background-position: 0 100%; }
    100% { background-position: 100px 0; }
}

@keyframes shimmerEffect {
    0% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
        opacity: 0;
    }
    50% {
        opacity: 1;
    }
    100% {
        transform: translateX(100%) translateY(100%) rotate(45deg);
        opacity: 0;
    }
}

@keyframes underwaterGlow {
    0% {
        text-shadow:
            0 0 10px rgba(120, 220, 255, 0.3),
            0 0 20px rgba(120, 220, 255, 0.2),
            0 0 30px rgba(120, 220, 255, 0.1);
    }
    100% {
        text-shadow:
            0 0 15px rgba(120, 220, 255, 0.4),
            0 0 25px rgba(120, 220, 255, 0.3),
            0 0 35px rgba(120, 220, 255, 0.2);
    }
}

.card-hover {
    transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
}

.card-hover:hover {
    box-shadow: 0 15px 30px rgba(0, 0, 150, 0.1);
}

@media (max-width: 768px) {
    .underwater-text-effect {
        font-size: 2.5rem;
    }

    .gradient-text {
        background-size: 200% 200%;
    }

    .marine-conservation-card {
        padding: 1.5rem;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const counterElements = document.querySelectorAll('.counter');

    const observerOptions = {
        threshold: 0.1
    };

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.dataset.value || entry.target.textContent);
                animateCounter(entry.target, target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    counterElements.forEach(counter => {
        counterObserver.observe(counter);
    });

    function animateCounter(element, target) {
        let start = 0;
        const duration = 2000; 
        const increment = target / 100;
        const startTime = performance.now();

        function updateCounter(currentTime) {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);

            const currentCount = Math.floor(progress * target);
            element.textContent = currentCount.toLocaleString();

            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target.toLocaleString();
            }
        }

        requestAnimationFrame(updateCounter);
    }

    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                scrollObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    animatedElements.forEach(element => {
        scrollObserver.observe(element);
    });

    const fileInput = document.getElementById('gambar');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const fileLabel = this.closest('.relative').querySelector('p');
                fileLabel.textContent = 'Selected: ' + this.files[0].name;
            }
        });
    }

    const filterButtons = document.querySelectorAll('.quick-filter-btn');
    if (filterButtons.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const filterType = this.dataset.filter;
                filterCommunities(filterType);
            });
        });
    }

    function filterCommunities(filterType) {
        const communityCards = document.querySelectorAll('.community-card');

        communityCards.forEach(card => {
            let shouldShow = true;

            switch(filterType) {
                case 'all':
                    shouldShow = true;
                    break;
                case 'trending':
                    shouldShow = parseInt(card.dataset.members) > 10;
                    break;
                case 'new':
                    const createdDate = new Date(card.dataset.created);
                    const thirtyDaysAgo = new Date();
                    thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
                    shouldShow = createdDate > thirtyDaysAgo;
                    break;
                case 'joined':
                    shouldShow = card.dataset.joined === 'true';
                    break;
            }

            if (shouldShow) {
                card.style.display = '';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0) scale(1)';
                }, 10);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px) scale(0.95)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
    }

    const viewTypeButtons = document.querySelectorAll('.view-btn');
    if (viewTypeButtons.length > 0) {
        viewTypeButtons.forEach(button => {
            button.addEventListener('click', function() {
                viewTypeButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const viewType = this.dataset.view;
                document.getElementById('gridView').style.display = viewType === 'grid' ? 'grid' : 'none';
                document.getElementById('listView').style.display = viewType === 'list' ? 'block' : 'none';

                localStorage.setItem('communityViewType', viewType);
            });
        });

        const savedViewType = localStorage.getItem('communityViewType');
        if (savedViewType) {
            viewTypeButtons.forEach(btn => {
                if (btn.dataset.view === savedViewType) {
                    btn.click();
                }
            });
        }
    }

    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(function() {
            const searchTerm = this.value.toLowerCase();
            const communityCards = document.querySelectorAll('.community-card');

            communityCards.forEach(card => {
                const communityName = card.dataset.name;
                const shouldShow = communityName.includes(searchTerm);

                if (shouldShow) {
                    card.style.display = '';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        }, 300));
    }

    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
});
</script>
@endsection
