@extends('layouts.app')

@section('title', $funfact->judul . ' - Fakta Menarik Kelautan')

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

    /* Underwater Current Effect */
    .underwater-current {
        background: linear-gradient(45deg,
            rgba(59, 130, 246, 0.1) 0%,
            transparent 25%,
            rgba(6, 182, 212, 0.1) 50%,
            transparent 75%,
            rgba(20, 184, 166, 0.1) 100%
        );
        background-size: 400% 400%;
        animation: currentFlow 20s ease-in-out infinite;
    }

    @keyframes currentFlow {
        0%, 100% { background-position: 0% 0%; }
        25% { background-position: 100% 0%; }
        50% { background-position: 100% 100%; }
        75% { background-position: 0% 100%; }
    }

    /* Line clamp utility */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Reading progress bar */
    .reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #06b6d4, #3b82f6);
        z-index: 9999;
        transition: width 0.1s ease;
    }

    /* Floating animation for cards */
    .float-animation {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Scroll indicator */
    .scroll-indicator {
        position: fixed;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        z-index: 1000;
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .scroll-indicator:hover {
        opacity: 1;
    }

    /* Enhanced hover effects */
    .hover-scale {
        transition: transform 0.3s ease;
    }

    .hover-scale:hover {
        transform: scale(1.05);
    }

    /* Ripple effect */
    .ripple {
        position: relative;
        overflow: hidden;
    }

    .ripple:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .ripple:hover:before {
        width: 300px;
        height: 300px;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
    
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-400/10 via-cyan-500/10 to-teal-600/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

    <section class="bg-gradient-to-br from-blue-800 via-blue-900 to-teal-900 text-white py-16 relative overflow-hidden">
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
            <!-- Enhanced Breadcrumb -->
            <nav class="flex mb-8 animate-on-scroll" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3 bg-white/10 backdrop-blur-md rounded-full px-6 py-3 border border-white/20">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="text-cyan-200 hover:text-white transition duration-300 inline-flex items-center group">
                            <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-cyan-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('funfacts.index') }}" class="ml-1 text-cyan-200 hover:text-white transition duration-300 md:ml-2 group">
                                <span class="group-hover:underline">Fakta Menarik</span>
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-cyan-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-white font-medium md:ml-2">{{ Str::limit($funfact->judul, 30) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="max-w-4xl mx-auto text-center">
                @if($funfact->is_highlighted)
                    <div class="inline-flex items-center bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-full px-6 py-2 mb-6 font-semibold text-sm shadow-lg animate-on-scroll">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.922-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        ⭐ Fakta Unggulan
                    </div>
                @endif

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight text-reveal">
                    <span class="gradient-text-enhanced">{{ $funfact->judul }}</span>
                </h1>

                <!-- Metadata -->
                <div class="flex flex-wrap justify-center gap-4 mb-8 text-reveal-delay-1">
                    @if($funfact->article && $funfact->article->category)
                        <div class="flex items-center bg-white/10 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                            <svg class="w-4 h-4 mr-2 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span class="text-cyan-100 font-medium">{{ $funfact->article->category->nama_kategori }}</span>
                        </div>
                    @endif

                    <div class="flex items-center bg-white/10 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                        <svg class="w-4 h-4 mr-2 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        <span class="text-cyan-100 font-medium">Urutan Animasi: {{ $funfact->urutan_animasi }}</span>
                    </div>
                </div>
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

        <div class="max-w-6xl mx-auto -mt-16 mb-12">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Funfact Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden border border-white/20 animate-on-scroll">
                        <!-- Hero Image -->
                        @if($funfact->gambar)
                            <div class="relative h-80 md:h-96 overflow-hidden">
                                <img src="{{ Storage::url($funfact->gambar) }}" alt="{{ $funfact->judul }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                
                                <!-- Ocean Wave Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 via-transparent to-transparent"></div>
                                
                                <!-- Floating Elements -->
                                <div class="absolute top-4 left-4 flex space-x-2">
                                    @if($funfact->is_highlighted)
                                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center shadow-lg">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.922-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Unggulan
                                        </div>
                                    @endif
                                </div>

                                <!-- Admin Controls -->
                                @if(auth()->check() && auth()->user()->is_admin)
                                    <div class="absolute top-4 right-4 flex space-x-2">
                                        <a href="{{ route('funfacts.edit', $funfact) }}" 
                                           class="bg-blue-600/80 hover:bg-blue-600 text-white p-2 rounded-full transition-all duration-200 backdrop-blur-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- No Image Placeholder with Ocean Theme -->
                            <div class="h-64 bg-gradient-to-r from-blue-400 to-cyan-400 flex items-center justify-center relative overflow-hidden">
                                <!-- Wave Pattern Background -->
                                <div class="absolute inset-0 bg-cover opacity-30" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxOHB4IiB2aWV3Qm94PSIwIDAgMTI4MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0iI2ZmZmZmZiI+PHBhdGggZD0iTTEyODAgMy40QzEwNTAuNTkgMTggMTAxOS40IDg0Ljg5IDczNC40MiA4NC44OWMtMzIwIDAtMzIwLTg0LjMtNjQwLTg0LjNDNTkuNC41OSAyOC4yIDEuNiAwIDMuNFYxNDBoMTI4MHoiIGZpbGwtb3BhY2l0eT0iLjMiLz48cGF0aCBkPSJNMCAyNC4zMWM0My40Ni01LjY5IDk0LjU2LTkuMjUgMTU4LjQyLTkuMjUgMzIwIDAgMzIwIDg5LjI0IDY0MCA4OS4yNCAyNTYuMTMgMCAzMDcuMjgtNTcuMTYgNDgxLjU4LTgwVjE0MEgweiIgZmlsbC1vcGFjaXR5PSIuNSIvPjxwYXRoIGQ9Ik0xMjgwIDUxLjc2Yy0yMDEgMTIuNDktMjQyLjQzIDUzLjQtNTEzLjU4IDUzLjQtMzIwIDAtMzIwLTU3LTY0MC01Ny00OC44NS4wMS05MC4yMSAxLjM1LTEyNi40MiAzLjZWMTQwaDEyODB6Ii8+PC9nPjwvc3ZnPg==');background-size: 100% 100%"></div>
                                
                                <div class="relative z-10 text-center">
                                    <svg class="w-24 h-24 text-white/80 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                    <p class="text-white/90 font-medium">Fakta Menarik Kelautan</p>
                                </div>

                                @if($funfact->is_highlighted)
                                    <div class="absolute top-4 left-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold flex items-center shadow-lg">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.922-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Unggulan
                                    </div>
                                @endif

                                @if(auth()->check() && auth()->user()->is_admin)
                                    <div class="absolute top-4 right-4">
                                        <a href="{{ route('funfacts.edit', $funfact) }}" 
                                           class="bg-white/20 hover:bg-white/30 text-white p-2 rounded-full transition-all duration-200 backdrop-blur-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- Content Section -->
                        <div class="p-8">
                            <!-- Title (mobile only) -->
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 lg:hidden">{{ $funfact->judul }}</h1>

                            <!-- Description Content -->
                            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                <div class="bg-blue-50/50 rounded-2xl p-6 border-l-4 border-blue-500 mb-6">
                                    <h3 class="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Fakta Menarik
                                    </h3>
                                    <div class="text-gray-700">
                                        {!! nl2br(e($funfact->deskripsi)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                  
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 border border-white/20 animate-on-scroll">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Fakta
                        </h3>
                        
                        <div class="space-y-4">
                            @if($funfact->article && $funfact->article->category)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Kategori:</span>
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $funfact->article->category->nama_kategori }}
                                    </span>
                                </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Urutan Animasi:</span>
                                <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $funfact->urutan_animasi }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Status:</span>
                                @if($funfact->is_highlighted)
                                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.922-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Unggulan
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">
                                        Standar
                                    </span>
                                @endif
                            </div>

                            @if($funfact->created_at)
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">Dibuat:</span>
                                    <span class="text-gray-800 text-sm">
                                        {{  App\Helpers\IndonesiaTimeHelper::formatDate($funfact->created_at) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Related Article Card -->
                    @if($funfact->article)
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg overflow-hidden border border-white/20 animate-on-scroll">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Artikel Terkait
                                </h3>

                                <a href="{{ route('articles.show', $funfact->article) }}" 
                                   class="block p-4 border-2 border-dashed border-green-200 rounded-xl bg-green-50/50 hover:bg-green-100/50 hover:border-green-300 transition-all duration-300 group">
                                    
                                    @if($funfact->article->gambar)
                                        <div class="aspect-video rounded-lg overflow-hidden mb-3">
                                            <img src="{{ Storage::url($funfact->article->gambar) }}" 
                                                 alt="{{ $funfact->article->judul }}" 
                                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                        </div>
                                    @endif

                                    <h4 class="font-bold text-gray-800 mb-2 group-hover:text-green-600 transition-colors">
                                        {{ $funfact->article->judul }}
                                    </h4>
                                    
                                    @if($funfact->article->konten_isi_artikel)
                                        <p class="text-sm text-gray-600 mb-3 line-clamp-3">
                                            {{ Str::limit(strip_tags($funfact->article->konten_isi_artikel), 120) }}
                                        </p>
                                    @endif

                                    <div class="flex items-center text-green-600 font-medium text-sm group-hover:underline">
                                        Baca Artikel Lengkap
                                        <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg p-6 border border-white/20 animate-on-scroll">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi</h3>
                        <div class="space-y-3">
                            <a href="{{ route('funfacts.index') }}" 
                               class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar Fakta
                            </a>

                            @if(auth()->check() && auth()->user()->is_admin)
                                <a href="{{ route('funfacts.edit', $funfact) }}" 
                                   class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit Fakta Menarik
                                </a>

                                <form action="{{ route('funfacts.toggle-highlight', $funfact) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="w-full flex items-center justify-center px-4 py-3 {{ $funfact->is_highlighted ? 'bg-gradient-to-r from-yellow-500 to-orange-500' : 'bg-gradient-to-r from-gray-500 to-gray-600' }} text-white rounded-xl hover:opacity-90 transition-all duration-300 shadow-md hover:shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="{{ $funfact->is_highlighted ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                        </svg>
                                        {{ $funfact->is_highlighted ? 'Hapus dari Unggulan' : 'Jadikan Unggulan' }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ocean Facts Section -->
        <div class="max-w-4xl mx-auto mt-16">
            <div class="bg-gradient-to-br from-white/80 to-blue-50/80 backdrop-blur-sm rounded-3xl shadow-xl p-8 border border-white/20">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Jelajahi Lebih Banyak Fakta
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Temukan lebih banyak fakta menarik tentang kehidupan laut dan misteri samudra yang menunggu untuk dijelajahi.
                    </p>
                </div>
                
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('funfacts.index') }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-full hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Semua Fakta Menarik
                    </a>
                    
                    @if($funfact->article && $funfact->article->category)
                        <a href="{{ route('funfacts.index', ['category' => $funfact->article->category->category_id]) }}" 
                           class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-full hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl border border-blue-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ $funfact->article->category->nama_kategori }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
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
                // Add staggered animation delay
                setTimeout(() => {
                    entry.target.style.transform = 'translateY(0)';
                    entry.target.style.opacity = '1';
                }, entry.target.dataset.delay || 0);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach((el, index) => {
        el.dataset.delay = index * 100; // Stagger animations
        observer.observe(el);
    });

    // Reading progress bar
    const progressBar = document.createElement('div');
    progressBar.className = 'reading-progress';
    document.body.appendChild(progressBar);

    function updateReadingProgress() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.scrollHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        progressBar.style.width = scrollPercent + '%';
    }

    window.addEventListener('scroll', updateReadingProgress);
    updateReadingProgress(); // Initial call

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Enhanced image loading with lazy loading
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Add floating animation to sidebar cards
    const sidebarCards = document.querySelectorAll('.lg\\:col-span-1 > div');
    sidebarCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.5}s`;
        card.classList.add('float-animation');
    });

    // Parallax effect for hero image
    const heroImage = document.querySelector('.hero-image');
    if (heroImage) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroImage.style.transform = `translateY(${rate}px)`;
        });
    }

    // Interactive breadcrumb highlighting
    const breadcrumbItems = document.querySelectorAll('nav[aria-label="Breadcrumb"] a');
    breadcrumbItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });


    // Enhanced form interactions
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            if (button) {
                button.disabled = true;
                button.innerHTML = button.innerHTML.replace(/^.*/, '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...');
            }
        });
    });

    // Ripple effect for buttons
    document.querySelectorAll('.ripple').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Auto-hide elements on scroll
    let lastScrollTop = 0;
    const scrollIndicator = document.querySelector('.scroll-indicator');
    
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollIndicator) {
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                scrollIndicator.style.opacity = '0';
            } else {
                scrollIndicator.style.opacity = '0.7';
            }
        }
        
        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    });

    // Initialize tooltips if needed
    const tooltips = document.querySelectorAll('[data-tooltip]');
    tooltips.forEach(tooltip => {
        tooltip.addEventListener('mouseenter', function() {
            const text = this.getAttribute('data-tooltip');
            const tooltipElement = document.createElement('div');
            tooltipElement.className = 'absolute z-50 px-2 py-1 text-sm text-white bg-gray-800 rounded shadow-lg';
            tooltipElement.textContent = text;
            this.appendChild(tooltipElement);
        });
        
        tooltip.addEventListener('mouseleave', function() {
            const tooltipElement = this.querySelector('.absolute.z-50');
            if (tooltipElement) {
                tooltipElement.remove();
            }
        });
    });
});

// Utility function for smooth reveal animations
function revealOnScroll() {
    const reveals = document.querySelectorAll('.reveal');
    
    for (let i = 0; i < reveals.length; i++) {
        const windowHeight = window.innerHeight;
        const elementTop = reveals[i].getBoundingClientRect().top;
        const elementVisible = 150;
        
        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add('active');
        } else {
            reveals[i].classList.remove('active');
        }
    }
}

window.addEventListener('scroll', revealOnScroll);

// Preload images for better performance
function preloadImages() {
    const images = document.querySelectorAll('img[data-preload]');
    images.forEach(img => {
        const imageUrl = img.getAttribute('data-preload');
        const image = new Image();
        image.src = imageUrl;
    });
}

// Call preload on page load
window.addEventListener('load', preloadImages);
</script>
@endsection
