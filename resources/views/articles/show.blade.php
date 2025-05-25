@extends('layouts.app')

@section('content')
<!-- Article Header -->
<div class="bg-gradient-to-r from-blue-700 to-blue-900 text-white py-6">
    <div class="container mx-auto px-4">
        <div class="flex items-center mb-4">
            <a href="{{ route('articles.index') }}" class="flex items-center text-blue-200 hover:text-white mr-4">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Articles
            </a>
            <span class="text-blue-200">|</span>
            <a href="{{ route('articles.index', ['category' => $article->category->category_id]) }}" class="ml-4 text-blue-200 hover:text-white">
                {{ $article->category->nama_kategori }}
            </a>
        </div>
        <h1 class="text-3xl md:text-4xl font-bold">{{ $article->judul }}</h1>
        <div class="flex items-center mt-4 text-sm">
            <div class="flex items-center">
                <img src="{{ $article->user->profile_photo_url }}" alt="{{ $article->user->nama }}" class="w-8 h-8 rounded-full mr-2">
                <span>{{ $article->user->nama }}</span>
            </div>
            <span class="mx-2">•</span>
            <span>{{ $article->tgl_upload->format('M d, Y') }}</span>
            <span class="mx-2">•</span>
            <div class="flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ $article->tgl_upload->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Article Content -->
        <div class="lg:w-2/3">
            <!-- Featured Image -->
            @if($article->gambar)
                <div class="mb-8">
                    <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-auto max-h-96 object-cover rounded-lg">
                </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none mb-8">
                {!! $article->konten_isi_artikel !!}
            </div>

            <!-- Article Tags -->
            @if($article->tags->count() > 0)
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                            <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-sm transition duration-300">
                                #{{ $tag->nama_tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Fun Facts Section -->
            @if($article->funfacts->count() > 0)
                <div class="bg-blue-50 p-6 rounded-lg mb-8">
                    <h3 class="text-xl font-bold text-blue-800 mb-4">Fun Facts</h3>
                    <div class="space-y-4">
                        @foreach($article->funfacts as $funfact)
                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                <h4 class="font-medium text-blue-700 mb-1">{{ $funfact->judul }}</h4>
                                <p class="text-gray-700">{{ $funfact->konten }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Reactions Section -->
           <!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\articles\show.blade.php -->
<!-- Reactions Section -->
<div class="mb-8" id="reactions">
    <h3 class="text-lg font-bold text-gray-800 mb-4">Reactions</h3>
    <div class="flex flex-wrap gap-3">
        @php
            $reactionTypes = ['like', 'love', 'wow', 'sad', 'angry'];
            $reactionIcons = [
                'like' => 'M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5',
                'love' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                'wow' => 'M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z',
                'sad' => 'M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'angry' => 'M13 10V3L4 14h7v7l9-11h-7z'
            ];

            // Get the current user's reaction if any
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

                    <button type="submit" class="flex flex-col items-center p-2 rounded-lg hover:bg-gray-100 transition duration-300">
                        <div class="w-8 h-8 flex items-center justify-center {{ $userReaction && $userReaction->jenis_reaksi === $type ? 'text-blue-600' : 'text-gray-600' }}">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $reactionIcons[$type] }}"></path>
                            </svg>
                        </div>
                        <span class="text-xs mt-1 capitalize">{{ $type }}</span>
                        <span class="text-xs font-bold">{{ $article->reactions->where('jenis_reaksi', $type)->count() }}</span>
                    </button>
                </form>
            @endforeach
        @else
            <!-- Display read-only reactions for guests -->
            @foreach($reactionTypes as $type)
                <div class="flex flex-col items-center p-2">
                    <div class="w-8 h-8 flex items-center justify-center text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $reactionIcons[$type] }}"></path>
                        </svg>
                    </div>
                    <span class="text-xs mt-1 capitalize">{{ $type }}</span>
                    <span class="text-xs font-bold">{{ $article->reactions->where('jenis_reaksi', $type)->count() }}</span>
                </div>
            @endforeach

            <div class="ml-2 text-sm text-gray-500">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> to react
            </div>
        @endauth
    </div>

    @if($article->reactions->count() > 0)
        <div class="mt-2">
            <a href="{{ route('reactions.show', ['type' => 'article', 'id' => $article->article_id]) }}" class="text-sm text-blue-600 hover:underline">
                View all {{ $article->reactions->count() }} reactions
            </a>
        </div>
    @endif
</div>

            <!-- Comments Section -->

<!-- Inside your comments section, after the comment content but before the reply section -->
<div id="comments" class="mb-8">

    <div class="space-y-6">
        @forelse($article->comments as $comment)
            <div class="bg-gray-50 p-4 rounded-lg" id="comment-{{ $comment->comment_id }}">
                <div class="flex items-start mb-2">
                    <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->nama }}" class="w-10 h-10 rounded-full mr-3">
                    <div class="flex-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="font-medium text-gray-800">{{ $comment->user->nama }}</h4>
                                <p class="text-xs text-gray-500">{{ $comment->tgl_komen->format('M d, Y \a\t H:i') }}</p>
                            </div>
                            @auth
                                @if(Auth::id() == $comment->user_id || Auth::user()->isAdmin())
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        <div class="mt-2 text-gray-700">
                            {{ $comment->konten }}
                        </div>

                        <!-- Like/Dislike buttons for comments -->
                        <div class="flex items-center mt-3 space-x-4">
                            @auth
                                <div class="flex items-center space-x-3">
                                    <!-- Like button -->
                                    <form action="{{ route('likes.store') }}" method="POST" class="inline-flex">
                                        @csrf
                                        <input type="hidden" name="type" value="like">
                                        <input type="hidden" name="model_type" value="App\Models\Comment">
                                        <input type="hidden" name="model_id" value="{{ $comment->comment_id }}">
                                        <input type="hidden" name="redirect_url" value="{{ $currentUrl }}">
                                        <input type="hidden" name="fragment" value="comment-{{ $comment->comment_id }}">

                                        <button type="submit" class="flex items-center text-sm {{ $comment->isLikedBy(Auth::id()) ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-blue-600' }}">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                            </svg>
                                            <span>{{ $comment->likes_count ?? 0 }}</span>
                                        </button>
                                    </form>

                                    <!-- Dislike button -->
                                    <form action="{{ route('likes.store') }}" method="POST" class="inline-flex">
                                        @csrf
                                        <input type="hidden" name="type" value="dislike">
                                        <input type="hidden" name="model_type" value="App\Models\Comment">
                                        <input type="hidden" name="model_id" value="{{ $comment->comment_id }}">
                                        <input type="hidden" name="redirect_url" value="{{ $currentUrl }}">
                                        <input type="hidden" name="fragment" value="comment-{{ $comment->comment_id }}">

                                        <button type="submit" class="flex items-center text-sm {{ $comment->isDislikedBy(Auth::id()) ? 'text-red-600 font-medium' : 'text-gray-500 hover:text-red-600' }}">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a.937.937 0 01.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13v-9m-7 10h2m5 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2.5"></path>
                                            </svg>
                                            <span>{{ $comment->dislikes_count ?? 0 }}</span>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <!-- Read-only likes/dislikes for guests -->
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                        </svg>
                                        <span>{{ $comment->likes_count ?? 0 }}</span>
                                    </div>

                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a.937.937 0 01.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13v-9m-7 10h2m5 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2.5"></path>
                                        </svg>
                                        <span>{{ $comment->dislikes_count ?? 0 }}</span>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Reply button and existing replies -->
                <div class="ml-12">
                    @auth
                        <button onclick="toggleReplyForm('reply-form-{{ $comment->comment_id }}')" class="text-blue-600 hover:text-blue-800 text-sm mb-2">Reply</button>

                        <div id="reply-form-{{ $comment->comment_id }}" class="mb-3 hidden">
                            <form action="{{ route('comments.replies.store', $comment) }}" method="POST">
                                @csrf
                                <div class="mb-2">
                                    <textarea name="konten" rows="2" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Write your reply..."></textarea>
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 text-sm rounded hover:bg-blue-700 transition duration-300">Reply</button>
                                </div>
                            </form>
                        </div>
                    @endauth

                    @if($comment->replies->count() > 0)
                        <div class="space-y-3 mt-3">
                            @foreach($comment->replies as $reply)
                                <div class="bg-white p-3 rounded-lg" id="reply-{{ $reply->reply_id }}">
                                    <div class="flex items-start">
                                        <img src="{{ $reply->user->profile_photo_url }}" alt="{{ $reply->user->nama }}" class="w-8 h-8 rounded-full mr-2">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <h5 class="font-medium text-gray-800 text-sm">{{ $reply->user->nama }}</h5>
                                                    <p class="text-xs text-gray-500">{{ $reply->tgl_reply->format('M d, Y \a\t H:i') }}</p>
                                                </div>
                                                @auth
                                                    @if(Auth::id() == $reply->user_id || Auth::user()->isAdmin())
                                                        <form action="{{ route('comments.replies.destroy', [$comment, $reply]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endauth
                                            </div>
                                            <div class="mt-1 text-gray-700 text-sm">
                                                {{ $reply->konten }}
                                            </div>

                                            <!-- Like/Dislike buttons for replies -->
                                            <div class="flex items-center mt-2 space-x-4">
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

                                                            <button type="submit" class="flex items-center text-xs {{ $reply->isLikedBy(Auth::id()) ? 'text-blue-600 font-medium' : 'text-gray-500 hover:text-blue-600' }}">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                                </svg>
                                                                <span>{{ $reply->likes_count ?? 0 }}</span>
                                                            </button>
                                                        </form>

                                                        <!-- Dislike button -->
                                                        <form action="{{ route('likes.store') }}" method="POST" class="inline-flex">
                                                            @csrf
                                                            <input type="hidden" name="type" value="dislike">
                                                            <input type="hidden" name="model_type" value="App\Models\CommentReply">
                                                            <input type="hidden" name="model_id" value="{{ $reply->reply_id }}">
                                                            <input type="hidden" name="redirect_url" value="{{ $currentUrl }}">
                                                            <input type="hidden" name="fragment" value="reply-{{ $reply->reply_id }}">

                                                            <button type="submit" class="flex items-center text-xs {{ $reply->isDislikedBy(Auth::id()) ? 'text-red-600 font-medium' : 'text-gray-500 hover:text-red-600' }}">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a.937.937 0 01.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905 0-.714.211-1.412.608-2.006L17 13v-9m-7 10h2m5 0h2a2 2 0 002-2v-6a2 2 0 00-2-2h-2.5"></path>
                                                                </svg>
                                                                <span>{{ $reply->dislikes_count ?? 0 }}</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @else
                                                    <!-- Read-only likes/dislikes for guests -->
                                                    <div class="flex items-center space-x-2">
                                                        <div class="flex items-center text-xs text-gray-500">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                            </svg>
                                                            <span>{{ $reply->likes_count ?? 0 }}</span>
                                                        </div>

                                                        <div class="flex items-center text-xs text-gray-500">
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
        @empty
            <div class="text-center py-4">
                <p class="text-gray-500">No comments yet. Be the first to comment!</p>
            </div>
        @endforelse
    </div>
</div>
        </div>

        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Author Card -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">About the Author</h3>
                <div class="flex items-center mb-4">
                    <img src="{{ $article->user->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="{{ $article->user->nama }}" class="w-16 h-16 rounded-full mr-4">
                        <div>
                        <h4 class="font-bold text-gray-800">{{ $article->user->nama }}</h4>
                        <p class="text-gray-600 text-sm">Member since {{ $article->user->created_at->format('M Y') }}</p>
                    </div>
                </div>
                @if($article->user->deskripsi)
                    <p class="text-gray-700 mb-4">{{ $article->user->deskripsi }}</p>
                @endif
                <a href="{{ route('users.show', $article->user) }}" class="inline-block text-blue-600 hover:text-blue-800 font-medium">View Profile</a>
            </div>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Related Articles</h3>
                    <div class="space-y-4">
                        @foreach($relatedArticles as $relatedArticle)
                            <div class="flex items-start">
                                <a href="{{ route('articles.show', $relatedArticle) }}" class="block w-20 h-16 bg-gray-200 rounded overflow-hidden mr-3">
                                    @if($relatedArticle->gambar)
                                        <img src="{{ Storage::url($relatedArticle->gambar) }}" alt="{{ $relatedArticle->judul }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </a>
                                <div>
                                    <a href="{{ route('articles.show', $relatedArticle) }}" class="text-gray-800 font-medium hover:text-blue-600 transition duration-300">{{ $relatedArticle->judul }}</a>
                                    <p class="text-xs text-gray-500 mt-1">{{ $relatedArticle->tgl_upload->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Categories Widget -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Categories</h3>
                <ul class="space-y-2">
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('articles.index', ['category' => $category->category_id]) }}" class="flex items-center text-gray-700 hover:text-blue-600 transition duration-300">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $category->nama_kategori }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Popular Tags -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Popular Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($tags as $tag)
                        <a href="{{ route('articles.index', ['tag' => $tag->tag_id]) }}" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full text-sm transition duration-300">
                            #{{ $tag->nama_tag }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleReplyForm(formId) {
        const form = document.getElementById(formId);
        form.classList.toggle('hidden');
    }
</script>
@endpush

@endsection
