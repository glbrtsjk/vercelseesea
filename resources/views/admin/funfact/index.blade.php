<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\funfacts\index.blade.php -->
@extends('layouts.app')

@section('title', __('Funfacts') . (request()->filled('keyword') ? ' - ' . request('keyword') : ''))

@section('content')
<!-- Header Section -->
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-10 px-4">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ __('Funfacts') }}</h1>
                <p class="text-lg opacity-80">{{ __('Discover interesting facts about the world around us') }}</p>
            </div>

            @if(auth()->check() && auth()->user()->is_admin)
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('funfacts.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ __('Create New Funfact') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <!-- Alerts -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Advanced Search and Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <form action="{{ route('funfacts.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Keyword Search -->
                <div>
                    <label for="keyword" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Search Funfacts') }}</label>
                    <input type="text" name="keyword" id="keyword" value="{{ request('keyword') }}" placeholder="{{ __('Enter keywords...') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Category Filter -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Filter by Category') }}</label>
                    <select name="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Article Filter -->
                <div>
                    <label for="article" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Filter by Article') }}</label>
                    <select name="article" id="article" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                        <option value="">{{ __('All Articles') }}</option>
                        @foreach($relatedArticles as $article)
                            <option value="{{ $article->article_id }}" {{ request('article') == $article->article_id ? 'selected' : '' }}>
                                {{ Str::limit($article->judul, 50) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-between items-center pt-2">
                @if(request()->anyFilled(['keyword', 'category', 'article']))
                    <a href="{{ route('funfacts.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        {{ __('Clear all filters') }}
                    </a>
                @else
                    <div></div>
                @endif

                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    {{ __('Search') }}
                </button>
            </div>
        </form>
    </div>

    <!-- Search Results Header -->
    @if(request('keyword') || request('category') || request('article'))
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ __('Search Results') }}

                @if(request('keyword'))
                    <span class="font-normal">"{{ request('keyword') }}"</span>
                @endif

                @if(request('category'))
                    @php
                        $categoryName = $categories->where('category_id', request('category'))->first()->nama_kategori ?? '';
                    @endphp
                    <span class="font-normal">{{ __('in category') }} "{{ $categoryName }}"</span>
                @endif

                @if(request('article'))
                    @php
                        $articleTitle = $relatedArticles->where('article_id', request('article'))->first()->judul ?? '';
                    @endphp
                    <span class="font-normal">{{ __('for article') }} "{{ Str::limit($articleTitle, 30) }}"</span>
                @endif
            </h2>
            <p class="text-gray-600">{{ $funfacts->total() }} {{ $funfacts->total() == 1 ? __('result found') : __('results found') }}</p>
        </div>
    @else
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            @if($funfacts->isEmpty())
                {{ __('No Funfacts Available') }}
            @else
                {{ __('Discover Random Funfacts') }}
            @endif
        </h2>
    @endif

    <!-- Funfacts Grid -->
    @if($funfacts->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            @foreach($funfacts as $funfact)
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 flex flex-col h-full">
                    <!-- Image Section -->
                    @if($funfact->gambar)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">

                            @if($funfact->is_highlighted)
                                <div class="absolute top-0 right-0 bg-yellow-500 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                                    {{ __('Highlighted') }}
                                </div>
                            @endif

                            <!-- Admin-only actions for image overlay -->
                            @if(auth()->check() && auth()->user()->is_admin)
                                <div class="absolute top-2 left-2 flex space-x-2">
                                    <form action="{{ route('funfacts.toggle-highlight', $funfact) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-gray-800 bg-opacity-70 hover:bg-opacity-100 text-white p-2 rounded-full transition-all">
                                            <svg class="w-4 h-4" fill="{{ $funfact->is_highlighted ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="h-24 bg-gray-100 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>

                            @if($funfact->is_highlighted && auth()->check() && auth()->user()->is_admin)
                                <div class="absolute top-0 right-0 bg-yellow-500 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                                    {{ __('Highlighted') }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Content Section -->
                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $funfact->judul }}</h3>

                        <p class="text-gray-600 mb-6 flex-grow">
                            {{ Str::limit($funfact->getLocalizedDescription(), 130) }}
                        </p>

                        <!-- Related Article -->
                        @if($funfact->article)
                            <div class="flex items-start space-x-2 mb-4 text-sm">
                                <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <a href="{{ route('articles.show', $funfact->article) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ Str::limit($funfact->article->judul, 60) }}
                                </a>
                            </div>
                        @endif

                        <!-- Category and Animation Order -->
                        <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                            @if($funfact->article && $funfact->article->category)
                                <span class="inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $funfact->article->category->nama_kategori }}
                                </span>
                            @else
                                <span>&nbsp;</span>
                            @endif

                            <span>{{ __('Animation Order') }}: {{ $funfact->urutan_animasi }}</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                            <a href="{{ route('funfacts.show', $funfact) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                                {{ __('Read More') }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>

                            <!-- Admin-only actions -->
                            @if(auth()->check() && auth()->user()->is_admin)
                                <div class="flex space-x-2">
                                    <a href="{{ route('funfacts.edit', $funfact) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>

                                    <form action="{{ route('funfacts.destroy', $funfact) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Are you sure you want to delete this funfact?') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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

        <!-- Pagination -->
        <div class="mt-8">
            {{ $funfacts->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12 bg-white rounded-lg shadow-sm border border-gray-200">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900">{{ __('No Funfacts Found') }}</h3>
            <p class="mt-2 text-gray-500 max-w-md mx-auto">
                {{ __('No funfacts match your search criteria. Try adjusting your filters or search terms.') }}
            </p>

            @if(auth()->check() && auth()->user()->is_admin)
                <div class="mt-6">
                    <a href="{{ route('funfacts.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        {{ __('Create New Funfact') }}
                    </a>
                </div>
            @endif
        </div>
    @endif

    <!-- Admin Management Section - Only visible to admins -->
    @if(auth()->check() && auth()->user()->is_admin)
        <div class="bg-white rounded-lg shadow-md p-6 mt-10">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Funfact Management') }}</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('funfacts.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    {{ __('Create New Funfact') }}
                </a>
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    {{ __('Admin Dashboard') }}
                </a>
            </div>
        </div>
    @endif

    <!-- About Funfacts Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-10">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('About Funfacts') }}</h2>
        <div class="prose max-w-none text-gray-600">
            <p>
                {{ __('Funfacts are interesting and educational tidbits of information that can enhance your knowledge about various subjects. Each funfact on our platform is carefully curated and often linked to related articles for more in-depth exploration.') }}
            </p>
            <p class="mt-4">
                {{ __('Browse through our collection of funfacts to discover fascinating insights about nature, history, science, and more. The funfacts displayed on this page are randomly selected to provide you with a diverse learning experience each time you visit.') }}
            </p>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Animation for cards */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .grid > div {
        animation: fadeIn 0.5s ease-out forwards;
        animation-delay: calc(var(--animation-order, 0) * 100ms);
        opacity: 0;
    }

    @media (prefers-reduced-motion: reduce) {
        .grid > div {
            animation: none;
            opacity: 1;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set animation delay for each card based on its position
        const cards = document.querySelectorAll('.grid > div');
        cards.forEach((card, index) => {
            card.style.setProperty('--animation-order', index);
        });

        // Initialize select elements with better UX if needed
        const selects = document.querySelectorAll('select');
        selects.forEach(select => {
            select.addEventListener('change', function() {
                if (this.value) {
                    this.classList.add('text-gray-900', 'font-medium');
                } else {
                    this.classList.remove('text-gray-900', 'font-medium');
                }
            });

            // Initialize state
            if (select.value) {
                select.classList.add('text-gray-900', 'font-medium');
            }
        });
    });
</script>
@endpush
