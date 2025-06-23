@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen pb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Sidebar Profil -->
            <div class="col-span-1">
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-md p-6 mb-6 border-t-4 border-blue-500 relative overflow-hidden">
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>
                    
                    <div class="flex flex-col items-center text-center relative z-10">
                        <div class="relative mb-4">
                            <img class="h-32 w-32 rounded-full object-cover border-4 border-blue-100 shadow-lg"
                                 src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('img/default-avatar.png') }}"
                                 alt="{{ Auth::user()->name }}">
                        </div>
                        <h2 class="text-xl font-medium text-gray-900">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ Auth::user()->email }}</p>
                        <div class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded mb-4">
                            Administrator
                        </div>

                        <div class="w-full">
                            <a href="{{ route('admin.edit-profile') }}" class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition duration-300">
                                Edit Profil
                            </a>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mt-6 pt-4 relative z-10">
                        <h3 class="text-sm font-medium text-gray-500 mb-3">Statistik Admin</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center justify-between">
                                <span class="text-gray-600">Artikel Disetujui</span>
                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['articles_approved'] }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-gray-600">Artikel Ditolak</span>
                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['articles_rejected'] }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-gray-600">Total Pengguna</span>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $stats['users_count'] }}</span>
                            </li>
                            <li class="flex items-center justify-between">
                                <span class="text-gray-600">Admin Sejak</span>
                                <span class="text-gray-600 text-sm">{{ $stats['admin_since'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bagian Bio -->
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-md p-6 border-t-4 border-teal-500 relative overflow-hidden">
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-teal-400/20 animate-wave opacity-60"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-teal-500/20 animate-wave-slow opacity-40"></div>
                    
                    <h3 class="font-medium text-gray-900 mb-2 relative z-10">Tentang Saya</h3>
                    <p class="text-gray-600 relative z-10">
                        {{ Auth::user()->bio ?: 'Belum ada biodata. Ceritakan tentang Anda dengan mengedit profil.' }}
                    </p>
                </div>
            </div>

            <!-- Area Konten Utama -->
            <div class="col-span-2 space-y-6">
                <!-- Link Cepat -->
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-md p-6 border-t-4 border-purple-500 relative overflow-hidden">
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-purple-400/20 animate-wave opacity-60"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-purple-500/20 animate-wave-slow opacity-40"></div>
                    
                    <h2 class="text-lg font-medium text-gray-900 mb-4 relative z-10">Aksi Admin Cepat</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10">
                        <a href="{{ route('admin.articles.pending') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200 bg-white/70">
                            <div class="p-3 bg-yellow-100 rounded-full mr-3">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">Artikel Tertunda</h3>
                                <p class="text-sm text-gray-500">Tinjau dan setujui kiriman pengguna</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.users.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200 bg-white/70">
                            <div class="p-3 bg-blue-100 rounded-full mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">Kelola Pengguna</h3>
                                <p class="text-sm text-gray-500">Lihat dan kelola akun pengguna</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.dashboard.community') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200 bg-white/70">
                            <div class="p-3 bg-purple-100 rounded-full mr-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">Komunitas</h3>
                                <p class="text-sm text-gray-500">Kelola komunitas</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.dashboard.article') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200 bg-white/70">
                            <div class="p-3 bg-green-100 rounded-full mr-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-900">Artikel</h3>
                                <p class="text-sm text-gray-500">Kelola artikel</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Pengaturan Akun -->
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-md p-6 border-t-4 border-cyan-500 relative overflow-hidden">
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-cyan-400/20 animate-wave opacity-60"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-cyan-500/20 animate-wave-slow opacity-40"></div>
                    
                    <h2 class="text-lg font-medium text-gray-900 mb-4 relative z-10">Pengaturan Akun</h2>

                    <div class="space-y-4 relative z-10">
                        <a href="{{ route('admin.edit-profile') }}" class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200 bg-white/70">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-900">Edit Profil</h3>
                                    <p class="text-sm text-gray-600">Perbarui informasi pribadi Anda</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.change-password') }}" class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-200 bg-white/70">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <div>
                                    <h3 class="font-medium text-gray-900">Ganti Kata Sandi</h3>
                                    <p class="text-sm text-gray-600">Perbarui informasi keamanan Anda</p>
                                </div>
                            </div>
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="particle particle-1"></div>
<div class="particle particle-2"></div>
<div class="particle particle-3"></div>
@endsection

@section('scripts')
<script>
    // Animasi Gelembung Dashboard Admin
    document.addEventListener('DOMContentLoaded', function() {
        // Membuat gelembung di latar belakang dashboard admin
        const container = document.querySelector('.bg-gradient-to-r.min-h-screen');

        if (!container) {
            console.error('Container gelembung tidak ditemukan');
            return; // Keluar jika container tidak ditemukan
        }

        // Fungsi untuk membuat satu gelembung
        function createBubble() {
            const bubble = document.createElement('div');
            const size = Math.random() * 60 + 20; // Ukuran acak antara 20-80px
            const left = Math.random() * 100; // Posisi horizontal acak
            const delay = Math.random() * 5; // Delay acak
            const duration = Math.random() * 15 + 10; // Durasi acak antara 10-25s

            bubble.className = 'admin-bubble';
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.bottom = '-100px'; // Mulai dari bawah
            bubble.style.animationDuration = `${duration}s`;
            bubble.style.animationDelay = `${delay}s`;

            container.appendChild(bubble);

            // Hapus gelembung setelah animasi untuk mencegah masalah memori
            setTimeout(() => {
                if (bubble && bubble.parentNode) {
                    bubble.parentNode.removeChild(bubble);
                }
            }, (duration + delay) * 1000);
        }

        // Gelembung awal
        for (let i = 0; i < 15; i++) {
            setTimeout(createBubble, i * 300);
        }

        // Membuat gelembung baru secara berkala
        setInterval(createBubble, 2000);
    });
</script>
@endsection

@section('styles')
<style>
/* Animasi gelombang yang ditingkatkan */
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

/* Animasi gelembung */
.admin-bubble {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%,
                               rgba(255,255,255,0.8),
                               rgba(255,255,255,0.3) 30%,
                               rgba(255,255,255,0.1) 60%);
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.4),
                inset 0 0 6px rgba(255, 255, 255, 0.4);
    opacity: 0.3;
    z-index: 1;
    animation: bubble-float 15s ease-in infinite;
    pointer-events: none;
    will-change: transform, opacity;
}

/* Meningkatkan animasi gelembung */
@keyframes bubble-float {
    0% {
        transform: translateY(0) translateX(0) scale(0.4);
        opacity: 0;
    }
    10% {
        opacity: 0.3;
        transform: translateY(-20vh) translateX(5px) scale(0.6);
    }
    40% {
        opacity: 0.4;
        transform: translateY(-40vh) translateX(-10px) scale(0.8);
    }
    70% {
        opacity: 0.3;
        transform: translateY(-70vh) translateX(10px) scale(0.9);
    }
    90% {
        opacity: 0.2;
    }
    100% {
        transform: translateY(-100vh) translateX(-5px) scale(0.7);
        opacity: 0;
    }
}

.animate-wave {
    animation: wave 8s linear infinite;
}

.animate-wave-slow {
    animation: wave-slow 12s linear infinite;
}

.text-shadow {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Animasi partikel */
.particle {
    position: absolute;
    background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    opacity: 0.3;
    z-index: 5;
}

.particle-1 {
    width: 80px;
    height: 80px;
    top: 10%;
    left: 10%;
    animation: float 20s infinite ease-in-out;
}

.particle-2 {
    width: 50px;
    height: 50px;
    top: 20%;
    right: 20%;
    animation: float 15s infinite ease-in-out reverse;
}

.particle-3 {
    width: 35px;
    height: 35px;
    bottom: 30%;
    left: 30%;
    animation: float 25s infinite ease-in-out 5s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0) translateX(0);
    }
    25% {
        transform: translateY(-15px) translateX(15px);
    }
    50% {
        transform: translateY(8px) translateX(-8px);
    }
    75% {
        transform: translateY(-5px) translateX(10px);
    }
}
.admin-bubble {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle at 30% 30%,
                               rgba(255,255,255,0.8),
                               rgba(255,255,255,0.3) 30%,
                               rgba(255,255,255,0.1) 60%);
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.4),
                inset 0 0 6px rgba(255, 255, 255, 0.4);
    opacity: 0.3;
    z-index: 1;
    animation: bubble-float 15s ease-in infinite;
    pointer-events: none;
    will-change: transform, opacity;
}

.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(83, 157, 196) 0%, rgb(65, 120, 183) 100%);
}

.absolute.inset-0.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(109, 176, 214) 0%, rgb(52, 149, 190) 100%);
    opacity: 0.9 !important; /* Tingkatkan opacity */
}

/* Tambahkan efek kilauan pada latar belakang */
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
}

/* Tambahkan efek bayangan pada kartu */
.bg-white\/90 {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
</style>
@endsection