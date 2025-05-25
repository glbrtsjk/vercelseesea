@extends('layouts.app')

@section('title', 'My Articles')

@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">My Articles</h1>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-900">All My Articles</h2>
            <a href="{{ route('articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                <i class="fas fa-plus mr-2"></i> Create New Article
            </a>
        </div>

        @if(count($articles) > 0)
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Title</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Published</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Stats</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($articles as $article)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex items-center">
                                        @if($article->gambar)
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded object-cover" src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}">
                                            </div>
                                        @endif
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ $article->judul }}</div>
                                            <div class="text-gray-500">{{ $article->category->nama_kategori }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex rounded-full bg-{{ $article->getStatusColor() }}-100 px-2 text-xs font-semibold leading-5 text-{{ $article->getStatusColor() }}-800">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $article->tgl_upload->format('M d, Y') }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div class="flex space-x-2">
                                        <span class="inline-flex items-center text-xs">
                                            <svg class="mr-1 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $article->reactions_count }}
                                        </span>
                                        <span class="inline-flex items-center text-xs">
                                            <svg class="mr-1 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                            </svg>
                                            {{ $article->comments_count }}
                                        </span>
                                    </div>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <div class="flex space-x-2 justify-end">
                                        <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-900">
                                            View<span class="sr-only">, {{ $article->judul }}</span>
                                        </a>
                                        @if($article->status == 'draft' || $article->status == 'rejected')
                                            <a href="{{ route('articles.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900">
                                                Edit<span class="sr-only">, {{ $article->judul }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No articles yet</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new article.</p>
                <div class="mt-6">
                    <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create New Article
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
