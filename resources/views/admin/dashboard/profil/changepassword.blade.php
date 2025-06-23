@extends('layouts.admin')

@section('title', 'Ubah Kata Sandi')

@section('content')
<div class="container-fluid px-0 py-0 bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>
    <!-- Animasi gelombang yang disempurnakan -->

    <div class="max-w-3xl mx-auto z-10 relative py-8 px-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Ubah Kata Sandi</h1>

            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
            </div>

            <form action="{{ route('admin.update-password') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="current_password">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" id="current_password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <p class="mt-1 text-sm text-gray-500">Minimal 8 karakter</p>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-medium mb-2" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.profile') }}" class="bg-gray-300 text-gray-700 hover:bg-gray-400 px-4 py-2 rounded-md text-sm font-medium transition duration-300">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-2 rounded-md text-sm font-medium transition duration-300">
                        Perbarui Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Animasi Gelembung Admin Dashboard
    document.addEventListener('DOMContentLoaded', function() {
        // Buat gelembung di latar belakang dashboard admin
        const container = document.querySelector('.container-fluid.min-h-screen');

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
/* Mengatur layout container penuh */
.container-fluid {
    width: 100% !important;
    max-width: 100% !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    overflow-x: hidden !important;
}

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
.container-fluid.min-h-screen::before {
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

/* Memperbaiki tampilan pada layar kecil */
@media (max-width: 640px) {
    .max-w-3xl {
        max-width: 95% !important;
    }
}
</style>
@endsection
