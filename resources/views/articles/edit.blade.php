@extends('layouts.app')

@section('title', 'Edit Artikel Konservasi Laut')

@section('content')
<!-- layouts seperti laut dalam -->
<section class="bg-gradient-to-br from-blue-800 via-blue-900 to-teal-900 text-white py-35 relative overflow-hidden ">
    <!-- Underwater texture pattern -->
    <div class="absolute inset-0 underwater-pattern opacity-20"></div>

    <!-- animasi cahaya didalam laut -->
    <div class="absolute inset-0">
        <div class="light-ray light-ray-1"></div>
        <div class="light-ray light-ray-2"></div>
    </div>

    <!-- partikel bawah laut dan gelembung-->
    <div class="floating-particles absolute inset-0"></div>
    <div class="absolute inset-0 bubble-container">
        <div class="animated-bubble size-lg delay-2"></div>
        <div class="animated-bubble size-md delay-4"></div>
        <div class="animated-bubble size-sm delay-1"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-6 fade-in-up">
            <!-- Badge Status -->
            <div class="inline-flex items-center bg-white/15 backdrop-blur-md rounded-full px-6 py-2 mb-4 animate-on-scroll border border-white/20">
                <div class="w-3 h-3 bg-cyan-300 rounded-full mr-3 animate-pulse"></div>
                <span class="text-cyan-100 font-medium">Perbarui Konten Konservasi</span>
            </div>

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 underwater-text-effect">
                Edit <span class="gradient-text-enhanced">Artikel Konservasi</span>
            </h1>
            <p class="text-lg text-cyan-100 max-w-2xl mx-auto">
                Perbarui artikel "{{ $article->judul }}" untuk terus berkontribusi dalam pengetahuan konservasi laut
            </p>
        </div>
    </div>

    <!-- Wave Separator -->
   <div class="absolute bottom-0 left-0 w-full">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
        <defs>
            <linearGradient id="waveGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                <stop offset="0%" style="stop-color:#54e4fd;stop-opacity:0.3" />
                <stop offset="50%" style="stop-color:#69e1ff;stop-opacity:0.2" />
                <stop offset="100%" style="stop-color:#6fd6f3;stop-opacity:0.3" />
            </linearGradient>
        </defs>
        <path fill="url(#waveGradient)"
              d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,208C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
        <path fill="#f0fdff" fill-opacity="0.9"
              d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,208C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
</div>
</section>

<!-- Article Form Content -->
<section class="py-12 bg-gradient-to-b from-cyan-50 via-white to-blue-50 relative">
    <!-- Subtle background animations -->
    <div class="absolute inset-0 z-0">
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-10"></div>
        <div class="floating-particles absolute inset-0 opacity-20"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Form Card -->
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-cyan-100 p-6 md:p-8 hover-lift mb-10">
                <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg shadow">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">Harap perbaiki kesalahan berikut:</span>
                            </div>
                            <ul class="list-disc pl-10 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Title -->
                    <div>
                        <label for="judul" class="block text-gray-800 font-medium mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                            Judul Artikel
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $article->judul) }}"
                            class="w-full border-cyan-200 focus:border-cyan-500 focus:ring focus:ring-cyan-200 rounded-xl shadow-sm transition-all duration-300"
                            placeholder="Buat judul yang menarik tentang konservasi laut" required>
                        <p class="text-sm text-gray-500 mt-1">
                            Judul yang baik akan menarik perhatian pembaca dan menjelaskan topik utama artikel
                        </p>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-gray-800 font-medium mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Kategori Konservasi
                        </label>
                        <div class="relative">
                            <select name="category_id" id="category_id"
                                class="w-full border-cyan-200 focus:border-cyan-500 focus:ring focus:ring-cyan-200 rounded-xl shadow-sm appearance-none transition-all duration-300"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" {{ old('category_id', $article->category_id) == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            Pilih kategori yang paling sesuai dengan topik artikel Anda
                        </p>
                    </div>

                    <!-- Tags -->
                    <div>
                        <label class="block text-gray-800 font-medium mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                            Tag Konservasi
                        </label>
                        <div class="border border-cyan-200 rounded-xl p-4 max-h-60 overflow-y-auto bg-white/50 backdrop-blur-sm shadow-inner">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @php
                                    $articleTags = $article->tags->pluck('tag_id')->toArray();
                                @endphp

                                @foreach($tags as $tag)
                                    <div class="flex items-center bg-white/80 p-2 rounded-lg hover:bg-cyan-50 transition-all duration-300 border border-cyan-100">
                                        <input type="checkbox" name="tags[]" id="tag-{{ $tag->tag_id }}" value="{{ $tag->tag_id }}"
                                               class="rounded-md border-cyan-300 text-cyan-600 shadow-sm focus:border-cyan-300 focus:ring focus:ring-cyan-200 focus:ring-opacity-50 transition-all duration-300"
                                               {{ (is_array(old('tags')) && in_array($tag->tag_id, old('tags'))) ||
                                                  (!old('tags') && in_array($tag->tag_id, $articleTags)) ? 'checked' : '' }}>
                                        <label for="tag-{{ $tag->tag_id }}" class="ml-2 text-sm text-gray-700 cursor-pointer select-none">
                                            {{ $tag->nama_tag }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            Pilih tag yang relevan untuk membantu pembaca menemukan artikel Anda
                        </p>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="konten_isi_artikel" class="block text-gray-800 font-medium mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Konten Artikel
                        </label>
                        <textarea name="konten_isi_artikel" id="konten_isi_artikel" rows="12"
                            class="w-full border-cyan-200 focus:border-cyan-500 focus:ring focus:ring-cyan-200 rounded-xl shadow-sm transition-all duration-300"
                            placeholder="Tulis artikel konservasi laut Anda di sini..." required>{{ old('konten_isi_artikel', $article->konten_isi_artikel) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">
                            Berikan informasi yang akurat, bermanfaat, dan relevan dengan tema konservasi laut
                        </p>
                    </div>

                    <!-- Current Image -->
                    @if($article->gambar)
                        <div>
                            <label class="block text-gray-800 font-medium mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Gambar Saat Ini
                            </label>
                            <div class="mt-2">
                                <div class="h-40 w-full sm:w-80 rounded-xl overflow-hidden bg-gradient-to-br from-blue-100 via-cyan-100 to-teal-100 shadow-md border border-cyan-200">
                                    <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div>
                        <label for="gambar" class="block text-gray-800 font-medium mb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $article->gambar ? 'Ganti Gambar' : 'Tambah Gambar' }}
                        </label>
                        <div class="mt-2 flex flex-col sm:flex-row items-center gap-4">
                            <div class="w-full sm:w-auto">
                                <div class="h-32 w-full sm:w-48 rounded-xl overflow-hidden bg-gradient-to-br from-blue-100 via-cyan-100 to-teal-100 flex items-center justify-center shadow-md relative border-2 border-dashed border-cyan-300">
                                    <div id="image-preview" class="absolute inset-0 bg-cover bg-center"></div>
                                    <svg id="placeholder-icon" class="h-16 w-16 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-grow">
                                <label class="block">
                                    <span class="sr-only">Pilih gambar</span>
                                    <div class="relative">
                                        <input type="file" name="gambar" id="gambar" accept="image/*"
                                            class="absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10"
                                            onchange="updateFileName(this)">
                                        <button type="button"
                                            class="w-full sm:w-auto flex items-center justify-center px-6 py-3 rounded-xl
                                            bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-medium
                                            hover:from-cyan-600 hover:to-blue-700 transition-all duration-300 shadow-md">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            Pilih Gambar
                                        </button>
                                        <p id="file-name" class="mt-2 text-sm text-gray-600">Belum ada file yang dipilih</p>
                                    </div>
                                </label>
                                <p class="text-sm text-gray-500 mt-2">
                                    Unggah gambar utama untuk artikel (JPG, PNG, JPEG - maks. 2MB). Gambar yang menarik akan meningkatkan daya tarik artikel Anda.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Options & Publishing Information -->
                    @if(Auth::user()->isAdmin())
                        <div class="p-6 bg-gradient-to-r from-amber-50 to-yellow-50 rounded-xl shadow-inner border border-amber-200">
                            <h3 class="text-lg font-medium text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Opsi Admin
                            </h3>
                            <div class="mb-4">
                                <label for="status" class="block text-gray-700 font-medium mb-2">Status Artikel</label>
                                <div class="relative">
                                    <select name="status" id="status" class="w-full border-amber-200 focus:border-amber-500 focus:ring focus:ring-amber-200 focus:ring-opacity-50 rounded-xl shadow-sm appearance-none">
                                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draf</option>
                                        <option value="pending" {{ old('status', $article->status) == 'pending' ? 'selected' : '' }}>Menunggu Review</option>
                                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Dipublikasi</option>
                                        <option value="rejected" {{ old('status', $article->status) == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center mb-4 bg-white/70 p-3 rounded-lg">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                    class="rounded-md border-amber-300 text-amber-600 shadow-sm focus:border-amber-300 focus:ring focus:ring-amber-200 focus:ring-opacity-50 transition-all duration-300"
                                    {{ $article->is_featured ? 'checked' : '' }}>
                                <label for="is_featured" class="ml-2 text-gray-700">Jadikan artikel unggulan</label>
                            </div>
                            <p class="text-sm text-gray-600 bg-white/50 p-3 rounded-lg">
                                Sebagai administrator, Anda dapat langsung mempublikasikan atau menjadikan artikel ini sebagai konten unggulan pada halaman utama.
                            </p>
                        </div>
                    @else
                        <div class="p-6 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl shadow-inner border border-blue-200">
                            <h3 class="text-lg font-medium text-gray-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Informasi Publikasi
                            </h3>
                            <p class="text-gray-600 bg-white/70 p-4 rounded-lg">
                                Artikel Anda akan ditinjau oleh administrator kami sebelum dipublikasikan. Setiap perubahan yang Anda buat akan memerlukan peninjauan ulang.
                            </p>

                            @if($article->status === 'rejected')
                                <div class="mt-4 p-4 bg-red-50/70 border border-red-200 rounded-xl">
                                    <h4 class="text-md font-medium text-red-800 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        Umpan Balik dari Administrator:
                                    </h4>
                                    <p class="text-gray-700 mt-2 bg-white/60 p-3 rounded-lg">
                                        {{ $article->rejection_reason ?? 'Tidak ada umpan balik spesifik yang diberikan. Silakan tinjau kembali konten artikel Anda untuk kualitas dan kepatuhan terhadap pedoman kami.' }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Submit Buttons -->
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-10 border-t border-cyan-100 pt-6">
                        <button type="button" onclick="confirmDelete()" class="w-full sm:w-auto bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-medium py-3 px-8 rounded-xl transition duration-300 shadow-md flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Artikel
                        </button>

                        <div class="flex flex-col sm:flex-row items-center gap-4">
                            <a href="{{ route('articles.index') }}" class="w-full sm:w-auto bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-8 rounded-xl transition duration-300 flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Batal
                            </a>
                            <button type="submit" class="w-full sm:w-auto bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-medium py-3 px-8 rounded-xl transition duration-300 shadow-lg hover:shadow-xl flex items-center justify-center group">
                                <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Perbarui Artikel
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

            <!-- Article Status Information -->
            <div class="bg-gradient-to-r from-cyan-50 to-blue-50 rounded-2xl overflow-hidden shadow-lg border border-cyan-100 hover-lift mb-6">
                <div class="bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Artikel
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-cyan-100">
                            <p class="text-sm text-gray-500">Dibuat pada</p>
                            <p class="font-medium text-gray-800">{{ $article->tgl_upload->format('d F Y') }}</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-cyan-100">
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="font-medium">
                                @if($article->status == 'published')
                                    <span class="text-green-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Dipublikasi
                                    </span>
                                @elseif($article->status == 'pending')
                                    <span class="text-amber-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Menunggu Review
                                    </span>
                                @elseif($article->status == 'rejected')
                                    <span class="text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Draf
                                    </span>
                                @endif
                            </p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-cyan-100">
                            <p class="text-sm text-gray-500">Penulis</p>
                            <p class="font-medium text-gray-800">{{ $article->user->nama }}</p>
                        </div>
                        <div class="bg-white/80 backdrop-blur-sm p-4 rounded-xl border border-cyan-100">
                            <p class="text-sm text-gray-500">URL Artikel</p>
                            <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-800 text-sm truncate block">{{ route('articles.show', $article) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated bubbles -->
    <div class="submarine-bubbles absolute bottom-0 left-0 right-0 top-0 pointer-events-none"></div>
</section>
@endsection

@section('styles')
<style>
/* Ocean Effects & Animations */
.underwater-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3z' fill='%23ffffff' fill-opacity='0.15' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.2;
    animation: underwater-drift 60s linear infinite;
}

@keyframes underwater-drift {
    0% { background-position: 0 0; }
    100% { background-position: 100px 100px; }
}

/* Light rays animation */
.light-ray {
    position: absolute;
    background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 75%);
    transform-origin: top center;
    width: 150px;
    height: 100%;
    border-radius: 50% 50% 0 0;
    opacity: 0;
    animation: light-ray-animation 12s infinite ease-in-out;
}

.light-ray-1 {
    left: 15%;
    animation-delay: 0s;
    transform: rotate(20deg);
}

.light-ray-2 {
    left: 75%;
    animation-delay: 4s;
    transform: rotate(-15deg);
}

@keyframes light-ray-animation {
    0%, 100% { opacity: 0; }
    25%, 75% { opacity: 0.5; }
    50% { opacity: 0.7; }
}

/* Floating particles */
.floating-particles {
    background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.2) 1px, transparent 1.5px),
        radial-gradient(circle, rgba(255, 255, 255, 0.15) 1px, transparent 1px),
        radial-gradient(circle, rgba(255, 255, 255, 0.1) 0.5px, transparent 0.5px);
    background-size: 50px 50px, 100px 100px, 30px 30px;
    background-position: 0 0, 25px 25px, 10px 10px;
    animation: particles-float 40s linear infinite;
}

@keyframes particles-float {
    0% { background-position: 0 0, 25px 25px, 10px 10px; }
    100% { background-position: 50px 50px, 125px 125px, 40px 40px; }
}

/* Animated bubbles */
.bubble-container {
    pointer-events: none;
    overflow: hidden;
}
.animated-bubble {
    position: absolute;
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0.1) 100%);
    border-radius: 50%;
    opacity: 0;
    animation: bubble-rise 15s ease-in infinite;
}

.animated-bubble.size-lg {
    width: 30px;
    height: 30px;
    left: 15%;
    bottom: -30px;
}

.animated-bubble.size-md {
    width: 20px;
    height: 20px;
    left: 40%;
    bottom: -20px;
}

.animated-bubble.size-sm {
    width: 15px;
    height: 15px;
    left: 70%;
    bottom: -15px;
}

.animated-bubble.delay-1 { animation-delay: 1s; }
.animated-bubble.delay-2 { animation-delay: 2s; }
.animated-bubble.delay-4 { animation-delay: 4s; }

@keyframes bubble-rise {
    0% {
        transform: translateY(0) rotate(0);
        opacity: 0;
    }
    10% {
        opacity: 0.8;
    }
    100% {
        transform: translateY(-100vh) rotate(20deg);
        opacity: 0;
    }
}

/* Enhanced Gradient Text */
.gradient-text-enhanced {
    background: linear-gradient(135deg, #10b981, #06b6d4, #3b82f6, #8b5cf6);
    background-size: 400% 400%;
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    animation: gradientShift 8s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Underwater Text Effect */
.underwater-text-effect {
    text-shadow:
        0 0 10px rgba(120, 220, 255, 0.3),
        0 0 20px rgba(120, 220, 255, 0.2),
        0 0 30px rgba(120, 220, 255, 0.1);
    animation: underwaterGlow 4s ease-in-out infinite alternate;
}

@keyframes underwaterGlow {
    0% {
        text-shadow:
            0 0 10px rgba(120, 220, 255, 0.3),
            0 0 20px rgba(120, 220, 255, 0.2),
            0 0 30px rgba(120, 220, 255, 0.1);
    }
    100% {
        text-shadow:
            0 0 15px rgba(120, 220, 255, 0.4),
            0 0 25px rgba(120, 220, 255, 0.3),
            0 0 35px rgba(120, 220, 255, 0.2);
    }
}

/* Fade-in animations */
.fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    animation: fade-in-up 0.8s ease-out forwards;
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover lift effect */
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Underwater current effect */
.underwater-current {
    background: linear-gradient(90deg,
        transparent,
        rgba(56, 189, 248, 0.03) 30%,
        rgba(6, 182, 212, 0.03) 40%,
        rgba(20, 184, 166, 0.03) 50%,
        transparent 70%
    );
    background-size: 200% 100%;
    animation: currentFlow 25s ease-in-out infinite;
}

@keyframes currentFlow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Ocean waves */
.ocean-waves {
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    background-repeat: no-repeat;
}

/* Submarine bubbles for subtle background effects */
.submarine-bubbles {
    overflow: hidden;
    opacity: 0.5;
}

.submarine-bubbles::before,
.submarine-bubbles::after {
    content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(6, 182, 212, 0.2);
    bottom: -10px;
    animation: submarine-bubble-rise 8s infinite ease-out;
}

.submarine-bubbles::before {
    left: 10%;
    animation-delay: 0s;
    animation-duration: 12s;
}

.submarine-bubbles::after {
    left: 80%;
    animation-delay: 4s;
    animation-duration: 10s;
    width: 15px;
    height: 15px;
}

@keyframes submarine-bubble-rise {
    0% {
        opacity: 0;
        transform: translate(0, 0) scale(0);
    }
    10% {
        opacity: 0.8;
        transform: translate(0, -30px) scale(1);
    }
    90% {
        opacity: 0.2;
    }
    100% {
        opacity: 0;
        transform: translate(0, -800px) scale(0.5);
    }
}

/* Add more bubbles */
.submarine-bubbles::before {
    box-shadow:
        120px 40px 0 -2px rgba(6, 182, 212, 0.1),
        280px -20px 0 -1px rgba(6, 182, 212, 0.15),
        400px 100px 0 0px rgba(6, 182, 212, 0.1),
        580px -80px 0 -3px rgba(6, 182, 212, 0.2),
        650px 95px 0 -1px rgba(6, 182, 212, 0.1),
        780px 120px 0 -2px rgba(6, 182, 212, 0.15);
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview functionality
    const input = document.getElementById('gambar');
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('placeholder-icon');

    input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.style.backgroundImage = `url('${e.target.result}')`;
                placeholder.style.display = 'none';
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    // Fungsi update nama file
    function updateFileName(input) {
        const fileNameDisplay = document.getElementById('file-name');
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Perbarui pratinjau gambar
                document.getElementById('image-preview').style.backgroundImage = `url('${e.target.result}')`;
                document.getElementById('placeholder-icon').style.display = 'none';

                // Perbarui teks nama file
                fileNameDisplay.textContent = input.files[0].name;
                fileNameDisplay.classList.add('text-cyan-600');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            fileNameDisplay.textContent = 'Belum ada file yang dipilih';
            fileNameDisplay.classList.remove('text-cyan-600');
        }
    }

    // Paparka fungsi updateFileName ke global scope
    window.updateFileName = updateFileName;

    // Gelembung animasi
    function createBubble() {
        const section = document.querySelector('section.py-12');
        const bubble = document.createElement('div');

        const size = Math.random() * 20 + 5;
        const left = Math.random() * 100;
        const animDuration = Math.random() * 6 + 8;
        const opacity = Math.random() * 0.3 + 0.1;

        bubble.style.cssText = `
            position: absolute;
            bottom: -${size}px;
            left: ${left}%;
            width: ${size}px;
            height: ${size}px;
            background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8), rgba(6,182,212,${opacity}));
            border-radius: 50%;
            z-index: 1;
            pointer-events: none;
            animation: float-up ${animDuration}s ease-in forwards;
        `;

        section.appendChild(bubble);

        setTimeout(() => {
            bubble.remove();
        }, animDuration * 1000);
    }

    // Buat gelembung secara berkala
    setInterval(createBubble, 2000);

    // Buat gelembung awal
    for (let i = 0; i < 10; i++) {
        setTimeout(createBubble, i * 300);
    }

    // Tambahkan animasi keyframe untuk gelembung
    if (!document.getElementById('bubble-style')) {
        const style = document.createElement('style');
        style.id = 'bubble-style';
        style.textContent = `
            @keyframes float-up {
                0% {
                    transform: translateY(0) translateX(0);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 0.5;
                }
                100% {
                    transform: translateY(-1000px) translateX(${Math.random() * 100 - 50}px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Fungsi konfirmasi hapus artikel
    window.confirmDelete = function() {
        if (confirm('Apakah Anda yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form').submit();
        }
    }

    // Tingkatkan elemen formulir dengan animasi halus
    document.querySelectorAll('input, select, textarea').forEach(element => {
        element.addEventListener('focus', function() {
            this.closest('div').classList.add('scale-105', 'transition-all', 'duration-300');
        });

        element.addEventListener('blur', function() {
            this.closest('div').classList.remove('scale-105');
        });
    });
});
</script>
@endsection
