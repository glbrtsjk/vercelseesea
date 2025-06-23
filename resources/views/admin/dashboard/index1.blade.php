@extends('layouts.admin')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen pb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>
      <div class="container mx-auto px-4 py-8">
  <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-lg shadow-lg rounded-xl p-6 mb-8 overflow-hidden border-t-4 border-cyan-400">
    <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
        <div>
            <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Admin Dashboard</h1>
            <p class="text-cyan-100 font-medium">Selamat Datang, {{ Auth::user()->name }}</p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
            <a href="{{ route('articles.create') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Artikel Baru
            </a>
            <a href="{{ route('admin.users.usermanage') }}" class="bg-cyan-600/70 hover:bg-cyan-700/80 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-cyan-400/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
               Kelola User
            </a>
        </div>
    </div>

    <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
    <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
    </div>
</div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Total Artikel</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalArticles }}</p>
                    </div>
                </div>
            </div>

        <div class="bg-gradient-to-r from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-sky-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Artikel Pending</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $pendingArticlesCount }}</p>
                    </div>
                </div>
            </div>

            <div class=" bg-gradient-to-r from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Total User</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl  shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Community</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalCommunities }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8 border-t-4 border-blue-500 relative overflow-hidden">
            <div class="flex justify-between items-center mb-6 relative z-10">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-yellow-500 mr-2 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Artikel Pending
                </h2>
                <a href="{{ route('admin.articles.pending') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center transition-all duration-300 hover:translate-x-1">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>

            @if($recentArticles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recentArticles as $article)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:translate-y-[-4px]">
                            @if($article->gambar)
                                <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-r from-blue-300 to-teal-300 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4">
                                <div class="flex items-center mb-3">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold flex items-center">
                                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-1 animate-pulse"></span>
                                        Pending
                                    </span>
                                    <span class="ml-2 text-xs text-gray-500">{{ $article->tgl_upload->format('M d, Y') }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2 hover:text-blue-600 transition-colors duration-300">{{ $article->judul }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($article->konten_isi_artikel), 100) }}</p>

                                <!-- Author info -->
                                <div class="flex items-center mb-4">
                                    <img src="{{ $article->user->foto_profil ? Storage::url($article->user->foto_profil) : asset('img/default-avatar.png') }}"
                                        alt="{{ $article->user->name }}"
                                        class="w-8 h-8 rounded-full mr-2 border-2 border-blue-500">
                                    <span class="text-sm text-gray-700">{{ $article->user->name }}</span>
                                </div>

                                <div class="flex items-center justify-between">
                                    <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center transition-all duration-300 hover:translate-x-1">
                                       Baca Selengkapnya
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                    <div class="flex space-x-2 mt-2">
   <form action="{{ route('admin.articles.approve', $article) }}" method="POST" class="approve-article-form">
    @csrf
    <button type="button" class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-1.5 rounded-lg text-sm font-medium shadow-md transition-all duration-300 hover:shadow-lg flex items-center approve-button">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        Setujui
    </button>
</form>

    <form action="{{ route('admin.articles.reject', $article) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak artikel ini?');">
        @csrf
       <button type="button" class="bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-4 py-1.5 rounded-lg text-sm font-medium shadow-md transition-all duration-300 hover:shadow-lg flex items-center reject-button" data-article-id="{{ $article->article_id }}">
    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
    Tolak
</button>
    </form>
</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $recentArticles->links() }}
                </div>
            @else
                <div class="bg-gray-50 rounded-xl p-6 text-center border border-dashed border-gray-300">
                    <div class="flex justify-center mb-3">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-600 font-medium">Tidak ada artikel yang menunggu persetujuan.</p>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Funfacts Section -->
            <div class="bg-gradient-to-t from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl  shadow-lg p-6 border-t-4 border-purple-500 relative overflow-hidden">
                <div class="flex justify-between items-center mb-6 relative z-10">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Funfact
                    </h2>
                    <a href="{{ route('admin.funfacts.create') }}" class="bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white py-2 px-4 rounded-lg font-medium flex items-center shadow-md transition-all duration-300 hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambahkan Funfact
                    </a>
                </div>

                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-purple-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-purple-500/20 animate-wave-slow opacity-40"></div>

                <div class="space-y-4 relative z-10">
                    @forelse($recentFunfacts as $funfact)
                        <div class="border border-gray-200 rounded-xl p-4 flex items-center bg-white hover:shadow-md transition-all duration-300 hover:translate-x-1">
                            @if($funfact->gambar)
                                <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}" class="w-16 h-16 object-cover rounded-lg mr-4 border border-purple-200">
                            @else
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-800">{{ $funfact->judul }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit($funfact->deskripsi_id, 80) }}</p>
                            </div>
                            <a href="{{ route('admin.funfacts.edit', $funfact) }}" class="text-purple-600 hover:text-purple-800 ml-4 transition-transform duration-300 hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>
                        </div>
                    @empty
                        <div class="bg-gray-50 rounded-xl p-6 text-center border border-dashed border-gray-300">
                            <p class="text-gray-600">No funfacts found.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('funfacts.index') }}" class="text-purple-600 hover:text-purple-800 font-medium inline-flex items-center transition-all duration-300 hover:translate-x-1">
                        Lihat Semua Funfacts
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-t from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl  shadow-lg p-6 border-t-4 border-green-500 relative overflow-hidden">
                <div class="flex justify-between items-center mb-6 relative z-10">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center">
                        <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Tag
                    </h2>
                    <a href="{{ route('admin.tags.create') }}" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white py-2 px-4 rounded-lg font-medium flex items-center shadow-md transition-all duration-300 hover:shadow-lg">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Tag
                    </a>
                </div>

                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-green-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-green-500/20 animate-wave-slow opacity-40"></div>

                <div class="flex flex-wrap gap-3 relative z-10">
                    @forelse($popularTags as $tag)
                        <div class="bg-gradient-to-r from-green-100 to-emerald-100 rounded-full px-4 py-2 flex items-center transform transition-all duration-300 hover:scale-105 hover:shadow-md border border-green-200">
                            <span class="text-gray-800 font-medium">{{ $tag->nama_tag }}</span>
                            <span class="ml-2 bg-white text-green-700 rounded-full px-2 py-0.5 text-xs font-bold shadow-inner">{{ $tag->articles_count }}</span>
                        </div>
                    @empty
                        <div class="bg-gray-50 rounded-xl p-6 text-center w-full border border-dashed border-gray-300">
                            <p class="text-gray-600">Tidak ada tag.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('admin.tags.index') }}" class="text-cyan-600 hover:text-green-800 font-medium inline-flex items-center transition-all duration-300 hover:translate-x-1">
                       Lihat Semua Tag
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl  shadow-lg p-6 border-t-4 border-teal-500 relative overflow-hidden">
            <div class="flex justify-between items-center mb-6 relative z-10">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    User Terbaru
                </h2>
                <a href="{{ route('admin.users.index') }}" class="text-teal-600 hover:text-teal-800 font-medium flex items-center transition-all duration-300 hover:translate-x-1">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <!-- Wave background -->
            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-teal-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-teal-500/20 animate-wave-slow opacity-40"></div>

            <div class="overflow-x-auto relative z-10">
                <table class="min-w-full bg-white rounded-2xl overflow-hidden">
                    <thead class="bg-gradient-to-r from-teal-500 to-cyan-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">User</th>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Bergabung</th>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Artikel</th>
                            <th class="py-3 px-4 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentUsers as $user)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <img src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                                            alt="{{ $user->name }}"
                                            class="w-10 h-10 rounded-full mr-3 border-2 border-teal-500 object-cover">
                                        <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-gray-700">{{ $user->email }}</td>
                                <td class="py-3 px-4 text-gray-700">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="py-3 px-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $user->articles_count ?? 0 }}</span>
                                </td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('admin.users.show', $user) }}" class="text-teal-600 hover:text-teal-800 font-medium transition-all duration-300 hover:translate-x-1 inline-flex items-center">
                                        View
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<div id="rejectionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center rounded-3xl z-50">
    <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-md mx-4 transform transition-all">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Tolak Artikel</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600 close-modal">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="rejectionForm" method="POST">
            @csrf
            <div class="mb-4">
                <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea id="rejection_reason" name="rejection_reason" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Berikan alasan mengapa artikel ini ditolak..." required></textarea>
                <div id="rejection_reason_error" class="text-red-500 text-sm mt-1 hidden">Alasan penolakan harus diisi minimal 10 karakter.</div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200 close-modal">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                    Konfirmasi Penolakan
                </button>
            </div>
        </form>
    </div>
</div>

</div>

@endsection
@section('scripts')
<script>
    // Fixed Admin Dashboard Bubble Ani    Route::match(['get', 'post'], '/articles/{article}/approve', [AdminArticleController::class, 'approve'])->name('approve');
    document.addEventListener('DOMContentLoaded', function() {

          document.querySelectorAll('.approve-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                if (confirm('Apakah Anda yakin ingin menyetujui artikel ini?')) {
                    // Submit the form if confirmed
                    this.closest('.approve-article-form').submit();
                }
            });
        });



          const rejectionModal = document.getElementById('rejectionModal');
        const rejectionForm = document.getElementById('rejectionForm');
        let currentArticleId = null;

        document.querySelectorAll('.reject-button').forEach(button => {
            button.addEventListener('click', function() {
                currentArticleId = this.getAttribute('data-article-id');
                rejectionForm.action = `/admin/articles/${currentArticleId}/reject`;
                rejectionModal.classList.remove('hidden');
                rejectionModal.classList.add('flex');
                document.body.classList.add('overflow-hidden');
            });
        });

        document.querySelectorAll('.close-modal').forEach(button => {
            button.addEventListener('click', function() {
                rejectionModal.classList.add('hidden');
                rejectionModal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                rejectionForm.reset();
            });
        });

        rejectionModal.addEventListener('click', function(e) {
            if (e.target === rejectionModal) {
                rejectionModal.classList.add('hidden');
                rejectionModal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
                rejectionForm.reset();
            }
        });

        rejectionForm.addEventListener('submit', function(e) {
            const reasonField = document.getElementById('rejection_reason');
            const errorDiv = document.getElementById('rejection_reason_error');

            if (reasonField.value.trim().length < 10) {
                e.preventDefault();
                errorDiv.classList.remove('hidden');
                reasonField.classList.add('border-red-500');
                return false;
            } else {
                errorDiv.classList.add('hidden');
                reasonField.classList.remove('border-red-500');
                return true;
            }
        });
        const container = document.querySelector('.bg-gradient-to-r.min-h-screen');

        if (!container) {
            console.error('Bubble container not found');
            return;
        }

        // Function to create a single bubble
        function createBubble() {
            const bubble = document.createElement('div');
            const size = Math.random() * 60 + 20;
            const left = Math.random() * 100;
            const delay = Math.random() * 5;
             const duration = Math.random() * 15 + 10;

            bubble.className = 'admin-bubble';
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.bottom = '-100px';
            bubble.style.animationDuration = `${duration}s`;
            bubble.style.animationDelay = `${delay}s`;

            container.appendChild(bubble);

            setTimeout(() => {
                if (bubble && bubble.parentNode) {
                    bubble.parentNode.removeChild(bubble);
                }
            }, (duration + delay) * 1000);
        }


        for (let i = 0; i < 15; i++) {
            setTimeout(createBubble, i * 300);
        }

        setInterval(createBubble, 2000);
    });
</script>
@endsection

@section('styles')
<style>
@keyframes wave {
  0% {
    transform: translateX(-100%) translateZ(0) scaleY(1);
  }
  50% {
    transform: translateX(-30%) translateZ(0) scaleY(0.8);
  }
  100% {
    transform: translateX(0) translateZ(0) scaleY(1);
  }
}

@keyframes wave-slow {
  0% {
    transform: translateX(0) translateZ(0) scaleY(1);
  }
  50% {
    transform: translateX(-50%) translateZ(0) scaleY(0.8);
  }
  100% {
    transform: translateX(-100%) translateZ(0) scaleY(1);
  }
}

.admin-bubble {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%,
                               rgba(255,255,255,0.8),
                               rgba(255,255,255,0.3) 30%,
                               rgba(255,255,255,0.1) 60%);
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.4),
                inset 0 0 6px rgba(255, 255, 255, 0.4);
    opacity: 0.3;
    z-index: 1;
    animation: bubble-float 15s ease-in infinite;
    pointer-events: none;
    will-change: transform, opacity;
}

@keyframes bubble-float {
    0% {
        transform: translateY(0) translateX(0) scale(0.4);
        opacity: 0;
    }
    10% {
        opacity: 0.3;
        transform: translateY(-20vh) translateX(5px) scale(0.6);
    }
    40% {
        opacity: 0.4;
        transform: translateY(-40vh) translateX(-10px) scale(0.8);
    }
    70% {
        opacity: 0.3;
        transform: translateY(-70vh) translateX(10px) scale(0.9);
    }
    90% {
        opacity: 0.2;
    }
    100% {
        transform: translateY(-100vh) translateX(-5px) scale(0.7);
        opacity: 0;
    }
}

.animate-wave {
    animation: wave 8s linear infinite;
}

.animate-wave-slow {
    animation: wave-slow 12s linear infinite;
}

.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(83, 157, 196) 0%, rgb(65, 120, 183) 100%);
}

.absolute.inset-0.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(109, 176, 214) 0%, rgb(52, 149, 190) 100%);
    opacity: 0.9 !important; /* Increase opacity */
}

.bg-gradient-to-r.min-h-screen::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        45deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.03) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    background-size: 200% 200%;
    animation: shimmer 10s infinite ease-in-out;
    pointer-events: none;
    z-index: 2;
}

@keyframes shimmer {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}
.text-shadow {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.stats-card {
    @apply bg-gradient-to-br from-blue-600/90 to-sky-500/80 backdrop-blur-lg rounded-xl shadow-lg p-6 border-l-4 border-cyan-400 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 text-white relative overflow-hidden;
}

.stats-card h2 {
    @apply text-cyan-100 font-semibold;
}

.stats-card p {
    @apply text-3xl font-bold text-white;
}

.stats-card .stats-icon {
    @apply p-3 rounded-xl bg-white/15 text-white backdrop-blur-md border border-white/10;
}

.particle {
    position: absolute;
    background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    opacity: 0.3;
}

.particle-1 {
    width: 80px;
    height: 80px;
    top: 10%;
    left: 10%;
    animation: float 20s infinite ease-in-out;
}

.particle-2 {
    width: 50px;
    height: 50px;
    top: 20%;
    right: 20%;
    animation: float 15s infinite ease-in-out reverse;
}
.particle-3 {
    width: 35px;
    height: 35px;
    bottom: 30%;
    left: 30%;
    animation: float 25s infinite ease-in-out 5s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) translateX(0);
    }
    25% {
        transform: translateY(-15px) translateX(15px);
    }
    50% {
        transform: translateY(8px) translateX(-8px);
    }
    75% {
        transform: translateY(-5px) translateX(10px);
    }
}
</style>
@endsection
