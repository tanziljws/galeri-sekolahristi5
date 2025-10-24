@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-dark">
                <i class="fas fa-chart-line me-2 text-primary"></i>
                Dashboard Galeri
            </h1>
            <p class="text-muted mb-0">Statistik dan ringkasan galeri foto sekolah</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('galeri.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>
                Tambah Album Baru
            </a>
            <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-images me-2"></i>
                Lihat Semua Galeri
            </a>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-images fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Album</h6>
                            <h2 class="mb-0">{{ $totalGaleries }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Album Aktif</h6>
                            <h2 class="mb-0">{{ $activeGaleries }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-pause-circle fa-2x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Album Nonaktif</h6>
                            <h2 class="mb-0">{{ $inactiveGaleries }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                <i class="fas fa-photo-video fa-2x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1">Total Foto</h6>
                            <h2 class="mb-0">{{ $totalPhotos }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Galleries by Category -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-layer-group me-2 text-primary"></i>
                        Album per Kategori
                    </h5>
                </div>
                <div class="card-body">
                    @php
                        $categoryLabels = [
                            'umum' => 'Umum',
                            'ekstrakurikuler' => 'Ekstrakurikuler',
                            'prestasi' => 'Prestasi',
                            'pplg' => 'PPLG',
                            'tjkt' => 'TJKT',
                            'tpfl' => 'TPFL',
                            'to' => 'TO',
                            'transforkrab' => 'Transforkrab',
                        ];
                        $categoryIcons = [
                            'umum' => 'fa-images',
                            'ekstrakurikuler' => 'fa-users',
                            'prestasi' => 'fa-trophy',
                            'pplg' => 'fa-code',
                            'tjkt' => 'fa-network-wired',
                            'tpfl' => 'fa-tools',
                            'to' => 'fa-car',
                            'transforkrab' => 'fa-graduation-cap',
                        ];
                    @endphp

                    @if($galleriesByCategory->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($galleriesByCategory as $category => $count)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <i class="fas {{ $categoryIcons[$category] ?? 'fa-folder' }} me-2 text-muted"></i>
                                        <span class="fw-medium">{{ $categoryLabels[$category] ?? ucfirst($category) }}</span>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $count }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada album dalam kategori apapun</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Galleries -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        Album Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @if($recentGaleries->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentGaleries as $galery)
                                <a href="{{ route('galeri.show', $galery->id) }}" class="list-group-item list-group-item-action px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            @if($galery->fotos->count() > 0)
                                                <img src="{{ \App\Helpers\ImageHelper::getImageUrl($galery->fotos->first()->file) }}" 
                                                     alt="Thumbnail" 
                                                     class="rounded"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">{{ Str::limit($galery->judul ?? ($galery->post ? $galery->post->judul : 'Gallery'), 40) }}</h6>
                                            <small class="text-muted">
                                                <i class="fas fa-images me-1"></i>{{ $galery->fotos->count() }} foto
                                                <span class="mx-2">•</span>
                                                <i class="fas fa-calendar me-1"></i>{{ $galery->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                        <div class="flex-shrink-0">
                                            @if($galery->status == 1)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Nonaktif</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-images fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada album yang dibuat</p>
                            <a href="{{ route('galeri.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-2"></i>Buat Album Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="fas fa-bolt me-2 text-primary"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('galeri.create') }}" class="btn btn-outline-primary w-100 py-3">
                                <i class="fas fa-plus-circle fa-2x d-block mb-2"></i>
                                <span class="fw-medium">Tambah Album Baru</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('galeri.index') }}" class="btn btn-outline-info w-100 py-3">
                                <i class="fas fa-images fa-2x d-block mb-2"></i>
                                <span class="fw-medium">Kelola Galeri</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('galeri.report') }}" class="btn btn-outline-success w-100 py-3">
                                <i class="fas fa-file-pdf fa-2x d-block mb-2"></i>
                                <span class="fw-medium">Laporan Galeri</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('galeri.public') }}" class="btn btn-outline-secondary w-100 py-3" target="_blank">
                                <i class="fas fa-eye fa-2x d-block mb-2"></i>
                                <span class="fw-medium">Lihat Galeri Publik</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
