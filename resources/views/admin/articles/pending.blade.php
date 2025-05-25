<!-- filepath: c:\xampp\htdocs\projectpwl\resources\views\admin\articles\pending.blade.php -->
@extends('layouts.admin')

@section('title', 'Pending Articles')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pending Articles</h6>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($articles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Submitted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($article->gambar)
                                                        <img src="{{ Storage::url($article->gambar) }}" alt="{{ $article->judul }}" class="img-thumbnail mr-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <strong>{{ $article->judul }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $article->user->nama }}</td>
                                            <td>{{ $article->category->nama_kategori }}</td>
                                            <td>{{ $article->tgl_upload->format('M d, Y') }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-info btn-sm mr-2">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                    <button type="button" class="btn btn-success btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#approveModal{{ $article->article_id }}">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $article->article_id }}">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Approve Modal -->
                                        <div class="modal fade" id="approveModal{{ $article->article_id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $article->article_id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="approveModalLabel{{ $article->article_id }}">Confirm Approval</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to approve this article?</p>
                                                        <p><strong>{{ $article->judul }}</strong></p>
                                                        <p>By <strong>{{ $article->user->nama }}</strong></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('admin.articles.approve', $article) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Approve Article</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Reject Modal -->
                                        <div class="modal fade" id="rejectModal{{ $article->article_id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $article->article_id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.articles.reject', $article) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="rejectModalLabel{{ $article->article_id }}">Reject Article</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>You're rejecting <strong>{{ $article->judul }}</strong></p>
                                                            <div class="mb-3">
                                                                <label for="feedback" class="form-label">Feedback for Author (Optional)</label>
                                                                <textarea class="form-control" id="feedback" name="feedback" rows="4" placeholder="Provide feedback to help the author improve their article..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Reject Article</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $articles->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="fas fa-check-circle fa-4x text-success"></i>
                            </div>
                            <h5>No pending articles to review!</h5>
                            <p class="text-muted">All articles have been reviewed.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
