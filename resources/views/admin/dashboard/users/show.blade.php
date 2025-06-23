
@extends('layouts.admin')

@section('title', $user->name . ' - Profil Pengguna')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen pb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <!-- Header Section with Wave Animation -->
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-lg shadow-lg rounded-xl p-6 mb-8 overflow-hidden border-t-4 border-cyan-400">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-20">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Profil Pengguna: {{ $user->name }}</h1>
                    <p class="text-cyan-100 font-medium">Detail dan aktivitas pengguna</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.users.index') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Pengguna
                    </a>
                </div>
            </div>

            <!-- Enhanced wave animations dengan z-index yang tepat -->
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70 z-10"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150 z-10"></div>

            <!-- Particle elements dengan pointer-events-none -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-10">
                <div class="particle particle-1 pointer-events-none"></div>
                <div class="particle particle-2 pointer-events-none"></div>
                <div class="particle particle-3 pointer-events-none"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Informasi Profil Pengguna -->
            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-300 transform transition-all duration-300 hover:shadow-xl relative overflow-hidden z-20">
                <div class="flex flex-col items-center text-center mb-6 relative z-10">
                    <img class="h-32 w-32 rounded-full object-cover mb-4 border-4 border-white shadow-lg"
                         src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                         alt="{{ $user->name }}">
                    <h2 class="text-xl font-semibold text-blue-800">{{ $user->name }}</h2>
                    <p class="text-blue-600">{{ $user->email }}</p>
                    <div class="mt-2">
                        @if($user->email_verified_at)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Terverifikasi
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Belum Terverifikasi
                            </span>
                        @endif

                        @if($user->isBanned())
                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Diblokir
                            </span>
                        @endif
                    </div>
                </div>

                <div class="border-t border-blue-200 pt-4 relative z-10">
                    <h3 class="text-sm font-medium text-blue-600 mb-3">Detail Pengguna</h3>
                    <ul class="space-y-3">
                        <li class="text-sm flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-blue-700">Bergabung: {{ $user->created_at->format('d M Y') }}</span>
                        </li>

                        <li class="text-sm flex items-start">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div>
                                <span class="font-semibold text-blue-700">Bio:</span><br>
                                <p class="text-blue-600">{{ $user->bio ?: 'Belum ada bio.' }}</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="border-t border-blue-200 pt-4 mt-4 relative z-10">
                    <h3 class="text-sm font-medium text-blue-600 mb-3">Ringkasan Aktivitas</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-3 rounded-lg text-center shadow-sm">
                            <div class="text-2xl font-bold text-blue-600">{{ $articleCount }}</div>
                            <div class="text-xs text-blue-500">Artikel</div>
                        </div>
                        <div class="bg-green-50 p-3 rounded-lg text-center shadow-sm">
                            <div class="text-2xl font-bold text-green-600">{{ $commentCount }}</div>
                            <div class="text-xs text-green-500">Komentar</div>
                        </div>
                    </div>
                </div>

                @if(Auth::id() !== $user->user_id)
                    <div class="border-t border-blue-200 pt-4 mt-4 relative z-10">
                        <h3 class="text-sm font-medium text-blue-600 mb-3">Tindakan Administratif</h3>
                        <div class="flex flex-col space-y-2">
                            @if($user->isBanned())
                                <form action="{{ route('admin.users.unban', $user->user_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:from-green-600 hover:to-emerald-700 transition duration-200 shadow-md">
                                        Buka Blokir Pengguna
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.ban', $user->user_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-lg hover:from-red-600 hover:to-rose-700 transition duration-200 shadow-md">
                                        Blokir Pengguna
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-50 transition duration-200 shadow-md">
                                    Hapus Pengguna
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Background elements for profile card -->
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-blue-200/50 rounded-full z-0"></div>
            </div>

            <!-- Bagian Konten Pengguna -->
            <div class="md:col-span-2 space-y-6 z-20">
                <!-- Artikel Terbaru -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-t-4 border-blue-500 relative overflow-hidden">
                    <!-- Wave background -->
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60 z-0"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40 z-0"></div>

                    <h2 class="text-lg font-medium text-blue-800 mb-4 relative z-10">Artikel Terbaru</h2>

                    @if($articles->count() > 0)
                        <div class="space-y-4 relative z-10">
                            @foreach($articles as $article)
                                <div class="border border-blue-200 rounded-lg p-4 hover:bg-blue-50 transition-colors">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-medium text-blue-800">{{ $article->judul }}</h3>
                                            <p class="text-sm text-blue-600 mt-1">{{ Str::limit(strip_tags($article->konten_isi_artikel), 100) }}</p>

                                            <div class="flex items-center mt-2">
                                                @php
                                                    $statusColor = $article->status == 'published' ? 'green' : ($article->status == 'pending' ? 'yellow' : 'red');
                                                @endphp
                                                <span class="bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800 text-xs px-2 py-1 rounded">
                                                    {{ $article->status == 'published' ? 'Dipublikasikan' : ($article->status == 'pending' ? 'Menunggu' : 'Ditolak') }}
                                                </span>
                                                <span class="text-xs text-blue-500 ml-2">{{ $article->tgl_upload->format('d M Y') }}</span>
                                            </div>
                                        </div>

                                        <a href="{{ route('admin.articles.show', $article) }}" class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($articleCount > 5)
                            <div class="mt-4 text-center relative z-10">
                                <a href="{{ route('admin.articles.index', ['user_id' => $user->user_id]) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    Lihat Semua Artikel ({{ $articleCount }})
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="bg-blue-50 rounded-lg p-6 text-center relative z-10">
                            <p class="text-blue-600">Pengguna ini belum mempublikasikan artikel.</p>
                        </div>
                    @endif
                </div>

                <!-- Komunitas -->
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-t-4 border-teal-500 relative overflow-hidden">
                    <!-- Wave background -->
                    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-teal-400/20 animate-wave opacity-60 z-0"></div>
                    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-teal-500/20 animate-wave-slow opacity-40 z-0"></div>

                    <h2 class="text-lg font-medium text-teal-800 mb-4 relative z-10">Komunitas</h2>

                    @if($communities->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 relative z-10">
                            @foreach($communities as $community)
                                <div class="border border-teal-200 rounded-lg p-4 hover:bg-teal-50 transition-colors">
                                    <h3 class="font-medium text-teal-800">{{ $community->nama_komunitas }}</h3>
                                    <p class="text-sm text-teal-600 mt-1">{{ Str::limit($community->deskripsi, 60) }}</p>
                                    <div class="mt-2 flex justify-between items-center">
                                        <span class="text-xs text-teal-500">Bergabung {{ \Carbon\Carbon::parse($community->pivot->tg_gabung)->format('M Y') }}</span>
                                        <a href="{{ route('communities.show', $community->community_id) }}" class="text-teal-600 hover:text-teal-800 text-sm">Lihat</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-teal-50 rounded-lg p-6 text-center relative z-10">
                            <p class="text-teal-600">Pengguna ini belum bergabung dengan komunitas manapun.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* Improved wave animations */
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

/* Bubble animation */
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

/* Background gradients */
.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(83, 157, 196) 0%, rgb(65, 120, 183) 100%);
}

.absolute.inset-0.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(109, 176, 214) 0%, rgb(52, 149, 190) 100%);
    opacity: 0.9 !important; /* Increase opacity */
}

/* Add shimmer effect to the background */
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
    z-index: 1;
    pointer-events: none;
}

/* Improved bubble animation */
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

/* Particle animations */
.particle {
    position: absolute;
    background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    opacity: 0.3;
    pointer-events: none;
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

/* Fix z-index issues - make sure interactive elements are above decorative elements */
.container {
    position: relative;
    z-index: 10;
}

a, button, input, select, form {
    position: relative;
    z-index: 20;
}

.pointer-events-none {
    pointer-events: none !important;
}

/* Ensure links are clickable */
.relative.z-10 a,
.relative.z-10 button,
.relative.z-20 a,
.relative.z-20 button {
    position: relative;
    z-index: 30;
}
</style>
@endsection

@section('scripts')
<script>
    // Admin Dashboard Bubble Animation
    document.addEventListener('DOMContentLoaded', function() {
        // Create bubbles in the admin dashboard background
        const container = document.querySelector('.bg-gradient-to-r.min-h-screen');

        if (!container) {
            console.error('Bubble container not found');
            return; // Exit if container not found
        }

        // Function to create a single bubble
        function createBubble() {
            const bubble = document.createElement('div');
            const size = Math.random() * 60 + 20; // Random size between 20-80px
            const left = Math.random() * 100; // Random horizontal position
            const delay = Math.random() * 5; // Random delay
            const duration = Math.random() * 15 + 10; // Random duration between 10-25s

            bubble.className = 'admin-bubble pointer-events-none';
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.bottom = '-100px'; // Start from bottom
            bubble.style.animationDuration = `${duration}s`;
            bubble.style.animationDelay = `${delay}s`;
            bubble.style.zIndex = '1'; // Ensure bubbles stay below interactive elements

            container.appendChild(bubble);

            // Remove bubble after animation to prevent memory issues
            setTimeout(() => {
                if (bubble && bubble.parentNode) {
                    bubble.parentNode.removeChild(bubble);
                }
            }, (duration + delay) * 1000);
        }

        // Initial bubbles
        for (let i = 0; i < 15; i++) {
            setTimeout(createBubble, i * 300);
        }

        // Create new bubbles periodically
        setInterval(createBubble, 2000);
    });
</script>
@endsection
