
@extends('layouts.admin')

@section('title', 'Create New Tag')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create New Tag</h6>
                    <a href="{{ route('admin.tags.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Tags
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.tags.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_tag" class="form-label">Tag Name</label>
                            <input type="text" class="form-control @error('nama_tag') is-invalid @enderror"
                                id="nama_tag" name="nama_tag" value="{{ old('nama_tag') }}" required>
                            <small class="form-text text-muted">
                                The tag name should be unique and concise. It will be automatically converted to a URL-friendly format.
                            </small>
                            @error('nama_tag')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Description (Optional)</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                            <small class="form-text text-muted">
                                Provide a short description explaining what this tag represents.
                            </small>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Create Tag
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Guidelines Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tag Creation Guidelines</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Best Practices</h5>
                            <ul>
                                <li>Use singular forms (e.g., "article" not "articles")</li>
                                <li>Keep tag names concise and descriptive</li>
                                <li>Use lowercase unless it's a proper noun</li>
                                <li>Check for similar existing tags before creating new ones</li>
                                <li>Add descriptions to clarify tag usage</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Examples</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Good Tags</th>
                                            <th>Not Recommended</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>javascript</td>
                                            <td>JS, JavaScript, javascripts</td>
                                        </tr>
                                        <tr>
                                            <td>database</td>
                                            <td>databases, DB stuff</td>
                                        </tr>
                                        <tr>
                                            <td>machine-learning</td>
                                            <td>ML, machine learning, ml-algorithms</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
