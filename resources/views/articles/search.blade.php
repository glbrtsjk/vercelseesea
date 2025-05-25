@extends('layouts.app')

@section('title', 'Search Results: ' . request('query'))

@section('content')
<!-- Search Header -->
<section class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Search Results</h1>
        <p class="text-lg mb-6">Showing results for "{{ request('query') }}"</p>

        <!-- Search Form -->
        <form action="{{ route('articles.search') }}" method="GET" class="flex flex-col md:flex-row gap-3 max-w-3xl">
            <div class="flex-grow">
                <input type="text" name="query" placeholder="Search articles..." value="{{ request('query') }}" class="w-full px-4 py-3 rounded-lg text-gray-800">
            </div>
            <div class="w-full md:w-1/3">
                <select name="category" class="w-full px-4 py-3 rounded-lg text-gray-800">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition duration-300">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Search Results -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Result Stats -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <p class="text-gray-600">Found {{ $articles->total() }} {{ Str::plural('result', $articles->total()) }}</p>
                @if(request('category'))
                    <p class="text-sm text-gray-500">Filtered by category: {{ $categoryName ?? 'All Categories' }}</p>
                @endif
            </div>
            <div>
                <a href="{{ route('articles.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">View All Articles</a>
            </div>
        </div>

        @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                        <a href="{{ route('articles.show', $article) }}">
                            @if($article->gambar)
                                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div class="p-5">
                            <div class="flex items-center flex-wrap gap-2 mb-3">
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">{{ $article->category->nama_kategori }}</span>
                                <span class="text-xs text-gray-500">{{ $article->tgl_upload->format('M d, Y') }}</span>

                                <div class="flex items-center ml-auto text-gray-500 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"></path>
                                    </svg>
                                    {{ $article->reactions->count() }}
                                </div>
                            </div>
                            <a href="{{ route('articles.show', $article) }}">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 hover:text-blue-600 transition duration-300">{{ $article->judul }}</h3>
                            </a>
                            <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($article->konten_isi_artikel), 120) }}</p>

                            <!-- Article tags -->
                            @if($article->tags->count() > 0)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($article->tags as $tag)
                                        <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}" class="text-xs text-blue-600 hover:text-blue-800">#{{ $tag->nama_tag }}</a>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center">
                                <img src="{{ $article->user->profile_photo_url }}" alt="{{ $article->user->nama }}" class="w-8 h-8 rounded-full mr-2">
                                <span class="text-sm text-gray-700">{{ $article->user->nama }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-lg shadow-sm">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-700 mb-2">No Results Found</h3>
                <p class="text-gray-500 mb-6">We couldn't find any articles matching "{{ request('query') }}"</p>
                <div class="space-y-4">
                    <p class="text-gray-600">Try:</p>
                    <ul class="text-gray-600 space-y-2">
                        <li>• Using more general keywords</li>
                        <li>• Checking your spelling</li>
                        <li>• Searching in all categories</li>
                    </ul>
                    <div class="pt-4">
                        <a href="{{ route('articles.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Browse All Articles</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Search Related Tags -->
@if(isset($relatedTags) && count($relatedTags) > 0)
<section class="py-8 bg-white border-t">
    <div class="container mx-auto px-4">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Related Topics</h2>
        <div class="flex flex-wrap gap-2">
            @foreach($relatedTags as $tag)
                <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-gray-800 text-sm transition duration-300">
                    #{{ $tag->nama_tag }}
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
