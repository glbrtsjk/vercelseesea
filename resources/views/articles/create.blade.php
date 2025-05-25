@extends('layouts.app')

@section('content')
<!-- Article Create Header -->
<section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Create Article</h1>
        <p class="text-lg">Share your knowledge with the Bagan community</p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Title -->
                <div class="mb-6">
                    <label for="judul" class="block text-gray-700 font-medium mb-2">Article Title</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                    <p class="text-sm text-gray-500 mt-1">Create a compelling title that describes your article</p>
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tags -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Tags</label>
                    <div class="border border-gray-300 rounded-lg p-3 max-h-48 overflow-y-auto">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach($tags as $tag)
                                <div class="flex items-center">
                                    <input type="checkbox" name="tags[]" id="tag-{{ $tag->tag_id }}" value="{{ $tag->tag_id }}"
                                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                           {{ (is_array(old('tags')) && in_array($tag->tag_id, old('tags'))) ? 'checked' : '' }}>
                                    <label for="tag-{{ $tag->tag_id }}" class="ml-2 text-sm text-gray-700">{{ $tag->nama_tag }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Select tags that are relevant to your article</p>
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="konten_isi_artikel" class="block text-gray-700 font-medium mb-2">Article Content</label>
                    <textarea name="konten_isi_artikel" id="konten_isi_artikel" rows="12" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('konten_isi_artikel') }}</textarea>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="gambar" class="block text-gray-700 font-medium mb-2">Featured Image</label>
                    <div class="mt-1 flex items-center">
                        <span class="inline-block h-12 w-12 rounded-md overflow-hidden bg-gray-100">
                            <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                        <input type="file" name="gambar" id="gambar" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Upload an image (JPEG, PNG, JPG, GIF - max 2MB)</p>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end mt-8 space-x-3">
                    <a href="{{ route('articles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-lg transition duration-300">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                        Create Article
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Article Guidelines -->
<section class="py-10 bg-blue-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Article Guidelines</h2>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-blue-100">
                <ul class="space-y-3 text-gray-700">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Write original content that adds value to the community.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Ensure your content is respectful and follows our community guidelines.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Your article will be reviewed by administrators before being published.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Including relevant images can make your article more engaging.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Add any JavaScript/jQuery needed for rich text editor integration
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize a rich text editor for the content field if needed
        // Example: CKEDITOR.replace('konten_isi_artikel');
    });
</script>
@endpush
