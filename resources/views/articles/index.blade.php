@extends('layouts.app')

@section('title', 'Ocean Articles - Explore Marine Knowledge')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
    <!-- Animated Ocean Background -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-400/10 via-cyan-500/10 to-teal-600/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
    </div>

    <!-- Articles Header -->
    <section class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 z-0 deep-sea-bubbles opacity-30"></div>
        <div class="absolute inset-0 z-0 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/ocean-bg.jpg') }}');"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 animate-on-scroll">
                    <div class="w-3 h-3 bg-cyan-300 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-cyan-100 font-medium">Explore Ocean Knowledge</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight text-reveal">
                    <span class="gradient-text">Dive</span> Into Our Ocean <span class="gradient-text">Articles</span>
                </h1>

                <p class="text-xl text-cyan-100 max-w-3xl mx-auto leading-relaxed mb-8 text-reveal-delay-1">
                    Discover marine knowledge shared by our community of ocean experts and enthusiasts from around the world
                </p>

                <!-- Search Form -->
                <form action="{{ route('articles.search') }}" method="GET" class="flex flex-col md:flex-row gap-3 max-w-3xl mx-auto bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20 text-reveal-delay-2">
                    <div class="flex-grow relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-cyan-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" name="query" placeholder="Search the depths..." value="{{ request('query') }}"
                            class="w-full pl-12 py-3 rounded-xl text-gray-800 bg-white/80 backdrop-blur-sm border-0 focus:ring-2 focus:ring-cyan-500">
                    </div>

                    <div class="w-full md:w-1/3">
                        <select name="category" class="w-full py-3 px-4 rounded-xl text-gray-800 bg-white/80 backdrop-blur-sm border-0 focus:ring-2 focus:ring-cyan-500 appearance-none">
                            <option value="">All Ocean Zones</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl font-medium transition duration-300 flex items-center justify-center shadow-lg shadow-blue-700/20">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Explore
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,208C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <!-- Categories Filter Tabs -->
    <section class="bg-white/80 backdrop-blur-sm border-b border-cyan-100 sticky top-16 z-30">
        <div class="container mx-auto px-4 py-4 overflow-x-auto">
            <div class="flex space-x-3 items-center">
                <a href="{{ route('articles.index') }}" class="px-5 py-2.5 whitespace-nowrap rounded-full text-sm font-medium transition-all duration-300 {{ !request('category') ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-md shadow-blue-500/20' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                    All Zones
                </a>

                @foreach($categories as $category)
                    <a href="{{ route('articles.index', ['category' => $category->category_id]) }}"
                       class="px-5 py-2.5 whitespace-nowrap rounded-full text-sm font-medium transition-all duration-300 {{ request('category') == $category->category_id ? 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white shadow-md shadow-blue-500/20' : 'bg-gray-100 hover:bg-gray-200 text-gray-800' }}">
                        {{ $category->nama_kategori }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Tags -->
    <section class="bg-cyan-50/70 py-4 backdrop-blur-sm">
        <div class="container mx-auto px-4">
            <div class="flex items-center flex-wrap gap-3">
                <span class="text-sm font-medium text-gray-700">Popular Currents:</span>
                @foreach($tags as $tag)
                    <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}"
                       class="px-3 py-1 text-xs rounded-full bg-white border border-cyan-200 hover:border-cyan-500 text-gray-700 transition duration-300 hover:bg-blue-50 shadow-sm flex items-center">
                       <span class="w-2 h-2 bg-cyan-500 rounded-full mr-1.5"></span>
                       {{ $tag->nama_tag }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Article (if available) -->
    @if(isset($featuredArticle) && $featuredArticle)
    <section class="py-12 bg-gradient-to-b from-blue-50 to-transparent relative z-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 animate-on-scroll">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    Featured Ocean Discovery
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Deep Dive Highlight</h2>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/30 card-hover animate-on-scroll">
                <div class="grid md:grid-cols-2 gap-0">
                    <div class="relative h-80 md:h-auto overflow-hidden">
                        @if($featuredArticle->gambar)
                            <img src="{{ Storage::url($featuredArticle->gambar) }}" alt="{{ $featuredArticle->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-cyan-600 flex items-center justify-center">
                                <svg class="w-24 h-24 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2 1M4 7l2-1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 left-4">
                            <span class="bg-blue-600 text-white text-sm px-4 py-1.5 rounded-full font-semibold shadow-lg">
                                Featured
                            </span>
                        </div>
                    </div>

                    <div class="p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center mb-4">
                                <span class="bg-cyan-100 text-cyan-800 text-xs px-3 py-1 rounded-full">{{ $featuredArticle->category->nama_kategori }}</span>
                                <span class="text-xs text-gray-500 ml-3">{{ $featuredArticle->tgl_upload->format('M d, Y') }}</span>
                            </div>

                            <h3 class="text-2xl font-bold text-gray-800 mb-4 hover:text-blue-600 transition duration-300">
                                <a href="{{ route('articles.show', $featuredArticle) }}">{{ $featuredArticle->judul }}</a>
                            </h3>

                            <p class="text-gray-600 mb-6 line-clamp-3">
                                {{ Str::limit(strip_tags($featuredArticle->konten_isi_artikel), 200) }}
                            </p>

                            @if($featuredArticle->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach($featuredArticle->tags as $tag)
                                        <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}" class="text-xs text-blue-600 hover:text-blue-800">#{{ $tag->nama_tag }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-100">
                            <div class="flex items-center">
                                <img src="{{ $featuredArticle->user->profile_photo_url }}" alt="{{ $featuredArticle->user->nama }}" class="w-10 h-10 rounded-full mr-3 border-2 border-white shadow">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $featuredArticle->user->nama }}</p>
                                    <p class="text-xs text-gray-500">Ocean Explorer</p>
                                </div>
                            </div>

                            <a href="{{ route('articles.show', $featuredArticle) }}" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-5 py-2 rounded-full text-sm font-medium transition duration-300 flex items-center group shadow-md shadow-blue-500/20">
                                Read Article
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <!-- Articles Grid -->
    <section class="py-12 relative z-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8 animate-on-scroll">
                <div class="inline-flex items-center bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838l-2.727 1.17 1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zm5.99 7.176A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                    </svg>
                    {{ request('category') ? $categories->where('category_id', request('category'))->first()->nama_kategori : 'All Articles' }}
                </div>

                @if(request('query'))
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Results for "{{ request('query') }}"</h2>
                @else
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">
                        <span class="gradient-text">Explore</span>
                        {{ request('category') ? $categories->where('category_id', request('category'))->first()->nama_kategori : 'Ocean Treasures' }}
                    </h2>
                @endif

                <p class="text-gray-600 max-w-2xl mx-auto">
                    Dive into our collection of {{ $articles->total() }} articles about marine life, ocean conservation, and underwater discoveries
                </p>
            </div>

            @if($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($articles as $index => $article)
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition duration-300 border border-white/30 h-full flex flex-col animate-on-scroll" style="animation-delay: {{ $index * 0.1 }}s">
                            <a href="{{ route('articles.show', $article) }}" class="relative block h-48 overflow-hidden">
                                @if($article->gambar)
                                    <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}"
                                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-cyan-100 via-blue-100 to-teal-100 flex items-center justify-center relative">
                                        <svg class="w-16 h-16 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-200/20 to-transparent"></div>
                                    </div>
                                @endif

                                <div class="absolute top-4 right-4">
                                    <span class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white text-xs font-bold px-3 py-1 rounded-lg shadow-md">
                                        {{ $article->category->nama_kategori }}
                                    </span>
                                </div>
                            </a>

                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-xs text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $article->tgl_upload->format('M d, Y') }}
                                    </span>

                                    <div class="flex items-center text-gray-500 text-xs">
                                        <svg class="w-4 h-4 mr-1 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                                        </svg>
                                        {{ $article->reactions->count() }}
                                    </div>
                                </div>

                                <a href="{{ route('articles.show', $article) }}" class="block mb-3">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2 hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                                        {{ $article->judul }}
                                    </h3>
                                </a>

                                <p class="text-gray-600 mb-4 text-sm line-clamp-3 flex-grow">
                                    {{ Str::limit(strip_tags($article->konten_isi_artikel), 120) }}
                                </p>

                                <!-- Article tags -->
                                @if($article->tags->count() > 0)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach($article->tags->take(3) as $tag)
                                            <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}" class="text-xs text-blue-600 hover:text-blue-800 bg-blue-50 px-2 py-1 rounded-md hover:bg-blue-100 transition-colors">
                                                #{{ $tag->nama_tag }}
                                            </a>
                                        @endforeach

                                        @if($article->tags->count() > 3)
                                            <span class="text-xs text-gray-500">+{{ $article->tags->count() - 3 }}</span>
                                        @endif
                                    </div>
                                @endif

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                    <div class="flex items-center">
                                        <img src="{{ $article->user->profile_photo_url }}" alt="{{ $article->user->nama }}"
                                            class="w-8 h-8 rounded-full border border-cyan-200 shadow mr-2">
                                        <span class="text-sm text-gray-700">{{ $article->user->nama }}</span>
                                    </div>

                                    <a href="{{ route('articles.show', $article) }}" class="text-cyan-600 hover:text-cyan-800 text-sm font-semibold flex items-center group">
                                        Read
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
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-16 animate-on-scroll">
                    <div class="mx-auto w-40 h-40 mb-6 bg-blue-50 rounded-full flex items-center justify-center">
                        <svg class="w-20 h-20 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">No Articles Found in These Waters</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        The current you're searching for seems unexplored. Try adjusting your search or filter to find different ocean knowledge.
                    </p>
                    <a href="{{ route('articles.index') }}" class="inline-block bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-cyan-600 shadow-md transition duration-300">
                        Explore All Ocean Articles
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Create Article CTA -->
    <section class="relative z-10">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto transform rotate-180">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>

        @auth
            <section class="py-16 bg-white border-t relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-cyan-50 opacity-50"></div>
                <div class="absolute right-0 bottom-0 w-64 h-64 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-full -mr-20 -mb-20 filter blur-3xl opacity-70"></div>
                <div class="absolute left-0 top-0 w-64 h-64 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full -ml-20 -mt-20 filter blur-3xl opacity-70"></div>

                <div class="container mx-auto px-4 text-center relative z-10">
                    <div class="max-w-2xl mx-auto animate-on-scroll">
                        <div class="inline-flex items-center bg-green-100 text-green-700 px-6 py-2 rounded-full mb-6 font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Share Your Knowledge
                        </div>

                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Have Ocean Wisdom to Share?</h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Contribute your knowledge to our growing community of ocean enthusiasts and help others discover the wonders beneath the waves.
                        </p>

                        <a href="{{ route('articles.create') }}" class="inline-flex items-center bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-4 rounded-xl font-bold hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-green-500/25">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create a New Article
                            <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
        @else
            <section class="py-16 bg-white border-t relative">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-50 to-cyan-50 opacity-50"></div>
                <div class="absolute right-0 bottom-0 w-64 h-64 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-full -mr-20 -mb-20 filter blur-3xl opacity-70"></div>
                <div class="absolute left-0 top-0 w-64 h-64 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full -ml-20 -mt-20 filter blur-3xl opacity-70"></div>

                <div class="container mx-auto px-4 text-center relative z-10">
                    <div class="max-w-2xl mx-auto animate-on-scroll">
                        <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-6 font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Join Our Community
                        </div>

                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Become an Ocean Explorer</h2>
                        <p class="text-lg text-gray-600 mb-8">
                            Sign up to share your ocean knowledge, connect with fellow marine enthusiasts, and contribute to our growing sea of wisdom.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-5 justify-center">
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-8 py-4 rounded-xl font-bold hover:from-blue-600 hover:to-cyan-700 transition-all duration-300 shadow-xl flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Sign Up
                            </a>

                            <a href="{{ route('login') }}" class="bg-white border-2 border-blue-500 text-blue-600 px-8 py-4 rounded-xl font-bold hover:bg-blue-50 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Log In
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endauth
    </section>

    <!-- Related Ocean Content -->
    <section class="py-16 bg-gradient-to-b from-blue-50 to-cyan-50 relative overflow-hidden">
        <div class="absolute inset-0 deep-sea-bubbles opacity-20"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12 animate-on-scroll">
                <div class="inline-flex items-center bg-cyan-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    Discover More
                </div>

                <h2 class="text-3xl font-bold text-gray-800 mb-2">Explore Related Ocean Content</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Continue your underwater journey with these resources
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Funfacts -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-8 flex flex-col border border-white/30 animate-on-scroll">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-400 to-cyan-500 rounded-2xl flex items-center justify-center mb-6 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-3">Ocean Funfacts</h3>
                    <p class="text-gray-600 mb-6 flex-grow">
                        Discover amazing facts about marine life and ocean ecosystems that will surprise and delight you.
                    </p>

                    <a href="{{ route('funfacts.index') }}" class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-6 py-3 rounded-xl font-medium hover:from-teal-600 hover:to-cyan-600 transition duration-300 flex items-center justify-center shadow-md shadow-teal-500/20">
                        Explore Funfacts
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Conservation -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-8 flex flex-col border border-white/30 animate-on-scroll" style="animation-delay: 0.1s">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center mb-6 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-3">Conservation Efforts</h3>
                    <p class="text-gray-600 mb-6 flex-grow">
                        Learn about ongoing conservation projects and how you can contribute to protecting our precious ocean ecosystems.
                    </p>

                    <a href="{{ route('articles.index', ['category' => 3]) }}" class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-xl font-medium hover:from-green-600 hover:to-emerald-600 transition duration-300 flex items-center justify-center shadow-md shadow-green-500/20">
                        Get Involved
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <!-- Educational Resources -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-8 flex flex-col border border-white/30 animate-on-scroll" style="animation-delay: 0.2s">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-indigo-500 rounded-2xl flex items-center justify-center mb-6 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-3">Educational Resources</h3>
                    <p class="text-gray-600 mb-6 flex-grow">
                        Access guides, tutorials, and educational materials to deepen your understanding of marine science.
                    </p>

                    <a href="{{ route('articles.index', ['category' => 2]) }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-xl font-medium hover:from-blue-600 hover:to-indigo-600 transition duration-300 flex items-center justify-center shadow-md shadow-blue-500/20">
                        Start Learning
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('styles')
<style>
    /* Ocean Wave Animations */
    .ocean-waves {
        background: linear-gradient(90deg,
            transparent,
            rgba(6, 182, 212, 0.1) 25%,
            rgba(59, 130, 246, 0.1) 50%,
            rgba(20, 184, 166, 0.1) 75%,
            transparent
        );
        background-size: 200% 100%;
        animation: oceanFlow 8s ease-in-out infinite;
    }

    @keyframes oceanFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Floating Particles */
    .floating-particles {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(6, 182, 212, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 40% 40%, rgba(20, 184, 166, 0.1) 1px, transparent 1px);
        background-size: 100px 100px, 150px 150px, 200px 200px;
        animation: floatParticles 20s linear infinite;
    }

    @keyframes floatParticles {
        0% { background-position: 0 0, 0 0, 0 0; }
        100% { background-position: 100px 100px, -150px 150px, 200px -200px; }
    }

    /* Deep Sea Bubbles */
    .deep-sea-bubbles {
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.1) 3px, transparent 3px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.08) 4px, transparent 4px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.12) 2px, transparent 2px),
            radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.1) 3px, transparent 3px);
        background-size: 300px 300px, 400px 400px, 200px 200px, 350px 350px;
        animation: deepBubbleRise 20s linear infinite;
    }

    @keyframes deepBubbleRise {
        0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%; }
        100% { background-position: 0 -300px, 0 -400px, 0 -200px, 0 -350px; }
    }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(to right, #22d3ee, #3b82f6, #0ea5e9);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: inline;
    }

    /* Text Reveal Animation */
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

    /* Animate On Scroll */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease-out;
    }

    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Line Clamp Utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Articles page script loaded");

        // Intersection Observer for animate-on-scroll elements
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    // Keep observing for elements that might scroll in and out of view
                    if (!entry.target.classList.contains('keep-observing')) {
                        observer.unobserve(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Force animations to show on small screens or when JavaScript might be limited
        setTimeout(function() {
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                if (!el.classList.contains('in-view')) {
                    el.classList.add('in-view');
                }
            });
        }, 1000);

        // Handle category dropdown on mobile
        const categorySelect = document.querySelector('select[name="category"]');
        if (categorySelect) {
            categorySelect.addEventListener('change', function() {
                if (this.value) {
                    window.location.href = `{{ route('articles.index') }}?category=${this.value}`;
                } else {
                    window.location.href = `{{ route('articles.index') }}`;
                }
            });
        }
    });
</script>
@endsection
