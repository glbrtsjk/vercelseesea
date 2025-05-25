@extends('layouts.admin')
@section('title', 'Edit Community')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Community: {{ $community->nama_komunitas }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.communities.update', $community) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_komunitas" class="form-label">Community Name</label>
                            <input type="text" class="form-control @error('nama_komunitas') is-invalid @enderror"
                                id="nama_komunitas" name="nama_komunitas" value="{{ old('nama_komunitas', $community->nama_komunitas) }}" required>
                            @error('nama_komunitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Description</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $community->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label">Community Image</label>

                            @if($community->gambar)
                                <div class="mb-2">
                                    <p class="mb-1">Current Image:</p>
                                    <img src="{{ asset('storage/' . $community->gambar) }}" alt="{{ $community->nama_komunitas }}"
                                        class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif

                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                id="gambar" name="gambar" accept="image/*">
                            <small class="text-muted">Upload a new image to replace the current one (Max: 2MB, Allowed formats: JPEG, PNG, JPG, GIF)</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div id="imagePreview" class="mt-2 d-none">
                                <p class="mb-1">New Image Preview:</p>
                                <img src="#" alt="New Image Preview" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.communities.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Community</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Community Statistics Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Community Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Total Members</h5>
                                    <h2 class="mb-0">{{ $community->users->count() }}</h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="#membersList" data-bs-toggle="collapse">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Messages</h5>
                                    <h2 class="mb-0">{{ $community->messages->count() }}</h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="small text-white">Last 30 days</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Created On</h5>
                                    <h2 class="mb-0">{{ $community->created_at->format('M d, Y') }}</h2>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span class="small text-white">{{ $community->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Collapsible Members List -->
                    <div class="collapse mt-4" id="membersList">
                        <div class="card card-body">
                            <h5>Community Members</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Joined</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($community->users as $user)
                                            <tr>
                                                <td>{{ $user->user_id }}</td>
                                                <td>{{ $user->nama }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->pivot->tg_gabung->format('M d, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-user"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No members found</td>
                                            </tr>
                                        @endforelse
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

@section('scripts')
<script>
    // Image preview functionality
    document.getElementById('gambar').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('d-none');
        }
    });

    // Initialize rich text editor for description
    if (document.getElementById('deskripsi')) {
        ClassicEditor
            .create(document.getElementById('deskripsi'))
            .catch(error => {
                console.error(error);
            });
    }
</script>
@endsection
