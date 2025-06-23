@extends('layouts.app')

@section('title', 'Jelajahi Fakta Menarik' . (request()->filled('keyword') ? ' - ' . request('keyword') : ''))

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-400/10 via-cyan-500/10 to-teal-600/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <!-- Header Utama -->
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
                    @php $isAdmin = auth()->check() && auth()->user()->is_admin; @endphp
                    <span class="text-cyan-100 font-semibold text-lg">{{ $isAdmin ? 'Pusat Administrasi Fakta Menarik' : 'Jelajahi Fakta Menarik Kelautan' }}</span>
                </div>

                <!-- Judul Utama -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-8 leading-tight text-reveal">
                    <span class="gradient-text-enhanced">{{ $isAdmin ? 'Kelola' : 'Jelajahi' }}</span>
                    <br class="md:hidden">
                    Fakta <span class="gradient-text-enhanced">Menarik</span>
                </h1>

                <p class="text-xl md:text-2xl text-cyan-100 max-w-4xl mx-auto leading-relaxed mb-12 text-reveal-delay-1">
                    {{ $isAdmin ? 'Kelola dan atur semua fakta menarik untuk memberikan wawasan yang menakjubkan kepada pengunjung' : 'Temukan fakta-fakta menakjubkan tentang kehidupan laut dan dunia kelautan yang penuh misteri' }}
                </p>

                @if($isAdmin)
                    <div class="flex flex-wrap justify-center gap-4 text-reveal-delay-2">
                        <a href="{{ route('funfacts.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Buat Fakta Baru
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-md text-white rounded-full hover:bg-white/30 transition-all duration-300 border border-white/30">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Dashboard Admin
                        </a>
                    </div>
                @endif
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

    <div class="container mx-auto px-4 py-8 relative z-10">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 max-w-4xl mx-auto" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <span class="sr-only">Tutup</span>
                    <svg class="h-5 w-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl relative mb-6 max-w-4xl mx-auto" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('error') }}</span>
                </div>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <span class="sr-only">Tutup</span>
                    <svg class="h-5 w-5 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if($isAdmin)
            <!-- Admin Panel -->
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20 mb-12">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Manajemen Fakta Menarik
                    </h2>
                    <form action="{{ route('funfacts.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <input type="text" name="keyword" placeholder="Cari fakta menarik..."
                                   class="w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 bg-white/80 backdrop-blur-sm"
                                   value="{{ request('keyword') }}">
                        </div>
                        <div>
                            <select name="category" class="w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 bg-white/80 backdrop-blur-sm appearance-none">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <select name="article" class="w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 bg-white/80 backdrop-blur-sm appearance-none">
                                <option value="">Semua Artikel</option>
                                @foreach($relatedArticles as $article)
                                    <option value="{{ $article->article_id }}" {{ request('article') == $article->article_id ? 'selected' : '' }}>
                                        {{ Str::limit($article->judul, 50) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-3 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg">
                                Terapkan Filter
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('funfacts.index') }}" class="flex items-center justify-center w-full bg-gray-100 text-gray-800 px-4 py-3 rounded-xl hover:bg-gray-200 transition-all duration-300">
                                Atur Ulang Filter
                            </a>
                        </div>
                    </form>
                </div>

                <div class="pt-8 border-t border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        Alat Manajemen Cepat
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('funfacts.create') }}" class="flex items-center justify-center bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Buat Fakta Baru
                        </a>
                        <button onclick="toggleAllHighlighted()" class="flex items-center justify-center bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-6 py-3 rounded-xl hover:from-yellow-600 hover:to-orange-600 transition-all duration-300 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            Toggle Sorotan
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Dashboard Admin
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="max-w-4xl mx-auto -mt-16 mb-12">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                    <form action="{{ route('funfacts.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="keyword" placeholder="Cari fakta menarik tentang kelautan..."
                                class="w-full pl-12 pr-4 py-4 rounded-xl bg-white/80 backdrop-blur-sm border border-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg"
                                value="{{ request('keyword') }}">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-4 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg flex items-center justify-center md:w-auto w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Cari</span>
                        </button>
                    </form>
                </div>
            </div>

            <div class="mb-8 max-w-4xl mx-auto">
                <div class="flex flex-wrap gap-3 justify-center">
                    <a href="{{ route('funfacts.index') }}" class="group flex items-center text-blue-600 hover:text-blue-800 bg-white/70 backdrop-blur-sm px-4 py-2 rounded-full border border-blue-100 hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md {{ !request()->anyFilled(['keyword', 'category', 'article']) ? 'bg-blue-500 text-white' : '' }}">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <span class="font-medium">Semua Fakta</span>
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('funfacts.index', ['category' => $category->category_id]) }}" class="group flex items-center text-blue-600 hover:text-blue-800 bg-white/70 backdrop-blur-sm px-4 py-2 rounded-full border border-blue-100 hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md {{ request('category') == $category->category_id ? 'bg-blue-500 text-white' : '' }}">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="font-medium">{{ $category->nama_kategori }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if(request('keyword') || request('category') || request('article'))
            <div class="mb-6 max-w-4xl mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-md border border-white/20">
                    <h2 class="text-xl font-semibold text-gray-800 flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Hasil Pencarian

                        @if(request('keyword'))
                            <span class="font-normal ml-2">"{{ request('keyword') }}"</span>
                        @endif

                        @if(request('category'))
                            @php
                                $categoryName = $categories->where('category_id', request('category'))->first()->nama_kategori ?? '';
                            @endphp
                            <span class="font-normal ml-2">dalam kategori "{{ $categoryName }}"</span>
                        @endif

                        @if(request('article'))
                            @php
                                $articleTitle = $relatedArticles->where('article_id', request('article'))->first()->judul ?? '';
                            @endphp
                            <span class="font-normal ml-2">untuk artikel "{{ Str::limit($articleTitle, 30) }}"</span>
                        @endif
                    </h2>
                    <p class="text-gray-600 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        {{ $funfacts->total() }} {{ $funfacts->total() == 1 ? 'hasil ditemukan' : 'hasil ditemukan' }}
                    </p>
                </div>
            </div>
        @else
            <div class="mb-6 max-w-4xl mx-auto text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    @if($funfacts->isEmpty())
                        Belum Ada Fakta Menarik
                    @else
                        Jelajahi Fakta Menarik Acak
                    @endif
                </h2>
                @if(!$funfacts->isEmpty())
                    <p class="text-gray-600">Temukan wawasan menakjubkan tentang dunia kelautan</p>
                @endif
            </div>
        @endif

        @if($funfacts->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-10">
                @foreach($funfacts as $funfact)
                    <div class="bg-gradient-to-br from-white/90 to-blue-50/90 backdrop-blur-sm rounded-2xl shadow-md hover:shadow-xl border border-white/50 overflow-hidden transition-all duration-300 transform hover:-translate-y-2 group animate-on-scroll shine-effect">
                        @if($funfact->gambar)
                            <div class="relative h-48 overflow-hidden bg-gradient-to-r from-blue-500 to-cyan-500">
                                <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 via-transparent to-transparent"></div>
                                
                                @if($funfact->is_highlighted)
                                    <div class="absolute top-3 right-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                        Unggulan
                                    </div>
                                @endif

                                @if($isAdmin)
                                    <div class="absolute top-3 left-3 flex space-x-2">
                                        <form action="{{ route('funfacts.toggle-highlight', $funfact) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-gray-800/70 hover:bg-gray-800/90 text-white p-2 rounded-full transition-all duration-200 backdrop-blur-sm">
                                                <svg class="w-4 h-4" fill="{{ $funfact->is_highlighted ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                <div class="absolute bottom-3 left-3 bg-white/80 backdrop-blur-sm text-blue-600 text-xs font-semibold px-2 py-1 rounded-full">
                                    Urutan: {{ $funfact->urutan_animasi }}
                                </div>
                            </div>
                        @else
                            <div class="h-32 bg-gradient-to-r from-blue-400 to-cyan-400 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 bg-cover opacity-30" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxOHB4IiB2aWV3Qm94PSIwIDAgMTI4MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iI2ZmZmZmZiI+PHBhdGggZD0iTTEyODAgMy40QzEwNTAuNTkgMTggMTAxOS40IDg0Ljg5IDczNC40MiA4NC44OWMtMzIwIDAtMzIwLTg0LjMtNjQwLTg0LjNDNTkuNC41OSAyOC4yIDEuNiAwIDMuNFYxNDBoMTI4MHoiIGZpbGwtb3BhY2l0eT0iLjMiLz48cGF0aCBkPSJNMCAyNC4zMWM0My40Ni01LjY5IDk0LjU2LTkuMjUgMTU4LjQyLTkuMjUgMzIwIDAgMzIwIDg5LjI0IDY0MCA4OS4yNCAyNTYuMTMgMCAzMDcuMjgtNTcuMTYgNDgxLjU4LTgwVjE0MEgweiIgZmlsbC1vcGFjaXR5PSIuNSIvPjxwYXRoIGQ9Ik0xMjgwIDUxLjc2Yy0yMDEgMTIuNDktMjQyLjQzIDUzLjQtNTEzLjU4IDUzLjQtMzIwIDAtMzIwLTU3LTY0MC01Ny00OC44NS4wMS05MC4yMSAxLjM1LTEyNi40MiAzLjZWMTQwaDEyODB6Ii8+PC9nPjwvc3ZnPg==');background-size: 100% 100%"></div>
                                
                                <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>

                                @if($isAdmin)
                                    <div class="absolute top-3 left-3 flex space-x-2">
                                        <form action="{{ route('funfacts.toggle-highlight', $funfact) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-gray-800/70 hover:bg-gray-800/90 text-white p-2 rounded-full transition-all duration-200 backdrop-blur-sm">
                                                <svg class="w-4 h-4" fill="{{ $funfact->is_highlighted ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                @if($funfact->is_highlighted)
                                    <div class="absolute top-3 right-3 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                         Unggulan
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="p-5 flex-grow flex flex-col">
                            <h3 class="text-lg font-bold text-gray-800 mb-3 group-hover:text-blue-600 transition-colors">
                                {{ $funfact->judul }}
                            </h3>

                            <p class="text-gray-600 text-sm mb-4 flex-grow leading-relaxed">
                                {{ Str::limit($funfact->getLocalizedDescription(), 120) }}
                            </p>

                            @if($funfact->article)
                                <div class="flex items-start space-x-2 mb-4 text-sm">
                                    <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <a href="{{ route('articles.show', $funfact->article) }}" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                        {{ Str::limit($funfact->article->judul, 50) }}
                                    </a>
                                </div>
                            @endif

                            @if($funfact->article && $funfact->article->category)
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $funfact->article->category->nama_kategori }}
                                    </span>
                                </div>
                            @endif

                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                <a href="{{ route('funfacts.show', $funfact) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium transition-colors">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>

                                @if($isAdmin)
                                    <div class="flex space-x-2">
                                        <a href="{{ route('funfacts.edit', $funfact) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('funfacts.destroy', $funfact) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus fakta menarik ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-800 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-4 shadow-md">
                    {{ $funfacts->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-16 max-w-2xl mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl p-12 border border-white/20">
                    <div class="relative mb-8">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full flex items-center justify-center animate-pulse">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-3 h-3 bg-blue-300 rounded-full animate-bounce"></div>
                        <div class="absolute -bottom-2 -left-2 w-2 h-2 bg-cyan-300 rounded-full animate-bounce" style="animation-delay: 0.5s;"></div>
                        <div class="absolute top-1/2 -right-4 w-2 h-2 bg-teal-300 rounded-full animate-bounce" style="animation-delay: 1s;"></div>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Tidak Ada Fakta Menarik Ditemukan</h3>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Maaf, tidak ada fakta menarik yang sesuai dengan kriteria pencarian Anda. Coba sesuaikan filter atau kata kunci pencarian Anda.
                    </p>

                    @if($isAdmin)
                        <div class="space-y-4">
                            <a href="{{ route('funfacts.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Buat Fakta Menarik Pertama
                            </a>
                            <br>
                            <a href="{{ route('funfacts.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                atau lihat semua fakta yang ada
                            </a>
                        </div>
                    @else
                        <a href="{{ route('funfacts.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-full hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Jelajahi Semua Fakta
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <div class="max-w-4xl mx-auto mt-16">
            <div class="bg-gradient-to-br from-white/80 to-blue-50/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tentang Fakta Menarik
                    </h2>
                </div>
                
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xl font-semibold text-blue-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                Apa itu Fakta Menarik?
                            </h3>
                            <p class="mb-4">
                                Fakta menarik adalah informasi menakjubkan dan edukatif yang dapat memperluas pengetahuan Anda tentang berbagai subjek. Setiap fakta di platform kami telah dikurasi dengan hati-hati dan sering dikaitkan dengan artikel terkait untuk eksplorasi yang lebih mendalam.
                            </p>
                        </div>
                        
                        <div>
                            <h3 class="text-xl font-semibold text-blue-700 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Jelajahi dan Pelajari
                            </h3>
                            <p class="mb-4">
                                Jelajahi koleksi fakta menarik kami untuk menemukan wawasan yang menakjubkan tentang alam, sejarah, sains, dan banyak lagi. Fakta-fakta yang ditampilkan di halaman ini dipilih secara acak untuk memberikan pengalaman belajar yang beragam setiap kali Anda berkunjung.
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-8 p-6 bg-blue-50/50 rounded-2xl border border-blue-100">
                        <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            Tahukah Anda?
                        </h3>
                        <p class="text-blue-700 italic">
                            Lautan menutupi lebih dari 70% permukaan bumi dan menyimpan jutaan spesies yang belum ditemukan. Setiap fakta menarik di sini membawa Anda lebih dekat untuk memahami keajaiban dunia bawah laut!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
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

    .deep-sea-bubbles {
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.12) 5px, transparent 5px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.18) 3px, transparent 3px),
            radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px);
        background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
        animation: bubbleRiseEnhanced 30s linear infinite;
    }

    @keyframes bubbleRiseEnhanced {
        0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%, 0 100%; }
        100% { background-position: 0 -400px, 0 -500px, 0 -300px, 0 -450px, 0 -250px; }
    }

    .wave-overlay-1 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath d='M0,160L48,170.7C96,181,192,203,288,202.7C384,203,480,181,576,160C672,139,768,117,864,122.7C960,128,1056,160,1152,176C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z' fill='%23ffffff' fill-opacity='0.08'%3E%3C/path%3E%3C/svg%3E");
        background-size: 100% 100%;
        background-position: bottom center;
        animation: wave-animation1 25s linear infinite alternate;
        pointer-events: none;
        z-index: 1;
    }

    .wave-overlay-2 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath d='M0,192L30,208C60,224,120,256,180,261.3C240,267,300,245,360,213.3C420,181,480,139,540,149.3C600,160,660,224,720,250.7C780,277,840,267,900,234.7C960,203,1020,149,1080,133.3C1140,117,1200,139,1260,154.7C1320,171,1380,181,1410,186.7L1440,192L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z' fill='%23ffffff' fill-opacity='0.12'%3E%3C/path%3E%3C/svg%3E");
        background-size: 100% 100%;
        background-position: bottom center;
        animation: wave-animation2 20s linear infinite alternate-reverse;
        pointer-events: none;
        z-index: 2;
    }

    .wave-overlay-3 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath d='M0,256L48,261.3C96,267,192,277,288,266.7C384,256,480,224,576,218.7C672,213,768,235,864,245.3C960,256,1056,256,1152,234.7C1248,213,1344,171,1392,149.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z' fill='%23ffffff' fill-opacity='0.15'%3E%3C/path%3E%3C/svg%3E");
        background-size: 100% 100%;
        background-position: bottom center;
        animation: wave-animation3 15s linear infinite alternate;
        pointer-events: none;
        z-index: 3;
    }

    @keyframes wave-animation1 {
        0% { transform: translateX(0) scale(1.05); }
        100% { transform: translateX(-3%) scale(1.05); }
    }

    @keyframes wave-animation2 {
        0% { transform: translateX(0) scale(1.02); }
        100% { transform: translateX(3%) scale(1.02); }
    }

    @keyframes wave-animation3 {
        0% { transform: translateX(0) scale(1.03); }
        100% { transform: translateX(-2%) scale(1.03); }
    }

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

    .text-reveal {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 1s ease-out forwards;
    }

    .text-reveal-delay-1 {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 1s ease-out 0.3s forwards;
    }

    .text-reveal-delay-2 {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 1s ease-out 0.6s forwards;
    }

    @keyframes textReveal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Card hover effect */
    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 50%,
            rgba(255, 255, 255, 0) 100%
        );
        transform: rotate(30deg);
        opacity: 0;
        transition: opacity 0.6s;
    }

    .shine-effect:hover::after {
        opacity: 1;
        animation: shine 1.5s forwards;
    }

    @keyframes shine {
        100% {
            left: 150%;
            top: 100%;
        }
    }

    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        gap: 0.5rem;
    }

    .pagination li {
        display: inline-flex;
    }

    .pagination li > * {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .pagination li > *:not(.text-gray-500) {
        background-color: white;
        color: #3b82f6;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .pagination li > *:hover:not(.text-gray-500) {
        background-color: #eff6ff;
        color: #2563eb;
    }

    .pagination .active > * {
        background-color: #3b82f6 !important;
        color: white !important;
        font-weight: 600;
    }

    .pagination li span[aria-disabled="true"] {
        color: #9ca3af;
        background-color: #f3f4f6;
        cursor: not-allowed;
    }

    /* Underwater Current Effect */
    .underwater-current {
        background: linear-gradient(45deg,
            rgba(59, 130, 246, 0.1) 0%,
            transparent 25%,
            rgba(6, 182, 212, 0.1) 50%,
            transparent 75%,
            rgba(20, 184, 166, 0.1) 100%
        );
        background-size: 400% 400%;
        animation: currentFlow 20s ease-in-out infinite;
    }

    @keyframes currentFlow {
        0%, 100% { background-position: 0% 0%; }
        25% { background-position: 100% 0%; }
        50% { background-position: 100% 100%; }
        75% { background-position: 0% 100%; }
    }

    .grid > div {
        animation-delay: calc(var(--animation-order, 0) * 100ms);
    }

    .shimmer {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach(el => {
        observer.observe(el);
    });

    const cards = document.querySelectorAll('.grid > div');
    cards.forEach((card, index) => {
        card.style.setProperty('--animation-order', index);
    });

    const selects = document.querySelectorAll('select');
    selects.forEach(select => {
        select.addEventListener('change', function() {
            if (this.value) {
                this.classList.add('text-gray-900', 'font-medium');
            } else {
                this.classList.remove('text-gray-900', 'font-medium');
            }
        });

        
        if (select.value) {
            select.classList.add('text-gray-900', 'font-medium');
        }
    });

    const alerts = document.querySelectorAll('[role="alert"]');
    alerts.forEach(alert => {
        if (!alert.querySelector('button')) return;
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    const funfactCards = document.querySelectorAll('.shine-effect');
    funfactCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
        card.classList.add('animate-float');
    });

    const searchInput = document.querySelector('input[name="keyword"]');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                if (this.value.length > 2) {
                    this.classList.add('border-green-300', 'bg-green-50');
                    this.classList.remove('border-gray-200');
                } else {
                    this.classList.remove('border-green-300', 'bg-green-50');
                    this.classList.add('border-gray-200');
                }
            }, 300);
        });
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

function toggleAllHighlighted() {
    if (confirm('Apakah Anda yakin ingin mengubah status sorotan semua fakta menarik?')) {
        console.log('Bulk highlight toggle would be implemented here');
        alert('Fitur ini akan diimplementasikan dalam versi mendatang.');
    }
}

function handleFilterChange(element) {
    element.style.transform = 'scale(0.98)';
    setTimeout(() => {
        element.style.transform = 'scale(1)';
    }, 100);
}

const style = document.createElement('style');
style.textContent = `
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
`;
document.head.appendChild(style);
</script>
@endsection
