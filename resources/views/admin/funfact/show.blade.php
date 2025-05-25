@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600 transition duration-300 inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('funfacts.index') }}" class="ml-1 text-gray-700 hover:text-green-600 transition duration-300 md:ml-2">Funfacts</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">{{ $funfact->judul }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Funfact Content -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if($funfact->gambar)
                <div class="w-full h-80">
                    <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}" class="w-full h-full object-cover">
                </div>
            @endif
            <div class="p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $funfact->judul }}</h1>

                <div class="prose max-w-none mb-8">
                    {!! app()->getLocale() === 'id' ? nl2br(e($funfact->deskripsi_id)) : nl2br(e($funfact->deskripsi_en)) !!}
                </div>

                @if($funfact->article)
                    <div class="mt-10 pt-6 border-t border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Related Article</h2>
                        <a href="{{ route('articles.show', $funfact->article) }}" class="flex items-center p-4 border border-blue-100 rounded-lg bg-blue-50 hover:bg-blue-100 transition duration-300">
                            @if($funfact->article->gambar)
                                <img src="{{ Storage::url($funfact->article->gambar) }}" alt="{{ $funfact->article->judul }}" class="w-16 h-16 object-cover rounded mr-4">
                            @endif
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $funfact->article->judul }}</h3>
                                <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($funfact->article->konten_isi_artikel), 100) }}</p>
                                <span class="inline-block mt-2 text-blue-600 hover:underline">Read the full article</span>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Navigation -->
        <div class="mt-8 flex justify-between">
            <a href="{{ route('funfacts.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-5 py-2 rounded-lg transition duration-300">
                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Funfacts
            </a>

            @if(Auth::check() && Auth::user()->is_admin)
                <a href="{{ route('admin.funfacts.edit', $funfact) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition duration-300">
                    <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Funfact
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
