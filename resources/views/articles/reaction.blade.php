{{-- filepath: c:\xampp\htdocs\projectpwl\resources\views\reactions\show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Reactions</h1>
                <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">Back</a>
            </div>

            @foreach($reactionsByType as $type => $reactions)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-3 capitalize">{{ $type }} ({{ $reactions->count() }})</h2>

                    <div class="space-y-3">
                        @foreach($reactions as $reaction)
                            <div class="flex items-center">
                                <img src="{{ $reaction->user->profile_photo_url }}" alt="{{ $reaction->user->name }}" class="w-10 h-10 rounded-full mr-3">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $reaction->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $reaction->created_at->format('M d, Y \a\t H:i') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
