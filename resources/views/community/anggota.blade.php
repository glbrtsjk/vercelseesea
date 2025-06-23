@extends('layouts.app')

@section('title', $community->nama_komunitas . ' - Anggota')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Latar Belakang Animasi -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <!-- Header Area -->
    <header class="relative py-12 mb-6">
        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-wrap items-center gap-4">
                <a href="{{ route('communities.show', $community) }}" class="bg-white/80 backdrop-blur-sm text-blue-600 hover:bg-white hover:text-blue-700 p-2 rounded-lg transition-all">
                    <i class="fas fa-arrow-left"></i>
                </a>

                <div class="flex items-center">
                    <div class="w-16 h-16 rounded-xl overflow-hidden mr-4 shadow-lg">
                        @if($community->gambar)
                            <img src="{{ asset('storage/' . $community->gambar) }}"
                                class="w-full h-full object-cover"
                                alt="{{ $community->nama_komunitas }}">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center text-white font-medium">
                                {{ strtoupper(substr($community->nama_komunitas, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">{{ $community->nama_komunitas }}</h1>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-users mr-2"></i>
                            <span>{{ $members->count() }} Anggota</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-6 relative z-10">
        <!-- Pencarian dan Filter -->
        <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-4 mb-6">
            <div class="flex flex-wrap gap-4">
                <div class="flex-1">
                    <form action="{{ route('communities.members', $community) }}" method="GET" class="flex">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari anggota..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="flex items-center gap-2">
                    <select name="role" id="role-filter" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Peran</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="moderator" {{ request('role') == 'moderator' ? 'selected' : '' }}>Moderator</option>
                        <option value="member" {{ request('role') == 'member' ? 'selected' : '' }}>Anggota</option>
                    </select>

                    <select name="sort" id="sort-order" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Statistik Anggota -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-md p-4 flex items-center">
                <div class="bg-white/20 p-3 rounded-lg mr-4">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm opacity-80">Total Anggota</p>
                    <p class="text-2xl font-bold">{{ $members->count() }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl shadow-md p-4 flex items-center">
                <div class="bg-white/20 p-3 rounded-lg mr-4">
                    <i class="fas fa-user-shield text-xl"></i>
                </div>
                <div>
                    <p class="text-sm opacity-80">Admin</p>
                    <p class="text-2xl font-bold">{{ $admins }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-xl shadow-md p-4 flex items-center">
                <div class="bg-white/20 p-3 rounded-lg mr-4">
                    <i class="fas fa-user-cog text-xl"></i>
                </div>
                <div>
                    <p class="text-sm opacity-80">Moderator</p>
                    <p class="text-2xl font-bold">{{ $moderators }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-xl shadow-md p-4 flex items-center">
                <div class="bg-white/20 p-3 rounded-lg mr-4">
                    <i class="fas fa-user text-xl"></i>
                </div>
                <div>
                    <p class="text-sm opacity-80">Anggota Reguler</p>
                    <p class="text-2xl font-bold">{{ $regularMembers }}</p>
                </div>
            </div>
        </div>

        <!-- Daftar Anggota Online -->
        @if($onlineMembers->count() > 0)
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <span class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                Anggota Online ({{ $onlineMembers->count() }})
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($onlineMembers as $member)
                    <div class="bg-white/90 backdrop-blur-sm border-l-4 border-green-400 rounded-xl shadow-sm p-4 flex items-center hover:shadow-md transition-shadow">
                        <div class="relative">
                            @if($member->foto_profil)
                                <img src="{{ asset('storage/' . $member->foto_profil) }}"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-white"
                                    alt="{{ $member->nama }}">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr($member->nama, 0, 1)) }}
                                </div>
                            @endif
                            <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                        </div>

                        <div class="ml-3 min-w-0">
                            <h3 class="font-medium text-gray-900 truncate flex items-center">
                                {{ $member->nama }}
                                @if($member->pivot->role === 'admin')
                                    <span class="ml-1 bg-red-100 text-red-800 text-xs px-1.5 py-0.5 rounded-full">Admin</span>
                                @elseif($member->pivot->role === 'moderator')
                                    <span class="ml-1 bg-amber-100 text-amber-800 text-xs px-1.5 py-0.5 rounded-full">Mod</span>
                                @endif
                            </h3>
                            <p class="text-xs text-green-600">Online</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Daftar Semua Anggota -->
        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-users mr-2"></i>
            Semua Anggota
        </h2>
@if($members->isEmpty())
    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-8 text-center">
        @if($hasSearch)
            <div class="flex flex-col items-center justify-center">
                <div class="text-gray-400 mb-3">
                    <i class="fas fa-search fa-3x"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada hasil untuk "{{ $searchQuery }}"</h3>
                <p class="text-gray-600 mb-4">Coba kata kunci lain atau hapus filter pencarian</p>
                <a href="{{ route('communities.members', $community) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-times-circle mr-2"></i> Hapus Pencarian
                </a>
            </div>
        @else
            <div class="flex flex-col items-center justify-center">
                <div class="text-gray-400 mb-3">
                    <i class="fas fa-users fa-3x"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada anggota ditemukan</h3>
                <p class="text-gray-600">Komunitas ini belum memiliki anggota</p>
            </div>
        @endif
    </div>
@else
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            @foreach($members as $member)
                <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-4 flex items-center hover:shadow-lg transition-shadow">
                    <div class="relative mr-4">
                        @if($member->foto_profil)
                            <img src="{{ asset('storage/' . $member->foto_profil) }}"
                                class="w-16 h-16 rounded-full object-cover border-2 border-gray-200"
                                alt="{{ $member->nama }}">
                        @else
                            <div class="w-16 h-16 rounded-full flex items-center justify-center text-white font-bold text-2xl
                          {{ $member->pivot->role == 'admin' || $member->role == 'admin' ? 'bg-gradient-to-br from-red-400 to-red-600' :
                      ($member->pivot->role == 'moderator' ? 'bg-gradient-to-br from-amber-400 to-amber-600' :
                    'bg-gradient-to-br from-blue-400 to-indigo-500') }}">
                      {{ strtoupper(substr($member->nama, 0, 1)) }}
                        </div>

                        @endif

                        @if($member->pivot && isset($member->pivot->aktif_flag) && $member->pivot->aktif_flag == 1 && $member->pivot->terakhir_aktif && \Carbon\Carbon::parse($member->pivot->terakhir_aktif)->gt(now()->subMinutes(15)))
                            <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900">{{ $member->nama }}</h3>
                        <p class="text-sm text-gray-600 flex items-center gap-1">
                             @if($member->pivot->role === 'admin' || $member->role === 'admin')
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs px-2 py-0.5 rounded-full">
                                    <i class="fas fa-crown text-xs mr-1"></i> Admin
                                </span>
                            @elseif($member->pivot->role === 'moderator')
                                <span class="inline-flex items-center bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full">
                                    <i class="fas fa-shield-alt text-xs mr-1"></i> Moderator
                                </span>
                            @else
                                <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">
                                    <i class="fas fa-user text-xs mr-1"></i> Anggota
                                </span>
                            @endif
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Bergabung {{ App\Helpers\IndonesiaTimeHelper::formatDate($member->pivot->tg_gabung) }}</p>
                    </div>

                    @if(Auth::check() && $isModeratorOrAdmin && !$member->isAdmin())
                        <div class="dropdown">
                            <button class="text-gray-400 hover:text-gray-600 dropdown-toggle" type="button" id="memberMenu{{ $member->user_id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="memberMenu{{ $member->user_id }}">
                                <li class="text-xs text-gray-500 px-4 py-1 border-b">Kelola Anggota</li>

                                @if($member->pivot->role == 'moderator')
                                    <li>
                                        <form action="{{ route('communities.demote-moderator', ['community' => $community, 'user' => $member]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-amber-600 flex items-center" onclick="return confirm('Apakah Anda yakin ingin menghapus moderator ini?');">
                                                <i class="fas fa-user-minus mr-2"></i> Hapus sebagai Moderator
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li>
                                        <form action="{{ route('communities.promote-moderator', ['community' => $community, 'user' => $member]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-amber-600 flex items-center">
                                                <i class="fas fa-user-shield mr-2"></i> Jadikan Moderator
                                            </button>
                                        </form>
                                    </li>
                                @endif

                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('communities.ban-user', ['community' => $community, 'user' => $member]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-red-600 flex items-center" onclick="return confirm('Apakah Anda yakin ingin mengeluarkan anggota ini dari komunitas?');">
                                            <i class="fas fa-ban mr-2"></i> Keluarkan dari Komunitas
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
@endif

        <!-- Pagination -->
        @if($members->hasPages())
            <div class="mt-8">
                {{ $members->links() }}
            </div>
        @endif
    </main>
</div>
@endsection

@section('styles')
<style>
    /* Ocean animations for background */
    .ocean-depth-rays {
        background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(255,255,255,0.05) 50%);
        background-size: 100% 20px;
        opacity: 0.3;
        animation: rays 8s linear infinite;
    }

    .floating-particles::before,
    .floating-particles::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-image: radial-gradient(circle, rgba(255,255,255,0.3) 1px, transparent 1px);
        background-size: 30px 30px;
        opacity: 0.2;
    }

    .floating-particles::before {
        animation: floatParticles 20s linear infinite;
    }

    .floating-particles::after {
        background-size: 20px 20px;
        animation: floatParticles 15s linear infinite reverse;
    }

    .ocean-waves {
        background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='rgba(255,255,255,0.2)'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: bottom;
        background-size: cover;
        animation: waveAnimation 20s linear infinite alternate;
    }

    .ocean-bubbles {
        background-image: radial-gradient(circle, rgba(255,255,255,0.6) 2px, transparent 2px),
                        radial-gradient(circle, rgba(255,255,255,0.4) 1px, transparent 1px);
        background-size: 50px 50px, 30px 30px;
        animation: bubbleRise 15s linear infinite;
        opacity: 0.2;
    }

    .underwater-current {
        background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.1) 50%, rgba(255,255,255,0) 100%);
        animation: underwaterCurrent 8s ease-in-out infinite;
    }

    @keyframes rays {
        0% { background-position: 0 0; }
        100% { background-position: 0 20px; }
    }

    @keyframes waveAnimation {
        0% { transform: translateX(-50px); }
        50% { transform: translateY(15px); }
        100% { transform: translateX(50px) translateY(-15px); }
    }

    @keyframes floatParticles {
        0% { transform: translateY(0) translateX(0); }
        25% { transform: translateY(-15px) translateX(15px); }
        50% { transform: translateY(-25px) translateX(0); }
        75% { transform: translateY(-10px) translateX(-15px); }
        100% { transform: translateY(0) translateX(0); }
    }

    @keyframes bubbleRise {
        from { background-position: 0 0, 0 0; }
        to { background-position: 0 -100px, 0 -50px; }
    }

    @keyframes underwaterCurrent {
        0%, 100% { opacity: 0.05; transform: translateX(-100%); }
        50% { opacity: 0.15; transform: translateX(100%); }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle filter changes
        const roleFilter = document.getElementById('role-filter');
        const sortOrder = document.getElementById('sort-order');

        function applyFilters() {
            const url = new URL(window.location);

            if (roleFilter.value) {
                url.searchParams.set('role', roleFilter.value);
            } else {
                url.searchParams.delete('role');
            }

            if (sortOrder.value) {
                url.searchParams.set('sort', sortOrder.value);
            } else {
                url.searchParams.delete('sort');
            }

            window.location = url;
        }

        roleFilter.addEventListener('change', applyFilters);
        sortOrder.addEventListener('change', applyFilters);

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
