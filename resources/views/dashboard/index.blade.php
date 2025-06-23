@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-cyan-50 via-blue-50 to-teal-50 relative overflow-hidden">
    <!-- Animasi Latar Belakang Laut -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-cyan-500/20 via-blue-600/20 to-teal-700/30"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-30"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="ocean-bubbles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <div class="bg-gradient-to-br from-blue-500 via-blue-900 to-teal-900 text-white py-10 relative z-10">
        <div class="container mx-auto px-4 relative">
            <h1 class="text-3xl font-bold mb-2">Dashboard</h1>
            @if(Auth::check())
                <p class="mt-2">Selamat datang kembali, {{ Auth::user()->name }}!</p>
            @endif

            <div class="absolute inset-0 z-0 overflow-hidden">
                <div class="deep-sea-bubbles opacity-20"></div>
                <div class="marine-light-rays"></div>
                <div class="floating-particles absolute inset-0"></div>
            </div>
        </div>
    </div>

    <div class="bg-blue-100 shadow-md relative z-10">
        <div class="container mx-auto">
            <ul class="flex flex-wrap -mb-px text-lg font-medium text-center">
                <li class="mr-2">
                    <a href="{{ route('user.dashboard') }}" class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active">
                        <i class="fas fa-home mr-2"></i> Beranda
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.articles') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-newspaper mr-2"></i> Artikel Saya
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.communities') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-users mr-2"></i> Komunitas
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('user.profile') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                        <i class="fas fa-user mr-2"></i> Profil
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 relative z-10">
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/90 to-emerald-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 notification-toast">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('success') }}</div>
                    <button type="button" class="text-white hover:text-white/80 close-notification">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-500/90 to-rose-600/90 text-white rounded-xl shadow-lg backdrop-blur-sm mb-6 notification-toast">
                <div class="flex items-center p-4">
                    <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">{{ session('error') }}</div>
                    <button type="button" class="text-white hover:text-white/80 close-notification">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        @if(Auth::check())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 fade-in-up animate-on-scroll">
                <div class="bg-gradient-to-br from-white/90 to-blue-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-blue-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-blue-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-blue-500/5 rounded-full -mb-8 -ml-8"></div>

                    <div class="relative p-6 z-10">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-gradient-to-r from-blue-100 to-blue-200 text-blue-600 mr-4 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Artikel Saya</p>
                                <h4 class="text-2xl font-bold text-gray-800">{{ Auth::user()->articles->count() }}</h4>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('user.articles') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center group">
                                <span>Lihat semua artikel</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white/90 to-green-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-green-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-green-500/5 rounded-full -mb-8 -ml-8"></div>

                    <div class="relative p-6 z-10">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-600 mr-4 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Komentar</p>
                                <h4 class="text-2xl font-bold text-gray-800">{{ Auth::user()->comments->count() }}</h4>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-green-600 hover:text-green-800 text-sm font-medium flex items-center group">
                                <span>Lihat aktivitas saya</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white/90 to-purple-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-purple-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-purple-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-purple-500/5 rounded-full -mb-8 -ml-8"></div>

                    <div class="relative p-6 z-10">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-gradient-to-r from-purple-100 to-purple-200 text-purple-600 mr-4 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Komunitas</p>
                                <h4 class="text-2xl font-bold text-gray-800">{{ isset($communities) ? $communities->count() : 0 }}</h4>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('user.communities') }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium flex items-center group">
                                <span>Lihat komunitas</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-white/90 to-red-50/90 backdrop-blur-sm rounded-xl shadow-md border-l-4 border-red-500 overflow-hidden relative group transform transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-red-500/10 rounded-full -mt-10 -mr-10 group-hover:scale-125 transition-all duration-500"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-red-500/5 rounded-full -mb-8 -ml-8"></div>

                    <div class="relative p-6 z-10">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-600 mr-4 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Reaksi Diterima</p>
                                <h4 class="text-2xl font-bold text-gray-800">{{ isset($reactionsCount) ? $reactionsCount : 0 }}</h4>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('user.profile') }}" class="text-red-600 hover:text-red-800 text-sm font-medium flex items-center group">
                                <span>Lihat profil</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <span>Artikel Terbaru</span>
                            </h2>
                            <a href="{{ route('user.articles') }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                <span>Lihat Semua</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        @if(isset($articles) && count($articles) > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gradient-to-r from-blue-50 to-cyan-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aktivitas</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($articles as $article)
                                            <tr class="hover:bg-blue-50/50 transition-colors">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="{{ route('articles.show', $article) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                                        {{ Str::limit($article->judul, 40) }}
                                                    </a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        bg-{{ $article->getStatusColor() }}-100 text-{{ $article->getStatusColor() }}-800">
                                                        {{ ucfirst($article->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {{ App\Helpers\IndonesiaTimeHelper::formatDate($article->tgl_upload)}}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    <div class="flex space-x-3">
                                                        <span class="flex items-center" title="Komentar">
                                                            <svg class="w-4 h-4 text-gray-400 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            {{ $article->comments_count ?? 0 }}
                                                        </span>
                                                        <span class="flex items-center" title="Reaksi">
                                                            <svg class="w-4 h-4 text-gray-400 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            {{ $article->reactions_count ?? 0 }}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 flex justify-center">
                                <a href="{{ route('articles.create') }}" class="inline-flex items-center bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 shadow-lg transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Buat Artikel Baru
                                </a>
                            </div>
                        @else
                            <div class="text-center py-10 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                                <svg class="mx-auto h-12 w-12 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada artikel</h3>
                                <p class="mt-1 text-base text-gray-500">Mulai berbagi pengetahuan Anda dengan komunitas.</p>
                                <div class="mt-6">
                                    <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to- from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700  transition-all duration-300 transform hover:-translate-y-1">
                                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Buat Artikel Pertama
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-up animate-on-scroll" style="animation-delay: 0.2s">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Aktivitas Terkini</span>
                        </h2>

                        @if(isset($recentActivity) && count($recentActivity) > 0)
                            <div class="flow-root">
                                <ul role="list" class="-mb-8">
                                    @foreach($recentActivity as $activity)
                                        <li class="fade-in-left animate-on-scroll" style="animation-delay: {{ 0.2 + $loop->index * 0.1 }}s">
                                            <div class="relative pb-8">
                                                @if(!$loop->last)
                                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gradient-to-b from-blue-200 via-cyan-200 to-transparent" aria-hidden="true"></span>
                                                @endif
                                                <div class="relative flex space-x-3">
                                                    <div>
                                                        <span class="h-8 w-8 rounded-full flex items-center justify-center {{ $activity['bg_color'] }} shadow-inner">
                                                            <svg class="h-5 w-5 {{ $activity['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity['icon'] }}"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                        <div>
                                                            <p class="text-sm text-gray-700">{!! $activity['description'] !!}</p>
                                                        </div>
                                                        <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                            <time>{{ App\Helpers\IndonesiaTimeHelper::diffForHumans($activity['time'] )}}</time>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="text-center py-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                                <p class="text-gray-600">Tidak ada aktivitas terkini.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-right animate-on-scroll">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-4 relative">
                                <div class="w-16 h-16 rounded-full ocean-profile-border overflow-hidden">
                                    <img class="w-full h-full object-cover"
                                        src="{{ Auth::user()->getProfilePhotoUrlAttribute() }}"
                                        alt="{{ Auth::user()->name }}">
                                </div>
                                <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full w-4 h-4 border-2 border-white pulse-dot"></div>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-600">Bergabung sejak {{ App\Helpers\IndonesiaTimeHelper::formatDate(Auth::user()->created_at)}}</p>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-gray-100 pt-4 flex space-x-3">
                            <a href="{{ route('user.profile') }}" class="flex-1 bg-white border border-gray-300 rounded-lg py-2 px-4 text-sm font-medium text-gray-700 hover:bg-gray-50 text-center transition-colors">
                                Lihat Profil
                            </a>
                            <a href="{{ route('user.edit-profile') }}" class="flex-1 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 border border-transparent rounded-lg py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 text-center transition-all duration-300 shadow-md transform hover:-translate-y-0.5">
                                Edit Profil
                            </a>
                        </div>
                    </div>

                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-right animate-on-scroll" style="animation-delay: 0.2s">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-gray-800 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span>Komunitas Saya</span>
                            </h3>
                            <a href="{{ route('user.communities') }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                <span>Lihat Semua</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        @if(isset($communities) && count($communities) > 0)
                            <div class="space-y-4">
                                @foreach($communities as $community)
                                   <div class="flex items-center bg-gradient-to-r from-blue-50 to-cyan-50 p-3 rounded-xl hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5">
               <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 mr-3">
                @if($community->gambar)
            <img src="{{ asset('storage/' . $community->gambar) }}"
                 class="w-full h-full object-cover"
                 alt="{{ $community->nama_komunitas }}">
        @else
            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-cyan-500 flex items-center justify-center text-white font-medium shadow-sm">
                {{ strtoupper(substr($community->nama_komunitas, 0, 2)) }}
            </div>
        @endif
    </div>
    <div class="flex-1 min-w-0">
        <p class="text-sm font-medium text-gray-800 truncate">
            {{ $community->nama_komunitas }}
        </p>
        <p class="text-xs text-gray-500">
            {{ $community->users_count ?? 0 }} anggota
        </p>
    </div>
    <a href="{{ route('communities.show', $community) }}" class="ml-2 inline-flex items-center px-2.5 py-1 border border-transparent text-xs font-medium rounded-lg text-cyan-700 bg-cyan-100 hover:bg-cyan-200 transition-colors">
        Kunjungi
    </a>
           </div>
                                @endforeach
                            </div>

                            <div class="mt-4 text-center">
                                <a href="{{ route('communities.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                                    <span>Temukan komunitas lainnya</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @else
                            <div class="text-center py-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl">
                                <p class="text-gray-600 text-sm mb-4">Anda belum bergabung dengan komunitas apapun.</p>
                                <a href="{{ route('communities.index') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Jelajahi Komunitas
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white/90 backdrop-blur-sm rounded-xl shadow-md p-6 border border-blue-100 fade-in-right animate-on-scroll" style="animation-delay: 0.4s">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            <span>Tautan Cepat</span>
                        </h3>
                        <nav class="space-y-2">
                            <a href="{{ route('articles.create') }}" class="ocean-quick-link flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r from-blue-50 to-cyan-50 hover:text-gray-900 transition-all duration-300">
                                <svg class="mr-3 flex-shrink-0 h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Tulis Artikel Baru
                                <div class="ocean-quick-link-bubbles"></div>
                            </a>
                            <a href="{{ route('communities.index') }}" class="ocean-quick-link flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r from-blue-50 to-cyan-50 hover:text-gray-900 transition-all duration-300">
                                <svg class="mr-3 flex-shrink-0 h-5 w-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Jelajahi Komunitas
                                <div class="ocean-quick-link-bubbles"></div>
                            </a>
                            <a href="{{ route('user.change-password') }}" class="ocean-quick-link flex items-center px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gradient-to-r from-blue-50 to-cyan-50 hover:text-gray-900 transition-all duration-300">
                                <svg class="mr-3 flex-shrink-0 h-5 w-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Ubah Kata Sandi
                                <div class="ocean-quick-link-bubbles"></div>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-6 mb-6 rounded-lg" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm">Sesi Anda telah berakhir atau pengguna tidak ditemukan. Silahkan <a href="{{ route('login') }}" class="font-medium underline">masuk</a> kembali.</p>
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center py-16 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl shadow-md fade-in-up animate-on-scroll">
                <div class="w-24 h-24 bg-gradient-to-r from-blue-400 to-cyan-500 rounded-full mx-auto mb-6 flex items-center justify-center shadow-xl">
                    <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Silahkan Masuk untuk Melanjutkan</h2>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">Untuk mengakses dashboard dan fitur lengkap, silahkan masuk dengan akun Anda.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 shadow-md inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-white text-gray-800 border border-gray-300 hover:bg-gray-50 px-6 py-3 rounded-lg font-medium transition-all duration-300 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Daftar
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

@section('styles')
<style>
.ocean-waves {
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(54,187,252,0.15) 100%);
    background-size: 400% 400%;
    animation: wave 15s ease-in-out infinite;
    transform: translateZ(0);
}

.floating-particles {
    background-image:
        radial-gradient(circle at 85% 15%, rgba(255,255,255,0.15) 1px, transparent 1px),
        radial-gradient(circle at 20% 40%, rgba(255,255,255,0.1) 1.5px, transparent 1.5px),
        radial-gradient(circle at 30% 70%, rgba(255,255,255,0.2) 1px, transparent 1px),
        radial-gradient(circle at 70% 90%, rgba(255,255,255,0.1) 1.5px, transparent 1.5px),
        radial-gradient(circle at 40% 25%, rgba(255,255,255,0.15) 1px, transparent 1px);
    background-size: 300px 300px;
    animation: floatingParticles 60s linear infinite;
}

.ocean-bubbles {
    background-image:
        radial-gradient(circle at 90% 10%, rgba(255,255,255,0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 20% 50%, rgba(255,255,255,0.7) 1px, transparent 1px),
        radial-gradient(circle at 30% 80%, rgba(255,255,255,0.6) 0.8px, transparent 0.8px),
        radial-gradient(circle at 60% 30%, rgba(255,255,255,0.8) 0.5px, transparent 0.5px),
        radial-gradient(circle at 80% 60%, rgba(255,255,255,0.7) 1px, transparent 1px);
    background-size: 100px 100px;
    animation: bubbleRise 25s linear infinite;
}

.underwater-current {
    background: linear-gradient(45deg,
        rgba(0,115,209,0) 0%,
        rgba(0,115,209,0.02) 50%,
        rgba(0,115,209,0) 100%);
    background-size: 200% 200%;
    animation: underwaterCurrent 15s ease-in-out infinite;
}

.deep-sea-bubbles {
    background-image:
        radial-gradient(circle at 15% 85%, rgba(255,255,255,0.15) 4px, transparent 4px),
        radial-gradient(circle at 45% 75%, rgba(255,255,255,0.12) 5px, transparent 5px),
        radial-gradient(circle at 75% 65%, rgba(255,255,255,0.18) 3px, transparent 3px);
    background-size: 300px 300px;
    animation: deepBubbleRise 30s linear infinite;
}

.marine-light-rays {
    background: linear-gradient(45deg,
        transparent 30%,
        rgba(120, 220, 255, 0.08) 40%,
        rgba(120, 220, 255, 0.04) 50%,
        transparent 60%
    );
    background-size: 200px 200px;
    animation: lightRaysMove 15s ease-in-out infinite;
}

.ocean-profile-border {
    position: relative;
    border: 2px solid transparent;
    background: linear-gradient(to right, #38bdf8, #0ea5e9, #0284c7);
    background-clip: padding-box;
    box-shadow: 0 0 15px rgba(56, 189, 248, 0.3);
}

.ocean-profile-border::before {
    content: '';
    position: absolute;
    top: -2px;
    left: -2px;
    right: -2px;
    bottom: -2px;
    z-index: -1;
    background: linear-gradient(45deg, #38bdf8, #0ea5e9, #0284c7, #38bdf8);
    border-radius: inherit;
    animation: rotate 3s linear infinite;
}

.pulse-dot {
    animation: pulse 2s infinite;
}

.ocean-quick-link {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.ocean-quick-link:hover {
    background-color: rgba(186, 230, 253, 0.2);
    transform: translateX(4px);
}

.ocean-quick-link-bubbles {
    position: absolute;
    bottom: -5px;
    right: 10px;
    width: 20px;
    height: 20px;
    opacity: 0;
    transition: opacity 0.3s ease;
    background-image:
        radial-gradient(circle at 50% 50%, rgba(56, 189, 248, 0.4) 2px, transparent 2px),
        radial-gradient(circle at 70% 30%, rgba(56, 189, 248, 0.3) 1.5px, transparent 1.5px),
        radial-gradient(circle at 30% 40%, rgba(56, 189, 248, 0.4) 1px, transparent 1px);
    animation: quickLinkBubbleRise 3s ease-in-out infinite;
}

.ocean-quick-link:hover .ocean-quick-link-bubbles {
    opacity: 1;
}

.fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in-left {
    opacity: 0;
    transform: translateX(-20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.fade-in-right {
    opacity: 0;
    transform: translateX(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.animate-on-scroll.in-view {
    opacity: 1;
    transform: translate(0);
}

@keyframes wave {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

@keyframes floatingParticles {
    0% { background-position: 0 0; }
    100% { background-position: 300px 300px; }
}

@keyframes bubbleRise {
    0% { background-position: 0 100%; }
    100% { background-position: 100px 0; }
}

@keyframes underwaterCurrent {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
}

@keyframes deepBubbleRise {
    0% { background-position: 0 100%, 0 100%, 0 100%; }
    100% { background-position: 0 -300px, 0 -300px, 0 -300px; }
}

@keyframes lightRaysMove {
    0%, 100% {
        transform: translateX(-100px) rotate(0deg);
        opacity: 0.3;
    }
    50% {
        transform: translateX(100px) rotate(15deg);
        opacity: 0.8;
    }
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulse {
    0% { transform: scale(0.95); opacity: 0.5; }
    50% { transform: scale(1.2); opacity: 1; }
    100% { transform: scale(0.95); opacity: 0.5; }
}

@keyframes quickLinkBubbleRise {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

@media (max-width: 768px) {
    .ocean-quick-link {
        padding: 0.5rem 1rem;
    }
}

.notification-toast {
    animation: fadeIn 0.3s ease-in-out, fadeOut 0.5s ease-in-out 5s forwards;
}

@keyframes fadeIn {
    0% { opacity: 0; transform: translateY(-20px); }
    100% { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-20px); }
}
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const animateOnScrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach(element => {
        animateOnScrollObserver.observe(element);
    });

    document.querySelectorAll('.close-notification').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.notification-toast').style.display = 'none';
        });
    });

    function createRandomBubbles() {
        const container = document.querySelector('.underwater-current');
        if (!container) return;

        for (let i = 0; i < 15; i++) {
            const bubble = document.createElement('div');
            bubble.classList.add('random-bubble');

            const size = Math.random() * 10 + 5;
            const left = Math.random() * 100;
            const animationDuration = Math.random() * 15 + 10;
            const delay = Math.random() * 15;

            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${left}%`;
            bubble.style.animationDuration = `${animationDuration}s`;
            bubble.style.animationDelay = `${delay}s`;

            container.appendChild(bubble);
        }
    }

    createRandomBubbles();

    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            document.querySelector('.mobile-submenu').classList.toggle('hidden');
        });
    }
});
</script>
@endsection
