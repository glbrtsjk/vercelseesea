@extends('layouts.admin')

@section('title', 'Manage Communities')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Communities</h1>
        <a href="{{ route('admin.communities.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Create New Community
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Communities</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="communitiesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Members</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($communities as $community)
                            <tr>
                                <td>{{ $community->community_id }}</td>
                                <td>
                                    @if($community->gambar)
                                        <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}" width="50" height="50" class="rounded">
                                    @else
                                        <div class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $community->nama_komunitas }}</td>
                                <td>{{ $community->slug }}</td>
                                <td>{{ $community->users_count ?? $community->users->count() }}</td>
                                <td>{{ $community->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Community actions">
                                        <a href="{{ route('communities.show', $community) }}" class="btn btn-sm btn-info" target="_blank" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.communities.edit', $community) }}" class="btn btn-sm btn-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCommunityModal{{ $community->community_id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteCommunityModal{{ $community->community_id }}" tabindex="-1" aria-labelledby="deleteCommunityModalLabel{{ $community->community_id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteCommunityModalLabel{{ $community->community_id }}">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete the community "{{ $community->nama_komunitas }}"? This action cannot be undone.
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('admin.communities.destroy', $community) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete Community</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No communities found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $communities->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#communitiesTable').DataTable({
            "paging": false,
            "info": false,
            "searching": true,
            "responsive": true,
            "order": [[0, "desc"]]
        });
    });
</script>
@endsection
