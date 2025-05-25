<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\user\profile.blade.php -->
@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">My Profile</h1>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Profile Sidebar -->
        <div class="col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <img class="h-32 w-32 rounded-full object-cover"
                             src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('img/default-avatar.png') }}"
                             alt="{{ Auth::user()->name }}">
                    </div>
                    <h2 class="text-xl font-medium text-gray-900">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600 mb-4">{{ Auth::user()->email }}</p>

                    <div class="w-full">
                        <a href="{{ route('user.edit-profile') }}" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div class="border-t border-gray-200 mt-6 pt-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">My Stats</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Articles</span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['articles'] }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Comments</span>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['comments'] }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Communities</span>
                            <span class="bg-purple-100 text-purple-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['communities'] }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Member Since</span>
                            <span class="text-gray-600 text-sm">{{ Auth::user()->created_at->format('M Y') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bio Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-medium text-gray-900 mb-2">About Me</h3>
                <p class="text-gray-600">
                    {{ Auth::user()->bio ?: 'No bio provided. Tell the community about yourself by editing your profile.' }}
                </p>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-span-2 space-y-6">
            <!-- My Articles -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">My Articles</h2>
                    <a href="{{ route('user.articles') }}" class="text-blue-600 hover:text-blue-800">View All</a>
                </div>

                @if(count($recentArticles) > 0)
                    <div class="space-y-4">
                        @foreach($recentArticles as $article)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-medium text-gray-900">{{ $article->judul }}</h3>
                                    <span class="bg-{{ $article->getStatusColor() }}-100 text-{{ $article->getStatusColor() }}-800 text-xs px-2 py-1 rounded">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mt-2">{{ Str::limit(strip_tags($article->konten_isi_artikel), 100) }}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-gray-500 text-xs">{{ $article->tgl_upload->format('M d, Y') }}</span>
                                    <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm">Read More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 text-gray-500">
                        <p>You haven't created any articles yet.</p>
                        <a href="{{ route('articles.create') }}" class="inline-block mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                            Create Your First Article
                        </a>
                    </div>
                @endif
            </div>

            <!-- My Communities -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-medium text-gray-900">My Communities</h2>
                    <a href="{{ route('user.communities') }}" class="text-blue-600 hover:text-blue-800">View All</a>
                </div>

                @if(count($communities) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($communities as $community)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h3 class="font-medium text-gray-900">{{ $community->nama }}</h3>
                                <p class="text-gray-600 text-sm mt-2">{{ Str::limit($community->deskripsi, 60) }}</p>
                                <div class="flex justify-between items-center mt-3">
                                    <span class="text-gray-500 text-xs">{{ $community->members_count }} members</span>
                                    <a href="{{ route('communities.show', $community) }}" class="text-blue-600 hover:text-blue-800 text-sm">Visit</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 text-gray-500">
                        <p>You haven't joined any communities yet.</p>
                        <a href="{{ route('communities.index') }}" class="inline-block mt-3 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                            Explore Communities
                        </a>
                    </div>
                @endif
            </div>

            <!-- Account Settings -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Account Settings</h2>

                <div class="space-y-4">
                    <a href="{{ route('user.edit-profile') }}" class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div>
                                <h3 class="font-medium text-gray-900">Edit Profile</h3>
                                <p class="text-sm text-gray-600">Update your personal information</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>

                    <a href="{{ route('user.change-password') }}" class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <div>
                                <h3 class="font-medium text-gray-900">Change Password</h3>
                                <p class="text-sm text-gray-600">Update your security information</p>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
