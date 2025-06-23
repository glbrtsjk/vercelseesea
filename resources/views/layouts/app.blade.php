<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Knowledge Platform') | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/typography@0.4.0/dist/typography.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  -->
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex flex-wrap items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center flex-shrink-0 mr-6">
                <span class="font-bold text-xl ml-2 text-blue-600">SeeSea</span>
            </a>

            <!-- Mobile menu button -->
            <div class="block lg:hidden">
                <button id="mobile-menu-button" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-500 hover:text-blue-600 hover:border-blue-600">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div id="navigation-menu" class="hidden w-full flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="text-sm lg:flex-grow">
                    <a href="{{ route('home') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-blue-600 mr-6 {{ request()->routeIs('home') ? 'font-semibold text-blue-600' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('articles.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-blue-600 mr-6 {{ request()->routeIs('articles.*') ? 'font-semibold text-blue-600' : '' }}">
                        Artikel
                    </a>
                    <a href="{{ route('communities.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-blue-600 mr-6 {{ request()->routeIs('communities.*') ? 'font-semibold text-blue-600' : '' }}">
                        Komunitas
                    </a>
                    <a href="{{ route('funfacts.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-blue-600 mr-6 {{ request()->routeIs('tags.*') ? 'font-semibold text-blue-600' : '' }}">
                        Funfact
                    </a>
                      <a href="{{ route('tags.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-blue-600 mr-6 {{ request()->routeIs('tags.*') ? 'font-semibold text-blue-600' : '' }}">
                        Tag
                    </a>
                </div>


                <div class="relative mx-4 hidden lg:block lg:w-64">
                    <form action="{{ route('articles.search') }}" method="GET">
                        <input type="text" name="query" placeholder="Cari Artikel..." class="w-full px-4 py-2 pr-8 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
                        <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- User Menu -->
                <div class="flex items-center">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-gray-700 hover:text-blue-600 focus:outline-none">
                                <img src="{{ Auth::user()->foto_profil ? asset('storage/' . Auth::user()->foto_profil) : asset('images/default-avatar.png') }}" alt="{{ Auth::user()->name }}" class="h-8 w-8 rounded-full mr-2 object-cover">
                                <span class="hidden md:inline-block">{{ Auth::user()->name }}</span>
                                <svg class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Admin Dashboard
                                    </a>
                                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profil Saya
                                </a>
                                <a href="{{ route('admin.dashboard.article') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Artikel Saya
                                </a>
                                <a href="{{ route('admin.dashboard.community') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                   Komunitas Saya
                                </a>
                                 @else
                                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Dashboard
                                    </a>
                                     <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Profil Saya
                                </a>
                                <a href="{{ route('user.articles') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Artikel Saya
                                </a>
                                <a href="{{ route('user.communities') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                   Komunitas Saya
                                </a>
                                @endif
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-blue-600 border-blue-600 hover:border-transparent hover:text-white hover:bg-blue-600 mr-2">Login</a>
                        <a href="{{ route('register') }}" class="inline-block text-sm px-4 py-2 leading-none rounded text-white bg-blue-600 hover:bg-blue-700">Register</a>
                    @endauth

                </div>
            </div>
        </nav>

        <!-- Mobile Search (only visible on mobile) -->
        <div class="lg:hidden px-4 pb-4">
            <form action="{{ route('articles.search') }}" method="GET" class="mt-2">
                <div class="relative">
                    <input type="text" name="query" placeholder="Search articles..." class="w-full px-4 py-2 pr-8 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
                    <button type="submit" class="absolute right-0 top-0 mt-2 mr-3 text-gray-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white py-12 relative overflow-hidden ">
        <div class="absolute inset-0 z-0">
            <div class="deep-sea-bubbles absolute inset-0 opacity-5"></div>
            <div class="ocean-current absolute inset-0 opacity-5"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <h3 class="text-xl font-bold mb-6 text-cyan-400">Tentang SEESEA</h3>
                    <p class="text-gray-400 mb-6 leading-relaxed">Didedikasikan untuk berbagi pengetahuan tentang ekosistem laut, konservasi kehidupan laut, dan mempromosikan praktik berkelanjutan untuk lautan kita.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.195A4.92 4.92 0 0016.77 2.5a4.923 4.923 0 00-4.923 4.923c0 .386.043.76.126 1.12A13.986 13.986 0 013.401 3.114a4.892 4.892 0 00-.667 2.476 4.92 4.92 0 002.19 4.098A4.902 4.902 0 012.5 9.13v.062a4.924 4.924 0 003.95 4.828 4.996 4.996 0 01-2.225.084 4.93 4.93 0 004.6 3.419A9.87 9.87 0 012 19.54a13.934 13.934 0 007.548 2.206c9.054 0 14-7.496 14-13.99 0-.21-.004-.42-.012-.63a10 10 0 002.417-2.556z"/></svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6 text-cyan-400">Link Cepat</h3>
                    <ul class="space-y-4">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-white transition-colors">Jelajahi Artikel</a></li>
                        <li><a href="{{ route('funfacts.index') }}" class="text-gray-400 hover:text-white transition-colors">Fakta Laut</a></li>
                        @auth
                            @if(auth()->user()->is_admin == true || auth()->user()->role == 'admin')
                                <li><a href="{{ route('admin.edit-profile') }}" class="text-gray-400 hover:text-white transition-colors">Profil Saya</a></li>
                            @else
                                <li><a href="{{ route('user.edit-profile') }}" class="text-gray-400 hover:text-white transition-colors">Profil Saya</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white transition-colors">Masuk</a></li>
                            <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">Daftar</a></li>
                        @endauth
                    </ul>
                </div>

               <div>
    <h3 class="text-xl font-bold mb-6 text-cyan-400">Kategori Laut</h3>
    <ul class="space-y-4">
        @if(isset($categories) && $categories->count() > 0)
            @foreach($categories->take(6) as $category)
                <li><a href="{{ route('articles.index', ['category' => $category->category_id]) }}" class="text-gray-400 hover:text-white transition-colors">{{ $category->nama_kategori }}</a></li>
            @endforeach
        @else
            <li><span class="text-gray-400">Kategori tidak tersedia</span></li>
        @endif
    </ul>
</div>

                <div>
                    <h3 class="text-xl font-bold mb-6 text-cyan-400">Informasi Kontak</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-400">Jl.Dr.Mansyur</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-gray-400">(+62) 999 8888 7777</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-cyan-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-400">seasea@belajar.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2025 SeaSea. Hak cipta dilindungi. Dirancang dengan 💙 untuk laut.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('navigation-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        });

        document.querySelectorAll('[role="alert"]').forEach(alert => {
            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&times;';
            closeButton.classList.add('float-right', 'font-semibold', 'text-lg');
            closeButton.addEventListener('click', () => {
                alert.remove();
            });
            alert.insertBefore(closeButton, alert.firstChild);
        });

    </script>

    @yield('scripts')
    @yield('styles')
</body>
</html>
