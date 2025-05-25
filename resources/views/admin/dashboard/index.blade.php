@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Dashboard Header -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}</p>
            </div>
            <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
                <a href="{{ route('articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-medium flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    New Article
                </a>
                <a href="{{ route('admin.users.usermanage') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg font-medium flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Manage Users
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Articles -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Articles</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalArticles }}</p>
                </div>
            </div>
        </div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Pending Articles</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingArticlesCount }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-hourglass-half fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Users</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Total Communities -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Communities</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalCommunities }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Articles Section -->
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Articles Pending Approval</h2>
            <a href="{{ route('admin.articles.pending') }}" class="text-blue-600 hover:text-blue-800 font-medium">View All</a>
        </div>

        @if($recentArticles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recentArticles as $article)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        @if($article->gambar)
                            <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center ">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded">Pending</span>
                                <span class="ml-2 text-xs text-gray-500">{{ $article->tgl_upload->format('M d, Y') }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $article->judul }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit(strip_tags($article->konten_isi_artikel), 100) }}</p>

                            <!-- Author info -->
                            <div class="flex items-center mb-4">
                                <img src="{{ $article->user->foto_profil ? Storage::url($article->user->foto_profil) : asset('img/default-avatar.png') }}"
                                    alt="{{ $article->user->name }}"
                                    class="w-8 h-8 rounded-full mr-2">
                                <span class="text-sm text-gray-700">{{ $article->user->name }}</span>
                            </div>

                            <!-- Action buttons -->
                            <div class="flex items-center justify-between">
                                <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Read More
                                </a>
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.articles.approve', $article) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                            Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.articles.reject', $article) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this article?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $recentArticles->links() }}
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-6 text-center">
                <p class="text-gray-600">No pending articles found.</p>
            </div>
        @endif
    </div>

    <!-- Funfacts & Tags Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Funfacts Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Funfacts</h2>
                <a href="{{ route('admin.funfacts.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Funfact
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recentFunfacts as $funfact)
                    <div class="border border-gray-200 rounded-lg p-4 flex items-center">
                        @if($funfact->gambar)
                            <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}" class="w-16 h-16 object-cover rounded mr-4">
                        @else
                            <div class="w-16 h-16 bg-purple-100 rounded flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800">{{ $funfact->judul }}</h3>
                            <p class="text-sm text-gray-600">{{ Str::limit($funfact->deskripsi_id, 80) }}</p>
                        </div>
                        <a href="{{ route('admin.funfacts.edit', $funfact) }}" class="text-blue-600 hover:text-blue-800 ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                        </a>
                    </div>
                @empty
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <p class="text-gray-600">No funfacts found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('funfacts.index') }}" class="text-purple-600 hover:text-purple-800 font-medium">View All Funfacts</a>
            </div>
        </div>

        <!-- Tags Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Tags</h2>
                <a href="{{ route('admin.tags.create') }}" class="bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded font-medium flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Tag
                </a>
            </div>

            <div class="flex flex-wrap gap-2">
                @forelse($popularTags as $tag)
                    <div class="bg-gray-100 rounded-lg px-4 py-2 flex items-center">
                        <span class="text-gray-800 font-medium">{{ $tag->nama_tag }}</span>
                        <span class="ml-2 bg-gray-200 text-gray-700 rounded-full px-2 py-0.5 text-xs">{{ $tag->articles_count }}</span>
                    </div>
                @empty
                    <div class="bg-gray-50 rounded-lg p-6 text-center w-full">
                        <p class="text-gray-600">No tags found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('admin.tags.index') }}" class="text-green-600 hover:text-green-800 font-medium">View All Tags</a>
            </div>
        </div>
    </div>

    <!-- Recent Users Section -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Recent Users</h2>
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">View All</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Articles</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentUsers as $user)
                        <tr>
                            <td class="py-3 px-4">
                                <div class="flex items-center">
                                    <img src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                                        alt="{{ $user->name }}"
                                        class="w-8 h-8 rounded-full mr-3">
                                    <span class="font-medium text-gray-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-gray-700">{{ $user->email }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $user->articles_count ?? 0 }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-800 font-medium">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
