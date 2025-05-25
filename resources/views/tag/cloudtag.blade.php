@extends('layouts.app')

@section('title', 'Tag Cloud')

@section('content')
<div class="container py-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Tag Cloud</h1>
            <p class="text-lg text-gray-600">Explore topics by popularity</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-8">
            <div class="flex flex-wrap justify-center">
                @foreach($tags as $tag)
                    @php
                        // Calculate font size based on article count (between 1 and 3 rem)
                        $min = 1;
                        $max = 3;
                        $maxArticles = $tags->max('articles_count');
                        $fontSize = $min + ($max - $min) * ($tag->articles_count / max($maxArticles, 1));

                        // Generate a color based on popularity
                        $intensity = 40 + min(40, $tag->articles_count * 2);
                        $hue = ($tag->tag_id * 77) % 360; // Generate different hues
                    @endphp

                    <a href="{{ route('tags.show', $tag->slug) }}"
                       class="m-2 px-3 py-1 inline-block"
                       style="font-size: {{ $fontSize }}rem; color: hsl({{ $hue }}, {{ $intensity }}%, 50%);">
                        #{{ $tag->nama_tag }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('tags.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded">
                <i class="fas fa-list mr-2"></i> View All Tags
            </a>
        </div>
    </div>
</div>
@endsection
