@if(count($messages) > 0)
    @foreach($messages as $message)
        <div class="message mb-3" data-message-id="{{ $message->id }}" data-user-id="{{ $message->user_id }}">
            <div class="d-flex">
                <div class="message-avatar me-2">
                    <img src="{{ $message->user->avatar ?? '/images/default-avatar.png' }}" alt="{{ $message->user->nama }}" class="rounded-circle" width="40" height="40">
                </div>
                <div class="message-content flex-grow-1">
                    <div class="message-header d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold">{{ $message->user->nama }}</span>
                            @php
                                $roleClass = $message->user->role === 'admin' ? 'bg-danger' :
                                           ($message->user->role === 'moderator' ? 'bg-primary' : 'bg-secondary');
                            @endphp
                            <span class="badge {{ $roleClass }} ms-2">{{ $message->user->role ?? 'member' }}</span>
                        </div>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="message-body">
                        <div class="message-text">{{ $message->isi_pesan }}</div>

                        @if($message->attachment)
                            <div class="message-attachments mt-2">
                                @if($message->attachment_type == 'image')
                                    <div class="message-image">
                                        <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $message->attachment) }}" class="img-fluid rounded" alt="Attachment" style="max-height: 200px;">
                                        </a>
                                    </div>
                                @else
                                    <div class="message-file d-flex align-items-center border rounded p-2">
                                        <i class="fas fa-file me-2"></i>
                                        <span>{{ $message->attachment_name ?: basename($message->attachment) }}</span>
                                        <div class="ms-auto">
                                            <a href="{{ asset('storage/' . $message->attachment) }}" class="btn btn-sm btn-outline-secondary me-1" target="_blank" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                            @if(Auth::user()->can('moderate', $community))
                                                <span class="badge bg-warning text-dark" title="Please review this file">
                                                    <i class="fas fa-exclamation-triangle"></i> {{ __('Review') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="message-footer small mt-1 d-flex justify-content-between align-items-center">
                        <div>
                            @if($message->is_edited)
                                <span class="message-edited text-muted">
                                    <i class="fas fa-pen-fancy"></i> {{ __('edited') }}
                                </span>
                            @endif
                        </div>
                        <div>
                            @if(Auth::user()->can('moderate', $community) || $message->user_id == Auth::id())
                                <form action="{{ route('admin.communities.messages.delete', $message->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0"
                                            onclick="return confirm('{{ __('Are you sure you want to delete this message?') }}');">
                                        <i class="fas fa-trash-alt"></i> {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center p-5">
        <div class="mb-3">
            <i class="fas fa-comments fa-3x text-muted"></i>
        </div>
        <p class="lead text-muted">{{ __('No messages yet. Be the first to say something!') }}</p>
    </div>
@endif
