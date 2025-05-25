htdocs\projectpwl\resources\views\dashboard\communities.blade.php
@extends('layouts.app')

@section('title', 'My Communities')

@section('content')
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold">My Communities</h1>
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
            <h2 class="text-xl font-bold text-gray-900">Communities I've Joined</h2>
            <a href="{{ route('communities.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                <i class="fas fa-search mr-2"></i> Explore Communities
            </a>
        </div>

        @if(count($communities) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($communities as $community)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-bold text-gray-900">{{ $community->nama }}</h3>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ $community->members_count }} members
                                </span>
                            </div>

                            <p class="mt-2 text-gray-600">{{ Str::limit($community->deskripsi, 100) }}</p>

                            <div class="mt-4 flex items-center text-sm text-gray-500">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                Joined {{ \Carbon\Carbon::parse($community->pivot->tg_gabung)->format('M d, Y') }}
                            </div>

                            <div class="mt-4">
                                <a href="{{ route('communities.show', $community) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                    Visit Community <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $communities->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No communities joined</h3>
                <p class="mt-1 text-sm text-gray-500">Start by joining a community that interests you.</p>
                <div class="mt-6">
                    <a href="{{ route('communities.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Explore Communities
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
