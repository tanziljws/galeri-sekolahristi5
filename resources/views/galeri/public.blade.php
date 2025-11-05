<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galeri Sekolah - v2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Force refresh cache -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <style>
        body { 
            background: #ffffff; 
            color: #333;
        }
        
        .hero {
            position: relative;
            background: url('{{ asset('images/smk-gedung.jpg') }}') center/cover no-repeat;
        }
        .hero::before { content: ""; position: absolute; inset: 0; background: rgba(15,23,42,.6); }
        .hero-inner { position: relative; z-index: 1; }
        
        /* Gallery Grid Styles */
        .gallery-card { 
            border: none; 
            border-radius: 12px; 
            overflow: hidden; 
            box-shadow: 0 8px 24px rgba(0,0,0,.08); 
            transition: transform .2s ease; 
            background: #fff; 
        }
        
        .gallery-card:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 12px 32px rgba(0,0,0,.15);
        }
        
        .gallery-img { 
            width: 100%; 
            height: 260px; 
            object-fit: cover; 
            display: block; 
            cursor: zoom-in;
        }
        
        .caption { 
            font-weight: 600; 
            color: #111827; 
            font-size: 1.1rem;
        }
        
        .meta { 
            color: #6b7280; 
            font-size: .9rem; 
        }
        
        .card-body {
            padding: 1.25rem;
        }
        
        .border-warning {
            border: 2px solid #ffc107 !important;
        }
        .badge.bg-warning {
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Interaction Buttons Styling - Modern Circular */
        .interaction-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
        }
        
        .interaction-buttons .btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
            padding: 0;
            background: white;
            border: 2px solid #e0e0e0;
            cursor: pointer !important;
            pointer-events: auto !important;
        }
        
        .interaction-buttons .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .interaction-buttons .btn i {
            font-size: 1.3rem;
            pointer-events: none;
        }
        
        .interaction-buttons .btn-count {
            position: absolute;
            bottom: -8px;
            right: -8px;
            background: #dc3545 !important;
            color: white !important;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex !important;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
            border: 2px solid white;
            z-index: 100;
            pointer-events: none !important;
        }
        
        /* Like Button */
        .like-btn {
            border-color: #e0e0e0;
            cursor: pointer !important;
            pointer-events: auto !important;
            position: relative;
            z-index: 10;
            background: white;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px !important;
            border-radius: 25px !important;
            width: auto !important;
            height: auto !important;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .like-btn i {
            color: #999;
            pointer-events: none;
            font-size: 1.1rem;
        }
        
        .like-btn .like-count {
            color: #666;
            position: static !important;
            background: transparent !important;
            border: none !important;
            width: auto !important;
            height: auto !important;
            display: inline !important;
            font-size: 0.95rem;
            pointer-events: none;
        }
        
        .like-btn:hover {
            border-color: #ffc0cb;
            background: #fff5f7 !important;
            transform: scale(1.05);
        }
        
        .like-btn.liked {
            background: #ffe4e9 !important;
            border-color: #ff69b4 !important;
        }
        
        .like-btn.liked i {
            color: #ff1493 !important;
        }
        
        .like-btn.liked .like-count {
            color: #ff1493 !important;
        }
        
        /* Comment Button */
        .comment-btn {
            border-color: #e0e0e0;
            cursor: pointer !important;
            pointer-events: auto !important;
            position: relative;
            z-index: 10;
        }
        
        .comment-btn i {
            color: #666;
            pointer-events: none;
        }
        
        .comment-btn:hover {
            border-color: #17a2b8;
            background: #e3f2fd !important;
        }
        
        .comment-btn.active {
            background: #e3f2fd !important;
            border-color: #2196f3 !important;
        }
        
        .comment-btn.active i {
            color: #2196f3;
        }
        
        /* Share Button */
        .share-btn {
            border-color: #e0e0e0;
            cursor: pointer !important;
            pointer-events: auto !important;
        }
        
        .share-btn i {
            color: #666;
            pointer-events: none;
        }
        
        .share-btn:hover {
            border-color: #17a2b8;
            background: #e3f2fd !important;
        }
        
        /* Download Button Styles */
        .download-btn {
            border-color: #28a745 !important;
        }
        
        .download-btn i {
            color: #28a745;
            pointer-events: none;
        }
        
        .download-btn:hover {
            border-color: #28a745;
            background: #d4edda !important;
        }
        
        /* Share Modal Styles */
        .share-social-btn {
            transition: all 0.3s ease;
            border: none;
        }
        
        .share-social-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        #sharePhotoPreview {
            border: 3px solid #f0f0f0;
        }
        
        /* Pulse animation for like button */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }
        
        .like-btn.pulse {
            animation: pulse 0.3s ease-in-out;
        }
        
        /* Filter Button Styles */
        .filter-btn {
            transition: all 0.3s ease;
            font-weight: 500;
            border-radius: 20px;
            padding: 8px 20px;
        }
        
        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .filter-btn.active {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
        }
        
        /* Photo Item Transition */
        .photo-item {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        
        .photo-item[style*="display: none"] {
            opacity: 0;
            transform: scale(0.95);
        }
        
        /* Modern Filter Container */
        .filter-modern-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            align-items: center;
        }
        
        /* Modern Filter Button */
        .btn-modern-filter {
            background: #ffffff;
            border: 2px solid #e0e6ed;
            border-radius: 50px;
            padding: 0.65rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #4a5568;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .btn-modern-filter:hover {
            background: #f7fafc;
            border-color: #4299e1;
            color: #2b6cb0;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 153, 225, 0.15);
        }
        
        .btn-modern-filter.active {
            background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
            border-color: #3182ce;
            color: white;
            box-shadow: 0 4px 15px rgba(66, 153, 225, 0.4);
        }
        
        .btn-modern-filter i {
            font-size: 0.9rem;
        }
        
        /* Dropdown Modern */
        .dropdown-modern {
            border-radius: 16px;
            border: 1px solid #e0e6ed;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
            padding: 0.5rem;
            min-width: 220px;
            margin-top: 0.5rem;
        }
        
        .dropdown-modern .dropdown-item {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #4a5568;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }
        
        .dropdown-modern .dropdown-item:hover {
            background: linear-gradient(135deg, #ebf8ff 0%, #e6fffa 100%);
            color: #2b6cb0;
            transform: translateX(4px);
        }
        
        .dropdown-modern .dropdown-item i {
            width: 24px;
            font-size: 0.9rem;
        }
        
        /* Chevron Animation */
        .btn-modern-filter .fa-chevron-down {
            transition: transform 0.3s ease;
        }
        
        .btn-modern-filter[aria-expanded="true"] .fa-chevron-down {
            transform: rotate(180deg);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .filter-modern-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-modern-filter {
                width: 100%;
                justify-content: center;
            }
        }
        
        /* Modal Navigation Buttons - Instagram Style */
        .btn-nav-modal {
            position: absolute !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            border: 2px solid rgba(0,0,0,0.1) !important;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            z-index: 1000 !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3) !important;
        }
        
        .btn-nav-modal:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }
        
        .btn-nav-modal i {
            font-size: 1.4rem !important;
            color: #111 !important;
            font-weight: bold !important;
        }
        
        .btn-nav-prev {
            left: 20px !important;
        }
        
        .btn-nav-next {
            right: 20px !important;
        }
        
        .btn-nav-modal:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        
        .btn-nav-modal:disabled:hover {
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
        }
        
        /* Photo Counter */
        .photo-counter {
            position: absolute !important;
            bottom: 20px !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            background: rgba(0, 0, 0, 0.8) !important;
            color: white !important;
            padding: 10px 20px !important;
            border-radius: 25px !important;
            font-size: 1rem !important;
            font-weight: 600 !important;
            z-index: 1000 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.3) !important;
        }
        
        /* Keyboard Navigation Hint */
        .keyboard-hint {
            position: absolute;
            top: 20px;
            right: 80px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 0.75rem;
            z-index: 10;
            opacity: 0.7;
        }
        
        @media (max-width: 768px) {
            .btn-nav-modal {
                width: 35px;
                height: 35px;
            }
            
            .btn-nav-modal i {
                font-size: 1rem;
            }
            
            .btn-nav-prev {
                left: 10px;
            }
            
            .btn-nav-next {
                right: 10px;
            }
            
            .keyboard-hint {
                display: none;
            }
        }
    </style>
    <link rel="icon" type="image/png" href="{{ asset('images/smk-logo.png') }}">
</head>
<body>
    <nav class="navbar navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('images/smk-logo.png') }}" alt="Logo" width="36" height="36" class="me-2">
                <span class="fw-semibold">SMK Negeri 4 Kota Bogor</span>
            </a>
            <a href="/" class="btn btn-outline-dark btn-sm"><i class="fas fa-home me-1"></i>Beranda</a>
        </div>
    </nav>

    <!-- Banner seperti contoh -->
    <section class="hero text-white py-5 mb-4">
        <div class="container hero-inner text-center">
            <div class="text-uppercase mb-2" style="letter-spacing:.35rem; opacity:.9;">Profil</div>
            <h1 class="display-5 fw-bold">Galeri Foto</h1>
        </div>
    </section>

    <main class="pb-5">
        <div class="container">
            <!-- Modern Filter Kategori with Dropdown -->
            @if(isset($categories) && $categories->count())
                <div class="mb-5">
                    <div class="filter-modern-container">
                        @php
                            // Separate categories into majors and general
                            $majorCategories = ['pplg', 'tjkt', 'tpfl', 'to'];
                            $generalCategories = $categories->filter(function($cat) use ($majorCategories) {
                                return !in_array($cat, $majorCategories);
                            });
                            $majors = $categories->filter(function($cat) use ($majorCategories) {
                                return in_array($cat, $majorCategories);
                            });
                            
                            $icons = [
                                'ekstrakurikuler' => 'users',
                                'prestasi' => 'trophy',
                                'pplg' => 'code',
                                'tjkt' => 'network-wired',
                                'tpfl' => 'industry',
                                'to' => 'car',
                                'transforkrab' => 'industry',
                                'umum' => 'images',
                                'maulid nabi' => 'mosque',
                                'adiwiyata' => 'leaf',
                                'upacara' => 'flag',
                                'neospragma' => 'lightbulb',
                                'p5' => 'project-diagram'
                            ];
                        @endphp
                        
                        <!-- Semua Button with Dropdown (General Categories Only) -->
                        <div class="dropdown">
                            <button class="btn-modern-filter active" type="button" id="semuaDropdown" data-bs-toggle="dropdown" aria-expanded="false" onclick="filterByCategory('all')">
                                <i class="fas fa-th-large me-2"></i>Semua
                                <i class="fas fa-chevron-down ms-2" style="font-size: 0.75rem;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-modern" aria-labelledby="semuaDropdown">
                                @foreach($generalCategories as $category)
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="filterByCategory('{{ $category }}'); return false;">
                                            <i class="fas fa-{{ $icons[$category] ?? 'folder' }} me-2"></i>
                                            {{ $categoryLabels[$category] ?? ucfirst($category) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <!-- Jurusan Dropdown (Always show 4 majors) -->
                        <div class="dropdown">
                            <button class="btn-modern-filter" type="button" id="jurusanDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-graduation-cap me-2"></i>Jurusan
                                <i class="fas fa-chevron-down ms-2" style="font-size: 0.75rem;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-modern" aria-labelledby="jurusanDropdown">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="filterByCategory('pplg'); return false;">
                                        <i class="fas fa-code me-2"></i>PPLG
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="filterByCategory('tjkt'); return false;">
                                        <i class="fas fa-network-wired me-2"></i>TJKT
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="filterByCategory('tpfl'); return false;">
                                        <i class="fas fa-industry me-2"></i>TPFL
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" onclick="filterByCategory('to'); return false;">
                                        <i class="fas fa-car me-2"></i>TO
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Galeri Prestasi Section -->
            @if($prestasiPhotos->count())
                <section class="mb-5">
                    <div class="row g-4">
                        @foreach($prestasiPhotos as $photo)
                            <div class="col-12 col-md-6 col-lg-4 photo-item" data-category="{{ $photo->galery->category }}">
                                <div class="card gallery-card h-100 border-warning">
                                    <div class="position-relative">
                                        <img class="gallery-img" src="{{ \App\Helpers\ImageHelper::getImageUrl($photo->file) }}" alt="Foto Prestasi" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-trophy me-1"></i>Prestasi
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="caption mb-1">{{ $photo->galery->judul ?? $photo->galery->post->judul ?? 'Album ' . ucfirst($photo->galery->category ?? 'Galeri') }}</div>
                                        <div class="meta mb-3"><i class="far fa-calendar me-1"></i>{{ $photo->created_at->format('d M Y') }}</div>
                                        
                                        <!-- Interaction Buttons -->
                                        <div class="interaction-buttons mb-3">
                                            <button class="btn like-btn" data-photo-id="{{ $photo->id }}" title="Like">
                                                <i class="far fa-heart"></i>
                                                <span class="like-count">{{ $photo->likesCount() }}</span>
                                            </button>
                                            <button class="btn comment-btn" data-photo-id="{{ $photo->id }}" title="Komentar">
                                                <i class="far fa-comment"></i>
                                                <span class="btn-count comment-count" style="{{ $photo->comments()->count() > 0 ? '' : 'display: none;' }}">{{ $photo->comments()->count() }}</span>
                                            </button>
                                            <button class="btn share-btn" data-photo-id="{{ $photo->id }}" title="Share" onclick="sharePhoto({{ $photo->id }}, this)">
                                                <i class="fas fa-share-alt"></i>
                                            </button>
                                            <button class="btn download-btn" data-photo-id="{{ $photo->id }}" title="Download" onclick="downloadPhoto({{ $photo->id }}, '{{ $photo->file }}')">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- Comments Section -->
                                        <div class="comments-section" id="comments-{{ $photo->id }}" style="display: none;">
                                            <div class="comments-list mb-3" id="comments-list-{{ $photo->id }}">
                                                <!-- Comments will be loaded here -->
                                            </div>
                                            <form class="comment-form" data-photo-id="{{ $photo->id }}">
                                                <div class="mb-2">
                                                    <input type="text" class="form-control form-control-sm" name="name" placeholder="Nama Anda" required>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="email" class="form-control form-control-sm" name="email" placeholder="Email (opsional)">
                                                </div>
                                                <div class="mb-2">
                                                    <textarea class="form-control form-control-sm" name="comment" rows="2" placeholder="Tulis komentar..." required></textarea>
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Gunakan bahasa yang sopan dan pantas. Komentar dengan kata-kata kasar akan ditolak.
                                                    </small>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">Kirim Komentar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <!-- Galeri Umum Section -->
            @if($generalPhotos->count())
                <section>
                    <div class="text-center mb-4">
                        <h2 class="h3 fw-bold text-primary mb-2">
                            <i class="fas fa-images me-2"></i>Galeri Kegiatan
                        </h2>
                        <p class="text-muted">Berbagai kegiatan dan aktivitas sekolah</p>
                    </div>
                    <div class="row g-4">
                        @foreach($generalPhotos as $photo)
                            <div class="col-12 col-md-6 col-lg-4 photo-item" data-category="{{ $photo->galery->category }}">
                                <div class="card gallery-card h-100">
                                    <div class="position-relative">
                                        <img class="gallery-img" src="{{ \App\Helpers\ImageHelper::getImageUrl($photo->file) }}" alt="Foto Galeri" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                        <div class="position-absolute top-0 end-0 m-2">
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
                                                    'maulid-nabi' => 'Maulid Nabi',
                                                    'neospragma' => 'Neospragma',
                                                    'p5' => 'P5',
                                                    'upacara' => 'Upacara',
                                                    'adiwiyata' => 'Adiwiyata',
                                                    'pmr' => 'PMR',
                                                    'pramuka' => 'Pramuka',
                                                    'osis' => 'OSIS',
                                                    'lainnya' => 'Lainnya'
                                                ];
                                                $categoryColors = [
                                                    'umum' => 'primary',
                                                    'ekstrakurikuler' => 'success',
                                                    'prestasi' => 'warning',
                                                    'pplg' => 'info',
                                                    'tjkt' => 'danger',
                                                    'tpfl' => 'secondary',
                                                    'to' => 'dark',
                                                    'transforkrab' => 'purple',
                                                    'maulid-nabi' => 'success',
                                                    'neospragma' => 'info',
                                                    'p5' => 'primary',
                                                    'upacara' => 'danger',
                                                    'adiwiyata' => 'success',
                                                    'pmr' => 'danger',
                                                    'pramuka' => 'success',
                                                    'osis' => 'primary',
                                                    'lainnya' => 'secondary'
                                                ];
                                                $category = $photo->galery->category;
                                            @endphp
                                            <span class="badge bg-{{ $categoryColors[$category] ?? 'secondary' }} text-white">
                                                {{ $categoryLabels[$category] ?? ucfirst($category) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="caption mb-1">{{ $photo->galery->judul ?? $photo->galery->post->judul ?? 'Album ' . ucfirst($photo->galery->category ?? 'Galeri') }}</div>
                                        <div class="meta mb-3"><i class="far fa-calendar me-1"></i>{{ $photo->created_at->format('d M Y') }}</div>
                                        
                                        <!-- Interaction Buttons -->
                                        <div class="interaction-buttons mb-3">
                                            <button class="btn like-btn" data-photo-id="{{ $photo->id }}" title="Like">
                                                <i class="far fa-heart"></i>
                                                <span class="like-count">{{ $photo->likesCount() }}</span>
                                            </button>
                                            <button class="btn comment-btn" data-photo-id="{{ $photo->id }}" title="Komentar">
                                                <i class="far fa-comment"></i>
                                                <span class="btn-count comment-count" style="{{ $photo->comments()->count() > 0 ? '' : 'display: none;' }}">{{ $photo->comments()->count() }}</span>
                                            </button>
                                            <button class="btn share-btn" data-photo-id="{{ $photo->id }}" title="Share" onclick="sharePhoto({{ $photo->id }}, this)">
                                                <i class="fas fa-share-alt"></i>
                                            </button>
                                            <button class="btn download-btn" data-photo-id="{{ $photo->id }}" title="Download" onclick="downloadPhoto({{ $photo->id }}, '{{ $photo->file }}')">
                                                <i class="fas fa-download"></i>
                                            </button>
                                        </div>
                                        
                                        <!-- Comments Section -->
                                        <div class="comments-section" id="comments-{{ $photo->id }}" style="display: none;">
                                            <div class="comments-list mb-3" id="comments-list-{{ $photo->id }}">
                                                <!-- Comments will be loaded here -->
                                            </div>
                                            <form class="comment-form" data-photo-id="{{ $photo->id }}">
                                                <div class="mb-2">
                                                    <input type="text" class="form-control form-control-sm" name="name" placeholder="Nama Anda" required>
                                                </div>
                                                <div class="mb-2">
                                                    <input type="email" class="form-control form-control-sm" name="email" placeholder="Email (opsional)">
                                                </div>
                                                <div class="mb-2">
                                                    <textarea class="form-control form-control-sm" name="comment" rows="2" placeholder="Tulis komentar..." required></textarea>
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Gunakan bahasa yang sopan dan pantas. Komentar dengan kata-kata kasar akan ditolak.
                                                    </small>
                                                </div>
                                                <button type="submit" class="btn btn-sm btn-primary">Kirim Komentar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if(!$prestasiPhotos->count() && !$generalPhotos->count())
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <p class="subtitle mb-0">Belum ada foto.</p>
                </div>
            @endif
        </div>
    </main>

    <!-- Reusable Image Modal with Navigation -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-image me-2"></i>
                        <span id="modalPhotoTitle">Pratinjau Foto</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 text-center bg-dark position-relative">
                    <!-- Previous Button -->
                    <button class="btn-nav-modal btn-nav-prev" id="prevPhoto" onclick="navigatePhoto(-1)">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <!-- Image -->
                    <img id="modalImage" src="" alt="Preview" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;">
                    
                    <!-- Next Button -->
                    <button class="btn-nav-modal btn-nav-next" id="nextPhoto" onclick="navigatePhoto(1)">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <!-- Photo Counter -->
                    <div class="photo-counter">
                        <span id="currentPhotoIndex">1</span> / <span id="totalPhotos">1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="shareModalLabel">Share this with your social Community</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <!-- Photo Preview -->
                    <div class="mb-4">
                        <img id="sharePhotoPreview" src="" alt="Photo" class="img-fluid rounded shadow" style="max-height: 300px; object-fit: cover;">
                    </div>

                    <!-- Social Media Buttons -->
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <button class="btn btn-lg rounded-circle share-social-btn" id="shareWhatsApp" style="width: 70px; height: 70px; background: #25D366;">
                            <i class="fab fa-whatsapp fa-2x text-white"></i>
                        </button>
                        <button class="btn btn-lg rounded-circle share-social-btn" id="shareInstagram" style="width: 70px; height: 70px; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%);">
                            <i class="fab fa-instagram fa-2x text-white"></i>
                        </button>
                    </div>

                    <!-- Copy Link Section -->
                    <div class="mt-4">
                        <p class="text-muted mb-2">or copy link</p>
                        <div class="input-group">
                            <input type="text" class="form-control" id="shareLinkInput" readonly>
                            <button class="btn btn-dark" type="button" id="copyLinkBtn">Copy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Check if user is logged in
        const isLoggedIn = {{ session('user_id') ? 'true' : 'false' }};
        const loginUrl = "{{ route('user.login.form') }}";
        const currentUserId = {{ session('user_id') ?? 'null' }};
        
        console.log('User login status:', isLoggedIn);
        console.log('Current user ID:', currentUserId);
        
        // Global filter function as fallback
        window.filterByCategory = function(category) {
            console.log('Global filter called:', category);
            
            // Update modern filter button states
            document.querySelectorAll('.btn-modern-filter').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-filter') === category || (category === 'all' && btn.id === 'semuaDropdown')) {
                    btn.classList.add('active');
                }
            });
            
            // Filter photos
            const photoItems = document.querySelectorAll('.photo-item');
            photoItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                if (category === 'all' || itemCategory === category) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        };
    
        // Photo Navigation System
        let allPhotos = [];
        let currentPhotoIndex = 0;
        
        function initPhotoNavigation() {
            // Collect all visible photos
            allPhotos = Array.from(document.querySelectorAll('.gallery-img'))
                .filter(img => img.closest('.photo-item').style.display !== 'none')
                .map(img => ({
                    src: img.getAttribute('src'),
                    title: img.closest('.card-body')?.querySelector('.caption')?.textContent || 'Foto'
                }));
        }
        
        function openPhotoModal(index) {
            currentPhotoIndex = index;
            const photo = allPhotos[currentPhotoIndex];
            
            document.getElementById('modalImage').setAttribute('src', photo.src);
            document.getElementById('modalPhotoTitle').textContent = photo.title;
            document.getElementById('currentPhotoIndex').textContent = currentPhotoIndex + 1;
            document.getElementById('totalPhotos').textContent = allPhotos.length;
            
            updateNavigationButtons();
        }
        
        function navigatePhoto(direction) {
            console.log('Navigate photo:', direction, 'Current:', currentPhotoIndex, 'Total:', allPhotos.length);
            currentPhotoIndex += direction;
            
            // Loop around
            if (currentPhotoIndex < 0) {
                currentPhotoIndex = allPhotos.length - 1;
            } else if (currentPhotoIndex >= allPhotos.length) {
                currentPhotoIndex = 0;
            }
            
            console.log('New index:', currentPhotoIndex);
            openPhotoModal(currentPhotoIndex);
        }
        
        // Make function global
        window.navigatePhoto = navigatePhoto;
        
        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevPhoto');
            const nextBtn = document.getElementById('nextPhoto');
            
            // Disable buttons if only 1 photo
            if (allPhotos.length <= 1) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';
            }
        }
        
        // Klik gambar untuk membuka modal pratinjau
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM loaded, initializing...');
            
            const modalElement = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const bsModal = modalElement ? new bootstrap.Modal(modalElement) : null;
            
            // Initialize photo navigation
            initPhotoNavigation();

            document.querySelectorAll('.gallery-img').forEach(function (img, index) {
                img.addEventListener('click', function (e) {
                    e.stopPropagation();
                    initPhotoNavigation(); // Refresh photo list
                    
                    // Find index in visible photos
                    const visiblePhotos = Array.from(document.querySelectorAll('.gallery-img'))
                        .filter(i => i.closest('.photo-item').style.display !== 'none');
                    const clickedIndex = visiblePhotos.indexOf(img);
                    
                    openPhotoModal(clickedIndex);
                    bsModal.show();
                });
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (modalElement.classList.contains('show')) {
                    if (e.key === 'ArrowLeft') {
                        navigatePhoto(-1);
                    } else if (e.key === 'ArrowRight') {
                        navigatePhoto(1);
                    } else if (e.key === 'Escape') {
                        bsModal.hide();
                    }
                }
            });

            // Filter berdasarkan kategori
            try {
                const filterButtons = document.querySelectorAll('.filter-btn');
                console.log('Filter buttons found:', filterButtons.length);
                
                if (filterButtons.length > 0) {
                    filterButtons.forEach(function(btn){
                        btn.style.cursor = 'pointer'; // Ensure cursor shows it's clickable
                        btn.addEventListener('click', function(e){
                            e.preventDefault();
                            e.stopPropagation();
                            console.log('Filter clicked:', this.getAttribute('data-filter'));
                            
                            // Update active state
                            filterButtons.forEach(b => {
                                b.classList.remove('active', 'btn-primary');
                                b.classList.add('btn-outline-primary');
                            });
                            this.classList.remove('btn-outline-primary');
                            this.classList.add('active', 'btn-primary');

                            const filterCategory = this.getAttribute('data-filter');
                            const photoItems = document.querySelectorAll('.photo-item');
                            console.log('Photo items found:', photoItems.length);
                            
                            let visibleCount = 0;
                            photoItems.forEach(function(item){
                                const itemCategory = item.getAttribute('data-category');
                                if(filterCategory === 'all' || itemCategory === filterCategory){
                                    item.style.display = '';
                                    visibleCount++;
                                } else {
                                    item.style.display = 'none';
                                }
                            });
                            console.log('Visible items:', visibleCount);
                        });
                    });
                    console.log('Filter buttons initialized successfully');
                } else {
                    console.error('No filter buttons found!');
                }
            } catch (error) {
                console.error('Error initializing filter buttons:', error);
            }

            // Load initial interaction counts
            loadInteractionCounts();

            // Like button functionality
            document.querySelectorAll('.like-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const photoId = this.getAttribute('data-photo-id');
                    likePhoto(photoId, this);
                });
            });

            // Comment button functionality
            document.querySelectorAll('.comment-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const photoId = this.getAttribute('data-photo-id');
                    toggleComments(photoId);
                });
            });

            // Comment form submission
            document.querySelectorAll('.comment-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const photoId = this.getAttribute('data-photo-id');
                    submitComment(photoId, this);
                });
            });
            
            // Load initial like and comment counts on page load
            document.querySelectorAll('.like-btn').forEach(function(button) {
                const photoId = button.getAttribute('data-photo-id');
                loadPhotoInteractions(photoId);
            });
            
            console.log('Page initialized successfully!');
        });

        // Load interaction counts for all photos
        function loadInteractionCounts() {
            document.querySelectorAll('.comment-btn').forEach(function(btn) {
                const photoId = btn.getAttribute('data-photo-id');
                fetch(`/api/photo/${photoId}/interactions`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateInteractionButtons(photoId, data.data);
                        }
                    })
                    .catch(error => console.error('Error loading interactions:', error));
            });
        }


        // Update interaction buttons with current state
        function updateInteractionButtons(photoId, data) {
            try {
                const likeBtn = document.querySelector(`[data-photo-id="${photoId}"].like-btn`);
                const commentBtn = document.querySelector(`[data-photo-id="${photoId}"].comment-btn`);

                // Update like button
                if (likeBtn) {
                    const likeCountEl = likeBtn.querySelector('.like-count');
                    const likeIcon = likeBtn.querySelector('i');
                    
                    if (likeCountEl) {
                        const likeCount = data.likes_count || 0;
                        likeCountEl.textContent = likeCount;
                        
                        // Update button style based on user_liked
                        if (data.user_liked) {
                            likeBtn.classList.add('liked');
                            likeIcon.classList.remove('far');
                            likeIcon.classList.add('fas');
                        } else {
                            likeBtn.classList.remove('liked');
                            likeIcon.classList.remove('fas');
                            likeIcon.classList.add('far');
                        }
                    }
                }

                // Update comment button
                if (commentBtn) {
                    const commentCountEl = commentBtn.querySelector('.comment-count');
                    if (commentCountEl && data.comments_count !== undefined) {
                        const commentCount = data.comments_count || 0;
                        commentCountEl.textContent = commentCount;
                        
                        // Show/hide count badge
                        if (commentCount > 0) {
                            commentCountEl.style.display = 'flex';
                        } else {
                            commentCountEl.style.display = 'none';
                        }
                    }
                }
            } catch (error) {
                console.error('Error updating interaction buttons:', error);
            }
        }

        // Like photo function
        function likePhoto(photoId, button) {
            // Check if user is logged in
            if (!isLoggedIn) {
                // Langsung redirect ke halaman login user
                window.location.href = '/user/login';
                return;
            }
            
            // Optimistic UI Update
            const likeCountEl = button.querySelector('.like-count');
            const likeIcon = button.querySelector('i');
            
            if (!likeCountEl) {
                console.error('Like count element not found!');
                return;
            }
            
            const currentCount = parseInt(likeCountEl.textContent) || 0;
            const isLiked = button.classList.contains('liked');
            
            // Toggle UI immediately for better UX
            if (isLiked) {
                // Unlike
                button.classList.remove('liked');
                likeIcon.classList.remove('fas');
                likeIcon.classList.add('far');
                likeCountEl.textContent = Math.max(0, currentCount - 1);
            } else {
                // Like
                button.classList.add('liked');
                likeIcon.classList.remove('far');
                likeIcon.classList.add('fas');
                likeCountEl.textContent = currentCount + 1;
                
                // Add pulse animation
                button.style.animation = 'pulse 0.3s ease-in-out';
                setTimeout(() => {
                    button.style.animation = '';
                }, 300);
            }
            
            // Send request to server
            fetch(`/api/photo/${photoId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Like response:', data);
                if (data.success && data.data) {
                    // Update with server data
                    const serverCount = data.data.likes_count || 0;
                    console.log(`Server returned - Likes: ${serverCount}, User Liked: ${data.data.user_liked}, Identifier: ${data.data.debug_identifier}`);
                    likeCountEl.textContent = serverCount;
                    
                    // Ensure button state matches server
                    if (data.data.user_liked) {
                        button.classList.add('liked');
                        likeIcon.classList.remove('far');
                        likeIcon.classList.add('fas');
                    } else {
                        button.classList.remove('liked');
                        likeIcon.classList.remove('fas');
                        likeIcon.classList.add('far');
                    }
                } else {
                    console.error('Like failed:', data);
                    // Revert UI on error
                    if (isLiked) {
                        button.classList.add('liked');
                        likeIcon.classList.remove('far');
                        likeIcon.classList.add('fas');
                        likeCountEl.textContent = currentCount;
                    } else {
                        button.classList.remove('liked');
                        likeIcon.classList.remove('fas');
                        likeIcon.classList.add('far');
                        likeCountEl.textContent = currentCount;
                    }
                    showAlert('Gagal melakukan like. Silakan coba lagi.', 'danger');
                }
            })
            .catch(error => {
                console.error('Error liking photo:', error);
                // Revert UI on error
                if (isLiked) {
                    button.classList.add('liked');
                    likeIcon.classList.remove('far');
                    likeIcon.classList.add('fas');
                    likeCountEl.textContent = currentCount;
                } else {
                    button.classList.remove('liked');
                    likeIcon.classList.remove('fas');
                    likeIcon.classList.add('far');
                    likeCountEl.textContent = currentCount;
                }
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
            });
        }

        // Share photo function
        function sharePhoto(photoId, button) {
            // Check if user is logged in
            if (!isLoggedIn) {
                // Langsung redirect ke halaman login user
                window.location.href = '/user/login';
                return;
            }
            
            // Get photo element and URL
            const photoCard = button.closest('.card');
            const photoImg = photoCard.querySelector('.gallery-img');
            const photoSrc = photoImg ? photoImg.src : '';
            
            // Use APP_URL from .env (supports Ngrok URL)
            const baseUrl = '{{ config("app.url") }}';
            const photoUrl = baseUrl + '/foto/' + photoId;
            const photoTitle = photoCard.querySelector('.caption')?.textContent || 'Galeri Foto SMK Negeri 4';
            
            // Set modal content
            document.getElementById('sharePhotoPreview').src = photoSrc;
            document.getElementById('shareLinkInput').value = photoUrl;
            
            // Show modal
            const shareModal = new bootstrap.Modal(document.getElementById('shareModal'));
            shareModal.show();
            
            // Setup share buttons
            document.getElementById('shareWhatsApp').onclick = function() {
                const whatsappText = encodeURIComponent(`Lihat foto dari ${photoTitle}\n\nSMK Negeri 4 Kota Bogor\n\n${photoUrl}`);
                
                // Detect if mobile or desktop
                const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
                
                if (isMobile) {
                    // Mobile: Open WhatsApp app
                    window.location.href = `whatsapp://send?text=${whatsappText}`;
                } else {
                    // Desktop: Open WhatsApp Web
                    window.open(`https://wa.me/?text=${whatsappText}`, '_blank');
                }
            };
            
            document.getElementById('shareInstagram').onclick = function() {
                // Instagram doesn't support direct sharing via URL, so we copy link and show instruction
                navigator.clipboard.writeText(photoUrl).then(() => {
                    showAlert('📋 Link disalin! Buka Instagram dan paste link di bio atau story Anda.', 'info');
                });
            };
            
            document.getElementById('copyLinkBtn').onclick = function() {
                const linkInput = document.getElementById('shareLinkInput');
                linkInput.select();
                navigator.clipboard.writeText(photoUrl).then(() => {
                    showAlert('📋 Link berhasil disalin!', 'success');
                    this.textContent = 'Copied!';
                    setTimeout(() => {
                        this.textContent = 'Copy';
                    }, 2000);
                });
            };
        }

        // Download photo function
        function downloadPhoto(photoId, filename) {
            // Check if user is logged in
            if (!isLoggedIn) {
                // Langsung redirect ke halaman login user
                window.location.href = '/user/login';
                return;
            }
            
            // If logged in, proceed with download
            const downloadUrl = '/storage/galeri/' + filename;
            const link = document.createElement('a');
            link.href = downloadUrl;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            showAlert('✅ Foto berhasil didownload!', 'success');
        }

        // Daftar kata-kata tidak pantas (bad words filter)
        const badWords = [
            'anjing', 'anj', 'anjir', 'anjay', 'babi', 'bangsat', 'bajingan', 'kampret', 
            'goblok', 'goblog', 'tolol', 'bodoh', 'bego', 'idiot', 'kontol', 'memek', 
            'ngentot', 'jancok', 'jancuk', 'asu', 'kimak', 'puki', 'perek', 'pelacur',
            'fuck', 'shit', 'bitch', 'ass', 'damn', 'hell', 'bastard', 'dick', 'sex',
            'tai', 'taik', 'sial', 'sialan', 'brengsek', 'monyet', 'kunyuk', 'bangke',
            'keparat', 'bedebah', 'setan', 'iblis', 'laknat', 'celaka', 'busuk'
        ];

        // Function to check if text contains bad words
        function containsBadWords(text) {
            const lowerText = text.toLowerCase();
            for (let word of badWords) {
                if (lowerText.includes(word)) {
                    return word;
                }
            }
            return null;
        }
        
        // Load photo interactions from server
        function loadPhotoInteractions(photoId) {
            fetch(`/api/photo/${photoId}/interactions`)
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data) {
                        console.log(`Photo ${photoId} - Likes: ${data.data.likes_count}, User Liked: ${data.data.user_liked}, User ID: ${currentUserId}, Identifier: ${data.data.debug_identifier}`);
                        updateInteractionButtons(photoId, data.data);
                    } else {
                        console.error('Failed to load interactions:', data);
                    }
                })
                .catch(error => console.error('Error loading interactions for photo', photoId, ':', error));
        }

        // Toggle comments section
        function toggleComments(photoId) {
            console.log('Toggle comments for photo:', photoId);
            
            const commentsSection = document.getElementById(`comments-${photoId}`);
            const commentBtn = document.querySelector(`[data-photo-id="${photoId}"].comment-btn`);
            
            console.log('Comments section:', commentsSection);
            console.log('Comment button:', commentBtn);
            
            if (!commentsSection) {
                console.error('Comments section not found for photo:', photoId);
                return;
            }
            
            if (commentsSection.style.display === 'none' || commentsSection.style.display === '') {
                commentsSection.style.display = 'block';
                if (commentBtn) commentBtn.classList.add('active');
                loadComments(photoId);
                console.log('Comments opened');
            } else {
                commentsSection.style.display = 'none';
                if (commentBtn) commentBtn.classList.remove('active');
                console.log('Comments closed');
            }
        }

        // Load comments for a photo
        function loadComments(photoId) {
            fetch(`/api/photo/${photoId}/interactions`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayComments(photoId, data.data.comments);
                    }
                })
                .catch(error => console.error('Error loading comments:', error));
        }

        // Display comments
        function displayComments(photoId, comments) {
            const commentsList = document.getElementById(`comments-list-${photoId}`);
            commentsList.innerHTML = '';

            if (comments.length === 0) {
                commentsList.innerHTML = '<p class="text-muted small">Belum ada komentar.</p>';
                return;
            }

            comments.forEach(function(comment) {
                const commentElement = document.createElement('div');
                commentElement.className = 'comment-item border-bottom pb-2 mb-2';
                commentElement.innerHTML = `
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong class="small">${comment.name}</strong>
                            <p class="small mb-1">${comment.comment}</p>
                        </div>
                        <small class="text-muted">${new Date(comment.created_at).toLocaleDateString('id-ID')}</small>
                    </div>
                `;
                commentsList.appendChild(commentElement);
            });
        }

        // Submit comment
        function submitComment(photoId, form) {
            // Check if user is logged in
            if (!isLoggedIn) {
                showAlert('⚠️ Anda harus login terlebih dahulu untuk menambahkan komentar!', 'warning');
                setTimeout(() => {
                    if (confirm('Anda harus login untuk menambahkan komentar. Redirect ke halaman login?')) {
                        window.location.href = loginUrl;
                    }
                }, 500);
                return;
            }
            
            const formData = new FormData(form);
            const commentText = formData.get('comment');
            
            // Check for bad words
            const badWord = containsBadWords(commentText);
            if (badWord) {
                showAlert(`⚠️ PERINGATAN: Komentar Anda mengandung kata tidak pantas "${badWord}". Mohon gunakan bahasa yang sopan dan santun!`, 'danger');
                return;
            }
            
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                comment: commentText
            };

            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Mengirim...';
            submitBtn.disabled = true;

            fetch(`/api/photo/${photoId}/comment`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    form.reset();
                    loadComments(photoId);
                    loadInteractionCounts(); // Refresh counts
                    
                    // Langsung tampilkan komentar tanpa alert
                } else {
                    if (data.error === 'inappropriate_content') {
                        // Show warning for inappropriate content
                        showAlert('⚠️ ' + data.message, 'warning');
                        
                        // Highlight the comment field
                        const commentField = form.querySelector('textarea[name="comment"]');
                        commentField.style.borderColor = '#dc3545';
                        commentField.style.backgroundColor = '#fff5f5';
                        
                        // Reset styling after 3 seconds
                        setTimeout(() => {
                            commentField.style.borderColor = '';
                            commentField.style.backgroundColor = '';
                        }, 3000);
                    } else {
                        showAlert('Gagal mengirim komentar: ' + data.message, 'danger');
                    }
                }
            })
            .catch(error => {
                console.error('Error submitting comment:', error);
                showAlert('Gagal mengirim komentar. Silakan coba lagi.', 'danger');
            })
            .finally(() => {
                // Reset button state
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        }

        // Show alert message
        function showAlert(message, type = 'info') {
            // Remove existing alerts
            const existingAlerts = document.querySelectorAll('.comment-alert');
            existingAlerts.forEach(alert => alert.remove());

            // Create alert element
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show comment-alert`;
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '9999';
            alertDiv.style.minWidth = '300px';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            // Add to page
            document.body.appendChild(alertDiv);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);
        }
    </script>
    </body>
    </html>


