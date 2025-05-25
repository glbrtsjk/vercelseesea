<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\users\index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Add New User
                    </a>
                </div>
                <div class="card-body">
                    <!-- Search and Filter Form -->
                    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-4">
                        <div class="row g-3 align-items-center">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search users..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <select name="role" class="form-select">
                                    <option value="">All Roles</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Administrators</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>Regular Users</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select name="sort" class="form-select">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                                    <option value="articles" {{ request('sort') == 'articles' ? 'selected' : '' }}>Most Articles</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Banned Users</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </form>

                    @if($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Articles</th>
                                        <th>Comments</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        @php
                                            $isAdmin = \App\Models\Admin::where('email', $user->email)->exists();
                                        @endphp
                                        <tr>
                                            <td>{{ $user->user_id }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $user->foto_profil ? Storage::url($user->foto_profil) : asset('images/default-avatar.png') }}"
                                                         alt="{{ $user->name }}" class="rounded-circle mr-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <div>{{ $user->name }}</div>
                                                        @if($user->banned_at)
                                                            <span class="badge bg-danger">Banned</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($isAdmin)
                                                    <span class="badge bg-primary">Administrator</span>
                                                @else
                                                    <span class="badge bg-secondary">User</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->articles_count }}</td>
                                            <td>{{ $user->comments_count }}</td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if(!$isAdmin || \App\Models\Admin::count() > 1)
                                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->user_id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $user->user_id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                                                                <p><strong>User:</strong> {{ $user->name }}</p>
                                                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Delete User</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle me-2"></i> No users found matching your criteria.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
