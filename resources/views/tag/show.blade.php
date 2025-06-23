@extends('layouts.app')

@section('title', '#' . $tag->nama_tag)

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 via-cyan-50 to-teal-50 relative overflow-hidden">
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-400/10 via-cyan-500/10 to-teal-600/20"></div>
        <div class="ocean-waves absolute bottom-0 left-0 w-full h-96 opacity-20"></div>
        <div class="floating-particles absolute inset-0"></div>
        <div class="underwater-current absolute inset-0"></div>
    </div>

<div class="bg-gradient-to-r h-[70vh] from-blue-800 to-indigo-900 text-white py-16 relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center  z-0 opacity-20"
         style="background-image: url('{{ asset('home/bawahlaut.jpg') }}');">
    </div>

    <div class="absolute inset-0 z-0">
        <div class="wave-overlay-1"></div>
        <div class="wave-overlay-2"></div>
        <div class="wave-overlay-3"></div>
    </div>

    <div class="absolute inset-0 z-0 deep-sea-bubbles opacity-40"></div>
    <div class="absolute inset-0 z-0 marine-light-rays"></div>

    <div class="absolute bottom-0 left-0 w-full h-32 seafloor-particles"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row md:items-center gap-6">
            <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-full p-6 mr-5 shadow-xl shadow-blue-900/40 shine-effect glow-pulse">
                <i class="fas fa-tag text-3xl"></i>
            </div>
            <div class="max-w-2xl">
                <span class="inline-block text-cyan-200 mb-2 text-sm tracking-wider uppercase font-medium">Pencarian Tag</span>
                <h1 class="text-5xl font-bold mb-3 gradient-text-blue underwater-text-effect">#{{ $tag->nama_tag }}</h1>
                @if($tag->deskripsi)
                    <p class="text-lg text-blue-100 mb-2">{{ $tag->deskripsi }}</p>
                @endif
                <div class="flex items-center mt-3 text-blue-200 bg-blue-700/30 backdrop-blur-sm w-fit px-4 py-2 rounded-full border border-blue-400/20">
                    <i class="fas fa-file-alt mr-2"></i>
                    <span class="font-medium">{{ $tag->articles_count ?? $articles->total() }}</span>
                    <span class="ml-1">{{ Str::plural('article', $tag->articles_count ?? $articles->total()) }}</span>
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-wrap gap-4">
            @auth
                @if(Auth::user()->tags->contains($tag->tag_id))
                    <form action="{{ route('tags.unfollow', $tag->slug) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-white/90 to-blue-100/90 backdrop-blur-sm text-blue-700 px-6 py-3 rounded-xl hover:shadow-xl hover:from-white hover:to-blue-50 transition duration-300 flex items-center font-medium shadow-lg shadow-blue-900/20 transform hover:-translate-y-1">
                            <i class="fas fa-user-minus mr-2"></i> Unfollow Tag
                        </button>
                    </form>
                @else
                    <form action="{{ route('tags.follow', $tag->slug) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-white/90 to-blue-100/90 backdrop-blur-sm text-blue-700 px-6 py-3 rounded-xl hover:shadow-xl hover:from-white hover:to-blue-50 transition duration-300 flex items-center font-medium shadow-lg shadow-blue-900/20 transform hover:-translate-y-1">
                            <i class="fas fa-user-plus mr-2"></i> Follow Tag
                        </button>
                    </form>
                @endif
            @endauth
            <a href="{{ route('tags.index') }}" class="inline-flex items-center bg-blue-600/40 hover:bg-blue-600/50 backdrop-blur-sm text-blue-50 px-6 py-3 rounded-xl transition duration-300 border border-white/10 shadow-lg shadow-blue-900/10 transform hover:-translate-y-1">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Daftar Tag
            </a>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
            <path fill="#E0F2FE" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z" class="wave-path"></path>
        </svg>
    </div>
</div>

    <div class="container mx-auto px-4 py-12 relative z-10">
        @if($articles->count() > 0)
            <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl border border-blue-100/50 p-6 mb-10 flex flex-wrap gap-6 justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 text-white p-3 rounded-xl shadow-md mr-4">
                        <i class="fas fa-chart-bar text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-700 text-lg">Article Stats</h3>
                        <p class="text-gray-600">Menjelajahi #{{ $tag->nama_tag }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-6">
                    <div class="bg-blue-50 rounded-xl px-5 py-3 border border-blue-100">
                        <p class="text-xs text-blue-600 font-medium">Total Artikel</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $articles->total() }}</p>
                    </div>

                    <div class="bg-cyan-50 rounded-xl px-5 py-3 border border-cyan-100">
                        <p class="text-xs text-cyan-600 font-medium"> Artikel Terbaru </p>
                        <p class="text-lg font-bold text-cyan-700">
                     {{ $articles->first() && $articles->first()->created_at ? App\Helpers\IndonesiaTimeHelper::formatDate($articles->first()->created_at) : 'N/A' }}                         </p>
                    </div>

                    <div class="bg-teal-50 rounded-xl px-5 py-3 border border-teal-100">
                        <p class="text-xs text-teal-600 font-medium">Pengikut</p>
                        <p class="text-2xl font-bold text-teal-700">{{ $tag->users_count ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 border border-white/50 group transform hover:-translate-y-2">
                        @if($article->gambar)
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                    <div class="text-white">
                                        <div class="flex items-center gap-4 text-sm">
                                            <span class="flex items-center">
                                                <i class="fas fa-calendar-alt mr-1"></i>
                                                {{ $article->tgl_upload->format('M d, Y') }}
                                            </span>
                                            <span class="flex items-center">
                                                <i class="fas fa-eye mr-1"></i>
                                                {{ $article->views ?? 0 }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-blue-100 via-cyan-200 to-teal-300 flex items-center justify-center relative overflow-hidden">
                                <div class="absolute inset-0 underwater-pattern opacity-30"></div>
                                <i class="fas fa-newspaper text-4xl text-white/70"></i>
                            </div>
                        @endif

                        <div class="p-6">
                            <a href="{{ route('articles.show', $article->slug) }}" class="block">
                                <h3 class="text-xl font-semibold text-gray-800 mb-3 hover:text-blue-600 transition-colors line-clamp-2">{{ $article->judul }}</h3>
                            </a>

                            <div class="flex items-center text-gray-600 mb-4">
                                <img src="{{ $article->user->foto_profil ? asset('storage/' . $article->user->foto_profil) : asset('images/default-avatar.png') }}"
                                    class="w-7 h-7 rounded-full mr-2 border border-white shadow-sm" alt="{{ $article->user->name }}">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium">{{ $article->user->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $article->tgl_upload->format('M d, Y') }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($article->tags->take(3) as $articleTag)
                                    <a href="{{ route('tags.show', $articleTag->slug) }}"
                                        class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full hover:bg-blue-100 transition-colors">
                                        #{{ $articleTag->nama_tag }}
                                    </a>
                                @endforeach
                                @if($article->tags->count() > 3)
                                    <span class="px-3 py-1 bg-gray-50 text-gray-500 text-xs font-medium rounded-full">
                                        +{{ $article->tags->count() - 3 }}
                                    </span>
                                @endif
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
                                <a href="{{ route('articles.show', $article->slug) }}"
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    Baca Artikel
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-4 shadow-md">
                    {{ $articles->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl p-12 shadow-xl border border-blue-100/50 max-w-3xl mx-auto">
                    <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-cyan-300 rounded-full mx-auto flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-search text-4xl text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Artikel Tidak Ditemukan </h2>
                    <p class="text-gray-600 mb-6 text-lg">
                        Tidak Ada Artikel untuk tag <span class="font-medium text-blue-600">#{{ $tag->nama_tag }}</span> sekarang
                    </p>

                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        @auth
                            <a href="{{ route('articles.create') }}" class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-xl flex items-center justify-center">
                                <i class="fas fa-pencil-alt mr-2"></i>
                                Buat Artikel Baru
                            </a>
                        @endauth
                        <a href="{{ route('tags.index') }}" class="bg-white border border-blue-200 text-blue-600 px-6 py-3 rounded-xl font-medium hover:bg-blue-50 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-tags mr-2"></i>
                            Telusuri Tag lain
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($relatedTags) && $relatedTags->count() > 0)
            <div class="mt-16 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-3xl p-8 shadow-lg border border-blue-100/50">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-project-diagram text-blue-500 mr-3"></i>
                    Tag Terkait
                </h3>

                <div class="flex flex-wrap gap-3">
                    @foreach($relatedTags as $relatedTag)
                        <a href="{{ route('tags.show', $relatedTag->slug) }}" class="bg-white px-4 py-2 rounded-xl text-gray-700 hover:text-blue-600 border border-blue-100 hover:border-blue-300 hover:shadow-md transition-all duration-300 flex items-center">
                            <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                            #{{ $relatedTag->nama_tag }}
                            <span class="text-xs text-gray-500 ml-2">({{ $relatedTag->articles_count }})</span>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
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

    .marine-light-rays {
        background: linear-gradient(45deg,
            transparent 30%,
            rgba(120, 220, 255, 0.08) 40%,
            rgba(120, 220, 255, 0.04) 50%,
            transparent 60%
        );
        background-size: 300px 300px;
        animation: lightRaysMove 20s ease-in-out infinite;
    }

    @keyframes lightRaysMove {
        0%, 100% {
            transform: translateX(-100px) translateY(-100px) rotate(0deg);
            opacity: 0.3;
        }
        50% {
            transform: translateX(100px) translateY(100px) rotate(15deg);
            opacity: 0.8;
        }
    }

    .wave-overlay-1 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z' fill='%23ffffff' fill-opacity='0.1'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        animation: wave-animation1 25s linear infinite alternate;
    }

    .wave-overlay-2 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 60%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z' fill='%23ffffff' fill-opacity='0.2'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        animation: wave-animation2 20s linear infinite alternate-reverse;
    }

    .wave-overlay-3 {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40%;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' fill='%23ffffff' fill-opacity='0.3'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        animation: wave-animation3 15s linear infinite alternate;
    }

    @keyframes wave-animation1 {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50px); }
    }

    @keyframes wave-animation2 {
        0% { transform: translateX(0); }
        100% { transform: translateX(50px); }
    }

    @keyframes wave-animation3 {
        0% { transform: translateX(0); }
        100% { transform: translateX(-30px); }
    }

    .underwater-pattern {
        background-image:
            radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
            radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.08) 3px, transparent 3px);
        background-size: 50px 50px, 80px 80px;
        animation: patternFloat 20s linear infinite;
    }

    @keyframes patternFloat {
        0% { background-position: 0 0, 0 0; }
        100% { background-position: 50px 50px, -80px 80px; }
    }

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

    .underwater-text-effect {
        text-shadow:
            0 0 10px rgba(120, 220, 255, 0.3),
            0 0 20px rgba(120, 220, 255, 0.2),
            0 0 30px rgba(120, 220, 255, 0.1);
        animation: underwaterGlow 4s ease-in-out infinite alternate;
    }

    @keyframes underwaterGlow {
        0% {
            text-shadow:
                0 0 10px rgba(120, 220, 255, 0.3),
                0 0 20px rgba(120, 220, 255, 0.2),
                0 0 30px rgba(120, 220, 255, 0.1);
        }
        100% {
            text-shadow:
                0 0 15px rgba(120, 220, 255, 0.4),
                0 0 25px rgba(120, 220, 255, 0.3),
                0 0 35px rgba(120, 220, 255, 0.2);
        }
    }

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
    .wave-path {
        fill: rgba(240, 253, 255, 1);
        filter: drop-shadow(0 -6px 8px rgba(14, 165, 233, 0.1));
    }

    .marine-light-rays {
        background: linear-gradient(45deg,
            transparent 30%,
            rgba(186, 230, 253, 0.05) 40%,
            rgba(186, 230, 253, 0.1) 50%,
            transparent 60%
        ),
        linear-gradient(135deg,
            transparent 30%,
            rgba(56, 189, 248, 0.08) 40%,
            rgba(56, 189, 248, 0.05) 50%,
            transparent 60%
        );
        background-size: 400px 400px, 300px 300px;
        animation: lightRaysFlow 18s ease-in-out infinite alternate;
    }

    @keyframes lightRaysFlow {
        0% {
            transform: translateX(-150px) translateY(-150px) rotate(0deg);
            opacity: 0.3;
            background-position: 0% 0%, 0% 0%;
        }
        50% {
            transform: translateX(100px) translateY(100px) rotate(10deg);
            opacity: 0.8;
            background-position: 50% 50%, 30% 30%;
        }
        100% {
            transform: translateX(150px) translateY(150px) rotate(20deg);
            opacity: 0.3;
            background-position: 100% 100%, 60% 60%;
        }
    }

    .deep-sea-bubbles {
        background-image:
            radial-gradient(circle at 15% 85%, rgba(255, 255, 255, 0.2) 4px, transparent 5px),
            radial-gradient(circle at 45% 75%, rgba(255, 255, 255, 0.15) 5px, transparent 6px),
            radial-gradient(circle at 75% 65%, rgba(255, 255, 255, 0.2) 3px, transparent 4px),
            radial-gradient(circle at 85% 15%, rgba(255, 255, 255, 0.18) 6px, transparent 7px),
            radial-gradient(circle at 25% 35%, rgba(255, 255, 255, 0.15) 2px, transparent 3px);
        background-size: 400px 400px, 500px 500px, 300px 300px, 450px 450px, 250px 250px;
        animation: bubbleRiseEnhanced 25s linear infinite;
    }

    .seafloor-particles {
        background-image:
            radial-gradient(circle at 10% 90%, rgba(14, 116, 144, 0.3) 1px, transparent 2px),
            radial-gradient(circle at 30% 95%, rgba(8, 145, 178, 0.25) 2px, transparent 3px),
            radial-gradient(circle at 50% 92%, rgba(6, 182, 212, 0.2) 1px, transparent 2px),
            radial-gradient(circle at 70% 97%, rgba(2, 132, 199, 0.3) 2px, transparent 3px),
            radial-gradient(circle at 90% 94%, rgba(3, 105, 161, 0.25) 1px, transparent 2px);
        background-size: 80px 80px, 120px 120px, 100px 100px, 130px 130px, 90px 90px;
        animation: seafloorParticlesDrift 30s linear infinite alternate;
    }

    @keyframes seafloorParticlesDrift {
        0% { background-position: 0px 0px, 0px 0px, 0px 0px, 0px 0px, 0px 0px; }
        100% { background-position: 80px 0px, -120px 0px, 100px 0px, -130px 0px, 90px 0px; }
    }

    .gradient-text-blue {
        background: linear-gradient(135deg, #ffffff, #bae6fd, #7dd3fc, #ffffff);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .glow-pulse {
        animation: glowPulseEffect 3s infinite alternate;
    }

    @keyframes glowPulseEffect {
        0% {
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.6),
                       0 0 20px rgba(56, 189, 248, 0.4);
        }
        100% {
            box-shadow: 0 0 15px rgba(56, 189, 248, 0.8),
                       0 0 30px rgba(56, 189, 248, 0.6),
                       0 0 45px rgba(2, 132, 199, 0.3);
        }
    }

    .underwater-text-effect {
        text-shadow:
            0 0 10px rgba(186, 230, 253, 0.4),
            0 0 20px rgba(125, 211, 252, 0.3),
            0 0 30px rgba(56, 189, 248, 0.2);
        animation: underwaterGlow 4s ease-in-out infinite alternate;
    }

    @keyframes underwaterGlow {
        0% {
            text-shadow:
                0 0 10px rgba(186, 230, 253, 0.4),
                0 0 20px rgba(125, 211, 252, 0.3),
                0 0 30px rgba(56, 189, 248, 0.2);
        }
        100% {
            text-shadow:
                0 0 15px rgba(186, 230, 253, 0.6),
                0 0 25px rgba(125, 211, 252, 0.5),
                0 0 35px rgba(56, 189, 248, 0.4);
        }
    }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const createBubble = () => {
        const bubble = document.createElement('div');
        bubble.className = 'absolute rounded-full bg-white/30 pointer-events-none animate-bubble-rise';

        const size = Math.random() * 15 + 5;
        bubble.style.width = `${size}px`;
        bubble.style.height = `${size}px`;

        const left = Math.random() * 100;
        bubble.style.left = `${left}%`;
        bubble.style.bottom = '-20px';

        const duration = Math.random() * 5 + 10;
        const delay = Math.random() * 5;
        bubble.style.animationDuration = `${duration}s`;
        bubble.style.animationDelay = `${delay}s`;

        bubble.style.background = 'radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.2) 60%, rgba(255,255,255,0) 100%)';
        bubble.style.boxShadow = '0 0 5px rgba(255,255,255,0.3)';

        document.querySelector('.deep-sea-bubbles').appendChild(bubble);

        setTimeout(() => {
            bubble.remove();
        }, (duration + delay) * 1000);
    };

    for (let i = 0; i < 10; i++) {
        setTimeout(createBubble, Math.random() * 2000);
    }

    setInterval(createBubble, 2000);

    if (!document.getElementById('bubble-animations')) {
        const style = document.createElement('style');
        style.id = 'bubble-animations';
        style.textContent = `
            @keyframes animate-bubble-rise {
                0% {
                    transform: translateY(0) translateX(0) scale(0.5);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100vh) translateX(calc(var(--tx, 0) * 50px)) scale(1);
                    opacity: 0;
                }
            }

            .animate-bubble-rise {
                --tx: ${Math.random() * 2 - 1};
                animation: animate-bubble-rise var(--duration, 15s) ease-in var(--delay, 0s) forwards;
            }
        `;
        document.head.appendChild(style);
    }
});
</script>
