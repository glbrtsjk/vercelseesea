@extends('layouts.app')

@section('title', 'Communities')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">{{ __('Communities') }}</h1>

        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.communities.index') }}" class="btn btn-primary">
                    <i class="fas fa-cog me-1"></i> {{ __('Manage Communities') }}
                </a>
            @endif
        @endauth
    </div>

    <!-- Search form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form action="{{ route('communities.index') }}" method="GET" class="mb-0">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="{{ __('Search communities...') }}"
                           value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> {{ __('Search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Communities grid -->
    <div class="row g-4">
        @forelse($communities as $community)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="position-relative">
                        @if($community->gambar)
                            <img src="{{ asset('storage/' . $community->gambar) }}" class="card-img-top" alt="{{ $community->nama_komunitas }}" style="height: 160px; object-fit: cover;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 160px;">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                        @endif
                        <div class="position-absolute top-0 end-0 p-2">
                            <span class="badge bg-primary rounded-pill">
                                <i class="fas fa-users me-1"></i> {{ $community->users_count ?? $community->users->count() }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $community->nama_komunitas }}</h5>
                        <p class="text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i> {{ __('Created') }} {{ $community->created_at->format('M d, Y') }}
                        </p>
                        <p class="card-text">{{ Str::limit(strip_tags($community->deskripsi), 100) }}</p>
                    </div>

                    <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                        <a href="{{ route('communities.show', $community) }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> {{ __('View Community') }}
                        </a>

                        @auth
                            @if($community->users->contains('user_id', Auth::id()))
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i> {{ __('Member') }}
                                </span>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    @if(isset($search) && $search)
                        {{ __('No communities found matching your search.') }}
                    @else
                        {{ __('No communities available yet.') }}
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $communities->links() }}
    </div>
</div>
@endsection
