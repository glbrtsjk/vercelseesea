@extends('layouts.app')

@section('title', 'Tag Suggestions')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tag Suggestions</h1>
            <p class="text-lg text-gray-600">Based on your content</p>
        </div>

        <!-- Content Analysis -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Content Analysis</h2>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Title</label>
                <div class="p-3 bg-gray-50 rounded border border-gray-200">
                    {{ $title }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Content Preview</label>
                <div class="p-3 bg-gray-50 rounded border border-gray-200 max-h-40 overflow-y-auto">
                    {{ Str::limit($content, 500) }}
                </div>
            </div>
        </div>

        <!-- Suggested Tags -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Suggested Tags</h2>

            @if(count($suggestions) > 0)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($suggestions as $suggestion)
                        <div class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                            #{{ $suggestion }}
                        </div>
                    @endforeach
                </div>

                <form action="{{ url()->previous() }}" method="GET" class="mt-8">
                    <input type="hidden" name="suggested_tags" value="{{ implode(',', $suggestions) }}">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        Use These Tags
                    </button>
                    <a href="{{ url()->previous() }}" class="ml-4 text-gray-600 hover:text-gray-800">
                        Cancel
                    </a>
                </form>
            @else
                <div class="text-center py-8">
                    <div class="text-4xl text-gray-300 mb-4">
                        <i class="fas fa-tags"></i>
                    </div>
                    <p class="text-gray-600">No tag suggestions found for your content.</p>
                    <a href="{{ url()->previous() }}" class="mt-4 inline-block text-blue-600 hover:text-blue-800">
                        Back to Editor
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
