@extends('layouts.app')

@section('title', 'Artikel Saya')

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
            <h1 class="text-3xl font-bold mb-2">Artikel Saya</h1>
            @if(Auth::check())
                <p class="mt-2">Kelola semua publikasi Anda di satu tempat.</p>
            @endif

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
                    <a href="{{ route('user.articles') }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active">
                        <i class="fas fa-newspaper mr-2"></i> Artikel Saya
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.communities') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
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

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-8">
            <div class="bg-gradient-to-br from-white/90 to-blue-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-blue-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-blue-500/5 rounded-full -mb-8 -ml-8"></div>

                <div class="relative p-6 z-10">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-600 mr-4 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Artikel</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ $articles->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white/90 to-green-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-green-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                <div class="absolute top-0 right-0 w-20 h-20 bg-green-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-green-500/5 rounded-full -mb-8 -ml-8"></div>

                <div class="relative p-6 z-10">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-600 mr-4 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Dipublikasikan</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ $articles->where('status', 'published')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white/90 to-yellow-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-yellow-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                <div class="absolute top-0 right-0 w-20 h-20 bg-yellow-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-yellow-500/5 rounded-full -mb-8 -ml-8"></div>

                <div class="relative p-6 z-10">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-600 mr-4 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Menunggu</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ $articles->where('status', 'pending')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-white/90 to-purple-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-purple-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                <div class="absolute top-0 right-0 w-20 h-20 bg-purple-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-purple-500/5 rounded-full -mb-8 -ml-8"></div>

                <div class="relative p-6 z-10">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-gradient-to-r from-purple-100 to-purple-200 text-purple-600 mr-4 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Draft</p>
                            <h4 class="text-2xl font-bold text-gray-800">{{ $articles->where('status', 'draft')->count() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <span>Semua Artikel</span>
                </h2>

                <div class="flex gap-3">
                    <div class="relative">
                        <form action="{{ route('user.articles') }}" method="GET">
                            <div class="flex items-center bg-white border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500">
                                <input type="text" name="search" placeholder="Cari artikel..." class="flex-1 px-4 py-2 text-sm focus:outline-none" value="{{ request('search') }}">
                                <button type="submit" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>
                    <a href="{{ route('articles.create') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-md transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tulis Artikel
                    </a>
                </div>
            </div>

            @if(count($articles) > 0)
                <div class="overflow-x-auto fade-in-up animate-on-scroll">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-50 to-cyan-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Publikasi</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statistik</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($articles as $article)
                                <tr class="hover:bg-blue-50/40 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($article->gambar)
                                                <div class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg shadow-sm">
                                                    <img class="h-12 w-12 object-cover transform transition-transform group-hover:scale-110"
                                                        src="{{ Storage::url($article->gambar) }}"
                                                        alt="{{ $article->judul }}">
                                                </div>
                                            @else
                                                <div class="h-12 w-12 flex-shrink-0 rounded-lg bg-gradient-to-br from-blue-400/70 to-cyan-400/70 flex items-center justify-center text-white">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <a href="{{ route('articles.show', $article) }}" class="font-medium text-blue-600 hover:text-blue-900 hover:underline">
                                                    {{ Str::limit($article->judul, 40) }}
                                                </a>
                                                <div class="text-xs text-gray-500">
                                                    {{ $article->category->nama_kategori ?? 'Tanpa Kategori' }}
                                                    <span class="mx-1">•</span>
                                                    <span>{{ Str::limit(strip_tags($article->isi), 40) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($article->status == 'published')
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Dipublikasikan
                                            </span>
                                        @elseif($article->status == 'draft')
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                Draft
                                            </span>
                                        @elseif($article->status == 'pending')
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Menunggu
                                            </span>
                                        @elseif($article->status == 'rejected')
                                            <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ App\Helpers\IndonesiaTimeHelper::formatDate($article->tgl_upload) }}
                                            <span class="ml-1.5 text-xs text-gray-400">{{ App\Helpers\IndonesiaTimeHelper::diffForHumans($article->tgl_upload) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center" title="Komentar">
                                                <div class="p-1.5 rounded-full bg-blue-50 text-blue-500 mr-2">
                                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <span>{{ $article->comments_count ?? 0 }}</span>
                                            </div>
                                            <div class="flex items-center" title="Reaksi">
                                                <div class="p-1.5 rounded-full bg-red-50 text-red-500 mr-2">
                                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                                <span>{{ $article->reactions_count ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('articles.show', $article) }}" class="text-cyan-600 hover:text-cyan-900 transition-colors">
                                                <div class="p-1.5 rounded-full bg-cyan-50 hover:bg-cyan-100" title="Lihat">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                            @if($article->status == 'draft' || $article->status == 'rejected')
                                                <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:text-blue-900 transition-colors">
                                                    <div class="p-1.5 rounded-full bg-blue-50 hover:bg-blue-100" title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                    </div>
                                                </a>
                                            @endif
                                            @if($article->status == 'draft')
                                                <form method="POST" action="{{ route('articles.submit', $article) }}" class="inline-block">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 transition-colors">
                                                        <div class="p-1.5 rounded-full bg-green-50 hover:bg-green-100" title="Kirim untuk review">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                        </div>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl fade-in-up animate-on-scroll">
                    <svg class="mx-auto h-16 w-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-800">Belum Ada Artikel</h3>
                    <p class="mt-2 text-gray-600 max-w-md mx-auto">Mulai perjalanan berbagi pengetahuan Anda dengan menulis artikel pertama.</p>
                    <div class="mt-8">
                        <a href="{{ route('articles.create') }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tulis Artikel Pertama
                        </a>
                    </div>
                    <div class="absolute bottom-0 right-0 w-40 h-40 bg-cyan-500/5 rounded-full -mb-20 -mr-20"></div>
                    <div class="absolute top-0 left-0 w-20 h-20 bg-blue-500/5 rounded-full -mt-10 -ml-10"></div>
                </div>
            @endif
        </div>

        @if(count($articles) > 0 && $articles->where('status', 'published')->count() > 0)
            <div class="mt-8 bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span>Statistik Artikel</span>
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-6 rounded-xl">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Artikel Terpopuler</h3>
                        @php
                            $popularArticle = $articles->where('status', 'published')->sortByDesc('reactions_count')->first();
                        @endphp
                        @if($popularArticle)
                            <div class="relative overflow-hidden rounded-lg bg-white p-4 shadow-sm transform transition hover:-translate-y-1 hover:shadow-md group">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @if($popularArticle->gambar)
                                            <img src="{{ Storage::url($popularArticle->gambar) }}" alt="{{ $popularArticle->judul }}" class="h-16 w-16 rounded-lg object-cover">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center text-white">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h4 class="font-medium text-gray-900">
                                            <a href="{{ route('articles.show', $popularArticle) }}" class="hover:text-blue-700">
                                                {{ Str::limit($popularArticle->judul, 60) }}
                                            </a>
                                        </h4>
                                        <p class="mt-1 text-xs text-gray-500">{{ $popularArticle->tgl_upload->format('d M Y') }}</p>
                                        <div class="mt-2 flex items-center space-x-4">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 text-red-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $popularArticle->reactions_count }} reaksi
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 text-blue-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $popularArticle->comments_count }} komentar
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 border-t border-gray-100 pt-3">
                                    <p class="text-sm text-gray-600">
                                        {{ Str::limit(strip_tags($popularArticle->isi), 120) }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                        @endif
                    </div>

                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-xl">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Artikel Terbaru</h3>
                        @php
                            $recentArticle = $articles->where('status', 'published')->sortByDesc('tgl_upload')->first();
                        @endphp
                        @if($recentArticle)
                            <div class="relative overflow-hidden rounded-lg bg-white p-4 shadow-sm transform transition hover:-translate-y-1 hover:shadow-md group">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0">
                                        @if($recentArticle->gambar)
                                            <img src="{{ Storage::url($recentArticle->gambar) }}" alt="{{ $recentArticle->judul }}" class="h-16 w-16 rounded-lg object-cover">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gradient-to-br from-purple-400 to-indigo-400 flex items-center justify-center text-white">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h4 class="font-medium text-gray-900">
                                            <a href="{{ route('articles.show', $recentArticle) }}" class="hover:text-purple-700">
                                                {{ Str::limit($recentArticle->judul, 60) }}
                                            </a>
                                        </h4>
                                        <p class="mt-1 text-xs text-gray-500">{{ $recentArticle->tgl_upload->format('d M Y') }}</p>
                                        <div class="mt-2 flex items-center space-x-4">
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 text-red-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $recentArticle->reactions_count }} reaksi
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 text-blue-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                                </svg>
                                                {{ $recentArticle->comments_count }} komentar
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 border-t border-gray-100 pt-3">
                                    <p class="text-sm text-gray-600">
                                        {{ Str::limit(strip_tags($recentArticle->isi), 120) }}
                                    </p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-600">Belum ada artikel yang dipublikasikan.</p>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Tips and Resources -->
        <div class="mt-8 bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Tips Menulis</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-5 border border-blue-100 rounded-xl bg-gradient-to-br from-blue-50/50 to-cyan-50/50 hover:shadow-md transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-blue-100 rounded-full text-blue-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Judul yang Menarik</h3>
                    </div>
                    <p class="text-sm text-gray-600">Buatlah judul yang informatif dan menarik. Ini adalah kesan pertama dan sangat menentukan apakah artikelmu akan dibaca atau tidak.</p>
                </div>

                <div class="p-5 border border-blue-100 rounded-xl bg-gradient-to-br from-green-50/50 to-teal-50/50 hover:shadow-md transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-green-100 rounded-full text-green-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Gunakan Visual</h3>
                    </div>
                    <p class="text-sm text-gray-600">Tambahkan gambar atau ilustrasi yang relevan untuk membuat artikelmu lebih menarik dan membantu pembaca memahami kontenmu.</p>
                </div>

                <div class="p-5 border border-blue-100 rounded-xl bg-gradient-to-br from-purple-50/50 to-indigo-50/50 hover:shadow-md transition transform hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <div class="p-2 bg-purple-100 rounded-full text-purple-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Struktur yang Jelas</h3>
                    </div>
                    <p class="text-sm text-gray-600">Gunakan paragraf pendek, subjudul, dan daftar poin untuk membuat artikelmu mudah dibaca dan dipahami oleh pembaca.</p>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('articles.create') }}" class="inline-flex items-center py-2.5 px-5 text-sm font-medium text-blue-600 hover:text-blue-800">
                    <span>Mulai menulis sekarang</span>
                    <svg class="w-4 h-4 ml-1 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
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

/* Animation Utilities */
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

/* Animation Keyframes */
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

.status-badge {
    position: relative;
    overflow: hidden;
}

.status-badge::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.4) 50%, rgba(255,255,255,0) 100%);
    transform: translateX(-100%);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    100% {
        transform: translateX(100%);
    }
}

thead {
    position: relative;
}

thead::after {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 1px;
    background: linear-gradient(to right, rgba(59, 130, 246, 0.1), rgba(14, 165, 233, 0.3), rgba(59, 130, 246, 0.1));
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
