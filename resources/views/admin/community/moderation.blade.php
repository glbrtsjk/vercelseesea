<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\community\moderation.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">{{ __('Community Moderation') }}: {{ $community->nama_komunitas }}</h1>
        <a href="{{ route('admin.communities.show', $community) }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-1"></i> {{ __('Back to Community') }}
        </a>
    </div>

    <div class="row">
        <!-- Chat Lock Status -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">{{ __('Chat Lock Status') }}</h5>

                    <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title mb-0">{{ __('Chat Lock Status') }}</h5>
           <a href="{{ route('admin.communities.lock-chat', $community) }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-cog me-1"></i> {{ __('Manage Lock') }}
           </a>
           </div>
                </div>
                <div class="card-body">
                    <div id="lockStatusContainer">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button id="toggleChatLock" class="btn btn-primary" data-locked="false">
                            <i class="fas fa-lock me-1"></i> {{ __('Lock Chat') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Moderation Actions -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0">{{ __('User Moderation') }}</h5>
                </div>
                <div class="card-body">
                    <form id="moderateUserForm" class="mb-3">
                        <div class="mb-3">
                            <label for="userSelect" class="form-label">{{ __('Select User') }}</label>
                            <select class="form-select" id="userSelect" required>
                                <option value="" selected disabled>{{ __('-- Select a user --') }}</option>
                                @foreach($community->users as $user)
                                    @if(!$user->can('moderate', $community))
                                        <option value="{{ $user->user_id }}" data-name="{{ $user->nama }}">{{ $user->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-warning" id="muteUserBtn">
                                <i class="fas fa-microphone-slash me-1"></i> {{ __('Mute') }}
                            </button>
                            <button type="button" class="btn btn-danger" id="banUserBtn">
                                <i class="fas fa-ban me-1"></i> {{ __('Ban') }}
                            </button>
                        </div>
                    </form>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-1"></i> {{ __('Muting temporarily prevents a user from posting messages. Banning removes them from the community.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Banned Users -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('Banned Users') }}</h5>
                    <button class="btn btn-sm btn-outline-secondary" id="refreshBannedBtn">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div id="bannedUsersContainer">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Muted Users -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('Muted Users') }}</h5>
                    <button class="btn btn-sm btn-outline-secondary" id="refreshMutedBtn">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div id="mutedUsersContainer">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="community-id" value="{{ $community->community_id }}">
</div>

<!-- Mute User Modal -->
<div class="modal fade" id="muteModal" tabindex="-1" aria-labelledby="muteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="muteModalLabel">{{ __('Mute User') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="muteForm">
                    <input type="hidden" id="muteUserId">
                    <div class="mb-3">
                        <label for="muteDuration" class="form-label">{{ __('Mute Duration (minutes)') }}</label>
                        <input type="number" class="form-control" id="muteDuration" min="1" max="1440" value="60" required>
                        <div class="form-text">{{ __('Enter duration between 1 minute and 24 hours (1440 minutes)') }}</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-warning" id="confirmMute">{{ __('Mute User') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Ban User Modal -->
<div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="banModalLabel">{{ __('Ban User') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="banForm">
                    <input type="hidden" id="banUserId">
                    <div class="mb-3">
                        <label for="banReason" class="form-label">{{ __('Ban Reason (optional)') }}</label>
                        <textarea class="form-control" id="banReason" rows="3"></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        {{ __('Banning a user will permanently remove them from this community until manually unbanned.') }}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-danger" id="confirmBan">{{ __('Ban User') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/community-moderation.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const muteModal = new bootstrap.Modal(document.getElementById('muteModal'));
    const banModal = new bootstrap.Modal(document.getElementById('banModal'));

    // Mute button handling
    document.getElementById('muteUserBtn').addEventListener('click', function() {
        const selectElement = document.getElementById('userSelect');
        if (selectElement.value) {
            document.getElementById('muteUserId').value = selectElement.value;
            muteModal.show();
        } else {
            alert('Please select a user first');
        }
    });

    // Ban button handling
    document.getElementById('banUserBtn').addEventListener('click', function() {
        const selectElement = document.getElementById('userSelect');
        if (selectElement.value) {
            document.getElementById('banUserId').value = selectElement.value;
            banModal.show();
        } else {
            alert('Please select a user first');
        }
    });

    // Confirm mute action
    document.getElementById('confirmMute').addEventListener('click', function() {
        const userId = document.getElementById('muteUserId').value;
        const duration = document.getElementById('muteDuration').value;
        const selectElement = document.getElementById('userSelect');
        const username = selectElement.options[selectElement.selectedIndex].dataset.name;

        if (!duration || isNaN(duration) || duration < 1 || duration > 1440) {
            alert('Please enter a valid duration between 1 and 1440 minutes');
            return;
        }

        muteModal.hide();
        muteUser(userId, username, duration);
    });

    // Confirm ban action
    document.getElementById('confirmBan').addEventListener('click', function() {
        const userId = document.getElementById('banUserId').value;
        const reason = document.getElementById('banReason').value;
        const selectElement = document.getElementById('userSelect');
        const username = selectElement.options[selectElement.selectedIndex].dataset.name;

        banModal.hide();
        banUser(userId, username, reason);
    });

    // Refresh buttons
    document.getElementById('refreshBannedBtn').addEventListener('click', function() {
        loadBannedUsers();
    });

    document.getElementById('refreshMutedBtn').addEventListener('click', function() {
        loadMutedUsers();
    });
});
</script>
@endsection
