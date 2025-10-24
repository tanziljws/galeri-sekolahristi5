@extends('layouts.public')

@section('page-title','Berita SMKN 4 Kota Bogor')
@section('page-subtitle')
    <p class="text-muted mb-0">Informasi terbaru kegiatan, pengumuman, dan agenda sekolah.</p>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row mb-4 align-items-center">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <form method="get" action="{{ route('berita.index') }}" class="d-flex">
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Cari berita...">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('berita.index') }}" class="btn btn-sm {{ request('kategori') ? 'btn-outline-secondary' : 'btn-secondary' }}">Semua</a>
                    @foreach($kategoris as $kategori)
                        <a href="{{ route('berita.index', ['kategori' => $kategori->id]) }}" class="btn btn-sm {{ request('kategori') == $kategori->id ? 'btn-primary' : 'btn-outline-primary' }}">
                            {{ $kategori->judul }}
                            <span class="badge bg-light text-primary ms-1">{{ $kategori->posts_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row g-4">
            @forelse($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0" style="border-radius: 12px;">
                        <!-- Image Section -->
                        <div class="position-relative" style="height: 200px; overflow: hidden; border-radius: 12px 12px 0 0;">
                            @if($post->galeries && $post->galeries->count() > 0 && $post->galeries->first()->fotos->count() > 0)
                                @php
                                    $imageUrl = \App\Helpers\ImageHelper::getImageUrl($post->galeries->first()->fotos->first()->file);
                                @endphp
                                <img src="{{ $imageUrl }}" 
                                     class="card-img-top w-100 h-100" 
                                     alt="{{ $post->judul }}"
                                     style="object-fit: cover; transition: transform 0.3s ease;">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light">
                                    <div class="text-center text-muted">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p class="mb-0">Tidak ada gambar</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content Section -->
                        <div class="card-body d-flex flex-column p-4">
                            <div class="small text-muted mb-2">
                                <i class="fas fa-tag me-1"></i>
                                {{ optional($post->kategori)->judul }} • {{ $post->created_at->format('d M Y') }}
                            </div>
                            <h5 class="card-title fw-bold mb-3" style="color: #1f2937; line-height: 1.3;">{{ $post->judul }}</h5>
                            <p class="card-text text-muted mb-3" style="flex-grow:1; line-height: 1.5;">{{ Str::limit(strip_tags($post->isi), 120) }}</p>
                            <a href="{{ route('berita.show', $post->id) }}" 
                               class="btn btn-outline-primary align-self-start mt-auto"
                               style="border-radius: 8px; padding: 8px 16px; font-weight: 500;">
                                Baca selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada berita tersedia</h4>
                        <p class="text-muted">Berita akan segera ditambahkan.</p>
                    </div>
                </div>
            @endforelse
        </div>

        
    </div>

    <style>
        .card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .card:hover .card-img-top {
            transform: scale(1.05);
        }
        
        .card-img-top {
            transition: transform 0.3s ease;
        }
        
        .btn-outline-primary {
            border-color: #3b82f6;
            color: #3b82f6;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background-color: #3b82f6;
            border-color: #3b82f6;
            transform: translateY(-1px);
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .card-text {
            font-size: 0.9rem;
        }
        
        .small {
            font-size: 0.8rem;
        }
    </style>
@endsection


