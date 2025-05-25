
<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\tags\index.blade.php -->
@extends('layouts.app')

@section('title', 'Browse Tags')

@section('content')
<div class="container py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Browse All Tags</h1>
            <p class="text-lg text-gray-600">Discover content by topic</p>
        </div>

        <!-- Search Box -->
        <div class="mb-8">
            <form action="{{ route('tags.search') }}" method="GET" class="flex">
                <div class="relative flex-grow">
                    <input type="text" name="query" placeholder="Search for tags..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        value="{{ request('query') }}">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-search"></i>
                    <span class="ml-1">Search</span>
                </button>
            </form>
        </div>

        <!-- Popular Tags Link -->
        <div class="mb-8">
            <a href="{{ route('tags.cloud') }}" class="flex items-center text-blue-600 hover:text-blue-800">
                <i class="fas fa-cloud text-xl mr-2"></i>
                <span>View Tag Cloud Visualization</span>
            </a>
        </div>

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
            {{ $tags->links() }}
        </div>
    </div>
</div>
@endsection
