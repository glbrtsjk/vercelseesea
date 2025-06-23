@extends('layouts.app')

@section('title', 'Profil Saya')

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
            <h1 class="text-3xl font-bold mb-2">Profil Saya</h1>
            <p class="mt-2">Kelola informasi pribadi dan pantau aktivitas Anda.</p>

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
                    <a href="{{ route('user.communities') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-users mr-2"></i> Komunitas
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.profile') }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active">
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="col-span-1 space-y-6">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-right animate-on-scroll">
                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            <div class="w-32 h-32 rounded-full ocean-profile-border overflow-hidden">
                                <img class="h-32 w-32 rounded-full object-cover transform transition-all duration-500 hover:scale-110"
                                     src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('home/userdefault.jpg') }}"
                                     alt="{{ Auth::user()->name }}">
                            </div>
                            <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full w-4 h-4 border-2 border-white pulse-dot"></div>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mt-2">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ Auth::user()->email }}</p>

                        <div class="w-full">
                            <a href="{{ route('user.edit-profile') }}" class="w-full block text-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg transition-all duration-300 shadow-md transform hover:-translate-y-1">
                                Edit Profil
                            </a>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mt-6 pt-4">
                        <h3 class="text-sm font-medium text-gray-500 mb-3">Statistik Saya</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between p-2 rounded-lg hover:bg-blue-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div class="p-2 bg-blue-100 rounded-full text-blue-600 mr-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-600">Artikel</span>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['articles'] }}</span>
                            </li>
                            <li class="flex items-center justify-between p-2 rounded-lg hover:bg-blue-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div class="p-2 bg-green-100 rounded-full text-green-600 mr-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-600">Komentar</span>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['comments'] }}</span>
                            </li>
                            <li class="flex items-center justify-between p-2 rounded-lg hover:bg-blue-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div class="p-2 bg-purple-100 rounded-full text-purple-600 mr-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-600">Komunitas</span>
                                </div>
                                <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['communities'] }}</span>
                            </li>
                            <li class="flex items-center justify-between p-2 rounded-lg hover:bg-blue-50/50 transition-colors">
                                <div class="flex items-center">
                                    <div class="p-2 bg-cyan-100 rounded-full text-cyan-600 mr-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-600">Bergabung Sejak</span>
                                </div>
                                <span class="text-cyan-600 text-xs font-semibold">{{ Auth::user()->created_at->format('M Y') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-right animate-on-scroll" style="animation-delay: 0.2s">
                    <h3 class="font-medium text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Tentang Saya</span>
                    </h3>
                    <div class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg">
                        @if(Auth::user()->bio)
                            <p class="text-gray-700">{{ Auth::user()->bio }}</p>
                        @else
                            <p class="text-gray-500 italic">Belum ada deskripsi. Ceritakan tentang diri Anda dengan mengubah profil.</p>
                        @endif
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('user.edit-profile') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center justify-center group">
                            <span>Ubah deskripsi</span>
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-right animate-on-scroll" style="animation-delay: 0.4s">
                    <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Pengaturan Akun</span>
                    </h3>
                    <nav class="space-y-2">
                        <a href="{{ route('user.edit-profile') }}" class="ocean-quick-link flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r from-blue-50 to-cyan-50 hover:text-gray-900 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-600 mr-3 shadow-inner">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Edit Profil</h3>
                                    <p class="text-xs text-gray-600">Perbarui informasi pribadi</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <div class="ocean-quick-link-bubbles"></div>
                        </a>

                        <a href="{{ route('user.change-password') }}" class="ocean-quick-link flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r from-blue-50 to-cyan-50 hover:text-gray-900 transition-all duration-300">
                            <div class="flex items-center">
                                <div class="p-2 rounded-full bg-gradient-to-r from-cyan-100 to-cyan-200 text-cyan-600 mr-3 shadow-inner">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Ubah Kata Sandi</h3>
                                    <p class="text-xs text-gray-600">Perbarui informasi keamanan</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <div class="ocean-quick-link-bubbles"></div>
                        </a>

                    </nav>
                </div>
            </div>

            <div class="col-span-2 space-y-6">
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <span>Artikel Saya</span>
                        </h2>
                        <a href="{{ route('user.articles') }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    @if(count($recentArticles) > 0)
                        <div class="space-y-4">
                            @foreach($recentArticles as $article)
                                <div class="bg-gradient-to-br from-white to-blue-50/30 border border-blue-100/60 rounded-xl shadow-sm overflow-hidden transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md">
                                    <div class="p-5">
                                        <div class="flex justify-between items-start">
                                            <h3 class="font-semibold text-gray-900 flex-1">
                                                <a href="{{ route('articles.show', $article) }}" class="hover:text-blue-700">
                                                    {{ $article->judul }}
                                                </a>
                                            </h3>
                                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full
                                                bg-{{ $article->getStatusColor() }}-100 text-{{ $article->getStatusColor() }}-800 ml-2 flex-shrink-0">
                                                {{ ucfirst($article->status) }}
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ Str::limit(strip_tags($article->konten_isi_artikel), 150) }}</p>
                                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                            <div class="flex items-center space-x-4">
                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-4 h-4 mr-1 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $article->tgl_upload->format('d M Y') }}
                                                </div>

                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $article->comments_count ?? 0 }}
                                                </div>

                                                <div class="flex items-center text-xs text-gray-500">
                                                    <svg class="w-4 h-4 mr-1 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $article->reactions_count ?? 0 }}
                                                </div>
                                            </div>
                                            <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center text-xs font-medium text-blue-600 hover:text-blue-800 group relative overflow-hidden">
                                                <span>Baca</span>
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

                        <div class="flex justify-center mt-6">
                            <a href="{{ route('articles.create') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-md transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tulis Artikel Baru
                            </a>
                        </div>
                    @else
                        <div class="text-center py-10 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                            <svg class="mx-auto h-12 w-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada artikel</h3>
                            <p class="mt-1 text-base text-gray-500">Mulai berbagi pengetahuan Anda dengan komunitas.</p>
                            <div class="mt-6">
                                <a href="{{ route('articles.create') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tulis Artikel Pertama
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll" style="animation-delay: 0.2s">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Komunitas Saya</span>
                        </h2>
                        <a href="{{ route('user.communities') }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    @if(count($communities) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($communities as $community)
                                <div class="bg-gradient-to-br from-white to-blue-50/30 border border-blue-100/60 rounded-xl shadow-sm overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-md group">
                                    <div class="h-16 bg-gradient-to-r from-blue-600 to-cyan-600 relative overflow-hidden">
                                        <div class="absolute inset-0">
                                            <div class="w-full h-full deep-sea-bubbles opacity-20"></div>
                                            <div class="w-full h-full marine-light-rays"></div>
                                        </div>

                                        <div class="absolute -bottom-5 left-5">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-100 to-cyan-100 flex items-center justify-center text-blue-700 font-bold text-sm shadow-md border-2 border-white overflow-hidden">
                                                @if($community->gambar)
                                                    <img src="{{ Storage::url($community->gambar) }}" alt="{{ $community->nama }}" class="w-full h-full object-cover">
                                                @else
                                                    {{ strtoupper(substr($community->nama, 0, 2)) }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="p-5 pt-7">
                                        <div class="flex justify-between items-start">
                                            <h3 class="font-medium text-gray-900">{{ $community->nama }}</h3>
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded-full">
                                                {{ $community->members_count ?? 0 }} anggota
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ Str::limit($community->deskripsi, 60) }}</p>
                                        <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                                            <span class="text-gray-500 text-xs">Bergabung {{ \Carbon\Carbon::parse($community->pivot->tg_gabung)->format('M Y') }}</span>
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

                        <div class="flex justify-center mt-6">
                            <a href="{{ route('communities.index') }}" class="inline-flex items-center bg-gradient-to-r  from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-md transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Jelajahi Komunitas Lainnya
                            </a>
                        </div>
                    @else
                        <div class="text-center py-10 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                            <svg class="mx-auto h-12 w-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900">Belum bergabung ke komunitas</h3>
                            <p class="mt-1 text-base text-gray-500">Temukan dan bergabunglah dengan komunitas yang sesuai minat Anda.</p>
                            <div class="mt-6">
                                <a href="{{ route('communities.index') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Jelajahi Komunitas
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll" style="animation-delay: 0.4s">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Aktivitas Terkini</span>
                    </h2>

                    @if(isset($recentActivities) && count($recentActivities) > 0)
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @foreach($recentActivities as $activity)
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
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="text-center py-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                            <p class="text-gray-600">Tidak ada aktivitas terkini.</p>
                        </div>
                    @endif
                </div>
            </div>
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

.ocean-profile-border {
    position: relative;
    border: 2px solid transparent;
    background: linear-gradient(to right, #38bdf8, #0ea5e9, #0284c7);
    background-clip: padding-box;
    box-shadow: 0 0 15px rgba(56, 189, 248, 0.3);
}

.ocean-profile-border::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    z-index: -1;
    background: linear-gradient(45deg, #38bdf8, #0ea5e9, #0284c7, #38bdf8);
    border-radius: inherit;
    animation: rotate 3s linear infinite;
}

.pulse-dot {
    animation: pulse 2s infinite;
}

.ocean-quick-link {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.ocean-quick-link:hover {
    transform: translateX(4px);
}

.ocean-quick-link-bubbles {
    position: absolute;
    bottom: -5px;
    right: 10px;
    width: 20px;
    height: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
    background-image:
        radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.4) 2px, transparent 2px),
        radial-gradient(circle at 70% 30%, rgba(56, 189, 248, 0.3) 1.5px, transparent 1.5px),
        radial-gradient(circle at 30% 40%, rgba(56, 189, 248, 0.4) 1px, transparent 1px);
    animation: quickLinkBubbleRise 3s ease-in-out infinite;
}

.ocean-quick-link:hover .ocean-quick-link-bubbles {
    opacity: 1;
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

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
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

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulse {
    0% { transform: scale(0.95); opacity: 0.5; }
    50% { transform: scale(1.2); opacity: 1; }
    100% { transform: scale(0.95); opacity: 0.5; }
}

@keyframes quickLinkBubbleRise {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
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

    function createRandomBubbles() {
        const container = document.querySelector('.underwater-current');
        if (!container) return;

        for (let i = 0; i < 15; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('random-bubble');

            const size = Math.random() * 10 + 5;
            const left = Math.random() * 100;
            const animationDuration = Math.random() * 15 + 10;
            const delay = Math.random() * 15;

            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.animationDuration = `${animationDuration}s`;
            bubble.style.animationDelay = `${delay}s`;

            container.appendChild(bubble);
        }
    }

    createRandomBubbles();

    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            document.querySelector('.mobile-submenu').classList.toggle('hidden');
        });
    }
});
</script>
@endsection
