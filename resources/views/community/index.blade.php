@extends('layouts.app')

@section('title', 'Ocean Communities')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-100 to-teal-50 relative overflow-hidden">
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
    </div>

    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-teal-700 text-white overflow-hidden py-16">
        <div class="absolute inset-0 z-0">
            <div class="bg-scroll-right absolute inset-0 bg-cover bg-no-repeat opacity-20" style="background-image: url('{{ asset('images/ocean-bg.jpg') }}');"></div>
            <div class="floating-particles absolute inset-0"></div>
            <div class="wave-pattern absolute bottom-0 left-0 w-full h-20 opacity-30"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4 flex items-center">
                        <i class="fas fa-users mr-4 text-cyan-300"></i>
                        <span class="text-reveal">Ocean Communities</span>
                    </h1>
                    <p class="text-lg text-cyan-100 max-w-2xl text-reveal-delay-1">
                        Connect with ocean enthusiasts, marine conservationists, and passionate communities dedicated to preserving our oceans.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-6 justify-center lg:justify-start">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 stat-counter" data-target="{{ $stats['total_communities'] }}">
                            <div class="text-2xl font-bold counter">0</div>
                            <div class="text-xs text-cyan-200">Communities</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 stat-counter" data-target="{{ $stats['total_members'] }}">
                            <div class="text-2xl font-bold counter">0</div>
                            <div class="text-xs text-cyan-200">Members</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 stat-counter" data-target="{{ $stats['active_today'] }}">
                            <div class="text-2xl font-bold counter">0</div>
                            <div class="text-xs text-cyan-200">Active Today</div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.communities.index') }}" class="btn-ocean-secondary">
                                <i class="fas fa-cog me-1"></i> {{ __('Manage Communities') }}
                            </a>
                        @endif
                        <a href="#create-community" data-bs-toggle="modal" data-bs-target="#createCommunityModal" class="btn-ocean-primary">
                            <i class="fas fa-plus me-1"></i> {{ __('Create Community') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-ocean-secondary">
                            <i class="fas fa-sign-in-alt me-1"></i> {{ __('Login to Create') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="max-w-6xl mx-auto mb-10 animate-on-scroll">
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl border border-blue-100 p-6">
                <form action="{{ route('communities.index') }}" method="GET" class="space-y-4" id="filterForm">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="flex-grow relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-blue-500"></i>
                            </div>
                            <input type="text" class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   name="search" placeholder="{{ __('Search ocean communities...') }}" value="{{ request('search') }}"
                                   id="searchInput">
                        </div>

                        <div class="relative">
                            <select name="sort" class="appearance-none bg-white border-2 border-blue-200 rounded-xl px-4 py-3 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    onchange="document.getElementById('filterForm').submit()">
                                <option value="users_count" {{ request('sort') == 'users_count' ? 'selected' : '' }}>{{ __('Most Members') }}</option>
                                <option value="activity" {{ request('sort') == 'activity' ? 'selected' : '' }}>{{ __('Most Active') }}</option>
                                <option value="created" {{ request('sort') == 'created' ? 'selected' : '' }}>{{ __('Newest') }}</option>
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>{{ __('Name A-Z') }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-blue-500"></i>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button type="button" onclick="changeView('grid')"
                                    class="p-3 rounded-xl border-2 border-blue-200 hover:bg-blue-50 view-btn active"
                                    data-view="grid">
                                <i class="fas fa-th-large text-blue-500"></i>
                            </button>
                            <button type="button" onclick="changeView('list')"
                                    class="p-3 rounded-xl border-2 border-blue-200 hover:bg-blue-50 view-btn"
                                    data-view="list">
                                <i class="fas fa-list text-blue-500"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <button type="button" class="quick-filter-btn active" data-filter="all">
                            <i class="fas fa-globe mr-2"></i>{{ __('All Communities') }}
                        </button>
                        <button type="button" class="quick-filter-btn" data-filter="trending">
                            <i class="fas fa-fire mr-2"></i>{{ __('Trending') }}
                        </button>
                        <button type="button" class="quick-filter-btn" data-filter="new">
                            <i class="fas fa-star mr-2"></i>{{ __('New') }}
                        </button>
                        @auth
                            <button type="button" class="quick-filter-btn" data-filter="joined">
                                <i class="fas fa-user-check mr-2"></i>{{ __('My Communities') }}
                            </button>
                        @endauth
                    </div>

                    <input type="hidden" name="order" value="{{ request('order', 'desc') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 12) }}">
                </form>
            </div>
        </div>

        @if($trendingCommunities->count() > 0 || $newestCommunities->count() > 0)
        <div class="max-w-6xl mx-auto mb-10 animate-on-scroll">
            <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl border border-blue-100 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ __('Discover Communities') }}</h3>
                    <div class="flex gap-2">
                        <button class="carousel-nav-btn" onclick="showCarousel('trending')" id="trendingBtn">
                            <i class="fas fa-fire mr-1"></i>{{ __('Trending') }}
                        </button>
                        <button class="carousel-nav-btn" onclick="showCarousel('newest')" id="newestBtn">
                            <i class="fas fa-star mr-1"></i>{{ __('Newest') }}
                        </button>
                    </div>
                </div>

                <div id="trendingCarousel" class="carousel-content">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($trendingCommunities as $community)
                            <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-xl p-4 border border-orange-200">
                                <div class="flex items-center gap-3">
                                    @if($community->gambar)
                                        <img src="{{ asset('storage/' . $community->gambar) }}" class="w-12 h-12 rounded-full object-cover" alt="{{ $community->nama_komunitas }}">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-users text-white"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800 truncate">{{ $community->nama_komunitas }}</h4>
                                        <p class="text-sm text-gray-600">{{ $community->users_count }} members</p>
                                    </div>
                                    <div class="text-orange-500">
                                        <i class="fas fa-fire"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="newestCarousel" class="carousel-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($newestCommunities as $community)
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4 border border-green-200">
                                <div class="flex items-center gap-3">
                                    @if($community->gambar)
                                        <img src="{{ asset('storage/' . $community->gambar) }}" class="w-12 h-12 rounded-full object-cover" alt="{{ $community->nama_komunitas }}">
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full flex items-center justify-center">
                                            <i class="fas fa-users text-white"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-800 truncate">{{ $community->nama_komunitas }}</h4>
                                        <p class="text-sm text-gray-600">{{ $community->users_count }} members</p>
                                    </div>
                                    <div class="text-green-500">
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div id="communitiesContainer">
            <div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @forelse($communities as $community)
                    <div class="community-card bg-white/80 backdrop-blur-sm rounded-3xl overflow-hidden shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll card-hover perspective-container"
                         data-members="{{ $community->users_count ?? $community->users->count() }}"
                         data-created="{{ $community->created_at->format('Y-m-d') }}"
                         data-name="{{ strtolower($community->nama_komunitas) }}"
                         data-joined="{{ Auth::check() && $community->users->contains('user_id', Auth::id()) ? 'true' : 'false' }}">

                        <div class="relative h-48 overflow-hidden">
                            @if($community->gambar)
                                <img src="{{ asset('storage/' . $community->gambar) }}" class="w-full h-full object-cover shine-effect" alt="{{ $community->nama_komunitas }}">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-400 via-blue-500 to-teal-500 flex items-center justify-center shine-effect">
                                    <i class="fas fa-users text-5xl text-white/70"></i>
                                </div>
                            @endif

                            <div class="absolute top-4 right-4">
                                <div class="bg-blue-500/90 backdrop-blur-sm text-white rounded-full px-3 py-1 shadow-lg flex items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>{{ $community->users_count ?? $community->users->count() }}</span>
                                </div>
                            </div>

                            @if($community->messages_count ?? 0 > 0)
                            <div class="absolute top-4 left-4">
                                <div class="bg-green-500/90 backdrop-blur-sm text-white rounded-full px-2 py-1 shadow-lg flex items-center">
                                    <div class="w-2 h-2 bg-green-300 rounded-full animate-pulse mr-1"></div>
                                    <span class="text-xs">Active</span>
                                </div>
                            </div>
                            @endif

                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4 text-white">
                                <h2 class="text-xl font-bold truncate">{{ $community->nama_komunitas }}</h2>
                                <div class="flex items-center text-xs text-white/80">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ __('Created') }} {{ $community->created_at->format('M d, Y') }}
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <p class="text-gray-600 mb-6 line-clamp-3">
                                {{ Str::limit(strip_tags($community->deskripsi), 150) }}
                            </p>

                            <div class="flex items-center justify-between mt-auto">
                                <a href="{{ route('communities.show', $community) }}" class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-4 py-2 rounded-xl font-medium shadow-md hover:shadow-lg transition-all duration-300 flex items-center">
                                    <i class="fas fa-eye mr-2"></i> {{ __('View') }}
                                </a>

                                <div class="flex items-center gap-2">
                                    @auth
                                        @if($community->users->contains('user_id', Auth::id()))
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-xl text-sm flex items-center">
                                                <i class="fas fa-check-circle mr-1"></i> {{ __('Member') }}
                                            </span>
                                        @endif

                                        @if(Auth::user()->isAdmin() || ($community->created_by === Auth::id()))
                                            <a href="{{ Auth::user()->isAdmin() ? route('admin.communities.edit', $community) : '#' }}"
                                               class="bg-amber-100 text-amber-700 hover:bg-amber-200 p-2 rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-white/50 text-center">
                            <div class="w-20 h-20 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-search text-3xl"></i>
                            </div>
                            @if(request('search'))
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ __('No communities found matching your search.') }}</h3>
                                <p class="text-gray-600">Try adjusting your search terms or browse all communities.</p>
                                <a href="{{ route('communities.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">
                                    <i class="fas fa-arrow-left mr-1"></i> {{ __('View all communities') }}
                                </a>
                            @else
                                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ __('No communities available yet.') }}</h3>
                                <p class="text-gray-600">Be the first to create an ocean community!</p>
                                @auth
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#createCommunityModal"
                                            class="mt-4 bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-300">
                                        <i class="fas fa-plus mr-2"></i> {{ __('Create Community') }}
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="mt-4 inline-block bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-300">
                                        <i class="fas fa-sign-in-alt mr-2"></i> {{ __('Login to Create') }}
                                    </a>
                                @endauth
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <div id="listView" class="space-y-4 mb-12 hidden">
                @foreach($communities as $community)
                    <div class="community-card bg-white/90 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/50 hover:shadow-xl transition-all duration-300"
                         data-members="{{ $community->users_count ?? $community->users->count() }}"
                         data-created="{{ $community->created_at->format('Y-m-d') }}"
                         data-name="{{ strtolower($community->nama_komunitas) }}"
                         data-joined="{{ Auth::check() && $community->users->contains('user_id', Auth::id()) ? 'true' : 'false' }}">

                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden flex-shrink-0">
                                @if($community->gambar)
                                    <img src="{{ asset('storage/' . $community->gambar) }}" class="w-full h-full object-cover" alt="{{ $community->nama_komunitas }}">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-teal-500 flex items-center justify-center">
                                        <i class="fas fa-users text-2xl text-white"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-1">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $community->nama_komunitas }}</h3>
                                        <p class="text-gray-600 mb-3 line-clamp-2">{{ Str::limit(strip_tags($community->deskripsi), 200) }}</p>
                                        <div class="flex items-center gap-4 text-sm text-gray-500">
                                            <span class="flex items-center">
                                                <i class="fas fa-users mr-1"></i>
                                                {{ $community->users_count ?? $community->users->count() }} {{ __('members') }}
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                {{ $community->created_at->format('M d, Y') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        @auth
                                            @if($community->users->contains('user_id', Auth::id()))
                                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-xl text-sm">
                                                    <i class="fas fa-check-circle mr-1"></i> {{ __('Member') }}
                                                </span>
                                            @endif
                                        @endauth

                                        <a href="{{ route('communities.show', $community) }}" class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white px-4 py-2 rounded-xl font-medium">
                                            {{ __('View') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($communities->hasPages())
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-2">
                <span class="text-gray-600">{{ __('Show') }}:</span>
                <select onchange="changePageSize(this.value)" class="border border-gray-300 rounded-lg px-3 py-1">
                    <option value="6" {{ request('per_page') == 6 ? 'selected' : '' }}>6</option>
                    <option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12</option>
                    <option value="24" {{ request('per_page') == 24 ? 'selected' : '' }}>24</option>
                    <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48</option>
                </select>
                <span class="text-gray-600">{{ __('per page') }}</span>
            </div>

            <div class="flex-1 flex justify-center">
                {{ $communities->appends(request()->query())->links() }}
            </div>

            <div class="text-gray-600 text-sm">
                {{ __('Showing') }} {{ $communities->firstItem() ?? 0 }} {{ __('to') }} {{ $communities->lastItem() ?? 0 }} {{ __('of') }} {{ $communities->total() }} {{ __('results') }}
            </div>
        </div>
        @endif

        @if($communities->count() > 0)
            <div class="max-w-6xl mx-auto py-12">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ __('Join the Ocean Movement') }}</h2>
                    <p class="text-gray-600">Connect with communities making a difference for our oceans</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-3xl p-6 shadow-lg border border-blue-100 feature-card">
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-4">
                            <i class="fas fa-hand-holding-water text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Conservation Efforts</h3>
                        <p class="text-gray-600">Join communities focused on marine conservation projects and initiatives.</p>
                        <div class="mt-4 text-blue-600 font-semibold">{{ $stats['total_communities'] }}+ Communities</div>
                    </div>

                    <div class="bg-gradient-to-r from-cyan-50 to-teal-50 rounded-3xl p-6 shadow-lg border border-cyan-100 feature-card">
                        <div class="w-14 h-14 bg-cyan-100 rounded-2xl flex items-center justify-center text-cyan-600 mb-4">
                            <i class="fas fa-microscope text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Research & Education</h3>
                        <p class="text-gray-600">Discover communities sharing cutting-edge marine research and educational resources.</p>
                        <div class="mt-4 text-cyan-600 font-semibold">{{ $stats['total_members'] }}+ Members</div>
                    </div>

                    <div class="bg-gradient-to-r from-teal-50 to-green-50 rounded-3xl p-6 shadow-lg border border-teal-100 feature-card">
                        <div class="w-14 h-14 bg-teal-100 rounded-2xl flex items-center justify-center text-teal-600 mb-4">
                            <i class="fas fa-seedling text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Sustainability Initiatives</h3>
                        <p class="text-gray-600">Explore communities advancing sustainable practices for ocean health.</p>
                        <div class="mt-4 text-teal-600 font-semibold">{{ $stats['active_today'] }} Active Today</div>
                    </div>
                </div>
            </div>
        @endif
    </div>

   
    @auth
    <div class="modal fade" id="createCommunityModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-blue-100 overflow-hidden">
                <div class="modal-header bg-gradient-to-r from-blue-500 to-teal-500 text-white p-5">
                    <h5 class="modal-title text-xl font-bold">{{ __('Create New Ocean Community') }}</h5>
                    <button type="button" class="btn-close bg-white/20 hover:bg-white/40 rounded-full w-8 h-8 flex items-center justify-center" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body p-6">
                    <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <label for="nama_komunitas" class="block text-gray-700 font-medium mb-2">{{ __('Community Name') }} *</label>
                            <input type="text" id="nama_komunitas" name="nama_komunitas"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-blue-100 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                   required>
                        </div>

                        <div class="mb-6">
                            <label for="deskripsi" class="block text-gray-700 font-medium mb-2">{{ __('Description') }} *</label>
                            <textarea id="deskripsi" name="deskripsi" rows="5"
                                      class="w-full px-4 py-3 rounded-xl border-2 border-blue-100 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                      required></textarea>
                        </div>

                        <div class="mb-6">
                            <label for="gambar" class="block text-gray-700 font-medium mb-2">{{ __('Community Image') }}</label>
                            <div class="relative border-2 border-dashed border-blue-300 rounded-xl p-6 bg-blue-50">
                                <input type="file" id="gambar" name="gambar" accept="image/*"
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-blue-500 text-3xl mb-2"></i>
                                    <p class="text-blue-700">{{ __('Click or drag and drop to upload an image') }}</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 border-t border-gray-100">
                            <button type="button" class="mr-4 px-6 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl font-medium transition-colors" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white rounded-xl font-medium shadow-md hover:shadow-lg transition-all">
                                <i class="fas fa-plus mr-2"></i> {{ __('Create Community') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    <div class="absolute bottom-0 left-0 w-full z-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
            <path fill="#0099ff" fill-opacity="0.2" d="M0,224L48,213.3C96,203,192,181,288,186.7C384,192,480,224,576,218.7C672,213,768,171,864,165.3C960,160,1056,192,1152,197.3C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</div>
@endsection

@section('styles')
<style>

    .stat-counter {
        animation: slideInUp 0.8s ease-out forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    .stat-counter:nth-child(1) { animation-delay: 0.2s; }
    .stat-counter:nth-child(2) { animation-delay: 0.4s; }
    .stat-counter:nth-child(3) { animation-delay: 0.6s; }

    .quick-filter-btn {
        @apply px-4 py-2 bg-white/80 hover:bg-blue-50 border border-blue-200 rounded-xl text-sm font-medium transition-all duration-300 flex items-center;
    }

    .quick-filter-btn.active {
        @apply bg-blue-500 text-white border-blue-500;
    }

    .carousel-nav-btn {
        @apply px-4 py-2 bg-gray-100 hover:bg-blue-100 rounded-xl text-sm font-medium transition-all duration-300 flex items-center;
    }

    .carousel-nav-btn.active {
        @apply bg-blue-500 text-white;
    }

    .carousel-content {
        transition: all 0.3s ease-in-out;
    }

    .view-btn.active {
        @apply bg-blue-500 text-white border-blue-500;
    }

    .feature-card {
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 150, 0.1);
    }

    @keyframes slideInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes countUp {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .ocean-waves {
        background: linear-gradient(90deg,
            transparent,
            rgba(56, 189, 248, 0.15) 25%,
            rgba(6, 182, 212, 0.15) 50%,
            rgba(20, 184, 166, 0.15) 75%,
            transparent
        );
        background-size: 200% 100%;
        animation: oceanFlow 15s ease-in-out infinite;
    }

    .floating-particles {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(56, 189, 248, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 40% 40%, rgba(20, 184, 166, 0.15) 2px, transparent 2px);
        background-size: 100px 100px, 150px 150px, 200px 200px;
        animation: floatParticles 30s linear infinite;
    }

    .ocean-bubbles {
        background-image:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, 0.8) 0.5px, transparent 0.5px),
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.7) 1px, transparent 1px),
            radial-gradient(circle at 30% 80%, rgba(255, 255, 255, 0.6) 0.8px, transparent 0.8px),
            radial-gradient(circle at 70% 40%, rgba(255, 255, 255, 0.7) 1.2px, transparent 1.2px);
        background-size: 100px 100px;
        animation: bubbleRise 25s linear infinite;
    }

    .wave-pattern {
        background-image:
            linear-gradient(135deg, transparent 45%, rgba(255, 255, 255, 0.1) 45%, rgba(255, 255, 255, 0.1) 55%, transparent 55%);
        background-size: 20px 20px;
        animation: waveMove 10s linear infinite;
    }

    .bg-grid-pattern {
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .perspective-container {
        perspective: 1000px;
        transform-style: preserve-3d;
    }

    .card-hover {
        transition: all 0.5s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .card-hover:hover {
        box-shadow: 0 15px 30px rgba(0, 0, 150, 0.1);
    }

    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 50%;
        height: 100%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 100%
        );
        transform: skewX(-25deg);
        animation: shine 2.5s infinite;
    }

    .text-reveal {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 0.8s ease-out forwards;
    }

    .text-reveal-delay-1 {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 0.8s ease-out 0.3s forwards;
    }

    .btn-ocean-primary {
        @apply bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-6 py-3 rounded-full font-bold hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-xl transform hover:-translate-y-1 hover:shadow-cyan-500/25 flex items-center;
    }

    .btn-ocean-secondary {
        @apply bg-white/20 hover:bg-white/30 backdrop-blur-sm border border-white/30 text-white px-6 py-3 rounded-full font-medium transition-all duration-300 flex items-center;
    }

    @keyframes oceanFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes floatParticles {
        0% { background-position: 0 0, 0 0, 0 0; }
        100% { background-position: 100px 100px, -150px 150px, 200px -200px; }
    }

    @keyframes bubbleRise {
        0% { background-position: 0 100%; }
        100% { background-position: 100px 0; }
    }

    @keyframes waveMove {
        0% { background-position: 0 0; }
        100% { background-position: 40px 0; }
    }

    @keyframes textReveal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes shine {
        0% {
            left: -100%;
        }
        20% {
            left: 100%;
        }
        100% {
            left: 100%;
        }
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    .bg-scroll-right {
        animation: scrollRight 60s linear infinite;
        background-size: 200% 100%;
    }

    @keyframes scrollRight {
        0% { background-position: 0% center; }
        100% { background-position: -200% center; }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function animateCounter(element, target) {
            let current = 0;
            const increment = target / 100;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current);
            }, 20);
        }

        const counters = document.querySelectorAll('.stat-counter .counter');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.closest('.stat-counter').dataset.target);
                    animateCounter(entry.target, target);
                    observer.unobserve(entry.target);
                }
            });
        });

        counters.forEach(counter => observer.observe(counter));

        const fileInput = document.getElementById('gambar');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                if (fileName) {
                    const parent = this.closest('.border-dashed');
                    const icon = parent.querySelector('.fa-cloud-upload-alt');
                    const text = parent.querySelector('p:not(.text-xs)');

                    icon.classList.remove('fa-cloud-upload-alt');
                    icon.classList.add('fa-check-circle');
                    text.textContent = `Selected: ${fileName}`;
                }
            });
        }

        const searchInput = document.getElementById('searchInput');
        let searchTimeout;

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterCommunities();
                }, 300);
            });
        }

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    scrollObserver.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            scrollObserver.observe(el);
        });
    });

    function changeView(viewType) {
        const gridView = document.getElementById('gridView');
        const listView = document.getElementById('listView');
        const viewBtns = document.querySelectorAll('.view-btn');

        viewBtns.forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.view === viewType) {
                btn.classList.add('active');
            }
        });

        if (viewType === 'grid') {
            gridView.classList.remove('hidden');
            listView.classList.add('hidden');
        } else {
            gridView.classList.add('hidden');
            listView.classList.remove('hidden');
        }

        localStorage.setItem('communityView', viewType);
    }

    const savedView = localStorage.getItem('communityView') || 'grid';
    changeView(savedView);

    document.querySelectorAll('.quick-filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.quick-filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            filterCommunities(filter);
        });
    });

    function filterCommunities(quickFilter = null) {
        const searchTerm = document.getElementById('searchInput')?.value.toLowerCase() || '';
        const communityCards = document.querySelectorAll('.community-card');

        communityCards.forEach(card => {
            let show = true;

            if (searchTerm) {
                const name = card.dataset.name;
                show = name.includes(searchTerm);
            }

            if (quickFilter && show) {
                switch (quickFilter) {
                    case 'trending':
                        show = parseInt(card.dataset.members) > 5;
                        break;
                    case 'new':
                        const created = new Date(card.dataset.created);
                        const thirtyDaysAgo = new Date();
                        thirtyDaysAgo.setDate(thirtyDaysAgo.getDate() - 30);
                        show = created > thirtyDaysAgo;
                        break;
                    case 'joined':
                        show = card.dataset.joined === 'true';
                        break;
                    default:
                        show = true;
                }
            }

            if (show) {
                card.style.display = '';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 10);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
    }

    function showCarousel(type) {
        const trendingCarousel = document.getElementById('trendingCarousel');
        const newestCarousel = document.getElementById('newestCarousel');
        const trendingBtn = document.getElementById('trendingBtn');
        const newestBtn = document.getElementById('newestBtn');

        trendingBtn.classList.remove('active');
        newestBtn.classList.remove('active');

        if (type === 'trending') {
            trendingCarousel.classList.remove('hidden');
            newestCarousel.classList.add('hidden');
            trendingBtn.classList.add('active');
        } else {
            trendingCarousel.classList.add('hidden');
            newestCarousel.classList.remove('hidden');
            newestBtn.classList.add('active');
        }
    }

    showCarousel('trending');

    function changePageSize(perPage) {
        const url = new URL(window.location);
        url.searchParams.set('per_page', perPage);
        url.searchParams.delete('page'); 
        window.location.href = url.toString();
    }
</script>
@endsection
