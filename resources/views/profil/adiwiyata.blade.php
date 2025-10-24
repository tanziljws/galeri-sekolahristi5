<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adiwiyata - SMK Negeri 4 Kota Bogor</title>
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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

        .adiwiyata-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .adiwiyata-card:hover {
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
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
        }

        .card-icon i {
            font-size: 3rem;
            color: white;
        }

        .card-title {
            color: #10b981;
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

        .program-section {
            background: #f0fdf4;
            border-radius: 15px;
            padding: 2rem;
            border-left: 5px solid #10b981;
            margin-bottom: 2rem;
        }

        .program-title {
            color: #10b981;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .program-description {
            color: #374151;
            font-size: 1rem;
            line-height: 1.6;
            margin: 0;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }

        .feature-item {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
            border: 2px solid transparent;
        }

        .feature-item:hover {
            transform: translateY(-5px);
            border-color: #10b981;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .feature-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .feature-title {
            color: #10b981;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .feature-description {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.5;
            margin: 0;
        }

        .achievement-section {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            margin: 2rem 0;
        }

        .achievement-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .achievement-description {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .back-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
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
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .back-btn:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.4);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .adiwiyata-card {
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

            .feature-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .achievement-section {
                padding: 2rem;
            }

            .achievement-title {
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Header -->
    <section class="hero-header">
        <div class="hero-content">
            <h1 class="hero-title">Adiwiyata</h1>
            <p class="hero-subtitle">Program Sekolah Berwawasan Lingkungan</p>
            <div class="breadcrumb-nav">
                <a href="{{ route('home') }}">Beranda</a> / 
                <a href="{{ route('home') }}#home">Profil Sekolah</a> / 
                <span>Adiwiyata</span>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="adiwiyata-card">
                        <div class="card-header-section">
                            <div class="card-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h2 class="card-title">Program Adiwiyata</h2>
                            <p class="card-subtitle">
                                SMK Negeri 4 Kota Bogor berkomitmen untuk mengembangkan sekolah berwawasan lingkungan 
                                melalui program Adiwiyata yang berkelanjutan dan terintegrasi dalam seluruh aspek pembelajaran.
                            </p>
                        </div>

                        <!-- Program Overview -->
                        <div class="program-section">
                            <h3 class="program-title">
                                <i class="fas fa-seedling"></i>
                                Tentang Program Adiwiyata
                            </h3>
                            <p class="program-description">
                                Program Adiwiyata adalah program Kementerian Lingkungan Hidup yang bertujuan untuk 
                                mewujudkan sekolah yang peduli dan berbudaya lingkungan. Program ini mendorong sekolah 
                                untuk melaksanakan kebijakan sekolah berwawasan lingkungan hidup, melaksanakan kurikulum 
                                berbasis lingkungan, dan melaksanakan kegiatan berbasis partisipatif.
                            </p>
                        </div>

                        <!-- Features Grid -->
                        <div class="feature-grid">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-recycle"></i>
                                </div>
                                <h4 class="feature-title">Pengelolaan Sampah</h4>
                                <p class="feature-description">
                                    Implementasi sistem pengelolaan sampah yang ramah lingkungan dengan pemilahan 
                                    sampah organik dan anorganik, serta pengolahan sampah menjadi kompos.
                                </p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-tint"></i>
                                </div>
                                <h4 class="feature-title">Konservasi Air</h4>
                                <p class="feature-description">
                                    Program penghematan air melalui sistem irigasi yang efisien, penampungan air hujan, 
                                    dan edukasi tentang pentingnya konservasi air.
                                </p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-solar-panel"></i>
                                </div>
                                <h4 class="feature-title">Energi Terbarukan</h4>
                                <p class="feature-description">
                                    Pemanfaatan energi matahari melalui panel surya untuk kebutuhan listrik sekolah 
                                    dan edukasi tentang energi bersih.
                                </p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-tree"></i>
                                </div>
                                <h4 class="feature-title">Penghijauan</h4>
                                <p class="feature-description">
                                    Program penghijauan sekolah dengan penanaman pohon, pembuatan taman, dan 
                                    pengembangan kebun sekolah yang produktif.
                                </p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4 class="feature-title">Partisipasi Masyarakat</h4>
                                <p class="feature-description">
                                    Melibatkan seluruh warga sekolah dan masyarakat sekitar dalam program 
                                    lingkungan hidup yang berkelanjutan.
                                </p>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <h4 class="feature-title">Kurikulum Lingkungan</h4>
                                <p class="feature-description">
                                    Integrasi pendidikan lingkungan hidup ke dalam kurikulum pembelajaran 
                                    untuk membangun kesadaran lingkungan sejak dini.
                                </p>
                            </div>
                        </div>

                        <!-- Achievement Section -->
                        <div class="achievement-section">
                            <h3 class="achievement-title">Pencapaian Program Adiwiyata</h3>
                            <p class="achievement-description">
                                Berkat komitmen dan kerja keras seluruh warga sekolah, SMK Negeri 4 Kota Bogor 
                                telah berhasil meraih berbagai penghargaan dan sertifikasi dalam program Adiwiyata, 
                                menjadikan sekolah sebagai contoh dalam pengelolaan lingkungan yang berkelanjutan.
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
</body>
</html>
