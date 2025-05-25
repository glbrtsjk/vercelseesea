@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <a href="{{ route('communities.show', $community) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> {{ __('Back to Community') }}
                </a>
            </div>

            <div class="chat-container bg-white rounded shadow-sm mb-4">
                <div class="chat-header p-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-comments"></i> {{ __('Community Chat') }}
                    </h5>
                    <div class="d-flex gap-2">
                        @if(Auth::user()->can('moderate', $community))
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="moderationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-shield-alt"></i> {{ __('Moderate') }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moderationDropdown">
                                <li>
                                    <form action="{{ route('communities.lock-chat', $community) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            @if($community->isLocked())
                                            <i class="fas fa-unlock"></i> {{ __('Unlock Chat') }}
                                            @else
                                            <i class="fas fa-lock"></i> {{ __('Lock Chat') }}
                                            @endif
                                        </button>
                                    </form>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('communities.moderation', $community) }}">
                                    <i class="fas fa-cog"></i> {{ __('Moderation Dashboard') }}
                                </a></li>
                            </ul>
                        </div>
                        @endif
                        <a href="{{ route('communities.chat', $community) }}" class="btn btn-sm btn-outline-secondary" title="{{ __('Refresh chat') }}">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </div>
                </div>

                <div class="messages-container p-3" id="messagesContainer" style="height: 450px; overflow-y: auto;">
                    @include('admin.community.chat.massage')
                </div>

                <div class="chat-footer p-3 border-top">
                    @include('admin.community.chat.massage-form')
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
</script>
@endsection
