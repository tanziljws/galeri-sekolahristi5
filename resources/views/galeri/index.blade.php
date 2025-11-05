@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-dark">
            <i class="fas fa-images me-2 text-primary"></i>
            Album Sekolah
        </h1>
        <p class="text-muted mb-0">Koleksi foto kegiatan SMK Negeri 4 Kota Bogor</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Reporting Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded p-3">
                                <i class="fas fa-images fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Album</h6>
                            <h3 class="mb-0">{{ $galeries->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded p-3">
                                <i class="fas fa-photo-video fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Foto</h6>
                            <h3 class="mb-0">{{ $galeries->sum(function($g) { return $g->fotos->count(); }) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded p-3">
                                <i class="fas fa-eye fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Album Aktif</h6>
                            <h3 class="mb-0">{{ $galeries->where('status', 1)->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded p-3">
                                <i class="fas fa-layer-group fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Kategori</h6>
                            <h3 class="mb-0">{{ $categorizedGaleries->count() }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div>
                    <h6 class="mb-0">
                        <i class="fas fa-filter me-2"></i>
                        Filter Kategori
                    </h6>
                </div>
                <div class="btn-group flex-wrap" role="group">
                    <button type="button" class="btn btn-sm btn-outline-primary active" data-filter="all">
                        <i class="fas fa-th me-1"></i> Semua ({{ $galeries->count() }})
                    </button>
                    @foreach($categorizedGaleries as $category => $items)
                        @php
                            $categoryLabels = [
                                'umum' => 'Umum',
                                'ekstrakurikuler' => 'Ekstrakurikuler',
                                'prestasi' => 'Prestasi',
                                'pplg' => 'PPLG',
                                'tjkt' => 'TJKT',
                                'tpfl' => 'TPFL',
                                'to' => 'TO',
                                'transforkrab' => 'Transforkrab'
                            ];
                        @endphp
                        <button type="button" class="btn btn-sm btn-outline-primary" data-filter="{{ $category }}">
                            {{ $categoryLabels[$category] ?? $category }} ({{ $items->count() }})
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @if($galeries->count() > 0)
        <div class="row g-4">
            @foreach($galeries as $galery)
                <div class="col-lg-4 col-md-6 galeri-item" data-category="{{ $galery->category }}">
                    <div class="card h-100 border-0 shadow-sm hover-lift {{ session('highlight_id') == $galery->id ? 'ring-border' : '' }}" id="galeri-card-{{ $galery->id }}">
                        <div class="position-relative">
                            @if($galery->fotos->count() > 0)
                                <div class="d-flex align-items-center justify-content-center" style="height: 275px;">
                                    @php
                                        $firstPhoto = $galery->fotos->first();
                                        $imageUrl = \App\Helpers\ImageHelper::getImageUrl($firstPhoto->file);
                                    @endphp
                                    
                                    <img src="{{ $imageUrl }}" 
                                         class="card-img-top d-block mx-auto" 
                                         alt="Album {{ $galery->judul ?? 'Tanpa Judul' }}"
                                         style="width: 225px; height: 225px; object-fit: cover; object-position: center top;"
                                         onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}'">
                                    
                                    <!-- Photo count badge -->
                                    <div class="position-absolute bottom-0 start-0 m-2">
                                        <small class="text-white bg-dark px-2 py-1 rounded">
                                            <i class="fas fa-images me-1"></i>{{ $galery->fotos->count() }} foto
                                        </small>
                                    </div>
                                </div>

                            @else
                                <div class="d-flex align-items-center justify-content-center" style="height: 275px;">
                                    <div class="border rounded d-flex align-items-center justify-content-center text-muted" style="width: 225px; height: 225px; border-style: dashed !important;">
                                        <div class="text-center">
                                            <i class="fas fa-images fa-2x mb-2"></i>
                                            <p class="mb-0">Belum ada foto</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-body text-center">
                            <h5 class="card-title mb-2">{{ $galery->judul ?? 'Tanpa Judul' }}</h5>
                            <div class="mb-2">
                                @php
                                    $categoryLabels = [
                                        'umum' => 'Umum',
                                        'ekstrakurikuler' => 'Ekstrakurikuler',
                                        'prestasi' => 'Prestasi',
                                        'pplg' => 'PPLG',
                                        'tjkt' => 'TJKT',
                                        'tpfl' => 'TPFL',
                                        'to' => 'TO',
                                        'transforkrab' => 'Transforkrab'
                                    ];
                                    $categoryColors = [
                                        'umum' => 'primary',
                                        'ekstrakurikuler' => 'success',
                                        'prestasi' => 'warning',
                                        'pplg' => 'info',
                                        'tjkt' => 'danger',
                                        'tpfl' => 'secondary',
                                        'to' => 'dark',
                                        'transforkrab' => 'purple'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $categoryColors[$galery->category] ?? 'secondary' }}">
                                    {{ $categoryLabels[$galery->category] ?? $galery->category }}
                                </span>
                            </div>
                            <p class="card-text text-muted small mb-3">{{ $galery->fotos->count() }} Foto</p>
                            
                            <!-- Action Buttons -->
                            <div class="d-flex gap-2 justify-content-center flex-wrap">
                                <a href="{{ route('galeri.show', $galery->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye me-1"></i> Lihat
                                </a>
                                <button type="button" class="btn btn-sm btn-success" onclick="openQuickUpload({{ $galery->id }}, '{{ $galery->judul }}')">
                                    <i class="fas fa-upload me-1"></i> Upload Foto
                                </button>
                                <a href="{{ route('galeri.edit', $galery->id) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                                <form action="{{ route('galeri.destroy', $galery->id) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Yakin ingin menghapus album ini? Semua foto akan terhapus!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash me-1"></i> Hapus
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
            <div class="mb-4">
                <i class="fas fa-images fa-5x text-muted"></i>
            </div>
            <h4 class="text-muted mb-3">Belum Ada Album</h4>
            <p class="text-muted mb-4">Mulai buat album pertama untuk menampilkan foto kegiatan sekolah</p>
            <a href="{{ route('galeri.create') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>
                Buat Album Pertama
            </a>
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

.galeri-item {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.galeri-item.hidden {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-filter]');
    const galeriItems = document.querySelectorAll('.galeri-item');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            galeriItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    item.classList.remove('hidden');
                    item.style.display = '';
                } else {
                    item.classList.add('hidden');
                }
            });
        });
    });
    
    // Scroll to highlighted card if exists
    const highlightedCard = document.querySelector('.ring-border');
    if (highlightedCard) {
        setTimeout(() => {
            highlightedCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }, 300);
    }
});

// Quick Upload Modal Functions
function openQuickUpload(galeryId, galeryTitle) {
    document.getElementById('quickUploadGaleryId').value = galeryId;
    document.getElementById('quickUploadGaleryTitle').textContent = galeryTitle;
    document.getElementById('quickUploadForm').action = `/galeri/${galeryId}/quick-upload`;
    document.getElementById('quickUploadPhotos').value = '';
    document.getElementById('quickUploadPreview').innerHTML = '';
    document.getElementById('quickUploadPreview').style.display = 'none';
    
    const modal = new bootstrap.Modal(document.getElementById('quickUploadModal'));
    modal.show();
}

// Handle file selection for quick upload
document.addEventListener('DOMContentLoaded', function() {
    const quickUploadInput = document.getElementById('quickUploadPhotos');
    const quickUploadPreview = document.getElementById('quickUploadPreview');
    
    if (quickUploadInput) {
        quickUploadInput.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                quickUploadPreview.innerHTML = '';
                quickUploadPreview.style.display = 'block';
                
                let html = '<div class="row g-2">';
                for (let i = 0; i < Math.min(files.length, 20); i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        html += `
                            <div class="col-3">
                                <img src="${e.target.result}" class="img-thumbnail" style="height: 80px; width: 100%; object-fit: cover;">
                            </div>
                        `;
                        if (i === Math.min(files.length, 20) - 1) {
                            html += '</div>';
                            quickUploadPreview.innerHTML = html;
                        }
                    };
                    reader.readAsDataURL(file);
                }
            } else {
                quickUploadPreview.style.display = 'none';
            }
        });
    }
});
</script>

<!-- Quick Upload Modal -->
<div class="modal fade" id="quickUploadModal" tabindex="-1" aria-labelledby="quickUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="quickUploadModalLabel">
                    <i class="fas fa-upload me-2"></i>
                    Upload Foto ke Album: <span id="quickUploadGaleryTitle"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="quickUploadForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="quickUploadGaleryId" name="galery_id">
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Upload Otomatis:</strong> Pilih foto, langsung masuk database dan tampil di galeri. Judul foto akan dibuat otomatis.
                    </div>
                    
                    <div class="mb-3">
                        <label for="quickUploadPhotos" class="form-label fw-bold">
                            <i class="fas fa-images me-1"></i>
                            Pilih Foto (Maksimal 20 foto)
                        </label>
                        <input type="file" 
                               class="form-control" 
                               id="quickUploadPhotos" 
                               name="photos[]" 
                               accept="image/*" 
                               multiple 
                               required>
                        <div class="form-text">
                            Format: JPG, PNG | Ukuran maksimal: 20MB per file
                        </div>
                    </div>
                    
                    <div id="quickUploadPreview" style="display: none;">
                        <label class="form-label fw-bold">Preview:</label>
                        <!-- Preview images will be inserted here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-upload me-1"></i>
                        Upload Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('styles')
<style>
.ring-border {
    outline: 3px solid #4f46e5;
    outline-offset: 2px;
    border-radius: 12px;
    animation: flash 1.2s ease-in-out 2;
}
@keyframes flash {
    0%,100% { outline-color: #4f46e5; }
    50% { outline-color: transparent; }
}
</style>
@endpush
