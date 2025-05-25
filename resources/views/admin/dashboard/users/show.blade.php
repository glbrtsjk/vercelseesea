<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\users\show.blade.php -->
@extends('layouts.admin')

@section('title', $user->name . ' - User Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">User Profile</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg font-medium flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Users
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- User Profile Info -->
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex flex-col items-center text-center mb-6">
                <img class="h-32 w-32 rounded-full object-cover mb-4"
                     src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                     alt="{{ $user->name }}">
                <h2 class="text-xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-gray-600">{{ $user->email }}</p>
                <div class="mt-2">
                    @if($user->email_verified_at)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Verified
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Not Verified
                        </span>
                    @endif

                    @if($user->isBanned())
                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Banned
                        </span>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <h3 class="text-sm font-medium text-gray-500 mb-3">User Details</h3>
                <ul class="space-y-3">
                    <li class="text-sm flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Joined: {{ $user->created_at->format('M d, Y') }}
                    </li>

                    <li class="text-sm flex items-start">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <div>
                            <span class="font-semibold">Bio:</span><br>
                            <p class="text-gray-600">{{ $user->bio ?: 'No bio provided.' }}</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="border-t border-gray-200 pt-4 mt-4">
                <h3 class="text-sm font-medium text-gray-500 mb-3">Activity Summary</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ $articleCount }}</div>
                        <div class="text-xs text-gray-500">Articles</div>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $commentCount }}</div>
                        <div class="text-xs text-gray-500">Comments</div>
                    </div>
                </div>
            </div>

            @if(Auth::id() !== $user->user_id)
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Administrative Actions</h3>
                    <div class="flex flex-col space-y-2">
                        @if($user->isBanned())
                            <form action="{{ route('admin.users.unban', $user->user_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition duration-200">
                                    Unban User
                                </button>
                            </form>
                        @else
                            <form action="{{ route('admin.users.ban', $user->user_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-200">
                                    Ban User
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 border border-red-600 text-red-600 rounded hover:bg-red-50 transition duration-200">
                                Delete User
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- User's Content Section -->
        <div class="md:col-span-2 space-y-6">
            <!-- Recent Articles -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-800 mb-4">Recent Articles</h2>

                @if($articles->count() > 0)
                    <div class="space-y-4">
                        @foreach($articles as $article)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-medium text-gray-800">{{ $article->judul }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ Str::limit(strip_tags($article->konten_isi_artikel), 100) }}</p>

                                        <div class="flex items-center mt-2">
                                            <span class="bg-{{ $article->getStatusColor() }}-100 text-{{ $article->getStatusColor() }}-800 text-xs px-2 py-1 rounded">
                                                {{ ucfirst($article->status) }}
                                            </span>
                                            <span class="text-xs text-gray-500 ml-2">{{ $article->tgl_upload->format('M d, Y') }}</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('admin.articles.show', $article) }}" class="text-blue-600 hover:text-blue-800">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($articleCount > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.articles.index', ['user_id' => $user->user_id]) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                View All Articles ({{ $articleCount }})
                            </a>
                        </div>
                    @endif
                @else
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <p class="text-gray-600">This user hasn't published any articles yet.</p>
                    </div>
                @endif
            </div>

            <!-- Communities -->
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-800 mb-4">Communities</h2>

                @if($communities->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($communities as $community)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h3 class="font-medium text-gray-800">{{ $community->nama }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($community->deskripsi, 60) }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-xs text-gray-500">Joined {{ $community->pivot->created_at->format('M Y') }}</span>
                                    <a href="{{ route('admin.communities.show', $community) }}" class="text-blue-600 hover:text-blue-800 text-sm">View</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-lg p-6 text-center">
                        <p class="text-gray-600">This user hasn't joined any communities yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
