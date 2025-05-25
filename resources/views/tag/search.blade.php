
@extends('layouts.app')

@section('title', 'Search Tags: ' . $query)

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Search Results: "{{ $query }}"</h1>
            <p class="text-lg text-gray-600">Found {{ $tags->total() }} matching tags</p>
        </div>

        <!-- Search Box -->
        <div class="mb-8">
            <form action="{{ route('tags.search') }}" method="GET" class="flex">
                <div class="relative flex-grow">
                    <input type="text" name="query" placeholder="Search for tags..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ $query }}">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-search"></i>
                    <span class="ml-1">Search</span>
                </button>
            </form>
        </div>

        @if($tags->count() > 0)
            <!-- Tags Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($tags as $tag)
                    <div class="bg-white rounded-lg shadow-sm p-5 hover:shadow-md transition-shadow duration-300">
                        <a href="{{ route('tags.show', $tag->slug) }}" class="block">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $tag->nama_tag }}</h3>
                            <div class="flex items-center text-gray-600 mb-2">
                                <i class="fas fa-file-alt mr-2"></i>
                                <span>{{ $tag->articles_count }} {{ Str::plural('article', $tag->articles_count) }}</span>
                            </div>
                            @if($tag->deskripsi)
                                <p class="text-gray-600 text-sm">{{ Str::limit($tag->deskripsi, 100) }}</p>
                            @endif
                        </a>

                        @auth
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                @if(Auth::user()->tags->contains($tag->tag_id))
                                    <form action="{{ route('tags.unfollow', $tag->slug) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                            <i class="fas fa-user-minus mr-1"></i> Unfollow
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('tags.follow', $tag->slug) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
                                            <i class="fas fa-user-plus mr-1"></i> Follow
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endauth
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $tags->appends(['query' => $query])->links() }}
            </div>
        @else
            <!-- No Results -->
            <div class="bg-white shadow-sm rounded-lg p-8 text-center">
                <div class="text-5xl text-gray-300 mb-4">
                    <i class="fas fa-tag"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">No tags found</h2>
                <p class="text-gray-600 mb-6">
                    We couldn't find any tags matching "{{ $query }}"
                </p>
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('tags.index') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        Browse All Tags
                    </a>
                    @auth
                        <a href="{{ route('admin.tags.create') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                            Create New Tag
                        </a>
                    @endauth
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
