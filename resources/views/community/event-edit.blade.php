@extends('layouts.app')

@section('title', 'Edit Acara - ' . $event->title)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-100 to-teal-50 relative overflow-hidden">
    <!-- Latar Belakang Animasi Laut  -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Penanganan Notifikasi -->
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

    <!-- Header Edit Acara -->
   <div class="relative bg-gradient-to-br from-blue-400/80 via-blue-600/80 to-teal-700/80 text-white overflow-hidden py-10 mb-6">
    <!-- Elemen Latar Belakang Animasi yang Ditingkatkan dengan tinggi dikurangi -->
    <div class="absolute inset-0 z-0">
        <!--  animasi ocean-pulse -->
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


            <!-- Konten Header dengan visibilitas teks yang menarik -->
            <div class="md:w-3/4 text-center md:text-left animate-on-scroll fade-in-up">
                <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-6 py-2 mb-4">
                    <div class="w-2 h-2 bg-cyan-300 rounded-full mr-2 animate-pulse"></div>
                    <span class="text-white font-medium tracking-wide text-shadow-sm">{{ $community->nama_komunitas }}</span>
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 text-reveal words-reveal text-shadow-lg">
                    <span class="word gradient-text-white">Edit</span>
                    <span class="word gradient-text-white ml-2">Acara</span>
                </h1>

                <p class="text-xl text-white mb-8 max-w-2xl leading-relaxed text-shadow-sm font-medium bg-blue-800/20 backdrop-blur-sm p-4 rounded-xl border-l-4 border-cyan-400">
                    Perbarui detail acara untuk memberikan informasi terbaru kepada anggota komunitas. Pastikan detail informasi sudah lengkap dan akurat.
                </p>

                <!-- Highlight ajakan bertindak -->
                <div class="mt-6 flex flex-wrap gap-4 justify-center md:justify-start">
                    <div class="animate-pulse-slow">
                        <div class="bg-gradient-to-r from-cyan-400 to-teal-400 text-blue-900 font-bold py-2 px-5 rounded-full shadow-lg inline-flex items-center">
                            <i class="fas fa-star mr-2"></i>
                            {{ $event->title }}
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
                        <form action="{{ route('communities.events.update', ['community' => $community, 'event' => $event]) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="source" value="events_page">

                            <!-- Bagian Informasi Dasar Acara -->
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                                <h3 class="text-xl font-bold text-blue-800 mb-5 flex items-center">
                                    <span class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-500 rounded-full flex items-center justify-center text-white mr-3 shadow-md">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    Informasi Dasar
                                </h3>

                                <div class="space-y-5">
                                    <!-- Judul Acara -->
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Acara *</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-500">
                                                <i class="fas fa-heading"></i>
                                            </span>
                                            <input
                                                type="text"
                                                id="title"
                                                name="title"
                                                required
                                                class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                placeholder="Berikan judul yang menarik untuk acara Anda"
                                                value="{{ old('title', $event->title) }}"
                                            >
                                        </div>
                                        @error('title')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Deskripsi Acara -->
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi *</label>
                                        <div class="relative">
                                            <textarea
                                                id="description"
                                                name="description"
                                                rows="6"
                                                required
                                                class="w-full border border-blue-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                placeholder="Jelaskan tentang acara Anda, apa yang dapat diharapkan peserta, dan mengapa mereka harus bergabung"
                                            >{{ old('description', $event->description) }}</textarea>
                                        </div>
                                        <p class="mt-1 text-xs text-blue-600">Berikan detail lengkap untuk menarik peserta dan memberikan ekspektasi yang jelas.</p>
                                        @error('description')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Jadwal & Lokasi Acara -->
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                                <h3 class="text-xl font-bold text-blue-800 mb-5 flex items-center">
                                    <span class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-500 rounded-full flex items-center justify-center text-white mr-3 shadow-md">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                    Jadwal & Lokasi
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                    <!-- Tanggal Acara -->
                                    <div>
                                        <label for="event_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Acara *</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-500">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                            <input
                                                type="date"
                                                id="event_date"
                                                name="event_date"
                                                required
                                                class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                value="{{ old('event_date', $event->event_date) }}"
                                                min="{{ date('Y-m-d') }}"
                                            >
                                        </div>
                                        @error('event_date')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Lokasi Acara -->
                                    <div>
                                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-teal-500">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </span>
                                            <input
                                                type="text"
                                                id="location"
                                                name="location"
                                                class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                placeholder="Di mana acara akan berlangsung?"
                                                value="{{ old('location', $event->location) }}"
                                            >
                                        </div>
                                        @error('location')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Waktu Mulai -->
                                    <div>
                                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-blue-500">
                                                <i class="fas fa-clock"></i>
                                            </span>
                                            <input
                                                type="time"
                                                id="start_time"
                                                name="start_time"
                                                class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                value="{{ old('start_time', $event->start_time) }}"
                                            >
                                        </div>
                                        @error('start_time')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Waktu Selesai -->
                                    <div>
                                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                                        <div class="relative">
                                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-teal-500">
                                                <i class="fas fa-hourglass-end"></i>
                                            </span>
                                            <input
                                                type="time"
                                                id="end_time"
                                                name="end_time"
                                                class="w-full border border-blue-200 rounded-xl px-4 py-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white/70"
                                                value="{{ old('end_time', $event->end_time) }}"
                                            >
                                        </div>
                                        @error('end_time')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <p class="mt-3 text-xs text-gray-500 italic">Biarkan kolom waktu kosong jika acara berlangsung sepanjang hari.</p>
                            </div>

                            <!-- Bagian Gambar Acara -->
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-2xl p-6 border border-blue-100 shadow-sm">
                                <h3 class="text-xl font-bold text-blue-800 mb-5 flex items-center">
                                    <span class="w-10 h-10 bg-gradient-to-br from-blue-500 to-teal-500 rounded-full flex items-center justify-center text-white mr-3 shadow-md">
                                        <i class="fas fa-image"></i>
                                    </span>
                                    Gambar Acara
                                </h3>

                                @if($event->image)
                                    <div class="mb-5">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                                        <div class="relative w-full h-48 rounded-xl overflow-hidden mb-4 border border-blue-100">
                                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center mb-4">
                                        <input type="checkbox" id="remove_image" name="remove_image" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <label for="remove_image" class="ml-2 text-sm text-red-600 font-medium">Hapus gambar ini</label>
                                    </div>
                                @endif

                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">{{ $event->image ? 'Ganti Gambar' : 'Unggah Gambar' }}</label>
                                    <div class="relative border-2 border-dashed border-blue-300 rounded-xl p-8 text-center bg-white/50 hover:bg-white/80 transition-colors duration-300 cursor-pointer group">
                                        <input
                                            type="file"
                                            id="image"
                                            name="image"
                                            accept="image/*"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                            onchange="displayImagePreview(this)"
                                        >
                                        <div class="space-y-3" id="upload-text">
                                            <i class="fas fa-cloud-upload-alt text-blue-500 text-4xl group-hover:scale-110 transition-transform"></i>
                                            <p class="text-blue-700 font-medium">Klik atau seret dan lepas untuk mengunggah gambar acara</p>
                                            <p class="text-xs text-gray-500">Ukuran yang direkomendasikan: 1200x600px. Maks 2MB.</p>
                                        </div>
                                        <div id="image-preview-container" class="hidden flex justify-center"></div>
                                    </div>
                                    @error('image')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tombol Aksi Formulir -->
                            <div class="flex flex-wrap items-center justify-end gap-4">
                                <a href="{{ route('communities.events', $community) }}" class="bg-gradient-to-r from-gray-200 to-gray-300 hover:from-gray-300 hover:to-gray-400 text-gray-700 font-medium px-8 py-3 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                                    <i class="fas fa-times mr-2"></i> Batal
                                </a>
                                <button type="submit" class="bg-gradient-to-r from-blue-500 to-teal-500 hover:from-blue-600 hover:to-teal-600 text-white font-medium px-10 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Kolom Sidebar -->
            <div class="lg:col-span-4">
                <!-- Kartu Acara Terbaru -->
                <div class="bg-white backdrop-blur-xl rounded-3xl shadow-xl border border-blue-100/50 overflow-hidden animate-on-scroll slide-in-right" style="animation-delay: 0.2s">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-5">
                        <h3 class="text-lg font-bold flex items-center">
                            <i class="fas fa-calendar-check mr-3"></i>
                            Acara Komunitas Terbaru
                        </h3>
                    </div>
                    <div class="p-5">
                        @if($community->events->count() > 0)
                            <div class="space-y-4">
                                @foreach($community->events->sortByDesc('created_at')->take(3) as $recentEvent)
                                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200 group hover:shadow-md transition-all transform hover:-translate-y-1 duration-300 {{ $recentEvent->id == $event->id ? 'border-blue-400 bg-blue-100' : '' }}">
                                        <div class="flex items-start">
                                            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl w-12 h-12 flex flex-col items-center justify-center mr-3 flex-shrink-0 shadow-md">
                                                <span class="text-sm font-bold">{{ \Carbon\Carbon::parse($recentEvent->event_date)->format('d') }}</span>
                                                <span class="text-xs">{{ \Carbon\Carbon::parse($recentEvent->event_date)->format('M') }}</span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="font-bold text-gray-900 mb-1 text-sm">{{ $recentEvent->title }}</h6>
                                                <p class="text-xs text-gray-600">
                                                    <i class="fas fa-map-marker-alt mr-1 text-blue-600"></i>
                                                    {{ $recentEvent->location ?? 'Lokasi belum ditentukan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-center mt-4">
                                    <a href="{{ route('communities.events', $community) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm group">
                                        Lihat Semua Acara
                                        <i class="fas fa-arrow-right ml-1.5 transform group-hover:translate-x-1 transition-transform"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 mx-auto mb-4 relative">
                                    <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-50"></div>
                                    <div class="relative w-full h-full bg-blue-100 rounded-full flex items-center justify-center text-blue-500">
                                        <i class="fas fa-calendar-plus text-xl"></i>
                                    </div>
                                </div>
                                <h4 class="text-gray-800 mb-1 font-medium">Belum ada acara yang dibuat</h4>
                                <p class="text-sm text-gray-500">Ini akan menjadi acara pertama untuk komunitas Anda!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Kotak tips -->
                <div class="mt-6 bg-gradient-to-r from-cyan-50 to-blue-50 rounded-3xl shadow-lg border border-cyan-100/50 overflow-hidden animate-on-scroll slide-in-right" style="animation-delay: 0.4s">
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-blue-800 flex items-center mb-3">
                            <i class="fas fa-lightbulb text-amber-500 mr-2"></i>
                            Tips Perencanaan Acara
                        </h3>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-2"></i>
                                <span>Pilih judul deskriptif yang secara jelas mengkomunikasikan tujuan acara</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-2"></i>
                                <span>Sertakan semua detail penting seperti lokasi, tanggal, dan waktu</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-teal-500 mt-1 mr-2"></i>
                                <span>Unggah gambar berkualitas tinggi yang mewakili acara Anda</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Wave -->
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

        // Checkbox untuk menghapus gambar
        const removeImageCheckbox = document.getElementById('remove_image');
        const imageInput = document.getElementById('image');
        
        if (removeImageCheckbox && imageInput) {
            removeImageCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    imageInput.disabled = true;
                    imageInput.closest('.relative').classList.add('opacity-50');
                } else {
                    imageInput.disabled = false;
                    imageInput.closest('.relative').classList.remove('opacity-50');
                }
            });

            imageInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    removeImageCheckbox.checked = false;
                    removeImageCheckbox.disabled = true;
                } else {
                    removeImageCheckbox.disabled = false;
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

    // Fungsi pratinjau gambar
    function displayImagePreview(input) {
        const previewContainer = document.getElementById('image-preview-container');
        const uploadText = document.getElementById('upload-text');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                uploadText.classList.add('hidden');
                previewContainer.classList.remove('hidden');

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'max-h-64 rounded-lg shadow-md';

                // Hapus pratinjau sebelumnya
                previewContainer.innerHTML = '';

                // Tambahkan kontainer gambar dan tombol "ubah"
                const container = document.createElement('div');
                container.className = 'relative';

                const changeBtn = document.createElement('button');
                changeBtn.type = 'button';
                changeBtn.className = 'absolute -top-3 -right-3 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-md hover:bg-red-600 transition-colors';
                changeBtn.innerHTML = '<i class="fas fa-times"></i>';
                changeBtn.onclick = function() {
                    input.value = '';
                    previewContainer.classList.add('hidden');
                    uploadText.classList.remove('hidden');
                    
                    // Aktifkan kembali checkbox hapus gambar jika ada
                    const removeImageCheckbox = document.getElementById('remove_image');
                    if (removeImageCheckbox) {
                        removeImageCheckbox.disabled = false;
                    }
                };

                container.appendChild(img);
                container.appendChild(changeBtn);
                previewContainer.appendChild(container);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@section('styles')
<style>
    /* Ocean animations for header background */
    .ocean-depth-rays {
        background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(255,255,255,0.05) 50%);
        background-size: 100% 20px;
        opacity: 0.3;
        animation: rays 8s linear infinite;
    }

    .floating-particles::before,
    .floating-particles::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.2;
    }

    .floating-particles::before {
        animation: floatParticles 20s linear infinite;
    }

    .floating-particles::after {
        background-size: 20px 20px;
        animation: floatParticles 15s linear infinite reverse;
    }

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

    .ocean-bubbles {
        background-image:
            radial-gradient(circle at 90% 10%, rgba(255, 255, 255, 0.8) 0.5px, transparent 0.5px),
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.7) 1px, transparent 1px),
            radial-gradient(circle at 30% 80%, rgba(255, 255, 255, 0.6) 0.8px, transparent 0.8px),
            radial-gradient(circle at 70% 40%, rgba(255, 255, 255, 0.7) 1.2px, transparent 1.2px);
        background-size: 100px 100px;
        animation: bubbleRise 25s linear infinite;
    }

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
        background: linear-gradient(to right, #ffffff, #e0f2fe);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        text-shadow: 0px 2px 3px rgba(0, 0, 0, 0.15);
    }

    /* Text shadow untuk keterbacaan */
    .text-shadow-sm {
        text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .text-shadow-lg {
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Animasi kustom */
    @keyframes rays {
        0% { background-position: 0 0; }
        100% { background-position: 0 20px; }
    }

    @keyframes waveAnimation {
        0% { transform: translateX(-50px); }
        50% { transform: translateY(15px); }
        100% { transform: translateX(50px) translateY(-15px); }
    }

    @keyframes floatParticles {
        0% { transform: translateY(0) translateX(0); }
        25% { transform: translateY(-15px) translateX(15px); }
        50% { transform: translateY(-25px) translateX(0); }
        75% { transform: translateY(-10px) translateX(-15px); }
        100% { transform: translateY(0) translateX(0); }
    }

    @keyframes bubbleRise {
        from { background-position: 0 0, 0 0; }
        to { background-position: 0 -100px, 0 -50px; }
    }

    @keyframes underwaterCurrent {
        0%, 100% { opacity: 0.05; transform: translateX(-100%); }
        50% { opacity: 0.15; transform: translateX(100%); }
    }

    @keyframes oceanFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes shine {
        100% { left: 150%; }
    }

    @keyframes pulseSlow {
        0%, 100% { opacity: 0.9; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.05); }
    }

    /* Animate On Scroll */
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

    /* Efek batas bercahaya */
    .glow-border {
        box-shadow: 0 0 15px rgba(6, 182, 212, 0.3);
        transition: box-shadow 0.3s ease;
    }

    .glow-border:hover {
        box-shadow: 0 0 25px rgba(6, 182, 212, 0.5);
    }

    /* Animasi laut berdetak */
    .bg-ocean-pulse {
        background-size: cover;
        opacity: 0.7;
        animation: oceanPulse 10s ease-in-out infinite;
        filter: saturate(1.2);
    }

    @keyframes oceanPulse {
        0%, 100% {
            opacity: 0.65;
            filter: saturate(1.1);
        }
        50% {
            opacity: 0.75;
            filter: saturate(1.3);
        }
    }

     .relative input[type="text"],
    .relative input[type="date"],
    .relative input[type="time"] {
        padding-left: 2.5rem !important; 
    }
    
    .relative .inset-y-0.left-0 {
        pointer-events: none; 
        display: flex;
        align-items: center;
        width: 2.5rem;
        justify-content: center;
        background: transparent;
        z-index: 5;
    }
    
    #location {
        text-overflow: ellipsis;
    }
    
    /* Memastikan visibilitas teks saat ada ikon */
    .relative input::placeholder {
        opacity: 1;
        color: #9ca3af;
    }

    /* Memperbaiki tampilan input saat focus */
    .relative input:focus {
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
        border-color: #3b82f6;
    }
    
    /* Perbaikan untuk date dan time picker yang sering bermasalah */
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="time"]::-webkit-calendar-picker-indicator {
        background-color: transparent;
        opacity: 0.7;
        cursor: pointer;
        position: absolute;
        right: 10px;
        height: 100%;
        width: 30px;
    }
    
    /* Style ikon agar terlihat semi-transparan */
    .relative .text-blue-500,
    .relative .text-teal-500 {
        opacity: 0.7;
    }

</style>
@endsection