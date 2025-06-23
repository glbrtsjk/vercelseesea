@extends('layouts.admin')

@section('title', 'Kelola Tag')

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
    <div class="container mx-auto px-4 py-8 relative z-10">
        <!-- Header Kelola Tag -->
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-lg shadow-lg rounded-xl p-6 mb-8 overflow-hidden border-t-4 border-cyan-400">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1 text-shadow">Kelola Tag</h1>
                    <p class="text-cyan-100 font-medium">Kelola semua tag artikel di portal lautan</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.tags.create') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Tag Baru
                    </a>
                </div>
            </div>

            <!-- Enhanced wave animations with brighter colors -->
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>

            <!-- Add subtle particle effect -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
            </div>
        </div>

        <!-- Kartu Pencarian dan Filter -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg mb-8 overflow-hidden transition duration-300 hover:shadow-xl border-t-4 border-blue-500">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Pencarian dan Filter
                </h2>
            </div>
            <div class="p-6 relative">
                <!-- Wave background -->
                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>

                <form action="{{ route('admin.tags.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4 relative z-10">
                    <div class="md:col-span-5">
                        <div class="relative">
                            <input type="text" class="pencarian-tag form-input block w-full pl-10 pr-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                                 name="search" placeholder="Cari tag..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <select name="sort" class="pilihan-urutan form-select block w-full pl-10 pr-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                            <option value="articles" {{ request('sort') == 'articles' ? 'selected' : '' }}>Artikel Terbanyak</option>
                            <option value="created" {{ request('sort') == 'created' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit" class="tombol-terapkan w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md  text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:scale-105 shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            Terapkan
                        </button>
                    </div>

                    <div class="md:col-span-2">
                        <a href="{{ route('admin.tags.index') }}" class="tombol-reset w-full flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Tag -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden mb-8 transition duration-300 hover:shadow-xl border-t-4 border-blue-500 relative">
            <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center relative z-10">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Semua Tag
                </h2>
                <span class="bagde-total-tag bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $tags->total() }} tag
                </span>
            </div>


            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>

            <div class="overflow-x-auto relative z-10">
                <table class="tabel-tag min-w-full bg-white" id="tabelTag">
                    <thead class="bg-gradient-to-b from-blue-500 to-cyan-600 text-white uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Nama Tag</th>
                            <th class="py-3 px-4 text-left">Slug</th>
                            <th class="py-3 px-4 text-left">Artikel</th>
                            <th class="py-3 px-4 text-left">Dibuat Pada</th>
                            <th class="py-3 px-4 text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($tags as $tag)
                            <tr class="tag-baris hover:bg-blue-50 transition-all duration-200">
                                <td class="py-3 px-4 text-gray-800">{{ $tag->tag_id }}</td>
                                <td class="py-3 px-4">
                                    <span class="tag-nama font-medium text-gray-900">{{ $tag->nama_tag }}</span>
                                </td>
                                <td class="py-3 px-4 text-gray-600">{{ $tag->slug }}</td>
                                <td class="py-3 px-4">
                                    <span class="tag-jumlah-artikel bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $tag->articles_count }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-gray-600">{{ App\Helpers\IndonesiaTimeHelper::formatDate($tag->created_at)}}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.tags.edit', $tag->tag_id) }}" class="tombol-edit-tag bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-2 rounded-md transition duration-300 transform hover:scale-110 shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('tags.show', $tag->slug) }}" class="tombol-lihat-tag bg-gradient-to-r from-blue-500 to-emerald-600 hover:from-blue--600 hover:to-emerald-700 text-white p-2 rounded-md transition duration-300 transform hover:scale-110 shadow-sm" target="_blank">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.tags.destroy', $tag->tag_id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="tombol-hapus-tag bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white p-2 rounded-md transition duration-300 transform hover:scale-110 shadow-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus tag ini? Ini akan menghapus tag dari semua artikel.')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 px-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-lg">Tidak ada tag yang ditemukan</p>
                                        <p class="text-sm text-gray-400">Coba buat tag baru atau ubah filter pencarian Anda</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-4 py-3 border-t border-gray-200 bg-gray-50 relative z-10">
                <div class="pagination-tag flex justify-center">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>

        <!-- Alat Penggabungan Tag -->
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden mb-8 transition duration-300 hover:shadow-xl border-t-4 border-yellow-500 relative">
            <div class="border-b border-gray-200 px-6 py-4 relative z-10">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                    </svg>
                    Gabungkan Tag
                </h2>
            </div>

            <!-- Wave background -->
            <div class="absolute -bottom-8 left-0 right-0 h-16 bg-yellow-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-4 left-0 right-0 h-16 bg-yellow-500/20 animate-wave-slow opacity-40"></div>

            <div class="p-6 relative z-10">
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">Gunakan alat ini untuk menggabungkan satu tag ke tag lainnya. Semua artikel yang terkait dengan tag sumber akan dipindahkan ke tag target.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.tags.merge') }}" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    @csrf
                    <div class="md:col-span-5">
                        <label for="source_tag_id" class="block text-sm font-medium text-gray-700 mb-2">Tag Sumber (akan dihapus)</label>
                        <select name="source_tag_id" id="tag_sumber" class="pilihan-tag-sumber form-select block w-full rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
                            <option value="">Pilih tag</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->tag_id }}">{{ $tag->nama_tag }} ({{ $tag->articles_count }} artikel)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-5">
                        <label for="target_tag_id" class="block text-sm font-medium text-gray-700 mb-2">Tag Target (akan menerima artikel)</label>
                        <select name="target_tag_id" id="tag_target" class="pilihan-tag-target form-select block w-full rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
                            <option value="">Pilih tag</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->tag_id }}">{{ $tag->nama_tag }} ({{ $tag->articles_count }} artikel)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2 flex items-end">
                        <button type="submit" class="tombol-gabungkan w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md  text-sm font-medium text-white bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-all duration-300 transform hover:scale-105 shadow-md"
                                onclick="return confirm('Apakah Anda yakin ingin menggabungkan tag ini? Ini tidak dapat dibatalkan.')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                            </svg>
                            Gabungkan Tag
                        </button>
                    </div>
                </form>
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

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
    animation: fadeIn 0.4s ease-out forwards;
}

.tag-baris {
    transition: all 0.2s ease;
}

.tag-baris:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.tag-jumlah-artikel {
    transition: all 0.2s ease;
}

.tag-baris:hover .tag-jumlah-artikel {
    background-color: rgba(37, 99, 235, 0.2);
    transform: scale(1.1);
}

.notifikasi {
    transform: translateY(-10px);
    opacity: 0;
    animation: slideDown 0.5s ease forwards;
}

@keyframes slideDown {
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@media (max-width: 640px) {
    .tag-baris td {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    .tag-baris td:last-child {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }

    .tombol-edit-tag, .tombol-lihat-tag, .tombol-hapus-tag {
        padding: 0.25rem;
    }

    .tombol-edit-tag svg, .tombol-lihat-tag svg, .tombol-hapus-tag svg {
        width: 0.875rem;
        height: 0.875rem;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animasi untuk kartu tag pada saat halaman dimuat
    const cards = document.querySelectorAll('.rounded-2xl, .rounded-xl');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
    });

    // Menunjukkan total tag ditemukan
    const totalTag = {{ $tags->total() }};
    const hasilPencarian = document.querySelector('.bagde-total-tag');
    if (hasilPencarian) {
        if ("{{ request('search') }}") {
            hasilPencarian.textContent = `${totalTag} tag ditemukan`;
            hasilPencarian.classList.add('bg-green-100', 'text-green-800');
            hasilPencarian.classList.remove('bg-blue-100', 'text-blue-800');
        }
    }

    // Efek ripple pada tombol
    const buttons = document.querySelectorAll('button, .tombol-edit-tag, .tombol-lihat-tag, .tombol-hapus-tag');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Cek jika pengguna mengklik sebuah form hapus dan tidak mengkonfirmasi
            if (this.classList.contains('tombol-hapus-tag') && !confirm('Apakah Anda yakin ingin menghapus tag ini? Ini akan menghapus tag dari semua artikel.')) {
                e.preventDefault();
                return false;
            }

            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            this.appendChild(ripple);

            const x = e.clientX - e.target.getBoundingClientRect().left;
            const y = e.clientY - e.target.getBoundingClientRect().top;

            ripple.style.cssText = `
                position: absolute;
                background: rgba(255, 255, 255, 0.7);
                border-radius: 50%;
                pointer-events: none;
                width: 100px;
                height: 100px;
                top: ${y - 50}px;
                left: ${x - 50}px;
                transform: scale(0);
                opacity: 0.5;
                animation: rippleEffect 0.6s linear;
            `;

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });'
    
    ocument.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('#success-alert, #error-alert');
        
        alerts.forEach(alert => {
            setTimeout(() => {
                if (alert && alert.parentNode) {
                    alert.classList.add('auto-dismiss');
                    setTimeout(() => {
                        if (alert && alert.parentNode) {
                            alert.remove();
                        }
                    }, 500);
                }
            }, 5000);
        });
    });'

    // Pencegahan pemilihan tag yang sama untuk sumber dan target
    const tagSumber = document.getElementById('tag_sumber');
    const tagTarget = document.getElementById('tag_target');

    if (tagSumber && tagTarget) {
        function validateTags() {
            const sumberValue = tagSumber.value;
            const targetValue = tagTarget.value;

            if (sumberValue && targetValue && sumberValue === targetValue) {
                alert('Tag sumber dan target tidak boleh sama!');
                this.value = '';
                return false;
            }
            return true;
        }

        tagSumber.addEventListener('change', validateTags);
        tagTarget.addEventListener('change', validateTags);
    }

    // Menampilkan animasi gelembung laut di latar belakang
    const container = document.querySelector('.bg-gradient-to-r.min-h-screen');
    if (container) {
        for (let i = 0; i < 15; i++) {
            createBubble(container);
        }

        // Buat gelembung baru secara berkala
        setInterval(() => createBubble(container), 2000);
    }

    // Fungsi untuk membuat gelembung lautan
    function createBubble(parent) {
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

        parent.appendChild(bubble);

        setTimeout(() => {
            if (bubble && bubble.parentNode) {
                bubble.parentNode.removeChild(bubble);
            }
        }, (duration + delay) * 1000);
    }

    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
        @keyframes rippleEffect {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        @keyframes bubbleRise {
            0% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 0.2;
            }
            90% {
                opacity: 0.1;
            }
            100% {
                transform: translateY(-100vh) translateX(${Math.random() > 0.5 ? '+' : '-'}${Math.random() * 50}px);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(styleSheet);
});
</script>
@endsection
