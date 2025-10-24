@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-dark">
                <i class="fas fa-images me-2 text-primary"></i>
                Album: {{ $galery->judul ?? ($galery->post ? $galery->post->judul : 'Gallery') }}
            </h1>
        </div>
        <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Galeri
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Photos Grid -->
    @if($galery->fotos->count() > 0)
        <div class="row g-4">
            @foreach($galery->fotos as $index => $foto)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="position-relative">
                        <img src="{{ \App\Helpers\ImageHelper::getImageUrl($foto->file) }}" 
                             class="card-img-top d-block mx-auto" 
                             alt="Foto {{ $index + 1 }}"
                             style="width: 225px; height: 225px; object-fit: cover; cursor: pointer;"
                             data-bs-toggle="modal" 
                             data-bs-target="#photoModal{{ $foto->id }}">
                        
                        <!-- Photo Number Badge -->
                        <div class="position-absolute top-0 start-0 m-2">
                            <span class="badge bg-primary">
                                <i class="fas fa-image me-1"></i>
                                Foto {{ $index + 1 }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body text-center">
                        <form action="{{ route('galeri.foto.update', [$galery->id, $foto->id]) }}" method="POST" enctype="multipart/form-data" class="mb-2 d-flex flex-column align-items-center gap-2">
                            @csrf
                            <input type="file" name="file" accept="image/*" class="form-control form-control-sm" style="max-width: 260px;">
                            <div class="input-group input-group-sm" style="max-width: 260px;">
                                <input type="text" name="judul" class="form-control" value="{{ $foto->judul }}" placeholder="Keterangan foto (opsional)">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                        <form action="{{ route('galeri.foto.destroy', [$galery->id, $foto->id]) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash me-1"></i> Hapus Foto
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Photo Modal -->
            <div class="modal fade" id="photoModal{{ $foto->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-image me-2"></i>
                                Foto {{ $index + 1 }} dari {{ $galery->fotos->count() }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center p-0">
                            <img src="{{ \App\Helpers\ImageHelper::getImageUrl($foto->file) }}" 
                                 class="img-fluid w-100" 
                                 alt="Foto {{ $index + 1 }}"
                                 style="max-height: 70vh; object-fit: contain;">
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-2"></i>
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Add-more card -->
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('galeri.edit', $galery->id) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        <div class="d-flex align-items-center justify-content-center" style="height: 275px;">
                            <div class="text-center text-muted">
                                <div class="border rounded d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 225px; height: 225px; border-style: dashed !important;">
                                    <i class="fas fa-plus fa-2x"></i>
                                </div>
                                <span>Tambah Foto</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="mb-4">
                <img src="{{ asset('images/placeholder.svg') }}" 
                     alt="Album Kosong" 
                     class="img-fluid rounded"
                     style="max-width: 300px; opacity: 0.7;">
            </div>
            <h4 class="text-muted mb-3">Album Kosong</h4>
            <p class="text-muted mb-4">Belum ada foto dalam album ini</p>
        </div>
    @endif
</div>

<style>
.hover-lift {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.card {
    border-radius: 12px;
    overflow: hidden;
}

.card-img-top {
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
    border-radius: 20px;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.modal-content {
    border-radius: 12px;
}

.modal-header {
    border-radius: 12px 12px 0 0;
}

.modal-footer {
    border-radius: 0 0 12px 12px;
}
</style>
@endsection
