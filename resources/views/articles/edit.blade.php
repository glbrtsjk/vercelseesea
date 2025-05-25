@extends('layouts.app')

@section('content')
<!-- Article Edit Header -->
<section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Edit Article</h1>
        <p class="text-lg">Update your article - "{{ $article->judul }}"</p>
    </div>
</section>

<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 md:p-8">
            <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $article->judul) }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category_id" class="block text-gray-700 font-medium mb-2">Category</label>
                    <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id', $article->category_id) == $category->category_id ? 'selected' : '' }}>
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
                            @php
                                $articleTags = $article->tags->pluck('tag_id')->toArray();
                            @endphp

                            @foreach($tags as $tag)
                                <div class="flex items-center">
                                    <input type="checkbox" name="tags[]" id="tag-{{ $tag->tag_id }}" value="{{ $tag->tag_id }}"
                                          class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                          {{ (is_array(old('tags')) && in_array($tag->tag_id, old('tags'))) ||
                                             (!old('tags') && in_array($tag->tag_id, $articleTags)) ? 'checked' : '' }}>
                                    <label for="tag-{{ $tag->tag_id }}" class="ml-2 text-sm text-gray-700">{{ $tag->nama_tag }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="konten_isi_artikel" class="block text-gray-700 font-medium mb-2">Article Content</label>
                    <textarea name="konten_isi_artikel" id="konten_isi_artikel" rows="12" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>{{ old('konten_isi_artikel', $article->konten_isi_artikel) }}</textarea>
                </div>

                <!-- Current Image -->
                @if($article->gambar)
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium mb-2">Current Image</label>
                        <div class="mt-1">
                            <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}" class="h-40 object-cover rounded-lg border border-gray-200">
                        </div>
                    </div>
                @endif

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="gambar" class="block text-gray-700 font-medium mb-2">{{ $article->gambar ? 'Change Image' : 'Add Image' }}</label>
                    <div class="mt-1 flex items-center">
                        <input type="file" name="gambar" id="gambar" class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Upload an image (JPEG, PNG, JPG, GIF - max 2MB)</p>
                </div>

                <!-- Admin Options & Publishing Information -->
                @if(Auth::user()->isAdmin())
                    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <h3 class="font-medium text-gray-800 mb-2">Admin Options</h3>
                        <div class="mb-3">
                            <label for="status" class="block text-gray-700 text-sm font-medium mb-2">Article Status</label>
                            <select name="status" id="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="pending" {{ old('status', $article->status) == 'pending' ? 'selected' : '' }}>Pending Review</option>
                                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                                <option value="rejected" {{ old('status', $article->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="flex items-center mb-3">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ $article->is_featured ? 'checked' : '' }}>
                            <label for="is_featured" class="ml-2 text-gray-700">Feature this article</label>
                        </div>
                        <p class="text-sm text-gray-500">As an administrator, you can directly publish or feature this article.</p>
                    </div>
                @else
                    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <h3 class="font-medium text-gray-800 mb-2">Publishing Information</h3>
                        <p class="text-sm text-gray-600">Your article will be reviewed by our administrators before being published. Any changes you make will require a new review.</p>

                        @if($article->status === 'rejected')
                            <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                <h4 class="text-sm font-medium text-red-800">Feedback from Administrator:</h4>
                                <p class="text-sm text-gray-700 mt-1">{{ $article->rejection_reason ?? 'No specific feedback provided. Please review your article content for quality and adherence to our guidelines.' }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Submit Buttons -->
                <div class="flex items-center justify-between mt-8">
                    <button type="button" onclick="confirmDelete()" class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                        Delete
                    </button>

                    <div class="flex space-x-3">
                        <a href="{{ route('articles.index')}}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-6 rounded-lg transition duration-300">Cancel</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-300">
                            Update Article
                        </button>
                    </div>
                </div>
            </form>

            <!-- Delete Form (Hidden) -->
            <form id="delete-form" action="{{ route('articles.destroy', $article) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</section>

<!-- Article Status Information -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-lg font-medium text-gray-800 mb-3">Article Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Created on</p>
                        <p class="font-medium">{{ $article->tgl_upload->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-medium">
                            @if($article->status == 'published')
                                <span class="text-green-600">Published</span>
                            @elseif($article->status == 'pending')
                                <span class="text-yellow-600">Pending Review</span>
                            @elseif($article->status == 'rejected')
                                <span class="text-red-600">Rejected</span>
                            @else
                                <span class="text-gray-600">Draft</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Author</p>
                        <p class="font-medium">{{ $article->user->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Article URL</p>
                        <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm truncate block">{{ route('articles.show', $article) }}</a>
                    </div>
                </div>
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

    // Delete confirmation
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this article? This action cannot be undone.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endpush
