
@extends('layouts.app')

@section('title', 'Edit Inisiatif - ' . $community->nama_komunitas)

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

    <!-- Header Edit Inisiatif -->
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
                    <span class="word gradient-text-white">Edit</span>
                    <span class="word gradient-text-white ml-2">Inisiatif</span>
                    <span class="word gradient-text-white ml-2">Komunitas</span>
                </h1>

                <p class="text-xl text-white mb-8 max-w-2xl leading-relaxed text-shadow-sm font-medium bg-blue-800/20 backdrop-blur-sm p-4 rounded-xl border-l-4 border-cyan-400">
                    Perbarui inisiatif konservasi laut atau kegiatan untuk komunitas Anda. Inisiatif ini akan menunjukkan fokus utama yang ditampilkan pada halaman profil komunitas Anda.
                </p>

                <!-- Highlight ajakan bertindak -->
                <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                    <div class="animate-pulse-slow">
                        <div class="bg-gradient-to-r from-cyan-400 to-teal-400 text-blue-900 font-bold py-2 px-5 rounded-full shadow-lg inline-flex items-center">
                            <i class="fas fa-star mr-2"></i>
                            Edit inisiatif untuk meningkatkan dampak komunitas Anda
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
                        <form action="{{ route('admin.communities.initiatives.update', ['community' => $community, 'initiative' => $initiative]) }}" method="POST" class="relative">
                            @csrf
                            @method('PUT')

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Judul Inisiatif -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Inisiatif</label>
                                <div class="relative">
                                    <input type="text"
                                        id="judul"
                                        name="judul"
                                        value="{{ old('judul', $initiative->judul) }}"
                                        class="w-full px-4 py-3 pl-10 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white/70"
                                        placeholder="contoh: Perlindungan Terumbu Karang"
                                        required>
                                </div>
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ikon -->
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                                <div class="relative">
                                    <select id="icon" name="icon" required class="w-full appearance-none px-4 py-3 pl-10 pr-10 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white/70">
                                        <option value="air" data-image="{{ asset('icon/waterdrop.png') }}" {{ $initiative->icon == 'air' ? 'selected' : '' }}>Air</option>
                                        <option value="ikan" data-image="{{ asset('icon/fish.png') }}" {{ $initiative->icon == 'ikan' ? 'selected' : '' }}>Ikan</option>
                                        <option value="terumbuhkarang" data-image="{{ asset('icon/coral-reef.png') }}" {{ $initiative->icon == 'terumbuhkarang' ? 'selected' : '' }}>Terumbu Karang</option>
                                        <option value="alga" data-image="{{ asset('icon/seaweed.png') }}" {{ $initiative->icon == 'alga' ? 'selected' : '' }}>Alga</option>
                                        <option value="plankton" data-image="{{ asset('icon/plankton.png') }}" {{ $initiative->icon == 'plankton' ? 'selected' : '' }}>Alga dan Plankton</option>
                                        <option value="limbahlaut" data-image="{{ asset('icon/water-polution.png') }}" {{ $initiative->icon == 'limbahlaut' ? 'selected' : '' }}>Limbah Laut</option>
                                        <option value="hewanlangkah" data-image="{{ asset('icon/seaanimal.png') }}" {{ $initiative->icon == 'hewanlangkah' ? 'selected' : '' }}>Hewan Langka</option>
                                        <option value="lautdalam" data-image="{{ asset('icon/sea.png') }}" {{ $initiative->icon == 'lautdalam' ? 'selected' : '' }}>Laut Dalam</option>
                                        <option value="pesisir" data-image="{{ asset('icon/beach.png') }}" {{ $initiative->icon == 'pesisir' || $initiative->icon == 'custom-pesisir' ? 'selected' : '' }}>Pesisir</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-blue-600">Pilih ikon yang tepat untuk menggambarkan inisiatif ini</p>
                                @error('icon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Preview ikon -->
                        <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl border border-blue-100">
                            <div class="text-center">
                                <h5 class="text-sm font-medium text-blue-800 mb-2 flex items-center justify-center">
                                    Pratinjau Ikon
                                </h5>
                                <div class="flex justify-center">
                                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-teal-600 rounded-full flex items-center justify-center text-white shadow-md transform hover:scale-105 transition-all duration-300">
                                        <i id="icon-preview" class="text-2xl {{ $initiative->icon ? 'fas fa-' . $initiative->icon : 'fas fa-water' }}"></i>
                                    </div>
                                </div>
                                <p class="text-xs text-blue-600 mt-2">Ikon akan ditampilkan pada halaman profil komunitas</p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <div class="relative">
                                <textarea
                                    id="deskripsi"
                                    name="deskripsi"
                                    rows="4"
                                    class="w-full px-4 py-3 pl-10 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white/70"
                                    placeholder="Jelaskan detail tentang inisiatif ini..."
                                    required>{{ old('deskripsi', $initiative->deskripsi) }}</textarea>
                            </div>
                            <p class="mt-1 text-xs text-blue-600">Berikan detail yang cukup untuk pemahaman anggota komunitas.</p>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Urutan Prioritas -->
                        <div class="mb-6">
                            <label for="urutan_prioritas" class="block text-sm font-medium text-gray-700 mb-1">Urutan Prioritas</label>
                            <div class="relative">
                                <select
                                    id="urutan_prioritas"
                                    name="urutan_prioritas"
                                    class="w-full appearance-none px-4 py-3 pl-10 pr-10 rounded-xl border-0 ring-1 ring-gray-200 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white/70">
                                    <option value="0" {{ $initiative->urutan_prioritas == 0 ? 'selected' : '' }}>Prioritas Utama</option>
                                    <option value="1" {{ $initiative->urutan_prioritas == 1 ? 'selected' : '' }}>Prioritas Kedua</option>
                                    <option value="2" {{ $initiative->urutan_prioritas == 2 ? 'selected' : '' }}>Prioritas Ketiga</option>
                                    <option value="3" {{ $initiative->urutan_prioritas == 3 ? 'selected' : '' }}>Prioritas Keempat</option>
                                    <option value="4" {{ $initiative->urutan_prioritas == 4 ? 'selected' : '' }}>Prioritas Kelima</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-blue-600">Urutan prioritas mempengaruhi bagaimana inisiatif ditampilkan di profil komunitas</p>
                        </div>
                    </div>

                    <!-- Footer Pengiriman Formulir -->
                    <div class="p-8 bg-gradient-to-r from-blue-50 to-cyan-50 border-t border-blue-100 flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.communities.edit', $community) }}" class="px-6 py-3 bg-white border border-blue-200 rounded-xl text-blue-700 font-medium hover:bg-blue-50 transition-colors flex items-center gap-2 shadow-sm hover:shadow">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Batal
                            </a>

                            <form action="{{ route('admin.communities.initiatives.destroy', ['community' => $community, 'initiative' => $initiative]) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus inisiatif ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white rounded-xl font-medium transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
                                    <i class="fas fa-trash-alt mr-1"></i>
                                    Hapus Inisiatif
                                </button>
                            </form>
                        </div>

                        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white rounded-xl font-medium shadow-lg hover:shadow-xl transition-all duration-300 flex items-center gap-2">
                            <i class="fas fa-save mr-1"></i>
                            Simpan Perubahan
                        </button>
                        </div>
                    </form>
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

                <!-- Preview Inisiatif -->
                <div class="mt-6 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-3xl shadow-lg border border-cyan-100/50 overflow-hidden animate-on-scroll slide-in-right" style="animation-delay: 0.4s">
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-blue-800 flex items-center mb-3">
                            <i class="fas fa-eye text-blue-500 mr-2"></i>
                            Pratinjau Inisiatif
                        </h3>
                        <div class="space-y-4">
                            <div class="bg-white rounded-xl p-4 border border-blue-200 shadow-sm">
                                <div class="flex items-center gap-3 mb-2">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-teal-400 flex items-center justify-center">                                    </div>
                                    <h4 id="preview-title" class="font-bold text-blue-700">{{ $initiative->judul }}</h4>
                                </div>
                                <p id="preview-description" class="text-sm text-gray-600">{{ $initiative->deskripsi }}</p>
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
        radial-gradient(circle at 10% 20%, rgba(147, 51, 234, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 30% 60%, rgba(79, 70, 229, 0.1) 1px, transparent 1px),
        radial-gradient(circle at 70% 90%, rgba(124, 58, 237, 0.1) 1px, transparent 1px);
    background-size: 80px 80px;
    animation: particleMove 20s linear infinite;
}

/* Animasi pada scroll */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.animate-on-scroll.in-view {
    opacity: 1;
    transform: translateY(0);
}

.slide-in-left {
    transform: translateX(-30px);
}

.slide-in-right {
    transform: translateX(30px);
}

.slide-in-left.in-view,
.slide-in-right.in-view {
    transform: translateX(0);
}

.fade-in-up {
    transform: translateY(20px);
}

.fade-in-up.in-view {
    transform: translateY(0);
}

.fade-in-scale {
    opacity: 0;
    transform: scale(0.9);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
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


/* Efek bayangan teks */
.text-shadow-sm {
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

.text-shadow-lg {
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

/* Animasi Slow Pulse */
.pulse-slow {
    animation: pulseSlow 3s ease-in-out infinite;
}

@keyframes pulseSlow {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.animate-pulse-slow {
    animation: pulseSlow 3s infinite;
}

/* Efek Shine pada gambar */
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
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.3), transparent);
    transform: skewX(-25deg);
    animation: shine 6s infinite;
}

@keyframes shine {
    0%, 100% { left: -100%; }
    50% { left: 100%; }
}

/* Efek perspective untuk kartu */
.perspective-container {
    perspective: 1000px;
}
</style>
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
        
        // Real-time icon preview update
        const iconSelect = document.getElementById('icon');
        const iconPreview = document.getElementById('icon-preview');
        const iconImagePreview = document.getElementById('icon-image-preview');

        // Set icon select initial value
        updateIconPreview();

        // Update the icon preview when the selection changes
        iconSelect.addEventListener('change', updateIconPreview);

        function updateIconPreview() {
            // Get the selected option
            const selectedOption = iconSelect.options[iconSelect.selectedIndex];
            const value = selectedOption.value;
            const imageUrl = selectedOption.getAttribute('data-image');
            
            // Update image preview
            if (imageUrl) {
                iconImagePreview.src = imageUrl;
                iconImagePreview.style.display = 'block';
                iconPreview.style.display = 'none';
            } else {
                iconImagePreview.style.display = 'none';
                iconPreview.style.display = 'block';
                iconPreview.className = '';
                iconPreview.classList.add('text-2xl', 'fas', 'fa-' + value);
            }
        }

        // Real-time preview update
        const titleInput = document.getElementById('judul');
        const descInput = document.getElementById('deskripsi');
        const previewTitle = document.getElementById('preview-title');
        const previewDesc = document.getElementById('preview-description');
        const previewIconImg = document.getElementById('preview-icon-img');

        // Update preview on input changes
        titleInput.addEventListener('input', function() {
            previewTitle.textContent = this.value || '{{ $initiative->judul }}';
        });

        descInput.addEventListener('input', function() {
            previewDesc.textContent = this.value || '{{ $initiative->deskripsi }}';
        });

        iconSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const imageUrl = selectedOption.getAttribute('data-image');
            
            if (imageUrl) {
                previewIconImg.src = imageUrl;
            }
        });

        // Status loading pengiriman formulir
        const form = document.querySelector('form');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function(event) {
            // Don't show loading for delete form
            if (form.method.toLowerCase() !== 'post' || form.action.includes('delete')) {
                return;
            }

            // Tampilkan status loading
            submitButton.innerHTML = `
                <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>
                Menyimpan...
            `;
            submitButton.disabled = true;
        });
    });
</script>
@endsection
