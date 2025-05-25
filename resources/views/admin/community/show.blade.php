<!-- resources/views/communities/show.blade.php -->
@extends('layouts.app')

@section('title', $community->nama_komunitas)

@section('content')
<div class="container py-4">
    <!-- Community Header -->
    <div class="bg-white rounded shadow-sm p-4 mb-4">
        <div class="row">
            <div class="col-md-3 text-center mb-3 mb-md-0">
                @if($community->gambar)
                    <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="img-fluid rounded" style="max-height: 180px;">
                @else
                    <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center p-5" style="height: 180px;">
                        <i class="fas fa-users fa-5x"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-start">
                    <h1 class="mb-2">{{ $community->nama_komunitas }}</h1>
                    @auth
                        @if($isMember)
                            <form action="{{ route('communities.leave', $community) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-sign-out-alt"></i> {{ __('Leave') }}
                                </button>
                            </form>
                        @else
                            <a href="{{ route('communities.join.show', $community) }}" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt"></i> {{ __('Join') }}
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-muted mb-3">
                    <i class="fas fa-users mr-1"></i> {{ $community->users->count() }} {{ __('members') }}
                    <span class="mx-2">|</span>
                    <i class="fas fa-calendar-alt mr-1"></i> {{ __('Created') }} {{ $community->created_at->format('M d, Y') }}
                </p>

                <div class="community-description mb-3">
                    {!! Str::limit(strip_tags($community->deskripsi), 200) !!}
                    @if(strlen(strip_tags($community->deskripsi)) > 200)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#descriptionModal">{{ __('Read more') }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Content Area -->
        <div class="col-lg-8">
            <!-- Add this link in admin.community.show.blade.php where appropriate -->
        @if(Auth::check() && Auth::user()->can('moderate', $community))
        <a href="{{ route('admin.communities.moderation', $community) }}" class="btn btn-warning">
        <i class="fas fa-gavel"></i> {{ __('Moderation Tools') }}
       </a>
       @endif
            @if($isMember || Auth::user()->can('moderate', $community))
                <!-- Chat Section -->
                @include('communities.chat', ['community' => $community, 'messages' => $messages, 'members' => $members])
            @else
                <!-- Preview for non-members -->
                <div class="bg-white rounded shadow-sm p-4 mb-4">
                    <div class="text-center py-5">
                        <i class="fas fa-lock fa-4x text-muted mb-3"></i>
                        <h3>{{ __('Join this community to participate') }}</h3>
                        <p class="lead text-muted mb-4">{{ __('Connect with other members and join the conversation.') }}</p>

                        @auth
                            <a href="{{ route('communities.join', $community) }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt"></i> {{ __('Join Now') }}
                            </a>
                        @else
                            <div>
                                <a href="{{ route('login') }}" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> {{ __('Login to join') }}
                                </a>
                                <span class="mx-2">{{ __('or') }}</span>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-user-plus"></i> {{ __('Register') }}
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Members Section -->
            <div class="bg-white rounded shadow-sm p-4 mb-4">
                <h5 class="border-bottom pb-2 mb-3">
                    <i class="fas fa-users"></i> {{ __('Members') }}
                    <span class="badge bg-primary rounded-pill">{{ $community->users->count() }}</span>
                </h5>

                <div class="members-list">
                    @foreach($community->users->take(10) as $member)
                        <div class="d-flex align-items-center mb-2">
                            @if($member->foto_profil)
                                <img src="{{ asset('storage/' . $member->foto_profil) }}" class="rounded-circle mr-2" width="32" height="32" alt="{{ $member->nama }}">
                            @else
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 32px; height: 32px;">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                            <div class="ml-2">
                                <span class="fw-bold">{{ $member->nama }}</span>
                                <small class="text-muted d-block">{{ __('Joined') }} {{ $member->pivot->tg_gabung->diffForHumans() }}</small>
                            </div>
                        </div>
                    @endforeach

                    @if($community->users->count() > 10)
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#allMembersModal">
                                {{ __('View all members') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Community Info -->
            <div class="bg-white rounded shadow-sm p-4">
                <h5 class="border-bottom pb-2 mb-3">
                    <i class="fas fa-info-circle"></i> {{ __('Community Info') }}
                </h5>

                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-calendar-alt text-muted"></i>
                        <strong>{{ __('Created:') }}</strong> {{ $community->created_at->format('F d, Y') }}
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-comments text-muted"></i>
                        <strong>{{ __('Messages:') }}</strong> {{ $community->messages->count() }}
                    </li>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <li class="mt-3">
                            <a href="{{ route('admin.communities.edit', $community) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-edit"></i> {{ __('Edit Community') }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- All Members Modal -->
<div class="modal fade" id="allMembersModal" tabindex="-1" aria-labelledby="allMembersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="allMembersModalLabel">{{ __('All Members') }} - {{ $community->nama_komunitas }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($community->users as $member)
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                @if($member->foto_profil)
                                    <img src="{{ asset('storage/' . $member->foto_profil) }}" class="rounded-circle mr-2" width="40" height="40" alt="{{ $member->nama }}">
                                @else
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                                <div class="ml-2">
                                    <span class="fw-bold">{{ $member->nama }}</span>
                                    <small class="text-muted d-block">{{ __('Joined') }} {{ $member->pivot->tg_gabung->format('M d, Y') }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Description Modal -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">{{ $community->nama_komunitas }} - {{ __('Description') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $community->deskripsi !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any needed scripts for the community page
    });
</script>
@endsection
