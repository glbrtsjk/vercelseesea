<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\tags\show.blade.php -->
@extends('layouts.app')

@section('title', '#' . $tag->nama_tag)

@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex items-center">
            <div class="bg-blue-600 rounded-full p-3 mr-4">
                <i class="fas fa-tag text-2xl"></i>
            </div>
            <div>
                <h1 class="text-4xl font-bold mb-2">#{{ $tag->nama_tag }}</h1>
                @if($tag->deskripsi)
                    <p class="text-lg text-blue-100">{{ $tag->deskripsi }}</p>
                @endif
                <p class="text-blue-200 mt-2">
                    <i class="fas fa-file-alt mr-1"></i>
                    {{ $tag->articles_count ?? $articles->total() }} {{ Str::plural('article', $tag->articles_count ?? $articles->total()) }}
                </p>
            </div>
        </div>

        <div class="mt-6">
            @auth
                @if(Auth::user()->tags->contains($tag->tag_id))
                    <form action="{{ route('tags.unfollow', $tag->slug) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-white text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-50 transition duration-300">
                            <i class="fas fa-user-minus mr-2"></i> Unfollow Tag
                        </button>
                    </form>
                @else
                    <form action="{{ route('tags.follow', $tag->slug) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-white text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-50 transition duration-300">
                            <i class="fas fa-user-plus mr-2"></i> Follow Tag
                        </button>
                    </form>
                @endif
            @endauth
            <a href="{{ route('tags.index') }}" class="ml-4 text-blue-100 hover:text-white">
                <i class="fas fa-arrow-left mr-1"></i>
                Back to all tags
            </a>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    @if($articles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $article)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($article->gambar)
                        <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                        </div>
                    @endif

                    <div class="p-6">
                        <a href="{{ route('articles.show', $article->slug) }}">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2 hover:text-blue-600">{{ $article->judul }}</h3>
                        </a>

                        <div class="flex items-center text-gray-600 mb-4">
                            <img src="{{ $article->user->foto_profil ? asset('storage/' . $article->user->foto_profil) : asset('images/default-avatar.png') }}"
                                class="w-6 h-6 rounded-full mr-2" alt="{{ $article->user->name }}">
                            <span class="text-sm">{{ $article->user->name }}</span>
                            <span class="mx-2 text-gray-400">•</span>
                            <span class="text-sm">{{ $article->tgl_upload->format('M d, Y') }}</span>
                        </div>

                        <div class="flex flex-wrap gap-2 mt-4">
                            @foreach($article->tags as $articleTag)
                                <a href="{{ route('tags.show', $articleTag->slug) }}"
                                    class="px-3 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full hover:bg-gray-200">
                                    #{{ $articleTag->nama_tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="text-5xl text-gray-300 mb-4">
                <i class="fas fa-search"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">No articles found</h2>
            <p class="text-gray-600">
                There are no articles tagged with #{{ $tag->nama_tag }} yet.
            </p>
            @auth
                <div class="mt-6">
                    <a href="{{ route('articles.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                        Write the first article
                    </a>
                </div>
            @endauth
        </div>
    @endif
</div>
@endsection
