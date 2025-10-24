@extends('layouts.app')

@section('title', 'Dashboard | Web Galeri Sekolah')

@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Welcome Card -->
    <div class="card mb-4">
        <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                <div class="me-3">
                    <div style="width: 80px; height: 80px; border-radius: 50%; border: 3px solid #1e40af; display: flex; align-items: center; justify-content: center; background: white; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/smk-logo.png') }}" 
                             alt="SMK Negeri 4 Kota Bogor Logo" 
                             style="width: 100%; height: 100%; object-fit: contain; border-radius: 50%;">
                    </div>
                </div>
                    <div>
                    <h1 class="h2 mb-2">Selamat Datang!</h1>
                    <p class="text-muted mb-0">Selamat datang di Dashboard Galeri Sekolah SMK Negeri 4 Kota Bogor</p>
                </div>
            </div>
            
            <div class="d-flex align-items-center">
                <a href="{{ route('home') }}" class="btn btn-outline-light">
                            <i class="fas fa-home me-2"></i>
                    Kunjungi Homepage
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Post</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPosts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                        </div>
                    </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKategori }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Galeri</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalGalery }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-images fa-2x text-gray-300"></i>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Foto</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalFoto }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-camera fa-2x text-gray-300"></i>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-bolt me-2"></i>
                    Quick Actions
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-3">
                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-block w-100">
                        <i class="fas fa-plus me-2"></i>
                        Buat Post Baru
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <a href="{{ route('kategori.create') }}" class="btn btn-success btn-block w-100">
                        <i class="fas fa-tags me-2"></i>
                        Tambah Kategori
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <a href="{{ route('galeri.create') }}" class="btn btn-warning btn-block w-100">
                        <i class="fas fa-images me-2"></i>
                        Buat Galeri Baru
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-3">
                    <a href="{{ route('admin.create') }}" class="btn btn-info btn-block w-100">
                        <i class="fas fa-user-plus me-2"></i>
                        Tambah Admin
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>

<style>
/* Modern Stats Cards with Better Contrast */
.border-left-primary {
    border-left: 4px solid #667eea !important;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.15), rgba(118, 75, 162, 0.08)) !important;
    position: relative;
    overflow: hidden;
}

.border-left-primary::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(102, 126, 234, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.border-left-success {
    border-left: 4px solid #10b981 !important;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(5, 150, 105, 0.08)) !important;
    position: relative;
    overflow: hidden;
}

.border-left-success::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.border-left-warning {
    border-left: 4px solid #f59e0b !important;
    background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.08)) !important;
    position: relative;
    overflow: hidden;
}

.border-left-warning::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.border-left-danger {
    border-left: 4px solid #ef4444 !important;
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.08)) !important;
    position: relative;
    overflow: hidden;
}

.border-left-danger::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(239, 68, 68, 0.15) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

/* Enhanced text contrast for soft background */
.text-gray-300 {
    color: #4b5563 !important;
    opacity: 1 !important;
    font-weight: 600 !important;
}

.text-gray-800 {
    color: #0f172a !important;
    font-weight: 900 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    letter-spacing: -0.025em;
}

/* Title text styling for better visibility */
.text-xs.font-weight-bold.text-primary {
    color: #1e40af !important;
    font-weight: 800 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
    letter-spacing: 0.05em;
}

.text-xs.font-weight-bold.text-success {
    color: #047857 !important;
    font-weight: 800 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
    letter-spacing: 0.05em;
}

.text-xs.font-weight-bold.text-warning {
    color: #d97706 !important;
    font-weight: 800 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
    letter-spacing: 0.05em;
}

.text-xs.font-weight-bold.text-danger {
    color: #dc2626 !important;
    font-weight: 800 !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
    letter-spacing: 0.05em;
}

/* Enhanced card hover effects */
.border-left-primary:hover,
.border-left-success:hover,
.border-left-warning:hover,
.border-left-danger:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

/* Enhanced icon styling for better visibility */
.text-gray-300 i {
    font-size: 2.5rem !important;
    opacity: 1 !important;
    transition: all 0.3s ease;
    color: #374151 !important;
    filter: drop-shadow(0 3px 6px rgba(0, 0, 0, 0.2));
    font-weight: 600;
}

.border-left-primary:hover .text-gray-300 i {
    transform: scale(1.1);
    opacity: 1 !important;
    color: #667eea !important;
    filter: drop-shadow(0 4px 8px rgba(102, 126, 234, 0.3));
}

.border-left-success:hover .text-gray-300 i {
    transform: scale(1.1);
    opacity: 1 !important;
    color: #10b981 !important;
    filter: drop-shadow(0 4px 8px rgba(16, 185, 129, 0.3));
}

.border-left-warning:hover .text-gray-300 i {
    transform: scale(1.1);
    opacity: 1 !important;
    color: #f59e0b !important;
    filter: drop-shadow(0 4px 8px rgba(245, 158, 11, 0.3));
}

.border-left-danger:hover .text-gray-300 i {
    transform: scale(1.1);
    opacity: 1 !important;
    color: #ef4444 !important;
    filter: drop-shadow(0 4px 8px rgba(239, 68, 68, 0.3));
}

/* Welcome card enhancement */
.card-body {
    position: relative;
}

.card-body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.02), rgba(118, 75, 162, 0.02));
    border-radius: 20px;
    pointer-events: none;
}

/* Enhanced text visibility in welcome card */
.h2 {
    color: #0f172a !important;
    font-weight: 900 !important;
    text-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
    letter-spacing: -0.025em;
}

.text-muted {
    color: #475569 !important;
    font-weight: 600 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    line-height: 1.5;
}

/* Button enhancements */
.btn-outline-light {
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: #667eea;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 12px 24px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-outline-light:hover {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-color: transparent;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}
</style>
@endsection
