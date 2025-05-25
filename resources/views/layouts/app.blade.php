<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\layouts\app.blade.php -->
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

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4 flex flex-wrap items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center flex-shrink-0 mr-6">
                <img src="{{ asset('images/logo.svg') }}" alt="{{ config('app.name') }}" class="h-8 w-auto">
                <span class="font-bold text-xl ml-2 text-blue-600">Knowledge</span>
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
                        Articles
                    </a>
                    <a href="{{ route('communities.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-blue-600 mr-6 {{ request()->routeIs('communities.*') ? 'font-semibold text-blue-600' : '' }}">
                        Communities
                    </a>
                    <a href="{{ route('tags.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-blue-600 mr-6 {{ request()->routeIs('tags.*') ? 'font-semibold text-blue-600' : '' }}">
                        Tags
                    </a>
                </div>

                <!-- Search -->
                <div class="relative mx-4 hidden lg:block lg:w-64">
                    <form action="{{ route('articles.search') }}" method="GET">
                        <input type="text" name="query" placeholder="Search articles..." class="w-full px-4 py-2 pr-8 rounded-lg bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white">
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
                                    My Profile
                                </a>
                                <a href="{{ route('admin.dashboard.article') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    My Articles
                                </a>
                                <a href="{{ route('admin.dashboard.community') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    My Communities
                                </a>
                                 @else
                                    <a href="{{ route('dashboard.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Dashboard
                                    </a>
                                     <a href="{{ route('.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    My Profile
                                </a>
                                <a href="{{ route('user.articles') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    My Articles
                                </a>
                                <a href="{{ route('user.communities') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    My Communities
                                </a>
                                @endif
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Sign Out
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

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('info') || session('warning'))
        <div class="container mx-auto px-4 py-4">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            @if(session('info'))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-4" role="alert">
                    <p>{{ session('info') }}</p>
                </div>
            @endif
            @if(session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap">
                <div class="w-full lg:w-1/3 mb-8 lg:mb-0">
                    <h2 class="text-lg font-semibold mb-4">About Us</h2>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Knowledge Platform is a community-driven platform where knowledge seekers and sharers come together to learn, teach, and grow.
                    </p>
                </div>
                <div class="w-full lg:w-1/3 mb-8 lg:mb-0 lg:px-8">
                    <h2 class="text-lg font-semibold mb-4">Quick Links</h2>
                    <ul class="text-gray-300 text-sm space-y-2">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition duration-150">Home</a></li>
                        <li><a href="{{ route('articles.index') }}" class="hover:text-white transition duration-150">Articles</a></li>
                        <li><a href="{{ route('communities.index') }}" class="hover:text-white transition duration-150">Communities</a></li>
                        <li><a href="{{ route('tags.index') }}" class="hover:text-white transition duration-150">Tags</a></li>
                    </ul>
                </div>
                <div class="w-full lg:w-1/3">
                    <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
                    <ul class="text-gray-300 text-sm space-y-2">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            <a href="mailto:info@knowledgeplatform.com" class="hover:text-white transition duration-150">info@knowledgeplatform.com</a>
                        </li>
                    </ul>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition duration-150">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition duration-150">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-sm text-gray-400 text-center">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
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

        // Close alert messages
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
</body>
</html>
