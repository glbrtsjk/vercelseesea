@extends('layouts.app')

@section('title', 'Tambah Inisiatif - ' . $community->nama_komunitas)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-100 to-teal-50 relative overflow-hidden">
    <!-- Latar Belakang Animasi Laut yang Ditingkatkan -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/90 to-emerald-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 fade-in-up animate-on-scroll">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('success') }}</div>
                    <button type="button" class="text-white hover:text-white/80" data-bs-dismiss="alert" aria-label="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-500/90 to-rose-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 fade-in-up animate-on-scroll">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('error') }}</div>
                    <button type="button" class="text-white hover:text-white/80" data-bs-dismiss="alert" aria-label="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-gradient-to-r from-red-500/90 to-rose-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 fade-in-up animate-on-scroll">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="font-medium">Mohon perbaiki kesalahan berikut:</p>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="text-white hover:text-white/80" data-bs-dismiss="alert" aria-label="Tutup">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    </div>

    <!-- Header Buat Inisiatif -->
   <div class="relative bg-gradient-to-br from-blue-400/80 via-blue-600/80 to-teal-700/80 text-white overflow-hidden py-10 mb-6">
    <!-- Elemen Latar Belakang Animasi yang Ditingkatkan dengan tinggi dikurangi -->
    <div class="absolute inset-0 z-0">
        <!-- Animasi ocean-pulse -->
        <div class="bg-ocean-pulse absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('storage/' . $community->gambar) }}');"></div>
        <div class="floating-particles absolute inset-0 opacity-15"></div>
        <div class="wave-pattern absolute bottom-0 left-0 w-full h-12 opacity-15"></div>
        <div class="light-rays absolute inset-0 opacity-40"></div>
    </div>

      <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <!-- Gambar Komunitas dengan efek animasi yang ditingkatkan -->
            <div class="md:w-1/4 flex justify-center">
                <div class="perspective-container animate-on-scroll fade-in-scale">
                    <div class="transform hover:rotate-y-3 transition-all duration-700 relative">
                        @if($community->gambar)
                            <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white/30 glow-border shine-effect">
                                <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="w-full h-64 object-cover hover:scale-105 transition-all duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
                            </div>
                        @else
                            <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white/30 glow-border bg-gradient-to-br from-blue-400/90 via-blue-500/90 to-teal-600/90 flex items-center justify-center pulse-slow h-64 w-full">
                                <i class="fas fa-users fa-4x text-white/90"></i>
                            </div>
                        @endif
                        <div class="absolute -bottom-4 -right-4 w-20 h-20 rounded-full bg-gradient-to-br from-cyan-400 to-blue-400 blur-lg opacity-70 animate-pulse-slow"></div>
                    </div>
                </div>
            </div>

            <!-- Konten Header dengan visibilitas teks yang ditingkatkan -->
            <div class="md:w-3/4 text-center md:text-left animate-on-scroll fade-in-up">
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-2 mb-4">
                    <div class="w-2 h-2 bg-cyan-300 rounded-full mr-2 animate-pulse"></div>
                    <span class="text-white font-medium tracking-wide text-shadow-sm">{{ $community->nama_komunitas }}</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 text-reveal words-reveal text-shadow-lg">
                    <span class="word gradient-text-white">Tambah</span>
                    <span class="word gradient-text-white ml-2">Inisiatif</span>
                    <span class="word gradient-text-white ml-2">Baru</span>
                </h1>

                <p class="text-xl text-white mb-8 max-w-2xl leading-relaxed text-shadow-sm font-medium bg-blue-800/20 backdrop-blur-sm p-4 rounded-xl border-l-4 border-cyan-400">
                    Tambahkan inisiatif konservasi laut atau kegiatan untuk komunitas Anda. Inisiatif ini akan menjadi fokus utama yang ditampilkan pada halaman profil komunitas Anda.
                </p>

                <!-- Highlight ajakan bertindak -->
                <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                    <div class="animate-pulse-slow">
                        <div class="bg-gradient-to-r from-cyan-400 to-teal-400 text-blue-900 font-bold py-2 px-5 rounded-full shadow-lg inline-flex items-center">
                            <i class="fas fa-star mr-2"></i>
                            Buat inisiatif yang menginspirasi untuk komunitas Anda
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 100" preserveAspectRatio="none" class="w-full h-10">
            <path fill="#f8fafc" fill-opacity="1" d="M0,32L48,37.3C96,43,192,53,288,48C384,43,480,27,576,21.3C672,16,768,21,864,32C960,43,1056,59,1152,64C1248,69,1344,64,1392,61.3L1440,59L1440,100L1392,100C1344,100,1248,100,1152,100C1056,100,960,100,864,100C768,100,672,100,576,100C480,100,384,100,288,100C192,100,96,100,48,100L0,100Z"></path>
        </svg>
    </div>
</div>

    <!-- Kontainer Konten Utama -->
    <div class="container mx-auto px-4 relative z-10 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Kolom Formulir Utama -->
            <div class="lg:col-span-8">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl border border-blue-100/50 overflow-hidden animate-on-scroll slide-in-left">
                    <div class="p-8">
                        <form action="{{ route('admin.communities.initiatives.store', $community) }}" method="POST" class="space-y-8">
                            @csrf

                            <!-- Bagian Inisiatif -->
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                                <h3 class="text-xl font-bold text-blue-800 mb-5 flex items-center">
                                    <span class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-500 rounded-full flex items-center justify-center text-white mr-3 shadow-md">
                                        <i class="fas fa-lightbulb"></i>
                                    </span>
                                    Informasi Inisiatif
                                </h3>
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
                                                <div class="relative">
                                                    <input type="text"
                                                        name="initiatives[0][judul]"
                                                        class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                        placeholder="contoh: Perlindungan Terumbu Karang"
                                                        required>
                                                </div>
                                            </div>
                                            <!-- Pilihan Ikon -->
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                                                <div class="relative">
                                                    <select name="initiatives[0][icon]"
                                                        class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 appearance-none">
                                                        <option value="air" data-image="{{ asset('icon/waterdrop.png') }}">Air</option>
                                                        <option value="ikan" data-image="{{ asset('icon/fish.png') }}">Ikan</option>
                                                        <option value="terumbuhkarang" data-image="{{ asset('icon/coral-reef.png') }}">Terumbuh Karang</option>
                                                        <option value="alga" data-image="{{ asset('icon/seaweed.png') }}">Alga</option>
                                                        <option value="plankton" data-image="{{ asset('icon/plankton.png') }}">Alga dan Plankton</option>
                                                        <option value="limbahlaut" data-image="{{ asset('icon/water-polution.png') }}">Limbah Laut</option>
                                                        <option value="hewanlangkah" data-image="{{ asset('icon/seaanimal.png') }}">Hewan Langkah</option>
                                                        <option value="lautdalam" data-image="{{ asset('icon/sea.png') }}">Laut Dalam</option>
                                                        <option value="pesisir" data-image="{{ asset('icon/beach.png') }}">Pesisir</option>
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
                                            <div class="relative">
                                                <textarea
                                                    name="initiatives[0][deskripsi]"
                                                    class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                    rows="2"
                                                    placeholder="Deskripsi singkat tentang inisiatif ini"
                                                    required></textarea>
                                            </div>
                                            <p class="mt-1 text-xs text-blue-600">Berikan detail yang cukup untuk pemahaman anggota komunitas.</p>
                                        </div>

                                        <input type="hidden" name="initiatives[0][prioritas]" value="0" class="initiative-prioritas">
                                    </div>
                                </div>

                                <!-- Tombol Tambah Inisiatif -->
                                <button type="button" id="add-initiative" class="mt-4 px-5 py-3 bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white rounded-xl flex items-center gap-2 shadow-md hover:shadow-lg transition-all">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    Tambah Inisiatif Lain
                                </button>
                            </div>

                            <!-- Tombol Aksi Formulir -->
                            <div class="flex flex-wrap items-center justify-end gap-4">
                                <a href="{{ route('admin.communities.edit', $community) }}" class="bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-700 font-medium px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-times mr-2"></i> Batal
                                </a>
                                <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white font-medium px-10 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                                    <i class="fas fa-paper-plane mr-2"></i> Simpan Inisiatif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Kolom Sidebar -->
            <div class="lg:col-span-4">
                <!-- Kotak Tips Inisiatif -->
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl border border-blue-100/50 overflow-hidden animate-on-scroll slide-in-right" style="animation-delay: 0.2s">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-5">
                        <h3 class="text-lg font-bold flex items-center">
                            <i class="fas fa-lightbulb mr-3"></i>
                            Tips Inisiatif yang Efektif
                        </h3>
                    </div>
                    <div class="p-5">
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-2"></i>
                                <span><strong>Spesifik</strong> - Jelaskan dengan tepat apa tujuan inisiatif ini</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-2"></i>
                                <span><strong>Berkaitan dengan komunitas</strong> - Pastikan inisiatif ini sesuai dengan visi komunitas</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-2"></i>
                                <span><strong>Deskripsi jelas</strong> - Berikan detail yang cukup untuk pemahaman anggota</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-2"></i>
                                <span><strong>Pilih ikon representatif</strong> - Ikon yang sesuai akan mempermudah identifikasi</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contoh Inisiatif -->
                <div class="mt-6 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-3xl shadow-lg border border-cyan-100/50 overflow-hidden animate-on-scroll slide-in-right" style="animation-delay: 0.4s">
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-blue-800 flex items-center mb-3">
                            <i class="fas fa-clipboard-list text-blue-500 mr-2"></i>
                            Contoh Inisiatif
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-white rounded-xl p-4 border border-blue-200 shadow-sm">
                                <h4 class="font-bold text-blue-700 mb-1">Perlindungan Terumbu Karang</h4>
                                <p class="text-sm text-gray-600">Melindungi dan merestorasi terumbu karang di pesisir pantai dengan penanaman terumbu buatan</p>
                            </div>
                            <div class="bg-white rounded-xl p-4 border border-blue-200 shadow-sm">
                                <h4 class="font-bold text-blue-700 mb-1">Edukasi Limbah Plastik</h4>
                                <p class="text-sm text-gray-600">Mengedukasi masyarakat mengenai bahaya limbah plastik dan cara pengelolaannya di wilayah pesisir</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Wave Tetap -->
    <div class="fixed bottom-0 left-0 w-full z-0 pointer-events-none">
        <div class="relative h-32">
            <!-- Beberapa lapisan gelombang untuk efek realistis -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 left-0 w-full opacity-30">
                <path fill="#0099ff" d="M0,160L48,144C96,128,192,96,288,85.3C384,75,480,85,576,112C672,139,768,181,864,186.7C960,192,1056,160,1152,149.3C1248,139,1344,149,1392,154.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 left-0 w-full opacity-20" style="transform: scaleX(-1)">
                <path fill="#06b6d4" d="M0,192L60,176C120,160,240,128,360,133.3C480,139,600,181,720,197.3C840,213,960,203,1080,176C1200,149,1320,107,1380,85.3L1440,64L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 left-0 w-full opacity-10">
                <path fill="#0891b2" d="M0,256L48,234.7C96,213,192,171,288,165.3C384,160,480,192,576,202.7C672,213,768,203,864,197.3C960,192,1056,192,1152,170.7C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi untuk elemen saat muncul di tampilan
        const animateOnScroll = function() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(element => {
                const position = element.getBoundingClientRect();
                // Periksa apakah elemen ada di viewport
                if(position.top < window.innerHeight) {
                    element.classList.add('in-view');
                }
            });
        };

        // Jalankan saat halaman dimuat dan di-scroll
        animateOnScroll();
        window.addEventListener('scroll', animateOnScroll);

        // Animasi pengungkapan kata
        document.querySelectorAll('.words-reveal .word').forEach((word, index) => {
            word.style.animationDelay = `${0.2 * index}s`;
        });

        // Tambah inisiatif baru
        const container = document.getElementById('initiatives-container');
        const addButton = document.getElementById('add-initiative');
        let initiativeCount = 1;

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
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-500">
                                <i class="fas fa-heading"></i>
                            </span>
                            <input type="text"
                                name="initiatives[${initiativeCount}][judul]"
                                class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                placeholder="contoh: Perlindungan Terumbu Karang"
                                required>
                        </div>
                    </div>
                    <!-- Pilihan Ikon -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-teal-500">
                                <i class="fas fa-icons"></i>
                            </span>
                            <select name="initiatives[${initiativeCount}][icon]"
                                class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70 appearance-none">
                                <option value="air" data-image="{{ asset('icon/waterdrop.png') }}">Air</option>
                                <option value="ikan" data-image="{{ asset('icon/fish.png') }}">Ikan</option>
                                <option value="terumbuhkarang" data-image="{{ asset('icon/coral-reef.png') }}">Terumbuh Karang</option>
                                <option value="alga" data-image="{{ asset('icon/seaweed.png') }}">Alga</option>
                                <option value="plankton" data-image="{{ asset('icon/plankton.png') }}">Alga dan Plankton</option>
                                <option value="limbahlaut" data-image="{{ asset('icon/water-polution.png') }}">Limbah Laut</option>
                                <option value="hewanlangkah" data-image="{{ asset('icon/seaanimal.png') }}">Hewan Langkah</option>
                                <option value="lautdalam" data-image="{{ asset('icon/sea.png') }}">Laut Dalam</option>
                                <option value="pesisir" data-image="{{ asset('icon/beach.png') }}">Pesisir</option>
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
                    <div class="relative">
                        <span class="absolute top-3 left-3 text-blue-500">
                            <i class="fas fa-align-left"></i>
                        </span>
                        <textarea
                            name="initiatives[${initiativeCount}][deskripsi]"
                            class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                            rows="2"
                            placeholder="Deskripsi singkat tentang inisiatif ini"
                            required></textarea>
                    </div>
                    <p class="mt-1 text-xs text-blue-600">Berikan detail yang cukup untuk pemahaman anggota komunitas.</p>
                </div>

                <input type="hidden" name="initiatives[${initiativeCount}][prioritas]" value="${initiativeCount}" class="initiative-prioritas">
            `;

            // Tambahkan dengan animasi
            container.appendChild(newInitiative);
            setTimeout(() => {
                newInitiative.classList.add('visible');
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

                // Periksa apakah tombol dinonaktifkan
                if (button.disabled) {
                    return;
                }

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

        // Menutup otomatis peringatan setelah 5 detik
        setTimeout(() => {
            document.querySelectorAll('[data-bs-dismiss="alert"]').forEach(button => {
                button.click();
            });
        }, 5000);
    });
</script>
@endsection

@section('styles')
<style>
    /* Gelombang laut */
    .ocean-waves {
        background: linear-gradient(90deg,
            transparent,
            rgba(56, 189, 248, 0.15) 25%,
            rgba(6, 182, 212, 0.15) 50%,
            rgba(20, 184, 166, 0.15) 75%,
            transparent
        );
        background-size: 200% 100%;
        animation: oceanFlow 15s ease-in-out infinite;
    }

    /* Partikel mengambang yang ditingkatkan dengan kedalaman */
    .floating-particles {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(56, 189, 248, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 80% 20%, rgba(6, 182, 212, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 40% 40%, rgba(20, 184, 166, 0.15) 2px, transparent 2px);
        background-size: 100px 100px, 150px 150px, 200px 200px;
        animation: floatParticles 30s linear infinite;
    }

    /* Animasi gelembung untuk nuansa bawah laut */
    .ocean-bubbles {
        background-image:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, 0.8) 0.5px, transparent 0.5px),
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.7) 1px, transparent 1px),
            radial-gradient(circle at 30% 80%, rgba(255, 255, 255, 0.6) 0.8px, transparent 0.8px),
            radial-gradient(circle at 70% 40%, rgba(255, 255, 255, 0.7) 1.2px, transparent 1.2px);
        background-size: 100px 100px;
        animation: bubbleRise 25s linear infinite;
    }

    /* Pola gelombang untuk header */
    .wave-pattern {
        background-image:
            linear-gradient(135deg, transparent 45%, rgba(255, 255, 255, 0.1) 45%, rgba(255, 255, 255, 0.1) 55%, transparent 55%);
        background-size: 20px 20px;
        animation: waveMove 10s linear infinite;
    }

    /* Container perspektif untuk efek 3D */
    .perspective-container {
        perspective: 1000px;
    }

    /* Efek kilau untuk gambar */
    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 50%;
        height: 100%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 100%
        );
        transform: skewX(-25deg);
        transition: all 0.75s;
    }

    .shine-effect:hover::before {
        animation: shine 1.5s;
    }

    /* Animasi denyut lambat */
    .pulse-slow {
        animation: pulseSlow 4s infinite ease-in-out;
    }

    /* Efek teks gradien */
    .gradient-text-white {
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Animasi kustom */
    @keyframes oceanFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes floatParticles {
        0% { background-position: 0 0, 0 0, 0 0; }
        100% { background-position: 100px 100px, -150px 150px, 200px -200px; }
    }

    @keyframes bubbleRise {
        0% { background-position: 0 100%; }
        100% { background-position: 100px 0; }
    }

    @keyframes waveMove {
        0% { background-position: 0 0; }
        100% { background-position: 40px 0; }
    }

    @keyframes shine {
        100% { left: 150%; }
    }

    @keyframes pulseSlow {
        0%, 100% { opacity: 0.9; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.05); }
    }

    /* Animasi On Scroll */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Animasi geser masuk */
    .slide-in-left {
        opacity: 0;
        transform: translateX(-50px);
        transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .slide-in-right {
        opacity: 0;
        transform: translateX(50px);
        transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .slide-in-left.in-view, .slide-in-right.in-view {
        opacity: 1;
        transform: translateX(0);
    }

    /* Fade In Scale */
    .fade-in-scale {
        opacity: 0;
        transform: scale(0.9);
        transition: all 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    .fade-in-scale.in-view {
        opacity: 1;
        transform: scale(1);
    }

    /* Animasi pengungkapan kata */
    .words-reveal .word {
        display: inline-block;
        opacity: 0;
        transform: translateY(40px);
        animation: wordReveal 0.8s forwards;
    }

    @keyframes wordReveal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animasi fade-in untuk inisiatif baru */
    .animate-fade-in {
        opacity: 0;
        transition: opacity 0.3s ease-in, transform 0.3s ease-out;
        transform: translateY(10px);
    }

    .animate-fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Efek batas bercahaya */
    .glow-border {
        box-shadow: 0 0 15px rgba(6, 182, 212, 0.3);
        transition: box-shadow 0.3s ease;
    }

    .glow-border:hover {
        box-shadow: 0 0 25px rgba(6, 182, 212, 0.5);
    }

    /* Animasi pulsasi laut */
    .bg-ocean-pulse {
        background-size: cover;
        opacity: 0.7;
        animation: oceanPulse 10s ease-in-out infinite;
        filter: saturate(1.2);
    }

    @keyframes oceanPulse {
        0%, 100% {
            transform: scale(1.05);
            filter: brightness(0.9);
        }
        50% {
            transform: scale(1);
            filter: brightness(1.1);
        }
    }

    /* Sinar cahaya */
    .light-rays {
        background: linear-gradient(45deg,
            transparent 30%,
            rgba(255, 255, 255, 0.08) 40%,
            rgba(255, 255, 255, 0.06) 50%,
            transparent 60%
        );
        background-size: 200% 200%;
        animation: lightRaysMove 15s ease-in-out infinite;
    }

    @keyframes lightRaysMove {
        0%, 100% {
            transform: translateX(-10%) translateY(-10%) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateX(10%) translateY(10%) rotate(5deg);
            opacity: 0.6;
        }
    }

    /* Animasi gelombang footer */
    .fixed.bottom-0 svg:nth-child(1) {
        animation: waveFlow 12s ease-in-out infinite;
        transform-origin: center bottom;
    }

    .fixed.bottom-0 svg:nth-child(2) {
        animation: waveFlow2 15s ease-in-out infinite;
        transform-origin: center bottom;
    }

    .fixed.bottom-0 svg:nth-child(3) {
        animation: waveFlow3 10s ease-in-out infinite;
        transform-origin: center bottom;
    }

    @keyframes waveFlow {
        0% {
            transform: translateX(0) translateZ(0);
        }
        50% {
            transform: translateX(-25px) translateZ(0);
        }
        100% {
            transform: translateX(0) translateZ(0);
        }
    }

    @keyframes waveFlow2 {
        0% {
            transform: scaleX(-1) translateX(0) translateZ(0);
        }
        50% {
            transform: scaleX(-1) translateX(25px) translateZ(0);
        }
        100% {
            transform: scaleX(-1) translateX(0) translateZ(0);
        }
    }

    @keyframes waveFlow3 {
        0% {
            transform: translateX(0) translateZ(0) scaleY(1);
        }
        50% {
            transform: translateX(-15px) translateZ(0) scaleY(1.05);
        }
        100% {
            transform: translateX(0) translateZ(0) scaleY(1);
        }
    }

    /* Latar belakang kartu */
    .bg-white\/90 {
        background-color: rgba(255, 255, 255, 0.92);
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%230ea5e9' fill-opacity='0.02' fill-rule='evenodd'/%3E%3C/svg%3E");
    }

    /* Transisi inisiatif lembut */
    .initiative-item {
        transition: all 0.3s ease-out;
    }
</style>
