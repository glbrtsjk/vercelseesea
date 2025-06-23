
@extends('layouts.app')

@section('title', 'Buat Komunitas')

@section('content')
@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-100 to-teal-50 py-12 relative overflow-hidden">
    <!-- Elemen Latar Belakang Laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/10 via-blue-600/10 to-teal-700/20"></div>
        <div class="ocean-bubbles absolute inset-0 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Header Halaman dengan Banner Animasi -->
        <div class="bg-gradient-to-r from-blue-500 via-blue-900 to-teal-900 rounded-2xl shadow-xl mb-8 relative overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="bg-scroll-right absolute inset-0 bg-cover bg-no-repeat opacity-20" style="background-image: url('{{ asset('home/community.jpg') }}');"></div>
                <div class="deep-sea-bubbles opacity-30"></div>
                <div class="marine-light-rays"></div>
                <div class="floating-particles absolute inset-0"></div>
                <div class="wave-pattern absolute bottom-0 left-0 w-full h-20 opacity-30"></div>
            </div>

            <div class="relative z-10 px-8 py-10">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <div class="inline-flex items-center bg-white/15 backdrop-blur-md rounded-full px-4 py-2 mb-4 border border-white/20">
                            <div class="w-3 h-3 bg-cyan-300 rounded-full mr-3 animate-pulse"></div>
                            <span class="text-cyan-50 text-sm font-medium">Membuat Komunitas Baru</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Buat Komunitas Kelautan</h1>
                        <p class="text-cyan-100 max-w-xl">
                            Luncurkan komunitas konservasi laut Anda dan terhubung dengan para pecinta laut di seluruh dunia.
                        </p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30 transform rotate-6 relative overflow-hidden">
                            <div class="absolute inset-0 opacity-30 marine-light-rays"></div>
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemisah Gelombang -->
            <div class="absolute bottom-0 left-0 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" class="w-full h-auto">
                    <path fill="#f0fdff" fill-opacity="1" d="M0,64L48,58.7C96,53,192,43,288,37.3C384,32,480,32,576,42.7C672,53,768,75,864,74.7C960,75,1056,53,1152,42.7C1248,32,1344,32,1392,32L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>

        <!-- Timeline Kemajuan -->
        <div class="max-w-4xl mx-auto mb-8">
            <div class="flex justify-between items-center">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-lg shadow-blue-500/30">1</div>
                    <span class="text-sm font-medium text-blue-800 mt-2">Detail</span>
                </div>
                <div class="h-1 flex-grow bg-gradient-to-r from-blue-600 to-blue-300 rounded-full mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-200 text-blue-700 flex items-center justify-center font-bold">2</div>
                    <span class="text-sm font-medium text-blue-800 mt-2">Anggota</span>
                </div>
                <div class="h-1 flex-grow bg-blue-200 rounded-full mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-200 text-blue-700 flex items-center justify-center font-bold">3</div>
                    <span class="text-sm font-medium text-blue-800 mt-2">Publikasi</span>
                </div>
            </div>
        </div>

        <!-- Formulir Utama -->
        <div class="max-w-4xl mx-auto mb-10">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-blue-100">
                <form action="{{ route('admin.communities.store') }}" method="POST" enctype="multipart/form-data" class="relative">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="absolute top-0 right-0 mt-6 mr-6">
                        <a href="{{ route('admin.communities.index') }}" class="flex items-center text-gray-500 hover:text-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span class="ml-1 text-sm">Batal</span>
                        </a>
                    </div>

                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Detail Komunitas</h3>

                        <!-- Nama Komunitas -->
                        <div class="mb-8">
                            <label for="nama_komunitas" class="block text-sm font-medium text-gray-700 mb-1">Nama Komunitas</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <input type="text"
                                    class="block w-full pl-12 pr-6 py-4 rounded-xl text-gray-800 bg-white/80 backdrop-blur-sm border-0 ring-2 ring-blue-100 focus:ring-4 focus:ring-blue-400 focus:outline-none transition-all duration-300 text-lg"
                                    id="nama_komunitas"
                                    name="nama_komunitas"
                                    placeholder="contoh: Jaringan Pelindung Terumbu Karang"
                                    value="{{ old('nama_komunitas') }}"
                                    required>
                            </div>
                            @error('nama_komunitas')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">Pilih nama yang jelas dan mudah diingat yang mencerminkan fokus komunitas Anda.</p>
                        </div>

                        <!-- Deskripsi Komunitas -->
                        <div class="mb-8">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <div class="relative">
                                <textarea
                                    class="block w-full p-4 rounded-xl text-gray-800 bg-white/80 backdrop-blur-sm border-0 ring-2 ring-blue-100 focus:ring-4 focus:ring-blue-400 focus:outline-none transition-all duration-300 "
                                    id="deskripsi"
                                    name="deskripsi"
                                    rows="6"
                                    placeholder="Ceritakan tentang misi dan tujuan komunitas Anda..."
                                    required>{{ old('deskripsi') }}</textarea>
                            </div>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">Jelaskan misi, tujuan, dan isu-isu kelautan yang akan menjadi fokus komunitas Anda.</p>
                        </div>

                        <!-- Gambar Komunitas -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Komunitas</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-blue-200 rounded-xl hover:border-blue-400 transition-colors">
                                <div class="space-y-4 text-center" id="dropzone-container">
                                    <svg class="mx-auto h-16 w-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div class="flex flex-col items-center">
                                        <p class="text-gray-600">Tarik dan lepas gambar atau</p>
                                        <label for="gambar" class="mt-2 cursor-pointer rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none">
                                            <span>Pilih file</span>
                                            <input id="gambar" name="gambar" type="file" accept="image/*" class="sr-only" onChange="showPreview(this)">
                                        </label>
                                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, GIF (maks 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Pratinjau Gambar -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <div class="relative group">
                                    <img src="#" alt="Pratinjau" class="w-full h-48 object-cover rounded-xl shadow-md">
                                    <div class="absolute inset-0 bg-black/50 group-hover:opacity-100 opacity-0 transition-opacity duration-300 rounded-xl flex items-center justify-center">
                                        <button type="button" onclick="removeImage()" class="bg-red-600 text-white p-2 rounded-full hover:bg-red-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @error('gambar')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Bagian Inisiatif -->
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-8 border-t border-blue-100">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-400 to-blue-600 flex items-center justify-center shadow-md text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Inisiatif Komunitas</h3>
                        </div>
                        <p class="text-gray-600 mb-6">Tambahkan inisiatif konservasi atau kegiatan komunitas untuk menampilkan fokus utama komunitas Anda.</p>

                        <div id="initiatives-container" class="space-y-6">
                            <!-- Inisiatif Pertama (Default) -->
                            <div class="initiative-item bg-white rounded-xl shadow-md p-5 border border-blue-50 transform transition-all hover:scale-[1.01]">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="initiative-number font-bold text-blue-700 flex items-center">
                                        <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs mr-2">1</span>
                                        Inisiatif #1
                                    </h4>
                                    <button type="button" class="text-gray-400 hover:text-gray-600 cursor-not-allowed opacity-50 remove-initiative" disabled>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <!-- Bidang Judul -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                                        <input type="text"
                                            name="initiatives[0][judul]"
                                            class="w-full px-4 py-2 rounded-lg border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            placeholder="contoh: Perlindungan Terumbu Karang"
                                            required>
                                    </div>
                                    <!-- Pilihan Ikon -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                                        <div class="relative">
                                            <select name="initiatives[0][icon]"
                                                class="w-full appearance-none px-4 py-2 pr-10 rounded-lg border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                                <option value="air" data-image="{{ asset('icon/waterdrop.png') }}"">Air</option>
                                                <option value="ikan" data-image="{{ asset('icon/fish.png') }}"">Ikan</option>
                                                <option value="terumbuhkarang" data-image="{{ asset('icon/coral-reef.png') }}">Terumbuh Karang</option>
                                                <option value="alga" data-image="{{ asset('icon/seaweed.png') }} ">Alga</option><option value="plankton" data-image="{{ asset('icon/plankton.png') }}">Alga dan Plankphpton</option>
                                                <option value="limbahlaut" data-image="{{ asset('icon/water-polution.png') }} ">Limbah Laut</option>
                                                <option value="hewanlangkah" data-image="{{ asset('atorage/icon/seaanimal.png') }}">Hewan Langkah</option>
                                                <option value="lautdalam data-image="{{ asset('icon/sea.png') }}">Laut Dalam</option>
                                                <option value="custom-pesisir" data-image="{{ asset('icon/beach.png') }}">Pesisir</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bidang Deskripsi -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                    <textarea
                                        name="initiatives[0][deskripsi]"
                                        class="w-full px-4 py-2 rounded-lg border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                        rows="2"
                                        placeholder="Deskripsi singkat tentang inisiatif ini"
                                        required></textarea>
                                </div>

                                <input type="hidden" name="initiatives[0][prioritas]" value="0" class="initiative-prioritas">
                            </div>
                        </div>

                        <!-- Tombol Tambah Inisiatif -->
                        <button type="button" id="add-initiative" class="mt-4 px-5 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white rounded-xl flex items-center gap-2 shadow-md hover:shadow-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Inisiatif Lain
                        </button>
                    </div>

                    <!-- Footer Pengiriman Formulir -->
                    <div class="p-8 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <a href="{{ route('admin.communities.index') }}" class="px-6 py-3 bg-white border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Batal
                        </a>
                        <div>
                            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl font-medium shadow-md hover:shadow-lg transition-all duration-300 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Buat Komunitas
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Kotak Tips & Panduan -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-100 shadow-md">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-2">Tips untuk Membuat Komunitas Sukses</h4>
                        <ul class="space-y-2 text-gray-600 text-sm">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Spesifik</strong> tentang misi dan tujuan komunitas Anda</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Unggah gambar menarik</strong> yang mewakili fokus komunitas Anda</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Tambahkan beberapa inisiatif</strong> untuk menunjukkan keberagaman kegiatan komunitas</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Animasi Latar Belakang Laut */
.marine-light-rays {
    background: linear-gradient(45deg,
        transparent 30%,
        rgba(120, 220, 255, 0.08) 40%,
        rgba(120, 220, 255, 0.04) 50%,
        transparent 60%
    );
    background-size: 300px 300px;
    animation: lightRaysMove 20s ease-in-out infinite;
}

.ocean-bubbles {
    background-image:
        radial-gradient(circle at 90% 10%, rgba(255, 255, 255, 0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.7) 1px, transparent 1px),
        radial-gradient(circle at 30% 80%, rgba(255, 255, 255, 0.6) 0.8px, transparent 0.8px);
    background-size: 100px 100px;
    animation: bubbleRise 25s linear infinite;
}

.floating-particles {
    background-image:
        radial-gradient(circle at 10% 20%, rgba(34, 211, 238, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 30% 60%, rgba(59, 130, 246, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 70% 90%, rgba(20, 184, 166, 0.1) 1px, transparent 1px);
    background-size: 80px 80px;
    animation: particleMove 20s linear infinite;
}

/* Keyframes Animasi */
@keyframes lightRaysMove {
    0%, 100% {
        transform: translateX(-100px) translateY(-100px) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateX(100px) translateY(100px) rotate(15deg);
        opacity: 0.8;
    }
}

@keyframes bubbleRise {
    0% { background-position: 0 100%; }
    100% { background-position: 100px 0; }
}

@keyframes particleMove {
    0% {
        background-position: 0 0, 0 0, 0 0;
    }
    100% {
        background-position: 80px 80px, -120px 120px, 100px -100px;
    }
}

/* Perbaikan Form dan UI */
.initiative-item {
    transition: all 0.3s ease;
}

.initiative-item:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

#dropzone-container {
    transition: all 0.3s ease;
}

#dropzone-container:hover {
    transform: translateY(-2px);
}

/* Spinner untuk pengiriman formulir */
.spinner {
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top: 3px solid white;
    width: 20px;
    height: 20px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Penyesuaian responsif */
@media (max-width: 768px) {
    .initiative-item .grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('initiatives-container');
        const addButton = document.getElementById('add-initiative');
        let initiativeCount = 1;

        // Menangani zona drop file
        const dropzone = document.getElementById('dropzone-container');
        const fileInput = document.getElementById('gambar');

        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropzone.classList.add('bg-blue-50');
        });

        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropzone.classList.remove('bg-blue-50');
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('bg-blue-50');

            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                showPreview(fileInput);
            }
        });

        // Tambah inisiatif baru
        addButton.addEventListener('click', function() {
            const newInitiative = document.createElement('div');
            newInitiative.className = 'initiative-item bg-white rounded-xl shadow-md p-5 border border-blue-50 transform transition-all hover:scale-[1.01] animate-fade-in';
            newInitiative.innerHTML = `
                <div class="flex justify-between items-center mb-4">
                    <h4 class="initiative-number font-bold text-blue-700 flex items-center">
                        <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs mr-2">${initiativeCount + 1}</span>
                        Inisiatif #${initiativeCount + 1}
                    </h4>
                    <button type="button" class="text-gray-400 hover:text-red-600 remove-initiative transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <!-- Bidang Judul -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text"
                            name="initiatives[${initiativeCount}][judul]"
                            class="w-full px-4 py-2 rounded-lg border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="contoh: Perlindungan Terumbu Karang"
                            required>
                    </div>
                    <!-- Pilihan Ikon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                        <div class="relative">
                            <select name="initiatives[${initiativeCount}][icon]"
                                class="w-full appearance-none px-4 py-2 pr-10 rounded-lg border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="fas fa-water">Air</option>
                                <option value="fas fa-fish">Ikan</option>
                                <option value="fas fa-leaf">Daun</option>
                                <option value="fas fa-recycle">Daur Ulang</option>
                                <option value="fas fa-seedling">Bibit</option>
                                <option value="fas fa-globe-americas">Bumi</option>
                                <option value="fas fa-hands-helping">Tangan Membantu</option>
                                <option value="fas fa-book">Pendidikan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bidang Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea
                        name="initiatives[${initiativeCount}][deskripsi]"
                        class="w-full px-4 py-2 rounded-lg border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        rows="2"
                        placeholder="Deskripsi singkat tentang inisiatif ini"
                        required></textarea>
                </div>

                <input type="hidden" name="initiatives[${initiativeCount}][prioritas]" value="${initiativeCount}" class="initiative-prioritas">
            `;

            // Tambahkan dengan animasi
            container.appendChild(newInitiative);
            setTimeout(() => {
                newInitiative.classList.add('opacity-100');
            }, 10);

            initiativeCount++;

            // Aktifkan tombol hapus inisiatif pertama jika sekarang memiliki beberapa inisiatif
            if (initiativeCount > 1) {
                const firstInitiativeRemoveBtn = container.querySelector('.remove-initiative');
                if (firstInitiativeRemoveBtn) {
                    firstInitiativeRemoveBtn.disabled = false;
                    firstInitiativeRemoveBtn.classList.remove('cursor-not-allowed', 'opacity-50');
                    firstInitiativeRemoveBtn.classList.add('hover:text-red-600');
                }
            }
        });

        // Hapus inisiatif dengan delegasi event
        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-initiative')) {
                const button = e.target.closest('.remove-initiative');
                const initiativeItem = button.closest('.initiative-item');

                // Animasi penghapusan
                initiativeItem.classList.add('opacity-0', 'scale-95');
                initiativeItem.style.height = initiativeItem.offsetHeight + 'px';

                setTimeout(() => {
                    initiativeItem.style.height = '0';
                    initiativeItem.style.margin = '0';
                    initiativeItem.style.padding = '0';
                    initiativeItem.style.overflow = 'hidden';

                    setTimeout(() => {
                        initiativeItem.remove();
                        initiativeCount--;

                        // Nonaktifkan tombol hapus inisiatif pertama jika hanya tersisa satu
                        if (initiativeCount === 1) {
                            const firstInitiativeRemoveBtn = container.querySelector('.remove-initiative');
                            if (firstInitiativeRemoveBtn) {
                                firstInitiativeRemoveBtn.disabled = true;
                                firstInitiativeRemoveBtn.classList.add('cursor-not-allowed', 'opacity-50');
                                firstInitiativeRemoveBtn.classList.remove('hover:text-red-600');
                            }
                        }

                        // Perbarui nomor inisiatif dan indeks ulang bidang formulir
                        updateInitiativeNumbers();
                        reindexFormFields();
                    }, 300);
                }, 100);
            }
        });

        // Perbarui nomor inisiatif
        function updateInitiativeNumbers() {
            const initiatives = container.querySelectorAll('.initiative-item');
            initiatives.forEach((item, index) => {
                const numberElement = item.querySelector('.initiative-number');
                const bulletNumber = item.querySelector('.initiative-number span');
                if (numberElement) {
                    numberElement.innerHTML = `
                        <span class="w-6 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs mr-2">${index + 1}</span>
                        Inisiatif #${index + 1}
                    `;
                }
            });
        }

        // Indeks ulang bidang formulir
        function reindexFormFields() {
            const initiatives = container.querySelectorAll('.initiative-item');
            initiatives.forEach((item, index) => {
                const inputs = item.querySelectorAll('input, textarea, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/initiatives\[\d+\]/, `initiatives[${index}]`));
                    }
                });

                const orderInput = item.querySelector('.initiative-prioritas');
                if (orderInput) {
                    orderInput.value = index;
                }
            });
        }

        // Inisialisasi ClassicEditor dengan konfigurasi kustom jika tersedia
        if (typeof ClassicEditor !== 'undefined' && document.getElementById('deskripsi')) {
            ClassicEditor
                .create(document.getElementById('deskripsi'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'undo', 'redo'],
                    placeholder: 'Ceritakan tentang misi dan tujuan komunitas Anda...'
                })
                .catch(error => {
                    console.error(error);
                });
        }

        // Status loading pengiriman formulir
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function() {
            // Tampilkan status loading
            submitButton.innerHTML = `
                <div class="spinner mr-2"></div>
                Membuat...
            `;
            submitButton.disabled = true;
        });
    });

    // Fungsi pratinjau gambar
    function showPreview(input) {
        const preview = document.getElementById('imagePreview');
        const dropzone = document.getElementById('dropzone-container');
        const previewImg = preview.querySelector('img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
                dropzone.classList.add('hidden');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Hapus gambar
    function removeImage() {
        const preview = document.getElementById('imagePreview');
        const dropzone = document.getElementById('dropzone-container');
        const fileInput = document.getElementById('gambar');

        preview.classList.add('hidden');
        dropzone.classList.remove('hidden');
        fileInput.value = '';
    }
</script>
@endsection
