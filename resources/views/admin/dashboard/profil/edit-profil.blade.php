@extends('layouts.admin')

@section('title', 'Edit Profil Admin')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen pb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <!-- Header Section dengan Animasi Gelombang -->
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-lg shadow-lg rounded-xl p-6 mb-8 overflow-hidden border-t-4 border-cyan-400">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Edit Profil Admin</h1>
                    <p class="text-cyan-100 font-medium">Perbarui informasi profil Anda</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.profile') }}" class="bg-cyan-600/70 hover:bg-cyan-700/80 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-cyan-400/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Profil
                    </a>
                </div>

                <!-- Animasi gelombang yang disempurnakan -->
                <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
                <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>
                <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                </div>
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-t-4 border-blue-500 relative overflow-hidden">
                <!-- Latar belakang gelombang -->
                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>

                <div class="relative z-10">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profil</h2>

                    <form action="{{ route('admin.update-profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Foto Profil -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="photo">Foto Profil</label>
                            <div class="flex items-center">
                                <div class="mr-4">
                                    <div class="h-24 w-24 rounded-full overflow-hidden border-4 border-cyan-300 shadow-lg">
                                        <img class="h-full w-full object-cover"
                                            src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('img/default-avatar.png') }}"
                                            alt="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <input type="file" name="foto_profil" id="photo" class="block w-full text-sm text-gray-500
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-blue-50 file:text-blue-700
                                        hover:file:bg-blue-100">
                                    <p class="mt-1 text-sm text-gray-500">JPG, PNG atau GIF. Maksimal ukuran 2MB.</p>
                                    @error('foto_profil')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="name">Nama</label>
                            <div class="relative">
                                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" required
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="email">Alamat Email</label>
                            <div class="relative">
                                <input type="email" name="email" id="email" value="{{ old('email', Auth::user()->email) }}" required
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-medium mb-2" for="bio">Bio</label>
                            <div class="relative">
                                <textarea name="bio" id="bio" rows="4"
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('bio', Auth::user()->bio) }}</textarea>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Ceritakan sedikit tentang diri Anda.</p>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.profile') }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded-lg text-sm font-medium transition duration-300">
                                Batal
                            </a>
                            <button type="submit" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white hover:from-blue-700 hover:to-cyan-600 px-6 py-2 rounded-lg text-sm font-medium transition duration-300 shadow-md">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Perubahan
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animasi Gelembung Admin Dashboard
    document.addEventListener('DOMContentLoaded', function() {
        // Buat gelembung di latar belakang dashboard admin
        const container = document.querySelector('.bg-gradient-to-r.min-h-screen');

        if (!container) {
            console.error('Wadah gelembung tidak ditemukan');
            return; // Keluar jika wadah tidak ditemukan
        }

        // Fungsi untuk membuat gelembung tunggal
        function buatGelembung() {
            const gelembung = document.createElement('div');
            const ukuran = Math.random() * 60 + 20; // Ukuran acak antara 20-80px
            const kiri = Math.random() * 100; // Posisi horizontal acak
            const tunda = Math.random() * 5; // Tunda acak
            const durasi = Math.random() * 15 + 10; // Durasi acak antara 10-25s

            gelembung.className = 'admin-bubble';
            gelembung.style.width = `${ukuran}px`;
            gelembung.style.height = `${ukuran}px`;
            gelembung.style.left = `${kiri}%`;
            gelembung.style.bottom = '-100px'; // Mulai dari bawah
            gelembung.style.animationDuration = `${durasi}s`;
            gelembung.style.animationDelay = `${tunda}s`;

            container.appendChild(gelembung);

            // Hapus gelembung setelah animasi untuk mencegah masalah memori
            setTimeout(() => {
                if (gelembung && gelembung.parentNode) {
                    gelembung.parentNode.removeChild(gelembung);
                }
            }, (durasi + tunda) * 1000);
        }

        // Gelembung awal
        for (let i = 0; i < 15; i++) {
            setTimeout(buatGelembung, i * 300);
        }

        // Buat gelembung baru secara berkala
        setInterval(buatGelembung, 2000);
    });
</script>
@endsection

@section('styles')
<style>
/* Animasi gelombang yang disempurnakan */
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

/* Animasi gelembung yang disempurnakan */
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
</style>
@endsection
