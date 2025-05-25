@extends('layouts.admin')

@section('title', 'Lock Chat Management')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">{{ __('Chat Lock Management') }}: {{ $community->nama_komunitas }}</h1>
        <div>
            <a href="{{ route('admin.communities.chat.index', $community) }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-comments me-1"></i> {{ __('Go to Chat') }}
            </a>
            <a href="{{ route('admin.communities.show', $community) }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-1"></i> {{ __('Back to Community') }}
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">{{ __('Chat Status') }}</h5>
                </div>
                <div class="card-body">
                    <div class="chat-lock-status p-4 text-center">
                        @if($isChatLocked)
                            <div class="mb-4">
                                <div class="display-1 text-danger mb-3">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <h4 class="text-danger">{{ __('Chat is Currently Locked') }}</h4>
                                <p class="text-muted">{{ __('Locked by') }}: {{ $lockInfo->moderator->nama ?? 'Unknown' }}</p>
                                <p class="text-muted">{{ __('Locked at') }}: {{ $lockInfo->locked_at->format('M j, Y g:i A') }}</p>

                                <p class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ __('Only moderators can post messages while chat is locked.') }}
                                </p>
                            </div>

                            <form action="{{ route('admin.communities.lock-chat', $community) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-unlock me-2"></i> {{ __('Unlock Chat') }}
                                </button>
                            </form>
                        @else
                            <div class="mb-4">
                                <div class="display-1 text-success mb-3">
                                    <i class="fas fa-unlock"></i>
                                </div>
                                <h4 class="text-success">{{ __('Chat is Currently Unlocked') }}</h4>
                                <p class="text-muted">{{ __('All community members can participate in the chat.') }}</p>
                            </div>

                            <form action="{{ route('admin.communities.lock-chat', $community) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-lg">
                                    <i class="fas fa-lock me-2"></i> {{ __('Lock Chat') }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">{{ __('When to Lock Chat?') }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-fire-extinguisher fa-2x"></i>
                            </div>
                            <div>
                                <h5>{{ __('Emergency Situations') }}</h5>
                                <p class="text-muted mb-0">{{ __('Lock chat when there spam, harassment, or other urgent issues requiring immediate intervention.') }}</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-bullhorn fa-2x"></i>
                            </div>
                            <div>
                                <h5>{{ __('Important Announcements') }}</h5>
                                <p class="text-muted mb-0">{{ __('Lock chat temporarily when making important announcements to ensure visibility.') }}</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-user-shield fa-2x"></i>
                            </div>
                            <div>
                                <h5>{{ __('Moderator Actions') }}</h5>
                                <p class="text-muted mb-0">{{ __('Lock chat while performing major moderation actions or community restructuring.') }}</p>
                            </div>
                        </li>
                        <li class="list-group-item d-flex">
                            <div class="me-3 text-primary">
                                <i class="fas fa-moon fa-2x"></i>
                            </div>
                            <div>
                                <h5>{{ __('Community Cooldown') }}</h5>
                                <p class="text-muted mb-0">{{ __('Lock chat temporarily when discussions become heated and need time to cool down.') }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
