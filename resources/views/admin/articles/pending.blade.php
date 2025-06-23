@extends('layouts.admin')

@section('title', 'Artikel Tertunda')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen py-8 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>
    <div class="container mx-auto px-4">
        <!-- Header Section dengan Animasi Gelombang -->
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-sm shadow-lg rounded-2xl p-6 mb-8 overflow-hidden border-t-4 border-blue-200">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Artikel Tertunda</h1>
                    <p class="text-cyan-100 font-medium">Tinjau dan kelola artikel yang menunggu persetujuan</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.dashboard') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Dasbor
                    </a>
                </div>
            </div>

            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>

            <!-- Efek partikel halus -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
            </div>
        </div>

        <!-- Notifikasi Alerts -->
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md transform transition-all duration-500 animate-fade-in-down" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md transform transition-all duration-500 animate-fade-in-down" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Filter Panel -->
        <div class="rounded-2xl bg-gradient-to-b from-blue-100 to-blue-200 backdrop-blur-sm shadow-md p-5 mb-6 border-l-4 border-blue-100 animate-fade-in-up">
            <form action="{{ route('admin.articles.pending') }}" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center">
                    <div class="p-2 mr-3 rounded-lg bg-gradient-to-r from-teal-500 to-blue-600 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                    </div>
                    <select name="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 transition-all duration-300">
                        <option value="">Semua Kategori</option>
                        @foreach ($articles->pluck('category.nama_kategori', 'category.category_id')->unique() as $id => $name)
                            <option value="{{ $id }}" {{ request('category') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative flex-grow md:max-w-xs">
                    <div class="flex">
                        <div class="relative flex-grow">
                            <input type="search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-4 pr-3 py-2.5" placeholder="Cari artikel..." value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-r-lg px-3 transition-all duration-200 focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if($articles->count() > 0)
            <!-- Tabel Artikel -->
            <div class="bg-gradient-to-b from-sky-100 to-blue-100 backdrop-blur-sm shadow-lg rounded-2xl overflow-hidden border-t-4 border-blue-100 relative">
                <div class="overflow-x-auto relative z-10">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-600/90 to-sky-500/90">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Penulis</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kategori</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal Kirim</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($articles as $article)
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($article->gambar)
                                                <div class="flex-shrink-0 h-12 w-12">
                                                    <img class="h-12 w-12 rounded-lg object-cover shadow-md border-2 border-blue-100" src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}">
                                                </div>
                                            @else
                                                <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-gradient-to-br from-blue-400 to-teal-400 flex items-center justify-center shadow-md">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900 hover:text-blue-600 transition-colors duration-300">
                                                    {{ $article->judul }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $article->user->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $article->category->nama_kategori }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-700">{{ $article->tgl_upload->format('d M, Y') }}</span>
                                            <span class="text-xs text-gray-400">{{ $article->tgl_upload->format('H:i') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <a href="{{ route('articles.show', $article) }}" class="bg-indigo-100 hover:bg-indigo-200 text-indigo-700 p-2 rounded-lg transition-all duration-200 transform hover:scale-105" title="Lihat">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#approveModal{{ $article->article_id }}" class="bg-green-100 hover:bg-green-200 text-green-700 p-2 rounded-lg transition-all duration-200 transform hover:scale-105" title="Setujui">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $article->article_id }}" class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-all duration-200 transform hover:scale-105" title="Tolak">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Persetujuan -->
                                <div class="modal fade" id="approveModal{{ $article->article_id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $article->article_id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-xl bg-gradient-to-b from-white to-blue-50 border-t-4 border-green-500">
                                            <div class="modal-header border-b-0">
                                                <h5 class="modal-title text-lg font-bold text-gray-800" id="approveModalLabel{{ $article->article_id }}">Konfirmasi Persetujuan</h5>
                                                <button type="button" class="btn-close text-gray-500 hover:text-gray-700 focus:outline-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body px-6 py-4">
                                                <div class="flex items-center mb-4 text-green-600">
                                                    <svg class="w-10 h-10 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <div>
                                                        <p class="text-gray-700">Apakah Anda yakin ingin menyetujui artikel ini?</p>
                                                        <p class="font-semibold text-gray-900 mt-1">{{ $article->judul }}</p>
                                                        <p class="text-sm text-gray-500">Oleh <span class="font-medium">{{ $article->user->nama }}</span></p>
                                                    </div>
                                                </div>
                                                <p class="text-sm text-gray-600 mt-2 border-t border-gray-200 pt-2">
                                                    Artikel ini akan langsung dipublikasikan dan tersedia untuk umum setelah disetujui.
                                                </p>
                                            </div>
                                            <div class="modal-footer bg-gray-50 rounded-b-xl border-t border-gray-100 flex justify-between">
                                                <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition duration-200" data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <form action="{{ route('admin.articles.approve', $article) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-2 rounded-lg transition duration-200 shadow-md">
                                                        <div class="flex items-center">
                                                            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Setujui Artikel
                                                        </div>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Penolakan -->
                                <div class="modal fade" id="rejectModal{{ $article->article_id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $article->article_id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content rounded-xl bg-gradient-to-b from-white to-red-50 border-t-4 border-red-500">
                                            <form action="{{ route('admin.articles.reject', $article) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-b-0">
                                                    <h5 class="modal-title text-lg font-bold text-gray-800" id="rejectModalLabel{{ $article->article_id }}">Tolak Artikel</h5>
                                                    <button type="button" class="btn-close text-gray-500 hover:text-gray-700 focus:outline-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body px-6 py-4">
                                                    <div class="flex items-center mb-4 text-red-600">
                                                        <svg class="w-10 h-10 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        <div>
                                                            <p class="text-gray-700">Anda akan menolak artikel:</p>
                                                            <p class="font-semibold text-gray-900 mt-1">{{ $article->judul }}</p>
                                                            <p class="text-sm text-gray-500">Oleh <span class="font-medium">{{ $article->user->nama }}</span></p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 mt-4">
                                                        <label for="feedback{{ $article->article_id }}" class="block text-sm font-medium text-gray-700 mb-2">Masukan untuk Penulis (Opsional)</label>
                                                        <textarea class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" id="feedback{{ $article->article_id }}" name="feedback" rows="4" placeholder="Berikan masukan untuk membantu penulis memperbaiki artikelnya..."></textarea>
                                                        <p class="mt-1 text-xs text-gray-500">Masukan yang konstruktif akan membantu penulis meningkatkan kualitas artikelnya.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-gray-50 rounded-b-xl border-t border-gray-100 flex justify-between">
                                                    <button type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition duration-200" data-bs-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-4 py-2 rounded-lg transition duration-200 shadow-md">
                                                        <div class="flex items-center">
                                                            <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Tolak Artikel
                                                        </div>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="absolute -bottom-8 left-0 right-0 h-16 bg-blue-400/20 animate-wave opacity-60"></div>
                <div class="absolute -bottom-4 left-0 right-0 h-16 bg-blue-500/20 animate-wave-slow opacity-40"></div>

                <div class="p-5 relative z-10 border-t border-gray-200">
                    {{ $articles->links() }}
                </div>
            </div>
        @else
            <!-- Tampilan tidak ada artikel -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-12 shadow-lg text-center border-t-4 border-blue-500 animate-fade-in-up">
                <div class="text-8xl text-blue-500/30 mb-6 animate-float">
                    <svg class="inline-block" fill="currentColor" viewBox="0 0 24 24" style="width: 120px; height: 120px;">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Tidak Ada Artikel Tertunda!</h2>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">Semua artikel telah ditinjau. Cek lagi nanti untuk artikel baru yang memerlukan persetujuan.</p>
            </div>
        @endif

        <!-- Panduan Status Artikel -->
        <div class="mt-8 rounded-2xl bg-gradient-to-t from-sky-100 to-blue-100 backdrop-blur-sm p-6 shadow-lg border-t-4 border-teal-500 relative overflow-hidden animate-fade-in-up">
            <div class="relative z-10">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Panduan Persetujuan Artikel
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg border border-green-200 hover:bg-green-100 transition-all duration-300 transform hover:scale-105">
                        <span class="w-4 h-4 rounded-full bg-green-400 border border-green-600 flex-shrink-0"></span>
                        <span class="text-sm text-gray-700"><strong>Setujui:</strong> Artikel layak untuk dipublikasikan</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-red-50 rounded-lg border border-red-200 hover:bg-red-100 transition-all duration-300 transform hover:scale-105">
                        <span class="w-4 h-4 rounded-full bg-red-400 border border-red-600 flex-shrink-0"></span>
                        <span class="text-sm text-gray-700"><strong>Tolak:</strong> Artikel membutuhkan revisi atau tidak sesuai</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg border border-blue-200 hover:bg-blue-100 transition-all duration-300 transform hover:scale-105 md:col-span-2">
                        <span class="w-4 h-4 rounded-full bg-blue-400 border border-blue-600 flex-shrink-0"></span>
                        <span class="text-sm text-gray-700"><strong>Tips:</strong> Berikan masukan konstruktif saat menolak artikel untuk membantu penulis meningkatkan kualitasnya</span>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-teal-400/20 animate-wave opacity-60"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-teal-500/20 animate-wave-slow opacity-40 delay-150"></div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
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
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

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

@keyframes float {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

@keyframes fade-in-down {
  0% {
    opacity: 0;
    transform: translateY(-20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fade-in-up {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-wave {
  animation: wave 8s linear infinite;
}

.animate-wave-slow {
  animation: wave-slow 12s linear infinite;
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}

.animate-fade-in-down {
  animation: fade-in-down 0.5s ease-out;
}

.animate-fade-in-up {
  animation: fade-in-up 0.8s ease-out;
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

.modal-content {
    border: none !important;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
}

.btn-close {
    background: none !important;
    font-size: 1.5rem;
    opacity: 0.5;
}

.btn-close:hover {
    opacity: 0.75;
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
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bgElement = document.querySelector('.bg-gradient-to-r.min-h-screen');
        bgElement.classList.add('animate-shimmer');

        const container = document.querySelector('.bg-gradient-to-r.min-h-screen');

        if (container) {
            function createBubble() {
                const bubble = document.createElement('div');
                const size = Math.random() * 60 + 20; // Random size between 20-80px
                const left = Math.random() * 100; // Random horizontal position
                const delay = Math.random() * 5; // Random delay
                const duration = Math.random() * 15 + 10; // Random duration between 10-25s

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
        }

        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function () {
                const modalContent = this.querySelector('.modal-content');
                modalContent.classList.add('animate-fade-in-up');

                setTimeout(() => {
                    modalContent.classList.remove('animate-fade-in-up');
                }, 500);
            });
        });
    });
</script>
@endsection
