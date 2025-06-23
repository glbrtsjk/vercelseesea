@extends('layouts.app')

@section('title', 'Ubah Kata Sandi')

@section('content')
<!-- Latar Belakang Bertema Laut dengan Animasi Gelembung -->
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Animasi Latar Belakang Laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <!-- Bagian Hero dengan Latar Gradien -->
    <div class="bg-gradient-to-br from-blue-500 via-blue-900 to-teal-900 text-white py-10 relative z-10">
        <div class="container mx-auto px-4 relative">
            <h1 class="text-3xl font-bold mb-2">Ubah Kata Sandi</h1>
            <p class="mt-2">Tingkatkan keamanan akun Anda dengan kata sandi yang kuat.</p>

            <!-- Elemen Bawah Laut -->
            <div class="absolute inset-0 z-0 overflow-hidden">
                <div class="deep-sea-bubbles opacity-20"></div>
                <div class="marine-light-rays"></div>
                <div class="floating-particles absolute inset-0"></div>
            </div>
        </div>
    </div>

    <!-- SubNavbar mirip dengan halaman Dashboard -->
    <div class="bg-blue-100 shadow-md relative z-10">
        <div class="container mx-auto">
            <ul class="flex flex-wrap -mb-px text-lg font-medium text-center">
                <li class="mr-2">
                    <a href="{{ route('user.dashboard') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.articles') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-newspaper mr-2"></i> Artikel Saya
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.communities') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-users mr-2"></i> Komunitas
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.profile') }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/90 to-emerald-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 notification-toast">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('success') }}</div>
                    <button type="button" class="text-white hover:text-white/80 close-notification">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-500/90 to-rose-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 notification-toast">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('error') }}</div>
                    <button type="button" class="text-white hover:text-white/80 close-notification">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="max-w-3xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar Navigasi Profil -->
                <div class="col-span-1">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-right animate-on-scroll">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Pengaturan Profil</span>
                        </h3>

                        <nav class="space-y-2 mt-4">
                            <a href="{{ route('user.profile') }}" class="ocean-quick-link flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r from-blue-50 to-cyan-50 hover:text-gray-900 transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-600 mr-3 shadow-inner">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Profil Saya</span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <div class="ocean-quick-link-bubbles"></div>
                            </a>

                            <a href="{{ route('user.edit-profile') }}" class="ocean-quick-link flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r from-blue-50 to-cyan-50 hover:text-gray-900 transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-600 mr-3 shadow-inner">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Edit Profil</span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <div class="ocean-quick-link-bubbles"></div>
                            </a>

                            <a href="{{ route('user.change-password') }}" class="ocean-quick-link flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg bg-gradient-to-r from-cyan-50 to-blue-50 border-l-4 border-blue-500 text-gray-900 transition-all duration-300">
                                <div class="flex items-center">
                                    <div class="p-2 rounded-full bg-gradient-to-r from-cyan-100 to-cyan-200 text-cyan-600 mr-3 shadow-inner">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="font-medium text-gray-900">Ubah Kata Sandi</span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                                <div class="ocean-quick-link-bubbles"></div>
                            </a>
                        </nav>

                        <div class="mt-8 p-4 bg-gradient-to-br from-amber-50 to-yellow-50 rounded-xl border border-amber-100">
                            <div class="flex items-center">
                                <div class="p-3 bg-amber-100 rounded-full mr-4">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-gray-800 font-medium">Tips Keamanan</h3>
                                    <p class="text-sm text-gray-600">Gunakan kata sandi unik yang mengandung huruf, angka, dan simbol untuk keamanan maksimal.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Ubah Kata Sandi -->
                <div class="col-span-2">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Ubah Kata Sandi</span>
                        </h2>

                        <form action="{{ route('admin.change-password') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Kata Sandi Saat Ini -->
                            <div class="space-y-2">
                                <label class=" text-gray-700 text-sm font-medium mb-2 flex items-center" for="current_password">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                    </svg>
                                    Kata Sandi Saat Ini
                                </label>
                                <div class="relative">
                                    <input type="password" name="current_password" id="current_password" required
                                        class="w-full px-4 py-3 border border-blue-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kata Sandi Baru -->
                            <div class="space-y-2">
                                <label class=" text-gray-700 text-sm font-medium mb-2 flex items-center" for="password">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Kata Sandi Baru
                                </label>
                                <div class="relative">
                                    <input type="password" name="password" id="password" required
                                        class="w-full px-4 py-3 border border-blue-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Minimal 8 karakter</p>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Konfirmasi Kata Sandi Baru -->
                            <div class="space-y-2">
                                <label class=" text-gray-700 text-sm font-medium mb-2 flex items-center" for="password_confirmation">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    Konfirmasi Kata Sandi Baru
                                </label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="w-full px-4 py-3 border border-blue-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Panduan Kata Sandi -->
                            <div class="p-4 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-100">
                                <h4 class="font-medium text-gray-800 flex items-center mb-2">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Panduan Kata Sandi Yang Kuat
                                </h4>
                                <ul class="space-y-1 text-sm text-gray-600 pl-8 list-disc">
                                    <li>Minimal 8 karakter</li>
                                    <li>Gabungan huruf kecil dan huruf besar</li>
                                    <li>Sertakan angka dan simbol (seperti @, !, #)</li>
                                    <li>Hindari informasi pribadi yang mudah ditebak</li>
                                </ul>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="pt-6 border-t border-gray-200 flex items-center justify-between">
                                <a href="{{ route('user.profile') }}" class="bg-gray-100 text-gray-700 hover:bg-gray-200 px-6 py-3 rounded-xl text-sm font-medium transition duration-300 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Batal
                                </a>
                                <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-xl text-sm font-medium transition duration-300 shadow-md transform hover:-translate-y-1 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Perbarui Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animasi gelembung -->
        <div class="submarine-bubbles absolute bottom-0 left-0 right-0 top-0 pointer-events-none"></div>
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

/* Efek Border Profil Laut */
.ocean-profile-border {
    position: relative;
    border: 2px solid transparent;
    background: linear-gradient(to right, #38bdf8, #0ea5e9, #0284c7);
    background-clip: padding-box;
    box-shadow: 0 0 15px rgba(56, 189, 248, 0.3);
}

.ocean-profile-border::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    z-index: -1;
    background: linear-gradient(45deg, #38bdf8, #0ea5e9, #0284c7, #38bdf8);
    border-radius: inherit;
    animation: rotate 3s linear infinite;
}

.ocean-quick-link {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.ocean-quick-link:hover {
    transform: translateX(4px);
}

.ocean-quick-link-bubbles {
    position: absolute;
    bottom: -5px;
    right: 10px;
    width: 20px;
    height: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
    background-image:
        radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.4) 2px, transparent 2px),
        radial-gradient(circle at 70% 30%, rgba(56, 189, 248, 0.3) 1.5px, transparent 1.5px),
        radial-gradient(circle at 30% 40%, rgba(56, 189, 248, 0.4) 1px, transparent 1px);
    animation: quickLinkBubbleRise 3s ease-in-out infinite;
}

.ocean-quick-link:hover .ocean-quick-link-bubbles {
    opacity: 1;
}

/* Animasi Utilitas */
.fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in-right {
    opacity: 0;
    transform: translateX(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.animate-on-scroll.in-view {
    opacity: 1;
    transform: translate(0);
}

/* Gelembung Kapal Selam untuk efek latar belakang yang halus */
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

/* Notifikasi toast fade out */
.notification-toast {
    animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 5s forwards;
}

/* Animasi Keyframes */
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

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes quickLinkBubbleRise {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
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

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-20px); }
}

/* Tambahkan lebih banyak gelembung */
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

    // Tutup notifikasi toast
    document.querySelectorAll('.close-notification').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.notification-toast').style.display = 'none';
        });
    });

    // Gelembung muncul secara acak
    function createRandomBubbles() {
        const container = document.querySelector('.underwater-current');
        if (!container) return;

        for (let i = 0; i < 15; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('random-bubble');

            const size = Math.random() * 10 + 5;
            const left = Math.random() * 100;
            const animationDuration = Math.random() * 15 + 10;
            const delay = Math.random() * 15;

            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.animationDuration = `${animationDuration}s`;
            bubble.style.animationDelay = `${delay}s`;

            container.appendChild(bubble);
        }
    }

    createRandomBubbles();

    // Menambahkan validasi dasar untuk kata sandi
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const submitButton = document.querySelector('button[type="submit"]');

    if (passwordInput && confirmInput) {
        function validatePassword() {
            if (passwordInput.value !== confirmInput.value) {
                confirmInput.setCustomValidity('Kata sandi tidak cocok');
            } else {
                confirmInput.setCustomValidity('');
            }
        }

        passwordInput.addEventListener('change', validatePassword);
        confirmInput.addEventListener('keyup', validatePassword);
    }
});
</script>
@endsection
