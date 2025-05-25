@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Funfact</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.funfacts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition duration-300">
                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
            <a href="{{ route('funfacts.show', $funfact) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300" target="_blank">
                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
                View
            </a>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden p-6">
        <form action="{{ route('admin.funfacts.update', $funfact) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="col-span-2">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $funfact->judul) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Indonesian Description -->
                <div class="col-span-2 md:col-span-1">
                    <label for="deskripsi_id" class="block text-sm font-medium text-gray-700 mb-1">Indonesian Description</label>
                    <textarea name="deskripsi_id" id="deskripsi_id" rows="5"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('deskripsi_id', $funfact->deskripsi_id) }}</textarea>
                    @error('deskripsi_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- English Description -->
                <div class="col-span-2 md:col-span-1">
                    <label for="deskripsi_en" class="block text-sm font-medium text-gray-700 mb-1">English Description</label>
                    <textarea name="deskripsi_en" id="deskripsi_en" rows="5"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                              required>{{ old('deskripsi_en', $funfact->deskripsi_en) }}</textarea>
                    @error('deskripsi_en')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($funfact->gambar)
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                    <div class="mt-1 relative group w-40 h-40 border border-gray-200 rounded overflow-hidden">
                        <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center transition-all duration-300">
                            <input type="checkbox" name="remove_image" id="remove_image" value="1" class="absolute top-2 right-2 h-4 w-4">
                            <label for="remove_image" class="absolute top-2 right-7 text-white text-xs">Remove</label>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Image Upload -->
                <div class="col-span-2">
                    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">
                        {{ $funfact->gambar ? 'Change Image' : 'Upload Image' }} (Optional)
                    </label>
                    <div class="mt-1 flex items-center">
                        <label class="block w-full">
                            <span class="sr-only">Choose image</span>
                            <input type="file" name="gambar" id="gambar" accept="image/*"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">PNG, JPG, or GIF up to 2MB</p>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Animation Order -->
                <div class="col-span-1">
                    <label for="urutan_animasi" class="block text-sm font-medium text-gray-700 mb-1">Animation Order</label>
                    <input type="number" name="urutan_animasi" id="urutan_animasi" value="{{ old('urutan_animasi', $funfact->urutan_animasi) }}" min="1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                    @error('urutan_animasi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Related Article -->
                <div class="col-span-1">
                    <label for="article_id" class="block text-sm font-medium text-gray-700 mb-1">Related Article (Optional)</label>
                    <select name="article_id" id="article_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">None</option>
                        @foreach($articles as $article)
                            <option value="{{ $article->article_id }}" {{ (old('article_id', $funfact->article_id) == $article->article_id) ? 'selected' : '' }}>
                                {{ $article->judul }}
                            </option>
                        @endforeach
                    </select>
                    @error('article_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Status -->
                <div class="col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $funfact->is_featured) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_featured" class="ml-2 block text-sm text-gray-700">Mark as Featured Funfact</label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Featured funfacts will be displayed prominently on the homepage</p>
                </div>

                <!-- Tags -->
                <div class="col-span-2">
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags (Optional)</label>
                    <select name="tags[]" id="tags" multiple
                            class="tagselect w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->tag_id }}" {{ in_array($tag->tag_id, old('tags', $funfact->tags->pluck('tag_id')->toArray())) ? 'selected' : '' }}>
                                {{ $tag->nama_tag }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Select multiple tags by holding Ctrl (PC) or Cmd (Mac)</p>
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Last Updated Info -->
            <div class="mt-6">
                <div class="flex items-center text-sm text-gray-500">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Last updated: {{ $funfact->updated_at->format('M d, Y \a\t h:i A') }}

                    @if($funfact->user)
                    <span class="mx-2">|</span>
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0
                        00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    By: {{ $funfact->user->name }}
                    @endif
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-6">
                <div class="flex justify-between">
                    <button type="button" onclick="confirmDelete()" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete Funfact
                    </button>
                    <div>
                        <button type="button" onclick="window.history.back()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Funfact
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Hidden Delete Form -->
        <form id="delete-form" action="{{ route('admin.funfacts.destroy', $funfact) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Select2 for tags
        $('.tagselect').select2({
            placeholder: 'Select tags',
            allowClear: true,
            tags: true,
            tokenSeparators: [',', ' ']
        });

        // Preview image on upload
        const imgInput = document.getElementById('gambar');
        if (imgInput) {
            imgInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Create preview element if it doesn't exist
                        let preview = document.getElementById('image-preview');
                        if (!preview) {
                            preview = document.createElement('div');
                            preview.id = 'image-preview';
                            preview.className = 'mt-3';
                            imgInput.parentNode.parentNode.appendChild(preview);
                        }

                        preview.innerHTML = `
                            <div class="relative w-32 h-32 rounded overflow-hidden border border-gray-200">
                                <img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">
                                <button type="button" id="remove-image" class="absolute top-0 right-0 bg-red-500 text-white p-1 rounded-bl">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        `;

                        // Add remove button event listener
                        document.getElementById('remove-image').addEventListener('click', function() {
                            imgInput.value = '';
                            preview.remove();
                        });
                    }

                    reader.readAsDataURL(file);
                }
            });
        }
    });

    // Confirm delete function
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this funfact? This action cannot be undone.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endpush
@endsection
