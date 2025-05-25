docs\projectpwl\resources\views\admin\edit-profile.blade.php
@extends('layouts.admin')

@section('title', 'Edit Admin Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
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

        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h1>

            <form action="{{ route('admin.update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Photo -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="photo">Profile Photo</label>
                    <div class="flex items-center">
                        <div class="mr-4">
                            <img class="h-20 w-20 rounded-full object-cover"
                                 src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('img/default-avatar.png') }}"
                                 alt="{{ Auth::user()->name }}">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="foto_profil" id="photo" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100">
                            <p class="mt-1 text-sm text-gray-500">JPG, PNG or GIF. Max size 2MB.</p>
                            @error('foto_profil')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bio -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="bio">Bio</label>
                    <textarea name="bio" id="bio" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('bio', Auth::user()->bio) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Tell others a little about yourself.</p>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.profile') }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded-md text-sm font-medium transition duration-300">Cancel</a>
                    <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-2 rounded-md text-sm font-medium transition duration-300">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
