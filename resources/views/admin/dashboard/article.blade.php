@extends('layouts.admin')

@section('title', 'My Articles')

@section('content')
<div class="bg-gradient-to-r from-sky-300 to-blue-400 min-h-screen py-8 relative">
   <div class="absolute inset-0 bg-gradient-to-r from-sky-800 to-cyan-600 opacity-80 z-0"></div>
    <div class="container mx-auto px-4">
            
        <div class="relative bg-gradient-to-r from-blue-600/90 to-sky-500/90 backdrop-blur-sm shadow-lg rounded-2xl p-6 mb-8 overflow-hidden border-t-4 border-blue-200">
            <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-1">Artikel Saya</h1>
                    <p class="text-cyan-100 font-medium">Atur dan kelola artikel Anda</p>
                </div>
                <a href="{{ route('articles.create') }}" class="bg-white/20 hover:bg-white/30 text-white py-2 px-6 rounded-lg font-medium flex items-center transition-all duration-300 transform hover:scale-105 shadow-md backdrop-blur-sm border border-white/20">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Buat Artikel Baru
                </a>
            </div>
            <div class="absolute -bottom-16 left-0 right-0 h-24 bg-blue-400/30 animate-wave opacity-60"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/30 animate-wave-slow opacity-40 delay-150"></div>

              <div class="absolute -bottom-16 left-0 right-0 h-24 bg-cyan-400/40 animate-wave opacity-70"></div>
            <div class="absolute -bottom-10 left-0 right-0 h-24 bg-blue-500/40 animate-wave-slow opacity-50 delay-150"></div>

            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
            </div>
        </div>
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md transform transition-all duration-500 animate-fade-in-down" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md transform transition-all duration-500 animate-fade-in-down" role="alert">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
        @endif

      <div class="rounded-2xl bg-gradient-to-b from-blue-100 to-blue-200 backdrop-blur-sm shadow-md p-5 mb-6 border-l-4 border-blue-100 animate-fade-in-up">
    <form action="{{ route('admin.dashboard.article') }}" method="GET" class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center">
            <div class="p-2 mr-3 rounded-lg bg-gradient-to-r from-teal-500 to-blue-600 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
            </div>
            <select name="category_filter" class="bg-gray-50 border w-full pl-6 pr-3 py-1.5 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 transition-all duration-300">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category_id }}" {{ request('category_filter') == $category->category_id ? 'selected' : '' }}>
                        {{ $category->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex items-center">
            <div class="p-2 mr-3 rounded-lg bg-gradient-to-r from-blue-500 to-teal-600 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                </svg>
            </div>
            <select name="status" class="bg-gray-50 W-full pl-8 pr-3 py-1.5 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 transition-all duration-300">
                <option value="">Semua Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>DiPublikasikan</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Ditunda</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>DiTolak</option>
            </select>
        </div>
        <div class="relative flex-grow md:max-w-xs">
            <div class="flex">
                <div class="relative flex-grow">
                    <input type="search" name="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-8 pr-3 py-1.5" placeholder="Cari Artikel.." value="{{ request('search') }}">
                </div>
                <button type="submit" class="flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-r-lg px-3 transition-all duration-200 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
        <!-- Articles Table -->
        @if ($articles->count() > 0)
            <div class=" bg-gradient-to-b from-sky-100 to-blue-100 backdrop-blur-sm shadow-lg rounded-2xl overflow-hidden border-t-4 border-blue-100 relative">
                <div class="overflow-x-auto relative z-10">
                    <table class="min-w-full divide-y divide-gray-200">
                       <thead class="bg-gradient-to-t from-sky-100 to-blue-50 border-b border-gray-300">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Judul</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kategori</th>
                                  <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-white uppercase tracking-wider">Status</th>
                                 <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
                                 <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Method</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($articles as $article)
                                <tr class="hover:bg-blue-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($article->gambar)
                                                <div class="flex-shrink-0 h-12 w-12">
                                                    <img class="h-12 w-12 rounded-lg object-cover shadow-md border-2 border-blue-100" src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}">
                                                </div>
                                            @else
                                                <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-gradient-to-br from-blue-400 to-teal-400 flex items-center justify-center shadow-md">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900 hover:text-blue-600 transition-colors duration-300">
                                                    {{ $article->judul }}
                                                </div>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        {{ random_int(10, 500) }} views
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $article->category->nama_kategori }}
                                        </span>
                                    </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($article->status === 'published')
                                        <div class="flex justify-center">
                                            <span class="px-4 py-1.5 inline-flex items-center justify-center text-sm leading-5 font-medium rounded-full bg-gradient-to-r from-green-50 to-green-100 text-green-800 border border-green-200 shadow-sm hover:shadow-md transition-all duration-200 min-w-[120px]">
                                                <span class="w-3 h-3 bg-green-500 rounded-full mr-2 animate-pulse shadow-sm"></span>
                                                Dipublikasikan
                                            </span>
                                        </div>
                                    @elseif($article->status === 'pending')
                                        <div class="flex justify-center">
                                            <span class="px-4 py-1.5 inline-flex items-center justify-center text-sm leading-5 font-medium rounded-full bg-gradient-to-r from-yellow-50 to-yellow-100 text-yellow-800 border border-yellow-200 shadow-sm hover:shadow-md transition-all duration-200 min-w-[120px]">
                                                <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2 animate-pulse shadow-sm"></span>
                                                Ulasan Pending
                                            </span>
                                        </div>
                                    @elseif($article->status === 'rejected')
                                        <div class="flex justify-center">
                                            <span class="px-4 py-1.5 inline-flex items-center justify-center text-sm leading-5 font-medium rounded-full bg-gradient-to-r from-red-50 to-red-100 text-red-800 border border-red-200 shadow-sm hover:shadow-md transition-all duration-200 min-w-[120px]">
                                                <span class="w-3 h-3 bg-red-500 rounded-full mr-2 shadow-sm"></span>
                                                Ditolak
                                            </span>
                                        </div>
                                    @else
                                        <div class="flex justify-center">
                                            <span class="px-4 py-1.5 inline-flex items-center justify-center text-sm leading-5 font-medium rounded-full bg-gradient-to-r from-gray-50 to-gray-100 text-gray-800 border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 min-w-[120px]">
                                                <span class="w-3 h-3 bg-gray-500 rounded-full mr-2 shadow-sm"></span>
                                                Draft
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex flex-col">
                                            <span>{{ $article->tgl_upload->format('M d, Y') }}</span>
                                            <span class="text-xs text-gray-400">{{ $article->tgl_upload->format('h:i A') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            <a href="{{ route('articles.show', $article) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-100 hover:bg-indigo-200 p-2 rounded-lg transition-all duration-200" title="View">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            <a href="{{ route('articles.edit', $article) }}" class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-lg transition-all duration-200" title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-lg transition-all duration-200" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this article?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
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
    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-12 shadow-lg text-center border-t-4 border-blue-500 animate-fade-in-up">
        <div class="text-8xl text-blue-500/30 mb-6 animate-float">
            @if(request('search') || request('category_filter') || request('status'))
                <svg class="inline-block" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 120px; height: 120px;">
                    <path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path>
                </svg>
            @else
                <svg class="inline-block" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="width: 120px; height: 120px;">
                    <path d="M19.5 3h-15A2.5 2.5 0 002 5.5v13A2.5 2.5 0 004.5 21h15a2.5 2.5 0 002.5-2.5v-13A2.5 2.5 0 0019.5 3zm-9 3h3a.5.5 0 010 1h-3a.5.5 0 010-1zm0 3h3a.5.5 0 010 1h-3a.5.5 0 010-1zm0 3h6a.5.5 0 010 1h-6a.5.5 0 010-1zm0 3h6a.5.5 0 010 1h-6a.5.5 0 010-1zm-4-8a2 2 0 100 4 2 2 0 000-4z"></path>
                </svg>
            @endif
        </div>

        @if(request('search') || request('category_filter') || request('status'))
            <h2 class="text-2xl font-bold text-blue-800 mb-3">Tidak Ada Artikel Ditemukan</h2>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">
                Tidak ada artikel yang cocok dengan kriteria pencarian Anda. Coba ubah filter atau istilah pencarian.
            </p>

            <div class="flex flex-wrap justify-center gap-3 mb-6">
                @if(request('search'))
                    <div class="bg-blue-50 text-blue-800 rounded-full px-4 py-2 text-sm flex items-center">
                        <span class="mr-2">Pencarian:</span>
                        <span class="font-medium">{{ request('search') }}</span>
                    </div>
                @endif

                @if(request('category_filter'))
                    <div class="bg-green-50 text-green-800 rounded-full px-4 py-2 text-sm flex items-center">
                        <span class="mr-2">Kategori:</span>
                        <span class="font-medium">
                            @foreach($categories as $category)
                                @if($category->category_id == request('category_filter'))
                                    {{ $category->nama_kategori }}
                                @endif
                            @endforeach
                        </span>
                    </div>
                @endif

                @if(request('status'))
                    <div class="bg-purple-50 text-cyan-600 rounded-full px-4 py-2 text-sm flex items-center">
                        <span class="mr-2">Status:</span>
                        <span class="font-medium">
                            @if(request('status') == 'published')
                                Dipublikasikan
                            @elseif(request('status') == 'pending')
                                Ditunda
                            @elseif(request('status') == 'rejected')
                                Ditolak
                            @endif
                        </span>
                    </div>
                @endif
            </div>

            <a href="{{ route('admin.dashboard.article') }}" class="inline-block bg-gradient-to-b from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 text-white px-8 py-3 rounded-lg font-medium transition duration-300 shadow-lg transform hover:-translate-y-1">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Reset Pencarian
                </div>
            </a>
        @else
            <h2 class="text-2xl font-bold text-gray-800 mb-3">Belum Ada Artikel</h2>
            <p class="text-gray-600 mb-6 max-w-md mx-auto">Anda belum membuat artikel. Mulailah berbagi pengetahuan Anda dengan komunitas!</p>
            <a href="{{ route('articles.create') }}" class="inline-block bg-gradient-to-r from-blue-600 to-teal-600 hover:from-blue-700 hover:to-teal-700 text-white px-8 py-3 rounded-lg font-medium transition duration-300 shadow-lg transform hover:-translate-y-1">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Buat Artikel Pertama Anda
                </div>
            </a>
        @endif
    </div>
@endif
        <!-- Article Status Guide -->
        <div class="mt-8 rounded-2xl bg-gradient-to-t from-sky-100 to-blue-100 backdrop-blur-sm p-6  shadow-lg border-t-4 border-teal-500 relative overflow-hidden animate-fade-in-up">
            <div class="relative z-10">
                <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-teal-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Artikel Status Petunjuk
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg border border-green-200 hover:bg-green-100 transition-all duration-300 transform hover:scale-105">
                        <span class="w-4 h-4 rounded-full bg-green-400 border border-green-600 flex-shrink-0"></span>
                        <span class="text-sm text-gray-700"><strong>Published:</strong> Artikel anda telah terpublikasi.</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-lg border border-yellow-200 hover:bg-yellow-100 transition-all duration-300 transform hover:scale-105">
                        <span class="w-4 h-4 rounded-full bg-yellow-400 border border-yellow-600 flex-shrink-0"></span>
                        <span class="text-sm text-gray-700"><strong>Pending Review:</strong> Artikel Anda Sedang dalam persetujan.</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-red-50 rounded-lg border border-red-200 hover:bg-red-100 transition-all duration-300 transform hover:scale-105">
                        <span class="w-4 h-4 rounded-full bg-red-400 border border-red-600 flex-shrink-0"></span>
                        <span class="text-sm text-gray-700"><strong>Rejected:</strong> Artikel Anda Perlu direvisi</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                        <span class="w-4 h-4 rounded-full bg-gray-400 border border-gray-600 flex-shrink-0"></span>
                        <span class="text-sm text-gray-700"><strong>Draft:</strong>Artikel Anda masih dalam keadaan draft.</span>
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
    background-size: 200% 200%;
    animation: shimmer 10s infinite ease-in-out;
    pointer-events: none;
    z-index: 2;
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
</style>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add shimmer effect to the background
        const bgElement = document.querySelector('.bg-gradient-to-r.min-h-screen');
        bgElement.classList.add('animate-shimmer');

        // Add wave animation to the header section
        const headerWave = document.querySelector('.absolute.inset-0.bg-gradient-to-r.from-sky-300.to-blue-400');
        headerWave.classList.add('animate-wave');


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

            bubble.className = 'admin-bubble';
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.bottom = '-100px'; // Start from bottom
            bubble.style.animationDuration = `${duration}s`;
            bubble.style.animationDelay = `${delay}s`;

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

