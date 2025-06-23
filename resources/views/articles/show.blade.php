@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-900 py-20 z-0">
        <div class="absolute inset-0 underwater-pattern opacity-20"></div>
        <img src="{{ asset('home/seaarticle.jpeg') }}" alt="Ocean Background" class="absolute inset-0 w-full h-full object-cover opacity-30">

        <div class="absolute inset-0">
            <div class="light-ray light-ray-1"></div>
            <div class="light-ray light-ray-2"></div>
            <div class="light-ray light-ray-3"></div>
        </div>

        <div class="floating-particles absolute inset-0"></div>
        <div class="absolute inset-0 bubble-container">
            <div class="animated-bubble size-lg delay-2"></div>
            <div class="animated-bubble size-md delay-4"></div>
            <div class="animated-bubble size-sm delay-1"></div>
            <div class="animated-bubble size-xs delay-3"></div>
            <div class="animated-bubble size-md delay-5"></div>
        </div>


        <div class="absolute bottom-0 h-1/2 w-full bg-gradient-to-t from-blue-950/60 to-transparent"></div>


        <div class="ocean-waves absolute bottom-0 left-0 w-full h-20 opacity-20"></div>
    </div>
    <div class="container mx-auto px-4 py-12 relative min-h-[60vh]">
        <div class="flex items-center mb-6 fade-in-up ">
            <a href="{{ route('articles.index') }}" class="flex items-center text-blue-200 hover:text-white mr-4 transition duration-300">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="hover:underline">Kembali Ke Artikel</span>
            </a>
            <span class="text-blue-200">|</span>
            <a href="{{ route('articles.index', ['category' => $article->category->category_id]) }}" class="ml-4 text-blue-200 hover:text-white transition duration-300 hover:underline">
                {{ $article->category->nama_kategori }}
            </a>
        </div>

        <h1 class="text-3xl md:text-5xl font-bold text-sky-200 mb-4 leading-tight fade-in-up animation-delay-200">
            <span class="grad   ient-text-enhanced">{{ $article->judul }}</span>
        </h1>

        <div class="flex flex-wrap items-center mt-4 text-sm fade-in-up animation-delay-400">
            <div class="flex items-center bg-white/15 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                <img src="{{ $article->user->profile_photo_url }}" alt="{{ $article->user->nama }}" class="w-8 h-8 rounded-full mr-2 border-2 border-cyan-300">
                <span class="text-cyan-300">{{ $article->user->nama }}</span>
            </div>
            <span class="mx-2 text-blue-200">•</span>
            <div class="flex items-center bg-white/15 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                <svg class="w-4 h-4 mr-1 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
<span class="text-sky-300">
    {{ $article->tgl_upload ? App\Helpers\IndonesiaTimeHelper::formatDate($article->tgl_upload) : '-' }}
</span>            </div>
            <span class="mx-2 text-blue-200">•</span>
            <div class="flex items-center bg-white/15 backdrop-blur-md rounded-full px-4 py-2 border border-white/20">
                <svg class="w-4 h-4 mr-1 text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
<span class="text-sky-300">
   {{$article->tgl_upload ? \App\Helpers\IndonesiaTimeHelper::diffForHumans($article->tgl_upload): '-'}}
</span>
 </div>
        </div>
    </div>

    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 w-full z-10 transform translate-y-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
            <path fill="#f0fdff" fill-opacity="1"
                  d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,261.3C960,256,1056,224,1152,208C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>

        <div class="fish-group">
            <div class="swimming-fish fish-1"></div>
            <div class="swimming-fish fish-2"></div>
            <div class="swimming-fish fish-3"></div>
        </div>
    </div>
</div>

<div class="bg-gradient-to-b from-cyan-50 via-white to-blue-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Main Article Content -->
            <div class="lg:w-2/3 fade-in-up animation-delay-600">
                @if($article->gambar)
                    <div class="mb-8 rounded-2xl overflow-hidden shadow-2xl article-featured-image-container">
                        <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-auto max-h-[500px] object-cover rounded-lg article-featured-image">
                        <div class="light-ripple"></div>
                    </div>
                @endif

                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 border border-cyan-100 mb-8 prose prose-lg max-w-none prose-headings:text-blue-800 prose-a:text-cyan-600 hover-lift">
                    {!! $article->konten_isi_artikel !!}
                </div>

                @if($article->tags->count() > 0)
                    <div class="mb-8 fade-in-up">
                        <h3 class="text-lg font-bold text-blue-800 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            Tag
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                                <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}" class="px-4 py-2 bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-800 rounded-full text-sm transition duration-300 hover:from-cyan-200 hover:to-blue-200 hover:-translate-y-1 border border-cyan-200 flex items-center">
                                    <span class="w-2 h-2 bg-cyan-500 rounded-full mr-2 animate-pulse"></span>
                                    #{{ $tag->nama_tag }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($article->funfacts->count() > 0)
                    <div class="bg-gradient-to-br from-cyan-50 to-blue-50 p-8 rounded-2xl mb-8 shadow-lg border border-blue-100 hover-ripple fade-in-up">
                        <h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z"></path>
                            </svg>
                            Fun Facts
                        </h3>
                        <div class="space-y-4">
                            @foreach($article->funfacts as $index => $funfact)
                                <div class="bg-white/80 backdrop-blur-sm p-5 rounded-xl shadow-md border border-blue-100 funfact-card" style="animation-delay: {{ $index * 0.2 }}s">
                                    <h4 class="font-medium text-blue-700 mb-2">{{ $funfact->judul }}</h4>
                                    <p class="text-gray-700">{{ $funfact->konten }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mb-8" id="reactions">
                    <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center fade-in-up">
                        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                        </svg>
                        Reaksi
                    </h3>
                    <div class="flex flex-wrap gap-3 bg-white/70 backdrop-blur-sm p-6 rounded-xl shadow-lg border border-cyan-100 reactions-container fade-in-up">
                        @php
                            $reactionTypes = ['like', 'love', 'wow', 'sad', 'angry'];
                            $reactionIcons = [
                                'like' => 'M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5',
                                'love' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                                'wow' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z',
                                'sad' => 'M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                                'angry' => 'M13 10V3L4 14h7v7l9-11h-7z'
                            ];


                            $userReaction = null;
                            if (Auth::check()) {
                                $userReaction = $article->reactions->where('user_id', Auth::id())->first();
                            }
                        @endphp

                        @auth
                            @foreach($reactionTypes as $type)
                                <form action="{{ route('reactions.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="reactionable_id" value="{{ $article->article_id }}">
                                    <input type="hidden" name="reactionable_type" value="App\Models\Article">
                                    <input type="hidden" name="jenis_reaksi" value="{{ $type }}">
                                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                                    <input type="hidden" name="fragment" value="reactions">

                                    <button type="submit" class="reaction-button flex flex-col items-center p-3 rounded-lg hover:bg-gradient-to-br hover:from-cyan-100 hover:to-blue-100 transition duration-300 {{ $userReaction && $userReaction->jenis_reaksi === $type ? 'bg-gradient-to-r from-cyan-100 to-blue-100 border-2 border-blue-300' : '' }}">
                                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-md {{ $userReaction && $userReaction->jenis_reaksi === $type ? 'text-blue-600 reaction-pulse' : 'text-gray-600' }}">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $reactionIcons[$type] }}"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm mt-2 capitalize font-medium">{{ $type }}</span>
                                        <span class="text-sm font-bold bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full min-w-[24px] text-center mt-1">
                                            {{ $article->reactions->where('jenis_reaksi', $type)->count() }}
                                        </span>
                                    </button>
                                </form>
                            @endforeach
                        @else
                            <div class="flex flex-wrap gap-3 w-full">
                                @foreach($reactionTypes as $type)
                                    <div class="flex flex-col items-center p-3 bg-white/50 backdrop-blur-sm rounded-lg border border-gray-200">
                                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-md text-gray-500">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $reactionIcons[$type] }}"></path>
                                            </svg>
                                        </div>
                                        <span class="text-sm mt-2 capitalize font-medium">{{ $type }}</span>
                                        <span class="text-sm font-bold bg-cyan-100 text-cyan-800 px-2 py-1 rounded-full min-w-[24px] text-center mt-1">
                                            {{ $article->reactions->where('jenis_reaksi', $type)->count() }}
                                        </span>
                                    </div>
                                @endforeach

                                <div class="flex items-center ml-4 text-blue-600">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login to react</a>
                                </div>
                            </div>
                        @endauth

                        @if($article->reactions->count() > 0)
                            <div class="mt-4 w-full flex justify-end">
                                <a href="{{ route('reactions.show', ['type' => 'article', 'id' => $article->article_id]) }}" class="text-cyan-600 hover:text-cyan-800 flex items-center transition duration-300 font-medium">
                                    <span>Lihat semua ({{ $article->reactions->count() }} ) reaksi</span>
                                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-8 fade-in-up">
                    <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                        </svg>
                        Tinggalkan Komentar
                    </h3>

                    <div class="bg-white/70 backdrop-blur-sm rounded-xl shadow-lg border border-cyan-100 p-6">
                        @auth
                            <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $article->article_id }}">

                                <div class="relative">
                                    <textarea
                                        name="konten"
                                        rows="4"
                                        class="w-full px-5 py-3 border border-cyan-200 rounded-xl focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 resize-none bg-white/70 backdrop-blur-sm transition-all duration-300"
                                        placeholder="Bagikan Pengetahuan Anda tentang Artikel ini..."
                                        required
                                    >{{ old('konten') }}</textarea>

                                    @error('konten')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button
                                        type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-xl hover:from-cyan-600 hover:to-blue-700 transition duration-300 shadow-lg hover:shadow-xl flex items-center transform hover:scale-105"
                                    >
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        Kirim Pesan
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-8 text-center">
                                <svg class="w-12 h-12 text-cyan-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                <p class="text-blue-800 text-lg font-medium mb-4">
                                    Login
                                </p>
                                <p class="text-gray-600 mb-6">
                                    Please
                                    <a href="{{ route('login') }}" class="text-cyan-600 hover:underline font-medium">login</a>
                                    untuk berkomentar
                                </p>
                                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white rounded-lg hover:from-cyan-600 hover:to-blue-700 transition duration-300 shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    login
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>

                <div id="comments" class="mb-8 fade-in-up">
                    <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path>
                            <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"></path>
                        </svg>
                        Diskusi ({{ $article->comments->count() }})
                    </h3>

                    <div class="space-y-6">
                        @forelse($article->comments as $index => $comment)
                            <div class="bg-white/70 backdrop-blur-sm p-6 rounded-xl shadow-lg border border-blue-100 comment-card" id="comment-{{ $comment->comment_id }}" style="animation-delay: {{ $index * 0.15 }}s">
                                <div class="flex items-start gap-4">
                                    <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->nama }}" class="w-12 h-12 rounded-full border-2 border-cyan-200 shadow-md">
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="font-bold text-gray-800">{{ $comment->user->nama }}</h4>
                                                <p class="text-xs text-gray-500 flex items-center">
                                                    <svg class="w-3 h-3 mr-1 text-cyan-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $comment->tgl_komentar->format('M d, Y \a\t H:i') }}
                                                </p>
                                            </div>
                                            @auth
                                                @if(Auth::id() == $comment->user_id || Auth::user()->isAdmin())
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                        <div class="mt-3 text-gray-700 bg-blue-50 p-4 rounded-lg border border-blue-100">
                                            {{ $comment->isi_komentar }}
                                        </div>

                                        <div class="flex items-center mt-3 space-x-4">
                                            @auth
                                                <div class="flex items-center space-x-3">
                                                    <form action="{{ route('likes.store') }}" method="POST" class="inline-flex">
                                                        @csrf
                                                        <input type="hidden" name="type" value="like">
                                                        <input type="hidden" name="model_type" value="App\Models\Comment">
                                                        <input type="hidden" name="model_id" value="{{ $comment->comment_id }}">
                                                        <input type="hidden" name="redirect_url" value="{{ $currentUrl }}">
                                                        <input type="hidden" name="fragment" value="comment-{{ $comment->comment_id }}">

                                                        <button type="submit" class="flex items-center text-sm px-3 py-1 rounded-lg {{ $comment->isLikedBy(Auth::id()) ? 'bg-blue-100 text-blue-600 font-medium' : 'text-gray-500 hover:bg-blue-50' }} transition-all duration-300">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                            </svg>
                                                            <span>{{ $comment->likes_count ?? 0 }}</span>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('likes.store') }}" method="POST" class="inline-flex">
                                                        @csrf
                                                        <input type="hidden" name="type" value="dislike">
                                                        <input type="hidden" name="model_type" value="App\Models\Comment">
                                                        <input type="hidden" name="model_id" value="{{ $comment->comment_id }}">
                                                        <input type="hidden" name="redirect_url" value="{{ $currentUrl }}">
                                                        <input type="hidden" name="fragment" value="comment-{{ $comment->comment_id }}">

                                                        <button type="submit" class="flex items-center text-sm px-3 py-1 rounded-lg {{ $comment->isDislikedBy(Auth::id()) ? 'bg-red-100 text-red-600 font-medium' : 'text-gray-500 hover:bg-red-50' }} transition-all duration-300">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a.937.937 0 01.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13v-9m-7 10h2m5 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2.5"></path>
                                                            </svg>
                                                            <span>{{ $comment->dislikes_count ?? 0 }}</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="flex items-center space-x-4">
                                                    <div class="flex items-center text-sm px-3 py-1 bg-gray-50 rounded-lg text-gray-500">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                        </svg>
                                                        <span>{{ $comment->likes_count ?? 0 }}</span>
                                                    </div>

                                                    <div class="flex items-center text-sm px-3 py-1 bg-gray-50 rounded-lg text-gray-500">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a.937.937 0 01.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13v-9m-7 10h2m5 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2.5"></path>
                                                        </svg>
                                                        <span>{{ $comment->dislikes_count ?? 0 }}</span>
                                                    </div>
                                                </div>
                                            @endauth

                                            @auth
                                                <button onclick="toggleReplyForm('reply-form-{{ $comment->comment_id }}')" class="text-cyan-600 hover:text-cyan-800 transition-colors flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                   Balas
                                                </button>
                                            @endauth
                                        </div>

                                        <div class="ml-8 mt-4">
                                            @auth
                                                <div id="reply-form-{{ $comment->comment_id }}" class="mb-4 hidden">
                                                    <form action="{{ route('comments.replies.store', $comment) }}" method="POST" class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                                        @csrf
                                                        <div class="mb-2">
                                                            <textarea name="isi_balasan" rows="2" class="w-full px-4 py-2 text-sm border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 bg-white/90" placeholder="Write your reply..."></textarea>
                                                        </div>
                                                        <div class="flex justify-end">
                                                            <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-3 py-1 text-sm rounded-lg hover:from-cyan-600 hover:to-blue-600 transition duration-300 shadow-md">
                                                              Kirim Balasan
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endauth

                                            @if($comment->replies->count() > 0)
                                                <div class="space-y-4 mt-4">
                                                    @foreach($comment->replies as $replyIndex => $reply)
                                                        <div class="bg-white/80 p-4 rounded-lg shadow-sm border border-cyan-100" id="reply-{{ $reply->reply_id }}" style="animation-delay: {{ ($index + $replyIndex) * 0.1 + 0.1 }}s">
                                                            <div class="flex items-start gap-3">
                                                                <img src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->nama }}" class="w-8 h-8 rounded-full border border-cyan-200">
                                                                <div class="flex-1">
                                                                    <div class="flex items-center justify-between">
                                                                        <div>
                                                                            <h5 class="font-medium text-gray-800 text-sm">{{ $reply->user->nama }}</h5>
                                                                            <p class="text-xs text-gray-500">{{ $reply->tgl_reply ? $reply->tgl_reply->format('M d, Y \a\t H:i') : '-' }}</p>
                                                                        </div>
                                                                        @auth
                                                                            @if(Auth::id() == $reply->user_id || Auth::user()->isAdmin())
                                                                                <form action="{{ route('comments.replies.destroy', [$comment, $reply]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                                                        </svg>
                                                                                    </button>
                                                                                </form>
                                                                            @endif
                                                                        @endauth
                                                                    </div>
                                                                    <div class="mt-2 text-gray-700 text-sm bg-blue-50 p-3 rounded-lg">
                                                                        {{ $reply->isi_balasan }}
                                                                    </div>

                                                                    <!-- Like/Dislike buttons for replies -->
                                                                    <div class="flex items-center mt-2 space-x-3">
                                                                        @auth
                                                                            <div class="flex items-center space-x-2">
                                                                                <!-- Like button -->
                                                                                <form action="{{ route('likes.store') }}" method="POST" class="inline-flex">
                                                                                    @csrf
                                                                                    <input type="hidden" name="type" value="like">
                                                                                    <input type="hidden" name="model_type" value="App\Models\CommentReply">
                                                                                    <input type="hidden" name="model_id" value="{{ $reply->reply_id }}">
                                                                                    <input type="hidden" name="redirect_url" value="{{ $currentUrl }}">
                                                                                    <input type="hidden" name="fragment" value="reply-{{ $reply->reply_id }}">

                                                                                    <button type="submit" class="flex items-center text-xs px-2 py-1 rounded-md {{ $reply->isLikedBy(Auth::id()) ? 'bg-blue-100 text-blue-600 font-medium' : 'text-gray-500 hover:bg-blue-50' }} transition-all duration-300">
                                                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                                                        </svg>
                                                                                        <span>{{ $reply->likes_count ?? 0 }}</span>
                                                                                    </button>
                                                                                </form>

                                                                                <form action="{{ route('likes.store') }}" method="POST" class="inline-flex">
                                                                                    @csrf
                                                                                    <input type="hidden" name="type" value="dislike">
                                                                                    <input type="hidden" name="model_type" value="App\Models\CommentReply">
                                                                                    <input type="hidden" name="model_id" value="{{ $reply->reply_id }}">
                                                                                    <input type="hidden" name="redirect_url" value="{{ $currentUrl }}">
                                                                                    <input type="hidden" name="fragment" value="reply-{{ $reply->reply_id }}">

                                                                                    <button type="submit" class="flex items-center text-xs px-2 py-1 rounded-md {{ $reply->isDislikedBy(Auth::id()) ? 'bg-red-100 text-red-600 font-medium' : 'text-gray-500 hover:bg-red-50' }} transition-all duration-300">
                                                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a.937.937 0 01.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13v-9m-7 10h2m5 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2.5"></path>
                                                                                        </svg>
                                                                                        <span>{{ $reply->dislikes_count ?? 0 }}</span>
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                        @else
                                                                            <div class="flex items-center space-x-2">
                                                                                <div class="flex items-center text-xs px-2 py-1 bg-gray-50 rounded-md text-gray-500">
                                                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                                                    </svg>
                                                                                    <span>{{ $reply->likes_count ?? 0 }}</span>
                                                                                </div>

                                                                                <div class="flex items-center text-xs px-2 py-1 bg-gray-50 rounded-md text-gray-500">
                                                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a.937.937 0 01.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13v-9m-7 10h2m5 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2.5"></path>
                                                                                    </svg>
                                                                                    <span>{{ $reply->dislikes_count ?? 0 }}</span>
                                                                                </div>
                                                                            </div>
                                                                        @endauth
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 bg-white/70 backdrop-blur-sm rounded-xl shadow-lg border border-cyan-100">
                                <svg class="w-16 h-16 mx-auto text-cyan-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="text-gray-600">Tidak Ada Komen Sekarang!</p>
                                <p class="text-cyan-600 mt-2">Bagikan Pesan Anda Untuk Artikel ini </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="lg:w-1/3 fade-in-up animation-delay-800">

                <div class="bg-gradient-to-br from-white to-blue-50 p-6 rounded-2xl shadow-xl border border-cyan-100 mb-6 hover-lift">
                    <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                       Tentang Penulis
                    </h3>
                    <div class="flex items-center mb-4">
                        <div class="relative mr-4">
                            <img src="{{ $article->user->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="{{ $article->user->nama }}" class="w-16 h-16 rounded-full border-2 border-cyan-300 author-image">
                            <div class="absolute bottom-0 right-0 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $article->user->nama }}</h4>
                            <p class="text-gray-600 text-sm flex items-center">
                                <svg class="w-4 h-4 mr-1 text-cyan-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                                Berkontribusi Sejak {{ App\Helpers\IndonesiaTimeHelper::formatDateShort($article->user->created_at) }}
                            </p>
                        </div>
                    </div>
                    @if($article->user->deskripsi)
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 mb-4">
                            <p class="text-gray-700 italic">
                                "{{ Str::limit($article->user->deskripsi, 150) }}"
                            </p>
                        </div>
                    @endif
                    <a href="{{ route('user.profile', $article->user) }}" class="bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white px-4 py-2 rounded-lg transition duration-300 shadow-md flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                      Lihat Profil
                    </a>
                </div>


                @if($relatedArticles->count() > 0)
                    <div class="bg-gradient-to-br from-white to-cyan-50 p-6 rounded-2xl shadow-xl border border-cyan-100 mb-6 hover-lift">
                        <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                            </svg>
                           Artikel Terkait
                        </h3>
                        <div class="space-y-4">
                            @foreach($relatedArticles as $index => $relatedArticle)
                                <div class="flex items-start group hover-card" style="animation-delay: {{ $index * 0.2 }}s">
                                    <a href="{{ route('articles.show', $relatedArticle) }}" class="block w-20 h-16 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-lg overflow-hidden mr-3 shadow-md related-article-image">
                                        @if($relatedArticle->gambar)
                                            <img src="{{ Storage::url($relatedArticle->gambar) }}" alt="{{ $relatedArticle->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </a>
                                    <div>
                                        <a href="{{ route('articles.show', $relatedArticle) }}" class="text-gray-800 font-medium hover:text-cyan-600 transition duration-300 line-clamp-2">
                                            {{ $relatedArticle->judul }}
                                        </a>
                                        <div class="flex items-center mt-1">
                                            <svg class="w-3 h-3 text-cyan-500 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <p class="text-xs text-gray-500">
                                                {{ $relatedArticle->tgl_upload ? App\Helpers\IndonesiaTimeHelper::formatDate($relatedArticle->tgl_upload) : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

<div class="bg-gradient-to-br from-white to-blue-50 p-6 rounded-2xl shadow-xl border border-cyan-100 mb-6 hover-lift">
    <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
        </svg>
        Kategori Artikel
    </h3>
    <ul class="space-y-3">
        @foreach($categories as $category)
            <li class="category-item">
                <a href="{{ route('articles.index', ['category' => $category->category_id]) }}"
                   class="flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-700 transition duration-300 bg-white/70 backdrop-blur-sm hover:bg-gradient-to-r hover:from-blue-50 hover:to-cyan-50 border border-blue-50 hover:border-cyan-200 group shadow-sm hover:shadow-md">
                    <div class="mr-3 w-8 h-8 flex items-center justify-center rounded-full bg-gradient-to-br from-cyan-100 to-blue-100 text-cyan-700 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <span class="font-medium">{{ $category->nama_kategori }}</span>
                    <span class="ml-auto bg-cyan-100 text-cyan-800 text-xs font-medium px-2.5 py-1 rounded-full">
                        {{ $category->articles_count ?? 0 }}
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
    <div class="wave-animation mt-6">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
</div>

<div class="bg-gradient-to-br from-white to-cyan-50 p-6 rounded-2xl shadow-xl border border-cyan-100 hover-lift">
    <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
        </svg>
        Tag Populer
    </h3>
    <div class="flex flex-wrap gap-2 tags-container relative">
        @foreach($tags as $tag)
            <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}"
               class="px-4 py-2 bg-gradient-to-r from-cyan-100 to-blue-100 text-cyan-800 rounded-full text-sm transition duration-300 hover:from-cyan-200 hover:to-blue-200 hover:-translate-y-1 border border-cyan-200 flex items-center group tag-bubble">
                <span class="w-2 h-2 bg-cyan-500 rounded-full mr-2 group-hover:animate-pulse"></span>
                #{{ $tag->nama_tag }}
                <span class="ml-1 text-xs bg-white/70 backdrop-blur-sm text-cyan-700 rounded-full px-1.5">
                    {{ $tag->articles_count ?? 0 }}
                </span>
            </a>
        @endforeach


        <div class="bubble bubble-1"></div>
        <div class="bubble bubble-2"></div>
        <div class="bubble bubble-3"></div>
    </div>
</div>

    <div class="submarine-bubbles"></div>
</div>

@endsection
@section('styles')
<style>

.underwater-light {
    background: radial-gradient(ellipse at center, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 70%);
    animation: underwater-light-animation 8s infinite alternate;
}

@keyframes underwater-light-animation {
    0% { opacity: 0.1; transform: scale(1); }
    50% { opacity: 0.3; transform: scale(1.5); }
    100% { opacity: 0.1; transform: scale(1); }
}

.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.hover-ripple {
    position: relative;
    overflow: hidden;
}

.hover-ripple:after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at center, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0) 70%);
    transform: scale(0);
    opacity: 0;
    transition: transform 0.5s, opacity 0.5s;
}

.hover-ripple:hover:after {
    transform: scale(2);
    opacity: 0.3;
}

.wave-animation {
    position: relative;
    height: 20px;
    overflow: hidden;
}

.wave {
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' opacity='.25' fill='%230e7490'%3E%3C/path%3E%3Cpath d='M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z' opacity='.5' fill='%2306b6d4'%3E%3C/path%3E%3Cpath d='M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z' fill='%230ea5e9' opacity='.2'%3E%3C/path%3E%3C/svg%3E") repeat-x;
    position: absolute;
    width: 400%;
    height: 100%;
    animation: wave 15s linear infinite;
    bottom: 0;
}

.wave:nth-child(2) {
    animation-duration: 10s;
    animation-delay: -5s;
    opacity: 0.3;
}

.wave:nth-child(3) {
    animation-duration: 20s;
    opacity: 0.2;
}

@keyframes wave {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.bubble {
    position: absolute;
    background: radial-gradient(circle at center, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.4) 60%, rgba(255,255,255,0.1) 100%);
    border-radius: 50%;
}

.bubble-1 {
    width: 20px;
    height: 20px;
    right: 10%;
    bottom: 20px;
    opacity: 0.5;
    animation: bubble-rise 8s infinite ease-in-out;
}

.bubble-2 {
    width: 15px;
    height: 15px;
    right: 25%;
    bottom: 15px;
    opacity: 0.6;
    animation: bubble-rise 12s infinite ease-in-out 2s;
}

.bubble-3 {
    width: 10px;
    height: 10px;
    right: 40%;
    bottom: 10px;
    opacity: 0.7;
    animation: bubble-rise 10s infinite ease-in-out 4s;
}

@keyframes bubble-rise {
    0% { transform: translateY(0) scale(1); opacity: 0.7; }
    50% { transform: translateY(-50px) scale(1.1); opacity: 0.5; }
    100% { transform: translateY(-100px) scale(0.8); opacity: 0; }
}

.submarine-bubbles {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60px;
    overflow: hidden;
}

.submarine-bubbles:before,
.submarine-bubbles:after {
    content: '';
    position: absolute;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.4);
    bottom: 5px;
}

.submarine-bubbles:before {
    left: 30%;
    animation: bubble-up 3s infinite ease-in;
}

.submarine-bubbles:after {
    left: 70%;
    animation: bubble-up 3.5s infinite ease-in 1.5s;
}

@keyframes bubble-up {
    0% { transform: scale(0.5) translateY(0); opacity: 0; }
    20% { transform: scale(1) translateY(-20px); opacity: 0.8; }
    100% { transform: scale(0.5) translateY(-60px); opacity: 0; }
}

.tag-bubble {
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.tag-bubble:before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 150%;
    height: 150%;
    background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0) 70%);
    transform: translate(-50%, -50%) scale(0);
    transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: -1;
}

.tag-bubble:hover:before {
    transform: translate(-50%, -50%) scale(1);
}

.category-item {
    transition: transform 0.3s ease;
}

.category-item:hover {
    transform: translateX(5px);
}

.author-image {
    position: relative;
    animation: gentle-pulse 3s infinite alternate;
}

@keyframes gentle-pulse {
    0% { transform: scale(1); }
    100% { transform: scale(1.05); }
}

.underwater-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
}

.ocean-waves {
    background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1200 120' preserveAspectRatio='none'%3E%3Cpath d='M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z' fill='%23ffffff'%3E%3C/path%3E%3C/svg%3E");
    background-size: cover;
    background-repeat: no-repeat;
}

.floating-particles {
    background-image: radial-gradient(circle, rgba(255, 255, 255, 0.1) 2px, transparent 2px),
                     radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 30px 30px, 20px 20px;
    background-position: 0 0, 15px 15px;
    animation: float 20s linear infinite;
}

@keyframes float {
    0% { background-position: 0 0, 15px 15px; }
    100% { background-position: 30px 30px, 45px 45px; }
}

.article-featured-image-container {
    position: relative;
    overflow: hidden;
}

.article-featured-image {
    transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.article-featured-image-container:hover .article-featured-image {
    transform: scale(1.05);
}

.light-ripple {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at center, rgba(255, 255, 255, 0.6) 0%, transparent 70%);
    opacity: 0;
    transform: scale(0);
    transition: transform 1s, opacity 1s;
    pointer-events: none;
}

.article-featured-image-container:hover .light-ripple {
    transform: scale(1.5);
    opacity: 0.3;
}

.funfact-card {
    transform: translateY(20px);
    opacity: 0;
    animation: fade-in 0.6s ease-out forwards;
}

@keyframes fade-in {
    0% { transform: translateY(20px); opacity: 0; }
    100% { transform: translateY(0); opacity: 1; }
}

.reaction-button {
    position: relative;
    overflow: hidden;
}

.reaction-pulse:before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.3);
    animation: reaction-pulse 2s infinite;
}

@keyframes reaction-pulse {
    0% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(14, 165, 233, 0); }
    100% { box-shadow: 0 0 0 0 rgba(14, 165, 233, 0); }
}

.comment-card {
    opacity: 0;
    transform: translateY(20px);
    animation: comment-appear 0.5s ease-out forwards;
}

@keyframes comment-appear {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in-up {
    opacity: 0;
    transform: translateY(20px);
    animation: fade-in-up 0.8s ease-out forwards;
}

.animation-delay-200 {
    animation-delay: 0.2s;
}

.animation-delay-400 {
    animation-delay: 0.4s;
}

.animation-delay-600 {
    animation-delay: 0.6s;
}

.animation-delay-800 {
    animation-delay: 0.8s;
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.gradient-text-enhanced {
    background: linear-gradient(to right, #fff, #a5f3fc, #fff);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 0 10px rgba(165, 243, 252, 0.3);
}

.hover-card {
    animation: hover-appear 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(15px);
}

@keyframes hover-appear {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.underwater-pattern {
    background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5z' fill='%23ffffff' fill-opacity='0.15' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.2;
    animation: underwater-drift 60s linear infinite;
}

.light-ray {
    position: absolute;
    background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 75%);
    transform-origin: top center;
    width: 150px;
    height: 100%;
    border-radius: 50% 50% 0 0;
    opacity: 0;
    animation: light-ray-animation 12s infinite ease-in-out;
}

.light-ray-1 {
    left: 15%;
    animation-delay: 0s;
    transform: rotate(20deg);
}

.light-ray-2 {
    left: 50%;
    animation-delay: 4s;
    transform: rotate(-5deg);
}

.light-ray-3 {
    left: 75%;
    animation-delay: 8s;
    transform: rotate(-15deg);
}

@keyframes light-ray-animation {
    0%, 100% { opacity: 0; }
    25%, 75% { opacity: 0.5; }
    50% { opacity: 0.7; }
}

@keyframes underwater-drift {
    0% { background-position: 0 0; }
    100% { background-position: 100px 100px; }
}

.floating-particles {
    background-image:
        radial-gradient(circle, rgba(255, 255, 255, 0.2) 1px, transparent 1.5px),
        radial-gradient(circle, rgba(255, 255, 255, 0.15) 1px, transparent 1px),
        radial-gradient(circle, rgba(255, 255, 255, 0.1) 0.5px, transparent 0.5px);
    background-size: 50px 50px, 100px 100px, 30px 30px;
    background-position: 0 0, 25px 25px, 10px 10px;
    animation: particles-float 40s linear infinite;
}

@keyframes particles-float {
    0% { background-position: 0 0, 25px 25px, 10px 10px; }
    100% { background-position: 50px 50px, 125px 125px, 40px 40px; }
}

.bubble-container {
    pointer-events: none;
    overflow: hidden;
}
.animated-bubble {
    position: absolute;
    background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0.1) 100%);
    border-radius: 50%;
    opacity: 0;
    animation: bubble-rise 15s ease-in infinite;
}

.animated-bubble.size-lg {
    width: 30px;
    height: 30px;
    left: 15%;
    bottom: -30px;
}

.animated-bubble.size-md {
    width: 20px;
    height: 20px;
    left: 40%;
    bottom: -20px;
}

.animated-bubble.size-sm {
    width: 15px;
    height: 15px;
    left: 70%;
    bottom: -15px;
}

.animated-bubble.size-xs {
    width: 8px;
    height: 8px;
    left: 50%;
    bottom: -8px;
}

.animated-bubble.delay-1 { animation-delay: 1s; }
.animated-bubble.delay-2 { animation-delay: 2s; }
.animated-bubble.delay-3 { animation-delay: 3s; }
.animated-bubble.delay-4 { animation-delay: 4s; }
.animated-bubble.delay-5 { animation-delay: 5s; }

@keyframes bubble-rise {
    0% {
        transform: translateY(0) rotate(0);
        opacity: 0;
    }
    10% {
        opacity: 0.8;
    }
    100% {
        transform: translateY(-100vh) rotate(20deg);
        opacity: 0;
    }
}
</style>
@endsection
@section('scripts')
<script>
    function toggleReplyForm(formId) {
        const form = document.getElementById(formId);
        if (form) {
            form.classList.toggle('hidden');
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash) {
            setTimeout(function() {
                const targetElement = document.querySelector(window.location.hash);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }, 300);
        }
    });
</script>
@endsection
