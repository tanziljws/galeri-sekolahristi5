@extends('layouts.public')

@section('page-title', $post->judul)

@section('content')
<div class="news-detail-wrapper">
    <!-- Hero Image Section -->
    @if($post->galeries && $post->galeries->count() > 0 && $post->galeries->first()->fotos->count() > 0)
    <div class="news-hero">
        @php
            $imageUrl = \App\Helpers\ImageHelper::getImageUrl($post->galeries->first()->fotos->first()->file);
        @endphp
        <img src="{{ $imageUrl }}" alt="{{ $post->judul }}" class="news-hero-image">
        <div class="news-hero-overlay"></div>
    </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="news-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home me-1"></i>Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->judul, 50) }}</li>
                    </ol>
                </nav>

                <!-- News Header -->
                <article class="news-article">
                    <!-- Kategori Badge -->
                    <div class="news-category">
                        <span class="badge-category">
                            <i class="fas fa-tag me-1"></i>
                            {{ optional($post->kategori)->judul ?? 'Umum' }}
                        </span>
                    </div>

                    <!-- Judul Berita -->
                    <h1 class="news-title">{{ $post->judul }}</h1>

                    <!-- Meta Info -->
                    <div class="news-meta">
                        <div class="meta-item">
                            <i class="far fa-calendar-alt me-1"></i>
                            <span>{{ $post->created_at->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-clock me-1"></i>
                            <span>{{ $post->created_at->format('H:i') }} WIB</span>
                        </div>
                        @if($post->petugas)
                        <div class="meta-item">
                            <i class="far fa-user me-1"></i>
                            <span>{{ $post->petugas->username }}</span>
                        </div>
                        @endif
                    </div>

                    <hr class="news-divider">

                    <!-- Teras Berita / Lead -->
                    <div class="news-lead">
                        {!! nl2br(e(Str::limit($post->isi, 300))) !!}
                    </div>

                    <!-- Isi Berita / Body -->
                    <div class="news-body">
                        {!! nl2br(e($post->isi)) !!}
                    </div>

                    <!-- Tags / Keywords (Optional) -->
                    @if($post->kategori)
                    <div class="news-tags">
                        <i class="fas fa-tags me-2"></i>
                        <a href="{{ route('berita.index', ['kategori' => $post->kategori->id]) }}" class="tag-link">
                            #{{ str_replace(' ', '', $post->kategori->judul) }}
                        </a>
                    </div>
                    @endif

                    <!-- Share Buttons -->
                    <div class="news-share">
                        <h6 class="share-title">Bagikan Berita:</h6>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('berita.show', $post->id)) }}" 
                               target="_blank" 
                               class="btn-share btn-facebook"
                               title="Bagikan ke Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.show', $post->id)) }}&text={{ urlencode($post->judul) }}" 
                               target="_blank" 
                               class="btn-share btn-twitter"
                               title="Bagikan ke Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($post->judul . ' - ' . route('berita.show', $post->id)) }}" 
                               target="_blank" 
                               class="btn-share btn-whatsapp"
                               title="Bagikan ke WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <button onclick="copyLink()" class="btn-share btn-copy" title="Salin Link">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </article>

                <!-- Navigation: Previous/Next -->
                <div class="news-navigation">
                    @if($latest->count() > 0)
                        <a href="{{ route('berita.index') }}" class="btn-nav btn-back">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Berita
                        </a>
                    @endif
                </div>
            </div>

            <!-- Sidebar: Berita Terbaru -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="sidebar-card">
                        <h5 class="sidebar-title">
                            <i class="fas fa-newspaper me-2"></i>
                            Berita Terbaru
                        </h5>
                        <div class="sidebar-list">
                            @foreach($latest as $item)
                            <a href="{{ route('berita.show', $item->id) }}" 
                               class="sidebar-item {{ $item->id == $post->id ? 'active' : '' }}">
                                <div class="sidebar-item-content">
                                    <h6 class="sidebar-item-title">{{ $item->judul }}</h6>
                                    <div class="sidebar-item-meta">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </div>
                                </div>
                                @if($item->galeries && $item->galeries->count() > 0 && $item->galeries->first()->fotos->count() > 0)
                                    @php
                                        $thumbUrl = \App\Helpers\ImageHelper::getImageUrl($item->galeries->first()->fotos->first()->file);
                                    @endphp
                                    <img src="{{ $thumbUrl }}" alt="{{ $item->judul }}" class="sidebar-item-thumb">
                                @endif
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Minimalist News Detail Styles */
.news-detail-wrapper {
    background: #ffffff;
    min-height: 100vh;
}

/* Hero Image */
.news-hero {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
    margin-bottom: 3rem;
}

.news-hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-hero-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 150px;
    background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
}

/* Breadcrumb */
.news-breadcrumb {
    margin-top: 2rem;
    margin-bottom: 1.5rem;
}

.breadcrumb {
    background: transparent;
    padding: 0;
    margin: 0;
    font-size: 0.9rem;
}

.breadcrumb-item a {
    color: #6b7280;
    text-decoration: none;
    transition: color 0.2s;
}

.breadcrumb-item a:hover {
    color: #3b82f6;
}

.breadcrumb-item.active {
    color: #1f2937;
}

/* Article */
.news-article {
    background: #ffffff;
    padding: 2rem 0;
}

.news-category {
    margin-bottom: 1rem;
}

.badge-category {
    display: inline-block;
    padding: 0.5rem 1rem;
    background: #eff6ff;
    color: #3b82f6;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Judul Berita */
.news-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #111827;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    letter-spacing: -0.5px;
}

/* Meta Info */
.news-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    color: #6b7280;
    font-size: 0.9rem;
}

.meta-item i {
    color: #9ca3af;
}

.news-divider {
    border: none;
    height: 1px;
    background: linear-gradient(to right, #e5e7eb, transparent);
    margin: 2rem 0;
}

/* Lead / Teras Berita */
.news-lead {
    font-size: 1.15rem;
    line-height: 1.8;
    color: #374151;
    font-weight: 500;
    margin-bottom: 2rem;
    padding-left: 1rem;
    border-left: 4px solid #3b82f6;
    background: #f9fafb;
    padding: 1.5rem;
    border-radius: 8px;
}

/* Body / Isi Berita */
.news-body {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #1f2937;
    margin-bottom: 2.5rem;
}

.news-body p {
    margin-bottom: 1.5rem;
}

/* Tags */
.news-tags {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

.tag-link {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    background: #f3f4f6;
    color: #6b7280;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.2s;
}

.tag-link:hover {
    background: #3b82f6;
    color: #ffffff;
}

/* Share Buttons */
.news-share {
    background: #f9fafb;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
}

.share-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 1rem;
}

.share-buttons {
    display: flex;
    gap: 0.75rem;
}

.btn-share {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    color: #ffffff;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.btn-share:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-facebook { background: #1877f2; }
.btn-twitter { background: #1da1f2; }
.btn-whatsapp { background: #25d366; }
.btn-copy { background: #6b7280; }

/* Navigation */
.news-navigation {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #e5e7eb;
}

.btn-nav {
    display: inline-flex;
    align-items: center;
    padding: 0.75rem 1.5rem;
    background: #3b82f6;
    color: #ffffff;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
}

.btn-nav:hover {
    background: #2563eb;
    transform: translateX(-5px);
    color: #ffffff;
}

/* Sidebar */
.sidebar-sticky {
    position: sticky;
    top: 100px;
}

.sidebar-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border: 1px solid #f3f4f6;
}

.sidebar-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #e5e7eb;
}

.sidebar-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.sidebar-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid transparent;
}

.sidebar-item:hover {
    background: #f9fafb;
    border-color: #e5e7eb;
}

.sidebar-item.active {
    background: #eff6ff;
    border-color: #3b82f6;
}

.sidebar-item-content {
    flex: 1;
}

.sidebar-item-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.sidebar-item-meta {
    font-size: 0.8rem;
    color: #6b7280;
}

.sidebar-item-thumb {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 6px;
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 768px) {
    .news-hero {
        height: 250px;
    }
    
    .news-title {
        font-size: 1.75rem;
    }
    
    .news-meta {
        gap: 1rem;
    }
    
    .news-lead {
        font-size: 1rem;
    }
    
    .news-body {
        font-size: 0.95rem;
    }
    
    .sidebar-sticky {
        position: relative;
        top: 0;
        margin-top: 3rem;
    }
}
</style>

<script>
function copyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        alert('Link berhasil disalin!');
    });
}
</script>
@endsection


