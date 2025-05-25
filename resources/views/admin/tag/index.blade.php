<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\tag\index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manage Tags')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Tags</h1>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Create New Tag
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search and Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Search and Filter</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.tags.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search tags..."
                           value="{{ request('search') }}">
                </div>

                <div class="col-md-3">
                    <select name="sort" class="form-select">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name (A-Z)</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                        <option value="articles" {{ request('sort') == 'articles' ? 'selected' : '' }}>Most Articles</option>
                        <option value="created" {{ request('sort') == 'created' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Apply</button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tags Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Tags</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tagsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Articles</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{ $tag->tag_id }}</td>
                                <td>{{ $tag->nama_tag }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>{{ $tag->articles_count }}</td>
                                <td>{{ $tag->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.tags.edit', $tag->tag_id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('tags.show', $tag->slug) }}" class="btn btn-sm btn-info" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.tags.destroy', $tag->tag_id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this tag? This will remove the tag from all articles.')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tags found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $tags->links() }}
            </div>
        </div>
    </div>

    <!-- Tag Merge Tool -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Merge Tags</h6>
        </div>
        <div class="card-body">
            <p>Use this tool to merge one tag into another. All articles associated with the source tag will be transferred to the target tag.</p>

            <form action="{{ route('admin.tags.merge') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-5">
                    <label for="source_tag_id" class="form-label">Source Tag (will be deleted)</label>
                    <select name="source_tag_id" id="source_tag_id" class="form-select" required>
                        <option value="">Select a tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->tag_id }}">{{ $tag->nama_tag }} ({{ $tag->articles_count }} articles)</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="target_tag_id" class="form-label">Target Tag (will receive articles)</label>
                    <select name="target_tag_id" id="target_tag_id" class="form-select" required>
                        <option value="">Select a tag</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->tag_id }}">{{ $tag->nama_tag }} ({{ $tag->articles_count }} articles)</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-warning w-100" onclick="return confirm('Are you sure you want to merge these tags? This cannot be undone.')">
                        Merge Tags
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize the selects
        $('#source_tag_id, #target_tag_id').select2({
            placeholder: "Select a tag",
            allowClear: true,
            width: '100%'
        });

        // Prevent selecting the same tag for source and target
        $('#source_tag_id, #target_tag_id').on('change', function() {
            const sourceVal = $('#source_tag_id').val();
            const targetVal = $('#target_tag_id').val();

            if (sourceVal && targetVal && sourceVal === targetVal) {
                alert('Source and target tags cannot be the same');
                $(this).val('').trigger('change');
            }
        });
    });
</script>
@endsection
