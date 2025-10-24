<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPLG - SMK Negeri 4 Kota Bogor</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><path d='M50 5 L85 20 L85 70 L50 95 L15 70 L15 20 Z' fill='%231e40af'/><rect x='15' y='15' width='70' height='12' fill='%23dc2626'/><text x='50' y='24' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='8' font-weight='bold'>SMK NEGERI 4</text><rect x='35' y='30' width='30' height='8' fill='%23dc2626'/><rect x='40' y='38' width='20' height='4' fill='%23dc2626'/><rect x='45' y='42' width='10' height='8' fill='%23dc2626'/><path d='M25 35 L35 35 L30 45 Z' fill='%23dc2626'/><path d='M65 35 L75 35 L70 45 Z' fill='%23dc2626'/><rect x='70' y='38' width='8' height='4' fill='%231f2937'/><circle cx='50' cy='60' r='12' fill='%23f97316'/><circle cx='50' cy='60' r='8' fill='%231e40af'/><circle cx='50' cy='60' r='4' fill='%23f97316'/><rect x='38' y='48' width='4' height='6' fill='%23f97316'/><rect x='58' y='48' width='4' height='6' fill='%23f97316'/><rect x='48' y='38' width='4' height='6' fill='%23f97316'/><rect x='48' y='56' width='4' height='6' fill='%23f97316'/><path d='M40 70 L60 70 L60 80 L40 80 Z' fill='white' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='72' x2='55' y2='72' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='75' x2='55' y2='75' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='78' x2='55' y2='78' stroke='%231e40af' stroke-width='0.5'/><text x='50' y='90' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='6' font-weight='bold'>KOTA BOGOR</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #dc2626;
            --accent-color: #f97316;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .hero-jurusan {
            color: white;
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-jurusan .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/jurusan/pplg-bg-2.jpg.JPG') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            filter: blur(4px);
            transform: scale(1.05);
            z-index: 0;
        }

        .hero-jurusan .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(102,126,234,0.25) 0%, rgba(118,75,162,0.25) 50%, rgba(30,64,175,0.3) 100%);
            z-index: 1;
        }
        
        .hero-jurusan .container {
            position: relative;
            z-index: 2;
        }
        
        .hero-jurusan::after { display: none; }
        
        @keyframes gradientShift {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        
        .hero-title {
            animation: fadeInUp 1s ease-out;
        }
        
        .hero-subtitle {
            animation: fadeInUp 1s ease-out 0.2s both;
        }
        
        .jurusan-logo-large {
            animation: fadeInUp 1s ease-out 0.4s both;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255,255,255,0.05) 0%, transparent 50%);
            z-index: 1;
        }
        
        .hero-decoration {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
        }
        
        .decoration-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 6s ease-in-out infinite;
        }
        
        .decoration-circle:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .decoration-circle:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }
        
        .decoration-circle:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--dark-color);
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .jurusan-logo-large {
            width: 150px;
            height: 150px;
            object-fit: contain;
            background: white;
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .info-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .skill-item {
            background: #f8fafc;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary-color);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: transform 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .activity-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .activity-image {
            position: relative;
            overflow: hidden;
            height: 200px;
        }

        .activity-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .activity-card:hover .activity-image img {
            transform: scale(1.1);
        }

        .activity-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .activity-card:hover .activity-overlay {
            transform: translateY(0);
        }

        .activity-info h6 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .activity-info p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .footer {
            background: var(--dark-color);
            color: white;
            padding: 40px 0 20px;
            margin-top: 4rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="me-3">
                    <svg width="40" height="40" viewBox="0 0 100 100">
                        <path d="M50 5 L85 20 L85 70 L50 95 L15 70 L15 20 Z" fill="#1e40af"/>
                        <rect x="15" y="15" width="70" height="12" fill="#dc2626"/>
                        <text x="50" y="24" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="8" font-weight="bold">SMK NEGERI 4</text>
                        <rect x="35" y="30" width="30" height="8" fill="#dc2626"/>
                        <rect x="40" y="38" width="20" height="4" fill="#dc2626"/>
                        <rect x="45" y="42" width="10" height="8" fill="#dc2626"/>
                        <path d="M25 35 L35 35 L30 45 Z" fill="#dc2626"/>
                        <path d="M65 35 L75 35 L70 45 Z" fill="#dc2626"/>
                        <rect x="70" y="38" width="8" height="4" fill="#1f2937"/>
                        <circle cx="50" cy="60" r="12" fill="#f97316"/>
                        <circle cx="50" cy="60" r="8" fill="#1e40af"/>
                        <circle cx="50" cy="60" r="4" fill="#f97316"/>
                        <rect x="38" y="48" width="4" height="6" fill="#f97316"/>
                        <rect x="58" y="48" width="4" height="6" fill="#f97316"/>
                        <rect x="48" y="38" width="4" height="6" fill="#f97316"/>
                        <rect x="48" y="56" width="4" height="6" fill="#f97316"/>
                        <path d="M40 70 L60 70 L60 80 L40 80 Z" fill="white" stroke="#1e40af" stroke-width="0.5"/>
                        <line x1="45" y1="72" x2="55" y2="72" stroke="#1e40af" stroke-width="0.5"/>
                        <line x1="45" y1="75" x2="55" y2="75" stroke="#1e40af" stroke-width="0.5"/>
                        <line x1="45" y1="78" x2="55" y2="78" stroke="#1e40af" stroke-width="0.5"/>
                        <text x="50" y="90" text-anchor="middle" fill="white" font-family="Arial, sans-serif" font-size="6" font-weight="bold">KOTA BOGOR</text>
                    </svg>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold text-primary">SMK NEGERI 4</h4>
                    <small class="text-muted">KOTA BOGOR</small>
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#gallery">Galeri</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="jurusanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Jurusan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="jurusanDropdown">
                            <li><a class="dropdown-item" href="{{ route('jurusan.pplg') }}">PPLG</a></li>
                            <li><a class="dropdown-item" href="{{ route('jurusan.tjkt') }}">TJKT</a></li>
                            <li><a class="dropdown-item" href="{{ route('jurusan.tpfl') }}">TPFL</a></li>
                            <li><a class="dropdown-item" href="{{ route('jurusan.to') }}">TO</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#news">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-jurusan">
        <div class="hero-bg"></div>
        <div class="hero-overlay"></div>
        <!-- Background Pattern -->
        <div class="hero-pattern"></div>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/jurusan/pplg-logo.png') }}" alt="Logo PPLG" class="jurusan-logo-large">
                    </div>
                    <h1 class="hero-title">PPLG</h1>
                    <p class="hero-subtitle">Pengembangan Perangkat Lunak dan Gim</p>
                    <p class="lead">Jurusan unggulan yang mempersiapkan siswa untuk menjadi developer profesional di era digital</p>
                    
                    <!-- Decorative Elements -->
                    <div class="hero-decoration">
                        <div class="decoration-circle"></div>
                        <div class="decoration-circle"></div>
                        <div class="decoration-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Kegiatan PPLG -->
    <section class="py-5" style="background: white;">
        <div class="container">
            <h2 class="section-title">Galeri Kegiatan PPLG</h2>
            <p class="text-center text-muted mb-5">Dokumentasi kegiatan pembelajaran dan praktik di laboratorium PPLG</p>
            
            @if($activities->count() > 0)
                <div class="row g-4">
                    @foreach($activities as $activity)
                    <div class="col-lg-3 col-md-6">
                        <div class="activity-card">
                            <div class="activity-image">
                                @if($activity->fotos->count() > 0)
                                    @php
                                        $imageUrl = \App\Helpers\ImageHelper::getImageUrl($activity->fotos->first()->file);
                                    @endphp
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $activity->post->judul }}" 
                                         class="img-fluid gallery-image" 
                                         style="cursor: pointer;"
                                         onclick="openImageModal('{{ $imageUrl }}', '{{ $activity->post->judul }}')">
                                @else
                                    <img src="{{ asset('images/placeholder.jpg') }}" alt="Placeholder" class="img-fluid">
                                @endif
                                <div class="activity-overlay">
                                    <div class="activity-info">
                                        <h6>{{ $activity->post->judul }}</h6>
                                        <p>{{ Str::limit($activity->post->konten, 100) }}</p>
                                        <small class="text-light">{{ $activity->fotos->count() }} foto</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada kegiatan yang ditambahkan</h5>
                    <p class="text-muted">Admin dapat menambahkan foto kegiatan PPLG melalui panel admin</p>
                </div>
            @endif
            
            <div class="text-center mt-5">
                <a href="{{ route('home') }}#gallery" class="btn btn-outline-primary">
                    <i class="fas fa-images me-2"></i>
                    Lihat Galeri Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- Deskripsi Jurusan -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h2 class="section-title text-start">Tentang Jurusan PPLG</h2>
                    <p class="lead mb-4">
                        Jurusan Pengembangan Perangkat Lunak dan Gim (PPLG) adalah program keahlian yang dirancang untuk menghasilkan lulusan yang kompeten dalam pengembangan aplikasi dan permainan digital.
                    </p>
                    <p class="mb-4">
                        Siswa akan mempelajari berbagai teknologi modern seperti pemrograman web, mobile app development, game development, database management, dan software engineering. Jurusan ini sangat relevan dengan kebutuhan industri teknologi yang terus berkembang.
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
                <div class="col-lg-6">
                    <div class="info-card">
                        <h4 class="mb-3"><i class="fas fa-graduation-cap text-primary me-2"></i>Kompetensi Lulusan</h4>
                        <div class="skill-item">
                            <h6 class="mb-2">Web Developer</h6>
                            <p class="mb-0 text-muted">Menguasai pengembangan website modern dengan teknologi terkini</p>
                        </div>
                        <div class="skill-item">
                            <h6 class="mb-2">Mobile App Developer</h6>
                            <p class="mb-0 text-muted">Kemampuan membuat aplikasi mobile untuk Android dan iOS</p>
                        </div>
                        <div class="skill-item">
                            <h6 class="mb-2">Game Developer</h6>
                            <p class="mb-0 text-muted">Mengembangkan permainan digital dengan engine modern</p>
                        </div>
                        <div class="skill-item">
                            <h6 class="mb-2">Software Engineer</h6>
                            <p class="mb-0 text-muted">Memahami prinsip rekayasa perangkat lunak</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 SMK Negeri 4 Kota Bogor. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="imageModalLabel">Preview Foto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0 text-center">
                    <img id="modalImage" src="" alt="Preview" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to open image modal
        function openImageModal(imageUrl, title) {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('imageModalLabel');
            
            modalImage.src = imageUrl;
            modalTitle.textContent = title || 'Preview Foto';
            modal.show();
        }

        // Add hover effect to gallery images
        document.addEventListener('DOMContentLoaded', function() {
            const galleryImages = document.querySelectorAll('.gallery-image');
            galleryImages.forEach(img => {
                img.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                    this.style.transition = 'transform 0.3s ease';
                });
                img.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>
