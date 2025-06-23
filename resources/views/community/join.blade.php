

@extends('layouts.app')

@section('title', 'Gabung ' . $community->nama_komunitas . ' | Komunitas Konservasi Laut')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Latar Belakang Animasi Laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <div class="container mx-auto py-10 px-4 relative">
        <!-- Lencana & Judul Komunitas -->
        <div class="flex flex-col items-center mb-8">
            <div class="relative inline-block">
                @if($community->status === 'endangered')
                <!-- Lencana SOS -->
                <span class="absolute -right-3 -top-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-600 text-white animate__animated animate__heartBeat animate__infinite animate__slower">
                    SOS
                    <span class="sr-only">Peringatan Laut</span>
                </span>
                @endif

                <!-- Judul & Subjudul -->
                <div class="text-center">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2 animate__animated animate__fadeIn">
                        {{ $community->nama_komunitas }}
                    </h1>
                    <div class="flex items-center justify-center text-cyan-600 animate__animated animate__fadeIn animate__delay-1s">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Inisiatif Konservasi Laut Global</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-7 gap-6 max-w-6xl mx-auto">
            <div class="lg:col-span-5">
                <!-- Kartu Statistik Dampak -->
                <div class="bg-gradient-to-r from-slate-900/90 to-blue-900/80 rounded-xl overflow-hidden shadow-xl shadow-blue-900/20 backdrop-blur-sm mb-6 animate__animated animate__fadeInUp">
                    <div class="bg-gradient-to-r from-blue-700 to-cyan-600 px-6 py-4 border-b border-blue-700/50">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <h2 class="text-xl font-bold text-white">Dashboard Dampak Konservasi</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                            <div class="p-4 rounded-lg bg-white/5 backdrop-blur-sm">
                                <div class="text-3xl font-bold text-cyan-400 mb-1 counter-animation" data-count="{{ $community->users->count() }}">0</div>
                                <div class="text-xs text-blue-100">Pembela Laut</div>
                            </div>
                            <div class="p-4 rounded-lg bg-white/5 backdrop-blur-sm">
                                <div class="text-3xl font-bold text-cyan-400 mb-1 counter-animation" data-count="{{ $stats['messages_count'] ?? 0 }}">0</div>
                                <div class="text-xs text-blue-100">Update Konservasi</div>
                            </div>
                            <div class="p-4 rounded-lg bg-white/5 backdrop-blur-sm">
                                <div class="text-3xl font-bold text-cyan-400 mb-1 counter-animation" data-count="{{ $stats['events_count'] ?? 0 }}">0</div>
                                <div class="text-xs text-blue-100">Acara Laut</div>
                            </div>
                            <div class="p-4 rounded-lg bg-white/5 backdrop-blur-sm">
                                <div class="text-3xl font-bold text-cyan-400 mb-1 counter-animation" data-count="{{ $stats['days_active'] ?? 0 }}">0</div>
                                <div class="text-xs text-blue-100">Hari Berkegiatan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kartu Konten Utama -->
                <div class="bg-white rounded-xl overflow-hidden shadow-xl animate__animated animate__fadeInUp animate__delay-1s">
                    <!-- Banner Komunitas -->
                    <div class="relative h-56 md:h-64">
                        @if($community->gambar)
                            <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-r from-blue-600 to-cyan-500 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6">
                            <h2 class="text-2xl font-bold text-white mb-1">Bergabung dengan Misi Laut Kami</h2>
                            <p class="text-blue-100">Bersama kita bisa melindungi planet biru kita</p>
                        </div>
                    </div>

                    <!-- Bagian Konten -->
                    <div class="p-6 md:p-8">
                        <div class="grid md:grid-cols-5 gap-6">
                            <!-- Kolom Kiri: Deskripsi Komunitas -->
                            <div class="md:col-span-3">
                                <div class="mb-8">
                                    <h3 class="text-xl font-bold text-slate-800 mb-4">Tentang Komunitas Konservasi Ini</h3>
                                    <div class="prose text-slate-600">
                                        {!! Str::limit(strip_tags($community->deskripsi), 300) !!}
                                        @if(strlen(strip_tags($community->deskripsi)) > 300)
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#descriptionModal" class="text-blue-600 inline-flex items-center hover:text-blue-700">
                                                Baca selengkapnya
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Status Kesehatan Laut -->
                                <div class="mb-8 bg-blue-50 rounded-xl p-5 shadow-md">
                                    <div class="flex items-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h3 class="text-lg font-bold text-slate-800">Status Kesehatan Laut Lokal</h3>
                                    </div>

                                    <div class="mb-2">
                                        <div class="w-full bg-blue-200 rounded-full h-3">
                                            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 h-3 rounded-full" style="width: 65%"></div>
                                        </div>
                                        <div class="flex justify-end mt-1">
                                            <span class="text-sm font-medium text-blue-700">65%</span>
                                        </div>
                                    </div>

                                    <p class="text-sm text-blue-800">Status kesehatan laut saat ini memerlukan upaya konservasi berkelanjutan di wilayah ini.</p>
                                </div>

                                <!-- Inisiatif Konservasi - Tampilan utama -->
                                <div class="mb-8">
                                    <div class="flex items-center mb-4 pb-2 border-b border-slate-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                        <h3 class="text-lg font-bold text-slate-800">Inisiatif {{ $community->nama_komunitas }}</h3>
                                    </div>

                                    @if($community->initiatives && $community->initiatives->count() > 0)
                                        <div class="space-y-4">
                                            @foreach($community->initiatives->take(3) as $index => $initiative)
                                                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-lg border border-blue-100 shadow-sm transform transition-transform hover:-translate-y-1 hover:shadow-md">
                                                    <div class="flex items-start">
                                                        <div class="flex-shrink-0 h-12 w-12 rounded-full bg-{{ $initiative->color ?? 'blue' }}-100 flex items-center justify-center text-{{ $initiative->color ?? 'blue' }}-600 mr-4">
                                                            @php
                                                // Daftar ikon laut yang dapat digunakan berdasarkan kata kunci
                                                        $oceanIcons = [
                                                    'terumbu' => 'fas fa-water',
                                                    'karang' => 'fas fa-baseball-ball',
                                                    'mangrove' => 'fas fa-tree',
                                                    'pantai' => 'fas fa-umbrella-beach',
                                                    'plastik' => 'fas fa-recycle',
                                                    'sampah' => 'fas fa-trash-alt',
                                                    'pendidikan' => 'fas fa-graduation-cap',
                                                    'penelitian' => 'fas fa-microscope',
                                                    'konservasi' => 'fas fa-shield-alt',
                                                    'kebijakan' => 'fas fa-gavel',
                                                    'ikan' => 'fas fa-fish',
                                                    'kura' => 'fas fa-turtle',
                                                    'penyu' => 'fas fa-angle-up',
                                                    'hiu' => 'fas fa-angle-right',
                                                    'paus' => 'fas fa-water',
                                                    'dugong' => 'fas fa-horse',
                                                    'default' => 'fas fa-wave-square'
                                                ];

                                                // Fungsi untuk menentukan ikon berdasarkan judul atau deskripsi
                                               function getOceanIcon($initiative) {
                                                global $oceanIcons;

                                                $text = strtolower(($initiative->judul ?? '') . ' ' . ($initiative->deskripsi ?? ''));

                                                foreach ($oceanIcons as $keyword => $icon) {
                                                    if (strpos($text, $keyword) !== false) {
                                                        return $icon;
                                                    }
                                                }

                                                // Rotasi ikon default jika tidak ada kata kunci yang cocok
                                                $defaultIcons = [
                                                    'fas fa-water',
                                                    'fas fa-tint',
                                                    'fas fa-wave-square',
                                                    'fas fa-fish',
                                                    'fas fa-wind'
                                                ];

                                                // Gunakan ID inisiatif atau fallback ke nomor acak untuk memilih ikon default yang konsisten
                                                $iconIndex = isset($initiative->id) ? ($initiative->id % count($defaultIcons)) : rand(0, count($defaultIcons) - 1);
                                                return $defaultIcons[$iconIndex];
                                            }
                                                @endphp
                                                <i class="{{ $initiative->icon ?? getOceanIcon($initiative) }} text-xl"></i>
                                                    @php
                                                    $iconClass = $initiative->icon ?? getOceanIcon($initiative);
                                                    @endphp
                                                </div>
                                                        <div class="flex-1">
                                                            <h4 class="font-semibold text-slate-800 text-lg mb-1">{{ $initiative->judul }}</h4>
                                                            <p class="text-slate-600">{{ $initiative->deskripsi}}</p>

                                                            @if(isset($initiative->progress))
                                                                <div class="mt-3">
                                                                    <div class="w-full bg-blue-200/50 rounded-full h-2.5">
                                                                        <div class="bg-gradient-to-r from-blue-500 to-cyan-400 h-2.5 rounded-full" style="width: {{ $initiative->progress }}%"></div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if($community->initiatives->count() > 3)
                                                <div class="text-center pt-2">
                                                    <span class="inline-block bg-blue-50 px-3 py-1.5 text-sm font-medium text-blue-700 rounded-full">
                                                        + {{ $community->initiatives->count() - 3 }} inisiatif lainnya
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="p-6 rounded-lg bg-blue-50 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-blue-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                            </svg>
                                            <h4 class="text-lg font-medium text-blue-800 mb-2">Belum Ada Inisiatif</h4>
                                            <p class="text-blue-600">{{ $community->nama_komunitas }} belum menentukan inisiatif spesifik.</p>
                                            <p class="text-sm text-blue-500 mt-1">Bergabunglah untuk membantu merumuskan program konservasi laut.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Kolom Kanan: Formulir Bergabung -->
                            <div class="md:col-span-2">
                                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-xl overflow-hidden shadow-lg sticky top-4">
                                    <div class="p-6">
                                        <div class="flex flex-col items-center mb-6">
                                            <div class="h-16 w-16 rounded-full bg-white/20 flex items-center justify-center mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-bold text-white mb-1">Bergabunglah dengan Tim Konservasi Kami</h3>
                                            <p class="text-sm text-blue-100 text-center">
                                                Tambahkan suara Anda dengan {{ number_format($community->users->count()) }} pembela laut yang membuat perubahan
                                            </p>
                                        </div>

                                        <!-- Inisiatif Laut di Sidebar -->
                                        <div class="mb-6">
                                            <h4 class="flex items-center text-white text-lg font-semibold mb-3 pb-2 border-b border-blue-500/50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                Inisiatif Laut Kami
                                            </h4>

                                            @if($community->initiatives && $community->initiatives->count() > 0)
                                                <ul class="space-y-3">
                                                    @foreach($community->initiatives as $initiative)
                                                        <li class="bg-white/10 backdrop-blur p-3 rounded-lg">
                                                            <div class="flex items-center">
                                                                <div class="h-8 w-8 rounded-full bg-white/20 flex items-center justify-center mr-3">
                                                                    <i class="{{ $initiative->icon ?? 'fas fa-water' }} text-white/90"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="text-white font-medium">{{ $initiative->judul }}</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="mt-3 text-center">
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-900/50 text-blue-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $community->initiatives->count() }} inisiatif yang sedang berjalan
                                                    </span>
                                                </div>
                                            @else
                                                <div class="text-center py-4">
                                                    <div class="h-12 w-12 mx-auto rounded-full bg-white/10 flex items-center justify-center mb-3">
                                                        <i class="fas fa-seedling text-blue-200"></i>
                                                    </div>
                                                    <p class="text-blue-200 text-sm">Belum ada inisiatif yang ditentukan</p>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Formulir Bergabung -->
                                        <form action="{{ route('communities.join', $community) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full py-3 bg-white hover:bg-blue-50 text-blue-700 font-bold rounded-lg shadow-md transform transition hover:scale-[1.02] flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Bergabung dengan Upaya Konservasi
                                            </button>
                                        </form>

                                        <div class="mt-4">
                                            <div class="text-xs text-blue-200 text-center">
                                                Setelah bergabung, Anda akan menerima update tentang upaya konservasi dan kesempatan untuk berpartisipasi dalam kegiatan perlindungan laut.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Testimoni -->
                                    <div class="border-t border-blue-700/50 p-4 bg-blue-900/30">
                                        <div class="flex items-start space-x-3">
                                            <div class="flex-shrink-0">
                                                <div class="h-8 w-8 rounded-full bg-blue-400 flex items-center justify-center text-blue-800 font-bold">
                                                    M
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-xs text-blue-100 italic">"Bergabung dengan komunitas ini sangat transformatif. Bersama-sama kami telah menyelamatkan habitat laut dan mendorong perubahan nyata."</p>
                                                <p class="text-xs text-blue-300 mt-1">- Marina S., Anggota sejak 2023</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pedoman Komunitas -->
                    <div class="bg-slate-50 p-6 md:p-8 border-t border-slate-200">
                        <h3 class="flex items-center text-lg font-bold text-slate-800 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V6a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Pedoman Perilaku Komunitas
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-md bg-blue-100 flex items-center justify-center text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-slate-800">Pengelolaan Sumber Daya Kelautan</h4>
                                        <p class="text-sm text-slate-600">Dukung praktik berkelanjutan dan penghormatan terhadap ekosistem laut dalam semua diskusi dan kegiatan</p>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-md bg-blue-100 flex items-center justify-center text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-slate-800">Komunikasi yang Hormat</h4>
                                        <p class="text-sm text-slate-600">Bersikap baik, suportif, dan inklusif kepada semua anggota tanpa memandang latar belakang atau tingkat pengalaman</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-md bg-blue-100 flex items-center justify-center text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-slate-800">Pendekatan Berbasis Sains</h4>
                                        <p class="text-sm text-slate-600">Bagikan informasi dan penelitian terverifikasi untuk berkontribusi pada diskusi konservasi berbasis bukti</p>
                                    </div>
                                </div>
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="h-10 w-10 rounded-md bg-blue-100 flex items-center justify-center text-blue-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-semibold text-slate-800">Aksi Kolaboratif</h4>
                                        <p class="text-sm text-slate-600">Berpartisipasi secara konstruktif dalam inisiatif dan berbagi pengetahuan dengan sesama konservasionis</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-200 flex flex-col md:flex-row justify-between md:items-center gap-4">
                            <a href="{{ route('communities.show', $community) }}" class="flex items-center justify-center md:justify-start text-slate-700 hover:text-blue-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Ikhtisar Komunitas
                            </a>
                            <div class="flex items-center justify-center md:justify-end text-slate-500 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Didirikan {{ App\Helpers\IndonesiaTimeHelper::formatDate($community->created_at) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    /* Animasi laut yang sesuai dengan show3.blade.php */
    .ocean-waves {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='rgba(255,255,255,0.2)'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: cover;
        animation: waveAnimation 20s linear infinite alternate;
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

    .ocean-bubbles {
        background-image: radial-gradient(circle, rgba(255,255,255,0.6) 2px, transparent 2px),
                          radial-gradient(circle, rgba(255,255,255,0.4) 1px, transparent 1px);
        background-size: 50px 50px, 30px 30px;
        animation: bubbleRise 15s linear infinite;
        opacity: 0.2;
    }

    .underwater-current {
        background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0) 100%);
        animation: underwaterCurrent 8s ease-in-out infinite;
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

    /* Animasi untuk tombol Call-to-Action */
    .animate__animated.animate__fadeIn {
        animation-duration: 1s;
    }

    .animate__animated.animate__fadeInUp {
        animation-duration: 1s;
        animation-name: fadeInUp;
    }

    .animate__animated.animate__fadeIn.animate__delay-1s {
        animation-delay: 1s;
    }

    .animate__animated.animate__heartBeat {
        animation: heartBeat 1.5s infinite;
    }

    @keyframes heartBeat {
        0% { transform: scale(1); }
        14% { transform: scale(1.1); }
        28% { transform: scale(1); }
        42% { transform: scale(1.1); }
        70% { transform: scale(1); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 20px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    @media (max-width: 767.98px) {
        .bubble-animation {
            display: none;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animasi counter
        const counters = document.querySelectorAll('.counter-animation');

        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-count'));
            const duration = 2000; // Durasi animasi dalam milidetik
            const frameDuration = 1000 / 60; // 60fps
            const totalFrames = Math.round(duration / frameDuration);
            let frame = 0;

            const animate = () => {
                frame++;
                const progress = frame / totalFrames;
                const currentCount = Math.round(target * progress);

                counter.innerText = currentCount;

                if (frame < totalFrames) {
                    requestAnimationFrame(animate);
                } else {
                    counter.innerText = target; // Memastikan nilai akhir tepat
                }
            };

            animate();
        });
    });
</script>
@endsection
