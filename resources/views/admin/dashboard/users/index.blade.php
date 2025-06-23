<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\dashboard\users\index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen pb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <!-- Header Section with Wave Animation -->
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-lg shadow-lg rounded-xl p-6 mb-8 overflow-hidden border-t-4 border-cyan-400">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Manajemen User</h1>
                    <p class="text-cyan-100 font-medium">Kelola semua data User aplikasi</p>
                </div>
                <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
                    <a href="{{ route('admin.users.usermanage') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Dasbor User
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="bg-cyan-600/70 hover:bg-cyan-700/80 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-cyan-400/30">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Kembali ke Dasbor
                    </a>
                </div>

                  <!-- Enhanced wave animations -->
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>
         <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
         </div>
        <div class="particle particle-1"></div>
        <div class="particle particle-2"></div>
        <div class="particle particle-3"></div>
            </div>


        <!-- User Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-300 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="flex items-center relative z-10">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-blue-600 font-semibold">Total User</h2>
                        <p class="text-3xl font-bold text-blue-700">{{ $totalUsers }}</p>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-blue-200/50 rounded-full"></div>
            </div>

            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-green-300 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="flex items-center relative z-10">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-green-600 font-semibold">Aktif Minggu Ini</h2>
                        <p class="text-3xl font-bold text-green-700">{{ $activeUsers }}</p>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-green-200/50 rounded-full"></div>
            </div>

            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-red-300 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="flex items-center relative z-10">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-red-500 to-rose-600 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-red-600 font-semibold">User Diblokir</h2>
                        <p class="text-3xl font-bold text-red-700">{{ $bannedUsers }}</p>
                    </div>
                </div>
                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-red-200/50 rounded-full"></div>
            </div>
        </div>

        <!-- User Search & Filters -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 mb-8 border-t-4 border-blue-500 relative overflow-hidden">
            <!-- Wave background -->
            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>

            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 relative z-10">
                <div class="flex-grow">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau email..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 onchange="this.form.submit()">
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua User</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>User Aktif</option>
                        <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>User Diblokir</option>
                        <option value="recent" {{ request('status') == 'recent' ? 'selected' : '' }}>Baru Bergabung</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Users Table -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden border-t-4 border-teal-500 relative">
            <!-- Wave background -->
            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-teal-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-teal-500/20 animate-wave-slow opacity-40"></div>

            <div class="overflow-x-auto relative z-10">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-teal-500 to-cyan-600 text-sky-200">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Bergabung</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Konten</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover border-2 border-teal-500"
                                            src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('img/default-avatar.png') }}"
                                            alt="{{ $user->name }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->isBanned())
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Diblokir</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-2">
                                    <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                                        </svg>
                                        {{ $user->articles_count ?? 0 }}
                                    </span>
                                    <span class="px-2 inline-flex items-center text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        <svg class="mr-1 h-3 w-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"></path>
                                        </svg>
                                        {{ $user->comments_count ?? 0 }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.users.show', $user->user_id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat</a>

                                    @if(Auth::id() !== $user->user_id)
                                        @if($user->isBanned())
                                            <form action="{{ route('admin.users.unban', $user->user_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900">Buka Blokir</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user->user_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900">Blokir</button>
                                            </form>
                                        @endif

                                        <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus User ini? Tindakan ini tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">(Anda)</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-white border-t border-gray-200 relative z-10">
                {{ $users->links() }}
            </div>
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

        function createBubble() {
            const bubble = document.createElement('div');
            const size = Math.random() * 60 + 20; 
            const left = Math.random() * 100; 
            const delay = Math.random() * 5; 
            const duration = Math.random() * 15 + 10; 

            bubble.className = 'admin-bubble';
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.bottom = '-100px'; 
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
.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(83, 157, 196) 0%, rgb(65, 120, 183) 100%);
}

.absolute.inset-0.bg-gradient-to-r.from-sky-800.to-cyan-600 {
    background-image: linear-gradient(to right, rgb(109, 176, 214) 0%, rgb(52, 149, 190) 100%);
    opacity: 0.9 !important; /* Increase opacity */
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
    )};


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
