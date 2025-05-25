<?php
@extends('layouts.app')

@section('title', 'Bagan - Dive into a Sea of Knowledge')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Animated Ocean Background -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-400/20 via-blue-500/20 to-teal-600/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
    </div>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-cyan-600 via-blue-700 to-teal-800 text-white overflow-hidden min-h-screen flex items-center">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="lighthouse absolute right-10 top-10 opacity-20"></div>
            <div class="floating-particles absolute inset-0"></div>
            <div class="deep-sea-bubbles absolute inset-0"></div>
        </div>

        <!-- Navigation -->
        <div class="absolute top-0 left-0 right-0 z-20 pt-8">
            <div class="container mx-auto px-4">
                <div class="flex justify-center space-x-1 bg-white/10 backdrop-blur-sm rounded-full p-1 max-w-4xl mx-auto">
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-white/20 rounded-full text-white font-semibold text-sm backdrop-blur-sm">O společnosti</a>
                    <a href="{{ route('articles.index') }}" class="px-6 py-3 hover:bg-white/10 rounded-full text-white/80 hover:text-white font-semibold text-sm transition-all">Služby a řešení</a>
                    <a href="{{ route('funfacts.index') }}" class="px-6 py-3 hover:bg-white/10 rounded-full text-white/80 hover:text-white font-semibold text-sm transition-all">Reference</a>
                    <a href="#contact" class="px-6 py-3 hover:bg-white/10 rounded-full text-white/80 hover:text-white font-semibold text-sm transition-all">Kontakt</a>
                </div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="container mx-auto px-4 pt-32 pb-20 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-8">
                    <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 text-reveal">
                        <div class="w-3 h-3 bg-cyan-300 rounded-full mr-3 animate-pulse"></div>
                        <span class="text-cyan-100 font-medium">Website Pemeliharaan Ekosistem Laut</span>
                    </div>
                </div>

                <h1 class="text-6xl md:text-7xl font-bold mb-6 leading-tight text-reveal text-reveal-delay-1">
                    Discover the
                    <span class="gradient-text">Deep Sea</span>
                    <br>of Wisdom
                </h1>

                <p class="text-xl md:text-2xl mb-12 text-cyan-100 max-w-3xl mx-auto leading-relaxed text-reveal text-reveal-delay-2">
                    Navigate through depths of knowledge curated by our community of marine experts and ocean enthusiasts. Explore the mysteries beneath the waves.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center text-reveal text-reveal-delay-3">
                    <a href="{{ route('articles.index') }}" class="group bg-white text-blue-700 px-10 py-5 rounded-full font-bold hover:bg-cyan-50 transition-all duration-300 shadow-2xl transform hover:-translate-y-2 hover:shadow-cyan-500/25 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Explore Ocean Articles
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    @auth
                        <a href="{{ route('articles.create') }}" class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Share Your Discovery
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Join Ocean Community
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Ocean Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <!-- Enhanced Search Section -->
    <div class="container mx-auto px-4 py-16 -mt-32 relative z-30">
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20 max-w-6xl mx-auto glow-border animate-on-scroll">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 typewriter overflow-hidden whitespace-nowrap mx-auto">Navigate the Knowledge Ocean</h2>
                <p class="text-gray-600">Search through depths of wisdom and discoveries</p>
            </div>

            <form action="{{ route('articles.search') }}" method="GET" class="flex flex-col lg:flex-row gap-4 animate-on-scroll">
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="query" placeholder="Dive into what interests you..." class="w-full pl-12 pr-6 py-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-lg bg-white/50 backdrop-blur-sm">
                </div>
                <div class="w-full lg:w-80">
                    <select name="category" class="w-full px-6 py-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 appearance-none bg-white/50 backdrop-blur-sm text-lg">
                        <option value="">All Ocean Depths</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full lg:w-auto bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-10 py-5 rounded-2xl font-bold hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 flex items-center justify-center pulse-ring">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Explore
                    </button>
                </div>
            </form>

            <!-- Popular Categories -->
            <div class="mt-8 flex flex-wrap gap-3 justify-center animate-on-scroll">
                <span class="text-sm text-gray-500 flex items-center mr-4 font-medium">Popular Currents:</span>
                @foreach($categories->take(5) as $category)
                    <a href="{{ route('articles.index', ['category' => $category->category_id]) }}" class="bg-gradient-to-r from-cyan-50 to-blue-50 text-cyan-700 px-6 py-2 rounded-full text-sm hover:from-cyan-100 hover:to-blue-100 transition-all duration-300 border border-cyan-200 hover:border-cyan-300 transform hover:scale-105">
                        {{ $category->nama_kategori }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Auto-scrolling Ocean Gallery Section -->
    <div class="py-20 bg-gradient-to-r from-blue-50/50 to-cyan-50/50 overflow-hidden">
        <div class="container mx-auto px-4 mb-12">
            <div class="text-center animate-on-scroll">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Ocean Gallery
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 slide-in-left">
                    Discover the <span class="gradient-text">Underwater World</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto slide-in-right">
                    Immerse yourself in stunning visuals from the depths of our oceans
                </p>
            </div>
        </div>

        <!-- First Auto-scrolling Row -->
        <div class="overflow-hidden mb-8">
            <div class="flex auto-scroll">
                @foreach($latestArticles as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl morphing-shape">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2 1M4 7l2-1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
                <!-- Duplicate for seamless loop -->
                @foreach($latestArticles->take(5) as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-500"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Second Auto-scrolling Row (Reverse Direction) -->
        <div class="overflow-hidden">
            <div class="flex auto-scroll-reverse">
                @foreach($popularArticles as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
                <!-- Duplicate for seamless loop -->
                @foreach($popularArticles->take(5) as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Articles with Enhanced Visual Design -->
    <div class="container mx-auto px-4 py-20 relative z-20">
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center bg-cyan-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                Featured Ocean Discoveries
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                Treasures from the <span class="gradient-text">Deep</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                Dive into our most captivating articles, handpicked from the vast ocean of knowledge
            </p>
        </div>

        <!-- Enhanced Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($latestArticles as $index => $article)
                <!-- Article Card -->
                <div class="group card-hover card-3d bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/50 h-full flex flex-col animate-on-scroll" style="animation-delay: {{ $index * 0.2 }}s">
                    <div class="card-3d-inner">
                        <div class="relative overflow-hidden h-64">
                            @if($article->gambar)
                                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-cyan-100 via-blue-100 to-teal-100 flex items-center justify-center relative">
                                    <svg class="w-20 h-20 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-200/20 to-transparent"></div>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                                    {{ $article->category->nama_kategori }}
                                </span>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-8 flex-grow flex flex-col">
                            <div class="flex items-center mb-4">
                                <img src="{{ $article->user->foto_profil ? asset('storage/' . $article->user->foto_profil) : asset('images/default-profile.png') }}" alt="{{ $article->user->name }}" class="w-10 h-10 rounded-full border-3 border-white shadow-md">
                                <div class="ml-3">
                                    <span class="text-sm font-semibold text-gray-700">{{ $article->user->name }}</span>
                                    <p class="text-xs text-gray-500">{{ $article->tgl_upload->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold mb-4 text-gray-800 group-hover:text-cyan-700 transition-colors line-clamp-2 flex-grow">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->judul }}</a>
                            </h3>

                            <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                                {{ Str::limit(strip_tags($article->konten_isi_artikel), 120) }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm text-gray-500 ml-1.5 font-medium">{{ $article->reactions->count() }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-500 ml-1.5 font-medium">{{ $article->comments->count() }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-cyan-600 hover:text-cyan-700 font-semibold text-sm flex items-center group">
                                    Read More
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Articles Button -->
        <div class="text-center animate-on-scroll">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-8 py-4 rounded-full font-bold hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-cyan-500/25">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Explore All Ocean Articles
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Statistics Section with Animated Counters -->
    <div class="py-20 bg-gradient-to-r from-cyan-600 via-blue-700 to-teal-800 text-white relative overflow-hidden parallax">
        <div class="absolute inset-0 floating-particles"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-reveal">
                    Ocean <span class="gradient-text text-white">Impact</span> by Numbers
                </h2>
                <p class="text-xl text-cyan-100 max-w-3xl mx-auto text-reveal-delay-1">
                    Discover the scale of our ocean knowledge community and conservation efforts
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $latestArticles->count() * 3 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-cyan-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">2,847</h3>
                    <p class="text-cyan-100 font-medium">Articles Published</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $latestArticles->count() * 20 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">45,392</h3>
                    <p class="text-cyan-100 font-medium">Community Members</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $categories->count() * 20 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-teal-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">156</h3>
                    <p class="text-cyan-100 font-medium">Countries Reached</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $latestArticles->count() * 100 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-purple-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">892K</h3>
                    <p class="text-cyan-100 font-medium">Conservation Actions</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Ocean Explorer Section -->
    <div class="py-20 bg-gradient-to-b from-blue-50 to-cyan-50 relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Interactive Experience
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Dive Deeper with <span class="gradient-text">Ocean Explorer</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Experience interactive marine environments and learn about ocean ecosystems through immersive content
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Interactive Cards -->
                <div class="space-y-6 animate-on-scroll slide-in-left">
                    <div class="group bg-white/80 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-white/50 card-hover glow-border">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Virtual Reef Explorer</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Navigate through a 360° interactive coral reef ecosystem. Discover diverse marine species and learn about their ecological roles.
                        </p>
                        <a href="#" class="text-cyan-600 hover:text-cyan-800 inline-flex items-center font-semibold group">
                            Start Exploring
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="group bg-white/80 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-white/50 card-hover glow-border">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-2xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Ocean Ecosystem Builder</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Create your own balanced marine ecosystem. Add species and observe how they interact with each other in this interactive simulation.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 inline-flex items-center font-semibold group">
                            Start Building
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 3D Interactive Ocean Visualization -->
                <div class="relative animate-on-scroll slide-in-right">
                    <div class="aspect-square max-w-xl mx-auto bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full morphing-shape relative overflow-hidden shadow-2xl">
                        <!-- 3D Ocean Effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-300/30 via-transparent to-blue-400/20"></div>
                        <div class="absolute inset-0 deep-sea-bubbles"></div>

                        <!-- Interactive Ocean Elements - would be replaced with actual interactive elements -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-24 h-24 mx-auto mb-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                                <p class="text-xl font-bold mb-2">Interactive Ocean Globe</p>
                                <p class="text-sm opacity-80">Hover and click to explore different ocean regions</p>
                            </div>
                        </div>

                        <!-- Animated Glow Effect -->
                        <div class="absolute -inset-2 bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-500 opacity-30 blur-xl pulse-ring"></div>
                    </div>

                    <!-- Floating Action Buttons -->
                    <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-4">
                        <button class="bg-white text-cyan-600 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                        <button class="bg-white text-blue-600 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                        <button class="bg-white text-purple-600 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fun Facts - Ocean Mysteries -->
    <div class="bg-gradient-to-b from-blue-50/50 to-cyan-50/50 py-20 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Ocean Mysteries
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                    Fascinating <span class="text-blue-600">Deep Sea Facts</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                    Discover amazing secrets hidden beneath the ocean waves
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($funfacts as $index => $funfact)
                    <div class="group bg-white/70 backdrop-blur-lg rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-white/30 relative overflow-hidden animate-on-scroll" style="animation-delay: {{ $index * 0.2 }}s">
                        <!-- Background Pattern -->
                        <div class="absolute -right-16 -top-16 w-32 h-32 bg-gradient-to-br from-blue-100/50 to-cyan-100/50 rounded-full opacity-60 group-hover:scale-150 transition-transform duration-700"></div>

                        @if($funfact->gambar)
                            <div class="absolute top-4 right-4 w-16 h-16 opacity-30 rounded-full overflow-hidden group-hover:opacity-50 transition-opacity">
                                <img src="{{ asset('storage/' . $funfact->gambar) }}" alt="" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <span class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                                    Mystery #{{ $funfact->urutan_animasi }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold mb-4 text-gray-800 group-hover:text-blue-700 transition-colors">
                                {{ $funfact->judul }}
                            </h3>

                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ app()->getLocale() === 'id' ? $funfact->deskripsi_id : $funfact->deskripsi_en }}
                            </p>

                            @if($funfact->article_id)
                                <a href="{{ route('articles.show', $funfact->article->slug) }}"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold group-hover:translate-x-1 transition-all">
                                    <span>Dive Deeper</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('funfacts.index') }}" class="inline-flex items-center px-8 py-4 bg-white border-2 border-blue-500 rounded-full text-blue-600 font-bold hover:bg-blue-50 transition-all duration-300 shadow-lg group animate-on-scroll">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span>Uncover More Mysteries</span>
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Trending Articles - Ocean Currents -->
    <div class="container mx-auto px-4 py-20 relative z-20">
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center bg-red-100 text-red-700 px-6 py-2 rounded-full mb-4 font-medium">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                </svg>
                Strong Ocean Currents
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 slide-in-left">
                Whats <span class="text-red-500">Trending</span> in the Deep
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto slide-in-right">
                Ride the wave of popularity with our most-loved ocean content
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            @foreach($popularArticles as $index => $article)
                <div class="group bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 flex flex-col lg:flex-row border border-white/50 animate-on-scroll" style="animation-delay: {{ $index * 0.3 }}s">
                    <div class="lg:w-2/5 relative overflow-hidden">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-64 lg:h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-64 lg:h-full bg-gradient-to-br from-red-50 via-pink-50 to-orange-50 flex items-center justify-center relative">
                                <svg class="w-16 h-16 text-red-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="absolute inset-0 bg-gradient-to-br from-red-200/20 to-transparent"></div>
                            </div>
                        @endif
                        <!-- Trending Badge -->
                        <div class="absolute top-0 left-0 bg-gradient-to-r from-red-500 via-pink-500 to-orange-500 text-white font-bold py-2 px-6 rounded-br-2xl shadow-lg">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                </svg>
                                #{{ $index + 1 }} Trending
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-3/5 p-8 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $article->category->nama_kategori }}
                            </span>
                            <div class="flex items-center bg-red-50 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm font-bold text-red-700">{{ $article->reactions_count }}</span>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-red-600 transition-colors line-clamp-2 flex-grow">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->judul }}</a>
                        </h3>

                        <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($article->konten_isi_artikel), 150) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                            <div class="flex items-center">
                                <img src="{{ $article->user->foto_profil ? asset('storage/' . $article->user->foto_profil) : asset('images/default-profile.png') }}" alt="{{ $article->user->name }}" class="w-10 h-10 rounded-full border-2 border-white shadow-md mr-3">
                                <div>
                                    <span class="text-sm font-semibold text-gray-700">{{ $article->user->name }}</span>
                                    <p class="text-xs text-gray-500">Ocean Explorer</p>
                                </div>
                            </div>
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-red-600 hover:text-red-800 text-sm font-bold flex items-center group bg-red-50 px-4 py-2 rounded-full hover:bg-red-100 transition-all">
                                <span>Ride the Wave</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="// filepath: c:\xampp\htdocs\projectpwl\resources\views\homenew.blade.php
@extends('layouts.app')

@section('title', 'Bagan - Dive into a Sea of Knowledge')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Animated Ocean Background -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-400/20 via-blue-500/20 to-teal-600/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
    </div>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-cyan-600 via-blue-700 to-teal-800 text-white overflow-hidden min-h-screen flex items-center">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="lighthouse absolute right-10 top-10 opacity-20"></div>
            <div class="floating-particles absolute inset-0"></div>
            <div class="deep-sea-bubbles absolute inset-0"></div>
        </div>

        <!-- Navigation -->
        <div class="absolute top-0 left-0 right-0 z-20 pt-8">
            <div class="container mx-auto px-4">
                <div class="flex justify-center space-x-1 bg-white/10 backdrop-blur-sm rounded-full p-1 max-w-4xl mx-auto">
                    <a href="{{ route('home') }}" class="px-6 py-3 bg-white/20 rounded-full text-white font-semibold text-sm backdrop-blur-sm">O společnosti</a>
                    <a href="{{ route('articles.index') }}" class="px-6 py-3 hover:bg-white/10 rounded-full text-white/80 hover:text-white font-semibold text-sm transition-all">Služby a řešení</a>
                    <a href="{{ route('funfacts.index') }}" class="px-6 py-3 hover:bg-white/10 rounded-full text-white/80 hover:text-white font-semibold text-sm transition-all">Reference</a>
                    <a href="#contact" class="px-6 py-3 hover:bg-white/10 rounded-full text-white/80 hover:text-white font-semibold text-sm transition-all">Kontakt</a>
                </div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="container mx-auto px-4 pt-32 pb-20 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-8">
                    <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-6 text-reveal">
                        <div class="w-3 h-3 bg-cyan-300 rounded-full mr-3 animate-pulse"></div>
                        <span class="text-cyan-100 font-medium">Website Pemeliharaan Ekosistem Laut</span>
                    </div>
                </div>

                <h1 class="text-6xl md:text-7xl font-bold mb-6 leading-tight text-reveal text-reveal-delay-1">
                    Discover the
                    <span class="gradient-text">Deep Sea</span>
                    <br>of Wisdom
                </h1>

                <p class="text-xl md:text-2xl mb-12 text-cyan-100 max-w-3xl mx-auto leading-relaxed text-reveal text-reveal-delay-2">
                    Navigate through depths of knowledge curated by our community of marine experts and ocean enthusiasts. Explore the mysteries beneath the waves.
                </p>

                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center text-reveal text-reveal-delay-3">
                    <a href="{{ route('articles.index') }}" class="group bg-white text-blue-700 px-10 py-5 rounded-full font-bold hover:bg-cyan-50 transition-all duration-300 shadow-2xl transform hover:-translate-y-2 hover:shadow-cyan-500/25 flex items-center">
                        <svg class="w-6 h-6 mr-3 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Explore Ocean Articles
                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>

                    @auth
                        <a href="{{ route('articles.create') }}" class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Share Your Discovery
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Join Ocean Community
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Ocean Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <!-- Enhanced Search Section -->
    <div class="container mx-auto px-4 py-16 -mt-32 relative z-30">
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20 max-w-6xl mx-auto glow-border animate-on-scroll">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-2 typewriter overflow-hidden whitespace-nowrap mx-auto">Navigate the Knowledge Ocean</h2>
                <p class="text-gray-600">Search through depths of wisdom and discoveries</p>
            </div>

            <form action="{{ route('articles.search') }}" method="GET" class="flex flex-col lg:flex-row gap-4 animate-on-scroll">
                <div class="flex-grow relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-6 h-6 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="query" placeholder="Dive into what interests you..." class="w-full pl-12 pr-6 py-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 text-lg bg-white/50 backdrop-blur-sm">
                </div>
                <div class="w-full lg:w-80">
                    <select name="category" class="w-full px-6 py-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 appearance-none bg-white/50 backdrop-blur-sm text-lg">
                        <option value="">All Ocean Depths</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full lg:w-auto bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-10 py-5 rounded-2xl font-bold hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 flex items-center justify-center pulse-ring">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Explore
                    </button>
                </div>
            </form>

            <!-- Popular Categories -->
            <div class="mt-8 flex flex-wrap gap-3 justify-center animate-on-scroll">
                <span class="text-sm text-gray-500 flex items-center mr-4 font-medium">Popular Currents:</span>
                @foreach($categories->take(5) as $category)
                    <a href="{{ route('articles.index', ['category' => $category->category_id]) }}" class="bg-gradient-to-r from-cyan-50 to-blue-50 text-cyan-700 px-6 py-2 rounded-full text-sm hover:from-cyan-100 hover:to-blue-100 transition-all duration-300 border border-cyan-200 hover:border-cyan-300 transform hover:scale-105">
                        {{ $category->nama_kategori }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Auto-scrolling Ocean Gallery Section -->
    <div class="py-20 bg-gradient-to-r from-blue-50/50 to-cyan-50/50 overflow-hidden">
        <div class="container mx-auto px-4 mb-12">
            <div class="text-center animate-on-scroll">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Ocean Gallery
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 slide-in-left">
                    Discover the <span class="gradient-text">Underwater World</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto slide-in-right">
                    Immerse yourself in stunning visuals from the depths of our oceans
                </p>
            </div>
        </div>

        <!-- First Auto-scrolling Row -->
        <div class="overflow-hidden mb-8">
            <div class="flex auto-scroll">
                @foreach($latestArticles as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl morphing-shape">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2 1M4 7l2-1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
                <!-- Duplicate for seamless loop -->
                @foreach($latestArticles->take(5) as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-cyan-400 to-blue-500"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Second Auto-scrolling Row (Reverse Direction) -->
        <div class="overflow-hidden">
            <div class="flex auto-scroll-reverse">
                @foreach($popularArticles as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                <svg class="w-20 h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
                <!-- Duplicate for seamless loop -->
                @foreach($popularArticles->take(5) as $article)
                    <div class="flex-shrink-0 w-80 h-60 mx-4 rounded-2xl overflow-hidden shadow-xl">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500"></div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Articles with Enhanced Visual Design -->
    <div class="container mx-auto px-4 py-20 relative z-20">
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center bg-cyan-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                Featured Ocean Discoveries
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                Treasures from the <span class="gradient-text">Deep</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                Dive into our most captivating articles, handpicked from the vast ocean of knowledge
            </p>
        </div>

        <!-- Enhanced Articles Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($latestArticles as $index => $article)
                <!-- Article Card -->
                <div class="group card-hover card-3d bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/50 h-full flex flex-col animate-on-scroll" style="animation-delay: {{ $index * 0.2 }}s">
                    <div class="card-3d-inner">
                        <div class="relative overflow-hidden h-64">
                            @if($article->gambar)
                                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-cyan-100 via-blue-100 to-teal-100 flex items-center justify-center relative">
                                    <svg class="w-20 h-20 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-200/20 to-transparent"></div>
                                </div>
                            @endif
                            <div class="absolute top-4 right-4">
                                <span class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                                    {{ $article->category->nama_kategori }}
                                </span>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-8 flex-grow flex flex-col">
                            <div class="flex items-center mb-4">
                                <img src="{{ $article->user->foto_profil ? asset('storage/' . $article->user->foto_profil) : asset('images/default-profile.png') }}" alt="{{ $article->user->name }}" class="w-10 h-10 rounded-full border-3 border-white shadow-md">
                                <div class="ml-3">
                                    <span class="text-sm font-semibold text-gray-700">{{ $article->user->name }}</span>
                                    <p class="text-xs text-gray-500">{{ $article->tgl_upload->format('M d, Y') }}</p>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold mb-4 text-gray-800 group-hover:text-cyan-700 transition-colors line-clamp-2 flex-grow">
                                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->judul }}</a>
                            </h3>

                            <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                                {{ Str::limit(strip_tags($article->konten_isi_artikel), 120) }}
                            </p>

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="text-sm text-gray-500 ml-1.5 font-medium">{{ $article->reactions->count() }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-500 ml-1.5 font-medium">{{ $article->comments->count() }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}" class="text-cyan-600 hover:text-cyan-700 font-semibold text-sm flex items-center group">
                                    Read More
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- View All Articles Button -->
        <div class="text-center animate-on-scroll">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-8 py-4 rounded-full font-bold hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-cyan-500/25">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Explore All Ocean Articles
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Statistics Section with Animated Counters -->
    <div class="py-20 bg-gradient-to-r from-cyan-600 via-blue-700 to-teal-800 text-white relative overflow-hidden parallax">
        <div class="absolute inset-0 floating-particles"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <h2 class="text-4xl md:text-5xl font-bold mb-4 text-reveal">
                    Ocean <span class="gradient-text text-white">Impact</span> by Numbers
                </h2>
                <p class="text-xl text-cyan-100 max-w-3xl mx-auto text-reveal-delay-1">
                    Discover the scale of our ocean knowledge community and conservation efforts
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $latestArticles->count() * 3 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-cyan-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">2,847</h3>
                    <p class="text-cyan-100 font-medium">Articles Published</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $latestArticles->count() * 20 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">45,392</h3>
                    <p class="text-cyan-100 font-medium">Community Members</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $categories->count() * 20 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-teal-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">156</h3>
                    <p class="text-cyan-100 font-medium">Countries Reached</p>
                </div>

                <div class="text-center p-8 bg-white/10 backdrop-blur-sm rounded-3xl border border-white/20 card-hover animate-on-scroll" data-counter-value="{{ $latestArticles->count() * 100 }}">
                    <div class="w-16 h-16 mx-auto mb-4 bg-purple-400 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold mb-2 text-white counter">892K</h3>
                    <p class="text-cyan-100 font-medium">Conservation Actions</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Ocean Explorer Section -->
    <div class="py-20 bg-gradient-to-b from-blue-50 to-cyan-50 relative overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    Interactive Experience
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Dive Deeper with <span class="gradient-text">Ocean Explorer</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Experience interactive marine environments and learn about ocean ecosystems through immersive content
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Interactive Cards -->
                <div class="space-y-6 animate-on-scroll slide-in-left">
                    <div class="group bg-white/80 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-white/50 card-hover glow-border">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-2xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Virtual Reef Explorer</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Navigate through a 360° interactive coral reef ecosystem. Discover diverse marine species and learn about their ecological roles.
                        </p>
                        <a href="#" class="text-cyan-600 hover:text-cyan-800 inline-flex items-center font-semibold group">
                            Start Exploring
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="group bg-white/80 backdrop-blur-sm p-8 rounded-3xl shadow-xl border border-white/50 card-hover glow-border">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-2xl flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Ocean Ecosystem Builder</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Create your own balanced marine ecosystem. Add species and observe how they interact with each other in this interactive simulation.
                        </p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 inline-flex items-center font-semibold group">
                            Start Building
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- 3D Interactive Ocean Visualization -->
                <div class="relative animate-on-scroll slide-in-right">
                    <div class="aspect-square max-w-xl mx-auto bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full morphing-shape relative overflow-hidden shadow-2xl">
                        <!-- 3D Ocean Effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-cyan-300/30 via-transparent to-blue-400/20"></div>
                        <div class="absolute inset-0 deep-sea-bubbles"></div>

                        <!-- Interactive Ocean Elements - would be replaced with actual interactive elements -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-24 h-24 mx-auto mb-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                                <p class="text-xl font-bold mb-2">Interactive Ocean Globe</p>
                                <p class="text-sm opacity-80">Hover and click to explore different ocean regions</p>
                            </div>
                        </div>

                        <!-- Animated Glow Effect -->
                        <div class="absolute -inset-2 bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-500 opacity-30 blur-xl pulse-ring"></div>
                    </div>

                    <!-- Floating Action Buttons -->
                    <div class="absolute -bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-4">
                        <button class="bg-white text-cyan-600 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                        <button class="bg-white text-blue-600 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                        <button class="bg-white text-purple-600 w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fun Facts - Ocean Mysteries -->
    <div class="bg-gradient-to-b from-blue-50/50 to-cyan-50/50 py-20 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-blue-100 text-blue-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    Ocean Mysteries
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                    Fascinating <span class="text-blue-600">Deep Sea Facts</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                    Discover amazing secrets hidden beneath the ocean waves
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($funfacts as $index => $funfact)
                    <div class="group bg-white/70 backdrop-blur-lg rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-white/30 relative overflow-hidden animate-on-scroll" style="animation-delay: {{ $index * 0.2 }}s">
                        <!-- Background Pattern -->
                        <div class="absolute -right-16 -top-16 w-32 h-32 bg-gradient-to-br from-blue-100/50 to-cyan-100/50 rounded-full opacity-60 group-hover:scale-150 transition-transform duration-700"></div>

                        @if($funfact->gambar)
                            <div class="absolute top-4 right-4 w-16 h-16 opacity-30 rounded-full overflow-hidden group-hover:opacity-50 transition-opacity">
                                <img src="{{ asset('storage/' . $funfact->gambar) }}" alt="" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="relative z-10">
                            <div class="flex items-center mb-4">
                                <span class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg">
                                    Mystery #{{ $funfact->urutan_animasi }}
                                </span>
                            </div>

                            <h3 class="text-xl font-bold mb-4 text-gray-800 group-hover:text-blue-700 transition-colors">
                                {{ $funfact->judul }}
                            </h3>

                            <p class="text-gray-600 mb-6 leading-relaxed">
                                {{ app()->getLocale() === 'id' ? $funfact->deskripsi_id : $funfact->deskripsi_en }}
                            </p>

                            @if($funfact->article_id)
                                <a href="{{ route('articles.show', $funfact->article->slug) }}"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold group-hover:translate-x-1 transition-all">
                                    <span>Dive Deeper</span>
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('funfacts.index') }}" class="inline-flex items-center px-8 py-4 bg-white border-2 border-blue-500 rounded-full text-blue-600 font-bold hover:bg-blue-50 transition-all duration-300 shadow-lg group animate-on-scroll">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span>Uncover More Mysteries</span>
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Trending Articles - Ocean Currents -->
    <div class="container mx-auto px-4 py-20 relative z-20">
        <div class="text-center mb-16 animate-on-scroll">
            <div class="inline-flex items-center bg-red-100 text-red-700 px-6 py-2 rounded-full mb-4 font-medium">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                </svg>
                Strong Ocean Currents
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 slide-in-left">
                What's <span class="text-red-500">Trending</span> in the Deep
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto slide-in-right">
                Ride the wave of popularity with our most-loved ocean content
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            @foreach($popularArticles as $index => $article)
                <div class="group bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 flex flex-col lg:flex-row border border-white/50 animate-on-scroll" style="animation-delay: {{ $index * 0.3 }}s">
                    <div class="lg:w-2/5 relative overflow-hidden">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-64 lg:h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-64 lg:h-full bg-gradient-to-br from-red-50 via-pink-50 to-orange-50 flex items-center justify-center relative">
                                <svg class="w-16 h-16 text-red-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="absolute inset-0 bg-gradient-to-br from-red-200/20 to-transparent"></div>
                            </div>
                        @endif
                        <!-- Trending Badge -->
                        <div class="absolute top-0 left-0 bg-gradient-to-r from-red-500 via-pink-500 to-orange-500 text-white font-bold py-2 px-6 rounded-br-2xl shadow-lg">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                </svg>
                                #{{ $index + 1 }} Trending
                            </div>
                        </div>
                    </div>

                    <div class="lg:w-3/5 p-8 flex flex-col">
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $article->category->nama_kategori }}
                            </span>
                            <div class="flex items-center bg-red-50 px-3 py-1 rounded-full">
                                <svg class="w-4 h-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm font-bold text-red-700">{{ $article->reactions_count }}</span>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-red-600 transition-colors line-clamp-2 flex-grow">
                            <a href="{{ route('articles.show', $article->slug) }}">{{ $article->judul }}</a>
                        </h3>

                        <p class="text-gray-600 mb-6 line-clamp-3 flex-grow">
                            {{ Str::limit(strip_tags($article->konten_isi_artikel), 150) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                            <div class="flex items-center">
                                <img src="{{ $article->user->foto_profil ? asset('storage/' . $article->user->foto_profil) : asset('images/default-profile.png') }}" alt="{{ $article->user->name }}" class="w-10 h-10 rounded-full border-2 border-white shadow-md mr-3">
                                <div>
                                    <span class="text-sm font-semibold text-gray-700">{{ $article->user->name }}</span>
                                    <p class="text-xs text-gray-500">Ocean Explorer</p>
                                </div>
                            </div>
                            <a href="{{ route('articles.show', $article->slug) }}" class="text-red-600 hover:text-red-800 text-sm font-bold flex items-center group bg-red-50 px-4 py-2 rounded-full hover:bg-red-100 transition-all">
                                <span>Ride the Wave</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Categories Explorer - Ocean Zones -->
    <div class="bg-gradient-to-b from-gray-50/50 to-white/50 py-20 relative">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-cyan-50/30 to-transparent"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-gray-100 text-gray-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Ocean Zones
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                    Explore Knowledge <span class="text-cyan-600">Ocean Depths</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                    Navigate through different zones of our knowledge ocean, each containing unique treasures of wisdom
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6 animate-on-scroll">
                @foreach($categories as $category)
                    <a href="{{ route('articles.index', ['category' => $category->category_id]) }}"
                       class="group bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 hover:bg-gradient-to-br hover:from-cyan-50 hover:to-blue-50 border border-white/50">
                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 flex items-center justify-center group-hover:from-cyan-200 group-hover:to-blue-200 transition-all duration-300 shadow-inner">
                            <span class="text-cyan-600 font-bold text-2xl group-hover:scale-110 transition-transform">
                                {{ strtoupper(substr($category->nama_kategori, 0, 1)) }}
                            </span>
                        </div>
                        <h3 class="font-bold text-gray-800 group-hover:text-cyan-700 transition-colors mb-1">
                            {{ $category->nama_kategori }}
                        </h3>
                        <p class="text-xs text-gray-500 group-hover:text-gray-600">
                            {{ $category->articles_count ?? 0 }} treasures
                        </p>
                        <div class="mt-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <div class="w-8 h-0.5 bg-gradient-to-r from-cyan-400 to-blue-400 mx-auto rounded-full"></div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- CTA Section - Join Ocean Community -->
    <div class="relative bg-gradient-to-br from-cyan-600 via-blue-700 to-teal-800 text-white py-24 overflow-hidden">
        <!-- Animated Ocean Background -->
        <div class="absolute inset-0 z-0">
            <div class="deep-sea-bubbles absolute inset-0"></div>
            <div class="ocean-current absolute inset-0 opacity-20"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-4xl mx-auto animate-on-scroll">
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-8">
                    <div class="w-3 h-3 bg-cyan-300 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-cyan-100 font-medium">Join the Ocean Community</span>
                </div>

                <h2 class="text-5xl md:text-6xl font-bold mb-6 leading-tight text-reveal">
                    Become an
                    <span class="gradient-text">Ocean Explorer</span>
                </h2>

                <p class="text-xl md:text-2xl mb-12 text-cyan-100 max-w-3xl mx-auto leading-relaxed text-reveal-delay-1">
                    Share your marine discoveries, connect with fellow ocean enthusiasts, and help create the world's largest sea of knowledge
                </p>

                @auth
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center text-reveal-delay-2">
                        <a href="{{ route('articles.create') }}"
                           class="group bg-white text-blue-700 px-10 py-5 rounded-full font-bold hover:bg-cyan-50 transition-all duration-300 shadow-xl transform hover:-translate-y-2 hover:shadow-cyan-500/25 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Start Your Ocean Journey
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>

                        <a href="{{ route('articles.index') }}"
                           class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Explore Ocean Depths
                        </a>
                    </div>
                @else
                    <div class="flex flex-col sm:flex-row gap-6 justify-center items-center text-reveal-delay-2">
                        <a href="{{ route('login') }}"
                           class="group bg-white text-blue-700 px-10 py-5 rounded-full font-bold hover:bg-cyan-50 transition-all duration-300 shadow-xl transform hover:-translate-y-2 hover:shadow-cyan-500/25 flex items-center">
                            <svg class="w-6 h-6 mr-3 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Dive Into Login
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>

                        <a href="{{ route('register') }}"
                           class="group bg-transparent border-2 border-white/50 backdrop-blur-sm px-10 py-5 rounded-full font-bold hover:bg-white hover:text-blue-700 transition-all duration-300 flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                            </svg>
                            Join Ocean Community
                        </a>
                    </div>
                @endauth

                <!-- Ocean Stats with Animated Counters -->
                <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-2xl mx-auto text-reveal-delay-3">
                    <div class="text-center card-hover bg-white/10 rounded-xl backdrop-blur-sm p-6">
                        <div class="text-3xl font-bold text-white mb-2 counter">{{ number_format($latestArticles->count() * 50) }}+</div>
                        <div class="text-cyan-200 text-sm">Ocean Explorers</div>
                    </div>
                    <div class="text-center card-hover bg-white/10 rounded-xl backdrop-blur-sm p-6">
                        <div class="text-3xl font-bold text-white mb-2 counter">{{ number_format($categories->count() * 100) }}+</div>
                        <div class="text-cyan-200 text-sm">Articles Published</div>
                    </div>
                    <div class="text-center card-hover bg-white/10 rounded-xl backdrop-blur-sm p-6">
                        <div class="text-3xl font-bold text-white mb-2 counter">{{ $categories->count() }}+</div>
                        <div class="text-cyan-200 text-sm">Ocean Zones</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ocean Wave Bottom -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,224L48,208C96,192,192,160,288,160C384,160,480,192,576,213.3C672,235,768,245,864,234.7C960,224,1056,192,1152,181.3C1248,171,1344,181,1392,186.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <!-- Contact & Newsletter Section -->
    <div id="contact" class="bg-white py-20 relative">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-flex items-center bg-teal-100 text-teal-700 px-6 py-2 rounded-full mb-4 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Stay Connected
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 fade-in-scale">
                    Join the <span class="text-teal-600">Wave</span> of Updates
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto fade-in-scale">
                    Subscribe to our newsletter and be the first to receive ocean discoveries, conservation updates, and exclusive content
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Newsletter Form -->
                <div class="bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50 rounded-3xl p-8 md:p-12 shadow-xl animate-on-scroll slide-in-left relative overflow-hidden">
                    <div class="absolute -right-16 -bottom-16 w-64 h-64 bg-gradient-to-br from-cyan-100/30 to-transparent rounded-full"></div>
                    <div class="absolute -left-16 -top-16 w-64 h-64 bg-gradient-to-br from-blue-100/30 to-transparent rounded-full"></div>

                    <div class="relative z-10">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Stay in the Current</h3>
                        <p class="text-gray-600 mb-8">Get weekly updates on ocean conservation efforts, new articles, and exclusive underwater stories.</p>

                        <form action="#" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                    <input type="email" id="email" name="email" placeholder="youremail@example.com" class="w-full pl-12 pr-6 py-4 rounded-xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-700 bg-white/70 backdrop-blur-sm">
                                </div>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <input type="text" id="name" name="name" placeholder="Your name" class="w-full pl-12 pr-6 py-4 rounded-xl border-2 border-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 text-gray-700 bg-white/70 backdrop-blur-sm">
                                </div>
                            </div>

                            <div class="flex items-center">
                                <input id="newsletter" name="newsletter" type="checkbox" class="h-5 w-5 text-teal-600 focus:ring-teal-500 border-gray-300 rounded">
                                <label for="newsletter" class="ml-3 text-sm text-gray-600">
                                    I'd like to receive ocean conservation updates and exclusive content
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-cyan-600 text-white px-6 py-4 rounded-xl font-bold hover:from-teal-600 hover:to-cyan-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Subscribe to Newsletter
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="space-y-8 animate-on-scroll slide-in-right">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Reach Out to Us</h3>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-cyan-400 to-teal-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Phone Support</h4>
                            <p class="text-gray-600 mb-2">Our ocean experts are ready to help</p>
                            <p class="text-teal-600 font-semibold">(+62) 812-3456-7890</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Email Contact</h4>
                            <p class="text-gray-600 mb-2">Get in touch with our support team</p>
                            <p class="text-blue-600 font-semibold">support@oceanwisdom.com</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">Office Location</h4>
                            <p class="text-gray-600 mb-2">Visit our ocean knowledge center</p>
                            <p class="text-purple-600 font-semibold">Jl. Laut Biru No. 123, Jakarta, Indonesia</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-8 mt-8">
                        <h4 class="font-bold text-gray-800 mb-4">Follow Our Ocean Waves</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="w-12 h-12 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-blue-100 hover:bg-blue-200 text-blue-400 rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.195A4.92 4.92 0 0016.77 2.5a4.923 4.923 0 00-4.923 4.923c0 .386.043.76.126 1.12A13.986 13.986 0 013.401 3.114a4.892 4.892 0 00-.667 2.476 4.92 4.92 0 002.19 4.098A4.902 4.902 0 012.5 9.13v.062a4.924 4.924 0 003.95 4.828 4.996 4.996 0 01-2.225.084 4.93 4.93 0 004.6 3.419A9.87 9.87 0 012 19.54a13.934 13.934 0 007.548 2.206c9.054 0 14-7.496 14-13.99 0-.21-.004-.42-.012-.63a10 10 0 002.417-2.556z" />
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-pink-100 hover:bg-pink-200 text-pink-600 rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" />
                                </svg>
                            </a>
                            <a href="#" class="w-12 h-12 bg-red-100 hover:bg-red-200 text-red-600 rounded-full flex items-center justify-center transition-colors">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-12 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="deep-sea-bubbles absolute inset-0 opacity-5"></div>
            <div class="ocean-current absolute inset-0 opacity-5"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-xl font-bold mb-6 text-cyan-400">About Ocean Wisdom</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">Dedicated to sharing knowledge about ocean ecosystems, marine life conservation, and promoting sustainable practices for our oceans.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.195A4.92 4.92 0 0016.77 2.5a4.923 4.923 0 00-4.923 4.923c0 .386.043.76.126 1.12A13.986 13.986 0 013.401 3.114a4.892 4.892 0 00-.667 2.476 4.92 4.92 0 002.19 4.098A4.902 4.902 0 012.5 9.13v.062a4.924 4.924 0 003.95 4.828 4.996 4.996 0 01-2.225.084 4.93 4.93 0 004.6 3.419A9.87 9.87 0 012 19.54a13.934 13.934 0 007.548 2.206c9.054 0 14-7.496 14-13.99 0-.21-.004-.42-.012-.63a10 10 0 002.417-2.556z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6 text-cyan-400">Quick Links</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white transition-colors">Explore Articles</a></li>
                        <li><a href="{{ route('funfacts.index') }}" class="text-gray-400 hover:text-white transition-colors">Ocean Facts</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact Us</a></li>
                        @auth
                            <li><a href="{{ route('articles.create') }}" class="text-gray-400 hover:text-white transition-colors">Create Article</a></li>
                            <li><a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-white transition-colors">My Profile</a></li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Sign Up</a></li>
                        @endauth
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6 text-cyan-400">Ocean Categories</h3>
                    <ul class="space-y-4">
                        @foreach($categories->take(6) as $category)
                            <li><a href="{{ route('articles.index', ['category' => $category->category_id]) }}" class="text-gray-400 hover:text-white transition-colors">{{ $category->nama_kategori }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6 text-cyan-400">Contact Info</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-400">Jl. Laut Biru No. 123, Jakarta, Indonesia</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-400">(+62) 812-3456-7890</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-400">support@oceanwisdom.com</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-400">Monday-Friday: 9am-5pm</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2025 Ocean Wisdom. All rights reserved. Designed with 💙 for the ocean.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Back to Top Button -->
<button id="back-to-top" class="fixed bottom-8 right-8 bg-gradient-to-r from-cyan-500 to-blue-600 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50 hover:from-cyan-600 hover:to-blue-700">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>
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
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.08) 3px, transparent 3px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.06) 4px, transparent 4px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
            radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.08) 3px, transparent 3px);
        background-size: 300px 300px, 400px 400px, 200px 200px, 350px 350px;
        animation: deepBubbleRise 20s linear infinite;
    }

    @keyframes deepBubbleRise {
        0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%; }
        100% { background-position: 0 -300px, 0 -400px, 0 -200px, 0 -350px; }
    }

    /* Ocean Current Animation */
    .ocean-current {
        background: linear-gradient(45deg,
            transparent 30%,
            rgba(255, 255, 255, 0.05) 50%,
            transparent 70%
        );
        background-size: 200px 200px;
        animation: currentFlow 12s ease-in-out infinite;
    }

    @keyframes currentFlow {
        0%, 100% { background-position: -200px -200px; }
        50% { background-position: 200px 200px; }
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

    .text-reveal-delay-3 {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 1s ease-out 0.9s forwards;
    }

    @keyframes textReveal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Slide In Animations */
    .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 0.8s ease-out;
    }

    .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.8s ease-out;
    }

    .animate-on-scroll .slide-in-left.in-view,
    .animate-on-scroll .slide-in-right.in-view {
        opacity: 1;
        transform: translateX(0);
    }

    /* Fade In Scale */
    .fade-in-scale {
        opacity: 0;
        transform: scale(0.9);
        transition: all 0.6s ease-out;
    }

    .fade-in-scale.in-view {
        opacity: 1;
        transform: scale(1);
    }

    /* Auto-scroll Animation */
    .auto-scroll {
        animation: autoScroll 60s linear infinite;
    }

    .auto-scroll-reverse {
        animation: autoScrollReverse 60s linear infinite;
    }

    @keyframes autoScroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    @keyframes autoScrollReverse {
        0% { transform: translateX(-50%); }
        100% { transform: translateX(0); }
    }

    /* Glow Border Effect */
    .glow-border {
        box-shadow: 0 0 15px rgba(6, 182, 212, 0.2);
        transition: box-shadow 0.3s ease-in-out;
    }

    .glow-border:hover {
        box-shadow: 0 0 25px rgba(6, 182, 212, 0.4);
    }

    /* Card Hover Effect */
    .card-hover {
        transition: all 0.3s ease-in-out;
    }

    .card-hover:hover {
        transform: translateY(-10px);
    }

    /* Card 3D Effect */
    .card-3d {
        perspective: 1000px;
    }

    .card-3d-inner {
        transition: transform 0.6s;
    }

    .card-3d:hover .card-3d-inner {
        transform: rotateY(5deg) rotateX(5deg);
    }

    /* Morphing Shape */
    .morphing-shape {
        border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        transition: all 2s ease-in-out;
        animation: morphing 8s ease-in-out infinite;
    }

    @keyframes morphing {
        0% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        50% { border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%; }
        100% { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
    }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(to right, #22d3ee, #60a5fa, #14b8a6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: inline-block;
    }

    /* Pulse Ring Animation */
    .pulse-ring {
        position: relative;
    }

    .pulse-ring::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: inherit;
        animation: pulseRing 2s ease-out infinite;
        z-index: -1;
        opacity: 0;
    }

    @keyframes pulseRing {
        0% { transform: scale(0.8); opacity: 0.3; }
        50% { transform: scale(1.2); opacity: 0; }
        100% { transform: scale(0.8); opacity: 0; }
    }

    /* Typewriter Effect */
    .typewriter {
        overflow: hidden;
        white-space: nowrap;
        border-right: 3px solid #22d3ee;
        animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
        width: fit-content;
        max-width: 100%;
    }

    @keyframes typing {
        from { width: 0 }
        to { width: 100% }
    }

    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: #22d3ee }
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

    /* Parallax Effect */
    .parallax {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
                    // Stop observing after animation is triggered
                    if (!entry.target.classList.contains('keep-observing')) {
                        observer.unobserve(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll, .slide-in-left, .slide-in-right, .fade-in-scale').forEach(el => {
            observer.observe(el);
        });

        // Counter Animation
        document.querySelectorAll('.counter').forEach(counter => {
            const target = +counter.innerText.replace(/,/g, '').replace(/\+/g, '');
            const duration = 2000;
            const step = target / duration * 10;
            let current = 0;

            const updateCounter = () => {
                current += step;
                if (current < target) {
                    counter.innerText = Math.floor(current).toLocaleString() + '+';
                    setTimeout(updateCounter, 10);
                } else {
                    counter.innerText = target.toLocaleString() + '+';
                }
            };

            observer.observe(counter.parentElement);
            counter.parentElement.addEventListener('transitionend', updateCounter, { once: true });
        });

        // Back to Top Button
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.add('opacity-0', 'invisible');
                backToTopButton.classList.remove('opacity-100', 'visible');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
@endsection
