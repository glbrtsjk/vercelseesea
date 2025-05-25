@extends('layouts.app')

@section('title', 'Popular Tags')

@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-2">Popular Tags</h1>
        <p class="text-lg text-blue-100">Discover trending topics on our platform</p>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($tags as $tag)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <div class="bg-gray-50 p-4 border-b">
                    <a href="{{ route('tags.show', $tag->slug) }}" class="flex items-center">
                        <div class="bg-blue-600 text-white p-3 rounded-full mr-4">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">#{{ $tag->nama_tag }}</h3>
                            <p class="text-sm text-gray-500">
                                {{ $tag->articles_count }} {{ Str::plural('article', $tag->articles_count) }}
                            </p>
                        </div>
                    </a>
                </div>

                <div class="p-4">
                    @if($tag->deskripsi)
                        <p class="text-gray-600 mb-4">{{ Str::limit($tag->deskripsi, 100) }}</p>
                    @endif

                    @auth
                        <div class="mb-4">
                            @if(Auth::user()->tags->contains($tag->tag_id))
                                <form action="{{ route('tags.unfollow', $tag->slug) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                        <i class="fas fa-user-minus mr-1"></i> Unfollow this tag
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('tags.follow', $tag->slug) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                                        <i class="fas fa-user-plus mr-1"></i> Follow this tag
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endauth

                    <a href="{{ route('tags.show', $tag->slug) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                        Browse #{{ $tag->nama_tag }} Articles <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-12">
        <a href="{{ route('tags.cloud') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
            <i class="fas fa-cloud mr-2"></i> View Tag Cloud
        </a>
        <a href="{{ route('tags.index') }}" class="ml-4 bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition duration-300">
            <i class="fas fa-list mr-2"></i> View All Tags
        </a>
    </div>
</div>
@endsection
