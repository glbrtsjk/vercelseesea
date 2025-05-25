@extends('layouts.admin')

@section('title', 'Admin Profile')

@section('content')
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
                    <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded mb-4">
                        Administrator
                    </div>

                    <div class="w-full">
                        <a href="{{ route('admin.edit-profile') }}" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div class="border-t border-gray-200 mt-6 pt-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Admin Stats</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Articles Approved</span>
                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['articles_approved'] }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Articles Rejected</span>
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['articles_rejected'] }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Total Users</span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['users_count'] }}</span>
                        </li>
                        <li class="flex items-center justify-between">
                            <span class="text-gray-600">Admin Since</span>
                            <span class="text-gray-600 text-sm">{{ $stats['admin_since'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bio Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="font-medium text-gray-900 mb-2">About Me</h3>
                <p class="text-gray-600">
                    {{ Auth::user()->bio ?: 'No bio provided. Tell others about yourself by editing your profile.' }}
                </p>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-span-2 space-y-6">
            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Quick Admin Actions</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.articles.pending') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="p-3 bg-yellow-100 rounded-full mr-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Pending Articles</h3>
                            <p class="text-sm text-gray-500">Review and approve user submissions</p>
                        </div>
                    </a>

                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">                        <div class="p-3 bg-blue-100 rounded-full mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Manage Users</h3>
                            <p class="text-sm text-gray-500">View and manage user accounts</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.dashboard.community') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="p-3 bg-purple-100 rounded-full mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Communities</h3>
                            <p class="text-sm text-gray-500">Manage communities</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.dashboard.article') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
                        <div class="p-3 bg-green-100 rounded-full mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900">Article</h3>
                            <p class="text-sm text-gray-500">Manage article</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Account Settings -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Account Settings</h2>

                <div class="space-y-4">
                    <a href="{{ route('admin.edit-profile') }}" class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
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

                    <a href="{{ route('admin.change-password') }}" class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200">
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
