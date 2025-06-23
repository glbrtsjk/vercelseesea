@extends('layouts.app')

@section('title', 'Atur Ulang Kata Sandi - Portal Lautan Bagan')

@section('head')
<meta http-equiv="refresh" content="1800"> <!-- Menyegarkan halaman setelah 30 menit -->
@endsection

@section('content')
<div class="min-h-screen relative overflow-hidden flex items-center justify-center bg-gradient-to-b from-blue-900 via-blue-700 to-cyan-700">
    <!-- Latar Belakang Lautan Beranimasi -->
    <div class="absolute inset-0 z-0">
        <!-- Lapisan laut dalam -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/80 via-blue-800/70 to-cyan-800/80"></div>

        <!-- Ombak lautan -->
        <div class="ombak-lautan absolute bottom-0 left-0 w-full h-96 opacity-30"></div>

        <!-- Gelembung laut dalam -->
        <div class="gelembung-laut-dalam absolute inset-0"></div>

        <!-- Sinar cahaya melalui air -->
        <div class="sinar-laut absolute inset-0"></div>

        <!-- Partikel bawah laut -->
        <div class="partikel-bawah-laut absolute inset-0"></div>

        <!-- Siluet ikan -->
        <div id="wadah-ikan" class="absolute inset-0 overflow-hidden pointer-events-none"></div>

        <!-- Siluet karang di bawah -->
        <div class="siluet-karang absolute bottom-0 left-0 w-full"></div>
    </div>

    <!-- Kontainer Atur Ulang Kata Sandi -->
    <div class="relative z-10 w-full max-w-md px-8 py-10">
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl border border-white/20 transform transition-all hover:shadow-cyan-500/20 kartu-bercahaya">
            <!-- Logo/Merek -->
            <div class="text-center pt-10 pb-6 px-8">
                <div class="logo-lautan mx-auto mb-2 relative">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-r from-cyan-400 to-blue-600 mx-auto flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="efek-riak"></div>
                </div>
                <h2 class="text-3xl font-bold text-white mb-1 tracking-wide">Atur Ulang Kata Sandi</h2>
                <p class="text-cyan-100 text-lg">Masukkan kata sandi baru Anda</p>
            </div>

            <!-- Pembagi Gelombang -->
            <div class="pembagi-gelombang"></div>

            <!-- Status Notifikasi -->
            @if (session('status'))
                <div class="mx-8 mb-6 bg-cyan-100/30 backdrop-blur-sm border-l-4 border-cyan-500 text-cyan-100 p-4 rounded-lg" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formulir -->
            <div class="px-8 pt-6 pb-8">
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email -->
                    <div class="kelompok-form transform transition duration-500 item-form-masuk">
                        <label for="email" class="block text-cyan-100 text-sm font-medium mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-cyan-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                </svg>
                            </div>
                            <input id="email" name="email" type="email" value="{{ $email ?? old('email') }}" required readonly
                                class="bg-white/10 block w-full pl-10 pr-3 py-3.5 rounded-xl border border-white/20 focus:ring-2 focus:ring-cyan-500 focus:border-transparent placeholder-cyan-200/50 text-white text-lg transition duration-300 input-bercahaya">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kata Sandi Baru -->
                    <div class="kelompok-form transform transition duration-500 item-form-masuk" style="transition-delay: 100ms">
                        <label for="password" class="block text-cyan-100 text-sm font-medium mb-2">Kata Sandi Baru</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-cyan-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                class="bg-white/10 block w-full pl-10 pr-10 py-3.5 rounded-xl border border-white/20 focus:ring-2 focus:ring-cyan-500 focus:border-transparent placeholder-cyan-200/50 text-white text-lg transition duration-300 input-bercahaya"
                                placeholder="••••••••••••">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <button type="button" id="togglePassword" class="text-cyan-300 hover:text-white">
                                    <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg id="eyeSlashIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Kata Sandi -->
                    <div class="kelompok-form transform transition duration-500 item-form-masuk" style="transition-delay: 200ms">
                        <label for="password_confirmation" class="block text-cyan-100 text-sm font-medium mb-2">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-cyan-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                                class="bg-white/10 block w-full pl-10 pr-3 py-3.5 rounded-xl border border-white/20 focus:ring-2 focus:ring-cyan-500 focus:border-transparent placeholder-cyan-200/50 text-white text-lg transition duration-300 input-bercahaya"
                                placeholder="••••••••••••">
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="transform transition duration-500 item-form-masuk" style="transition-delay: 300ms">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-lg font-medium text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition duration-300 tombol-bercahaya">
                            <span class="relative flex items-center">
                                <svg class="w-6 h-6 mr-2 animasi-gelombang" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Atur Ulang Kata Sandi
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Link Kembali ke Login -->
                <div class="mt-8 text-center transform transition duration-500 item-form-masuk" style="transition-delay: 400ms">
                    <p class="text-cyan-100">
                        <a href="{{ route('login') }}" class="flex items-center justify-center font-medium text-cyan-300 hover:text-white transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path>
                            </svg>
                            Kembali ke halaman login
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Fakta Lautan -->
        <div class="mt-8 text-center transform transition duration-500 item-form-masuk bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10" style="transition-delay: 500ms">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-cyan-300 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-cyan-100 text-left">
                    <span class="font-medium text-white">Fakta Lautan:</span> Paus biru menghasilkan suara terkeras dari semua makhluk hidup, yang dapat terdengar hingga 800 km jauhnya di bawah air.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Komponen Animasi Lautan */
    .ombak-lautan {
        background: linear-gradient(90deg,
            transparent,
            rgba(56, 189, 248, 0.2) 25%,
            rgba(59, 130, 246, 0.2) 50%,
            rgba(20, 184, 166, 0.2) 75%,
            transparent
        );
        background-size: 300% 100%;
        animation: aliranLautanDitingkatkan 12s ease-in-out infinite;
    }

    .gelembung-laut-dalam::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.12) 5px, transparent 5px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.18) 3px, transparent 3px),
            radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px);
        background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
        animation: naikGelembungLautDalam 30s linear infinite;
    }

    .gelembung-laut-dalam::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image:
            radial-gradient(circle at 35% 35%, rgba(255, 255, 255, 0.12) 3px, transparent 3px),
            radial-gradient(circle at 65% 15%, rgba(255, 255, 255, 0.14) 4px, transparent 4px),
            radial-gradient(circle at 15% 45%, rgba(255, 255, 255, 0.12) 3px, transparent 3px),
            radial-gradient(circle at 85% 45%, rgba(255, 255, 255, 0.16) 2px, transparent 2px);
        background-size: 350px 350px, 450px 450px, 250px 250px, 300px 300px;
        animation: naikGelembungLautDalam 25s linear infinite;
        animation-delay: -10s;
    }

    /* Efek Sinar Cahaya */
    .sinar-laut {
        background: linear-gradient(45deg,
            transparent 30%,
            rgba(120, 220, 255, 0.1) 40%,
            rgba(120, 220, 255, 0.05) 50%,
            transparent 60%
        );
        background-size: 200px 200px;
        animation: aliranSinarCahaya 15s ease-in-out infinite;
    }

    /* Efek Partikel Bawah Laut */
    .partikel-bawah-laut {
        background-image:
            radial-gradient(circle at 10% 20%, rgba(34, 211, 238, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 30% 60%, rgba(59, 130, 246, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 70% 90%, rgba(20, 184, 166, 0.1) 1px, transparent 1px),
            radial-gradient(circle at 90% 30%, rgba(16, 185, 129, 0.1) 1px, transparent 1px);
        background-size: 80px 80px, 120px 120px, 100px 100px, 90px 90px;
        animation: aliranPartikel 20s linear infinite;
    }

    /* Siluet Karang */
    .siluet-karang {
        height: 80px;
        background-image:
            radial-gradient(ellipse at 20% 100%, rgba(16, 185, 129, 0.08) 20px, transparent 20px),
            radial-gradient(ellipse at 60% 100%, rgba(34, 211, 238, 0.08) 25px, transparent 25px),
            radial-gradient(ellipse at 80% 100%, rgba(59, 130, 246, 0.08) 18px, transparent 18px);
        background-size: 200px 150px, 300px 200px, 250px 180px;
        background-position: 0 100%, 0 100%, 0 100%;
        animation: ayunanKarang 25s ease-in-out infinite;
    }

    /* Pembagi Gelombang */
    .pembagi-gelombang {
        height: 24px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='rgba(255, 255, 255, 0.04)'/%3E%3C/svg%3E");
        background-size: 100% 100%;
    }

    /* Gaya Formulir dan Kartu */
    .kartu-bercahaya {
        box-shadow: 0 0 20px rgba(56, 189, 248, 0.12);
        animation: denyut-kartu 4s ease-in-out infinite;
    }

    /* Efek Cahaya Input */
    .input-bercahaya:focus {
        box-shadow: 0 0 15px rgba(56, 189, 248, 0.5);
    }

    /* Efek Cahaya Tombol */
    .tombol-bercahaya {
        box-shadow: 0 0 10px rgba(56, 189, 248, 0.3);
    }

    .tombol-bercahaya:hover {
        box-shadow: 0 0 20px rgba(6, 182, 212, 0.5);
    }

    /* Animasi Logo */
    .logo-lautan {
        position: relative;
    }

    .efek-riak {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        transform: translate(-50%, -50%);
        animation: riak 4s linear infinite;
        z-index: -1;
    }

    .animasi-gelombang {
        animation: denyut-gelombang 2s ease-in-out infinite;
    }

    /* Keyframes Animasi */
    @keyframes aliranLautanDitingkatkan {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes naikGelembungLautDalam {
        0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%, 0 100%; }
        100% { background-position: 0 -400px, 0 -500px, 0 -300px, 0 -450px, 0 -250px; }
    }

    @keyframes aliranSinarCahaya {
        0%, 100% {
            transform: translateX(-50px) translateY(-50px) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateX(50px) translateY(50px) rotate(10deg);
            opacity: 0.6;
        }
    }

    @keyframes aliranPartikel {
        0% {
            background-position: 0 0, 0 0, 0 0, 0 0;
            transform: translateX(0);
        }
        100% {
            background-position: 80px 80px, -120px 120px, 100px -100px, -90px 90px;
            transform: translateX(20px);
        }
    }

    @keyframes ayunanKarang {
        0%, 100% { transform: translateX(0) skewX(0deg); }
        33% { transform: translateX(10px) skewX(2deg); }
        66% { transform: translateX(-10px) skewX(-2deg); }
    }

    @keyframes denyut-kartu {
        0%, 100% { box-shadow: 0 0 20px rgba(56, 189, 248, 0.12); }
        50% { box-shadow: 0 0 30px rgba(6, 182, 212, 0.25); }
    }

    @keyframes renang-ikan {
        0% { transform: translateX(-100%) translateY(var(--y-offset)) scaleX(var(--dir)); }
        100% { transform: translateX(200%) translateY(var(--y-offset)) scaleX(var(--dir)); }
    }

    @keyframes riak {
        0% {
            width: 24px;
            height: 24px;
            opacity: 0.8;
        }
        100% {
            width: 120px;
            height: 120px;
            opacity: 0;
        }
    }

    @keyframes denyut-gelombang {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }

    /* Animasi Formulir */
    .item-form-masuk {
        opacity: 0;
        transform: translateY(20px);
        animation: muncul-dari-bawah 0.5s ease forwards;
    }

    @keyframes muncul-dari-bawah {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Optimasi Mobile */
    @media (max-width: 640px) {
        .item-form-masuk {
            transform: translateY(10px);
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle visibilitas kata sandi
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeSlashIcon = document.getElementById('eyeSlashIcon');

        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                // Toggle tipe field kata sandi
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Toggle ikon
                eyeIcon.classList.toggle('hidden');
                eyeSlashIcon.classList.toggle('hidden');
            });
        }

        // Membuat animasi ikan berenang
        buatIkanBerenang();

        // Membuat gelembung dinamis
        buatGelembungDinamis();
    });

    function buatIkanBerenang() {
        const wadahIkan = document.getElementById('wadah-ikan');
        if (!wadahIkan) return;

        const jumlahIkan = window.innerWidth < 768 ? 3 : 5;

        for (let i = 0; i < jumlahIkan; i++) {
            setTimeout(() => {
                const ikan = document.createElement('div');

                // Buat properti acak untuk ikan yang unik
                const ukuran = Math.random() * 30 + 10; // Ukuran ikan
                const posisiY = Math.random() * 80; // Posisi vertikal %
                const durasi = Math.random() * 30 + 20; // Durasi animasi
                const tunda = Math.random() * 15; // Penundaan animasi
                const arah = Math.random() > 0.5 ? 1 : -1; // Arah ikan

                // Buat SVG ikan
                ikan.innerHTML = `
                    <svg width="${ukuran}" height="${ukuran/2}" viewBox="0 0 100 50" fill="rgba(255, 255, 255, 0.2)" style="filter: drop-shadow(0 0 2px rgba(56, 189, 248, 0.3));">
                        <path d="M20 25Q30 15 50 25T80 25L90 15L90 35L80 25Q70 35 50 25T20 25Z"></path>
                        <circle cx="80" cy="25" r="3" fill="rgba(255, 255, 255, 0.5)"></circle>
                    </svg>
                `;

                // Terapkan gaya dan animasi
                ikan.style.position = 'absolute';
                ikan.style.top = `${posisiY}%`;
                ikan.style.setProperty('--y-offset', `${Math.random() * 10 - 5}%`);
                ikan.style.setProperty('--dir', arah);
                ikan.style.animation = `renang-ikan ${durasi}s linear ${tunda}s infinite`;
                ikan.style.zIndex = '5';
                ikan.style.opacity = '0.6';

                wadahIkan.appendChild(ikan);
            }, i * 1000); // Pembuatan bertahap
        }
    }

    function buatGelembungDinamis() {
        const maksGelembung = 20;
        const body = document.body;

        // Buat gelembung secara berkala
        const intervalGelembung = setInterval(() => {
            // Batasi jumlah maksimum gelembung untuk mencegah masalah performa
            const gelembungYangAda = document.querySelectorAll('.gelembung-dinamis').length;
            if (gelembungYangAda >= maksGelembung) return;

            const gelembung = document.createElement('div');
            gelembung.className = 'gelembung-dinamis';

            // Properti acak
            const ukuran = Math.random() * 8 + 3;
            const posisiKiri = Math.random() * 100;
            const durasi = Math.random() * 6 + 4;
            const tunda = Math.random() * 2;

            // Gaya gelembung
            gelembung.style.position = 'fixed';
            gelembung.style.bottom = '-20px';
            gelembung.style.left = `${posisiKiri}%`;
            gelembung.style.width = `${ukuran}px`;
            gelembung.style.height = `${ukuran}px`;
            gelembung.style.borderRadius = '50%';
            gelembung.style.background = 'radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8), rgba(255,255,255,0.2))';
            gelembung.style.boxShadow = '0 0 5px rgba(255,255,255,0.3)';
            gelembung.style.zIndex = '5';
            gelembung.style.opacity = '0';
            gelembung.style.pointerEvents = 'none';

            // Animasi gelembung dinamis
            gelembung.style.animation = `gelembungDinamis ${durasi}s ease-in ${tunda}s forwards`;

            body.appendChild(gelembung);

            // Hapus gelembung setelah animasi selesai
            setTimeout(() => {
                if (gelembung.parentNode) {
                    gelembung.parentNode.removeChild(gelembung);
                }
            }, (durasi + tunda) * 1000);
        }, 500);

        // Buat animasi keyframe secara dinamis
        const style = document.createElement('style');
        style.textContent = `
            @keyframes gelembungDinamis {
                0% {
                    opacity: 0;
                    transform: translateY(0) translateX(0) scale(0.2);
                }
                10% {
                    opacity: 0.7;
                }
                100% {
                    opacity: 0;
                    transform: translateY(-100vh) translateX(${Math.random() > 0.5 ? '-' : ''}${Math.random() * 100}px) scale(1);
                }
            }
        `;
        document.head.appendChild(style);
    }
</script>
@endsection
