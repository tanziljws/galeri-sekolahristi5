@extends('layouts.app')

@section('page-title', 'Manajemen Berita')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-newspaper me-2"></i>
                        Daftar Berita
                    </h4>
                    <a href="{{ route('post.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Berita
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($posts->count() > 0)
                        <div class="row">
                            @foreach($posts as $post)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge bg-{{ $post->status == 'Published' ? 'success' : 'warning' }}">
                                                {{ $post->status }}
                                            </span>
                                            <small class="text-muted">
                                                {{ $post->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                        
                                        <h5 class="card-title text-truncate" title="{{ $post->judul }}">
                                            {{ $post->judul }}
                                        </h5>
                                        
                                        <p class="card-text text-muted small mb-3">
                                            {{ Str::limit($post->isi, 100) }}
                                        </p>
                                        
                                        <div class="mb-3">
                                            <span class="badge bg-info me-1">
                                                <i class="fas fa-tag me-1"></i>
                                                {{ $post->kategori->judul }}
                                            </span>
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-user me-1"></i>
                                                {{ $post->petugas->username }}
                                            </span>
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-sm btn-outline-primary flex-fill">
                                                <i class="fas fa-eye me-1"></i>
                                                Lihat
                                            </a>
                                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-sm btn-outline-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada post</h5>
                            <p class="text-muted">Mulai dengan menambahkan post pertama Anda</p>
                            <a href="{{ route('post.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Tambah Post Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15) !important;
}

.badge {
    font-size: 0.75rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}
</style>
@endsection
