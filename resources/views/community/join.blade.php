<!-- resources/views/communities/join.blade.php -->
@extends('layouts.app')

@section('title', 'Join ' . $community->nama_komunitas)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Join Community: {{ $community->nama_komunitas }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            @if($community->gambar)
                                <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}" class="img-fluid rounded" style="max-height: 150px;">
                            @else
                                <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center p-5" style="height: 150px;">
                                    <i class="fas fa-users fa-4x"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h4>{{ $community->nama_komunitas }}</h4>
                            <p class="text-muted">
                                <i class="fas fa-users mr-1"></i> {{ $community->users->count() }} {{ __('members') }}
                                <span class="mx-2">|</span>
                                <i class="fas fa-calendar-alt mr-1"></i> {{ __('Created') }} {{ $community->created_at->format('M d, Y') }}
                            </p>
                            <div class="community-description mb-3">
                                <p>{!! Str::limit(strip_tags($community->deskripsi), 150) !!}</p>
                                @if(strlen(strip_tags($community->deskripsi)) > 150)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#descriptionModal">{{ __('Read more') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ __('Community Guidelines') }}</h6>
                        </div>
                        <div class="card-body">
                            <ul class="mb-0">
                                <li>{{ __('Be respectful to all community members') }}</li>
                                <li>{{ __('Do not post offensive or harmful content') }}</li>
                                <li>{{ __('Keep discussions relevant to community topics') }}</li>
                                <li>{{ __('Respect privacy and confidentiality of others') }}</li>
                                <li>{{ __('Follow the community rules and moderator instructions') }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="community-actions text-center">
                        <p>{{ __('By joining this community, you agree to follow the community guidelines.') }}</p>
                        if(<form action="{{ route('communities.chat', $community) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt mr-1"></i> {{ __('Join Chat') }}
                            </button>
                        </form>
                        <div class="mt-3">
                            <a href="{{ route('communities.show', $community) }}" class="text-decoration-none">
                                <i class="fas fa-arrow-left mr-1"></i> {{ __('Return to community page') }}
                            </a>
                        </div>
                    </div>
                </div>
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
