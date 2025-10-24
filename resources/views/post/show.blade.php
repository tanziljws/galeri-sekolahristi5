@extends('layouts.app')

@section('page-title', 'Detail Post')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-newspaper me-2"></i>
                        Detail Post
                    </h4>
                    <div class="d-flex gap-2">
                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit me-1"></i>
                            Edit
                        </a>
                        <a href="{{ route('post.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Post Content -->
                            <div class="mb-4">
                                <h2 class="mb-3">{{ $post->judul }}</h2>
                                
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-{{ $post->status == 'Published' ? 'success' : 'warning' }} me-2">
                                        {{ $post->status }}
                                    </span>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $post->created_at->format('d M Y H:i') }}
                                    </small>
                                </div>
                                
                                <div class="post-content">
                                    {!! nl2br(e($post->isi)) !!}
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <!-- Post Meta -->
                            <div class="card bg-light">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Informasi Post
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Kategori:</label>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-info me-2">
                                                <i class="fas fa-tag me-1"></i>
                                                {{ $post->kategori->judul }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Penulis:</label>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-user me-2 text-primary"></i>
                                            <div>
                                                <div class="fw-bold">{{ $post->petugas->username }}</div>
                                                <small class="text-muted">{{ $post->petugas->email }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Status:</label>
                                        <div>
                                            <span class="badge bg-{{ $post->status == 'Published' ? 'success' : 'warning' }}">
                                                <i class="fas fa-{{ $post->status == 'Published' ? 'check-circle' : 'clock' }} me-1"></i>
                                                {{ $post->status }}
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Tanggal Dibuat:</label>
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-plus me-1"></i>
                                            {{ $post->created_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Terakhir Update:</label>
                                        <div class="text-muted">
                                            <i class="fas fa-calendar-check me-1"></i>
                                            {{ $post->updated_at->format('d M Y H:i') }}
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">ID Post:</label>
                                        <div class="text-muted">
                                            <code>#{{ $post->id }}</code>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Quick Actions -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-tools me-2"></i>
                                        Aksi Cepat
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i>
                                            Edit Post
                                        </a>
                                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus post ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                <i class="fas fa-trash me-1"></i>
                                                Hapus Post
                                            </button>
                                        </form>
                                        <a href="{{ route('post.index') }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-list me-1"></i>
                                            Daftar Semua Post
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.post-content {
    line-height: 1.8;
    font-size: 1.1rem;
}

.post-content p {
    margin-bottom: 1rem;
}

.card.bg-light {
    border: 1px solid #e9ecef;
}

.badge {
    font-size: 0.875rem;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

code {
    background-color: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
}
</style>
@endsection
