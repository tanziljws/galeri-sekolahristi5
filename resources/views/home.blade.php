@php
    $currentPage = request()->query('page', 'home');
    $isProfilePage = $currentPage === 'profile' && session('user_id');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(config('app.env') === 'production' || config('app.env') === 'staging')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <title>{{ $isProfilePage ? 'Profil Saya' : 'SMK Negeri 4 Kota Bogor - Galeri Kegiatan Sekolah' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @php
        $heroImage = file_exists(public_path('images/hero.jpg'))
            ? asset('images/hero.jpg')
            : asset('images/smk-gedung.jpg');
    @endphp
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
            background: #ffffff;
            min-height: 100vh;
            padding-top: 80px; /* Space for fixed navbar */
            position: relative;
        }
        
        /* Global Background Blur - Full Page */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset("images/upacara-full.jpg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            filter: blur(10px) brightness(0.85);
            -webkit-filter: blur(10px) brightness(0.85);
            transform: scale(1.1);
            z-index: -2;
        }
        
        /* Global Dark Overlay */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: -1;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 25px rgba(0,0,0,0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1050;
            transition: all 0.3s ease;
        }

        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
            z-index: -1;
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

        .navbar-brand .d-flex.flex-column {
            height: 40px;
            justify-content: center;
            align-items: flex-start;
            margin-top: 3px;
        }

        .navbar-brand h4 {
            margin-bottom: 1px;
            padding-bottom: 0;
            line-height: 1;
        }

        .navbar-brand small {
            line-height: 1;
            margin-top: 0;
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

        .navbar-nav .dropdown-toggle::after {
            margin-left: 0.3em;
            vertical-align: 0.1em;
        }

        .navbar-nav .btn-primary {
            background: var(--primary-color);
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white !important;
        }

        .navbar-nav .btn-primary:hover {
            background: #1e3a8a;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
            color: white !important;
        }

                 /* Hero Section - Style Modern University */
         .hero-section {
             position: relative;
             height: 100vh;
             overflow: hidden;
         }
         
         .hero-section .carousel {
             height: 100%;
         }
         
         .hero-section .carousel-inner {
             height: 100%;
         }
         
         .hero-section .carousel-item {
             height: 100vh;
         }
         
         .hero-background {
             position: absolute;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background-size: cover;
             background-position: center;
             background-repeat: no-repeat;
         }
         
         .hero-background::before {
             content: '';
             position: absolute;
             top: 0;
             left: 0;
             right: 0;
             bottom: 0;
             background: rgba(0, 0, 0, 0.01);
             z-index: 1;
         }

         /* Carousel Indicators */
         .hero-section .carousel-indicators {
             bottom: 30px;
             z-index: 3;
         }
         
         .hero-section .carousel-indicators button {
             width: 12px;
             height: 12px;
             border-radius: 50%;
             border: 2px solid rgba(255, 255, 255, 0.5);
             background: transparent;
             margin: 0 5px;
             transition: all 0.3s ease;
         }
         
         .hero-section .carousel-indicators button.active {
             background: white;
             border-color: white;
         }
         
         /* Carousel Controls */
         .hero-section .carousel-control-prev,
         .hero-section .carousel-control-next {
             width: 50px;
             height: 50px;
             top: 50%;
             transform: translateY(-50%);
             background: rgba(255, 255, 255, 0.2);
             border-radius: 50%;
             backdrop-filter: blur(10px);
             border: 1px solid rgba(255, 255, 255, 0.3);
             transition: all 0.3s ease;
         }
         
         .hero-section .carousel-control-prev {
             left: 30px;
         }
         
         .hero-section .carousel-control-next {
             right: 30px;
         }
         
         .hero-section .carousel-control-prev:hover,
         .hero-section .carousel-control-next:hover {
             background: rgba(255, 255, 255, 0.3);
             transform: translateY(-50%) scale(1.1);
         }
         
         .hero-section .carousel-control-prev-icon,
         .hero-section .carousel-control-next-icon {
             width: 20px;
             height: 20px;
         }
         
         /* Responsive adjustments for hero carousel */
         @media (max-width: 768px) {
             .hero-section .carousel-control-prev,
             .hero-section .carousel-control-next {
                 width: 40px;
                 height: 40px;
             }
             
             .hero-section .carousel-control-prev {
                 left: 15px;
             }
             
             .hero-section .carousel-control-next {
                 right: 15px;
             }
             
             .hero-section .carousel-control-prev-icon,
             .hero-section .carousel-control-next-icon {
                 width: 16px;
                 height: 16px;
             }
             
             .hero-section .carousel-indicators {
                 bottom: 20px;
             }
             
             .hero-section .carousel-indicators button {
                 width: 10px;
                 height: 10px;
                 margin: 0 3px;
             }
         }

        

                 .hero-content {
             position: relative;
             z-index: 2;
             text-align: center;
             color: white;
             padding: 0 20px;
             max-width: 800px;
             margin: 0 auto;
             display: flex;
             flex-direction: column;
             justify-content: center;
             align-items: center;
             height: 100vh;
         }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.4rem;
            margin-bottom: 2.5rem;
            opacity: 0.95;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.7);
            line-height: 1.6;
            font-weight: 300;
        }

        .hero-btn {
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-color);
            border: 2px solid rgba(255, 255, 255, 0.8);
            padding: 15px 40px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            margin: 0 10px;
        }

        .hero-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
            color: var(--primary-color);
        }

        /* Modern Minimalist Sambutan Styling */
        .sambutan-modern-container {
            max-width: 100%;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .sambutan-modern-container.scroll-animate {
            opacity: 1;
            transform: translateY(0);
        }

        .kepala-sekolah-photo-modern {
            opacity: 0;
            transform: translateX(-30px);
            transition: all 0.8s ease-out 0.2s;
        }

        .kepala-sekolah-photo-modern.scroll-animate {
            opacity: 1;
            transform: translateX(0);
        }

        .sambutan-content-modern {
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.8s ease-out 0.4s;
        }

        .sambutan-content-modern.scroll-animate {
            opacity: 1;
            transform: translateX(0);
        }

        .sambutan-title-modern {
            font-family: 'Dancing Script', cursive, 'Inter', sans-serif;
            font-size: 3.5rem;
            font-weight: 600;
            color: #1e40af;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            letter-spacing: 1px;
        }

        .kepala-sekolah-photo-modern {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .photo-frame {
            width: 300px;
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            position: relative;
            background: #f8fafc;
        }

        .kepala-sekolah-photo-modern-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .kepala-sekolah-photo-modern-img:hover {
            transform: scale(1.02);
        }

        .sambutan-content-modern {
            position: relative;
            padding-left: 2rem;
        }

        .quote-mark {
            position: absolute;
            top: -10px;
            left: 0;
            font-size: 4rem;
            color: #e2e8f0;
            z-index: 1;
        }

        .sambutan-text {
            position: relative;
            z-index: 2;
            line-height: 1.8;
            color: #374151;
            font-size: 1.1rem;
        }

        .sambutan-text p {
            text-align: justify;
            margin-bottom: 1.5rem;
        }

        .signature-modern {
            margin-top: 3rem;
        }

        .signature-card {
            background: #f8fafc;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e5e7eb;
        }

        .signature-info {
            flex: 1;
        }

        .signature-role {
            color: #6b7280;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .signature-name {
            color: #1e40af;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }

        .signature-logo img {
            height: 60px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .signature-logo img:hover {
            opacity: 1;
        }

        /* Responsive untuk sambutan modern */
        @media (max-width: 992px) {
            .sambutan-title-modern {
                font-size: 2.8rem;
            }
            
            .photo-frame {
                width: 250px;
                height: 320px;
            }
        }

        @media (max-width: 768px) {
            .sambutan-title-modern {
                font-size: 2.2rem;
            }
            
            .photo-frame {
                width: 200px;
                height: 280px;
            }
            
            .sambutan-content-modern {
                padding-left: 1rem;
            }
            
            .quote-mark {
                font-size: 3rem;
            }
            
            .sambutan-text {
                font-size: 1rem;
            }
            
            .signature-card {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }
        }

        @media (max-width: 576px) {
            .sambutan-title-modern {
                font-size: 1.8rem;
            }
            
            .photo-frame {
                width: 180px;
                height: 240px;
            }
        }

        /* Responsive untuk jurusan photo cards */
        @media (max-width: 992px) {
            .jurusan-photo-container {
                height: 200px;
            }
            
            .jurusan-photo-title {
                font-size: 1.6rem;
                letter-spacing: 1px;
            }
        }

        @media (max-width: 768px) {
            .jurusan-photo-container {
                height: 180px;
            }
            
            .jurusan-photo-title {
                font-size: 1.4rem;
                letter-spacing: 1px;
            }
        }

        @media (max-width: 576px) {
            .jurusan-photo-container {
                height: 160px;
            }
            
            .jurusan-photo-title {
                font-size: 1.2rem;
                letter-spacing: 0.5px;
            }
        }

        /* Section Title Styling */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
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
            background: linear-gradient(90deg, #8b5cf6 0%, #ef4444 100%);
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
                margin-bottom: 2rem;
            }
        }

        /* Responsive untuk mobile */
                 @media (max-width: 768px) {
            .hero-content {
                padding: 0 15px;
                max-width: 100%;
            }
            
            .hero-title {
                font-size: 2.2rem;
                margin-bottom: 1rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
                margin-bottom: 2rem;
            }

            .hero-btn {
                padding: 12px 30px;
                font-size: 1rem;
            }

            .profil-cards-container {
                margin-top: 2rem;
            }

            .profil-card {
                padding: 1.5rem 1rem;
                margin-bottom: 1rem;
            }

            .profil-card-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 1rem;
            }

            .profil-card-icon i {
                font-size: 1.5rem;
            }

            .profil-card-title {
                font-size: 1.1rem;
                margin-bottom: 0.75rem;
            }

            .profil-card-description {
                font-size: 0.85rem;
            }



             
             .jurusan-card-grid {
                 flex-direction: column !important;
                 text-align: center !important;
                 gap: 1rem !important;
                 padding: 1.5rem !important;
             }
             
             .jurusan-number {
                 margin: 0 auto 1rem auto !important;
             }
             
             .jurusan-icon {
                 margin: 0 auto !important;
             }
             
             .jurusan-title-grid {
                 font-size: 1.3rem !important;
             }
             
             .jurusan-description-grid {
                 font-size: 0.9rem !important;
             }
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

        /* Scroll Animation Styles */
        .scroll-animate {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease-out;
        }

        .scroll-animate.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .scroll-animate.delay-1 {
            transition-delay: 0.1s;
        }

        .scroll-animate.delay-2 {
            transition-delay: 0.2s;
        }

        .scroll-animate.delay-3 {
            transition-delay: 0.3s;
        }

        .scroll-animate.delay-4 {
            transition-delay: 0.4s;
        }

        .scroll-animate.delay-5 {
            transition-delay: 0.5s;
        }

        /* YouTube Video Section Styles - White Background */
        .youtube-section {
            position: relative;
            min-height: 600px;
            background: transparent;
        }
        
        /* YouTube Section - White Overlay */
        .youtube-white-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.92);
            z-index: 1;
            pointer-events: none;
        }
        
        /* YouTube Section - Dark Text for White Background */
        .youtube-section-white h2,
        .youtube-section-white h3,
        .youtube-section-white p,
        .youtube-section-white .video-content h3,
        .youtube-section-white .video-content p {
            color: #1f2937 !important;
            text-shadow: none !important;
        }
        
        .youtube-section-white .feature-item {
            color: #1f2937 !important;
        }
        
        /* Section backgrounds removed - using global background */
        .section-background {
            display: none;
        }
        
        .section-overlay {
            display: none;
        }
        
        /* Gallery and News backgrounds removed - using global background */
        .gallery-section-background,
        .news-section-background {
            display: none;
        }
        
        .gallery-section-overlay,
        .news-section-overlay {
            display: none;
        }
        
        /* Gallery Section - Dark Overlay to differentiate */
        .gallery-section-dark {
            position: relative;
        }
        
        .gallery-dark-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
            pointer-events: none;
        }

        .video-container {
            position: relative;
            opacity: 0;
            transform: translateX(-100px);
            transition: all 0.8s ease-out;
        }

        .video-container.animate {
            opacity: 1;
            transform: translateX(0);
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            height: 0;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            background: #000;
        }

        .video-wrapper iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-text {
            padding-left: 2rem;
            opacity: 0;
            transform: translateX(100px);
            transition: all 0.8s ease-out;
        }

        .video-text.animate {
            opacity: 1;
            transform: translateX(0);
        }

        .video-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .video-description {
            font-size: 1.1rem;
            color: #ffffff;
            line-height: 1.6;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .video-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .feature-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            background: rgba(255, 255, 255, 1);
        }

        .feature-item i {
            font-size: 1.5rem;
            color: #3b82f6;
            width: 30px;
            text-align: center;
        }

        .feature-item span {
            font-weight: 600;
            color: #374151;
        }

        /* Responsive adjustments for video section */
        @media (max-width: 992px) {
            .video-text {
                padding-left: 0;
                padding-top: 2rem;
            }
            
            .video-title {
                font-size: 2rem;
            }
            
            .video-features {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.75rem;
            }
            
            .feature-item {
                flex: 1;
                min-width: 200px;
            }
        }

        @media (max-width: 768px) {
            .video-title {
                font-size: 1.75rem;
            }
            
            .video-description {
                font-size: 1rem;
            }
            
            .video-features {
                flex-direction: column;
            }
            
            .feature-item {
                min-width: auto;
            }
        }

        /* Modal and Carousel Fixes */
        .modal {
            z-index: 1055;
        }
        
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
        }
        
        .modal.show .modal-dialog {
            transform: none;
        }
        
        .modal-backdrop {
            z-index: 9998 !important;
            background-color: rgba(0, 0, 0, 0.1) !important;
        }
        
        .modal-backdrop.show {
            opacity: 1 !important;
        }
        
        .modal {
            z-index: 9999 !important;
        }
        
        .modal-dialog {
            z-index: 10000 !important;
        }
        
        .modal-content {
            z-index: 10001 !important;
        }
        
        .modal-dialog {
            margin: 1.75rem auto;
        }
        
        .modal-dialog.modal-xl {
            max-width: 90vw;
        }
        
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background: #ffffff !important;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: 3px solid #ffffff;
        }
        
        .modal-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            background: #1e40af !important;
        }
        
        .modal-footer {
            border-top: 1px solid #dee2e6;
            background: #f8f9fa;
        }
        
        .modal-body {
            background: #fff;
            padding: 0 !important;
        }
        
        .carousel {
            background: #000;
        }
        
        .carousel-item {
            background: #000;
        }
        
        .carousel-item img {
            border-radius: 0;
            max-height: 70vh;
            width: 100%;
            height: auto;
            object-fit: contain;
            background: #000;
        }
        
        /* Modal carousel styling */
        .modal .carousel-item {
            background: #ffffff !important;
            min-height: 75vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }
        
        .modal .carousel-item img {
            background: transparent !important;
            max-height: 75vh !important;
            max-width: 95%;
            width: auto !important;
            height: auto !important;
            object-fit: contain !important;
            image-rendering: auto;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
        }
        
        .modal .carousel {
            background: #ffffff !important;
        }
        
        .modal .carousel-inner {
            background: #ffffff !important;
        }
        
        .modal-body {
            background: #ffffff !important;
            min-height: 75vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            background: rgba(0, 0, 0, 0.3);
            border: none;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.5);
        }
        
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-size: 20px 20px;
        }
        
        /* Modal carousel controls */
        .modal .carousel-control-prev,
        .modal .carousel-control-next {
            width: 8%;
            opacity: 0.8;
        }
        
        .modal .carousel-control-prev:hover,
        .modal .carousel-control-next:hover {
            opacity: 1;
        }
        
        .carousel-indicators {
            margin-bottom: 1rem;
            background: rgba(0, 0, 0, 0.3);
            padding: 10px 0;
        }
        
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
            border: 2px solid #fff;
            background: transparent;
        }
        
        .carousel-indicators button.active {
            background: #fff;
        }
        
        /* Responsive modal carousel */
        @media (max-width: 768px) {
            .modal .carousel-item {
                min-height: 60vh;
                padding: 15px;
            }
            
            .modal .carousel-item img {
                max-height: 60vh !important;
                max-width: 100%;
            }
            
            .modal-body {
                min-height: 60vh;
            }
            
            .modal-dialog.modal-xl {
                max-width: 95vw;
                margin: 0.5rem auto;
            }
        }
        
        @media (max-width: 576px) {
            .modal .carousel-item {
                min-height: 50vh;
                padding: 10px;
            }
            
            .modal .carousel-item img {
                max-height: 50vh !important;
            }
            
            .modal-body {
                min-height: 50vh;
            }
        }
        
        /* Fix for blur effect */
        .modal.show {
            backdrop-filter: none !important;
            filter: none !important;
        }
        
        .modal-backdrop.show {
            backdrop-filter: none !important;
            filter: none !important;
        }
        
        .modal-dialog {
            filter: none !important;
        }
        
        .modal-content {
            filter: none !important;
        }
        
        .modal img {
            filter: none !important;
            -webkit-filter: none !important;
        }

        .gallery-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }


        .gallery-image {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        /* Contact Section Styling */
        .contact-info .d-flex {
            transition: all 0.3s ease;
        }

        .contact-info .d-flex:hover {
            transform: translateX(5px);
        }

        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .map-container:hover {
            transform: translateY(-5px);
        }

        .map-container iframe {
            border-radius: 10px;
        }

        /* Responsive Contact Section */
        @media (max-width: 991px) {
            .map-container {
                margin-top: 2rem;
            }
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #6b7280;
            line-height: 1.6;
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.5em 1em;
            border-radius: 20px;
        }

        .stats-section {
            background: white;
            padding: 80px 0;
        }

        .stat-card {
            text-align: center;
            padding: 2rem;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            color: #6b7280;
            font-weight: 500;
        }

        .news-section {
            background: var(--light-color);
            padding: 80px 0;
        }

        .news-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .jurusan-logo {
            transition: transform 0.3s ease;
        }

        .news-card:hover .jurusan-logo {
            transform: scale(1.1);
        }

                 /* Jurusan Section Styling */
         .jurusan-card {
             background: white !important;
             border-radius: 15px !important;
             padding: 2rem !important;
             margin-bottom: 1.5rem !important;
             border: 1px solid rgba(0, 0, 0, 0.1) !important;
             transition: all 0.3s ease !important;
             box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1) !important;
             display: flex !important;
             align-items: center !important;
             gap: 2rem !important;
             flex-direction: row !important;
         }

         .jurusan-card:hover {
             background: white;
             transform: translateY(-5px);
             box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
         }

         .logo-container {
             background: white !important;
             border-radius: 15px !important;
             padding: 1.5rem !important;
             display: flex !important;
             align-items: center !important;
             justify-content: center !important;
             box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
             flex-shrink: 0 !important;
             width: 120px !important;
             height: 120px !important;
         }

         .jurusan-logo {
             width: 80px;
             height: 80px;
             object-fit: contain;
             transition: transform 0.3s ease;
         }

         .jurusan-card:hover .jurusan-logo {
             transform: scale(1.1);
         }

         .jurusan-content {
             flex: 1 !important;
             margin-left: 0 !important;
             padding-left: 0 !important;
         }

         .jurusan-title {
             color: #2c5aa0;
             font-size: 2rem;
             font-weight: 700;
             margin-bottom: 1rem;
         }

         .jurusan-description {
             color: #4a5568 !important;
             font-size: 1.1rem !important;
             line-height: 1.6 !important;
             margin: 0 !important;
         }
         
         /* Grid Layout untuk Jurusan */
         .jurusan-card-grid {
             background: white !important;
             border-radius: 15px !important;
             padding: 2rem !important;
             margin-bottom: 1.5rem !important;
             border: 1px solid rgba(0, 0, 0, 0.1) !important;
             transition: all 0.3s ease !important;
             box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1) !important;
             display: flex !important;
             align-items: flex-start !important;
             gap: 1.5rem !important;
             position: relative !important;
             height: 100% !important;
         }

         .jurusan-card-grid:hover {
             background: white !important;
             transform: translateY(-5px) !important;
             box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
         }

         .jurusan-number {
             background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%) !important;
             color: white !important;
             width: 40px !important;
             height: 40px !important;
             border-radius: 50% !important;
             display: flex !important;
             align-items: center !important;
             justify-content: center !important;
             font-weight: bold !important;
             font-size: 1.2rem !important;
             flex-shrink: 0 !important;
             margin-top: 0.5rem !important;
         }

         .jurusan-content-grid {
             flex: 1 !important;
             margin-left: 0 !important;
             padding-left: 0 !important;
         }

         .jurusan-title-grid {
             color: #2c5aa0 !important;
             font-size: 1.5rem !important;
             font-weight: 700 !important;
             margin-bottom: 1rem !important;
         }

         .jurusan-description-grid {
             color: #4a5568 !important;
             font-size: 1rem !important;
             line-height: 1.6 !important;
             margin: 0 !important;
         }

         .jurusan-icon {
             display: flex !important;
             align-items: center !important;
             justify-content: center !important;
             flex-shrink: 0 !important;
             width: 80px !important;
             height: 80px !important;
         }

         .jurusan-logo-grid {
             width: 100% !important;
             height: 100% !important;
             object-fit: contain !important;
             transition: transform 0.3s ease !important;
         }

         .jurusan-card-grid:hover .jurusan-logo-grid {
             transform: scale(1.1) !important;
         }

        .news-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        /* Modern News Card Styling */
        .news-card-modern {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .news-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        /* News Image */
        .news-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card-modern:hover .news-image img {
            transform: scale(1.1);
        }

        .news-image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }

        /* Event Date Badge */
        .event-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            z-index: 10;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            animation: fadeInDown 0.5s ease;
        }

        .event-badge-upcoming {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.95), rgba(22, 163, 74, 0.95));
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .event-badge-today {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.95), rgba(220, 38, 38, 0.95));
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            animation: pulse 2s infinite;
        }

        .event-badge-past {
            background: linear-gradient(135deg, rgba(107, 114, 128, 0.95), rgba(75, 85, 99, 0.95));
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(239, 68, 68, 0.6);
            }
        }

        .news-image-placeholder {
            background: linear-gradient(135deg, #e5e7eb 0%, #f3f4f6 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .placeholder-content {
            text-align: center;
            color: #9ca3af;
        }

        .placeholder-content i {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .placeholder-content span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .news-header {
            margin-bottom: 1.5rem;
        }

        .date-badge {
            display: inline-block;
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .news-content {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .news-title {
            color: #1f2937;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .news-description {
            color: #6b7280;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .news-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .read-more-link {
            color: #1e40af;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .read-more-link:hover {
            color: #3b82f6;
            text-decoration: underline;
        }

        .author-info {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #6b7280;
            font-size: 0.85rem;
        }

        .author-info i {
            font-size: 0.8rem;
        }

        .footer {
            background: #5b6fa3;
            color: white;
            padding: 60px 0 30px;
        }

        /* Simple Gallery Card Styling */
        .gallery-card-simple {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
        }

        .gallery-card-simple:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .gallery-image-simple {
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-card-simple:hover .gallery-image-simple {
            transform: scale(1.05);
        }

        /* Overlay icon saat hover */
        .gallery-card-simple::before {
            content: '\f002';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2.5rem;
            color: white;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
            pointer-events: none;
        }

        .gallery-card-simple::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
            pointer-events: none;
        }

        .gallery-card-simple:hover::before,
        .gallery-card-simple:hover::after {
            opacity: 1;
        }

        /* Gallery Modal Item Hover Effect */
        .gallery-modal-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15) !important;
        }

        .gallery-label {
            padding: 0.75rem;
            background: white;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }

        .gallery-label span {
            color: #374151;
            font-size: 0.9rem;
            font-weight: 500;
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

        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Gallery View Button */
        .gallery-card .btn {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .gallery-card .btn:hover {
            transform: translateY(-2px);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        /* Photo Click Effect */
        .gallery-image {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gallery-image:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Carousel Styling */
        .carousel {
            border-radius: 10px;
            overflow: hidden;
        }

        .carousel-indicators {
            bottom: 20px;
        }

        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            border: 2px solid rgba(255, 255, 255, 0.8);
            margin: 0 4px;
        }

        .carousel-indicators button.active {
            background-color: white;
            border-color: white;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 20px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            width: 24px;
            height: 24px;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 10px 20px;
            bottom: 20px;
        }

        .carousel-caption h6 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .carousel-caption p {
            margin-bottom: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* Auto-sliding carousel styling */
        .carousel[data-bs-ride="carousel"] {
            transition: all 0.5s ease;
        }

        .carousel[data-bs-ride="carousel"]:hover {
            cursor: pointer;
        }

        /* Testimoni Display Styling */
        .testimoni-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            height: 100%;
        }

        .testimoni-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.15);
        }

        .testimoni-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .testimoni-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            margin-right: 1rem;
        }

        .testimoni-info h6 {
            margin: 0;
            color: #1f2937;
            font-weight: 600;
        }

        .testimoni-info small {
            color: #6b7280;
        }

        .testimoni-message {
            color: #374151;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .testimoni-date {
            color: #9ca3af;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
        }

        .testimoni-date i {
            margin-right: 0.5rem;
        }

        .testimoni-empty {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        .testimoni-empty i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        /* Ensure photo modal is always on top */
        .modal-backdrop {
            z-index: 99999 !important;
            background-color: rgba(0, 0, 0, 0.85) !important;
        }
        
        .modal {
            z-index: 100000 !important;
        }
        
        .modal.show {
            z-index: 100000 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        
        .modal-dialog {
            margin: 0 !important;
            max-width: 800px !important;
            width: auto !important;
        }
        
        .modal.show .modal-dialog {
            transform: none !important;
        }
        
        /* Ensure news section stays below modal */
        .berita-section {
            z-index: 1 !important;
            position: relative;
        }
        
        /* News Section - White Overlay */
        .news-white-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.92);
            z-index: 1;
            pointer-events: none;
        }
        
        /* News Section - Dark Text for White Background */
        .news-section-white .section-title,
        .news-section-white h2,
        .news-section-white h3,
        .news-section-white h5,
        .news-section-white p,
        .news-section-white .card-title,
        .news-section-white .card-text {
            color: #1f2937 !important;
            text-shadow: none !important;
        }
        
        /* Gallery section title - white color for dark overlay */
        #gallery .section-title {
            color: #ffffff !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        /* Fullscreen Image Viewer - Modern Light Blur Style */
        #imgViewer {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.25s ease-in-out;
        }
        
        #imgViewer img {
            max-width: 95%;
            max-height: 95vh;
            width: auto;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            animation: zoomIn 0.25s ease-in-out;
            cursor: default;
            object-fit: contain;
        }
        
        #closeBtn {
            position: absolute;
            top: 25px;
            right: 35px;
            background: rgba(255, 255, 255, 0.8);
            border: 0;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            color: #333;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 10000;
        }
        
        #closeBtn:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes zoomIn {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="me-3">
                    <div style="width: 50px; height: 50px; border-radius: 50%; border: 2px solid #1e40af; display: flex; align-items: center; justify-content: center; background: white; overflow: hidden;">
                        <img src="{{ asset('images/smk-logo.png') }}" 
                             alt="SMK Negeri 4 Kota Bogor Logo" 
                             style="width: 100%; height: 100%; object-fit: contain; border-radius: 50%;">
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
                        <a class="nav-link" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('galeri.public') }}">Galeri</a>
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
                        <a class="nav-link" href="{{ route('berita.index') }}">Berita</a>
                    </li>
                    @if(session('user_id'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                @php
                                    $currentUser = \App\Models\User::find(session('user_id'));
                                @endphp
                                @if($currentUser && $currentUser->profile_photo)
                                    <img src="{{ asset('storage/' . $currentUser->profile_photo) }}" 
                                         alt="Profile" 
                                         class="rounded-circle me-1"
                                         style="width: 30px; height: 30px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user-circle me-1"></i>
                                @endif
                                {{ session('user_name') }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('home', ['page' => 'profile']) }}">
                                        <i class="fas fa-user-edit me-2"></i>Profil
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('user.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.login.form') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="{{ route('user.register.form') }}">
                                <i class="fas fa-user-plus me-1"></i>Daftar
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if($isProfilePage)
        <!-- Profile Page Content with Background Image -->
        @php
            $profileUser = \App\Models\User::find(session('user_id'));
        @endphp
        <div class="profile-page-wrapper" style="
            position: relative;
            min-height: 100vh;
            padding: 3rem 0;
        ">
            <!-- Background Image with Blur -->
            <div style="
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('{{ asset('images/smk-gedung.jpg') }}');
                background-size: cover;
                background-position: center;
                filter: blur(1px);
                z-index: -2;
            "></div>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Header -->
                    <div class="mb-4 text-center">
                        <h2 class="fw-bold text-white">
                            <i class="fas fa-user-circle me-2"></i>Profil Saya
                        </h2>
                        <p class="text-white">Kelola informasi profil dan keamanan akun Anda</p>
                    </div>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row g-4">
                        <!-- Foto Profil Card -->
                        <div class="col-lg-4">
                            <div class="card shadow-sm border-0 h-100">
                                <div class="card-body text-center p-4">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-camera me-2"></i>Foto Profil
                                    </h5>
                                    
                                    <!-- Profile Photo Preview -->
                                    <div class="mb-4">
                                        @if($profileUser && $profileUser->profile_photo)
                                            <img src="{{ asset('storage/' . $profileUser->profile_photo) }}" 
                                                 alt="Profile Photo" 
                                                 class="rounded-circle img-thumbnail"
                                                 style="width: 200px; height: 200px; object-fit: cover;"
                                                 id="profilePhotoPreview">
                                        @else
                                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                                                 style="width: 200px; height: 200px; font-size: 4rem;"
                                                 id="profilePhotoPreview">
                                                {{ $profileUser ? strtoupper(substr($profileUser->name, 0, 1)) : 'U' }}
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Upload Form -->
                                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="name" value="{{ $profileUser->name ?? '' }}">
                                        <input type="hidden" name="email" value="{{ $profileUser->email ?? '' }}">
                                        
                                        <div class="mb-3">
                                            <label for="profile_photo" class="btn btn-outline-primary btn-sm w-100">
                                                <i class="fas fa-upload me-2"></i>Pilih Foto
                                            </label>
                                            <input type="file" 
                                                   class="d-none @error('profile_photo') is-invalid @enderror" 
                                                   id="profile_photo" 
                                                   name="profile_photo" 
                                                   accept="image/*"
                                                   onchange="previewPhoto(this); this.form.submit();">
                                            @error('profile_photo')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </form>

                                    @if($profileUser && $profileUser->profile_photo)
                                        <form action="{{ route('profile.photo.delete') }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm w-100" 
                                                    onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                                <i class="fas fa-trash me-2"></i>Hapus Foto
                                            </button>
                                        </form>
                                    @endif

                                    <small class="text-muted d-block mt-3">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Format: JPG, PNG, GIF<br>
                                        Maksimal: 2MB
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Profil & Password -->
                        <div class="col-lg-8">
                            <!-- Edit Profil Card -->
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-user-edit me-2"></i>Informasi Profil
                                    </h5>
                                    
                                    <form action="{{ route('profile.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', $profileUser->name ?? '') }}" 
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-semibold">Email</label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', $profileUser->email ?? '') }}" 
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Ubah Password Card -->
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-lock me-2"></i>Ubah Password
                                    </h5>
                                    
                                    <form action="{{ route('profile.password') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label fw-semibold">Password Lama</label>
                                            <input type="password" 
                                                   class="form-control @error('current_password') is-invalid @enderror" 
                                                   id="current_password" 
                                                   name="current_password" 
                                                   required>
                                            @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password" class="form-label fw-semibold">Password Baru</label>
                                            <input type="password" 
                                                   class="form-control @error('new_password') is-invalid @enderror" 
                                                   id="new_password" 
                                                   name="new_password" 
                                                   required>
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">Minimal 8 karakter</small>
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                                            <input type="password" 
                                                   class="form-control" 
                                                   id="new_password_confirmation" 
                                                   name="new_password_confirmation" 
                                                   required>
                                        </div>

                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-warning">
                                                <i class="fas fa-key me-2"></i>Ubah Password
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Activity Section -->
                    <div class="row g-4 mt-4">
                        <!-- Liked Photos Section -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-heart text-danger me-2"></i>Foto yang Disukai
                                    </h5>
                                    @php
                                        // Use same identifier as like system: 'user_' . user_id
                                        $userIdentifier = 'user_' . session('user_id');
                                        $likedPhotos = \App\Models\PhotoInteraction::where('ip_address', $userIdentifier)
                                            ->where('type', 'like')
                                            ->with(['foto.galery'])
                                            ->latest()
                                            ->get();
                                        $totalLikes = $likedPhotos->count();
                                        // Split into chunks of 4
                                        $likedPhotosChunks = $likedPhotos->chunk(4);
                                    @endphp
                                    
                                    <div class="mb-3">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Total foto yang disukai: <strong>{{ $totalLikes }}</strong>
                                        </div>
                                    </div>

                                    @if($likedPhotos->count() > 0)
                                        <!-- Carousel for Liked Photos -->
                                        <div id="likedPhotosCarousel" class="carousel slide" data-bs-ride="false">
                                            <div class="carousel-inner">
                                                @foreach($likedPhotosChunks as $chunkIndex => $chunk)
                                                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                                        <div class="list-group">
                                                            @foreach($chunk as $interaction)
                                                                @if($interaction->foto)
                                                                    <div class="list-group-item list-group-item-action">
                                                                        <div class="d-flex align-items-center">
                                                                            <img src="{{ asset('storage/galeri/' . $interaction->foto->file) }}" 
                                                                                 alt="Liked Photo" 
                                                                                 class="rounded me-3"
                                                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                                                 onerror="this.src='{{ asset('images/no-image.png') }}'">
                                                                            <div class="flex-grow-1">
                                                                                <h6 class="mb-1">{{ $interaction->foto->judul }}</h6>
                                                                                <small class="text-muted">
                                                                                    <i class="fas fa-calendar me-1"></i>
                                                                                    {{ $interaction->created_at->diffForHumans() }}
                                                                                </small>
                                                                            </div>
                                                                            <a href="{{ route('galeri.public') }}#foto-{{ $interaction->foto->id }}" 
                                                                               class="btn btn-sm btn-outline-primary">
                                                                                <i class="fas fa-eye"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                            <!-- Navigation Controls -->
                                            @if($likedPhotosChunks->count() > 1)
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#likedPhotosCarousel" data-bs-slide="prev">
                                                        <i class="fas fa-chevron-left"></i> Sebelumnya
                                                    </button>
                                                    <span class="text-muted small">
                                                        <span id="likedCurrentPage">1</span> / {{ $likedPhotosChunks->count() }}
                                                    </span>
                                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#likedPhotosCarousel" data-bs-slide="next">
                                                        Berikutnya <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center py-4 text-muted">
                                            <i class="fas fa-heart-broken fa-3x mb-3 opacity-25"></i>
                                            <p>Belum ada foto yang disukai</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- User Comments Section -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-comments text-primary me-2"></i>Komentar Saya
                                    </h5>
                                    @php
                                        $userComments = \App\Models\PhotoComment::where('email', $profileUser->email)
                                            ->with(['foto.galery'])
                                            ->latest()
                                            ->get();
                                        $totalComments = $userComments->count();
                                        $approvedComments = \App\Models\PhotoComment::where('email', $profileUser->email)
                                            ->where('is_approved', 1)
                                            ->count();
                                        // Split into chunks of 4
                                        $userCommentsChunks = $userComments->chunk(4);
                                    @endphp
                                    
                                    <div class="mb-3">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Total komentar: <strong>{{ $totalComments }}</strong> 
                                            <span class="text-success">({{ $approvedComments }} disetujui)</span>
                                        </div>
                                    </div>

                                    @if($userComments->count() > 0)
                                        <!-- Carousel for User Comments -->
                                        <div id="userCommentsCarousel" class="carousel slide" data-bs-ride="false">
                                            <div class="carousel-inner">
                                                @foreach($userCommentsChunks as $chunkIndex => $chunk)
                                                    <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
                                                        <div class="list-group">
                                                            @foreach($chunk as $comment)
                                                                @if($comment->foto)
                                                                    <div class="list-group-item {{ $comment->is_approved ? '' : 'bg-light' }}">
                                                                        <div class="d-flex align-items-start">
                                                                            <img src="{{ asset('storage/galeri/' . $comment->foto->file) }}" 
                                                                                 alt="Photo" 
                                                                                 class="rounded me-3"
                                                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                                                 onerror="this.src='{{ asset('images/no-image.png') }}'">
                                                                            <div class="flex-grow-1">
                                                                                <h6 class="mb-1">{{ $comment->foto->judul }}</h6>
                                                                                <p class="mb-2 text-muted small">{{ Str::limit($comment->comment, 100) }}</p>
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <small class="text-muted">
                                                                                        <i class="fas fa-calendar me-1"></i>
                                                                                        {{ $comment->created_at->diffForHumans() }}
                                                                                    </small>
                                                                                    <div>
                                                                                        @if($comment->is_approved)
                                                                                            <span class="badge bg-success">
                                                                                                <i class="fas fa-check"></i> Disetujui
                                                                                            </span>
                                                                                        @else
                                                                                            <span class="badge bg-warning">
                                                                                                <i class="fas fa-clock"></i> Menunggu
                                                                                            </span>
                                                                                        @endif
                                                                                        <a href="{{ route('galeri.public') }}#foto-{{ $comment->foto->id }}" 
                                                                                           class="btn btn-sm btn-outline-primary ms-2">
                                                                                            <i class="fas fa-eye"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                            <!-- Navigation Controls -->
                                            @if($userCommentsChunks->count() > 1)
                                                <div class="d-flex justify-content-between align-items-center mt-3">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#userCommentsCarousel" data-bs-slide="prev">
                                                        <i class="fas fa-chevron-left"></i> Sebelumnya
                                                    </button>
                                                    <span class="text-muted small">
                                                        <span id="commentsCurrentPage">1</span> / {{ $userCommentsChunks->count() }}
                                                    </span>
                                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#userCommentsCarousel" data-bs-slide="next">
                                                        Berikutnya <i class="fas fa-chevron-right"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-center py-4 text-muted">
                                            <i class="fas fa-comment-slash fa-3x mb-3 opacity-25"></i>
                                            <p>Belum ada komentar</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-4 text-center">
                        <a href="{{ route('home') }}" class="btn btn-light btn-lg shadow">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @else
    <!-- Hero Section - Auto Carousel -->
    <section id="home" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
        <div class="hero-background" style="background-image: url('{{ asset('images/smk-gedung.jpg') }}');">
            <div class="hero-content">
                <h1 class="hero-title">Selamat Datang di SMK Negeri 4 Kota Bogor</h1>
                <p class="hero-subtitle">Mengembangkan Generasi Unggul dengan Kompetensi Digital dan Karakter Bangsa</p>
                            <a href="{{ route('galeri.public') }}" class="hero-btn">Lihat Galeri Kegiatan</a>
                        </div>
                        </div>
                        </div>
                
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="hero-background" style="background-image: url('{{ asset('images/fasilitas/kompleks-sekolah.JPG') }}');">
                        <div class="hero-content">
                            <h1 class="hero-title">Lingkungan Belajar yang Nyaman</h1>
                            <p class="hero-subtitle">suasana kondusif untuk mengembangkan potensi siswa</p>
                            <a href="{{ route('profil.visi-misi') }}" class="hero-btn">Profil Visi-Misi</a>
                    </div>
                </div>
            </div>
            </div>
            
            <!-- Carousel Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- YouTube Video Section with White Background -->
    <section class="youtube-section py-5 position-relative youtube-section-white" style="overflow: hidden;">
        <!-- White Overlay -->
        <div class="youtube-white-overlay"></div>
        
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="video-container scroll-slide-left">
                        <div class="video-wrapper">
                            <iframe 
                                src="https://www.youtube.com/embed/auya1s3yif4" 
                                title="SMK Pusat Keunggulan" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                        </div>
                    </div>
                <div class="col-lg-6">
                    <div class="video-text scroll-slide-right">
                        <h2 class="video-title text-white">SMK Pusat Keunggulan</h2>
                        <p class="video-description text-white">
                            SMK Negeri 4 Kota Bogor sebagai Pusat Keunggulan yang berkomitmen 
                            memberikan pendidikan berkualitas tinggi dan menghasilkan lulusan 
                            yang siap bersaing di era digital.
                        </p>
                        <div class="video-features">
                            <div class="feature-item">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Pendidikan Berkualitas</span>
                </div>
                            <div class="feature-item">
                                <i class="fas fa-laptop-code"></i>
                                <span>Teknologi Terdepan</span>
                        </div>
                            <div class="feature-item">
                                <i class="fas fa-users"></i>
                                <span>Komunitas Unggul</span>
                        </div>
                    </div>
                </div>
                        </div>
                        </div>
        </div>
    </section>

    <!-- Gallery Section - Using Global Background with Dark Overlay -->
    <section id="gallery" class="py-5 scroll-animate position-relative gallery-section-dark" style="margin-bottom: 0; padding-bottom: 3rem; background: transparent;">
        <!-- Dark Overlay for Gallery Section -->
        <div class="gallery-dark-overlay"></div>
        
        <div class="container position-relative" style="z-index: 2;">
            <h2 class="section-title scroll-animate delay-1">Galeri Kegiatan Sekolah</h2>
            <div class="row g-3">
                @forelse($galeries as $galery)
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="gallery-card-simple" style="cursor: pointer;" 
                             @if($galery->fotos->count() > 0)
                             onclick="openImageFullscreen(
                                 '{{ \App\Helpers\ImageHelper::getImageUrl($galery->fotos->first()->file) }}',
                                 [
                                     @php
                                         // Ambil semua foto dari galeri dengan judul album yang sama
                                         $albumTitle = $galery->judul ?? ($galery->post ? $galery->post->judul : 'gallery_' . $galery->id);
                                         $titleGaleries = $galeriesByTitle[$albumTitle] ?? collect();
                                         $allPhotosInAlbum = collect();
                                         foreach($titleGaleries as $titleGalery) {
                                             foreach($titleGalery->fotos as $foto) {
                                                 $allPhotosInAlbum->push($foto);
                                             }
                                         }
                                     @endphp
                                     @foreach($allPhotosInAlbum as $foto)
                                         '{{ \App\Helpers\ImageHelper::getImageUrl($foto->file) }}'{{ !$loop->last ? ',' : '' }}
                                     @endforeach
                                 ],
                                 {{ $allPhotosInAlbum->search(function($foto) use ($galery) {
                                     return $foto->id === $galery->fotos->first()->id;
                                 }) ?: 0 }},
                                 '{{ $galery->judul ?? ($galery->post ? $galery->post->judul : 'Gallery') }}',
                                 '{{ ucfirst($galery->category) }}'
                             )"
                             @endif>
                            @if($galery->fotos->count() > 0)
                                <img src="{{ \App\Helpers\ImageHelper::getImageUrl($galery->fotos->first()->file) }}" 
                                    class="gallery-image-simple w-100" 
                                    alt="{{ $galery->judul ?? ($galery->post ? $galery->post->judul : 'Gallery') }}">
                            @else
                                <div class="gallery-image-simple w-100 bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-images fa-2x text-muted"></i>
                                </div>
                            @endif
                            <div class="gallery-label">
                                <span>{{ Str::limit($galery->judul ?? ($galery->post ? $galery->post->judul : 'Gallery'), 20) }}</span>
                                <span class="badge bg-primary ms-2" style="font-size: 0.7rem;">{{ ucfirst($galery->category) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="py-5">
                            <i class="fas fa-images fa-5x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum Ada Album</h4>
                            <p class="text-muted">Galeri kegiatan sekolah akan segera hadir!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Custom Gallery Viewers (No Bootstrap Modal) -->
        @foreach($galeries as $galery)
            @if($galery->fotos->count() > 0)
                @php
                    $albumTitle = $galery->judul ?? ($galery->post ? $galery->post->judul : 'Gallery');
                @endphp
                
                <!-- Gallery Grid View - Modern Light Blur Style -->
                <div id="galleryView{{ $galery->id }}" style="
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(255, 255, 255, 0.7);
                    backdrop-filter: blur(15px);
                    -webkit-backdrop-filter: blur(15px);
                    z-index: 10000;
                    overflow-y: auto;
                    padding: 3rem 2rem;
                    animation: fadeIn 0.25s ease-in-out;
                ">
                    <!-- Close Button - Top Right -->
                    <button onclick="closeGalleryView{{ $galery->id }}()" style="
                        position: fixed;
                        top: 2rem;
                        right: 2rem;
                        background: rgba(255, 255, 255, 0.9);
                        border: none;
                        color: #333;
                        padding: 10px 20px;
                        border-radius: 8px;
                        cursor: pointer;
                        font-size: 1rem;
                        font-weight: 600;
                        transition: all 0.3s ease;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                        z-index: 10001;
                    " onmouseover="this.style.background='rgba(255,255,255,1)'; this.style.transform='scale(1.05)'" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform='scale(1)'">
                        <i class="fas fa-times me-2"></i>Tutup
                    </button>

                    <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 80vh;">
                        <!-- Title Centered Above Photos -->
                        <div style="text-align: center; margin-bottom: 3rem;">
                            <h3 style="color: #333; margin: 0; font-size: 2rem; font-weight: 700;">
                                <i class="fas fa-images me-2" style="color: #667eea;"></i>{{ $albumTitle }}
                            </h3>
                        </div>
                        
                        <!-- Photo Grid Centered -->
                        <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; justify-content: center; align-items: center; width: 100%;">
                            @foreach($galery->fotos as $foto)
                                <img src="{{ \App\Helpers\ImageHelper::getImageUrl($foto->file) }}" 
                                     class="previewable img-fluid" 
                                     alt="{{ $albumTitle }}"
                                     style="width: 320px; height: 280px; object-fit: cover; border-radius: 12px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); background: white;"
                                     onmouseover="this.style.transform='translateY(-5px) scale(1.02)'; this.style.boxShadow='0 8px 20px rgba(0, 0, 0, 0.15)'"
                                     onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.1)'"
                                     onerror="this.src='{{ asset('images/placeholder.jpg') }}';">
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <script>
                    function openGalleryView{{ $galery->id }}() {
                        document.getElementById('galleryView{{ $galery->id }}').style.display = 'block';
                        document.body.style.overflow = 'hidden';
                    }
                    
                    function closeGalleryView{{ $galery->id }}() {
                        document.getElementById('galleryView{{ $galery->id }}').style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                </script>
            @endif
        @endforeach
    </section>



    <!-- News Section - White Background -->
    <section id="news" class="py-5 berita-section position-relative news-section-white" style="z-index: 1; margin-top: 0; padding-top: 4rem !important; background: transparent; min-height: 700px;">
        <!-- White Overlay -->
        <div class="news-white-overlay"></div>
        
        <div class="container position-relative" style="z-index: 2;">
            <h2 class="section-title">Berita Terbaru</h2>
            <div class="row g-4">
                @forelse($latestPosts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="news-card-modern">
                            <!-- News Image -->
                            @if($post->galeries && $post->galeries->count() > 0 && $post->galeries->first()->fotos->count() > 0)
                                @php
                                    $imageUrl = \App\Helpers\ImageHelper::getImageUrl($post->galeries->first()->fotos->first()->file);
                                @endphp
                                <div class="news-image">
                                    <img src="{{ $imageUrl }}" alt="{{ $post->judul }}">
                                    <div class="news-image-overlay"></div>
                                    
                                    <!-- Event Date Badge -->
                                    @if($post->tanggal_jadwal)
                                        @php
                                            $eventDate = \Carbon\Carbon::parse($post->tanggal_jadwal);
                                            $isUpcoming = $eventDate->isFuture();
                                            $isPast = $eventDate->isPast();
                                            $isToday = $eventDate->isToday();
                                        @endphp
                                        
                                        @if($isUpcoming)
                                            <div class="event-badge event-badge-upcoming">
                                                <i class="fas fa-calendar-check me-1"></i>
                                                Akan Datang: {{ $eventDate->locale('id')->format('d M Y') }}
                                            </div>
                                        @elseif($isToday)
                                            <div class="event-badge event-badge-today">
                                                <i class="fas fa-calendar-day me-1"></i>
                                                Hari Ini
                                            </div>
                                        @elseif($isPast)
                                            <div class="event-badge event-badge-past">
                                                <i class="fas fa-calendar-times me-1"></i>
                                                {{ $eventDate->locale('id')->format('d M Y') }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @else
                                <div class="news-image news-image-placeholder">
                                    <div class="placeholder-content">
                                        <i class="fas fa-newspaper"></i>
                                        <span>Tidak ada gambar</span>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="news-content">
                                <div class="news-header">
                                    <div class="date-badge">
                                        <i class="fas fa-calendar-alt me-2"></i>
                                        {{ $post->created_at->format('d M, Y') }}
                            </div>
                                </div>
                                <h5 class="news-title">{{ Str::limit($post->judul, 60) }}</h5>
                                <p class="news-description">{{ Str::limit($post->isi, 150) }}</p>
                                <div class="news-footer">
                                    <a href="{{ route('berita.show', $post->id) }}" class="read-more-link">Baca Selengkapnya »</a>
                                    <div class="author-info">
                                        <i class="fas fa-user"></i>
                                        <span>{{ $post->petugas->username }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="py-5">
                            <i class="fas fa-newspaper fa-5x text-white mb-3"></i>
                            <h4 class="text-white">Belum Ada Berita</h4>
                            <p class="text-light">Berita terbaru akan segera hadir!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-primary">Hubungi Kami</h2>
                <p class="lead text-muted">Kirimkan kritik, saran, atau pertanyaan Anda kepada kami</p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-5">
                            <h4 class="card-title text-primary mb-4">
                                <i class="fas fa-envelope me-2"></i>Kirim Pesan
                            </h4>
                            <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                            </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="email" class="form-label fw-semibold">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                            </div>
                            </div>
                                <div class="mb-4">
                                    <label for="message" class="form-label fw-semibold">Pesan</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                              id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                                
                                <!-- reCAPTCHA v2 Checkbox -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-center">
                                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                                    </div>
                                    @error('g-recaptcha-response')
                                        <div class="text-danger text-center mt-2">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                    @error('recaptcha')
                                        <div class="text-danger text-center mt-2">
                                            <small>{{ $message }}</small>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                                </div>
                                <div class="text-center mt-3">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle me-1"></i>
                                        *anda tidak perlu login untuk mengisi kritik dan saran
                                    </small>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
                
                <!-- Maps & Info -->
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-5">
                            <h4 class="card-title text-primary mb-4">
                                <i class="fas fa-map-marker-alt me-2"></i>Lokasi Sekolah
                            </h4>
                            
                            <!-- School Info -->
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">SMK Negeri 4 Kota Bogor</h5>
                                <div class="contact-info">
                                    <div class="d-flex align-items-start mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-3 mt-1"></i>
                                        <div>
                                            <strong>Alamat:</strong><br>
                                            <span class="text-muted">Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan, RT.03/RW.08, Muarasari, Kec. Bogor Sel., Kota Bogor, Jawa Barat 16137</span>
                            </div>
                            </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-phone text-primary me-3"></i>
                                        <div>
                                            <strong>Telepon:</strong>
                                            <span class="text-muted">(0251) 7547381</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-envelope text-primary me-3"></i>
                                        <div>
                                            <strong>Email:</strong>
                                            <span class="text-muted">info@smkn4bogor.sch.id</span>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                        <!-- Google Maps -->
                        <div class="map-container">
                            <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.123456789!2d106.822119!3d-6.6407281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid" 
                                    width="100%" 
                                    height="300" 
                                    style="border:0; border-radius: 10px;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                                <div class="text-center mt-3">
                                    <a href="https://maps.app.goo.gl/fi8xXEehE8JCQCwt7" 
                                       target="_blank" 
                                       class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-external-link-alt me-2"></i>Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Display Section -->
    <section id="testimoni-display" class="py-5" style="background: #f8fafc;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-5 fw-bold text-primary">Testimoni dari Masyarakat</h2>
                <p class="lead text-muted">Kritik, saran, dan pertanyaan dari pengunjung website</p>
            </div>
            
            <div class="row g-4" id="testimoni-container">
                <!-- Testimoni akan dimuat di sini -->
            </div>
            
            <div class="text-center mt-4">
                <button id="load-more-testimoni" class="btn btn-outline-primary" style="display: none;">
                    <i class="fas fa-plus me-2"></i>Lihat Lebih Banyak
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">SMK Negeri 4 Kota Bogor</h5>
                    <p class="text-muted">
                        Mengembangkan generasi unggul dengan kompetensi digital dan karakter bangsa yang kuat 
                        untuk masa depan Indonesia yang lebih baik.
                    </p>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Kontak</h5>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                        <span>Jl. Raya Tajur, Kp. Buntar RT.02/RW.08, Kel. Muara sari, Kec. Bogor Selatan, RT.03/RW.08, Muarasari, Kec. Bogor Sel., Kota Bogor, Jawa Barat 16137</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <span>(0251) 7547381</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <span>info@smkn4bogor.sch.id</span>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">Ikuti Kami</h5>
                    <div class="d-flex gap-3">
                        <a href="https://www.facebook.com/smkn4bogor" target="_blank" class="text-white fs-4" title="Facebook SMKN 4 Kota Bogor"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank" class="text-white fs-4" title="Instagram SMKN 4 Kota Bogor"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/smknegeri4bogor905" target="_blank"class="text-white fs-4"title="Youtube Smkn 4 Kota Bogor"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 SMK Negeri 4 Kota Bogor. All rights reserved.</p>
            </div>
        </div>
    </footer>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling untuk anchor links
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
        });

        // Sambutan Section Animation
        function animateSambutanSection() {
            const sambutanSection = document.getElementById('sambutan');
            if (!sambutanSection) return;

            const rect = sambutanSection.getBoundingClientRect();
            const isInView = rect.top < window.innerHeight * 0.8 && rect.bottom > 0;
            
            const container = sambutanSection.querySelector('.sambutan-modern-container');
            const photo = sambutanSection.querySelector('.kepala-sekolah-photo-modern');
            const content = sambutanSection.querySelector('.sambutan-content-modern');

            if (isInView) {
                container.classList.add('scroll-animate');
                photo.classList.add('scroll-animate');
                content.classList.add('scroll-animate');
            } else {
                container.classList.remove('scroll-animate');
                photo.classList.remove('scroll-animate');
                content.classList.remove('scroll-animate');
            }
        }

        // Scroll listener for sambutan animation
        window.addEventListener('scroll', animateSambutanSection);
        
        // Initial check
        document.addEventListener('DOMContentLoaded', animateSambutanSection);



        
        // Notification function
        function showNotification(type, message) {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());
            
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `notification notification-${type}`;
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 8px;
                color: white;
                font-weight: 500;
                z-index: 9999;
                max-width: 400px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            
            if (type === 'success') {
                notification.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            } else {
                notification.style.background = 'linear-gradient(135deg, #ef4444, #dc2626)';
            }
            
            notification.innerHTML = `
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 300);
            }, 5000);
        }

        // Input underline animation
        document.querySelectorAll('.contact-input').forEach(input => {
            input.addEventListener('focus', function() {
                const underline = this.nextElementSibling;
                if (underline && underline.classList.contains('input-underline')) {
                    underline.style.width = '100%';
                }
            });
            
            input.addEventListener('blur', function() {
                const underline = this.nextElementSibling;
                if (underline && underline.classList.contains('input-underline')) {
                    if (!this.value) {
                        underline.style.width = '0';
                    }
                }
            });
        });

         // Hero Carousel Auto-start
         document.addEventListener('DOMContentLoaded', function() {
             // Initialize hero carousel
             const heroCarousel = document.getElementById('heroCarousel');
             if (heroCarousel) {
                 const heroCarouselInstance = new bootstrap.Carousel(heroCarousel, {
                     interval: 4000,
                     ride: 'carousel',
                     wrap: true,
                     pause: 'hover'
                 });
                 
                 // Pause carousel when user hovers over it
                 heroCarousel.addEventListener('mouseenter', function() {
                     heroCarouselInstance.pause();
                 });
                 
                 // Resume carousel when user stops hovering
                 heroCarousel.addEventListener('mouseleave', function() {
                     heroCarouselInstance.cycle();
                 });
             }
        });

         // Carousel auto-start and pause on hover functionality for gallery modals
         document.addEventListener('DOMContentLoaded', function() {
             // Initialize carousels when modals open
             const modals = document.querySelectorAll('.modal');
             modals.forEach(function(modal) {
                 modal.addEventListener('shown.bs.modal', function(e) {
                     const carousel = this.querySelector('.carousel');
                     if (carousel && carousel.id) {
                         // Destroy existing carousel instance if any
                         const existingCarousel = bootstrap.Carousel.getInstance(carousel);
                         if (existingCarousel) {
                             existingCarousel.dispose();
                         }
                         
                         // Small delay to ensure DOM is ready
                         setTimeout(() => {
                             const carouselInstance = new bootstrap.Carousel(carousel, {
                                 interval: false, // Disable auto-slide in modal
                                 ride: false,
                                 wrap: true,
                                 keyboard: true,
                                 pause: 'hover'
                             });
                         }, 100);
                     }
                 });
                 
                 // Clean up when modal is hidden
                 modal.addEventListener('hidden.bs.modal', function() {
                     const carousel = this.querySelector('.carousel');
                     if (carousel) {
                         const carouselInstance = bootstrap.Carousel.getInstance(carousel);
                         if (carouselInstance) {
                             carouselInstance.dispose();
                         }
                     }
                     
                     // Remove any lingering backdrops
                     const backdrops = document.querySelectorAll('.modal-backdrop');
                     backdrops.forEach(backdrop => backdrop.remove());
                     
                     // Re-enable body scroll
                     document.body.classList.remove('modal-open');
                     document.body.style.overflow = '';
                     document.body.style.paddingRight = '';
                 });
             });
             
             // Global function to close modal
             window.closeModal = function(modalId) {
                 const modalElement = document.getElementById(modalId);
                 if (modalElement) {
                     const modalInstance = bootstrap.Modal.getInstance(modalElement);
                     if (modalInstance) {
                         modalInstance.hide();
                     } else {
                         // If no instance exists, create one and hide it
                         const newModalInstance = new bootstrap.Modal(modalElement);
                         newModalInstance.hide();
                     }
                 }
             };
             
             // Ensure modal close functionality works
             document.addEventListener('click', function(e) {
                 if (e.target.classList.contains('btn-close') || 
                     e.target.classList.contains('btn-secondary') ||
                     e.target.closest('.btn-close') ||
                     e.target.closest('.btn-secondary')) {
                     const modal = e.target.closest('.modal');
                     if (modal) {
                         const modalInstance = bootstrap.Modal.getInstance(modal);
                         if (modalInstance) {
                             modalInstance.hide();
                         }
                     }
                 }
                 
                 // Close modal when clicking on backdrop
                 if (e.target.classList.contains('modal-backdrop')) {
                     const openModal = document.querySelector('.modal.show');
                     if (openModal) {
                         const modalInstance = bootstrap.Modal.getInstance(openModal);
                         if (modalInstance) {
                             modalInstance.hide();
                         }
                     }
                 }
             });
             
             // Close modal on escape key
             document.addEventListener('keydown', function(e) {
                 if (e.key === 'Escape') {
                     const openModal = document.querySelector('.modal.show');
                     if (openModal) {
                         const modalInstance = bootstrap.Modal.getInstance(openModal);
                         if (modalInstance) {
                             modalInstance.hide();
                         }
                     }
                 }
             });
             
             // Force close all modals function
            window.closeAllModals = function() {
                const openModals = document.querySelectorAll('.modal.show');
                openModals.forEach(modal => {
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                });
            };

             // Scroll Animation Functionality
             const observerOptions = {
                 threshold: 0.1,
                 rootMargin: '0px 0px -50px 0px'
             };

             const observer = new IntersectionObserver(function(entries) {
                 entries.forEach(entry => {
                     if (entry.isIntersecting) {
                         entry.target.classList.add('animate');
                     }
                 });
             }, observerOptions);

             // Observe all elements with scroll-animate class
             const animateElements = document.querySelectorAll('.scroll-animate');
             animateElements.forEach(el => {
                 observer.observe(el);
             });

             // Video section scroll animation
             const videoObserverOptions = {
                 threshold: 0.2,
                 rootMargin: '0px 0px -100px 0px'
             };

             const videoObserver = new IntersectionObserver(function(entries) {
                 entries.forEach(entry => {
                     if (entry.isIntersecting) {
                         entry.target.classList.add('animate');
                     }
                 });
             }, videoObserverOptions);

            // Observe video elements
            const videoElements = document.querySelectorAll('.scroll-slide-left, .scroll-slide-right');
            videoElements.forEach(el => {
                videoObserver.observe(el);
            });

            // Initialize Hero Carousel with auto-slide
            const heroCarousel = document.getElementById('heroCarousel');
            if (heroCarousel) {
                const carousel = new bootstrap.Carousel(heroCarousel, {
                    interval: 4000, // 4 seconds
                    wrap: true,
                    touch: true,
                    keyboard: true
                });

                // Ensure auto-slide continues after user interaction
                heroCarousel.addEventListener('slide.bs.carousel', function (event) {
                    // Reset the interval after manual slide
                    setTimeout(() => {
                        carousel.cycle();
                    }, 100);
                });

                // Pause on hover, resume on mouse leave
                heroCarousel.addEventListener('mouseenter', function() {
                    carousel.pause();
                });

                heroCarousel.addEventListener('mouseleave', function() {
                    carousel.cycle();
                });
            }
         });

         // Load Testimoni
         function loadTestimoni() {
             fetch('/api/testimoni')
                 .then(response => response.json())
                 .then(data => {
                     const container = document.getElementById('testimoni-container');
                     const loadMoreBtn = document.getElementById('load-more-testimoni');
                     
                     if (data.length === 0) {
                         container.innerHTML = `
                             <div class="col-12">
                                 <div class="testimoni-empty">
                                     <i class="fas fa-comments"></i>
                                     <h5>Belum ada testimoni</h5>
                                     <p>Jadilah yang pertama memberikan testimoni!</p>
                                 </div>
                             </div>
                         `;
                         return;
                     }
                     
                     let html = '';
                     data.forEach(testimoni => {
                         const initial = testimoni.name.charAt(0).toUpperCase();
                         const date = new Date(testimoni.created_at).toLocaleDateString('id-ID', {
                             day: 'numeric',
                             month: 'long',
                             year: 'numeric'
                         });
                         
                         html += `
                             <div class="col-lg-4 col-md-6">
                                 <div class="testimoni-card">
                                     <div class="testimoni-header">
                                         <div class="testimoni-avatar">${initial}</div>
                                         <div class="testimoni-info">
                                             <h6>${testimoni.name}</h6>
                                             <small>${testimoni.email}</small>
                                         </div>
                                     </div>
                                     <div class="testimoni-message">
                                         "${testimoni.message}"
                                     </div>
                                     <div class="testimoni-date">
                                         <i class="fas fa-calendar-alt"></i>
                                         ${date}
                                     </div>
                                 </div>
                             </div>
                         `;
                     });
                     
                     container.innerHTML = html;
                     
                     // Show load more button if there are more than 6 testimonials
                     if (data.length > 6) {
                         loadMoreBtn.style.display = 'inline-block';
                     }
                 })
                 .catch(error => {
                     console.error('Error loading testimonials:', error);
                     const container = document.getElementById('testimoni-container');
                     container.innerHTML = `
                         <div class="col-12">
                             <div class="testimoni-empty">
                                 <i class="fas fa-exclamation-triangle"></i>
                                 <h5>Gagal memuat testimoni</h5>
                                 <p>Silakan refresh halaman untuk mencoba lagi.</p>
                             </div>
                         </div>
                     `;
                 });
         }

         // Load testimonials when page loads
         document.addEventListener('DOMContentLoaded', function() {
             loadTestimoni();
             
             // Check if we need to scroll to testimoni section after form submission
            @if(session('scroll_to_testimoni'))
                setTimeout(function() {
                    const testimoniSection = document.getElementById('testimoni-display');
                    if (testimoniSection) {
                        testimoniSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 500); // Small delay to ensure page is fully loaded
            @endif
         });
     </script>
     
     <!-- Google reCAPTCHA v2 -->
     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     
     <!-- Image Viewer for Gallery Modal -->
     <script>
         // Global function untuk image viewer
         window.openImageViewer = function(imageUrl, albumTitle, photoNumber) {
             console.log('Opening image viewer:', imageUrl);
             
             // Remove existing viewer if any
             const existingViewer = document.getElementById('imageViewer');
             if (existingViewer) {
                 existingViewer.remove();
             }
             
             // Create fullscreen image viewer
             const viewer = document.createElement('div');
             viewer.id = 'imageViewer';
             viewer.style.position = 'fixed';
             viewer.style.top = '0';
             viewer.style.left = '0';
             viewer.style.width = '100vw';
             viewer.style.height = '100vh';
             viewer.style.backgroundColor = 'rgba(0, 0, 0, 0.95)';
             viewer.style.zIndex = '99999';
             viewer.style.display = 'flex';
             viewer.style.alignItems = 'center';
             viewer.style.justifyContent = 'center';
             viewer.style.padding = '60px 40px 80px 40px';
             viewer.style.boxSizing = 'border-box';
             
             // Create image container
             const container = document.createElement('div');
             container.style.position = 'relative';
             container.style.width = '100%';
             container.style.height = '100%';
             container.style.display = 'flex';
             container.style.alignItems = 'center';
             container.style.justifyContent = 'center';
             
             // Create image
             const img = document.createElement('img');
             img.src = imageUrl;
             img.alt = albumTitle + ' - Foto ' + photoNumber;
             img.style.maxWidth = '100%';
             img.style.maxHeight = '100%';
             img.style.width = 'auto';
             img.style.height = 'auto';
             img.style.objectFit = 'contain';
             img.style.borderRadius = '12px';
             img.style.boxShadow = '0 20px 60px rgba(0,0,0,0.8)';
             img.style.backgroundColor = 'white';
             img.style.padding = '8px';
             
             // Create close button
             const closeBtn = document.createElement('button');
             closeBtn.innerHTML = '×';
             closeBtn.style.position = 'fixed';
             closeBtn.style.top = '20px';
             closeBtn.style.right = '20px';
             closeBtn.style.backgroundColor = 'white';
             closeBtn.style.border = 'none';
             closeBtn.style.width = '50px';
             closeBtn.style.height = '50px';
             closeBtn.style.borderRadius = '50%';
             closeBtn.style.cursor = 'pointer';
             closeBtn.style.fontSize = '24px';
             closeBtn.style.fontWeight = 'bold';
             closeBtn.style.boxShadow = '0 4px 20px rgba(0,0,0,0.4)';
             closeBtn.style.color = '#333';
             closeBtn.style.zIndex = '100000';
             closeBtn.onclick = function() {
                 window.closeImageViewer();
             };
             
             // Create info badge
             const infoBadge = document.createElement('div');
             infoBadge.innerHTML = '<i class="fas fa-images me-2" style="color: #667eea;"></i>' + albumTitle + ' - Foto ' + photoNumber;
             infoBadge.style.position = 'fixed';
             infoBadge.style.bottom = '20px';
             infoBadge.style.left = '50%';
             infoBadge.style.transform = 'translateX(-50%)';
             infoBadge.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
             infoBadge.style.color = '#333';
             infoBadge.style.padding = '12px 24px';
             infoBadge.style.borderRadius = '25px';
             infoBadge.style.textAlign = 'center';
             infoBadge.style.boxShadow = '0 4px 20px rgba(0,0,0,0.3)';
             infoBadge.style.fontWeight = '500';
             
             // Append elements
             container.appendChild(img);
             viewer.appendChild(container);
             viewer.appendChild(closeBtn);
             viewer.appendChild(infoBadge);
             
             // Click outside to close
             viewer.onclick = function(e) {
                 if (e.target === viewer || e.target === container) {
                     window.closeImageViewer();
                 }
             };
             
             // Append to body
             document.body.appendChild(viewer);
             document.body.style.overflow = 'hidden';
         };
         
         window.closeImageViewer = function() {
             const viewer = document.getElementById('imageViewer');
             if (viewer) {
                 viewer.remove();
                 document.body.style.overflow = '';
             }
         };
         
         // Close on ESC key
         document.addEventListener('keydown', function(e) {
             if (e.key === 'Escape') {
                 window.closeImageViewer();
             }
         });
     </script>
     
     <!-- Profile Photo Preview Script -->
     <script>
         function previewPhoto(input) {
             if (input.files && input.files[0]) {
                 const reader = new FileReader();
                 
                 reader.onload = function(e) {
                     const preview = document.getElementById('profilePhotoPreview');
                     if (preview) {
                         if (preview.tagName === 'IMG') {
                             preview.src = e.target.result;
                         } else {
                             preview.innerHTML = `<img src="${e.target.result}" class="rounded-circle img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">`;
                         }
                     }
                 }
                 
                 reader.readAsDataURL(input.files[0]);
             }
        }
    </script>

    <!-- Fullscreen Image Viewer - Modern Light Blur Style -->
    <div id="imgViewer" onclick="closeViewer()">
        <button id="closeBtn" onclick="closeViewer(); event.stopPropagation();">✕ Tutup</button>
        
        <!-- Previous Button -->
        <button id="prevBtn" onclick="navigateImage(-1); event.stopPropagation();" style="
            position: absolute;
            left: 2rem;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 2rem;
            color: #333;
            font-weight: bold;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 10001;
        " onmouseover="this.style.background='rgba(255,255,255,1)'; this.style.transform='translateY(-50%) scale(1.1)'; this.style.boxShadow='0 6px 16px rgba(0, 0, 0, 0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform='translateY(-50%) scale(1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'">
            <i class="fas fa-chevron-left"></i>
        </button>
        
        <!-- Next Button -->
        <button id="nextBtn" onclick="navigateImage(1); event.stopPropagation();" style="
            position: absolute;
            right: 2rem;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.2rem;
            color: #333;
            font-weight: bold;
            display: none;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 10001;
        " onmouseover="this.style.background='rgba(255,255,255,1)'; this.style.transform='translateY(-50%) scale(1.1)'; this.style.boxShadow='0 6px 16px rgba(0, 0, 0, 0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.9)'; this.style.transform='translateY(-50%) scale(1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.15)'">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        <img id="viewImage" src="" alt="Preview" onclick="event.stopPropagation()">
        
        <!-- Gallery Info (Title & Category) - Moved to Bottom -->
        <div style="
            position: absolute;
            bottom: 5rem;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            max-width: 80%;
        ">
            <div id="galleryTitle" style="
                background: rgba(255, 255, 255, 0.9);
                padding: 10px 20px;
                border-radius: 10px;
                font-size: 1.1rem;
                font-weight: 700;
                color: #333;
                margin-bottom: 8px;
                display: none;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            "></div>
            <div id="galleryCategory" style="
                background: rgba(59, 130, 246, 0.9);
                padding: 6px 16px;
                border-radius: 20px;
                font-size: 0.85rem;
                font-weight: 600;
                color: white;
                display: none;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                margin-bottom: 8px;
            "></div>
        </div>
        
        <!-- Image Counter -->
        <div id="imageCounter" style="
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.8);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            display: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        "></div>
    </div>

    <script>
        // Gallery data storage
        let currentGalleryImages = [];
        let currentImageIndex = 0;

        // Modern Fullscreen Image Viewer Script
        document.addEventListener('DOMContentLoaded', function() {
            // Add click event to all .previewable images
            document.querySelectorAll('.previewable').forEach(img => {
                img.style.cursor = 'pointer';
                img.addEventListener('click', function(e) {
                    e.stopPropagation();
                    document.getElementById('viewImage').src = this.src;
                    document.getElementById('imgViewer').style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });
        });

        // Function to open image in fullscreen with gallery navigation
        function openImageFullscreen(imageUrl, galleryImages = [], startIndex = 0, albumTitle = '', categoryName = '') {
            console.log('Opening fullscreen with', galleryImages.length, 'images');
            
            currentGalleryImages = galleryImages;
            currentImageIndex = startIndex;
            
            document.getElementById('viewImage').src = imageUrl;
            document.getElementById('imgViewer').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            
            // Update title and category info
            const titleElement = document.getElementById('galleryTitle');
            const categoryElement = document.getElementById('galleryCategory');
            if (titleElement && albumTitle) {
                titleElement.textContent = albumTitle;
                titleElement.style.display = 'block';
            }
            if (categoryElement && categoryName) {
                categoryElement.textContent = 'Kategori: ' + categoryName;
                categoryElement.style.display = 'block';
            }
            
            // Show/hide navigation buttons
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const counter = document.getElementById('imageCounter');
            
            console.log('Gallery has', galleryImages.length, 'images');
            
            if (galleryImages.length > 1) {
                console.log('Showing navigation buttons');
                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';
                counter.style.display = 'block';
                updateCounter();
            } else {
                console.log('Hiding navigation buttons - only 1 image');
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
                counter.style.display = 'none';
            }
        }

        // Navigate between images
        function navigateImage(direction) {
            if (currentGalleryImages.length === 0) return;
            
            currentImageIndex += direction;
            
            // Loop around
            if (currentImageIndex < 0) {
                currentImageIndex = currentGalleryImages.length - 1;
            } else if (currentImageIndex >= currentGalleryImages.length) {
                currentImageIndex = 0;
            }
            
            document.getElementById('viewImage').src = currentGalleryImages[currentImageIndex];
            updateCounter();
        }

        // Update image counter
        function updateCounter() {
            const counter = document.getElementById('imageCounter');
            counter.textContent = `${currentImageIndex + 1} / ${currentGalleryImages.length}`;
        }

        function closeViewer() {
            const viewer = document.getElementById('imgViewer');
            viewer.style.animation = 'fadeOut 0.2s ease-in-out';
            setTimeout(() => {
                viewer.style.display = 'none';
                viewer.style.animation = 'fadeIn 0.25s ease-in-out';
                document.body.style.overflow = 'auto';
                currentGalleryImages = [];
                currentImageIndex = 0;
            }, 200);
        }

        // Close viewer on ESC key, navigate with arrow keys
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeViewer();
            } else if (e.key === 'ArrowLeft') {
                navigateImage(-1);
            } else if (e.key === 'ArrowRight') {
                navigateImage(1);
            }
        });
        
        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = '@keyframes fadeOut { from {opacity: 1;} to {opacity: 0;} }';
        document.head.appendChild(style);
    </script>

    <!-- Liked Photos & Comments Carousel Page Counter -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Liked Photos Carousel
            const likedCarousel = document.getElementById('likedPhotosCarousel');
            if (likedCarousel) {
                likedCarousel.addEventListener('slide.bs.carousel', function(e) {
                    const currentPageElement = document.getElementById('likedCurrentPage');
                    if (currentPageElement) {
                        currentPageElement.textContent = e.to + 1;
                    }
                });
            }

            // User Comments Carousel
            const commentsCarousel = document.getElementById('userCommentsCarousel');
            if (commentsCarousel) {
                commentsCarousel.addEventListener('slide.bs.carousel', function(e) {
                    const currentPageElement = document.getElementById('commentsCurrentPage');
                    if (currentPageElement) {
                        currentPageElement.textContent = e.to + 1;
                    }
                });
            }
        });
    </script>
</body>
</html>
