@extends('layouts.admin')

@section('title', 'Admin Komunitas')

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
                    <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Komunitas Saya</h1>
                    <p class="text-cyan-100 font-medium">Kelola komunitas dan anggota Anda</p>
                </div>


                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.communities.create') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Komunitas
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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Total Komunitas</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalCommunities }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-blue-500 to-sky-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Total Anggota</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $totalMembers }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Komunitas Aktif</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $activeCommunities }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-sky-100 to-blue-100 backdrop-blur-sm rounded-2xl shadow-lg p-6 border-l-4 border-blue-100 transform transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div class="flex items-center">
                    <div class="p-3 rounded-xl bg-gradient-to-r from-yellow-500 to-amber-600 text-white">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-gray-600 font-semibold">Baru Bulan Ini</h2>
                        <p class="text-3xl font-bold text-gray-800">{{ $newThisMonth }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg mb-8 p-6 border-t-4 border-blue-500 relative overflow-hidden">
            <form action="{{ route('admin.dashboard.community') }}" method="GET" class="flex flex-col md:flex-row gap-4 relative z-10">
                    <div class="relative flex-grow h-full">
                         <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
            </div>
                        <input type="text" name="search" placeholder="Cari komunitas..." class="w-full py-3 pl-12 pr-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200 focus:border-blue-500" value="{{ request('search') }}">

                    </div>

                <div class="w-48 flex-shrink-0">
                    <select name="sort" class="w-full py-3   px-3 rounded-lg border border-gray-300 focus:ring focus:ring-blue-200 focus:border-blue-500">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="members_high" {{ request('sort') == 'members_high' ? 'selected' : '' }}>Anggota Terbanyak</option>
                        <option value="members_low" {{ request('sort') == 'members_low' ? 'selected' : '' }}>Anggota Tersedikit</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-lg transform transition-all duration-300 hover:scale-105">Terapkan</button>
                    <a href="{{ route('admin.dashboard.community') }}" class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Reset</a>
                </div>
            </form>

            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg mb-8 border-t-4 border-purple-500 relative overflow-hidden">
            <div class="p-6 border-b border-gray-200 relative z-10">
                <h2 class="text-lg font-semibold text-gray-800">Komunitas Saya</h2>
                <p class="text-gray-600">Komunitas yang telah Anda buat dan kelola</p>
            </div>

            @if($communities->count() > 0)
                <div class="overflow-x-auto relative z-10">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komunitas</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Anggota</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($communities as $community)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            @if($community->gambar)
                                                <img src="{{ Storage::url($community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="w-10 h-10 rounded-full object-cover mr-4">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-purple-500 flex items-center justify-center text-white font-bold mr-4">
                                                    {{ substr($community->nama_komunitas, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $community->nama_komunitas }}</p>
                                                <p class="text-sm text-gray-500">{{ Str::limit($community->deskripsi, 60) }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                            </svg>
                                            {{ $community->users_count }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        {{ $community->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        @if($community->is_active)
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Non-aktif</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('communities.show', $community->community_id) }}" class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.communities.edit',$community) }}" class="text-yellow-600 hover:text-yellow-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <button onclick="confirmDelete({{ $community->community_id }})" class="text-red-600 hover:text-red-900">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                            <form id="delete-form-{{ $community->community_id }}" action="{{ route('admin.communities.destroy', $community->community_id) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Wave background -->
                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-purple-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-purple-500/20 animate-wave-slow opacity-40"></div>

                <!-- Pagination -->
                <div class="p-6 relative z-10">
                    {{ $communities->withQueryString()->links() }}
                </div>
            @else
                <div class="p-12 text-center relative z-10">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada komunitas</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat komunitas baru.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.communities.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Buat Komunitas
                        </a>
                    </div>
                </div>

                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-purple-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-purple-500/20 animate-wave-slow opacity-40"></div>
            @endif
        </div>

        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border-t-4 border-teal-500 relative overflow-hidden">
            <div class="p-6 border-b border-gray-200 relative z-10">
                <h2 class="text-lg font-semibold text-gray-800">Aktivitas Anggota Terkini</h2>
                <p class="text-gray-600">Aktivitas terbaru di seluruh komunitas Anda</p>
            </div>

            <!-- Wave background -->
            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-teal-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-teal-500/20 animate-wave-slow opacity-40"></div>

            @if(isset($recentActivity) && $recentActivity->count() > 0)
                <div class="divide-y divide-gray-200 relative z-10">
                    @foreach($recentActivity as $activity)
                        <div class="p-6">
                            <div class="flex items-start">
                                <img src="{{ $activity->user->foto_profil ? Storage::url($activity->user->foto_profil) : asset('img/default-avatar.png') }}" alt="{{ $activity->user->name }}" class="w-10 h-10 rounded-full object-cover mr-4 border-2 border-teal-500">
                                <div>
                                    <p class="text-gray-800">
                                        <span class="font-medium">{{ $activity->user->name }}</span>
                                        {{ $activity->action }}
                                        <a href="{{ route('communities.show', $activity->community->community_id) }}" class="text-blue-600 hover:underline">{{ $activity->community->nama_komunitas }}</a>
                                    </p>
                                    <p class="text-sm text-gray-500 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-6 text-center relative z-10">
                    <p class="text-gray-500">Belum ada aktivitas terbaru</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function confirmDelete(communityId) {
        if (confirm('Apakah Anda yakin ingin menghapus komunitas ini? Tindakan ini tidak dapat dibatalkan.')) {
            document.getElementById('delete-form-' + communityId).submit();
        }
    }

    // Bubble Animation for AdAkti
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.bg-gradient-to-r.min-h-screen');

        if (!container) {
            console.error('Bubble container not found');
            return; // Exit if container not found
        }

        // Function to create a single bubble
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

         alerts.forEach(alert => {
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    alert.classList.add('auto-dismiss');
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }
            }, 5000);
        });
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

/* Enhanced background - increase contrast */
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
