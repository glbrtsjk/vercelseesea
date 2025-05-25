@extends('layouts.app')

@section('title', $community->nama_komunitas . ' - ' . __('Chat'))

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('communities.show', $community) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> {{ __('Back to Community') }}
                </a>

                @if(isset($canModerate) && $canModerate)
                <a href="{{ route('admin.communities.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-cog me-1"></i> {{ __('Admin Dashboard') }}
                </a>
                @endif
            </div>

            <div class="chat-container bg-white rounded shadow-sm mb-4">
                <div class="chat-header p-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-comments me-1"></i> {{ $community->nama_komunitas }} - {{ __('Chat') }}
                        @if(isset($isChatLocked) && $isChatLocked)
                            <span class="badge bg-warning text-dark ms-2">
                                <i class="fas fa-lock me-1"></i> {{ __('Locked') }}
                            </span>
                        @endif
                    </h5>
                    <div class="d-flex gap-2">
                        @if(isset($canModerate) && $canModerate)
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="moderationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shield-alt me-1"></i> {{ __('Moderate') }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moderationDropdown">
                                <li>
                                    <form action="{{ route('communities.lock-chat', $community) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            @if(isset($isChatLocked) && $isChatLocked)
                                            <i class="fas fa-unlock me-1"></i> {{ __('Unlock Chat') }}
                                            @else
                                            <i class="fas fa-lock me-1"></i> {{ __('Lock Chat') }}
                                            @endif
                                        </button>
                                    </form>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('communities.moderation', $community) }}">
                                        <i class="fas fa-cog me-1"></i> {{ __('Moderation Dashboard') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endif
                        <a href="{{ route('communities.chat', $community) }}" class="btn btn-sm btn-outline-secondary" title="{{ __('Refresh chat') }}">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                </div>

                <div class="messages-container p-3" id="messagesContainer" style="height: 450px; overflow-y: auto;">
                    @forelse($messages as $message)
                        <div class="chat-message mb-3 {{ $message->user_id == Auth::id() ? 'text-end' : '' }}">
                            <div class="message-header d-flex {{ $message->user_id == Auth::id() ? 'justify-content-end' : 'justify-content-start' }} align-items-center mb-1">
                                <div class="d-flex align-items-center">
                                    @if($message->user_id != Auth::id())
                                        <div class="avatar me-2">
                                            @if($message->user->avatar)
                                                <img src="{{ asset('storage/' . $message->user->avatar) }}" class="rounded-circle" width="32" height="32" alt="{{ $message->user->name }}">
                                            @else
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:32px;height:32px">
                                                    {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif

                                    <small class="text-muted">
                                        <strong>{{ $message->user->name }}</strong>
                                        <span class="ms-1">{{ $message->tgl_pesan->format('M d, H:i') }}</span>
                                    </small>

                                    @if($message->user_id == Auth::id())
                                        <div class="avatar ms-2">
                                            @if($message->user->avatar)
                                                <img src="{{ asset('storage/' . $message->user->avatar) }}" class="rounded-circle" width="32" height="32" alt="{{ $message->user->name }}">
                                            @else
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:32px;height:32px">
                                                    {{ strtoupper(substr($message->user->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="message-content">
                                <div class="d-inline-block {{ $message->user_id == Auth::id() ? 'bg-primary text-white' : 'bg-light' }} rounded p-2 px-3">
                                    {{ $message->konten }}
                                </div>

                                @if(isset($canModerate) && $canModerate)
                                <div class="message-actions mt-1 {{ $message->user_id == Auth::id() ? 'text-end' : '' }}">
                                    <form action="{{ route('communities.messages.delete', [$community, $message]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-danger p-0" onclick="return confirm('{{ __('Are you sure you want to delete this message?') }}')">
                                            <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <p>{{ __('No messages yet. Be the first to start the conversation!') }}</p>
                        </div>
                    @endforelse
                </div>

                <div class="chat-footer p-3 border-top">
                    @if(!isset($isChatLocked) || !$isChatLocked || (isset($canModerate) && $canModerate))
                        <form action="{{ route('communities.messages.store', $community) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <textarea class="form-control" name="konten" rows="1" placeholder="{{ __('Type your message...') }}" required></textarea>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>

                            @error('konten')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </form>
                    @else
                        <div class="text-center text-muted py-2">
                            <i class="fas fa-lock me-1"></i>
                            {{ __('Chat is currently locked by a moderator.') }}
                            @if(isset($lockInfo) && isset($lockInfo->lockedBy))
                                <small class="d-block mt-1">{{ __('Locked by') }}: {{ $lockInfo->lockedBy->name }} ({{ $lockInfo->created_at->diffForHumans() }})</small>
                            @endif
                        </div>
                    @endif
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

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Auto-scroll to bottom on load
    window.addEventListener('load', function() {
        const messagesContainer = document.getElementById('messagesContainer');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });

    // Auto-resize textarea
    document.addEventListener('DOMContentLoaded', function() {
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });
        });
    });
</script>
@endsection
