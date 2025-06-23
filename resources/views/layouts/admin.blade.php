<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('styles')
<style>

    @media (min-width: 1280px) {
        #mobile-menu-button, #close-sidebar-button {
            display: none !important;
        }

        #sidebar {
            transform: translateX(0) !important;
        }

        .main-content {
            margin-left: 16rem !important;
            width: calc(100% - 16rem) !important;
        }
    }
    #sidebar {
        background: linear-gradient(135deg, #5da4c1 0%, #1a5d94 100%);
        position: fixed;
        height: 100vh;
        z-index: 50;
        width: 16rem; /* 256px */
        transition: transform 0.3s ease-in-out;
    }
    #sidebar a.hover\:bg-gray-700:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-left: 3px solid #38bdf8;
    }

    #sidebar a.bg-blue-600 {
        background-color: rgba(56, 189, 248, 0.2);
        border-left: 3px solid #38bdf8;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    
    #sidebar .py-6.px-4 > div:first-child {
        background: rgba(0, 0, 0, 0.1);
        margin: -1.5rem -1rem 1rem;
        padding: 1.5rem 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    #sidebar .border-t.border-gray-700 {
        border-color: rgba(255, 255, 255, 0.1);
    }

    #sidebar .text-gray-300 {
        color: rgba(255, 255, 255, 0.8);
    }

    .main-content {
        transition: margin-left 0.3s ease-in-out, width 0.3s ease-in-out;
    }

    @media (min-width: 1280px) {
        #sidebar {
            transform: translateX(0) !important;
        }

        .main-content {
            margin-left: 16rem !important;
            width: calc(100% - 16rem) !important;
        }

        .xl:hidden {
            display: none !important;
        }
    }

    @media (max-width: 1279px) {
        body.sidebar-open #sidebar {
            transform: translateX(0);
        }

        body:not(.sidebar-open) #sidebar {
            transform: translateX(-100%);
        }

        body.sidebar-open #sidebar-backdrop {
            display: block;
        }

        body:not(.sidebar-open) #sidebar-backdrop {
            display: none;
        }

        @media (max-width: 767px) {
            body.sidebar-open .main-content {
                margin-left: 0;
                width: 100%;
            }
        }

        @media (min-width: 768px) and (max-width: 1279px) {
            body.sidebar-open .main-content {
                margin-left: 16rem;
                width: calc(100% - 16rem);
            }

            body:not(.sidebar-open) .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    }

    /* Button styling */
    #mobile-menu-button, #close-sidebar-button {
        cursor: pointer;
        z-index: 60;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Backdrop styling */
    #sidebar-backdrop {
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 40;
        transition: opacity 0.2s ease-in-out;
    }

    @media (max-width: 767px) {
        body.sidebar-open {
            overflow: hidden;
        }
    }
</style>

</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen" id="admin-body">
    <!-- Sidebar -->
<aside id="sidebar" class="bg-gray-800 text-white w-64 min-h-screen fixed transform transition-transform duration-300 ease-in-out lg:translate-x-0 -translate-x-full z-50">
        <div class="py-6 px-4 flex flex-col h-auto  ">
            <div class="flex items-center justify-between mb-8">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <span class="font-bold text-xl ml-2">Admin</span>
                </a>
    <button
    id="close-sidebar-button"
    class="lg:hidden bg-cyan-700 hover:bg-cyan-600 text-white p-3 rounded-md transition-colors cursor-pointer focus:outline-none"
    type="button"
    aria-label="Close sidebar"
>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
    </svg>
   </button>
            </div>

            <nav>
                <ul>
                    <li class="mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.dashboard.article') }}" class="block px-4 py-3 rounded-lg font-medium {{ request()->routeIs('admin.dashboard.article') || request()->is('admin/articles*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                </svg>
                                Artikel
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-3 rounded-lg font-medium {{ request()->routeIs('admin.users.*') || request()->is('admin/users*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                User
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.dashboard.funfacts') }}" class="block px-4 py-3 rounded-lg font-medium {{ request()->routeIs('admin.dashboard.funfacts') || request()->is('admin/funfact*')? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Fun Fact
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('admin.dashboard.community') }}" class="block px-4 py-3 rounded-lg font-medium {{ request()->routeIs('admin.dashboard.community') || request()->is('admin/community*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Comunitas
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                       <a href="{{ route('admin.tags.index') }}" class="block px-4 py-3 rounded-lg font-medium {{ request()->routeIs('admin.tags.*') || request()->is('admin/tags*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                    <div class="flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            Tag
        </div>
    </a>
</li>
                </ul>
            </nav>

            <!-- Divider -->
            <div class="border-t border-gray-700 my-6"></div>

            <!-- System Links -->
            <nav>
                <ul>
                    <li class="mb-1">
                        <a href="{{route('home') }}" class="block px-4 py-3 rounded-lg font-medium text-gray-300 hover:bg-gray-700">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Kembali ke home
                            </div>
                        </a>
                    </li>
                    <li class="mb-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-3 rounded-lg font-medium text-gray-300 hover:bg-gray-700">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </div>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    
            <div
                id="sidebar-backdrop"
                class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40 lg:hidden hidden"
                aria-hidden="true"
            ></div>

            <div class="main-content flex flex-col  min-h-screen">
                    <header class="bg-white shadow">
                        <div class="px-4 sm:px-6 lg:px-8 py-5 flex justify-between items-center">
                            <div class="flex items-center">
                        <button
                id="mobile-menu-button"
                class="lg:hidden text-gray-600 hover:text-gray-900 focus:outline-none cursor-pointer p-3 rounded-md hover:bg-gray-100 transition-colors"
                type="button"
                aria-label="Toggle sidebar"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

                    <h1 class="text-xl font-semibold text-gray-800">@yield('header-title', 'Admin Panel')</h1>
                </div>

                <div class="flex items-center">

                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->foto_profil ? Storage::url(Auth::user()->foto_profil) : asset('images/default-profile.png') }}" alt="{{ Auth::user()->name }}">
                            <span class="ml-2 text-gray-700">{{ Auth::user()->name }}</span>
                            <svg class="ml-1 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="user-dropdown" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden z-50">
                            <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                          <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>


    </div>
 <script src="{{ asset('js/app.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Admin dashboard initializing...');

        initSidebar();

        initializeUserDropdown();
    });

    function initSidebar() {
        const body = document.body;
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const menuButton = document.getElementById('mobile-menu-button');
        const closeButton = document.getElementById('close-sidebar-button');

        if (!sidebar || !backdrop || !menuButton || !closeButton) {
            console.error('Missing required sidebar elements');
            return;
        }

        function setInitialState() {
            if (window.innerWidth < 1024) {
                body.classList.remove('sidebar-open');
                backdrop.style.display = 'none';
            } else {
                body.classList.add('sidebar-open');
            }

            localStorage.setItem('sidebarState', body.classList.contains('sidebar-open') ? 'open' : 'closed');
        }

        function toggleSidebar() {
            if (body.classList.contains('sidebar-open')) {
                body.classList.remove('sidebar-open');

                if (window.innerWidth < 1024) {
                    backdrop.style.display = 'none';
                    body.style.overflow = '';
                }
            } else {
                body.classList.add('sidebar-open');

                if (window.innerWidth < 1024) {
                    backdrop.style.display = 'block';
                    body.style.overflow = 'hidden';
                }
            }

            localStorage.setItem('sidebarState', body.classList.contains('sidebar-open') ? 'open' : 'closed');
        }

        function restoreSidebarState() {
            const savedState = localStorage.getItem('sidebarState');

            if (window.innerWidth >= 1024 && savedState) {
                if (savedState === 'open') {
                    body.classList.add('sidebar-open');
                } else {
                    body.classList.remove('sidebar-open');
                }
            }
        }

        menuButton.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });

        closeButton.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });

        backdrop.addEventListener('click', function() {
            toggleSidebar();
        });

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                backdrop.style.display = 'none';
                body.style.overflow = '';
            } else {
            
                if (body.classList.contains('sidebar-open')) {
                    backdrop.style.display = 'block';
                    body.style.overflow = 'hidden';
                }
            }
        });

        
        setInitialState();
        restoreSidebarState();
    }

   function initializeUserDropdown() {
    const userMenuButton = document.getElementById('user-menu-button');
    const userDropdown = document.getElementById('user-dropdown');

    if (!userMenuButton || !userDropdown) {
        console.error('Missing user dropdown elements');
        return;
    }

    function toggleDropdown(event) {
        event.preventDefault();
        event.stopPropagation(); // menghindari penutupan dropdown saat mengklik tombol
        userDropdown.classList.toggle('hidden');

        //Jika dropdown terbuka, tambahkan listener untuk menutupnya saat klik di luar
        if (!userDropdown.classList.contains('hidden')) {
            // Add with slight delay to prevent immediate closing
            setTimeout(() => {
                document.addEventListener('click', closeDropdown);
            }, 10);
        } else {
            // hapus listener saat dropdown ditutup
            document.removeEventListener('click', closeDropdown);
        }
    }

    // tutup dropdown saat mengklik di luar
    function closeDropdown(event) {
        if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
            userDropdown.classList.add('hidden');
            document.removeEventListener('click', closeDropdown);
        }
    }

    // Tambahkan event listener untuk tombol menu pengguna
    userMenuButton.addEventListener('click', toggleDropdown);
}
</script>
    @yield('scripts')
</body>
</html>
