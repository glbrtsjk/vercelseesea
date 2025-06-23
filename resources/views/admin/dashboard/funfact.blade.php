@extends('layouts.admin')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen pb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>
     @if(session('success'))
                <div id="success-alert" class="mt-2 flex items-center justify-between bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative animate-fade-in" role="alert">
                    <span>{{ session('success') }}</span>
                    <button type="button" class="ml-4" onclick="document.getElementById('success-alert').remove()">
                        <svg class="h-4 w-4 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div id="error-alert" class="mt-2 flex items-center justify-between bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative animate-fade-in" role="alert">
                    <span>{{ session('error') }}</span>
                    <button type="button" class="ml-4" onclick="document.getElementById('error-alert').remove()">
                        <svg class="h-4 w-4 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                @endif
    <div class="container mx-auto px-4 py-8">
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-lg shadow-lg rounded-xl p-6 mb-8 overflow-hidden border-t-4 border-cyan-400">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">    
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Kelola Funfact</h1>
                    <p class="text-cyan-100 font-medium">Buat dan kelola fakta menarik tentang lautan</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.funfacts.create') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Funfact Baru
                    </a>
                </div>
            </div>

            
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>

            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Funfacts -->
            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Total Funfact</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalFunfacts }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Ditambahkan Bulan Ini</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $addedThisMonth }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Dengan Gambar</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $withImages }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8 border-t-4 border-blue-500 relative overflow-hidden">
    <form action="{{ route('admin.dashboard.funfacts') }}" method="GET" class="flex items-center gap-4 relative z-10">
       <div class="relative flex-grow h-full">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
    <input type="text" name="search" placeholder="Cari funfact..." value="{{ request()->search }}"
        class="w-full py-4 pl-12 pr-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:border-blue-500 transition duration-300"
        autocomplete="off">
</div>
        <div class="w-48 flex-shrink-0">
            <select name="urut" onchange="this.form.submit()" class="w-full py-2 px-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500 bg-white">
                <option value="latest" {{ request()->urut == 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="oldest" {{ request()->urut == 'oldest' ? 'selected' : '' }}>Terlama</option>
                <option value="title_asc" {{ request()->urut == 'title_asc' ? 'selected' : '' }}>Judul A-Z</option>
                <option value="title_desc" {{ request()->urut == 'title_desc' ? 'selected' : '' }}>Judul Z-A</option>
            </select>
        </div>
        <div class="flex-shrink-0">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transform transition-all duration-300 hover:scale-105">
                Cari
            </button>
        </div>
    </form>

    <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
    <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>
</div>
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden border-t-4 border-purple-500 relative">
            @if($funfacts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6 relative z-10">
                    @foreach($funfacts as $funfact)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition duration-300 hover:translate-y-[-4px]">
                            <div class="relative">
                                @if($funfact->gambar)
                                    <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gradient-to-r from-blue-300 to-teal-300 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <span class="absolute top-2 right-2 text-xs bg-white bg-opacity-80 px-2 py-1 rounded-full text-gray-600">
                                    {{ App\Helpers\IndonesiaTimeHelper::formatDate($funfact->created_at) }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $funfact->judul }}</h3>

                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-1">Deskrips</h4>
                                    <p class="text-sm text-gray-600">{{ Str::limit($funfact->deskripsi, 100) }}</p>
                                </div>

                                <div class="flex justify-end space-x-2 pt-3 border-t border-gray-100">
                                    <a href="{{ route('admin.funfacts.edit', $funfact->funfact_id) }}" class="text-blue-600 hover:text-blue-800 transition-transform duration-300 hover:scale-110">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.funfacts.destroy', $funfact->funfact_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus funfact ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-transform duration-300 hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-purple-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-purple-500/20 animate-wave-slow opacity-40"></div>

                <div class="p-6 border-t border-gray-200 relative z-10">
                    {{ $funfacts->links() }}
                </div>
            @else
                <div class="p-12 text-center relative z-10">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada funfact ditemukan</h3>
                    <p class="text-gray-500 mb-6">Mulai dengan menambahkan funfact lautan pertama Anda</p>
                    <a href="{{ route('admin.funfacts.create') }}" class="bg-gradient-to-r from-purple-500 to-indigo-600 hover:from-purple-600 hover:to-indigo-700 text-white py-2 px-6 rounded-lg font-medium shadow-md transition-all duration-300 hover:shadow-lg transform hover:scale-105">
                        Tambah Funfact Baru
                    </a>
                </div>

                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-purple-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-purple-500/20 animate-wave-slow opacity-40"></div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.bg-gradient-to-r.min-h-screen');

        if (!container) {
            console.error('Bubble container not found');
            return; 
        }

        // Function to create a single bubble
        function createBubble() {
            const bubble = document.createElement('div');
            const size = Math.random() * 60 + 20; 
            const left = Math.random() * 100; /
            const delay = Math.random() * 5; 
            const duration = Math.random() * 15 + 10; 

            bubble.className = 'admin-bubble';
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.bottom = '-100px'; // Start from bottom
            bubble.style.animationDuration = `${duration}s`;
            bubble.style.animationDelay = `${delay}s`;

            container.appendChild(bubble);

            setTimeout(() => {
                if (bubble && bubble.parentNode) {
                    bubble.parentNode.removeChild(bubble);
                }
            }, (duration + delay) * 1000);
        }

        
        for (let i = 0; i < 15; i++) {
            setTimeout(createBubble, i * 300);
        }

        setInterval(createBubble, 2000);
    });
</script>
@endsection

@section('styles')
<style>
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

.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(83, 157, 196) 0%, rgb(65, 120, 183) 100%);
}

.absolute.inset-0.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(109, 176, 214) 0%, rgb(52, 149, 190) 100%);
    opacity: 0.9 !important; 
}

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
    background-size: 200% 200%;
    animation: shimmer 10s infinite ease-in-out;
    pointer-events: none;
    z-index: 2;
}

@keyframes shimmer {
    0% {
        background-position: 0% 0%;
    }
    50% {
        background-position: 100% 100%;
    }
    100% {
        background-position: 0% 0%;
    }
}
.text-shadow {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

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
