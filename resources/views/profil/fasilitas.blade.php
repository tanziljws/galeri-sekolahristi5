<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas - SMK Negeri 4 Kota Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8fafc; }
        .hero-header { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 120px 0 80px; text-align: center; }
        .fasilitas-card { background: white; border-radius: 20px; padding: 3rem; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .fasilitas-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem; margin: 2rem 0; }
        .fasilitas-item { background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); transition: all 0.3s ease; }
        .fasilitas-item:hover { transform: translateY(-10px); }
        
        /* Gallery Styling */
        .gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 250px;
        }
        
        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 2rem 1.5rem 1.5rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }
        
        .gallery-overlay h5 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .gallery-overlay p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }
        
        .back-btn { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; padding: 12px 30px; border-radius: 25px; text-decoration: none; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">SMK Negeri 4 Kota Bogor</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                <a class="nav-link" href="{{ route('home') }}#gallery">Galeri</a>
                <a class="nav-link" href="{{ route('home') }}#majors">Jurusan</a>
            </div>
        </div>
    </nav>

    <section class="hero-header">
        <div class="container">
            <h1 class="display-4 fw-bold">Fasilitas</h1>
            <p class="lead">Sarana dan Prasarana Modern</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="fasilitas-card">
                <h2 class="text-center mb-4">Fasilitas Sekolah</h2>
                
                <div class="fasilitas-grid">
                    <div class="fasilitas-item">
                        <h3><i class="fas fa-laptop text-primary"></i> Laboratorium Komputer</h3>
                        <p>Dilengkapi dengan komputer modern untuk pembelajaran programming dan desain grafis.</p>
                    </div>
                    
                    <div class="fasilitas-item">
                        <h3><i class="fas fa-network-wired text-primary"></i> Laboratorium Jaringan</h3>
                        <p>Fasilitas lengkap untuk praktik jaringan komputer dan server administration.</p>
                    </div>
                    
                    <div class="fasilitas-item">
                        <h3><i class="fas fa-car text-primary"></i> Workshop Otomotif</h3>
                        <p>Bengkel lengkap dengan peralatan modern untuk praktik otomotif.</p>
                    </div>
                </div>

                <!-- Galeri Foto Fasilitas -->
                <div class="fasilitas-gallery mt-5">
                    <h3 class="text-center mb-4">
                        <i class="fas fa-images text-primary me-2"></i>
                        Galeri Fasilitas Sekolah
                    </h3>
                    <div class="row g-4">
                        <div class="col-lg-6 col-md-6">
                            <div class="gallery-item">
                                <img src="{{ asset('images/fasilitas/gedung-Pplg.png') }}" alt="Gedung PPLG SMK Negeri 4 Bogor" class="img-fluid rounded">
                                <div class="gallery-overlay">
                                    <h5>Gedung PPLG</h5>
                                    <p>Fasilitas khusus untuk program Pengembangan Perangkat Lunak dan Gim</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="gallery-item">
                                <img src="{{ asset('images/fasilitas/kompleks-sekolah.JPG') }}" alt="Kompleks Sekolah SMK Negeri 4 Bogor" class="img-fluid rounded">
                                <div class="gallery-overlay">
                                    <h5>Kompleks Sekolah</h5>
                                    <p>Area sekolah yang luas dengan lingkungan yang asri dan hijau</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="gallery-item">
                                <img src="{{ asset('images/fasilitas/gedung-Tjkt.JPG') }}" alt="Gedung TJKT SMK Negeri 4 Bogor" class="img-fluid rounded">
                                <div class="gallery-overlay">
                                    <h5>Gedung TJKT</h5>
                                    <p>Fasilitas khusus untuk program Teknik Jaringan Komputer dan Telekomunikasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="gallery-item">
                                <img src="{{ asset('images/fasilitas/gedung-To.JPG') }}" alt="Gedung TO SMK Negeri 4 Bogor" class="img-fluid rounded">
                                <div class="gallery-overlay">
                                    <h5>Gedung TO</h5>
                                    <p>Fasilitas khusus untuk program Teknik Otomotif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="back-btn">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
