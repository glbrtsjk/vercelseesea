@extends('layouts.app')

@section('title', 'Jelajahi Tag')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
    <!-- Animated Ocean Background -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-400/10 via-cyan-500/10 to-teal-600/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <!-- Header Utama -->
    <section class="bg-gradient-to-br from-blue-800 via-blue-900 to-teal-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0 deep-sea-bubbles opacity-30"></div>
        <div class="absolute inset-0 z-0 bg-cover bg-center opacity-20"
             style="background-image: url('https://images.unsplash.com/photo-1583212292454-1fe6229603b7?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');"></div>

        <!-- Efek Gelombang Dinamis -->
        <div class="absolute inset-0 z-0">
            <div class="wave-overlay-1"></div>
            <div class="wave-overlay-2"></div>
            <div class="wave-overlay-3"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Badge Status -->
                <div class="inline-flex items-center bg-white/15 backdrop-blur-md rounded-full px-8 py-4 mb-8 animate-on-scroll border border-white/20">
                    <div class="w-4 h-4 bg-cyan-300 rounded-full mr-4 animate-pulse"></div>
                    <span class="text-cyan-100 font-semibold text-lg">{{ $isAdmin ? 'Pusat Administrasi Tag' : 'Jelajahi Konten berdasarkan Topik' }}</span>
                </div>

                <!-- Judul Utama -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-8 leading-tight text-reveal">
                    <span class="gradient-text-enhanced">{{ $isAdmin ? 'Kelola' : 'Jelajahi' }}</span>
                    <br class="md:hidden">
                    Topik <span class="gradient-text-enhanced">Tag</span>
                </h1>

                <!-- Deskripsi -->
                <p class="text-xl md:text-2xl text-cyan-100 max-w-4xl mx-auto leading-relaxed mb-12 text-reveal-delay-1">
                    {{ $isAdmin ? 'Atur dan kelola semua tag situs untuk meningkatkan penemuan konten dan pengalaman pengguna' : 'Temukan pengetahuan kelautan yang dikategorikan berdasarkan topik yang penting bagi Anda' }}
                </p>
            </div>
        </div>

        <!-- Pembagi Gelombang -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                <path fill="#f0fdff" fill-opacity="1"
                      d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,208C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8 relative z-10">
        <!-- Admin Panel -->
        @if($isAdmin)
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20 mb-12">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Tag</h2>
                    <form action="{{ route('tags.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <input type="text" name="search" placeholder="Cari tag..."
                                   class="w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 bg-white/80 backdrop-blur-sm"
                                   value="{{ request('search') }}">
                        </div>
                        <div>
                            <select name="sort" class="w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 bg-white/80 backdrop-blur-sm appearance-none">
                                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama (A-Z)</option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                                <option value="articles" {{ request('sort') == 'articles' ? 'selected' : '' }}>Artikel Terbanyak</option>
                                <option value="created" {{ request('sort') == 'created' ? 'selected' : '' }}>Terbaru</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-4 py-3 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg">
                                Terapkan Filter
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('tags.index') }}" class="flex items-center justify-center w-full bg-gray-100 text-gray-800 px-4 py-3 rounded-xl hover:bg-gray-200 transition-all duration-300">
                                Atur Ulang Filter
                            </a>
                        </div>
                    </form>
                </div>

                <!-- Tag Merge Tool -->
                <div class="pt-8 border-t border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center mb-4">
                        <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2"></path>
                        </svg>
                        Alat Penggabungan Tag
                    </h2>
                    <p class="mb-6 text-gray-600">Gunakan alat ini untuk menggabungkan satu tag ke tag lain. Semua artikel dan langganan pengguna yang terkait dengan tag sumber akan ditransfer ke tag target.</p>

                    <form action="{{ route('admin.tags.merge') }}" method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        @csrf
                        <div class="md:col-span-2">
                            <label for="source_tag_id" class="block text-sm font-medium text-gray-700 mb-1">Tag Sumber (akan dihapus)</label>
                            <select name="source_tag_id" id="source_tag_id" class="w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 bg-white/80 backdrop-blur-sm" required>
                                <option value="">Pilih tag</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->tag_id }}">{{ $tag->nama_tag }} ({{ $tag->articles_count }} artikel)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label for="target_tag_id" class="block text-sm font-medium text-gray-700 mb-1">Tag Target (akan menerima konten)</label>
                            <select name="target_tag_id" id="target_tag_id" class="w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 border border-gray-200 bg-white/80 backdrop-blur-sm" required>
                                <option value="">Pilih tag</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->tag_id }}">{{ $tag->nama_tag }} ({{ $tag->articles_count }} artikel)</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-sky-500 text-white px-4 py-3 rounded-xl hover:from-blue-600 hover:to-sky-600 transition-all duration-300 shadow-lg"
                                    onclick="return confirm('Apakah Anda yakin ingin menggabungkan tag ini? Tindakan ini tidak dapat dibatalkan.')">
                                <i class="fas fa-object-group mr-2"></i>
                                Gabungkan Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <!-- Regular User Search Box -->
            <div class="max-w-4xl mx-auto -mt-16 mb-12">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/20">
                    <form action="{{ route('tags.search') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="relative flex-grow">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="query" placeholder="Cari tag terkait kelautan..."
                                class="w-full pl-12 pr-4 py-4 rounded-xl bg-white/80 backdrop-blur-sm border border-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-lg"
                                value="{{ request('query') }}">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white px-8 py-4 rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg flex items-center justify-center md:w-auto w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Cari</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Popular Tags Link -->
            <div class="mb-8 max-w-4xl mx-auto flex justify-center">
                <a href="{{ route('tags.cloud') }}" class="group flex items-center text-blue-600 hover:text-blue-800 bg-white/70 backdrop-blur-sm px-6 py-3 rounded-full border border-blue-100 hover:bg-white transition-all duration-300 shadow-sm hover:shadow-md">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                    <span class="font-medium">Lihat Visualisasi Awan Tag</span>
                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl relative mb-6 max-w-4xl mx-auto" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <span class="sr-only">Tutup</span>
                    <svg class="h-5 w-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if($isAdmin)
            <!-- Admin Tags Table with Enhanced Styling -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-xl border border-white/20 mb-12">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-50 to-cyan-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 uppercase tracking-wider">Slug</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 uppercase tracking-wider">Artikel</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 uppercase tracking-wider">Dibuat</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-blue-600 uppercase tracking-wider">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/50 backdrop-blur-sm divide-y divide-gray-200">
                            @forelse($tags as $tag)
                                <tr class="hover:bg-blue-50/50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $tag->tag_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ $tag->nama_tag }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tag->slug }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $tag->articles_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $tag->created_at ? $tag->created_at->format('d M Y') : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex items-center">
                                        <a href="{{ route('admin.tags.edit', $tag->tag_id) }}" class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('tags.show', $tag->slug) }}" class="text-cyan-600 hover:text-cyan-900 bg-cyan-100 hover:bg-cyan-200 p-2 rounded-lg transition-colors" target="_blank">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.tags.destroy', $tag->tag_id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-lg transition-colors" onclick="return confirm('Apakah Anda yakin ingin menghapus tag ini? Tindakan ini akan menghapus tag dari semua artikel.')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-lg">Tidak ada tag ditemukan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Regular User Tag Grid with Ocean Theme -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($tags as $tag)
                    <div class="bg-gradient-to-br from-white/80 to-blue-50/80 backdrop-blur-sm rounded-2xl shadow-md hover:shadow-xl border border-white/50 overflow-hidden transition-all duration-300 transform hover:-translate-y-2 group animate-on-scroll">
                        <div class="relative h-20 bg-gradient-to-r from-blue-500 to-cyan-500 overflow-hidden">
                            <!-- Wave Pattern Overlay -->
                            <div class="absolute inset-0 bg-cover opacity-30" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxOHB4IiB2aWV3Qm94PSIwIDAgMTI4MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iI2ZmZmZmZiI+PHBhdGggZD0iTTEyODAgMy40QzEwNTAuNTkgMTggMTAxOS40IDg0Ljg5IDczNC40MiA4NC44OWMtMzIwIDAtMzIwLTg0LjMtNjQwLTg0LjNDNTkuNC41OSAyOC4yIDEuNiAwIDMuNFYxNDBoMTI4MHoiIGZpbGwtb3BhY2l0eT0iLjMiLz48cGF0aCBkPSJNMCAyNC4zMWM0My40Ni01LjY5IDk0LjU2LTkuMjUgMTU4LjQyLTkuMjUgMzIwIDAgMzIwIDg5LjI0IDY0MCA4OS4yNCAyNTYuMTMgMCAzMDcuMjgtNTcuMTYgNDgxLjU4LTgwVjE0MEgweiIgZmlsbC1vcGFjaXR5PSIuNSIvPjxwYXRoIGQ9Ik0xMjgwIDUxLjc2Yy0yMDEgMTIuNDktMjQyLjQzIDUzLjQtNTEzLjU4IDUzLjQtMzIwIDAtMzIwLTU3LTY0MC01Ny00OC44NS4wMS05MC4yMSAxLjM1LTEyNi40MiAzLjZWMTQwaDEyODB6Ii8+PC9nPjwvc3ZnPg==');background-size: 100% 100%"></div>

                            <!-- Tag Count Badge -->
                            <div class="absolute top-3 right-3">
                                <span class="bg-white/80 backdrop-blur-sm text-blue-600 text-xs font-bold px-3 py-1 rounded-full flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $tag->articles_count }} {{ $tag->articles_count > 1 ? 'artikel' : 'artikel' }}
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <a href="{{ route('tags.show', $tag->slug) }}" class="block">
                                <h3 class="text-xl font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">{{ $tag->nama_tag }}</h3>

                                @if($tag->deskripsi)
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $tag->deskripsi }}</p>
                                @else
                                    <p class="text-gray-500 text-sm italic mb-4">Tidak ada deskripsi</p>
                                @endif
                            </a>

                            @auth
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    @if(Auth::user()->tags->contains($tag->tag_id))
                                        <form action="{{ route('tags.unfollow', $tag->slug) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-sm text-blue-600 hover:text-blue-800 flex items-center group bg-blue-50 w-full py-2 px-3 rounded-lg justify-center transition-colors hover:bg-blue-100">
                                                <svg class="w-4 h-4 mr-2 text-blue-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"></path>
                                                </svg>
                                                <span class="font-medium">Berhenti Mengikuti</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('tags.follow', $tag->slug) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-sm text-blue-600 hover:text-blue-800 flex items-center group bg-blue-50 w-full py-2 px-3 rounded-lg justify-center transition-colors hover:bg-blue-100">
                                                <svg class="w-4 h-4 mr-2 text-blue-500 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                                </svg>
                                                <span class="font-medium">Ikuti Tag</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Enhanced Pagination -->
        <div class="mt-12">
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-4 shadow-md">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Enhanced Ocean Wave Animations */
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

    /* Enhanced Floating Particles */
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

    /* Deep Sea Bubbles */
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

    /* Wave Overlay Animations */
    /* Improved Wave Overlay Animations with smoother edges and better transparency */
.wave-overlay-1 {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath d='M0,160L48,170.7C96,181,192,203,288,202.7C384,203,480,181,576,160C672,139,768,117,864,122.7C960,128,1056,160,1152,176C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z' fill='%23ffffff' fill-opacity='0.08'%3E%3C/path%3E%3C/svg%3E");
    background-size: 100% 100%;
    background-position: bottom center;
    animation: wave-animation1 25s linear infinite alternate;
    pointer-events: none;
    z-index: 1;
}

.wave-overlay-2 {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60%;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath d='M0,192L30,208C60,224,120,256,180,261.3C240,267,300,245,360,213.3C420,181,480,139,540,149.3C600,160,660,224,720,250.7C780,277,840,267,900,234.7C960,203,1020,149,1080,133.3C1140,117,1200,139,1260,154.7C1320,171,1380,181,1410,186.7L1440,192L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z' fill='%23ffffff' fill-opacity='0.12'%3E%3C/path%3E%3C/svg%3E");
    background-size: 100% 100%;
    background-position: bottom center;
    animation: wave-animation2 20s linear infinite alternate-reverse;
    pointer-events: none;
    z-index: 2;
}

.wave-overlay-3 {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 40%;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320' preserveAspectRatio='none'%3E%3Cpath d='M0,256L48,261.3C96,267,192,277,288,266.7C384,256,480,224,576,218.7C672,213,768,235,864,245.3C960,256,1056,256,1152,234.7C1248,213,1344,171,1392,149.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z' fill='%23ffffff' fill-opacity='0.15'%3E%3C/path%3E%3C/svg%3E");
    background-size: 100% 100%;
    background-position: bottom center;
    animation: wave-animation3 15s linear infinite alternate;
    pointer-events: none;
    z-index: 3;
}

@keyframes wave-animation1 {
    0% { transform: translateX(0) scale(1.05); }
    100% { transform: translateX(-3%) scale(1.05); }
}

@keyframes wave-animation2 {
    0% { transform: translateX(0) scale(1.02); }
    100% { transform: translateX(3%) scale(1.02); }
}

@keyframes wave-animation3 {
    0% { transform: translateX(0) scale(1.03); }
    100% { transform: translateX(-2%) scale(1.03); }
}

    /* Enhanced Gradient Text */
    .gradient-text-enhanced {
        background: linear-gradient(135deg, #10b981, #06b6d4, #3b82f6, #8b5cf6);
        background-size: 400% 400%;
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        animation: gradientShift 8s ease-in-out infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    /* Animation Classes */
    .text-reveal {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 1s ease-out forwards;
    }

    .text-reveal-delay-1 {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 1s ease-out 0.3s forwards;
    }

    .text-reveal-delay-2 {
        opacity: 0;
        transform: translateY(20px);
        animation: textReveal 1s ease-out 0.6s forwards;
    }

    @keyframes textReveal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .animate-on-scroll.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* Card hover effect */
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

    /* Enhanced Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        gap: 0.5rem;
    }

    .pagination li {
        display: inline-flex;
    }

    .pagination li > * {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .pagination li > *:not(.text-gray-500) {
        background-color: white;
        color: #3b82f6;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .pagination li > *:hover:not(.text-gray-500) {
        background-color: #eff6ff;
        color: #2563eb;
    }

    .pagination .active > * {
        background-color: #3b82f6 !important;
        color: white !important;
        font-weight: 600;
    }

    .pagination li span[aria-disabled="true"] {
        color: #9ca3af;
        background-color: #f3f4f6;
        cursor: not-allowed;
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animated elements on scroll
    const animatedElements = document.querySelectorAll('.animate-on-scroll');

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach(el => {
        observer.observe(el);
    });

    // Initialize Select2 for tag selects if Select2 is available
    if (typeof $ !== 'undefined' && $.fn.select2) {
        $('#source_tag_id, #target_tag_id').select2({
            placeholder: "Pilih tag",
            allowClear: true,
            width: '100%'
        });

        // Prevent selecting the same tag for source and target
        $('#source_tag_id, #target_tag_id').on('change', function() {
            const sourceVal = $('#source_tag_id').val();
            const targetVal = $('#target_tag_id').val();

            if (sourceVal && targetVal && sourceVal === targetVal) {
                alert('Tag sumber dan target tidak boleh sama');
                $(this).val('').trigger('change');
            }
        });
    }
});
</script>
@endsection
