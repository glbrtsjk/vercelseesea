{{-- filepath: c:\xampp\htdocs\projectpwl\resources\views\articles\index.blade.php --}}
@extends('layouts.app')

@section('title', 'Artikel Pelestarian Laut - Melindungi Ekosistem Laut')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
    <!-- Latar Belakang Laut Beranimasi -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-400/10 via-cyan-500/10 to-teal-600/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <!-- Header Utama dengan Fokus Konservasi -->
    <section class="bg-gradient-to-br from-blue-800 via-blue-900 to-teal-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0 deep-sea-bubbles opacity-30"></div>
        <div class="absolute inset-0 z-0 bg-cover bg-center opacity-20"
             style="background-image: url('https://images.unsplash.com/photo-1583212292454-1fe6229603b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');"></div>

        <!-- Efek Gelombang Dinamis -->
        <div class="absolute inset-0 z-0">
            <div class="wave-overlay-1"></div>
            <div class="wave-overlay-2"></div>
            <div class="wave-overlay-3"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Badge Status -->
                <div class="inline-flex items-center bg-white/15 backdrop-blur-md rounded-full px-8 py-4 mb-8 animate-on-scroll border border-white/20">
                    <div class="w-4 h-4 bg-cyan-300 rounded-full mr-4 animate-pulse"></div>
                    <span class="text-cyan-100 font-semibold text-lg">Melindungi Warisan Laut Kita</span>
                </div>

                <!-- Judul Utama -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-8 leading-tight text-reveal">
                    <span class="gradient-text-enhanced">Melestarikan</span>
                    <br class="md:hidden">
                    Laut <span class="gradient-text-enhanced">Bersama</span>
                </h1>

                <!-- Deskripsi -->
                <p class="text-xl md:text-2xl text-cyan-100 max-w-4xl mx-auto leading-relaxed mb-12 text-reveal-delay-1">
                    Temukan inisiatif konservasi, upaya perlindungan laut, dan bagaimana kita bekerja sama menyelamatkan samudra untuk generasi mendatang
                </p>

                <!-- Form Pencarian yang Ditingkatkan -->
                <form action="{{ route('articles.search') }}" method="GET"
                      class="max-w-4xl mx-auto bg-white/10 backdrop-blur-xl p-6 rounded-3xl border border-white/30 text-reveal-delay-2 shadow-2xl">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                        <!-- Input Pencarian -->
                        <div class="md:col-span-6 relative">
                            <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="query" placeholder="Cari topik konservasi..." value="{{ request('query') }}"
                                class="w-full pl-16 pr-6 py-4 rounded-2xl text-gray-800 bg-white/90 backdrop-blur-sm border-0 focus:ring-4 focus:ring-cyan-500/50 transition-all duration-300 font-medium">
                        </div>

                        <!-- Dropdown Kategori -->
                        <div class="md:col-span-4">
                            <select name="category" class="w-full py-4 px-6 rounded-2xl text-gray-800 bg-white/90 backdrop-blur-sm border-0 focus:ring-4 focus:ring-cyan-500/50 appearance-none font-medium transition-all duration-300">
                                <option value="">Semua Area Konservasi</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Cari -->
                        <div class="md:col-span-2">
                            <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-4 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center shadow-xl shadow-blue-700/30 transform hover:scale-105">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <span class="ml-2 hidden lg:block">Cari</span>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Statistik Konservasi -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16 text-reveal-delay-3">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <div class="text-3xl font-bold text-cyan-300 mb-2">{{ $articles->total() }}+</div>
                        <div class="text-cyan-100 text-sm">Artikel Konservasi</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <div class="text-3xl font-bold text-cyan-300 mb-2">{{ $categories->count() }}</div>
                        <div class="text-cyan-100 text-sm">Kategori</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <div class="text-3xl font-bold text-cyan-300 mb-2">{{ $tags->count() }}+</div>
                        <div class="text-cyan-100 text-sm">Tag Konservasi</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                        <div class="text-3xl font-bold text-cyan-300 mb-2">1M+</div>
                        <div class="text-cyan-100 text-sm">Pembaca</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pembagi Gelombang -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1"
                      d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,208C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Filter Kategori dengan Desain Baru -->
    <section class="bg-white/90 backdrop-blur-md border-b border-cyan-200 sticky top-16 z-40 shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
                <!-- Label -->
                <div class="flex items-center gap-3">
                    <h3 class="text-lg font-bold text-gray-800">Filter Kategori:</h3>
                </div>

                <!-- Tabs Kategori -->
                <div class="flex flex-wrap gap-3 items-center overflow-x-auto">
                    <a href="{{ route('articles.index') }}"
                       class="px-6 py-3 whitespace-nowrap rounded-full text-sm font-semibold transition-all duration-300 {{ !request('category') ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30 transform scale-105' : 'bg-gray-100 hover:bg-blue-50 text-gray-800 hover:text-blue-600' }}">
                        <i class="fas fa-globe mr-2"></i>Semua Inisiatif
                    </a>

                    @foreach($categories as $category)
                        <a href="{{ route('articles.index', ['category' => $category->category_id]) }}"
                           class="px-6 py-3 whitespace-nowrap rounded-full text-sm font-semibold transition-all duration-300 {{ request('category') == $category->category_id ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-lg shadow-blue-500/30 transform scale-105' : 'bg-gray-100 hover:bg-blue-50 text-gray-800 hover:text-blue-600' }}">
                            {{ $category->nama_kategori }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Tag Konservasi -->
    <section class="bg-gradient-to-r from-cyan-50 to-blue-50 py-6 backdrop-blur-sm border-b border-cyan-100">
        <div class="container mx-auto px-4">
            <div class="flex items-center flex-wrap gap-4">
                <span class="text-sm font-bold text-gray-700 flex items-center">
                    <i class="fas fa-tags mr-2 text-cyan-600"></i>
                    Upaya Konservasi Utama:
                </span>
                <div class="flex flex-wrap gap-3">
                    @foreach($tags as $tag)
                        <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}"
                           class="px-4 py-2 text-sm rounded-full bg-white border-2 border-cyan-200 hover:border-cyan-500 text-gray-700 transition-all duration-300 hover:bg-cyan-50 shadow-sm flex items-center hover:scale-105">
                           <span class="w-2 h-2 bg-cyan-500 rounded-full mr-2 animate-pulse"></span>
                           {{ $tag->nama_tag }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Artikel Unggulan Konservasi -->
    @if(isset($featuredArticle) && $featuredArticle)
    <section class="py-16 bg-gradient-to-b from-blue-50 to-transparent relative z-10">
        <div class="container mx-auto px-4">
            <!-- Header Bagian -->
            <div class="text-center mb-12 animate-on-scroll">
                <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-600 px-8 py-3 rounded-full mb-6 font-bold border border-green-200">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    Proyek Konservasi Unggulan
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    <span class="gradient-text-enhanced">Sorotan</span> Konservasi
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Temukan proyek konservasi laut yang sedang membuat dampak nyata dalam pelestarian ekosistem maritim
                </p>
            </div>

            <!-- Kartu Artikel Unggulan -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl border border-white/50 card-hover-enhanced animate-on-scroll">
                <div class="grid lg:grid-cols-2 gap-0">
                    <!-- Gambar -->
                    <div class="relative h-80 lg:h-auto overflow-hidden group">
                        @if($featuredArticle->gambar)
                            <img src="{{ Storage::url($featuredArticle->gambar) }}"
                                 alt="{{ $featuredArticle->judul }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 via-cyan-500 to-teal-600 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 underwater-pattern opacity-30"></div>
                                <svg class="w-32 h-32 text-white/40 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2 1M4 7l2-1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Badge Dampak -->
                        <div class="absolute top-6 left-6">
                            <span class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white text-sm font-bold px-5 py-2 rounded-full shadow-xl border border-white/20">
                                <i class="fas fa-leaf mr-2"></i>Dampak Konservasi
                            </span>
                        </div>

                        <!-- Overlay Interaksi -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                            <div class="text-white">
                                <div class="flex items-center gap-4 text-sm">
                                    <span class="flex items-center">
                                        <i class="fas fa-eye mr-2"></i>{{ rand(1000, 5000) }} views
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-heart mr-2"></i>{{ $featuredArticle->reactions->count() }} likes
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="p-8 lg:p-12 flex flex-col justify-between">
                        <div>
                            <!-- Meta Info -->
                            <div class="flex flex-wrap items-center gap-4 mb-6">
                                <span class="bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-800 text-sm font-semibold px-4 py-2 rounded-full border border-cyan-200">
                                    {{ $featuredArticle->category->nama_kategori }}
                                </span>
                                <span class="text-sm text-gray-500 flex items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                  {{ \App\Helpers\IndonesiaTimeHelper::formatDate($featuredArticle->created_at) }}
                                </span>

                            </div>

                            <!-- Judul -->
                            <h3 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-6 hover:text-blue-600 transition duration-300 leading-tight">
                                <a href="{{ route('articles.show', $featuredArticle) }}">{{ $featuredArticle->judul }}</a>
                            </h3>

                            <!-- Ringkasan -->
                            <p class="text-gray-600 mb-8 text-lg leading-relaxed line-clamp-4">
                                {{ Str::limit(strip_tags($featuredArticle->konten_isi_artikel), 250) }}
                            </p>

                            <!-- Tags -->
                            @if($featuredArticle->tags->count() > 0)
                                <div class="flex flex-wrap gap-3 mb-8">
                                    @foreach($featuredArticle->tags->take(4) as $tag)
                                        <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}"
                                           class="text-sm text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-full transition-colors border border-blue-200">
                                            #{{ $tag->nama_tag }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div class="flex items-center justify-between pt-8 border-t border-gray-200">
                            <div class="flex items-center">
                                <img src="{{ $featuredArticle->user->profile_photo_url }}"
                                     alt="{{ $featuredArticle->user->nama }}"
                                     class="w-12 h-12 rounded-full mr-4 border-3 border-white shadow-lg">
                                <div>
                                    <p class="text-lg font-bold text-gray-800">{{ $featuredArticle->user->nama }}</p>
                                    <p class="text-sm text-gray-500">Advokat Konservasi</p>
                                </div>
                            </div>

                            <a href="{{ route('articles.show', $featuredArticle) }}"
                               class="bg-gradient-to-r from-sky-500 to-cyan-500 hover:from-sky-600 hover:to-cyan-600 text-white px-8 py-4 rounded-2xl text-sm font-bold transition-all duration-300 flex items-center group shadow-xl shadow-blue-500/30 transform hover:scale-105">
                                Pelajari Lebih Lanjut
                                <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Grid Artikel Konservasi -->
    <section class="py-16 relative z-10">
        <div class="container mx-auto px-4">
            <!-- Header Bagian -->
            <div class="text-center mb-12 animate-on-scroll">
                <div class="inline-flex items-center bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-700 px-8 py-3 rounded-full mb-6 font-bold border border-cyan-200">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zm5.99 7.176A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                    </svg>
                    {{ request('category') ? $categories->where('category_id', request('category'))->first()->nama_kategori : 'Sumber Daya Konservasi' }}
                </div>

                @if(request('query'))
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Hasil untuk "<span class="gradient-text-enhanced">{{ request('query') }}</span>"
                    </h2>
                @else
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        <span class="gradient-text-enhanced">Jelajahi</span>
                        {{ request('category') ? $categories->where('category_id', request('category'))->first()->nama_kategori : 'Konservasi Laut' }}
                    </h2>
                @endif

                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Akses {{ $articles->total() }} artikel tentang perlindungan laut, praktik berkelanjutan, dan kisah sukses konservasi
                </p>
            </div>

            @if($articles->count() > 0)
                <!-- Grid Artikel -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    @foreach($articles as $index => $article)
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 h-full flex flex-col animate-on-scroll transform hover:-translate-y-2"
                             style="animation-delay: {{ $index * 0.1 }}s">

                            <!-- Gambar Artikel -->
                            <a href="{{ route('articles.show', $article) }}" class="relative block h-56 overflow-hidden group">
                                @if($article->gambar)
                                    <img src="{{ Storage::url($article->gambar) }}"
                                         alt="{{ $article->judul }}"
                                         class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-teal-100 via-blue-200 to-cyan-300 flex items-center justify-center relative overflow-hidden">
                                        <div class="absolute inset-0 underwater-pattern opacity-20"></div>
                                        <svg class="w-20 h-20 text-teal-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Badge Kategori -->
                                <div class="absolute top-4 right-4">
                                    <span class="bg-gradient-to-r from-teal-600 to-green-600 text-white text-xs font-bold px-4 py-2 rounded-xl shadow-xl border border-white/20">
                                        {{ $article->category->nama_kategori }}
                                    </span>
                                </div>

                                <!-- Indikator Dampak Konservasi -->
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                    <div class="flex items-center justify-between">
                                        <span class="bg-teal-400/90 text-white text-xs font-bold px-3 py-1 rounded-lg backdrop-blur-sm">
                                            <i class="fas fa-leaf mr-1"></i>Dampak Konservasi
                                        </span>
                                        <div class="flex items-center gap-3 text-white text-xs">
                                            <span><i class="fas fa-heart mr-1"></i>{{ $article->reactions->count() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- Konten Artikel -->
                            <div class="p-6 lg:p-8 flex flex-col flex-grow">
                                <!-- Meta Info -->
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-gray-500 flex items-center font-medium">
                                        <svg class="w-4 h-4 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                       {{ \App\Helpers\IndonesiaTimeHelper::formatDate($article->tgl_upload) }}
                                    </span>

                                    <div class="flex items-center text-gray-500 text-sm">
                                        <svg class="w-4 h-4 mr-1 text-teal-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                                        </svg>
                                        {{ $article->reactions->count() }}
                                    </div>
                                </div>

                                <!-- Judul -->
                                <a href="{{ route('articles.show', $article) }}" class="block mb-4">
                                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800 mb-3 hover:text-teal-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                        {{ $article->judul }}
                                    </h3>
                                </a>

                                <!-- Ringkasan -->
                                <p class="text-gray-600 mb-6 text-sm lg:text-base line-clamp-3 flex-grow leading-relaxed">
                                    {{ Str::limit(strip_tags($article->konten_isi_artikel), 150) }}
                                </p>

                                <!-- Tags Artikel -->
                                @if($article->tags->count() > 0)
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach($article->tags->take(3) as $tag)
                                            <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}"
                                               class="text-xs text-teal-600 hover:text-teal-800 bg-teal-50 hover:bg-teal-100 px-3 py-1 rounded-full transition-all duration-300 border border-teal-200 hover:border-teal-300">
                                                #{{ $tag->nama_tag }}
                                            </a>
                                        @endforeach

                                        @if($article->tags->count() > 3)
                                            <span class="text-xs text-gray-500 px-2 py-1">+{{ $article->tags->count() - 3 }} lainnya</span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Footer -->
                                <div class="flex items-center justify-between pt-6 border-t border-gray-200 mt-auto">
                                    <div class="flex items-center">
                                        <img src="{{ $article->user->profile_photo_url }}"
                                             alt="{{ $article->user->nama }}"
                                             class="w-10 h-10 rounded-full border-2 border-teal-200 shadow-md mr-3">
                                        <div>
                                            <span class="text-sm font-semibold text-gray-700">{{ $article->user->nama }}</span>
                                            <p class="text-xs text-gray-500">Penulis</p>
                                        </div>
                                    </div>

                                    <a href="{{ route('articles.show', $article) }}"
                                       class="text-teal-600 hover:text-teal-800 text-sm font-bold flex items-center group bg-teal-50 hover:bg-teal-100 px-4 py-2 rounded-xl transition-all duration-300">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @else
                <!-- Tidak Ada Artikel -->
                <div class="text-center py-20 animate-on-scroll">
                    <div class="mx-auto w-48 h-48 mb-8 bg-gradient-to-br from-teal-50 to-cyan-100 rounded-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-700 mb-4">Tidak Ada Artikel Konservasi Ditemukan</h3>
                    <p class="text-lg text-gray-500 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Kami belum menemukan upaya konservasi di area ini. Coba sesuaikan pencarian Anda atau jelajahi sumber daya perlindungan lingkungan lainnya.
                    </p>
                    <a href="{{ route('articles.index') }}"
                       class="inline-block bg-gradient-to-r from-teal-500 to-green-500 text-white px-8 py-4 rounded-2xl hover:from-teal-600 hover:to-green-600 shadow-xl transition-all duration-300 font-bold transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-3"></i>
                        Jelajahi Semua Artikel Konservasi
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Bagian Ekosistem Laut -->
    <section class="relative z-10 py-32 overflow-hidden">
        @auth
            <!-- Gambar Latar Ekosistem Laut -->
            <div class="w-full h-96 md:h-[500px] lg:h-[600px] relative overflow-hidden">
                <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                     alt="Ekosistem Laut - Terumbu karang bawah laut dan kehidupan laut"
                     class="w-full h-full object-cover object-center marine-ecosystem-parallax"
                     onerror="this.src='{{ asset('images/fallback-ocean.jpg') }}'; this.onerror=null;">

                <!-- Overlay Gradien untuk Keterbacaan Teks -->
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-800/60 to-transparent"></div>

                <!-- Efek Laut Beranimasi -->
                <div class="absolute inset-0 overflow-hidden">
                    <div class="underwater-bubbles-overlay"></div>
                    <div class="marine-light-rays"></div>
                    <div class="floating-plankton"></div>
                </div>

                <!-- Overlay Pesan Konservasi -->
                <div class="absolute inset-0 flex items-center justify-center text-center px-4">
                    <div class="max-w-5xl text-white animate-on-scroll">
                        <div class="inline-flex items-center bg-white/15 backdrop-blur-md rounded-full px-8 py-4 mb-8 border border-white/30">
                            <div class="w-4 h-4 bg-cyan-300 rounded-full mr-4 animate-pulse"></div>
                            <span class="text-cyan-100 font-bold text-lg">Melindungi Keanekaragaman Hayati Laut</span>
                        </div>

                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 underwater-text-effect leading-tight">
                            Setiap Spesies <span class="text-cyan-300">Berarti</span>
                        </h2>

                        <p class="text-xl md:text-2xl text-cyan-100 max-w-4xl mx-auto leading-relaxed mb-10">
                            Temukan koneksi rumit dalam ekosistem laut dan pelajari bagaimana tindakan Anda dapat membantu melestarikan surga bawah laut ini.
                        </p>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row gap-6 justify-center mt-8">
                            <a href="{{ route('communities.index') }}"
                               class="bg-gradient-to-r from-sky-500 to-cyan-500 hover:from-sky-600 hover:to-cyan-600 text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center shadow-xl transform hover:scale-105">
                                <i class="fas fa-users mr-3"></i>
                                Gabung Komunitas
                            </a>
                            <a href="{{ route('articles.index', ['category' => 1]) }}"
                               class="bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center">
                                <i class="fas fa-book-open mr-3"></i>
                                Pelajari Konservasi
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Indikator Scroll -->

        @else
            <!-- Bagian untuk Pengguna Tamu -->
            <section class="py-20 bg-gradient-to-br from-teal-50 via-blue-50 to-cyan-50 border-t-4 border-teal-500 relative overflow-hidden">
                <!-- Efek Latar Belakang -->
                <div class="absolute inset-0 bg-gradient-to-r from-teal-100/50 to-green-100/50 opacity-50"></div>
                <div class="absolute right-0 bottom-0 w-96 h-96 bg-gradient-to-br from-teal-200 to-green-200 rounded-full -mr-32 -mb-32 filter blur-3xl opacity-30"></div>
                <div class="absolute left-0 top-0 w-96 h-96 bg-gradient-to-br from-green-200 to-teal-200 rounded-full -ml-32 -mt-32 filter blur-3xl opacity-30"></div>

                <div class="container mx-auto px-4 text-center relative z-10">
                    <div class="max-w-4xl mx-auto animate-on-scroll">
                        <!-- Badge -->
                        <div class="inline-flex items-center bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 px-8 py-3 rounded-full mb-8 font-bold border border-green-200">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Bergabung dengan Komunitas Konservasi Kami
                        </div>

                        <!-- Judul -->
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-800 mb-6 leading-tight">
                            Menjadi <span class="gradient-text-enhanced">Advokat Laut</span>
                        </h2>

                        <!-- Deskripsi -->
                        <p class="text-xl md:text-2xl text-gray-600 mb-12 leading-relaxed">
                            Daftar untuk berkontribusi pada upaya konservasi laut, bagikan keahlian Anda, dan bantu kami melindungi ekosistem laut untuk generasi mendatang.
                        </p>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row gap-6 justify-center">
                            <a href="{{ route('register') }}"
                               class="bg-gradient-to-r from-cyan-500 to-teal-600 text-white px-10 py-5 rounded-2xl font-bold hover:from-sky-600 hover:to-teal-700 transition-all duration-300 shadow-2xl flex items-center justify-center transform hover:scale-105 text-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Bergabung Sebagai Konservasionis
                            </a>

                            <a href="{{ route('login') }}"
                               class="bg-white border-3 border-teal-500 text-teal-600 px-10 py-5 rounded-2xl font-bold hover:bg-teal-50 transition-all duration-300 flex items-center justify-center text-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Masuk
                            </a>
                        </div>

                        <!-- Fitur Unggulan -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/50">
                                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-pen text-green-600 text-xl"></i>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-2">Tulis Artikel</h4>
                                <p class="text-gray-600 text-sm">Bagikan pengetahuan konservasi Anda</p>
                            </div>
                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/50">
                                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-users text-blue-600 text-xl"></i>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-2">Bergabung Komunitas</h4>
                                <p class="text-gray-600 text-sm">Terhubung dengan sesama konservasionis</p>
                            </div>
                            <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/50">
                                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-heart text-teal-600 text-xl"></i>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-2">Buat Dampak</h4>
                                <p class="text-gray-600 text-sm">Selamatkan laut untuk masa depan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endauth
    </section>

    <!-- Sumber Daya Konservasi Laut -->
    <section class="py-24 bg-gradient-to-br from-blue-200 via-teal-900 to-blue-300 relative overflow-hidden">
        <!-- Efek Laut Dalam -->
        <div class="absolute inset-0 deep-sea-bubbles-enhanced opacity-20"></div>
        <div class="absolute inset-0 overflow-hidden z-10">
            <div class="marine-light-rays-enhanced"></div>
            <div class="underwater-particles-flow"></div>
            <div class="coral-silhouettes"></div>
        </div>

        <div class="container mx-auto px-4 relative z-20">
            <!-- Header Bagian -->
            <div class="text-center mb-20 animate-on-scroll">
                <div class="inline-flex items-center bg-white/15 backdrop-blur-md text-cyan-100 px-10 py-4 rounded-full mb-8 font-bold border border-white/20">
                    <svg class="w-8 h-8 mr-4 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    Pusat Aksi Konservasi
                </div>

                <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-8 underwater-text-effect leading-tight">
                    Ambil Aksi untuk <span class="text-cyan-300">Laut Kita</span>
                </h2>
                <p class="text-2xl md:text-3xl text-cyan-100 max-w-5xl mx-auto leading-relaxed">
                    Jelajahi cara-cara untuk terlibat dalam konservasi dan perlindungan laut. Setiap tindakan berarti dalam melestarikan planet biru kita.
                </p>
            </div>

            <!-- Grid Sumber Daya -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
                <!-- Kawasan Perlindungan Laut -->
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl p-10 lg:p-12 flex flex-col border border-white/20 animate-on-scroll hover:bg-white/15 transition-all duration-500 group marine-conservation-card">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-3xl flex items-center justify-center mb-10 text-white group-hover:scale-110 transition-transform duration-300 shadow-2xl shadow-blue-500/30">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="text-3xl font-bold text-white mb-6 group-hover:text-cyan-300 transition-colors">Kawasan Perlindungan Laut</h3>
                    <p class="text-cyan-100 mb-10 flex-grow text-lg leading-relaxed">
                        Pelajari tentang suaka laut, cagar alam, dan kawasan lindung yang berfungsi sebagai tempat aman bagi ekosistem laut dan keanekaragaman hayati maritim.
                    </p>

                    <a href="{{ route('articles.index', ['tag' => 5]) }}"
                       class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-10 py-5 rounded-2xl font-bold hover:from-blue-600 hover:to-cyan-600 transition duration-300 flex items-center justify-center shadow-2xl shadow-blue-500/20 group-hover:shadow-blue-400/30 transform hover:scale-105">
                        Jelajahi Kawasan Lindung
                        <svg class="w-6 h-6 ml-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Praktik Berkelanjutan -->
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl p-10 lg:p-12 flex flex-col border border-white/20 animate-on-scroll hover:bg-white/15 transition-all duration-500 group marine-conservation-card" style="animation-delay: 0.2s">
                    <div class="w-24 h-24 bg-gradient-to-br from-sky-400 to-cyan-500 rounded-3xl flex items-center justify-center mb-10 text-white group-hover:scale-110 transition-transform duration-300 shadow-2xl shadow-green-500/30">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11.5V14m0-2.5v-6a1.5 1.5 0 113 0m-3 6a1.5 1.5 0 00-3 0v2a7.5 7.5 0 0015 0v-5a1.5 1.5 0 00-3 0m-6-3V11m0-5.5v-1a1.5 1.5 0 013 0v1m0 0V11m0-5.5a1.5 1.5 0 013 0v3m0 0V11"></path>
                        </svg>
                    </div>

                    <h3 class="text-3xl font-bold text-white mb-6 group-hover:text-cyan-300 transition-colors">Praktik Berkelanjutan</h3>
                    <p class="text-cyan-100 mb-10 flex-grow text-lg leading-relaxed">
                        Temukan cara mengurangi dampak Anda terhadap ekosistem laut melalui kebiasaan berkelanjutan, pengurangan plastik, dan konsumsi yang bertanggung jawab.
                    </p>

                    <a href="{{ route('articles.index', ['category' => 3]) }}"
                       class="bg-gradient-to-r from-teal-500 to-emerald-500 text-white px-10 py-5 rounded-2xl font-bold hover:from-teal-600 hover:to-emerald-600 transition duration-300 flex items-center justify-center shadow-2xl shadow-green-500/20 group-hover:shadow-green-400/30 transform hover:scale-105">
                        Pelajari Kebiasaan Berkelanjutan
                        <svg class="w-6 h-6 ml-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>


                <!-- Peluang Volunteering -->
                <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl p-10 lg:p-12 flex flex-col border border-white/20 animate-on-scroll hover:bg-white/15 transition-all duration-500 group marine-conservation-card" style="animation-delay: 0.4s">
                    <div class="w-24 h-24 bg-gradient-to-br from-purple-400 to-indigo-500 rounded-3xl flex items-center justify-center mb-10 text-white group-hover:scale-110 transition-transform duration-300 shadow-2xl shadow-purple-500/30">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>

                    <h3 class="text-3xl font-bold text-white mb-6 group-hover:text-cyan-300 transition-colors">Peluang Volunteering</h3>
                    <p class="text-cyan-100 mb-10 flex-grow text-lg leading-relaxed">
                        Temukan cara berpartisipasi aktif dalam pembersihan pantai, restorasi terumbu karang, dan proyek sains warga yang membantu melestarikan kesehatan laut.
                    </p>

                    <a href="{{ route('communities.index') }}"
                       class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-10 py-5 rounded-2xl font-bold hover:from-purple-600 hover:to-indigo-600 transition duration-300 flex items-center justify-center shadow-2xl shadow-purple-500/20 group-hover:shadow-purple-400/30 transform hover:scale-105">
                        Bergabung Sebagai Volunteer
                        <svg class="w-6 h-6 ml-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Call to Action Section -->
            <div class="mt-20 text-center animate-on-scroll" style="animation-delay: 0.6s">
                <div class="bg-white/15 backdrop-blur-lg rounded-3xl p-12 lg:p-16 border border-white/30 shadow-2xl">
                    <div class="inline-flex items-center bg-white/20 backdrop-blur-md text-cyan-100 px-8 py-4 rounded-full mb-8 font-bold border border-white/30">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Mulai Aksi Konservasi Hari Ini
                    </div>

                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-8 underwater-text-effect leading-tight">
                        Setiap Tindakan <span class="text-cyan-300">Berarti</span>
                    </h2>

                    <p class="text-xl md:text-2xl text-cyan-100 max-w-4xl mx-auto leading-relaxed mb-12">
                        Bergabunglah dengan ribuan konservasionis di seluruh dunia. Mulai perjalanan Anda untuk melindungi lautan dan ekosistem maritime untuk generasi mendatang.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        @auth
                         @if(auth()->user()->is_banned)
        <div class="flex flex-col sm:flex-row gap-8 justify-center">
            <div class="bg-red-100 border-2 border-red-400 text-red-700 px-12 py-6 rounded-2xl font-bold text-center flex items-center justify-center text-xl">
                <svg class="w-8 h-8 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                Akun Anda Telah Diblokir
            </div>
        </div>
                @else
                            <a href="{{ route('communities.index') }}"
                               class="bg-gradient-to-r from-cyan-500 to-sky-500 hover:from-cyan-600 hover:to-sky-600 text-white px-10 py-5 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center shadow-2xl transform hover:scale-105 text-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Jelajahi Komunitas
                            </a>

                            <a href="{{ route('articles.create') }}"
                               class="bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white px-10 py-5 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center text-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Bagikan Artikel
                            </a>
                        @endif
                        @else
                            <a href="{{ route('register') }}"
                               class="bg-gradient-to-r from-cyan-500 to-sky-500 hover:from-sky-600 hover:to-cyan-600 text-white px-10 py-5 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center shadow-2xl transform hover:scale-105 text-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Bergabung Sekarang
                            </a>

                            <a href="{{ route('communities.index') }}"
                               class="bg-white/20 hover:bg-white/30 backdrop-blur-md border border-white/30 text-white px-10 py-5 rounded-2xl font-bold transition-all duration-300 flex items-center justify-center text-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Komunitas
                            </a>
                        @endauth
                    </div>

                    <!-- Community Statistics -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16">
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-cyan-300 mb-2">{{ \App\Models\Community::count() }}+</div>
                            <div class="text-cyan-100 text-sm">Komunitas Aktif</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-cyan-300 mb-2">{{ \DB::table('community_user_pivots')->count() }}+</div>
                            <div class="text-cyan-100 text-sm">Anggota Total</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-cyan-300 mb-2">{{ \App\Models\Message::count() }}+</div>
                            <div class="text-cyan-100 text-sm">Pesan Berbagi</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20">
                            <div class="text-3xl font-bold text-cyan-300 mb-2">{{ \App\Models\CommunityEvent::where('event_date', '>=', now())->count() }}+</div>
                            <div class="text-cyan-100 text-sm">Event Mendatang</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community Showcase Section -->
    <section class="py-24 bg-gradient-to-b from-slate-200 via-blue-50 to-cyan-200 relative overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-100/30 to-cyan-100/30 opacity-50"></div>
        <div class="absolute right-0 top-0 w-96 h-96 bg-gradient-to-br from-blue-200 to-cyan-200 rounded-full -mr-32 -mt-32 filter blur-3xl opacity-20"></div>
        <div class="absolute left-0 bottom-0 w-96 h-96 bg-gradient-to-br from-cyan-200 to-blue-200 rounded-full -ml-32 -mb-32 filter blur-3xl opacity-20"></div>

        <div class="container mx-auto px-4 relative z-10">
            <!-- Header -->
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-700 px-8 py-3 rounded-full mb-6 font-bold border border-blue-200">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Komunitas Konservasi Aktif
                </div>

                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                    Bergabung dengan <span class="gradient-text-enhanced">Komunitas Global</span>
                </h2>

                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Temukan komunitas yang tepat untuk Anda dan mulai membuat dampak nyata dalam konservasi laut bersama sesama pecinta lingkungan.
                </p>
            </div>

            <!-- Featured Communities Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @php
                    $featuredCommunities = \App\Models\Community::withCount('users')
                        ->orderBy('users_count', 'desc')
                        ->take(6)
                        ->get();
                @endphp

                @foreach($featuredCommunities as $index => $community)
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-white/50 animate-on-scroll transform hover:-translate-y-2"
                         style="animation-delay: {{ $index * 0.1 }}s">

                        <!-- Community Image -->
                        <div class="relative h-48 overflow-hidden group">
                            @if($community->gambar)
                                <img src="{{ Storage::url($community->gambar) }}"
                                     alt="{{ $community->nama_komunitas }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-100 via-cyan-200 to-teal-300 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 underwater-pattern opacity-30"></div>
                                    <svg class="w-16 h-16 text-blue-400 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            @endif

                            <!-- Member Count Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="bg-blue-600/90 text-white text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm border border-white/20">
                                    {{ $community->users_count }} anggota
                                </span>
                            </div>

                            <!-- Active Status -->
                            <div class="absolute bottom-4 left-4">
                                <span class="bg-cyan-500/90 text-white text-xs font-bold px-3 py-1 rounded-full backdrop-blur-sm border border-white/20 flex items-center">
                                    <div class="w-2 h-2 bg-green-300 rounded-full mr-2 animate-pulse"></div>
                                    Aktif
                                </span>
                            </div>
                        </div>

                        <!-- Community Content -->
                        <div class="p-6">
                            <!-- Community Name -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors line-clamp-1">
                                <a href="{{ route('communities.show', $community) }}">
                                    {{ $community->nama_komunitas }}
                                </a>
                            </h3>

                            <!-- Description -->
                            <p class="text-gray-600 mb-4 text-sm line-clamp-2 leading-relaxed">
                                {{ Str::limit($community->deskripsi, 100) }}
                            </p>

                            <!-- Community Stats -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    {{ $community->messages->count() ?? 0 }} pesan
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                   {{ \App\Helpers\IndonesiaTimeHelper::formatDate($community->created_at) }}
                                </span>
                            </div>

                            <!-- Join Button -->
                            <a href="{{ route('communities.show', $community) }}"
                               class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-bold transition-all duration-300 flex items-center justify-center group shadow-lg">
                                <svg class="w-5 h-5 mr-2 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Komunitas
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Communities Button -->
            <div class="text-center animate-on-scroll">
                <a href="{{ route('communities.index') }}"
                   class="inline-flex items-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-4 rounded-2xl font-bold transition-all duration-300 shadow-xl transform hover:scale-105 text-lg">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Jelajahi Semua Komunitas
                    <svg class="w-5 h-5 ml-3 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

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

/* Underwater Bubbles Overlay */
.underwater-bubbles-overlay {
    background-image:
        radial-gradient(circle at 10% 80%, rgba(255, 255, 255, 0.1) 3px, transparent 3px),
        radial-gradient(circle at 40% 70%, rgba(255, 255, 255, 0.08) 4px, transparent 4px),
        radial-gradient(circle at 70% 60%, rgba(255, 255, 255, 0.12) 2px, transparent 2px),
        radial-gradient(circle at 90% 90%, rgba(255, 255, 255, 0.1) 3px, transparent 3px);
    background-size: 200px 200px, 300px 300px, 150px 150px, 250px 250px;
    animation: bubbleRise 25s linear infinite;
}

@keyframes bubbleRise {
    0% {
        background-position: 0 100%, 0 100%, 0 100%, 0 100%;
    }
    100% {
        background-position: 0 -200px, 0 -300px, 0 -150px, 0 -250px;
    }
}

/* Floating Plankton */
.floating-plankton {
    background-image:
        radial-gradient(circle at 20% 30%, rgba(34, 211, 238, 0.05) 1px, transparent 1px),
        radial-gradient(circle at 60% 80%, rgba(16, 185, 129, 0.05) 1px, transparent 1px),
        radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.05) 1px, transparent 1px);
    background-size: 100px 100px, 150px 150px, 120px 120px;
    animation: planktonFloat 30s ease-in-out infinite;
}

@keyframes planktonFloat {
    0%, 100% {
        background-position: 0 0, 0 0, 0 0;
        transform: translateX(0);
    }
    33% {
        background-position: 50px 25px, -25px 50px, 25px -25px;
        transform: translateX(15px);
    }
    66% {
        background-position: -25px 50px, 50px -25px, -50px 25px;
        transform: translateX(-15px);
    }
}
    /* Enhanced Ocean Wave Animations */
    .ocean-waves {
        background: linear-gradient(90deg,
            transparent,
            rgba(6, 182, 212, 0.15) 25%,
            rgba(59, 130, 246, 0.15) 50%,
            rgba(20, 184, 166, 0.15) 75%,
            transparent
        );
        background-size: 300% 100%;
        animation: oceanFlowEnhanced 12s ease-in-out infinite;
    }

    @keyframes oceanFlowEnhanced {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Enhanced Floating Particles */
    .floating-particles {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(6, 182, 212, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 40% 40%, rgba(20, 184, 166, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 60% 70%, rgba(16, 185, 129, 0.15) 1px, transparent 1px);
        background-size: 150px 150px, 200px 200px, 300px 300px, 100px 100px;
        animation: floatParticlesEnhanced 25s linear infinite;
    }

    @keyframes floatParticlesEnhanced {
        0% { background-position: 0 0, 0 0, 0 0, 0 0; }
        100% { background-position: 150px 150px, -200px 200px, 300px -300px, -100px 100px; }
    }

    /* Enhanced Deep Sea Bubbles */
    .deep-sea-bubbles-enhanced {
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.15) 4px, transparent px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.12) 5px, transparent 5px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.18) 3px, transparent 3px),
            radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px);
        background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
        animation: deepBubbleRiseEnhanced 30s linear infinite;
    }

    @keyframes deepBubbleRiseEnhanced {
        0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%, 0 100%; }
        100% { background-position: 0 -400px, 0 -500px, 0 -300px, 0 -450px, 0 -250px; }
    }

    /* Enhanced Marine Light Rays */
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

    /* Underwater Particles Flow */
    .underwater-particles-flow {
        background-image:
            radial-gradient(circle at 10% 20%, rgba(34, 211, 238, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 30% 60%, rgba(59, 130, 246, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 70% 90%, rgba(20, 184, 166, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 90% 30%, rgba(16, 185, 129, 0.1) 1px, transparent 1px);
        background-size: 80px 80px, 120px 120px, 100px 100px, 90px 90px;
        animation: particleFlow 20s linear infinite;
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

    /* Coral Silhouettes */
    .coral-silhouettes {
        background-image:
            radial-gradient(ellipse at 20% 100%, rgba(16, 185, 129, 0.08) 20px, transparent 20px),
            radial-gradient(ellipse at 60% 100%, rgba(34, 211, 238, 0.08) 25px, transparent 25px),
            radial-gradient(ellipse at 80% 100%, rgba(59, 130, 246, 0.08) 18px, transparent 18px);
        background-size: 200px 150px, 300px 200px, 250px 180px;
        background-position: 0 100%, 0 100%, 0 100%;
        animation: coralSway 25s ease-in-out infinite;
    }

    @keyframes coralSway {
        0%, 100% { transform: translateX(0) skewX(0deg); }
        33% { transform: translateX(10px) skewX(2deg); }
        66% { transform: translateX(-10px) skewX(-2deg); }
    }

    /* Enhanced Gradient Text */
    .gradient-text-enhanced {
        background: linear-gradient(135deg, #10b981, #06b6d4, #3b82f6, #8b5cf6);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: gradientShift 8s ease-in-out infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Underwater Text Effect */
    .underwater-text-effect {
        text-shadow:
            0 0 10px rgba(120, 220, 255, 0.3),
            0 0 20px rgba(120, 220, 255, 0.2),
            0 0 30px rgba(120, 220, 255, 0.1);
        animation: underwaterGlow 4s ease-in-out infinite alternate;
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

    /* Marine Conservation Card Hover Effect */
    .marine-conservation-card {
        position: relative;
        overflow: hidden;
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

    /* Marine Ecosystem Parallax */
    .marine-ecosystem-parallax {
        transition: transform 0.1s ease-out;
    }

    /* Enhanced Card Hover */
    .card-hover-enhanced {
        transition: all 0.3s ease;
    }

    .card-hover-enhanced:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    }

    /* Underwater Pattern */
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

    /* Enhanced Animation Delays */
    .text-reveal-delay-3 {
        opacity: 0;
        transform: translateY(30px);
        animation: textReveal 1s ease-out 0.9s forwards;
    }

    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .underwater-text-effect {
            font-size: 2.5rem;
        }

        .gradient-text-enhanced {
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
    console.log("Enhanced ocean conservation ecosystem initialized");

    // Enhanced Intersection Observer
    const enhancedObserverOptions = {
        root: null,
        rootMargin: '-10% 0px -10% 0px',
        threshold: [0.1, 0.3, 0.7]
    };

    const enhancedObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Add staggered animation delays
                setTimeout(() => {
                    entry.target.classList.add('in-view');
                }, index * 100);

                // Add special effects for specific elements
                if (entry.target.classList.contains('marine-conservation-card')) {
                    entry.target.style.animationDelay = `${index * 0.2}s`;
                }
            }
        });
    }, enhancedObserverOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        enhancedObserver.observe(el);
    });

    // Enhanced Marine Ecosystem Parallax
    let ticking = false;

    function updateParallax() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.marine-ecosystem-parallax');

        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            const yPos = -(scrolled * speed);
            element.style.transform = `translate3d(0, ${yPos}px, 0)`;
        });

        ticking = false;
    }

    function requestTick() {
        if (!ticking) {
            requestAnimationFrame(updateParallax);
            ticking = true;
        }
    }

    window.addEventListener('scroll', requestTick);

    // Interactive Wave Effects
    const waveElements = document.querySelectorAll('.ocean-waves');
    waveElements.forEach(wave => {
        wave.addEventListener('mouseover', function() {
            this.style.animationDuration = '6s';
        });

        wave.addEventListener('mouseleave', function() {
            this.style.animationDuration = '12s';
        });
    });

    // Dynamic Bubble Effects
    function createBubble() {
        const bubble = document.createElement('div');
        bubble.className = 'dynamic-bubble';
        bubble.style.cssText = `
            position: fixed;
            bottom: -50px;
            left: ${Math.random() * 100}%;
            width: ${Math.random() * 20 + 10}px;
            height: ${Math.random() * 20 + 10}px;
            background: radial-gradient(circle, rgba(255,255,255,0.3), rgba(120,220,255,0.1));
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000;
            animation: bubbleRise ${Math.random() * 3 + 4}s linear forwards;
        `;

        document.body.appendChild(bubble);

        setTimeout(() => {
            bubble.remove();
        }, 7000);
    }

    // Create bubbles periodically
    setInterval(createBubble, 3000);

    // Add CSS for dynamic bubbles
    if (!document.getElementById('dynamic-bubble-style')) {
        const style = document.createElement('style');
        style.id = 'dynamic-bubble-style';
        style.textContent = `
            @keyframes bubbleRise {
                0% {
                    bottom: -50px;
                    opacity: 0;
                    transform: translateX(0) scale(0);
                }
                10% {
                    opacity: 1;
                    transform: scale(1);
                }
                90% {
                    opacity: 1;
                }
                100% {
                    bottom: 100vh;
                    opacity: 0;
                    transform: translateX(${Math.random() * 100 - 50}px) scale(0.5);
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Enhanced Social Sharing

    // Enhanced Scroll Progress Indicator
    const scrollProgress = document.createElement('div');
    scrollProgress.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #06b6d4, #3b82f6);
        z-index: 9999;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(scrollProgress);

    window.addEventListener('scroll', () => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        const scrolled = window.scrollY;
        const progress = (scrolled / scrollable) * 100;
        scrollProgress.style.width = progress + '%';
    });

    // Conservation Impact Counter Animation
    function animateCounters() {
        const counters = document.querySelectorAll('[data-counter]');

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-counter'));
            const duration = 2000;
            const steps = 60;
            const increment = target / steps;
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                }
            }, duration / steps);
        });
    }

    // Trigger counter animation when statistics section is visible
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                statsObserver.unobserve(entry.target);
            }
        });
    });

    const statsSection = document.querySelector('.grid.grid-cols-1.md\\:grid-cols-4');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Enhanced Loading States
    document.querySelectorAll('a[href*="route"]').forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.href.includes('create') || this.href.includes('communities')) {
                const loader = document.createElement('div');
                loader.innerHTML = `
                    <div style="
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: rgba(0,0,0,0.5);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        z-index: 10000;
                    ">
                        <div style="
                            background: white;
                            padding: 2rem;
                            border-radius: 1rem;
                            text-align: center;
                        ">
                            <div style="
                                width: 40px;
                                height: 40px;
                                border: 4px solid #e5e7eb;
                                border-top: 4px solid #06b6d4;
                                border-radius: 50%;
                                animation: spin 1s linear infinite;
                                margin: 0 auto 1rem;
                            "></div>
                            <p>Memuat halaman konservasi...</p>
                        </div>
                    </div>
                `;
                document.body.appendChild(loader);
            }
        });
    });
});
</script>
@endsection
