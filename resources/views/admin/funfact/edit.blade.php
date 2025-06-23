@extends('layouts.admin')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen py-8 relative">
   <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>
    <div class="container mx-auto px-4">
        <div class="relative backdrop-blur-sm shadow-lg rounded-2xl p-6 mb-8 overflow-hidden  bg-gradient-to-r from-blue-600/90 to-sky-500/90  border-t-4 border-blue-500">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Edit Funfact</h1>
                    <p class="text-cyan-100 font-medium">Perbarui informasi fakta menarik</p>
                </div>
                <div class="mt-4 md:mt-0 flex space-x-3">
                    <a href="{{ route('funfacts.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded-lg transition duration-300 flex items-center shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    <a href="{{ route('funfacts.show', $funfact) }}" class="bg-gradient-to-r from-blue-500 to-teal-600 hover:from-blue-600 hover:to-teal-700 text-white py-2 px-4 rounded-lg transition duration-300 flex items-center shadow-md" target="_blank">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Pratinjau
                    </a>
                </div>
            </div>
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-blue-400/30 animate-wave opacity-60"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/30 animate-wave-slow opacity-40 delay-150"></div>
        </div>

        <div class="relative bg-white/90 backdrop-blur-sm shadow-lg rounded-2xl overflow-hidden border-t-4 border-teal-500 animate-fade-in-up">
            <form action="{{ route('admin.funfacts.update', $funfact) }}" method="POST" enctype="multipart/form-data" class="p-6 relative z-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
                    <div class="col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <div class="relative">
                            <input type="text" name="judul" id="judul" value="{{ old('judul', $funfact->judul) }}"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <div class="relative">
                            <textarea name="deskripsi" id="deskripsi" rows="5"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>{{ old('deskripsi', $funfact->deskripsi) }}</textarea>
                        </div>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    @if($funfact->gambar)
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                        <div class="mt-1 relative group">
                            <div class="bg-gradient-to-r p-1 from-blue-500 via-teal-500 to-cyan-500 rounded-lg shadow-md">
                                <div class="bg-white rounded-md overflow-hidden">
                                    <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}" class="w-full h-64 object-cover">
                                </div>
                            </div>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" name="remove_image" id="remove_image" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="remove_image" class="ml-2 block text-sm text-gray-700">Hapus gambar ini</label>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Image Upload -->
                  <div class="col-span-2">
    <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $funfact->gambar ? 'Ubah Gambar' : 'Unggah Gambar' }} (Opsional)
    </label>
    <div class="mt-1">
        <div class="relative bg-gradient-to-r from-blue-50 to-teal-50 border border-gray-300 rounded-lg px-3 py-3 shadow-sm hover:bg-gradient-to-r hover:from-blue-100 hover:to-teal-100 transition-all duration-300">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="h-6 w-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <label for="gambar" class="text-gray-700 text-sm font-medium cursor-pointer">
                        Pilih file gambar
                    </label>
                </div>
                <span id="file-name" class="text-sm text-blue-600 font-medium truncate max-w-xs">
                    Belum ada file dipilih
                </span>
            </div>
            <input type="file" name="gambar" id="gambar" accept="image/*"
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                onchange="displayFileName(this)">
        </div>
    </div>
    <p class="mt-1 text-xs text-gray-500">PNG, JPG, atau GIF maksimal 2MB</p>
    @error('gambar')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
    <div id="image-preview" class="mt-3"></div>
</div>

                    <!-- Animation Order -->
                    <div class="col-span-1">
                        <label for="urutan_animasi" class="block text-sm font-medium text-gray-700 mb-1">Urutan Animasi</label>
                        <div class="relative">
                            <input type="number" name="urutan_animasi" id="urutan_animasi" value="{{ old('urutan_animasi', $funfact->urutan_animasi) }}" min="1"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                            </div>
                        </div>
                        @error('urutan_animasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Related Article -->
                    <div class="col-span-1">
                        <label for="article_id" class="block text-sm font-medium text-gray-700 mb-1">Artikel Terkait (Opsional)</label>
                        <div class="relative">
                            <select name="article_id" id="article_id"
                                class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Tidak Ada</option>
                                @foreach($articles as $article)
                                    <option value="{{ $article->article_id }}" {{ (old('article_id', $funfact->article_id) == $article->article_id) ? 'selected' : '' }}>
                                        {{ $article->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('article_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Highlighted Status -->
                    <div class="col-span-2">
                        <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-teal-50 rounded-lg border border-blue-100">
                            <input type="checkbox" name="is_highlighted" id="is_highlighted" value="1" {{ old('is_highlighted', $funfact->is_highlighted) ? 'checked' : '' }}
                                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_highlighted" class="ml-2 block">
                                <span class="text-sm font-medium text-gray-700">Tandai sebagai Funfact Unggulan</span>
                                <p class="text-xs text-gray-500 mt-1">Funfact unggulan akan ditampilkan secara menonjol di halaman beranda</p>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Last Updated Info -->
                <div class="mt-8 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="flex items-center text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Terakhir diperbarui: {{ $funfact->updated_at->format('d M Y \p\u\k\u\l H:i') }}

                        @if($funfact->user)
                        <span class="mx-2">|</span>
                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Oleh: {{ $funfact->user->name }}
                        @endif
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-200 pt-6 flex justify-between">
                    <button type="button" onclick="confirmDelete()" class="bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white py-2 px-6 rounded-lg shadow-md transition-all duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Funfact
                    </button>
                    <div class="flex space-x-3">
                        <button type="button" onclick="window.history.back()" class="bg-white py-2 px-6 border border-gray-300 rounded-lg shadow-sm text-gray-700 hover:bg-gray-50 transition-all duration-300 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </button>
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-600 hover:from-blue-600 hover:to-teal-700 text-white py-2 px-6 rounded-lg shadow-md transition-all duration-300 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Perbarui Funfact
                        </button>
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
</div>

@endsection
@section('styles')
<style>
@keyframes wave {
  0% {
    transform: translateX(-100%) translateZ(0) scaleY(1);
  }
  50% {
    transform: translateX(-30%) translateZ(0) scaleY(0.8);
  }
  100% {
    transform: translateX(0) translateZ(0) scaleY(1);
  }
}

@keyframes wave-slow {
  0% {
    transform: translateX(0) translateZ(0) scaleY(1);
  }
  50% {
    transform: translateX(-50%) translateZ(0) scaleY(0.8);
  }
  100% {
    transform: translateX(-100%) translateZ(0) scaleY(1);
  }
}

@keyframes fade-in-up {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-wave {
  animation: wave 8s linear infinite;
}

.animate-wave-slow {
  animation: wave-slow 12s linear infinite;
}

.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out;
}

.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(83, 157, 196) 0%, rgb(65, 120, 183) 100%);
}

.absolute.inset-0.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(109, 176, 214) 0%, rgb(52, 149, 190) 100%);
    opacity: 0.9 !important; /* Increase opacity */
}

/* Add shimmer effect to the background */
.bg-gradient-to-r.min-h-screen::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        45deg,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.03) 50%,
        rgba(255, 255, 255, 0) 100%
    );
    background-size: 200% 200%;
    animation: shimmer 10s infinite ease-in-out;
    pointer-events: none;
    z-index: 2;
}

</style>
@endsection
@section('scripts')
<script>
       document.addEventListener('DOMContentLoaded', function() { // Preview image on upload
      window.displayFileName = function(input) {
        const fileNameElement = document.getElementById('file-name');
        const preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Display file name
            const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Convert to MB
            fileNameElement.textContent = `${file.name} (${fileSize}MB)`;
            fileNameElement.classList.add('text-blue-700', 'font-semibold');

            // Create image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="bg-gradient-to-r p-2 from-blue-500 via-teal-500 to-cyan-500 rounded-lg shadow-lg">
                        <div class="relative bg-white rounded-md overflow-hidden">
                            <img src="${e.target.result}" alt="Pratinjau gambar" class="w-full h-64 object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white px-3 py-1.5">
                                <p class="text-sm truncate font-medium">${file.name}</p>
                                <p class="text-xs">${fileSize} MB</p>
                            </div>
                            <button type="button" id="remove-image" class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-sm transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;

                // Add event listener to remove button
                document.getElementById('remove-image').addEventListener('click', function() {
                    input.value = '';
                    preview.innerHTML = '';
                    fileNameElement.textContent = 'Belum ada file dipilih';
                    fileNameElement.classList.remove('text-blue-700', 'font-semibold');
                });
            };

            reader.readAsDataURL(file);
        } else {
            fileNameElement.textContent = 'Belum ada file dipilih';
            fileNameElement.classList.remove('text-blue-700', 'font-semibold');
            preview.innerHTML = '';
        }
    };

    // Confirm delete function
    window.confirmDelete = function() {
        if (confirm('Apakah Anda yakin ingin menghapus funfact ini? ')) {
            document.getElementById('delete-form').submit();
        }
    };

     const bgElement = document.querySelector('.bg-gradient-to-r.min-h-screen');
        bgElement.classList.add('animate-shimmer');

        // Add wave animation to the header section
        const headerWave = document.querySelector('.absolute.inset-0.bg-gradient-to-r.from-sky-300.to-blue-400');
        headerWave.classList.add('animate-wave');

    });

    // Confirm delete function
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus funfact ini? ')) {
            document.getElementById('delete-form').submit();
        }
    }


</script>
@endsection
