@extends('layouts.app')

@section('title', 'Hasil Pencarian: ' . request('query'))

@section('content')
<section class="bg-gradient-to-r h-[65vh] from-blue-800 via-blue-900 to-teal-900 text-white py-19 relative overflow-hidden">
    <!-- Efek latar belakang laut -->
    <div class="absolute inset-0 z-0">
        <div class="underwater-bubbles-overlay opacity-20"></div>
        <img src="{{ asset('home/search.jpg') }}" alt="Ocean Background" class="w-full h-full object-cover absolute inset-0 opacity-30">
        <div class="light-rays absolute inset-0"></div>
      <div class="absolute inset-0 bg-gradient-to-b from-blue-900/40 via-blue-700/30 to-teal-600/30 animate-pulse-slow"></div>

        <div class="absolute inset-0 opacity-10 mix-blend-overlay animate-drift-slow"
            style="background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNjAiIGhlaWdodD0iMTYwIiB2aWV3Qm94PSIwIDAgMTYwIDE2MCI+CiAgPCEtLSBFbmhhbmNlZCBEZWZpbml0aW9ucyBmb3IgQmV0dGVyIFVuZGVyd2F0ZXIgRWZmZWN0cyAtLT4KICA8ZGVmcz4KICAgIDwhLS0gQnViYmxlIGdyYWRpZW50cyAtLT4KICAgIDxyYWRpYWxHcmFkaWVudCBpZD0iYnViYmxlR3JhZGllbnQxIiBjeD0iMzAlIiBjeT0iMzAlIiByPSI3MCUiIGZ4PSIzMCUiIGZ5PSIzMCUiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjZmZmZmZmIiBzdG9wLW9wYWNpdHk9IjAuOTUiLz4KICAgICAgPHN0b3Agb2Zmc2V0PSI2MCUiIHN0b3AtY29sb3I9IiNmZmZmZmYiIHN0b3Atb3BhY2l0eT0iMC41Ii8+CiAgICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2ZmZmZmZiIgc3RvcC1vcGFjaXR5PSIwLjEiLz4KICAgIDwvcmFkaWFsR3JhZGllbnQ+CiAgPC9kZWZzPgogIDwhLS0gRW5oYW5jZWQgQnViYmxlcyAtLT4KICA8Y2lyY2xlIGN4PSIyMCIgY3k9IjMwIiByPSI4IiBmaWxsPSJ1cmwoI2J1YmJsZUdyYWRpZW50MSkiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjUiIG9wYWNpdHk9IjAuOCIvPgogIDxjaXJjbGUgY3g9IjYwIiBjeT0iMTUiIHI9IjUiIGZpbGw9InVybCgjYnViYmxlR3JhZGllbnQxKSIgc3Ryb2tlPSIjZmZmZmZmIiBzdHJva2Utd2lkdGg9IjAuNCIgb3BhY2l0eT0iMC43Ii8+CiAgPGNpcmNsZSBjeD0iMTAwIiBjeT0iNDAiIHI9IjEwIiBmaWxsPSJ1cmwoI2J1YmJsZUdyYWRpZW50MSkiIHN0cm9rZT0iI2ZmZmZmZiIgc3Ryb2tlLXdpZHRoPSIwLjUiIG9wYWNpdHk9IjAuNzUiLz4KICA8Y2lyY2xlIGN4PSIxMzAiIGN5PSIyMCIgcj0iNiIgZmlsbD0idXJsKCNidWJibGVHcmFkaWVudDEpIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMC40IiBvcGFjaXR5PSIwLjciLz4KPC9zdmc+');">
        </div>
    </div>

    <div class="absolute inset-0 z-5">
        <div class="deep-sea-bubbles absolute inset-0"></div>
        <div class="floating-particles absolute inset-0"></div>

    </div>

    <div class="container mx-auto px-4 relative z-10">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-reveal leading-tight">Hasil Pencarian</h1>
        <p class="text-xl mb-8 text-cyan-100 text-reveal-delay-1">
            Menampilkan hasil untuk "<span class="font-semibold">{{ request('query') }}</span>"
        </p>

        <!-- Form Pencarian yang Ditingkatkan -->
        <form action="{{ route('articles.search') }}" method="GET" class="flex flex-col md:flex-row gap-4 max-w-4xl animate-on-scroll bg-white/10 backdrop-blur-xl p-6 rounded-2xl border border-white/30">
            <div class="flex-grow relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="query" placeholder="Cari artikel kelautan..." value="{{ request('query') }}" class="w-full pl-12 pr-4 py-3 rounded-xl text-gray-800 bg-white/90 backdrop-blur-sm border-0 focus:ring-4 focus:ring-cyan-500/50 transition-all duration-300">
            </div>
            <div class="w-full md:w-1/3">
                <select name="category" class="w-full px-4 py-3 rounded-xl text-gray-800 bg-white/90 backdrop-blur-sm border-0 focus:ring-4 focus:ring-cyan-500/50 appearance-none">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-medium transition duration-300 flex items-center justify-center shadow-lg shadow-blue-600/30">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
            </div>
        </form>
    </div>


<div class="absolute bottom-0 left-0 w-full overflow-hidden leading-0 z-0">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
        <defs>
         <linearGradient id="waveGradient" x1="0%" y1="0%" x2="0%" y2="100%">
    <stop offset="0%" stop-color="#22526b" />
    <stop offset="25%" stop-color="#1352ab" />
    <stop offset="50%" stop-color="#275d9c  " /> 
</linearGradient>
        </defs>
        <path fill="url(#waveGradient)" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
</div>
</section>

<!-- Hasil Pencarian -->
<section class="py-16 bg-gradient-to-b from-blue-50 via-cyan-50 to-blue-50 relative">
  
    <div class="absolute inset-0 z-0 floating-particles opacity-30"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Statistik Hasil -->
        <div class="mb-10 flex flex-col md:flex-row justify-between items-center gap-6 bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-cyan-100/50 animate-on-scroll">
            <div>
                <p class="text-gray-700 font-medium flex items-center">
                    <svg class="w-5 h-5 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Ditemukan <span class="font-bold text-cyan-700"> {{ $articles->total() }}</span>  hasil
                </p>
                @if(request('category'))
                    <p class="text-sm text-gray-500 mt-1">
                        Difilter berdasarkan kategori: <span class="font-medium">{{ $categoryName ?? 'Semua Kategori' }}</span>
                    </p>
                @endif
            </div>
            <div class="flex gap-3">
                <a href="{{ route('articles.index') }}" class="text-blue-600 hover:text-blue-800 font-medium flex items-center group">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                    </svg>
                    Lihat Semua Artikel
                </a>
                <a href="{{ url()->current() }}" class="text-green-600 hover:text-green-800 font-medium flex items-center group">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Segarkan Pencarian
                </a>
            </div>
        </div>

        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $index => $article)
                    <div class="bg-white/80 backdrop-blur-xl rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 border border-white/50 flex flex-col animate-on-scroll transform hover:-translate-y-1" style="animation-delay: {{ $index * 0.1 }}s">
                        <a href="{{ route('articles.show', $article) }}" class="block h-48 overflow-hidden relative group">
                            @if($article->gambar)
                                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-400 via-cyan-400 to-teal-400 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 underwater-pattern opacity-20"></div>
                                    <svg class="w-16 h-16 text-white/60 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Overlay efek hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/80 via-blue-800/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <div class="text-white">
                                    <p class="font-medium text-sm">Lihat detail artikel</p>
                                    <div class="mt-2 flex items-center text-xs space-x-3">
                                        <span class="flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $article->tgl_upload->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ rand(50, 500) }} dilihat
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center flex-wrap gap-2 mb-3">
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md font-medium">{{ $article->category->nama_kategori }}</span>
                                <span class="text-xs text-gray-500">{{ $article->tgl_upload->locale('id')->isoFormat('D MMMM Y') }}</span>

                                <div class="flex items-center ml-auto text-gray-500 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                                    </svg>
                                    {{ $article->reactions->count() }}
                                </div>
                            </div>

                            <a href="{{ route('articles.show', $article) }}" class="block group">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-600 transition duration-300 line-clamp-2">{{ $article->judul }}</h3>
                            </a>

                            <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-3 flex-grow">
                                {{ Str::limit(strip_tags($article->konten_isi_artikel), 150) }}
                            </p>

                            <!-- Tag artikel -->
                            @if($article->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($article->tags->take(3) as $tag)
                                        <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}"
                                           class="text-xs text-blue-600 hover:text-blue-800 hover:underline">#{{ $tag->nama_tag }}</a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex items-center">
                                    <img src="{{ $article->user->profile_photo_url ?? asset('images/default-avatar.png') }}"
                                         alt="{{ $article->user->nama }}"
                                         class="w-8 h-8 rounded-full mr-2 border border-gray-200">
                                    <span class="text-sm text-gray-700">{{ $article->user->nama }}</span>
                                </div>
                                <a href="{{ route('articles.show', $article) }}"
                                   class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center group">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white/70 backdrop-blur-md rounded-3xl shadow-lg">
                <div class="mx-auto w-36 h-36 mb-6 bg-gradient-to-br from-blue-50 to-cyan-100 rounded-full flex items-center justify-center">
                    <svg class="w-20 h-20 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Tidak Ada Hasil Ditemukan</h3>
                <p class="text-gray-600 mb-8 max-w-xl mx-auto">Kami tidak dapat menemukan artikel yang sesuai dengan pencarian "{{ request('query') }}"</p>

                <div class="space-y-6">
                    <p class="text-gray-700 font-medium">Silakan coba:</p>
                    <ul class="text-gray-600 space-y-3 max-w-xs mx-auto text-left">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-cyan-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Gunakan kata kunci yang lebih umum</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-cyan-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Periksa ejaan kata pencarian Anda</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-cyan-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Cari di semua kategori</span>
                        </li>
                    </ul>

                    <div class="pt-6">
                        <a href="{{ route('articles.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white font-medium rounded-xl hover:from-blue-700 hover:to-cyan-700 transition duration-300 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Jelajahi Semua Artikel
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Tag Terkait -->
@if(isset($relatedTags) && count($relatedTags) > 0)
<section class="py-12 bg-gradient-to-r from-cyan-50 to-blue-50 border-t border-cyan-100">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <svg class="w-6 h-6 text-cyan-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            Topik Terkait
        </h2>
        <div class="flex flex-wrap gap-3">
            @foreach($relatedTags as $tag)
                <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}"
                   class="px-6 py-3 bg-white hover:bg-blue-50 rounded-full text-gray-700 text-sm font-medium transition duration-300 shadow-sm border border-gray-100 flex items-center group">
                    <span class="w-2 h-2 bg-cyan-500 rounded-full mr-2"></span>
                    #{{ $tag->nama_tag }}
                    <svg class="w-4 h-4 ml-2 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
       :root {
        --ocean-surface: #e0f7ff;
        --ocean-shallow: #bae6fd;
        --ocean-medium: #38bdf8;
        --ocean-deep: #0284c7;
        --ocean-abyss: #075985;
        --coral-accent: #fb7185;
        --sand-light: #fef3c7;
        --seaweed-accent: #10b981;
    }

    .underwater-bubbles-overlay {
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.25) 4px, transparent 5px),
            radial-gradient(circle at 45% 75%, rgba(56, 189, 248, 0.22) 5px, transparent 6px),
            radial-gradient(circle at 75% 65%, rgba(59, 130, 246, 0.18) 3px, transparent 4px),
            radial-gradient(circle at 85% 85%, rgba(14, 165, 233, 0.25) 4px, transparent 5px),
            radial-gradient(circle at 25% 25%, rgba(56, 189, 248, 0.2) 2px, transparent 3px);
        background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
        animation: bubbleRise 30s linear infinite;
    }

    .deep-sea-bubbles::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 50% 80%, rgba(255, 255, 255, 0.8) 2px, transparent 3px),
            radial-gradient(circle at 80% 60%, rgba(56, 189, 248, 0.8) 1px, transparent 2px),
            radial-gradient(circle at 20% 40%, rgba(59, 130, 246, 0.6) 1px, transparent 2px),
            radial-gradient(circle at 70% 30%, rgba(14, 165, 233, 0.7) 1px, transparent 2px);
        background-size: 80px 80px, 60px 60px, 70px 70px, 80px 80px;
        animation: bubbleRiseSmall 45s linear infinite;
        opacity: 0.5;
    }

    .deep-sea-bubbles::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.8) 1px, transparent 2px),
            radial-gradient(circle at 60% 40%, rgba(16, 185, 129, 0.6) 2px, transparent 3px),
            radial-gradient(circle at 10% 50%, rgba(20, 184, 166, 0.6) 1px, transparent 2px);
        background-size: 100px 100px, 80px 80px, 60px 60px;
        animation: bubbleRiseSmall 30s linear infinite;
        opacity: 0.6;
    }

    .underwater-bubbles-overlay {
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 5px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.12) 5px, transparent 6px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.18) 3px, transparent 4px),
            radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 5px),
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 3px);
        background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
        animation: bubbleRise 30s linear infinite;
    }

    @keyframes bubbleRise {
        0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%, 0 100%; }
        100% { background-position: 0 -400px, 0 -500px, 0 -300px, 0 -450px, 0 -250px; }
    }
     @keyframes bubbleRiseSmall {
        0% { background-position: 0 0, 0 0, 0 0, 0 0; }
        100% { background-position: 0 -500px, 50px -400px, -30px -350px, 20px -450px; }
    }

    .light-rays {
        background: linear-gradient(45deg,
            transparent 30%,
            rgba(120, 220, 255, 0.1) 40%,
            rgba(120, 220, 255, 0.05) 50%,
            transparent 60%
        );
        background-size: 200px 200px;
        animation: lightRaysFlow 15s ease-in-out infinite;
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

    .floating-particles {
        background-image:
            radial-gradient(circle at 10% 20%, rgba(34, 211, 238, 0.05) 1px, transparent 1px),
            radial-gradient(circle at 30% 60%, rgba(59, 130, 246, 0.05) 1px, transparent 1px),
            radial-gradient(circle at 70% 90%, rgba(20, 184, 166, 0.05) 1px, transparent 1px),
            radial-gradient(circle at 90% 30%, rgba(16, 185, 129, 0.05) 1px, transparent 1px);
        background-size: 100px 100px, 130px 130px, 110px 110px, 90px 90px;
        animation: particleFlow 25s linear infinite;
    }

    @keyframes particleFlow {
        0% {
            background-position: 0 0, 0 0, 0 0, 0 0;
        }
        100% {
            background-position: 100px 100px, -130px 130px, 110px -110px, -90px 90px;
        }
    }
     @keyframes drift-slow {
        0% { transform: translateX(0) translateY(0); }
        50% { transform: translateX(-2%) translateY(1%); }
        100% { transform: translateX(0) translateY(0); }
    }

    @keyframes pulse-slow {
        0%, 100% { opacity: 0.7; }
        50% { opacity: 0.9; }
    }

    .animate-drift-slow {
        animation: drift-slow 20s ease-in-out infinite;
    }

    .animate-pulse-slow {
        animation: pulse-slow 8s ease-in-out infinite;
    }

    .underwater-pattern {
        background-image:
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
            radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.08) 3px, transparent 3px);
        background-size: 50px 50px, 80px 80px;
        animation: patternFloat 20s linear infinite;
    }

    @keyframes patternFloat {
        0% { background-position: 0 0, 0 0; }
        100% { background-position: 50px 50px, -80px 80px; }
    }

    /* Animasi teks dan elemen */
    .text-reveal {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 0.8s ease-out 0.1s forwards;
    }

    .text-reveal-delay-1 {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 0.8s ease-out 0.3s forwards;
    }

    @keyframes textReveal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease-out;
    }

    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Animasi untuk pagination dan elemen hover */
    .pagination {
        transition: all 0.3s ease;
    }

    .pagination > span,
    .pagination a {
        transition: all 0.2s ease;
    }

    .pagination > span:hover,
    .pagination a:hover {
        transform: translateY(-2px);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('.animate-on-scroll').forEach((el) => {
        observer.observe(el);
    });

    // Efek hover untuk card
    document.querySelectorAll('.card-hover').forEach((card) => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
            this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.15)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
});
</script>
@endsection
