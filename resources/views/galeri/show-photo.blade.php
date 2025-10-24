<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $galery->post->judul ?? 'Foto' }} - SMK Negeri 4 Kota Bogor</title>
    
    <!-- Open Graph Meta Tags for WhatsApp Preview -->
    <meta property="og:title" content="{{ $galery->post->judul ?? 'Galeri Foto SMK Negeri 4' }}">
    <meta property="og:description" content="Lihat foto dari {{ $galery->post->judul ?? 'galeri' }} SMK Negeri 4 Kota Bogor">
    <meta property="og:image" content="{{ $imageUrl }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $galery->post->judul ?? 'Galeri Foto SMK Negeri 4' }}">
    <meta name="twitter:description" content="Lihat foto dari {{ $galery->post->judul ?? 'galeri' }} SMK Negeri 4 Kota Bogor">
    <meta name="twitter:image" content="{{ $imageUrl }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .photo-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        
        .photo-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
        }
        
        .photo-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .photo-header h1 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .photo-header p {
            margin: 0;
            opacity: 0.9;
        }
        
        .photo-image {
            width: 100%;
            max-height: 600px;
            object-fit: contain;
            background: #f8f9fa;
        }
        
        .photo-info {
            padding: 2rem;
        }
        
        .stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 1.5rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem 2rem;
            background: #f8f9fa;
            border-radius: 15px;
            transition: transform 0.2s;
        }
        
        .stat-item:hover {
            transform: scale(1.05);
        }
        
        .stat-item i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .stat-item .count {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .stat-item .label {
            font-size: 0.9rem;
            color: #666;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .btn-custom {
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
        }
        
        .btn-whatsapp {
            background: #25D366;
            color: white;
        }
        
        .btn-whatsapp:hover {
            background: #128C7E;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.4);
        }
        
        .btn-gallery {
            background: #667eea;
            color: white;
        }
        
        .btn-gallery:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .school-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .photo-header h1 {
                font-size: 1.4rem;
            }
            
            .stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-custom {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="photo-container">
        <div class="photo-card">
            <!-- Header -->
            <div class="photo-header">
                <img src="{{ asset('images/logo-smk.png') }}" alt="SMK Negeri 4" class="school-logo" onerror="this.style.display='none'">
                <h1>{{ $galery->post->judul ?? 'Galeri Foto' }}</h1>
                <p><i class="fas fa-school me-2"></i>SMK Negeri 4 Kota Bogor</p>
            </div>
            
            <!-- Photo -->
            <img src="{{ $imageUrl }}" alt="{{ $galery->post->judul ?? 'Foto' }}" class="photo-image">
            
            <!-- Info -->
            <div class="photo-info">
                <!-- Stats -->
                <div class="stats">
                    <div class="stat-item">
                        <i class="fas fa-heart text-danger"></i>
                        <div class="count">{{ $likesCount }}</div>
                        <div class="label">Likes</div>
                    </div>
                    <div class="stat-item">
                        <i class="fas fa-comments text-info"></i>
                        <div class="count">{{ $commentsCount }}</div>
                        <div class="label">Komentar</div>
                    </div>
                </div>
                
                <!-- Description -->
                @if($galery->post && $galery->post->isi)
                <div class="mt-4 p-3" style="background: #f8f9fa; border-radius: 15px;">
                    <h5><i class="fas fa-info-circle me-2 text-primary"></i>Deskripsi</h5>
                    <p class="mb-0">{{ Str::limit(strip_tags($galery->post->isi), 200) }}</p>
                </div>
                @endif
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn btn-custom btn-whatsapp" onclick="shareToWhatsApp()">
                        <i class="fab fa-whatsapp me-2"></i>Share via WhatsApp
                    </button>
                    <a href="{{ route('galeri.public') }}" class="btn btn-custom btn-gallery">
                        <i class="fas fa-images me-2"></i>Lihat Galeri Lengkap
                    </a>
                </div>
                
                <!-- Footer Info -->
                <div class="text-center mt-4 pt-4" style="border-top: 2px solid #e9ecef;">
                    <p class="text-muted mb-1">
                        <i class="far fa-calendar me-2"></i>
                        {{ $foto->created_at->format('d F Y') }}
                    </p>
                    <p class="text-muted mb-0">
                        <i class="fas fa-tag me-2"></i>
                        Kategori: <strong>{{ ucfirst($galery->category ?? 'Umum') }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function shareToWhatsApp() {
            const title = "{{ $galery->post->judul ?? 'Galeri Foto SMK Negeri 4' }}";
            const url = "{{ url()->current() }}";
            const text = encodeURIComponent(`Lihat foto dari ${title}\n\nSMK Negeri 4 Kota Bogor\n\n${url}`);
            
            // Detect if mobile or desktop
            const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            
            if (isMobile) {
                // Mobile: Open WhatsApp app
                window.location.href = `whatsapp://send?text=${text}`;
            } else {
                // Desktop: Open WhatsApp Web
                window.open(`https://wa.me/?text=${text}`, '_blank');
            }
        }
    </script>
</body>
</html>
