@extends('layouts.app')

@section('title', 'Komunitas Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Animasi Latar Belakang Laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <div class="bg-gradient-to-br from-blue-500 via-blue-900 to-teal-900 text-white py-10 relative z-10">
        <div class="container mx-auto px-4 relative">
            <h1 class="text-3xl font-bold mb-2">Komunitas Saya</h1>
            <p class="mt-2">Jelajahi dan kelola komunitas yang telah Anda gabung</p>

            <div class="absolute inset-0 z-0 overflow-hidden">
                <div class="deep-sea-bubbles opacity-20"></div>
                <div class="marine-light-rays"></div>
                <div class="floating-particles absolute inset-0"></div>
            </div>
        </div>
    </div>

    <div class="bg-blue-100 shadow-md relative z-10">
        <div class="container mx-auto">
            <ul class="flex flex-wrap -mb-px text-lg font-medium text-center">
                <li class="mr-2">
                    <a href="{{ route('user.dashboard') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.articles') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-newspaper mr-2"></i> Artikel Saya
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.communities') }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active">
                        <i class="fas fa-users mr-2"></i> Komunitas
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.profile') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 relative z-10">
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 fade-in-up animate-on-scroll">
            <div class="bg-gradient-to-br from-white/90 to-blue-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-blue-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-blue-500/5 rounded-full -mb-8 -ml-8"></div>

                <div class="relative p-6 z-10">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-600 mr-4 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Komunitas</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ count($communities) }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white/90 to-cyan-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-cyan-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                <div class="absolute top-0 right-0 w-20 h-20 bg-cyan-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-cyan-500/5 rounded-full -mb-8 -ml-8"></div>

                <div class="relative p-6 z-10">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gradient-to-r from-cyan-100 to-cyan-200 text-cyan-600 mr-4 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Anggota</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ $communities->sum('members_count') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white/90 to-teal-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-teal-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                <div class="absolute top-0 right-0 w-20 h-20 bg-teal-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-teal-500/5 rounded-full -mb-8 -ml-8"></div>

                <div class="relative p-6 z-10">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gradient-to-r from-teal-100 to-teal-200 text-teal-600 mr-4 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Diskusi Aktif</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ $totalDiscussions ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 mb-8 fade-in-up animate-on-scroll" style="animation-delay: 0.2s">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span>Komunitas yang Saya Ikuti</span>
                </h2>

                <div class="flex gap-3">
                    <div class="relative">
                        <form action="{{ route('user.communities') }}" method="GET">
                            <div class="flex items-center bg-white border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500">
                                <input type="text" name="search" placeholder="Cari komunitas..." class="flex-1 px-4 py-2 text-sm focus:outline-none" value="{{ request('search') }}">
                                <button type="submit" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('communities.index') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-md transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Jelajahi Komunitas
                    </a>
                </div>
            </div>

            @if(count($communities) > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-in-up animate-on-scroll" style="animation-delay: 0.4s">
                    @foreach($communities as $community)
                        <div class="bg-gradient-to-br from-white to-blue-50/30 border border-blue-100/60 rounded-xl shadow-sm overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-md group">
                            <div class="h-20 bg-gradient-to-r from-blue-600 to-cyan-600 relative overflow-hidden">
                                <div class="absolute inset-0">
                                    <div class="w-full h-full deep-sea-bubbles opacity-20"></div>
                                    <div class="w-full h-full marine-light-rays"></div>
                                </div>

\                                <div class="absolute -bottom-6 left-6">
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center text-blue-700 font-bold text-xl shadow-md border-2 border-white overflow-hidden">
                                        @if($community->gambar)
                                            <img src="{{ Storage::url($community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($community->nama_komunitas, 0, 2)) }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 pt-10">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $community->nama_komunitas }}</h3>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                        {{ $community->members_count }} anggota
                                    </span>
                                </div>

                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $community->deskripsi }}</p>

                                <div class="mt-4 flex items-center text-xs text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    Bergabung {{ \Carbon\Carbon::parse($community->pivot->tg_gabung)->format('d M Y') }}
                                    <span class="mx-1.5 text-gray-300">•</span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                        {{ $community->discussions_count ?? 0 }} diskusi
                                    </span>
                                </div>

                                <div class="mt-6 flex space-x-2 pt-3 border-t border-gray-100 items-center justify-between">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(explode(',', $community->categories ?? '') as $category)
                                            @if(trim($category) != '')
                                                <span class="bg-blue-50 text-blue-700 text-xs px-2 py-0.5 rounded-md">
                                                    {{ trim($category) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>

                                    <a href="{{ route('communities.show', $community) }}" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 group relative overflow-hidden">
                                        <span>Kunjungi</span>
                                        <svg class="w-4 h-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                        <div class="absolute bottom-0 left-0 w-full h-0.5 bg-gradient-to-r from-blue-600 to-cyan-600 transform scale-x-0 origin-left transition-transform group-hover:scale-x-100"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $communities->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl shadow-sm fade-in-up animate-on-scroll" style="animation-delay: 0.2s">
                    <svg class="mx-auto h-16 w-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800">Belum Ada Komunitas</h3>
                    <p class="mt-2 text-gray-600 max-w-md mx-auto">Anda belum bergabung dengan komunitas manapun. Jelajahi dan temukan komunitas yang sesuai minat Anda.</p>
                    <div class="mt-8">
                        <a href="{{ route('communities.index') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Jelajahi Komunitas
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 mb-8 fade-in-up animate-on-scroll" style="animation-delay: 0.4s">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    <span>Rekomendasi Komunitas</span>
                </h2>

                <a href="{{ route('communities.index') }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                    <span>Lihat Semua</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 fade-in-up animate-on-scroll" style="animation-delay: 0.6s">
                @foreach($recommendedCommunities ?? [] as $recommended)
                    <div class="bg-gradient-to-br from-white to-blue-50/30 border border-blue-100/60 rounded-xl shadow-sm overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-md group">
                        <div class="h-16 bg-gradient-to-r from-cyan-600 to-sky-600 relative overflow-hidden">
                            <div class="absolute inset-0">
                                <div class="w-full h-full deep-sea-bubbles opacity-20"></div>
                                <div class="w-full h-full marine-light-rays"></div>
                            </div>

                            <div class="absolute -bottom-5 left-5">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-100 to-indigo-100 flex items-center justify-center text-cyan-700 font-bold text-sm shadow-md border-2 border-white overflow-hidden">
                                    @if($recommended->gambar)
                                        <img src="{{ Storage::url($recommended->gambar) }}" alt="{{ $recommended->nama }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($recommended->nama_komunitas, 0, 2)) }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="p-4 pt-6">
                            <div class="flex justify-between items-start mb-1">
                                <h3 class="text-base font-bold text-gray-900">{{ $recommended->nama_komunitas }}</h3>
                                <span class="bg-indigo-100 text-cyan-800 text-xs font-medium px-2 py-0.5 rounded-full">
                                    {{ $recommended->members_count ?? 0 }} anggota
                                </span>
                            </div>

                            <p class="mt-1 text-xs text-gray-600 line-clamp-2">{{ Str::limit($recommended->deskripsi, 60) }}</p>

                            <div class="mt-3 pt-2 border-t border-gray-100">
                                <a href="{{ route('communities.show', $recommended) }}" class="inline-flex w-full items-center justify-center py-1.5 bg-gradient-to-r from-cyan-600 to-sky-600 hover:from-sky-700 hover:to-sky-700 text-xs text-white font-medium rounded-lg shadow-sm transform transition-all duration-200 hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    Gabung Komunitas
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if(empty($recommendedCommunities) || count($recommendedCommunities) === 0)
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-600">Tidak ada rekomendasi komunitas saat ini.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 mb-6 fade-in-up animate-on-scroll" style="animation-delay: 0.6s">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Aktivitas Komunitas Terkini</span>
            </h2>

            @if(isset($communityActivities) && count($communityActivities) > 0)
                <div class="flow-root fade-in-up animate-on-scroll" style="animation-delay: 0.7s">
                    <ul role="list" class="-mb-8">
                        @foreach($communityActivities as $activity)
                            <li class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gradient-to-b from-blue-200 via-cyan-200 to-transparent" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex items-start space-x-3">
                                    <div class="relative">
                                        <div class="h-10 w-10 rounded-full flex items-center justify-center bg-{{ $activity['color'] }}-100 text-{{ $activity['color'] }}-600 ring-8 ring-white">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity['icon_path'] }}"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {!! $activity['title'] !!}
                                            </div>
                                            <p class="mt-0.5 text-sm text-gray-500">
                                                {{ $activity['time'] }}
                                            </p>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-700">
                                            <p>{!! $activity['content'] !!}</p>
                                        </div>
                                        <div class="mt-2">
                                            <a href="{{ $activity['link'] }}" class="text-xs font-medium text-blue-600 hover:text-blue-800 flex items-center">
                                                <span>{{ $activity['link_text'] }}</span>
                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="text-center py-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                    <p class="text-gray-600">Tidak ada aktivitas komunitas terkini.</p>
                </div>
            @endif
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll" style="animation-delay: 0.8s">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Tips Berpartisipasi di Komunitas</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="p-5 border border-blue-100 rounded-xl bg-gradient-to-br from-blue-50/50 to-cyan-50/50 hover:shadow-md transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-blue-100 rounded-full text-blue-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Aktif Berdiskusi</h3>
                    </div>
                    <p class="text-sm text-gray-600">Berpartisipasilah dalam diskusi yang menarik minat Anda. Ajukan pertanyaan, berikan tanggapan, dan bagikan pengetahuan Anda.</p>
                </div>

                <div class="p-5 border border-blue-100 rounded-xl bg-gradient-to-br from-green-50/50 to-teal-50/50 hover:shadow-md transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-green-100 rounded-full text-green-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Bagikan Artikel</h3>
                    </div>
                    <p class="text-sm text-gray-600">Tulis dan bagikan artikel menarik tentang topik yang Anda sukai. Kontribusi Anda dapat membantu dan menginspirasi anggota lainnya.</p>
                </div>

                <div class="p-5 border border-blue-100 rounded-xl bg-gradient-to-br from-purple-50/50 to-indigo-50/50 hover:shadow-md transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-purple-100 rounded-full text-purple-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Aktif dalam event komunitas</h3>
                    </div>
                    <p class="text-sm text-gray-600">Bergabung dan Berpartisipasi dalam event komunitas.</p>
                </div>
            </div>

</div>
@endsection

@section('styles')
<style>
.ocean-waves {
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(54,187,252,0.15) 100%);
    background-size: 400% 400%;
    animation: wave 15s ease-in-out infinite;
    transform: translateZ(0);
}

.floating-particles {
    background-image:
        radial-gradient(circle at 85% 15%, rgba(255,255,255,0.15) 1px, transparent 1px),
        radial-gradient(circle at 20% 40%, rgba(255,255,255,0.1) 1.5px, transparent 1.5px),
        radial-gradient(circle at 30% 70%, rgba(255,255,255,0.2) 1px, transparent 1px),
        radial-gradient(circle at 70% 90%, rgba(255,255,255,0.1) 1.5px, transparent 1.5px),
        radial-gradient(circle at 40% 25%, rgba(255,255,255,0.15) 1px, transparent 1px);
    background-size: 300px 300px;
    animation: floatingParticles 60s linear infinite;
}

.ocean-bubbles {
    background-image:
        radial-gradient(circle at 90% 10%, rgba(255,255,255,0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 20% 50%, rgba(255,255,255,0.7) 1px, transparent 1px),
        radial-gradient(circle at 30% 80%, rgba(255,255,255,0.6) 0.8px, transparent 0.8px),
        radial-gradient(circle at 60% 30%, rgba(255,255,255,0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 80% 60%, rgba(255,255,255,0.7) 1px, transparent 1px);
    background-size: 100px 100px;
    animation: bubbleRise 25s linear infinite;
}

.underwater-current {
    background: linear-gradient(45deg,
        rgba(0,115,209,0) 0%,
        rgba(0,115,209,0.02) 50%,
        rgba(0,115,209,0) 100%);
    background-size: 200% 200%;
    animation: underwaterCurrent 15s ease-in-out infinite;
}

.deep-sea-bubbles {
    background-image:
        radial-gradient(circle at 15% 85%, rgba(255,255,255,0.15) 4px, transparent 4px),
        radial-gradient(circle at 45% 75%, rgba(255,255,255,0.12) 5px, transparent 5px),
        radial-gradient(circle at 75% 65%, rgba(255,255,255,0.18) 3px, transparent 3px);
    background-size: 300px 300px;
    animation: deepBubbleRise 30s linear infinite;
}

.marine-light-rays {
    background: linear-gradient(45deg,
        transparent 30%,
        rgba(120, 220, 255, 0.08) 40%,
        rgba(120, 220, 255, 0.04) 50%,
        transparent 60%
    );
    background-size: 200px 200px;
    animation: lightRaysMove 15s ease-in-out infinite;
}

/* Line clamp utility */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in-left {
    opacity: 0;
    transform: translateX(-20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in-right {
    opacity: 0;
    transform: translateX(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.animate-on-scroll.in-view {
    opacity: 1;
    transform: translate(0);
}

@keyframes wave {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

@keyframes floatingParticles {
    0% { background-position: 0 0; }
    100% { background-position: 300px 300px; }
}

@keyframes bubbleRise {
    0% { background-position: 0 100%; }
    100% { background-position: 100px 0; }
}

@keyframes underwaterCurrent {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

@keyframes deepBubbleRise {
    0% { background-position: 0 100%, 0 100%, 0 100%; }
    100% { background-position: 0 -300px, 0 -300px, 0 -300px; }
}

@keyframes lightRaysMove {
    0%, 100% {
        transform: translateX(-100px) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateX(100px) rotate(15deg);
        opacity: 0.8;
    }
}

.notification-toast {
    animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 5s forwards;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-20px); }
}

.random-bubble {
    position: absolute;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: rgba(255,255,255,0.6);
    animation: randomBubbleRise linear infinite;
    bottom: -20px;
    box-shadow: 0 0 5px rgba(255,255,255,0.3);
}

@keyframes randomBubbleRise {
    0% {
        transform: translateY(0) scale(0.8);
        opacity: 0;
    }
    10% {
        opacity: 0.8;
    }
    100% {
        transform: translateY(-150px) scale(1.2);
        opacity: 0;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const animateOnScrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach(element => {
        animateOnScrollObserver.observe(element);
    });

    document.querySelectorAll('.close-notification').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.notification-toast').style.display = 'none';
        });
    });

    function createRandomBubblesForCards() {
        document.querySelectorAll('.underwater-current').forEach(container => {
            if (!container) return;

            for (let i = 0; i < 10; i++) {
                const bubble = document.createElement('div');
                bubble.classList.add('random-bubble');

                const size = Math.random() * 6 + 3;
                const left = Math.random() * 100;
                const animationDuration = Math.random() * 10 + 8;
                const delay = Math.random() * 10;

                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.left = `${left}%`;
                bubble.style.animationDuration = `${animationDuration}s`;
                bubble.style.animationDelay = `${delay}s`;

                container.appendChild(bubble);
            }
        });
    }

    createRandomBubblesForCards();

    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            document.querySelector('.mobile-submenu').classList.toggle('hidden');
        });
    }
});
</script>
@endsection
