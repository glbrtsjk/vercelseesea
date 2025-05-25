<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\dashboard\articles.blade.php -->
@extends('layouts.app')

@section('title', 'My Articles')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">My Articles</h1>
        <a href="{{ route('articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-300">
            <i class="fas fa-plus mr-2"></i> Create New Article
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if ($articles->count() > 0)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($articles as $article)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($article->gambar)
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}">
                                        </div>
                                    @endif
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $article->judul }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $article->category->nama_kategori }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($article->status === 'published')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @elseif($article->status === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Pending Review
                                    </span>
                                @elseif($article->status === 'rejected')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Rejected
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $article->tgl_upload->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('articles.show', $article) }}" class="text-indigo-600 hover:text-indigo-900" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this article?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <div class="text-5xl text-gray-300 mb-4">
                <i class="fas fa-file-alt"></i>
            </div>
            <h2 class="text-xl font-medium text-gray-800 mb-2">No Articles Yet</h2>
            <p class="text-gray-600 mb-4">You haven't created any articles yet. Start sharing your knowledge with the community!</p>
            <a href="{{ route('articles.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition duration-300">
                Create Your First Article
            </a>
        </div>
    @endif

    <!-- Article Status Guide -->
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-lg font-medium text-gray-800 mb-4">Article Status Guide</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex items-center space-x-2">
                <span class="w-4 h-4 rounded-full bg-green-100 border border-green-800"></span>
                <span class="text-sm text-gray-700"><strong>Published:</strong> Your article is live and visible to all users.</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-4 h-4 rounded-full bg-yellow-100 border border-yellow-800"></span>
                <span class="text-sm text-gray-700"><strong>Pending Review:</strong> Your article is awaiting admin approval.</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-4 h-4 rounded-full bg-red-100 border border-red-800"></span>
                <span class="text-sm text-gray-700"><strong>Rejected:</strong> Your article needs revisions before it can be published.</span>
            </div>
            <div class="flex items-center space-x-2">
                <span class="w-4 h-4 rounded-full bg-gray-100 border border-gray-800"></span>
                <span class="text-sm text-gray-700"><strong>Draft:</strong> Your article is saved but not submitted for review.</span>
            </div>
        </div>
    </div>
</div>
@endsection
