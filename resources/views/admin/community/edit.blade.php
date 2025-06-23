@extends('layouts.app')
@section('title', 'Edit Komunitas')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden py-8">
    <!-- Latar Belakang Bertema Laut dengan Animasi Gelembung -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <!-- Konten Halaman -->
    <div class="container mx-auto px-4 relative z-10">
        <!-- Navigasi Breadcrumb -->
        <nav class="flex mb-5 pb-2 border-b border-blue-200/30" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-blue-700 hover:text-blue-900">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dasbor
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('communities.show', $community) }}" class="ml-1 text-sm font-medium text-blue-700 hover:text-blue-900 md:ml-2">Komunitas</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Edit Komunitas</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Judul Halaman dengan Animasi Laut -->
        <div class="mb-8 text-center relative overflow-hidden p-6 bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl shadow-xl">
            <div class="absolute inset-0 overflow-hidden">
                <div class="ocean-waves absolute bottom-0 left-0 w-full h-32 opacity-30"></div>
                <div class="floating-particles absolute inset-0"></div>
                <div class="deep-sea-bubbles opacity-30"></div>
            </div>
            <h1 class="text-3xl font-bold text-white relative z-10">Edit Komunitas</h1>
            <p class="text-blue-100 mt-2 relative z-10">Edit detail komunitas "{{ $community->nama_komunitas }}"</p>
        </div>

        <!-- Grid Konten Utama -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Bagian Formulir Edit Utama -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Kartu Informasi Komunitas -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-xl border border-blue-100 overflow-hidden fade-in-up animate-on-scroll">
                    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 p-5 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Komunitas
                        </h2>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('admin.communities.update', $community) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="nama_komunitas" class="block text-sm font-medium text-gray-700 mb-2">Nama Komunitas</label>
                                <input type="text"
                                       class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/80 transition-all r"
                                       id="nama_komunitas"
                                       name="nama_komunitas"
                                       value="{{ old('nama_komunitas', $community->nama_komunitas) }}"
                                       required>
                                @error('nama_komunitas')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                                <textarea
                                    class="w-full px-4 py-3 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/80 transition-all min-h-[150px]"
                                    id="deskripsi"
                                    name="deskripsi"
                                    rows="5"
                                    required>{{ old('deskripsi', $community->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-8">
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Gambar Komunitas</label>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                                    @if($community->gambar)
                                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                                            <p class="text-sm font-medium text-blue-700 mb-2">Gambar Saat ini:</p>
                                            <div class="relative group overflow-hidden rounded-lg">
                                                <img src="{{ asset('storage/' . $community->gambar) }}"
                                                     alt="{{ $community->nama_komunitas }}"
                                                     class="w-full h-48 object-cover rounded-lg transition-all duration-300 group-hover:scale-105">
                                                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end justify-center p-4">
                                                    <p class="text-white text-sm font-medium">Gambar Komunitas Terkini</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-4 rounded-xl border border-blue-100">
                                        <p class="text-sm font-medium text-blue-700 mb-2">Unggah Gambar Baru:</p>
                                        <div class="relative">
                                            <input type="file"
                                                class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                                                file:rounded-lg file:border-0 file:text-sm file:font-medium
                                                file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer
                                                @error('gambar') border-red-500 @enderror"
                                                id="gambar"
                                                name="gambar"
                                                accept="image/*">
                                            <p class="mt-2 text-xs text-gray-600">Maks: 2MB, Format: JPEG, PNG, JPG, GIF</p>

                                            <div id="imagePreview" class="mt-4 hidden">
                                                <p class="text-sm font-medium text-blue-700 mb-2">Pratinjau Gambar Baru:</p>
                                                <img src="#" alt="Pratinjau Gambar Baru" class="max-h-48 rounded-lg border border-blue-200 object-contain">
                                            </div>

                                            @error('gambar')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                <a href="{{ route('communities.show', $community) }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg flex items-center transition-all">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Batal
                                </a>
                                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white rounded-lg flex items-center transition-all shadow-md transform hover:-translate-y-1">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Perbarui Komunitas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Kartu Inisiatif Komunitas -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-xl border border-blue-100 overflow-hidden fade-in-up animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="bg-gradient-to-r from-teal-600 to-cyan-600 p-5 flex justify-between items-center">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Inisiatif Komunitas
                        </h2>
                        <button id="add-initiative" type="button" class="px-3 py-1.5 bg-white/20 hover:bg-white/30 text-white rounded-lg flex items-center transition-all text-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Inisiatif
                        </button>
                    </div>

                    <div class="p-6">
                        <div id="initiatives-container" class="space-y-4">
                            @forelse($community->initiatives as $initiative)
                                <div class="initiative-item p-4 border border-blue-200 rounded-xl bg-gradient-to-br from-white to-blue-50/30">
                                    <div class="flex justify-between items-center mb-3">
                                        <h6 class="initiative-number font-medium text-blue-800">Inisiatif #{{ $loop->iteration }}</h6>
                                        <button type="button" class="remove-initiative text-sm p-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 flex items-center" {{ $loop->count == 1 ? 'disabled' : '' }}>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                                            <input type="text"
                                                   name="initiatives[{{ $loop->index }}][title]"
                                                   class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90"
                                                   value="{{ $initiative->judul }}"
                                                   placeholder="contoh: Perlindungan Terumbu Karang"
                                                   required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                                            <select name="initiatives[{{ $loop->index }}][icon]"
                                                    class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90">
                                                <option value="air" data-image="{{ asset('icon/waterdrop.png') }}"">Air</option>
                                                 <option value="ikan" data-image="{{ asset('icon/fish.png') }}"">Ikan</option>
                                                <option value="terumbuhkarang" data-image="{{ asset('icon/coral-reef.png') }}">Terumbu Karang</option>
                                                <option value="alga" data-image="{{ asset('icon/seaweed.png') }} ">Alga</option>
                                                <option value="plankton" data-image="{{ asset('icon/plankton.png') }}">Alga dan Plankton</option>
                                                <option value="limbahlaut" data-image="{{ asset('icon/water-polution.png') }} ">Limbah Laut</option>
                                                <option value="hewanlangkah" data-image="{{ asset('atorage/icon/seaanimal.png') }}">Hewan Langka</option>
                                                <option value="lautdalam data-image="{{ asset('icon/sea.png') }}">Laut Dalam</option>
                                                <option value="custom-pesisir" data-image="{{ asset('icon/beach.png') }}">Pesisir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                        <textarea name="initiatives[{{ $loop->index }}][deskripsi]"
                                                  class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90"
                                                  rows="2"
                                                  placeholder="Deskripsi singkat tentang inisiatif ini"
                                                  required>{{ $initiative->deskripsi }}</textarea>
                                    </div>
                                    <input type="hidden" name="initiatives[{{ $loop->index }}][prioritas]" value="{{ $initiative->urutan_prioritas }}" class="initiative-order">
                                </div>
                            @empty
                                <div class="initiative-item p-4 border border-blue-200 rounded-xl bg-gradient-to-br from-white to-blue-50/30">
                                    <div class="flex justify-between items-center mb-3">
                                        <h6 class="initiative-number font-medium text-blue-800">Inisiatif #1</h6>
                                        <button type="button" class="remove-initiative text-sm p-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 flex items-center" disabled>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                                            <input type="text"
                                                   name="initiatives[0][title]"
                                                   class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90"
                                                   placeholder="contoh: Perlindungan Terumbu Karang"
                                                   required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                                            <select name="initiatives[0][icon]"
                                                    class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90">
                                                <option value="fas fa-water">Air</option>
                                                <option value="fas fa-fish">Ikan</option>
                                                <option value="fas fa-leaf">Terumbu Karang</option>
                                                <option value="fas fa-recycle">Alga</option>
                                                <option value="fas fa-seedling">Limbah Laut</option>
                                                <option value="fas fa-globe-americas">Hewan Langka</option>
                                                <option value="fas fa-hands-helping">Laut Dalam</option>
                                                <option value="fas fa-book">Pesisir</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                        <textarea name="initiatives[0][deskripsi]"
                                                  class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90"
                                                  rows="2"
                                                  placeholder="Deskripsi singkat tentang inisiatif ini"
                                                  required></textarea>
                                    </div>
                                    <input type="hidden" name="initiatives[0][prioritas]" value="0" class="initiative-order">
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Statistik Komunitas -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Kartu Info Cepat Komunitas -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-xl border border-blue-100 overflow-hidden fade-in-up animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="bg-gradient-to-r from-cyan-600 to-teal-600 p-5">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                           Informasi Singkat Komunitas
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center p-3 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg border border-blue-100">
                                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Dibuat Pada</p>
                                    <p class="text-gray-700 font-medium">{{App\Helpers\IndonesiaTimeHelper::formatDate($community->created_at)}}</p>
                                    <p class="text-xs text-gray-500">{{App\Helpers\IndonesiaTimeHelper::diffForHumans( $community->created_at)}}</p>
                                </div>
                            </div>

                            <div class="flex items-center p-3 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg border border-blue-100">
                                <div class="p-2 bg-green-100 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Total Anggota</p>
                                    <p class="text-gray-700 font-medium">{{ $community->users->count() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center p-3 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg border border-blue-100">
                                <div class="p-2 bg-cyan-100 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Total Pesan</p>
                                    <p class="text-gray-700 font-medium">{{ $community->messages->count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('communities.show', $community) }}" target="_blank" class="w-full flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg transition-all shadow-md transform hover:-translate-y-1">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Komunitas
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Statistik Cepat Anggota -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-xl border border-blue-100 overflow-hidden fade-in-up animate-on-scroll" style="animation-delay: 0.4s;">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-5">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Anggota Komunitas
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-center mb-4">
                            <div class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-3xl font-bold text-blue-600">{{ $community->users->count() }}</div>
                                    <div class="text-sm text-gray-600">Total Anggota</div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 space-y-2">
    <!-- Tombol Lihat Daftar Anggota - menggunakan JavaScript vanilla -->
    <button type="button" id="toggleMemberList" class="w-full py-2.5 px-4 bg-blue-100 text-blue-800 rounded-lg hover:bg-blue-200 transition-all flex justify-between items-center">
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            Lihat Daftar Anggota
        </span>
        <svg class="w-5 h-5 transform transition-transform" id="memberArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <!-- Tombol Kelola Anggota - tambahkan href ke route yang benar -->
    <a href="{{ route('communities.moderation', $community) }}" class="w-full py-2.5 px-4 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition-all flex justify-between items-center">
        <span class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            Kelola Anggota
        </span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </a>
</div>
                    </div>
                </div>

                <!-- Kartu Zona Berbahaya -->
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-xl border border-blue-100 overflow-hidden fade-in-up animate-on-scroll" style="animation-delay: 0.5s;">
                    <div class="bg-gradient-to-r from-red-600 to-pink-600 p-5">
                        <h2 class="text-xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            Tindakan Berisiko
                        </h2>
                    </div>
                    <div class="p-6">
                        <div class="p-4 border border-red-200 bg-red-50 rounded-lg">
                            <h3 class="text-lg font-medium text-red-800 mb-2">Hapus Komunitas</h3>
                            <p class="text-sm text-red-600 mb-4">Tindakan ini akan menghapus seluruh isi komunitas.</p>

                            <form action="{{ route('admin.communities.destroy', $community) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komunitas ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg flex items-center transition-colors">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Komunitas
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Anggota yang Dapat Diciutkan -->
       <div class="hidden mt-8 fade-in-up animate-on-scroll" id="membersList" style="animation-delay: 0.6s;">
              <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-xl border border-blue-100 overflow-hidden">
                <div class="p-6">
                    <h5 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    Anggota Komunitas
                    </h5>
                    <div class="overflow-x-auto rounded-xl border border-blue-100">
                        <table class="min-w-full divide-y divide-blue-200">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Nama</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Bergabung</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-blue-800 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-blue-100">
                                @forelse($community->users as $user)
                                    <tr class="hover:bg-blue-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->user_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->pivot->tg_gabung->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-800 mr-3">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                            <button type="button" class="text-red-600 hover:text-red-800">
                                                <i class="fas fa-user-minus"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada anggota</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Efek Animasi Laut */
.ocean-waves {
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(54,187,252,0.15) 100%);
    background-size: 400% 400%;
    animation: wave 15s ease-in-out infinite;
    transform: translateZ(0);
}

.floating-particles {
    background-image:
        radial-gradient(circle at 85% 15%, rgba(255,255,255,0.15) 1px, transparent 1px),
        radial-gradient(circle at 20% 40%, rgba(255,255,255,0.1) 1.5px, transparent 1.5px),
        radial-gradient(circle at 30% 70%, rgba(255,255,255,0.2) 1px, transparent 1px),
        radial-gradient(circle at 70% 90%, rgba(255,255,255,0.1) 1.5px, transparent 1.5px),
        radial-gradient(circle at 40% 25%, rgba(255,255,255,0.15) 1px, transparent 1px);
    background-size: 300px 300px;
    animation: floatingParticles 60s linear infinite;
}

.ocean-bubbles {
    background-image:
        radial-gradient(circle at 90% 10%, rgba(255,255,255,0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 20% 50%, rgba(255,255,255,0.7) 1px, transparent 1px),
        radial-gradient(circle at 30% 80%, rgba(255,255,255,0.6) 0.8px, transparent 0.8px),
        radial-gradient(circle at 60% 30%, rgba(255,255,255,0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 80% 60%, rgba(255,255,255,0.7) 1px, transparent 1px);
    background-size: 100px 100px;
    animation: bubbleRise 25s linear infinite;
}

.underwater-current {
    background: linear-gradient(45deg,
        rgba(0,115,209,0) 0%,
        rgba(0,115,209,0.02) 50%,
        rgba(0,115,209,0) 100%);
    background-size: 200% 200%;
    animation: underwaterCurrent 15s ease-in-out infinite;
}

.deep-sea-bubbles {
    background-image:
        radial-gradient(circle at 15% 85%, rgba(255,255,255,0.15) 4px, transparent 4px),
        radial-gradient(circle at 45% 75%, rgba(255,255,255,0.12) 5px, transparent 5px),
        radial-gradient(circle at 75% 65%, rgba(255,255,255,0.18) 3px, transparent 3px);
    background-size: 300px 300px;
    animation: deepBubbleRise 30s linear infinite;
}

.marine-light-rays {
    background: linear-gradient(45deg,
        transparent 30%,
        rgba(120, 220, 255, 0.08) 40%,
        rgba(120, 220, 255, 0.04) 50%,
        transparent 60%
    );
    background-size: 200px 200px;
    animation: lightRaysMove 15s ease-in-out infinite;
}

/* Utilitas Animasi */
.fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.animate-on-scroll.in-view {
    opacity: 1;
    transform: translate(0);
}

/* Keyframes Animasi */
@keyframes wave {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

@keyframes floatingParticles {
    0% { background-position: 0 0; }
    100% { background-position: 300px 300px; }
}

@keyframes bubbleRise {
    0% { background-position: 0 100%; }
    100% { background-position: 100px 0; }
}

@keyframes underwaterCurrent {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

@keyframes deepBubbleRise {
    0% { background-position: 0 100%, 0 100%, 0 100%; }
    100% { background-position: 0 -300px, 0 -300px, 0 -300px; }
}

@keyframes lightRaysMove {
    0%, 100% {
        transform: translateX(-100px) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateX(100px) rotate(15deg);
        opacity: 0.8;
    }
}

#membersList {
        transition: opacity 0.3s ease, transform 0.3s ease;
        opacity: 0;
        transform: translateY(-20px);
    }

    #membersList:not(.hidden) {
        opacity: 1;
        transform: translateY(0);
    }

    /* Transisi untuk rotasi panah */
    #memberArrow {
        transition: transform 0.3s ease;
    }

    #memberArrow.rotate-180 {
        transform: rotate(180deg);
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animasi elemen saat mereka memasuki viewport
    const animateOnScrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach(element => {
        animateOnScrollObserver.observe(element);
    });

    // Fungsionalitas pratinjau gambar
    document.getElementById('gambar').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });

    // Inisialisasi editor teks kaya untuk deskripsi
    if (document.getElementById('deskripsi') && typeof ClassicEditor !== 'undefined') {
        ClassicEditor
            .create(document.getElementById('deskripsi'))
            .catch(error => {
                console.error(error);
            });
    }


   const toggleMemberListBtn = document.getElementById('toggleMemberList');
    const membersList = document.getElementById('membersList');
    const memberArrow = document.getElementById('memberArrow');

    console.log('Debug dropdown anggota:', {
        toggleBtn: toggleMemberListBtn,
        membersList: membersList,
        arrow: memberArrow
    });

    if (toggleMemberListBtn && membersList && memberArrow) {
        // Pastikan awalnya tersembunyi dan opacity 0
        membersList.style.opacity = '0';
        membersList.classList.add('hidden');

        toggleMemberListBtn.addEventListener('click', function() {
            console.log('Toggle daftar anggota diklik'); // Debugging

            // Toggle visibilitas dengan animasi
            if (membersList.classList.contains('hidden')) {
                // Tampilkan daftar anggota
                membersList.classList.remove('hidden');
                memberArrow.classList.add('rotate-180');

                // Animasikan dengan opacity setelah hidden dihapus
                setTimeout(() => {
                    membersList.style.opacity = '1';
                    membersList.style.transform = 'translateY(0)';
                }, 10);
            } else {
                // Sembunyikan dengan animasi
                membersList.style.opacity = '0';
                membersList.style.transform = 'translateY(-20px)';
                memberArrow.classList.remove('rotate-180');

                // Tunggu animasi selesai baru sembunyikan
                setTimeout(() => {
                    membersList.classList.add('hidden');
                }, 300);
            }
        });
    } else {
        console.error('Salah satu elemen dropdown anggota tidak ditemukan!', {
            toggleBtn: toggleMemberListBtn,
            list: membersList,
            arrow: memberArrow
        });
    }

    // Manajemen inisiatif
    const container = document.getElementById('initiatives-container');
    const addButton = document.getElementById('add-initiative');
    let initiativeCount = {{ $community->initiatives->count() ?: 1 }};

    // Tambahkan inisiatif baru
    addButton.addEventListener('click', function() {
        const newInitiative = document.createElement('div');
        newInitiative.className = 'initiative-item p-4 border border-blue-200 rounded-xl bg-gradient-to-br from-white to-blue-50/30';
        newInitiative.innerHTML = `
            <div class="flex justify-between items-center mb-3">
                <h6 class="initiative-number font-medium text-blue-800">Inisiatif #${initiativeCount + 1}</h6>
                <button type="button" class="remove-initiative text-sm p-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 flex items-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text"
                           name="initiatives[${initiativeCount}][title]"
                           class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90"
                           placeholder="contoh: Perlindungan Terumbu Karang"
                           required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ikon</label>
                    <select name="initiatives[${initiativeCount}][icon]"
                            class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90">
                        <option value="fas fa-water">Air</option>
                        <option value="fas fa-fish">Ikan</option>
                        <option value="fas fa-leaf">Terumbu Karang</option>
                        <option value="fas fa-recycle">Alga</option>
                        <option value="fas fa-seedling">Limbah Laut</option>
                        <option value="fas fa-globe-americas">Hewan Langka</option>
                        <option value="fas fa-hands-helping">Laut Dalam</option>
                        <option value="fas fa-book">Pesisir</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="initiatives[${initiativeCount}][deskripsi]"
                          class="w-full px-3 py-2 rounded-lg border border-blue-200 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-white/90"
                          rows="2"
                          placeholder="Deskripsi singkat tentang inisiatif ini"
                          required></textarea>
            </div>
            <input type="hidden" name="initiatives[${initiativeCount}][prioritas]" value="${initiativeCount}" class="initiative-order">
        `;
        container.appendChild(newInitiative);
        initiativeCount++;

        // Aktifkan semua tombol hapus jika kita memiliki beberapa inisiatif
        if (initiativeCount > 1) {
            const removeButtons = container.querySelectorAll('.remove-initiative');
            removeButtons.forEach(button => {
                button.disabled = false;
            });
        }

        // Perbarui nomor inisiatif
        updateInitiativeNumbers();
    });

    // Hapus inisiatif
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-initiative') || e.target.parentElement.classList.contains('remove-initiative')) {
            const button = e.target.closest('.remove-initiative');
            const initiativeItem = button.closest('.initiative-item');

            initiativeItem.remove();
            initiativeCount--;

            // Nonaktifkan semua tombol hapus jika hanya tersisa satu inisiatif
            if (initiativeCount === 1) {
                const removeButtons = container.querySelectorAll('.remove-initiative');
                removeButtons.forEach(button => {
                    button.disabled = true;
                });
            }

            // Perbarui nomor inisiatif dan indeks ulang bidang formulir
            updateInitiativeNumbers();
            reindexFormFields();
        }
    });

    // Perbarui nomor inisiatif dalam header
    function updateInitiativeNumbers() {
        const initiatives = container.querySelectorAll('.initiative-item');
        initiatives.forEach((item, index) => {
            item.querySelector('.initiative-number').textContent = `Inisiatif #${index + 1}`;
        });
    }

    // Indeks ulang bidang formulir setelah penghapusan
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

            // Perbarui bidang urutan
            const orderInput = item.querySelector('.initiative-order');
            if (orderInput) {
                orderInput.value = index;
                orderInput.setAttribute('name', `initiatives[${index}][prioritas]`);
            }
        });
    }
});
</script>
@endsection