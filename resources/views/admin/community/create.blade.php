    @extends('layouts.admin')

@section('title', 'Create Community')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create New Community</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.communities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_komunitas" class="form-label">Community Name</label>
                            <input type="text" class="form-control @error('nama_komunitas') is-invalid @enderror"
                                id="nama_komunitas" name="nama_komunitas" value="{{ old('nama_komunitas') }}" required>
                            @error('nama_komunitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Description</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label">Community Image</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                id="gambar" name="gambar" accept="image/*">
                            <small class="text-muted">Upload an image (Max: 2MB, Allowed formats: JPEG, PNG, JPG, GIF)</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div id="imagePreview" class="mt-2 d-none">
                                <img src="#" alt="Image Preview" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.communities.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Community</button>
                        </div>
                    </form>
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
