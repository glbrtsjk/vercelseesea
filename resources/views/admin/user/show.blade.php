<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\users\show.blade.php -->
@extends('layouts.admin')

@section('title', 'User Details: ' . $user->name)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- User Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center pt-4">
                    <img src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('images/default-avatar.png') }}" alt="{{ $user->name }}"
                         class="rounded-circle img-thumbnail mx-auto mb-3" style="width: 150px; height: 150px; object-fit: cover;">

                    <h5 class="card-title mb-1">{{ $user->name }}</h5>
                    <p class="text-muted mb-2">{{ $user->email }}</p>

                    @if($user->role === 'admin')
                        <span class="badge bg-primary mb-3">Administrator</span>
                    @endif

                    @if($user->is_banned)
                        <span class="badge bg-danger mb-3">Banned</span>
                    @endif

                    <div class="d-flex justify-content-center gap-2 my-3">
                        <button type="button" class="btn {{ $user->role === 'admin' ? 'btn-danger' : 'btn-success' }}"
                                data-bs-toggle="modal" data-bs-target="#adminRoleModal">
                            <i class="fas {{ $user->role === 'admin' ? 'fa-user-minus' : 'fa-user-plus' }}"></i>
                            {{ $user->role === 'admin' ? 'Remove Admin' : 'Make Admin' }}
                        </button>

                        <button type="button" class="btn {{ $user->is_banned ? 'btn-success' : 'btn-warning' }}"
                                data-bs-toggle="modal" data-bs-target="#banModal">
                            <i class="fas {{ $user->is_banned ? 'fa-user-check' : 'fa-user-slash' }}"></i>
                            {{ $user->is_banned ? 'Unban User' : 'Ban User' }}
                        </button>
                    </div>

                    <hr>

                    @if($user->bio)
                        <div class="text-start mb-3">
                            <h6 class="text-muted">Bio</h6>
                            <p>{{ $user->bio }}</p>
                        </div>
                        <hr>
                    @endif

                    <div class="d-flex justify-content-center mb-0">
                        <div class="px-3">
                            <h6>{{ $articleCount }}</h6>
                            <small class="text-muted">Articles</small>
                        </div>
                        <div class="px-3 border-start">
                            <h6>{{ $commentCount }}</h6>
                            <small class="text-muted">Comments</small>
                        </div>
                        <div class="px-3 border-start">
                            <h6>{{ $user->communities_count }}</h6>
                            <small class="text-muted">Communities</small>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light text-center">
                    <small class="text-muted">Joined: {{ $user->created_at->format('M d, Y') }}</small>
                </div>
            </div>

            <!-- Account Details -->
            <div class="card shadow mt-4">
                <div class="card-header bg-light">
                    <h6 class="m-0 font-weight-bold text-primary">Account Details</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>User ID</span>
                            <span class="badge bg-secondary">{{ $user->user_id }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Role</span>
                            <span class="badge {{ $user->role === 'admin' ? 'bg-primary' : 'bg-secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Status</span>
                            @if($user->is_banned)
                                <span class="badge bg-danger">Banned</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Email Verified</span>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-light">
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">
                            <i class="fas fa-trash-alt me-1"></i> Delete User Account
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- User Activity Section -->
        <div class="col-lg-8">
            <!-- Recent Articles -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Articles</h6>
                    <a href="{{ route('admin.users.articles', $user) }}" class="btn btn-sm btn-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($articles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td>{{ Str::limit($article->judul, 40) }}</td>
                                            <td>{{ $article->category->nama_kategori }}</td>
                                            <td>
                                                @if($article->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @elseif($article->status === 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif($article->status === 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td>{{ $article->tgl_upload->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted mb-0">No articles found for this user.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Communities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Communities</h6>
                </div>
                <div class="card-body">
                    @if($communities->count() > 0)
                        <div class="row">
                            @foreach($communities as $community)
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $community->gambar ? Storage::url($community->gambar) : asset('images/default-community.png') }}"
                                                     alt="{{ $community->nama_komunitas }}" class="rounded-circle mr-3" style="width: 40px; height: 40px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0">{{ $community->nama_komunitas }}</h6>
                                                    <small class="text-muted">
                                                        Joined {{ $community->pivot->tgl_gabung ? $community->pivot->tgl_gabung->format('M d, Y') : 'N/A' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-0 text-end">
                                            <a href="{{ route('admin.communities.show', $community) }}" class="btn btn-sm btn-outline-primary">
                                                View Community
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted mb-0">User is not a member of any communities.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Ban History -->
            @if($user->banned_at || $user->banned_reason)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ban Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($user->banned_at)
                        <div class="col-md-6">
                            <p><strong>Banned Date:</strong> {{ $user->banned_at->format('M d, Y H:i') }}</p>
                        </div>
                        @endif
                        @if($user->banned_by)
                        <div class="col-md-6">
                            <p><strong>Banned By:</strong>
                                @php
                                    $banner = \App\Models\User::find($user->banned_by);
                                @endphp
                                {{ $banner ? $banner->name : 'Unknown' }}
                            </p>
                        </div>
                        @endif
                    </div>
                    @if($user->banned_reason)
                    <div class="alert alert-warning">
                        <strong>Reason:</strong> {{ $user->banned_reason }}
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Ban User Modal -->
<div class="modal fade" id="banModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $user->is_banned ? 'Unban User' : 'Ban User' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.toggle-ban', $user) }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if($user->is_banned)
                        <p>Are you sure you want to unban this user?</p>
                        <p><strong>User:</strong> {{ $user->name }}</p>
                        @if($user->banned_at)
                            <p><strong>Banned on:</strong> {{ $user->banned_at->format('M d, Y H:i') }}</p>
                        @endif
                        @if($user->banned_reason)
                            <p><strong>Reason for ban:</strong> {{ $user->banned_reason }}</p>
                        @endif
                    @else
                        <p>Are you sure you want to ban this user?</p>
                        <p><strong>User:</strong> {{ $user->name }}</p>
                        <div class="mb-3">
                            <label for="reason" class="form-label">Reason for ban (optional)</label>
                            <textarea id="reason" name="reason" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Banned users cannot log in or participate in any activities on the site.
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn {{ $user->is_banned ? 'btn-success' : 'btn-danger' }}">
                        {{ $user->is_banned ? 'Unban User' : 'Ban User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Toggle Admin Role Modal -->
<div class="modal fade" id="adminRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $user->role === 'admin' ? 'Remove Admin Privileges' : 'Grant Admin Privileges' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST">
                @csrf
                <div class="modal-body">
                    @if($user->role === 'admin')
                        <p>Are you sure you want to remove administrator privileges from this user?</p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            This user will no longer have access to the admin panel and administrative functions.
                        </div>
                    @else
                        <p>Are you sure you want to grant administrator privileges to this user?</p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            This will give the user full access to the admin panel and all administrative functions.
                        </div>
                    @endif
                    <p><strong>User:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn {{ $user->role === 'admin' ? 'btn-danger' : 'btn-success' }}">
                        {{ $user->role === 'admin' ? 'Remove Admin Privileges' : 'Grant Admin Privileges' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
