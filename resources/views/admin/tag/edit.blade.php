<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\tag\edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Tag: {{ $tag->nama_tag }}</h6>
                    <div>
                        <a href="{{ route('tags.show', $tag->slug) }}" class="btn btn-sm btn-info" target="_blank">
                            <i class="fas fa-eye"></i> View Public Page
                        </a>
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Tags
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_tag" class="form-label">Tag Name</label>
                            <input type="text" class="form-control @error('nama_tag') is-invalid @enderror"
                                id="nama_tag" name="nama_tag" value="{{ old('nama_tag', $tag->nama_tag) }}" required>
                            <small class="form-text text-muted">
                                Changing the tag name will also update its URL.
                            </small>
                            @error('nama_tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Description (Optional)</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $tag->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Tag
                            </button>

                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                                <i class="fas fa-trash"></i> Delete Tag
                            </button>
                        </div>
                    </form>

                    <!-- Hidden Delete Form -->
                    <form id="delete-form" action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tag Usage Statistics -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tag Usage Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-light mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Articles</h5>
                                    <p class="display-4">{{ $tag->articles_count ?? $tag->articles->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">User Followers</h5>
                                    <p class="display-4">{{ $tag->users_count ?? $tag->users->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-light mb-3">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Created</h5>
                                    <p class="h4">{{ $tag->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($tag->articles->count() > 0)
                        <h5 class="mt-4">Recent Articles with this tag</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tag->articles()->with('user')->latest()->take(5)->get() as $article)
                                        <tr>
                                            <td>{{ $article->judul }}</td>
                                            <td>{{ $article->user->name }}</td>
                                            <td>{{ $article->tgl_upload->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-sm btn-info" target="_blank">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('tags.show', $tag->slug) }}" class="btn btn-sm btn-primary" target="_blank">
                                View All Tagged Articles
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function confirmDelete() {
        if (confirm('Are you sure you want to delete this tag? This will remove the tag from all articles.')) {
            document.getElementById('delete-form').submit();
        }
    }
</script>
@endsection
