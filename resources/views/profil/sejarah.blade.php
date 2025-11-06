<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah - SMK Negeri 4 Kota Bogor</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><path d='M50 5 L85 20 L85 70 L50 95 L15 70 L15 20 Z' fill='%231e40af'/><rect x='15' y='15' width='70' height='12' fill='%23dc2626'/><text x='50' y='24' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='8' font-weight='bold'>SMK NEGERI 4</text><rect x='35' y='30' width='30' height='8' fill='%23dc2626'/><rect x='40' y='38' width='20' height='4' fill='%23dc2626'/><rect x='45' y='42' width='10' height='8' fill='%23dc2626'/><path d='M25 35 L35 35 L30 45 Z' fill='%23dc2626'/><path d='M65 35 L75 35 L70 45 Z' fill='%23dc2626'/><rect x='70' y='38' width='8' height='4' fill='%231f2937'/><circle cx='50' cy='60' r='12' fill='%23f97316'/><circle cx='50' cy='60' r='8' fill='%231e40af'/><circle cx='50' cy='60' r='4' fill='%23f97316'/><rect x='38' y='48' width='4' height='6' fill='%23f97316'/><rect x='58' y='48' width='4' height='6' fill='%23f97316'/><rect x='48' y='38' width='4' height='6' fill='%23f97316'/><rect x='48' y='56' width='4' height='6' fill='%23f97316'/><path d='M40 70 L60 70 L60 80 L40 80 Z' fill='white' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='72' x2='55' y2='72' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='75' x2='55' y2='75' stroke='%231e40af' stroke-width='0.5'/><line x1='45' y1='78' x2='55' y2='78' stroke='%231e40af' stroke-width='0.5'/><text x='50' y='90' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='6' font-weight='bold'>KOTA BOGOR</text></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #dc2626;
            --accent-color:rgb(96, 130, 199);
            --success-color:rgb(194, 158, 143);
            --warning-color:rgb(45, 72, 105);
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
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 25px rgba(0,0,0,0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand h4 {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            font-weight: 600;
            color: #2c3e50;
        }

        .navbar-brand small {
            margin-top: -2px;
            line-height: 1;
            color: #7f8c8d;
            font-weight: 400;
        }

        .navbar-nav .nav-link {
            color: #2c3e50 !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(30, 64, 175, 0.1);
        }

        .hero-header {
            background: linear-gradient(135deg,rgb(71, 121, 161) 0%,rgb(73, 111, 161) 100%);
            color: white;
            padding: 120px 0 80px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset('images/smk-gedung.jpg') }}') center/cover;
            opacity: 0.1;
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .breadcrumb-nav {
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            display: inline-block;
            backdrop-filter: blur(10px);
        }

        .breadcrumb-nav a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s ease;
        }

        .breadcrumb-nav a:hover {
            opacity: 0.8;
        }

        .content-section {
            padding: 80px 0;
        }

        .sejarah-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .sejarah-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .card-header-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .card-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg,rgb(75, 73, 160) 0%,rgb(72, 87, 147) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 30px rgba(249, 115, 22, 0.3);
        }

        .card-icon i {
            font-size: 3rem;
            color: white;
        }

        .card-title {
            color:rgb(71, 100, 150);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .card-subtitle {
            color: #6b7280;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .timeline {
            position: relative;
            margin: 3rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg,rgb(72, 88, 152) 0%,rgb(72, 125, 168) 100%);
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
        }

        .timeline-item:nth-child(odd) {
            flex-direction: row;
        }

        .timeline-item:nth-child(even) {
            flex-direction: row-reverse;
        }

        .timeline-content {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 45%;
            position: relative;
            transition: transform 0.3s ease;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.6s ease;
        }

        .timeline-content.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .timeline-content.animate:hover {
            transform: translateY(-5px);
        }

        .timeline-item:nth-child(odd) .timeline-content {
            margin-right: 5%;
        }

        .timeline-item:nth-child(even) .timeline-content {
            margin-left: 5%;
        }

        .timeline-marker {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background:rgb(90, 121, 164);
            border: 4px solid white;
            border-radius: 50%;
            box-shadow: 0 0 0 4pxrgb(82, 110, 171);
            z-index: 2;
        }

        .timeline-year {
            background: linear-gradient(135deg,rgb(72, 131, 159) 0%,rgb(72, 131, 159) 100%);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .timeline-title {
            color: #1f2937;
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .timeline-description {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        .milestone-section {
            background: linear-gradient(135deg,rgb(72, 131, 152) 0%,rgb(72, 131, 152) 100%);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin: 3rem 0;
        }

        .milestone-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .milestone-description {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .back-btn {
            background: linear-gradient(135deg,rgb(72, 131, 159) 0%,rgb(72, 131, 167) 100%);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3);
        }

        .back-btn:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(249, 115, 22, 0.4);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .sejarah-card {
                padding: 2rem;
            }

            .card-title {
                font-size: 2rem;
            }

            .card-icon {
                width: 80px;
                height: 80px;
            }

            .card-icon i {
                font-size: 2.5rem;
            }

            .timeline::before {
                left: 20px;
            }

            .timeline-item {
                flex-direction: column !important;
                align-items: flex-start;
            }

            .timeline-content {
                width: calc(100% - 40px);
                margin-left: 40px !important;
                margin-right: 0 !important;
            }

            .timeline-marker {
                left: 20px;
                transform: translate(-50%, -50%);
            }

            .milestone-section {
                padding: 2rem;
            }

            .milestone-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="me-3">
                    <div style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #1e40af; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
                        <svg width="30" height="30" viewBox="0 0 100 100">
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
                </div>
                <div class="d-flex flex-column justify-content-center" style="height: 40px; margin-top: 3px;">
                    <h4 class="mb-0 fw-bold" style="line-height: 1; font-size: 1.2rem; margin-bottom: 2px; color: #2c3e50;">SMK NEGERI 4</h4>
                    <small style="line-height: 1; font-size: 0.85rem; color: #7f8c8d;">KOTA BOGOR</small>
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#majors">Jurusan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#news">Berita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#about">Tentang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <section class="hero-header">
        <div class="hero-content">
            <h1 class="hero-title">Sejarah</h1>
            <p class="hero-subtitle">Perjalanan Panjang SMK Negeri 4 Kota Bogor</p>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Beranda</a> / 
                <a href="{{ route('home') }}#home">Profil Sekolah</a> / 
                <span>Sejarah</span>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="sejarah-card">
                        <div class="card-header-section">
                            <div class="card-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <h2 class="card-title">Sejarah Sekolah</h2>
                            <p class="card-subtitle">
                                SMK Negeri 4 Kota Bogor telah melalui perjalanan panjang dalam membangun 
                                pendidikan berkualitas dan menghasilkan generasi unggul untuk masa depan Indonesia.
                            </p>
                        </div>

                        <!-- Timeline -->
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-year">2008-2009</div>
                                    <h3 class="timeline-title">Pendirian Sekolah</h3>
                                    <p class="timeline-description">
                                    SMK Negeri (SMKN) 4 Bogor didirikan dan dirintis pada tahun 2008, kemudian dibuka pada tahun 2009 dengan dasar Surat Keputusan (SK) Pendirian Sekolah nomor 421-45-177 TAHUN 2009 tertanggal 15 Juni 2009.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-year">2008-2009</div>
                                    <h3 class="timeline-title">Pengembangan Jurusan</h3>
                                    <p class="timeline-description">
                                        Sekolah mulai mengembangkan berbagai jurusan teknik yang relevan 
                                        dengan kebutuhan industri, termasuk Teknik Otomotif, Teknik Pengelasan dan Fabrikasi Logam, Pengembangan perangkat lunak dan gim , Teknik Jaringan Komputer dan Telekomunikasi.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-year">2021</div>
                                    <h3 class="timeline-title">Akreditasi A</h3>
                                    <p class="timeline-description">
                                        Semua jurusan di SMK Negeri 4 Kota Bogor berhasil meraih akreditasi A, 
                                        membuktikan kualitas pendidikan yang tinggi dan standar pembelajaran 
                                        yang sesuai dengan standar nasional.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-content">
                                    <div class="timeline-year">2025</div>
                                    <h3 class="timeline-title">Masa Depan</h3>
                                    <p class="timeline-description">
                                        Sekolah terus berkomitmen untuk menghasilkan lulusan berkualitas 
                                        dengan kompetensi digital dan karakter bangsa yang kuat, 
                                        siap menghadapi tantangan global.
                                    </p>
                                </div>
                                <div class="timeline-marker"></div>
                            </div>
                        </div>

                        <!-- Milestone Section -->
                        <div class="milestone-section">
                            <h3 class="milestone-title">Pencapaian & Prestasi</h3>
                            <p class="milestone-description">
                                Sepanjang perjalanannya, SMK Negeri 4 Kota Bogor telah meraih berbagai prestasi 
                                dan penghargaan dalam bidang akademik, non-akademik, dan pengembangan sekolah. 
                                Sekolah ini telah menjadi salah satu SMK unggulan di Jawa Barat yang dikenal 
                                dengan kualitas lulusannya yang siap kerja dan berwawasan global.
                            </p>
                        </div>

                        <!-- Back Button -->
                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="back-btn">
                                <i class="fas fa-arrow-left"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Timeline Animation on Scroll
        function animateTimelineItems() {
            const timelineItems = document.querySelectorAll('.timeline-content');
            
            timelineItems.forEach((item, index) => {
                const rect = item.getBoundingClientRect();
                const isInView = rect.top < window.innerHeight * 0.8 && rect.bottom > 0;
                
                if (isInView && !item.classList.contains('animate')) {
                    // Add staggered delay for each item
                    setTimeout(() => {
                        item.classList.add('animate');
                    }, index * 200); // 200ms delay between each item
                }
            });
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 4px 30px rgba(0,0,0,0.15)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 2px 25px rgba(0,0,0,0.08)';
            }
            
            // Trigger timeline animation
            animateTimelineItems();
        });

        // Initial check when page loads
        document.addEventListener('DOMContentLoaded', function() {
            animateTimelineItems();
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
