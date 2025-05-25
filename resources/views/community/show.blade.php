@extends('layouts.app')

@section('title', $community->nama_komunitas)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Animated Ocean Background -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-400/20 via-blue-500/20 to-teal-600/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
    </div>

    <!-- Alerts Section -->
    <div class="container mx-auto px-4 pt-6 relative z-10">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/90 to-emerald-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 fade-in-up animate-on-scroll">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('success') }}</div>
                    <button type="button" class="text-white hover:text-white/80" data-bs-dismiss="alert" aria-label="Close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-500/90 to-rose-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 fade-in-up animate-on-scroll">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('error') }}</div>
                    <button type="button" class="text-white hover:text-white/80" data-bs-dismiss="alert" aria-label="Close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-gradient-to-r from-blue-500/90 to-indigo-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 fade-in-up animate-on-scroll">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('info') }}</div>
                    <button type="button" class="text-white hover:text-white/80" data-bs-dismiss="alert" aria-label="Close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Community Header Section with Ocean Theme -->
    <div class="relative bg-gradient-to-br from-cyan-600 via-blue-700 to-teal-800 text-white overflow-hidden py-16 mb-12">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 z-0">
            <div class="bg-scroll-right absolute inset-0 bg-cover bg-no-repeat opacity-40" style="background-image: url('{{ asset('images/ocean-bg.jpg') }}');"></div>
            <div class="floating-particles absolute inset-0"></div>
            <div class="deep-sea-bubbles absolute inset-0"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row gap-8 items-center">
                <!-- Community Image -->
                <div class="md:w-1/3 fade-in-scale animate-on-scroll">
                    <div class="relative">
                        @if($community->gambar)
                            <div class="rounded-2xl overflow-hidden morphing-shape shadow-2xl border-4 border-white/20 glow-border">
                                <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="w-full object-cover" style="max-height: 300px;">
                            </div>
                        @else
                            <div class="rounded-2xl overflow-hidden morphing-shape shadow-2xl border-4 border-white/20 glow-border bg-gradient-to-br from-cyan-400/70 via-blue-500/70 to-teal-600/70 flex items-center justify-center" style="height: 300px;">
                                <i class="fas fa-users fa-5x text-white/80"></i>
                            </div>
                        @endif

                        <!-- Floating badges -->
                        <div class="absolute -bottom-4 -right-4 bg-white/90 backdrop-blur-sm text-blue-700 rounded-full py-2 px-4 shadow-lg">
                            <div class="flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                <span class="font-bold">{{ $community->users->count() }} {{ __('members') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Community Information -->
                <div class="md:w-2/3 text-center md:text-left fade-in-up delay-300 animate-on-scroll">
                    <div class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-2 mb-4">
                        <div class="w-2 h-2 bg-cyan-300 rounded-full mr-2 animate-pulse"></div>
                        <span class="text-cyan-100 font-medium">{{ __('Ocean Community') }}</span>
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-reveal words-reveal">
                        <span class="word">{{ $community->nama_komunitas }}</span>
                    </h1>

                    <p class="text-lg text-cyan-100 mb-6">
                        <i class="fas fa-calendar-alt mr-2"></i> {{ __('Established') }} {{ $community->created_at->format('F d, Y') }}
                    </p>

                    <div class="community-description mb-6 text-lg text-cyan-50/90 max-w-2xl">
                        {!! Str::limit(strip_tags($community->deskripsi), 200) !!}
                        @if(strlen(strip_tags($community->deskripsi)) > 200)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#descriptionModal" class="text-cyan-300 hover:text-white transition-colors font-medium">
                                {{ __('Read more') }} <i class="fas fa-angle-right ml-1"></i>
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-4 justify-center md:justify-start items-center mt-6 text-reveal-delay-2">
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.communities.edit', $community) }}" class="group bg-white/20 hover:bg-white backdrop-blur-sm border border-white/50 text-white hover:text-blue-700 px-6 py-3 rounded-full font-medium transition-all duration-300 flex items-center">
                                    <i class="fas fa-edit mr-2"></i> {{ __('Edit Community') }}
                                </a>
                            @endif

                            @if($isMember)
                                <form action="{{ route('communities.index', $community) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('{{ __('Are you sure you want to leave this community?') }}');" class="group bg-red-500/80 hover:bg-red-600/90 backdrop-blur-sm border border-red-400/50 text-white px-6 py-3 rounded-full font-medium transition-all duration-300 flex items-center">
                                        <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Leave Community') }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('communities.join.show', $community) }}" class="group bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-8 py-3 rounded-full font-bold transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-cyan-500/25 flex items-center">
                                    <i class="fas fa-sign-in-alt mr-2"></i> {{ __('Join Community') }}
                                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            @endif
                        @endauth
                    </div>
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

    <div class="container mx-auto px-4 pb-16 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-8">
                @if(Auth::check() && $isModeratorOrAdmin)
                    <div class="bg-gradient-to-r from-amber-50 to-yellow-100 rounded-2xl p-6 mb-8 border-l-4 border-amber-500 shadow-lg animate-on-scroll slide-in-left">
                        <h5 class="text-xl font-bold text-amber-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            {{ __('Moderator Tools') }}
                        </h5>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('communities.chat', $community) }}" class="group bg-gradient-to-r from-amber-500 to-yellow-600 hover:from-amber-600 hover:to-yellow-700 text-white px-5 py-3 rounded-xl font-medium transition-all duration-300 shadow-md flex items-center">
                                <i class="fas fa-comments mr-2"></i> {{ __('Admin Chat View') }}
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>

                            <a href="{{ route('communities.moderation', $community) }}" class="group bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-5 py-3 rounded-xl font-medium transition-all duration-300 shadow-md flex items-center">
                                <i class="fas fa-gavel mr-2"></i> {{ __('Moderation Dashboard') }}
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif

                @if($isMember || $isModeratorOrAdmin)
                    <!-- Chat Section for Members -->
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden card-hover animate-on-scroll slide-in-left" style="animation-delay: 0.2s">
                        <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white p-6">
                            <div class="flex justify-between items-center">
                                <h5 class="text-2xl font-bold flex items-center">
                                    <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                    {{ __('Community Chat') }}
                                </h5>

                                @if($isChatLocked)
                                    <span class="bg-amber-500 text-white text-sm font-bold px-4 py-2 rounded-full flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                        {{ __('Chat Locked') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-8">
                            <div class="flex items-start mb-8">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-full flex items-center justify-center text-white mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h6 class="text-xl font-bold text-gray-800 mb-2">{{ __('Join the Conversation') }}</h6>
                                    <p class="text-gray-600 mb-6">{{ __('Connect with other ocean enthusiasts in the community chat room. Share discoveries, ask questions, and build connections.') }}</p>

                                    @if($isModeratorOrAdmin)
                                        <div class="space-y-4">
                                            <a href="{{ route('communities.chat', $community) }}" class="group bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white w-full py-4 rounded-xl font-bold transition-all duration-300 shadow-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                </svg>
                                                {{ __('Open Admin Chat Interface') }}
                                                <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </a>

                                            <div class="flex items-center justify-center text-sm text-gray-500">
                                                <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ __('Admin interface includes moderation tools and advanced options') }}
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('communities.chat', $community) }}" class="group bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white w-full py-4 rounded-xl font-bold transition-all duration-300 shadow-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ __('Open Community Chat') }}
                                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Conversation Preview - Can add a live preview of recent messages here -->
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-5 border border-blue-100">
                                <div class="flex justify-between items-center mb-4">
                                    <h6 class="font-semibold text-blue-800">{{ __('Recent Activity') }}</h6>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full">{{ __('Live') }}</span>
                                </div>

                                <div class="space-y-3">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-blue-200 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                                <div class="font-semibold text-sm text-gray-800">{{ __('Ocean Explorer') }}</div>
                                                <p class="text-sm text-gray-600">{{ __('Has anyone seen any interesting marine creatures lately?') }}</p>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">{{ __('Just now') }}</div>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-cyan-200 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <div class="bg-white rounded-lg px-4 py-2 shadow-sm">
                                                <div class="font-semibold text-sm text-gray-800">{{ __('Coral Guardian') }}</div>
                                                <p class="text-sm text-gray-600">{{ __('Join the coral reef cleanup this weekend!') }}</p>
                                            </div>
                                            <div class="text-xs text-gray-500 mt-1">{{ __('5 minutes ago') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Community Resources Section -->
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden mt-8 card-hover animate-on-scroll slide-in-left" style="animation-delay: 0.4s">
                        <div class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white p-6">
                            <h5 class="text-2xl font-bold flex items-center">
                                <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                {{ __('Community Resources') }}
                            </h5>
                        </div>

                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-gradient-to-br from-teal-50 to-green-50 rounded-2xl p-5 border border-teal-100 hover:shadow-lg transition-shadow">
                                    <div class="flex flex-col h-full">
                                        <div class="mb-4">
                                            <div class="w-12 h-12 bg-gradient-to-r from-teal-400 to-emerald-500 rounded-xl flex items-center justify-center text-white">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <h6 class="text-lg font-bold text-gray-800 mb-2">{{ __('Educational Materials') }}</h6>
                                        <p class="text-gray-600 mb-4 flex-grow">{{ __('Access our library of ocean conservation guides, research papers, and educational content.') }}</p>
                                        <a href="#" class="text-teal-600 hover:text-teal-800 font-medium flex items-center">
                                            {{ __('Browse Library') }}
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-5 border border-blue-100 hover:shadow-lg transition-shadow">
                                    <div class="flex flex-col h-full">
                                        <div class="mb-4">
                                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center text-white">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <h6 class="text-lg font-bold text-gray-800 mb-2">{{ __('Upcoming Events') }}</h6>
                                        <p class="text-gray-600 mb-4 flex-grow">{{ __('Find out about community meetups, beach cleanups, and conservation activities.') }}</p>
                                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium flex items-center">
                                            {{ __('View Calendar') }}
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Preview for non-members -->
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden card-hover animate-on-scroll slide-in-left">
                        <div class="p-10 text-center">
                            <div class="mb-6">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto">
                                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-3xl font-bold text-gray-800 mb-4">{{ __('Join this community to participate') }}</h3>
                            <p class="text-xl text-gray-600 mb-8 max-w-lg mx-auto">{{ __('Connect with other ocean enthusiasts, join discussions, and access exclusive community resources.') }}</p>

                            <div class="deep-sea-bubbles absolute inset-0 opacity-20 z-0"></div>

                            @auth
                                <div class="relative z-10">
                                    <a href="{{ route('communities.join.show', $community) }}" class="group bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-10 py-4 rounded-full font-bold transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-cyan-500/25 inline-flex items-center">
                                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                        </svg>
                                        {{ __('Join Now') }}
                                        <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            @else
                                <div class="space-x-4 relative z-10">
                                    <a href="{{ route('login') }}?redirect=community/{{ $community->community_id }}" class="group bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white px-8 py-3 rounded-full font-bold transition-all duration-300 shadow-xl inline-flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                        </svg>
                                        {{ __('Login to join') }}
                                    </a>

                                    <a href="{{ route('register') }}?redirect=community/{{ $community->community_id }}" class="group bg-white text-blue-600 border-2 border-blue-200 hover:border-blue-400 hover:bg-blue-50 px-8 py-3 rounded-full font-bold transition-all duration-300 inline-flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                        </svg>
                                        {{ __('Register') }}
                                    </a>
                                </div>
                            @endauth

                            <!-- Community Benefits Preview -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-5 text-left">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                        </svg>
                                    </div>
                                    <h6 class="font-bold text-gray-800 mb-2">{{ __('Community Chat') }}</h6>
                                    <p class="text-sm text-gray-600">{{ __('Connect with members in real-time discussions about ocean conservation.') }}</p>
                                </div>

                                <div class="bg-gradient-to-br from-teal-50 to-green-50 rounded-xl p-5 text-left">
                                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 mb-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <h6 class="font-bold text-gray-800 mb-2">{{ __('Exclusive Resources') }}</h6>
                                    <p class="text-sm text-gray-600">{{ __('Access to guides, research papers, and educational materials about marine ecosystems.') }}</p>
                                </div>

                                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-5 text-left">
                                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mb-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                    </div>
                                    <h6 class="font-bold text-gray-800 mb-2">{{ __('Events & Activities') }}</h6>
                                    <p class="text-sm text-gray-600">{{ __('Participate in beach cleanups, conservation projects, and educational workshops.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4">
                <!-- Members Section -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden mb-8 card-hover animate-on-scroll slide-in-right">
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-6">
                        <h5 class="text-xl font-bold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            {{ __('Community Members') }}
                            <span class="bg-white text-indigo-700 text-xs font-bold ml-3 px-3 py-1 rounded-full">{{ $community->users->count() }}</span>
                        </h5>
                    </div>

                    <div class="p-6">
                        @foreach($community->users->take(10) as $member)
                            <div class="flex items-center p-3 hover:bg-indigo-50/50 rounded-xl transition-colors mb-2">
                                @if(isset($member->foto_profil))
                                    <img src="{{ asset('storage/' . $member->foto_profil) }}" class="w-12 h-12 rounded-full border-2 border-white shadow-md object-cover" alt="{{ $member->nama }}">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <div class="font-bold text-gray-900">{{ $member->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ __('Joined') }} {{ $member->pivot->tg_gabung->diffForHumans() }}</div>
                                </div>
                            </div>
                        @endforeach

                        @if($community->users->count() > 10)
                            <div class="text-center mt-6">
                                <button type="button" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 font-medium px-6 py-2 rounded-lg transition-colors flex items-center mx-auto" data-bs-toggle="modal" data-bs-target="#allMembersModal">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('View all members') }}
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Community Info Card -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden mb-8 card-hover animate-on-scroll slide-in-right" style="animation-delay: 0.2s">
                    <div class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white p-6">
                        <h5 class="text-xl font-bold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ __('Community Info') }}
                        </h5>
                    </div>

                    <div class="p-6">
                        <ul class="space-y-4">
                            <li class="flex items-center">
                                <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">{{ __('Created') }}</div>
                                    <div class="font-bold text-gray-900">{{ $community->created_at->format('F d, Y') }}</div>
                                </div>
                            </li>

                            <li class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">{{ __('Messages') }}</div>
                                    <div class="font-bold text-gray-900">{{ $community->messages->count() }}</div>
                                </div>
                            </li>

                            <li class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                                                <div>
                                    <div class="text-sm text-gray-500">{{ __('Active Members') }}</div>
                                    <div class="font-bold text-gray-900">{{ $community->users->where('pivot.is_active', 1)->count() }}</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Community Actions -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden mb-8 card-hover animate-on-scroll slide-in-right" style="animation-delay: 0.4s">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-6">
                        <h5 class="text-xl font-bold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            {{ __('Community Actions') }}
                        </h5>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            <a href="#" class="bg-gradient-to-r from-purple-50 to-indigo-50 hover:from-purple-100 hover:to-indigo-100 flex items-center p-4 rounded-xl transition-colors">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ __('Report Issue') }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Report problems in the community') }}</div>
                                </div>
                            </a>

                            <a href="#" class="bg-gradient-to-r from-indigo-50 to-purple-50 hover:from-indigo-100 hover:to-purple-100 flex items-center p-4 rounded-xl transition-colors">
                                <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ __('Share Community') }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Invite others to join our ocean community') }}</div>
                                </div>
                            </a>

                            <a href="#" class="bg-gradient-to-r from-amber-50 to-orange-50 hover:from-amber-100 hover:to-orange-100 flex items-center p-4 rounded-xl transition-colors">
                                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">{{ __('Community Guidelines') }}</div>
                                    <div class="text-sm text-gray-600">{{ __('Read our community rules and policies') }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Community Events -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden mt-8 card-hover animate-on-scroll slide-in-right" style="animation-delay: 0.6s">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-600 text-white p-6">
                        <h5 class="text-xl font-bold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('Upcoming Events') }}
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Event 1 -->
                            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-100">
                                <div class="flex items-start">
                                    <div class="bg-gradient-to-br from-amber-500 to-orange-600 text-white rounded-xl w-16 h-16 flex flex-col items-center justify-center mr-4 flex-shrink-0">
                                        <span class="text-xl font-bold">15</span>
                                        <span class="text-xs">June</span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="font-bold text-gray-900 mb-1">{{ __('Beach Cleanup Day') }}</h6>
                                        <p class="text-sm text-gray-600 mb-2">{{ __('Join us for our monthly beach cleanup at Coastal Bay Beach.') }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-amber-700 bg-amber-100 px-2 py-1 rounded-full">9:00 AM - 1:00 PM</span>
                                            <a href="#" class="text-amber-600 hover:text-amber-800 text-sm font-medium flex items-center">
                                                {{ __('Details') }}
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Event 2 -->
                            <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-100">
                                <div class="flex items-start">
                                    <div class="bg-gradient-to-br from-amber-500 to-orange-600 text-white rounded-xl w-16 h-16 flex flex-col items-center justify-center mr-4 flex-shrink-0">
                                        <span class="text-xl font-bold">22</span>
                                        <span class="text-xs">June</span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="font-bold text-gray-900 mb-1">{{ __('Marine Conservation Workshop') }}</h6>
                                        <p class="text-sm text-gray-600 mb-2">{{ __('Learn about coral reef restoration techniques and practices.') }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-amber-700 bg-amber-100 px-2 py-1 rounded-full">3:00 PM - 5:00 PM</span>
                                            <a href="#" class="text-amber-600 hover:text-amber-800 text-sm font-medium flex items-center">
                                                {{ __('Details') }}
                                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center pt-2">
                                <a href="#" class="inline-flex items-center text-amber-600 hover:text-amber-800 font-medium">
                                    {{ __('View All Events') }}
                                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Ocean Articles -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-white/30 overflow-hidden mt-8 card-hover animate-on-scroll slide-in-right" style="animation-delay: 0.8s">
                    <div class="bg-gradient-to-r from-cyan-600 to-blue-600 text-white p-6">
                        <h5 class="text-xl font-bold flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            {{ __('Related Ocean Articles') }}
                        </h5>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Article Preview 1 -->
                            <div class="flex items-center p-3 hover:bg-blue-50/50 rounded-xl transition-colors">
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-cyan-100 to-blue-200 flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2 1M4 7l2-1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-bold text-gray-900 mb-1">{{ __('Understanding Coral Bleaching') }}</h6>
                                    <p class="text-sm text-gray-600">{{ __('Learn about the causes and effects of coral bleaching on marine ecosystems.') }}</p>
                                </div>
                            </div>

                            <!-- Article Preview 2 -->
                            <div class="flex items-center p-3 hover:bg-blue-50/50 rounded-xl transition-colors">
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-cyan-100 to-blue-200 flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-bold text-gray-900 mb-1">{{ __('Marine Protected Areas') }}</h6>
                                    <p class="text-sm text-gray-600">{{ __('How marine sanctuaries are helping ocean ecosystems recover and thrive.') }}</p>
                                </div>
                            </div>

                            <!-- Article Preview 3 -->
                            <div class="flex items-center p-3 hover:bg-blue-50/50 rounded-xl transition-colors">
                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-cyan-100 to-blue-200 flex items-center justify-center flex-shrink-0 mr-4">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h6 class="font-bold text-gray-900 mb-1">{{ __('Ocean Plastic Solutions') }}</h6>
                                    <p class="text-sm text-gray-600">{{ __('Innovative approaches to tackling the plastic pollution crisis in our oceans.') }}</p>
                                </div>
                            </div>

                            <div class="text-center pt-2">
                                <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                    {{ __('Browse More Articles') }}
                                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Full Community Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white/95 backdrop-blur-xl rounded-3xl border border-white/50 shadow-2xl">
            <div class="modal-header border-b-0 bg-gradient-to-r from-cyan-600 to-blue-600 text-white rounded-t-3xl">
                <h5 class="modal-title text-xl font-bold" id="descriptionModalLabel">{{ $community->nama_komunitas }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-6">
                <div class="prose prose-blue max-w-none">
                    {!! $community->deskripsi !!}
                </div>
            </div>
            <div class="modal-footer border-t-0 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-b-3xl">
                <button type="button" class="bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-700 font-medium px-5 py-2 rounded-xl" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- All Members Modal -->
<div class="modal fade" id="allMembersModal" tabindex="-1" aria-labelledby="allMembersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white/95 backdrop-blur-xl rounded-3xl border border-white/50 shadow-2xl">
            <div class="modal-header border-b-0 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-t-3xl">
                <h5 class="modal-title text-xl font-bold" id="allMembersModalLabel">
                    <i class="fas fa-users me-2"></i> {{ __('All Members') }} - {{ $community->nama_komunitas }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($community->users as $member)
                        <div class="flex items-center bg-gradient-to-br from-indigo-50 to-purple-50 p-3 rounded-xl">
                            @if(isset($member->foto_profil))
                                <img src="{{ asset('storage/' . $member->foto_profil) }}" class="w-12 h-12 rounded-full border-2 border-white shadow-md object-cover" alt="{{ $member->nama }}">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="ml-4">
                                <div class="font-bold text-gray-900 truncate max-w-[120px]">{{ $member->nama }}</div>
                                <div class="text-xs text-gray-500">{{ __('Joined') }} {{ $member->pivot->tg_gabung->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($community->users->count() > 15)
                    <div class="mt-6 text-center">
                        <button class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white px-6 py-2 rounded-xl font-medium">
                            {{ __('Load More') }}
                        </button>
                    </div>
                @endif
            </div>
            <div class="modal-footer border-t-0 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-b-3xl">
                <button type="button" class="bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-700 font-medium px-5 py-2 rounded-xl" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
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

    /* Words Reveal Animation */
    .words-reveal .word {
        display: inline-block !important;
        opacity: 0 !important;
        transform: translateY(40px) !important;
        animation: wordReveal 0.8s forwards !important;
    }

    @keyframes wordReveal {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Fade in up animation */
    .fade-in-up {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1s ease-out forwards;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Background Scroll Animation */
    .bg-scroll-right {
        animation: scrollRight 60s linear infinite;
        background-size: 200% 100%;
    }

    @keyframes scrollRight {
        0% { background-position: 0% center; }
        100% { background-position: -200% center; }
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

    /* Bubble animation for deep sea effect */
    .animate-bubble {
        position: absolute;
        border-radius: 50%;
        animation: bubbleRise linear forwards;
    }

    @keyframes bubbleRise {
        0% {
            transform: translateY(0) scale(1);
            opacity: 0.1;
        }
        50% {
            opacity: 0.3;
        }
        100% {
            transform: translateY(-100vh) scale(1.5);
            opacity: 0;
        }
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

        // Automatically dismiss alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('[data-bs-dismiss="alert"]').forEach(el => {
                el.click();
            });
        }, 5000);

        // Helper function to create bubble animations for deep sea effect
        function createDeepSeaBubbles() {
            const bubbleContainer = document.querySelector('.deep-sea-bubbles');
            if (!bubbleContainer) return;

            for (let i = 0; i < 10; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'absolute rounded-full bg-white/10 animate-bubble';
                bubble.style.width = `${Math.random() * 20 + 5}px`;
                bubble.style.height = bubble.style.width;
                bubble.style.left = `${Math.random() * 100}%`;
                bubble.style.bottom = `-${Math.random() * 20 + 10}px`;
                bubble.style.animationDuration = `${Math.random() * 5 + 3}s`;
                bubbleContainer.appendChild(bubble);
            }
        }

        // Create some dynamic bubbles
        createDeepSeaBubbles();

        // Word-by-word entrance animation
        document.querySelectorAll('.words-reveal .word').forEach((word, index) => {
            word.style.animationDelay = `${0.2 * index}s`;
        });
    });
</script>
@endsection
