@extends('layouts.app')

@section('title', 'Awan Tag')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
    <!-- Latar belakang animasi -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-400/10 via-cyan-500/10 to-teal-600/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <!-- Header section -->
    <div class="bg-gradient-to-r h-[60vh] from-blue-800 to-indigo-900 text-white py-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center z-0 opacity-20"
             style="background-image: url('{{ asset('home/bawahlaut.jpg') }}');">
        </div>

        <!-- Lapisan gelombang animasi -->
        <div class="absolute inset-0 z-0">
            <div class="wave-overlay-1"></div>
            <div class="wave-overlay-2"></div>
            <div class="wave-overlay-3"></div>
        </div>

        <!-- Efek gelembung dan cahaya -->
        <div class="absolute inset-0 z-0 deep-sea-bubbles opacity-40"></div>
        <div class="absolute inset-0 z-0 marine-light-rays"></div>
        <div class="absolute bottom-0 left-0 w-full h-32 seafloor-particles"></div>

        <!-- Konten header -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row md:items-center gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full p-6 mr-5 shadow-xl shadow-blue-900/40 shine-effect glow-pulse">
                    <i class="fas fa-tags text-3xl"></i>
                </div>
                <div class="max-w-2xl">
                    <span class="inline-block text-cyan-200 mb-2 text-sm tracking-wider uppercase font-medium">Koleksi Tag</span>
                    <h1 class="text-5xl font-bold mb-3 gradient-text-blue underwater-text-effect">Awan Tag</h1>
                    <p class="text-lg text-blue-100 mb-2">Jelajahi topik berdasarkan popularitas dan temukan artikel menarik</p>
                    <div class="flex items-center mt-3 text-blue-200 bg-blue-700/30 backdrop-blur-sm w-fit px-4 py-2 rounded-full border border-blue-400/20">
                        <i class="fas fa-hashtag mr-2"></i>
                        <span class="font-medium">{{ $tags->count() }}</span>
                        <span class="ml-1">{{ Str::plural('tag', $tags->count()) }} tersedia</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gelombang bawah -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#E0F2FE" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z" class="wave-path"></path>
            </svg>
        </div>
    </div>

    <!-- Konten utama -->
    <div class="container mx-auto px-4 py-12 relative z-10">
        <!-- Visualisasi awan tag -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-blue-100/50 p-8 mb-10">
            <div class="flex items-center mb-6 border-b border-gray-100 pb-4">
                <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white p-3 rounded-xl shadow-md mr-4">
                    <i class="fas fa-cloud text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-700 text-lg">Visualisasi Awan Tag</h3>
                    <p class="text-gray-600">Ukuran dan warna tag menunjukkan popularitasnya</p>
                </div>
            </div>

            <div class="flex flex-wrap justify-center py-8">
                @foreach($tags as $tag)
                    @php
                        // Kalkulasi ukuran font berdasarkan jumlah artikel (antara 1 dan 3 rem)
                        $min = 1;
                        $max = 3;
                        $maxArticles = $tags->max('articles_count');
                        $fontSize = $min + ($max - $min) * ($tag->articles_count / max($maxArticles, 1));

                        // Buat variasi warna berdasarkan popularitas
                        $intensity = 40 + min(40, $tag->articles_count * 2);
                        $hue = ($tag->tag_id * 77) % 360; // Generasi variasi warna
                        
                        // Efek highlight untuk tag populer
                        $highlight = $tag->articles_count > 5 ? 'shine-effect' : '';
                        
                        // Animasi untuk tag populer
                        $animation = $tag->articles_count > 10 ? 'animate-pulse' : '';
                    @endphp

                    <a href="{{ route('tags.show', $tag->slug) }}"
                       class="m-2 px-4 py-2 inline-block rounded-full transition-all duration-300 transform hover:-translate-y-1 hover:shadow-md {{$highlight}} {{$animation}}"
                       style="font-size: {{ $fontSize }}rem; color: hsl({{ $hue }}, {{ $intensity }}%, 50%); background-color: hsl({{ $hue }}, {{ $intensity }}%, 95%);">
                        #{{ $tag->nama_tag }}
                        <span class="text-xs font-medium ml-1" style="color: hsl({{ $hue }}, {{ $intensity - 10 }}%, 40%);">
                            ({{ $tag->articles_count }})
                        </span>
                    </a>
                @endforeach
            </div>
            
            <!-- Panel informasi -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-100 hover:shadow-md transition duration-300">
                    <h4 class="text-blue-700 font-medium mb-2 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i> Apa Itu Tag Cloud?
                    </h4>
                    <p class="text-gray-600 text-sm">Tag cloud menampilkan topik populer dimana ukuran tag menunjukkan seberapa sering topik tersebut dibahas dalam artikel.</p>
                </div>

                <div class="bg-cyan-50 rounded-xl p-4 border border-cyan-100 hover:shadow-md transition duration-300">
                    <h4 class="text-cyan-700 font-medium mb-2 flex items-center">
                        <i class="fas fa-search mr-2"></i> Cara Menggunakan
                    </h4>
                    <p class="text-gray-600 text-sm">Klik pada tag untuk melihat semua artikel yang terkait dengan topik tersebut. Tag yang lebih besar memiliki lebih banyak artikel.</p>
                </div>

                <div class="bg-teal-50 rounded-xl p-4 border border-teal-100 hover:shadow-md transition duration-300">
                    <h4 class="text-teal-700 font-medium mb-2 flex items-center">
                        <i class="fas fa-bookmark mr-2"></i> Mengikuti Tag
                    </h4>
                    <p class="text-gray-600 text-sm">Anda dapat mengikuti tag untuk mendapatkan pembaruan tentang topik yang Anda minati melalui halaman detail tag.</p>
                </div>
            </div>
        </div>

        <!-- Statistik tag -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-blue-100/50 p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-chart-bar text-blue-500 mr-2"></i> Tag Terpopuler
                </h3>
                
                <div class="space-y-4">
                    @foreach($tags->sortByDesc('articles_count')->take(5) as $topTag)
                    <div class="flex items-center">
                        <div class="w-full bg-gray-200 rounded-full h-4 mr-2">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 h-4 rounded-full"
                                 style="width: {{ ($topTag->articles_count / $tags->max('articles_count')) * 100 }}%">
                            </div>
                        </div>
                        <a href="{{ route('tags.show', $topTag->slug) }}" 
                           class="text-gray-700 hover:text-blue-600 whitespace-nowrap">
                            #{{ $topTag->nama_tag }}
                            <span class="text-xs text-gray-500">({{ $topTag->articles_count }})</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-blue-100/50 p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-lightbulb text-yellow-500 mr-2"></i> Tag Terbaru
                </h3>
                
                <div class="space-y-3">
                    @foreach($tags->sortByDesc('created_at')->take(5) as $newTag)
                    <div class="flex items-center justify-between py-2 px-4 rounded-lg hover:bg-blue-50 transition-colors">
                        <a href="{{ route('tags.show', $newTag->slug) }}" class="font-medium text-gray-700 hover:text-blue-600">
                            #{{ $newTag->nama_tag }}
                        </a>
                        <div class="text-xs bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                            <i class="fas fa-clock mr-1"></i> Baru
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tombol navigasi -->
        <div class="mt-8 text-center">
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('tags.index') }}" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg flex items-center justify-center">
                    <i class="fas fa-list mr-2"></i>
                    Lihat Semua Tag
                </a>
                <a href="{{ route('home') }}" class="bg-white border border-blue-200 text-blue-600 px-6 py-3 rounded-xl font-medium hover:bg-blue-50 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Animasi gelombang laut */
    .ocean-waves {
        background: linear-gradient(90deg,
            transparent,
            rgba(6, 182, 212, 0.15) 25%,
            rgba(59, 130, 246, 0.15) 50%,
            rgba(20, 184, 166, 0.15) 75%,
            transparent
        );
        background-size: 300% 100%;
        animation: oceanFlowEnhanced 12s ease-in-out infinite;
    }

    @keyframes oceanFlowEnhanced {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Partikel mengambang */
    .floating-particles {
        background-image:
            radial-gradient(circle at 20% 80%, rgba(6, 182, 212, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 80% 20%, rgba(59, 130, 246, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 40% 40%, rgba(20, 184, 166, 0.15) 2px, transparent 2px),
            radial-gradient(circle at 60% 70%, rgba(16, 185, 129, 0.15) 1px, transparent 1px);
        background-size: 150px 150px, 200px 200px, 300px 300px, 100px 100px;
        animation: floatParticlesEnhanced 25s linear infinite;
    }

    @keyframes floatParticlesEnhanced {
        0% { background-position: 0 0, 0 0, 0 0, 0 0; }
        100% { background-position: 150px 150px, -200px 200px, 300px -300px, -100px 100px; }
    }

    /* Gelembung dalam air */
    .deep-sea-bubbles {
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.12) 5px, transparent 5px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.18) 3px, transparent 3px),
            radial-gradient(circle at 85% 85%, rgba(255, 255, 255, 0.15) 4px, transparent 4px),
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px);
        background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
        animation: bubbleRiseEnhanced 30s linear infinite;
    }

    @keyframes bubbleRiseEnhanced {
        0% { background-position: 0 100%, 0 100%, 0 100%, 0 100%, 0 100%; }
        100% { background-position: 0 -400px, 0 -500px, 0 -300px, 0 -450px, 0 -250px; }
    }

    /* Arus bawah laut */
    .underwater-current {
        background: linear-gradient(45deg,
            rgba(0,115,209,0) 0%,
            rgba(0,115,209,0.02) 50%,
            rgba(0,115,209,0) 100%);
        background-size: 200% 200%;
        animation: underwaterCurrent 15s ease-in-out infinite;
    }

    @keyframes underwaterCurrent {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Sinar cahaya laut */
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

    /* Lapisan gelombang */
    .wave-overlay-1 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z' fill='%23ffffff' fill-opacity='0.1'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        animation: wave-animation1 25s linear infinite alternate;
    }

    .wave-overlay-2 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23ffffff' fill-opacity='0.2'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        animation: wave-animation2 20s linear infinite alternate-reverse;
    }

    .wave-overlay-3 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' fill='%23ffffff' fill-opacity='0.3'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        animation: wave-animation3 15s linear infinite alternate;
    }

    @keyframes wave-animation1 {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50px); }
    }

    @keyframes wave-animation2 {
        0% { transform: translateX(0); }
        100% { transform: translateX(50px); }
    }

    @keyframes wave-animation3 {
        0% { transform: translateX(0); }
        100% { transform: translateX(-30px); }
    }

    /* Partikel dasar laut */
    .seafloor-particles {
        background-image:
            radial-gradient(circle at 10% 90%, rgba(14, 116, 144, 0.3) 1px, transparent 2px),
            radial-gradient(circle at 30% 95%, rgba(8, 145, 178, 0.25) 2px, transparent 3px),
            radial-gradient(circle at 50% 92%, rgba(6, 182, 212, 0.2) 1px, transparent 2px),
            radial-gradient(circle at 70% 97%, rgba(2, 132, 199, 0.3) 2px, transparent 3px),
            radial-gradient(circle at 90% 94%, rgba(3, 105, 161, 0.25) 1px, transparent 2px);
        background-size: 80px 80px, 120px 120px, 100px 100px, 130px 130px, 90px 90px;
        animation: seafloorParticlesDrift 30s linear infinite alternate;
    }

    @keyframes seafloorParticlesDrift {
        0% { background-position: 0px 0px, 0px 0px, 0px 0px, 0px 0px, 0px 0px; }
        100% { background-position: 80px 0px, -120px 0px, 100px 0px, -130px 0px, 90px 0px; }
    }

    /* Efek teks gradien */
    .gradient-text-blue {
        background: linear-gradient(135deg, #ffffff, #bae6fd, #7dd3fc, #ffffff);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    /* Efek berkilau */
    .shine-effect {
        position: relative;
        overflow: hidden;
    }

    .shine-effect::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 50%,
            rgba(255, 255, 255, 0) 100%
        );
        transform: rotate(30deg);
        opacity: 0;
        transition: opacity 0.6s;
    }

    .shine-effect:hover::after {
        opacity: 1;
        animation: shine 1.5s forwards;
    }

    @keyframes shine {
        100% {
            left: 150%;
            top: 100%;
        }
    }

    /* Efek bersinar */
    .glow-pulse {
        animation: glowPulseEffect 3s infinite alternate;
    }

    @keyframes glowPulseEffect {
        0% {
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.6),
                       0 0 20px rgba(56, 189, 248, 0.4);
        }
        100% {
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.8),
                       0 0 30px rgba(56, 189, 248, 0.6),
                       0 0 45px rgba(2, 132, 199, 0.3);
        }
    }

    /* Efek teks bawah air */
    .underwater-text-effect {
        text-shadow:
            0 0 10px rgba(186, 230, 253, 0.4),
            0 0 20px rgba(125, 211, 252, 0.3),
            0 0 30px rgba(56, 189, 248, 0.2);
        animation: underwaterGlow 4s ease-in-out infinite alternate;
    }

    @keyframes underwaterGlow {
        0% {
            text-shadow:
                0 0 10px rgba(186, 230, 253, 0.4),
                0 0 20px rgba(125, 211, 252, 0.3),
                0 0 30px rgba(56, 189, 248, 0.2);
        }
        100% {
            text-shadow:
                0 0 15px rgba(186, 230, 253, 0.6),
                0 0 25px rgba(125, 211, 252, 0.5),
                0 0 35px rgba(56, 189, 248, 0.4);
        }
    }

    /* Jalur gelombang */
    .wave-path {
        fill: rgba(240, 253, 255, 1);
        filter: drop-shadow(0 -6px 8px rgba(14, 165, 233, 0.1));
    }
    
    /* Animasi untuk tag */
    @keyframes tagFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    /* Animasi hover khusus untuk tag */
    .tag-item:hover {
        animation: tagFloat 2s ease-in-out infinite;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fungsi untuk membuat gelembung animasi
    const createBubble = () => {
        const bubble = document.createElement('div');
        bubble.className = 'absolute rounded-full bg-white/30 pointer-events-none animate-bubble-rise';

        const size = Math.random() * 15 + 5;
        bubble.style.width = `${size}px`;
        bubble.style.height = `${size}px`;

        const left = Math.random() * 100;
        bubble.style.left = `${left}%`;
        bubble.style.bottom = '-20px';

        const duration = Math.random() * 5 + 10;
        const delay = Math.random() * 5;
        bubble.style.animationDuration = `${duration}s`;
        bubble.style.animationDelay = `${delay}s`;

        bubble.style.background = 'radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.2) 60%, rgba(255,255,255,0) 100%)';
        bubble.style.boxShadow = '0 0 5px rgba(255,255,255,0.3)';

        document.querySelector('.deep-sea-bubbles').appendChild(bubble);

        setTimeout(() => {
            bubble.remove();
        }, (duration + delay) * 1000);
    };

    // Buat beberapa gelembung di awal
    for (let i = 0; i < 10; i++) {
        setTimeout(createBubble, Math.random() * 2000);
    }

    // Terus buat gelembung secara berkala
    setInterval(createBubble, 2000);

    // Tambahkan animasi gelembung
    if (!document.getElementById('bubble-animations')) {
        const style = document.createElement('style');
        style.id = 'bubble-animations';
        style.textContent = `
            @keyframes animate-bubble-rise {
                0% {
                    transform: translateY(0) translateX(0) scale(0.5);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100vh) translateX(calc(var(--tx, 0) * 50px)) scale(1);
                    opacity: 0;
                }
            }

            .animate-bubble-rise {
                --tx: ${Math.random() * 2 - 1};
                animation: animate-bubble-rise var(--duration, 15s) ease-in var(--delay, 0s) forwards;
            }
        `;
        document.head.appendChild(style);
    }
    
    // Animasi untuk tag cloud
    const tags = document.querySelectorAll('.tag-item');
    tags.forEach(tag => {
        // Tambahkan delay acak
        const delay = Math.random() * 2;
        tag.style.animationDelay = `${delay}s`;
    });
});
</script>
@endsection