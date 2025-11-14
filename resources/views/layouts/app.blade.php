<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(config('app.env') === 'production' || config('app.env') === 'staging')
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <title>@yield('title', 'Web Galeri Sekolah')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/smk-logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8e7ff 0%, #e0f2fe 50%, #f0fdf4 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(248, 231, 255, 0.4) 0%, transparent 60%),
                radial-gradient(circle at 80% 20%, rgba(224, 242, 254, 0.4) 0%, transparent 60%),
                radial-gradient(circle at 40% 40%, rgba(240, 253, 244, 0.3) 0%, transparent 60%);
            z-index: -1;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.98);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            border: none;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            pointer-events: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
            background: linear-gradient(135deg, #5a67d8, #6b46c1);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        
        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
            background: linear-gradient(135deg, #059669, #047857);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
            color: white;
        }
        
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.6);
            background: linear-gradient(135deg, #d97706, #b45309);
        }
        
        .btn-info {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(6, 182, 212, 0.4);
        }
        
        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6, 182, 212, 0.6);
            background: linear-gradient(135deg, #0891b2, #0e7490);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6b7280, #4b5563);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(107, 114, 128, 0.4);
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(107, 114, 128, 0.6);
            background: linear-gradient(135deg, #4b5563, #374151);
        }
        
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        /* Modern Sidebar - Like photo first */
        .sidebar {
            background: #ffffff !important;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1) !important;
        }
        
        .sidebar .nav-link {
            color: #374151 !important;
            padding: 12px 16px !important;
            margin: 4px 8px !important;
            text-decoration: none !important;
            display: flex !important;
            align-items: center !important;
            background: #f8fafc !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 8px !important;
            font-weight: 500 !important;
            transition: all 0.3s ease !important;
        }
        
        .sidebar .nav-link:hover {
            background: #e0f2fe !important;
            color: #1e40af !important;
            text-decoration: none !important;
            transform: translateX(2px) !important;
            box-shadow: 0 2px 8px rgba(30, 64, 175, 0.15) !important;
        }
        
        .sidebar .nav-link.active {
            background: #1e40af !important;
            color: #ffffff !important;
            border-color: #1e40af !important;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3) !important;
        }
        
        .sidebar .nav-link i {
            color: #6b7280 !important;
            margin-right: 12px !important;
            width: 20px !important;
            text-align: center !important;
            font-size: 1.1rem !important;
        }
        
        .sidebar .nav-link.active i {
            color: #ffffff !important;
        }
        
        .sidebar .nav-link:hover i {
            color: #1e40af !important;
        }
        
        /* Header text styling */
        .h2 {
            color: #000000 !important;
            font-weight: 600 !important;
        }
        
        .text-dark {
            color: #000000 !important;
            font-weight: 500 !important;
        }
        
        .btn-outline-dark {
            color: #000000 !important;
            border-color: #000000 !important;
        }
        
        .btn-outline-dark:hover {
            background-color: #000000 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar" style="min-height: 100vh;">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <div class="d-inline-block mb-3">
                            <div style="width: 80px; height: 80px; border-radius: 50%; border: 4px solid #1e40af; display: flex; align-items: center; justify-content: center; background: white; overflow: hidden; box-shadow: 0 6px 20px rgba(30, 64, 175, 0.2);">
                                <img src="{{ asset('images/smk-logo.png') }}" 
                                     alt="SMK Negeri 4 Kota Bogor Logo" 
                                     style="width: 100%; height: 100%; object-fit: contain; border-radius: 50%;">
                            </div>
                        </div>
                        <div class="text-dark">
                            <div class="fw-bold" style="font-size: 1.1rem; color: #1e40af;">GALERI SEKOLAH</div>
                        </div>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.index') || request()->routeIs('admin.create') || request()->routeIs('admin.edit') ? 'active' : '' }}" href="{{ route('admin.index') }}">
                                <i class="fas fa-users-cog me-2"></i>
                                Manajemen Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('galeri.*') && !request()->routeIs('admin.galeri.upload') ? 'active' : '' }}" href="{{ route('galeri.index') }}">
                                <i class="fas fa-images me-2"></i>
                                Album Sekolah
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                                <i class="fas fa-tags me-2"></i>
                                Kategori Post
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('post.*') ? 'active' : '' }}" href="{{ route('post.index') }}">
                                <i class="fas fa-newspaper me-2"></i>
                                Berita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.galeri.upload') ? 'active' : '' }}" href="/admin/galeri/upload">
                                <i class="fas fa-cloud-upload-alt me-2"></i>
                                Upload Foto
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
                                <i class="fas fa-envelope me-2"></i>
                                Pesan Masuk
                                @php
                                    $unreadCount = \App\Models\Message::where('status', 'unread')->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="badge bg-danger rounded-pill ms-2">{{ $unreadCount }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="{{ route('logout') }}">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2 text-dark">@yield('page-title', 'Dashboard')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <span class="text-dark me-3">Hello, {{ session('username') }}</span>
                            <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm me-2">
                                <i class="fas fa-home me-1"></i>
                                Homepage
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Interactive Report Button (Only on Galeri page) -->
                @if(request()->routeIs('galeri.index'))
                <div class="mb-4">
                    <a href="{{ route('galeri.report') }}" class="btn btn-primary" style="border-radius: 12px; padding: 14px 28px; font-weight: 700; font-size: 16px; background: white; color: #1e40af; border: 3px solid #1e40af; text-decoration: none; box-shadow: 0 4px 12px rgba(30, 64, 175, 0.2); transition: all 0.3s ease;">
                        <i class="fas fa-chart-bar me-2" style="font-size: 18px;"></i>
                        Laporan Interaktif
                    </a>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Interactive Report Modal -->
    <div class="modal fade" id="interactiveReportModal" tabindex="-1" aria-labelledby="interactiveReportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 20px; border: none;">
                <div class="modal-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 20px 20px 0 0;">
                    <h5 class="modal-title" id="interactiveReportModalLabel">
                        <i class="fas fa-chart-line me-2"></i>
                        Laporan Interaktif Galeri Sekolah
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 2rem;">
                    <!-- Report Filters -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar me-2 text-primary"></i>
                                Periode
                            </label>
                            <select class="form-select" id="reportPeriod" style="border-radius: 10px;">
                                <option value="all">Semua Waktu</option>
                                <option value="today">Hari Ini</option>
                                <option value="week">Minggu Ini</option>
                                <option value="month" selected>Bulan Ini</option>
                                <option value="year">Tahun Ini</option>
                                <option value="custom">Custom Range</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-tag me-2 text-success"></i>
                                Kategori
                            </label>
                            <select class="form-select" id="reportCategory" style="border-radius: 10px;">
                                <option value="all">Semua Kategori</option>
                                <option value="umum">Umum</option>
                                <option value="ekstrakurikuler">Ekstrakurikuler</option>
                                <option value="prestasi">Prestasi</option>
                                <option value="pplg">PPLG</option>
                                <option value="tjkt">TJKT</option>
                                <option value="tpfl">TPFL</option>
                                <option value="to">TO</option>
                                <option value="transforkrab">Transforkrab</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-toggle-on me-2 text-info"></i>
                                Status
                            </label>
                            <select class="form-select" id="reportStatus" style="border-radius: 10px;">
                                <option value="all">Semua Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-center" style="border-radius: 15px; border: 2px solid #667eea; background: linear-gradient(135deg, #f0f4ff, #ffffff);">
                                <div class="card-body">
                                    <i class="fas fa-images fa-3x text-primary mb-2"></i>
                                    <h3 class="mb-0" id="totalAlbums">0</h3>
                                    <p class="text-muted mb-0">Total Album</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center" style="border-radius: 15px; border: 2px solid #10b981; background: linear-gradient(135deg, #f0fdf4, #ffffff);">
                                <div class="card-body">
                                    <i class="fas fa-photo-video fa-3x text-success mb-2"></i>
                                    <h3 class="mb-0" id="totalPhotos">0</h3>
                                    <p class="text-muted mb-0">Total Foto</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center" style="border-radius: 15px; border: 2px solid #f59e0b; background: linear-gradient(135deg, #fffbeb, #ffffff);">
                                <div class="card-body">
                                    <i class="fas fa-heart fa-3x text-warning mb-2"></i>
                                    <h3 class="mb-0" id="totalLikes">0</h3>
                                    <p class="text-muted mb-0">Total Likes</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center" style="border-radius: 15px; border: 2px solid #06b6d4; background: linear-gradient(135deg, #ecfeff, #ffffff);">
                                <div class="card-body">
                                    <i class="fas fa-comments fa-3x text-info mb-2"></i>
                                    <h3 class="mb-0" id="totalComments">0</h3>
                                    <p class="text-muted mb-0">Total Komentar</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Report Table -->
                    <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                        <div class="card-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 15px 15px 0 0;">
                            <h6 class="mb-0">
                                <i class="fas fa-table me-2"></i>
                                Detail Laporan Galeri
                            </h6>
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover" id="reportTable">
                                <thead style="position: sticky; top: 0; background: white; z-index: 10;">
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Album</th>
                                        <th>Kategori</th>
                                        <th>Jumlah Foto</th>
                                        <th>Likes</th>
                                        <th>Komentar</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody">
                                    <tr>
                                        <td colspan="8" class="text-center">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 2px solid #e5e7eb; padding: 1.5rem;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                        <i class="fas fa-times me-2"></i>
                        Tutup
                    </button>
                    <button type="button" class="btn btn-success" onclick="downloadReportPDF()" style="border-radius: 10px;">
                        <i class="fas fa-file-pdf me-2"></i>
                        Download PDF
                    </button>
                    <button type="button" class="btn btn-primary" onclick="printReport()" style="border-radius: 10px;">
                        <i class="fas fa-print me-2"></i>
                        Cetak Laporan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <script>
        // Simple script to ensure links work
        document.addEventListener('DOMContentLoaded', function() {
            // Remove any conflicting styles
            const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
            sidebarLinks.forEach(link => {
                link.style.pointerEvents = 'auto';
                link.style.cursor = 'pointer';
                link.style.userSelect = 'none';
            });
        });

        // Interactive Report Functions
        let reportData = [];

        // Load report data when modal opens
        document.getElementById('interactiveReportModal')?.addEventListener('show.bs.modal', function() {
            loadReportData();
        });

        // Listen to filter changes
        document.getElementById('reportPeriod')?.addEventListener('change', loadReportData);
        document.getElementById('reportCategory')?.addEventListener('change', loadReportData);
        document.getElementById('reportStatus')?.addEventListener('change', loadReportData);

        function loadReportData() {
            const period = document.getElementById('reportPeriod')?.value || 'all';
            const category = document.getElementById('reportCategory')?.value || 'all';
            const status = document.getElementById('reportStatus')?.value || 'all';

            // Show loading
            document.getElementById('reportTableBody').innerHTML = `
                <tr>
                    <td colspan="8" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                </tr>
            `;

            // Fetch data from API
            fetch(`/api/galeri/report?period=${period}&category=${category}&status=${status}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        reportData = data.data;
                        displayReportData(data.data, data.statistics);
                    } else {
                        showError('Gagal memuat data laporan');
                    }
                })
                .catch(error => {
                    console.error('Error loading report:', error);
                    showError('Terjadi kesalahan saat memuat data');
                });
        }

        function displayReportData(data, stats) {
            // Update statistics
            document.getElementById('totalAlbums').textContent = stats.total_albums || 0;
            document.getElementById('totalPhotos').textContent = stats.total_photos || 0;
            document.getElementById('totalLikes').textContent = stats.total_likes || 0;
            document.getElementById('totalComments').textContent = stats.total_comments || 0;

            // Update table
            const tbody = document.getElementById('reportTableBody');
            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                            Tidak ada data untuk ditampilkan
                        </td>
                    </tr>
                `;
                return;
            }

            tbody.innerHTML = data.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.title}</td>
                    <td>
                        <span class="badge bg-${getCategoryColor(item.category)}">
                            ${getCategoryLabel(item.category)}
                        </span>
                    </td>
                    <td>${item.photos_count}</td>
                    <td><i class="fas fa-heart text-danger me-1"></i>${item.likes_count || 0}</td>
                    <td><i class="fas fa-comment text-info me-1"></i>${item.comments_count || 0}</td>
                    <td>
                        <span class="badge bg-${item.status == 1 ? 'success' : 'secondary'}">
                            ${item.status == 1 ? 'Aktif' : 'Tidak Aktif'}
                        </span>
                    </td>
                    <td>${formatDate(item.created_at)}</td>
                </tr>
            `).join('');
        }

        function getCategoryColor(category) {
            const colors = {
                'umum': 'primary',
                'ekstrakurikuler': 'success',
                'prestasi': 'warning',
                'pplg': 'info',
                'tjkt': 'danger',
                'tpfl': 'secondary',
                'to': 'dark',
                'transforkrab': 'purple'
            };
            return colors[category] || 'secondary';
        }

        function getCategoryLabel(category) {
            const labels = {
                'umum': 'Umum',
                'ekstrakurikuler': 'Ekstrakurikuler',
                'prestasi': 'Prestasi',
                'pplg': 'PPLG',
                'tjkt': 'TJKT',
                'tpfl': 'TPFL',
                'to': 'TO',
                'transforkrab': 'Transforkrab'
            };
            return labels[category] || category;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', { 
                day: '2-digit', 
                month: 'short', 
                year: 'numeric' 
            });
        }

        function showError(message) {
            document.getElementById('reportTableBody').innerHTML = `
                <tr>
                    <td colspan="8" class="text-center text-danger">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2 d-block"></i>
                        ${message}
                    </td>
                </tr>
            `;
        }

        // Download PDF function
        function downloadReportPDF() {
            const period = document.getElementById('reportPeriod')?.value || 'all';
            const category = document.getElementById('reportCategory')?.value || 'all';
            const status = document.getElementById('reportStatus')?.value || 'all';

            // Create printable content
            const element = document.createElement('div');
            element.style.padding = '20px';
            element.innerHTML = `
                <div style="text-align: center; margin-bottom: 30px;">
                    <h1 style="color: #1e40af; margin-bottom: 10px;">Laporan Galeri Sekolah</h1>
                    <h3 style="color: #666;">SMK Negeri 4 Kota Bogor</h3>
                    <p style="color: #999;">Tanggal: ${new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</p>
                </div>
                
                <div style="margin-bottom: 30px;">
                    <h4 style="color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 10px;">Statistik</h4>
                    <table style="width: 100%; margin-top: 15px;">
                        <tr>
                            <td style="padding: 10px; background: #f0f4ff;"><strong>Total Album:</strong></td>
                            <td style="padding: 10px; background: #f0f4ff;">${document.getElementById('totalAlbums').textContent}</td>
                            <td style="padding: 10px; background: #f0fdf4;"><strong>Total Foto:</strong></td>
                            <td style="padding: 10px; background: #f0fdf4;">${document.getElementById('totalPhotos').textContent}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px; background: #fffbeb;"><strong>Total Likes:</strong></td>
                            <td style="padding: 10px; background: #fffbeb;">${document.getElementById('totalLikes').textContent}</td>
                            <td style="padding: 10px; background: #ecfeff;"><strong>Total Komentar:</strong></td>
                            <td style="padding: 10px; background: #ecfeff;">${document.getElementById('totalComments').textContent}</td>
                        </tr>
                    </table>
                </div>
                
                <div>
                    <h4 style="color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 10px;">Detail Laporan</h4>
                    ${document.getElementById('reportTable').outerHTML}
                </div>
            `;

            const opt = {
                margin: 10,
                filename: `Laporan_Galeri_${new Date().getTime()}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };

            html2pdf().set(opt).from(element).save();
        }

        // Print function
        function printReport() {
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Laporan Galeri Sekolah</title>');
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; padding: 20px; }');
            printWindow.document.write('h1, h3 { text-align: center; color: #1e40af; }');
            printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 20px; }');
            printWindow.document.write('th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }');
            printWindow.document.write('th { background-color: #1e40af; color: white; }');
            printWindow.document.write('.stats { margin: 20px 0; padding: 15px; background: #f0f4ff; border-radius: 10px; }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<h1>Laporan Galeri Sekolah</h1>');
            printWindow.document.write('<h3>SMK Negeri 4 Kota Bogor</h3>');
            printWindow.document.write(`<p style="text-align: center;">Tanggal: ${new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</p>`);
            printWindow.document.write('<div class="stats">');
            printWindow.document.write(`<p><strong>Total Album:</strong> ${document.getElementById('totalAlbums').textContent}</p>`);
            printWindow.document.write(`<p><strong>Total Foto:</strong> ${document.getElementById('totalPhotos').textContent}</p>`);
            printWindow.document.write(`<p><strong>Total Likes:</strong> ${document.getElementById('totalLikes').textContent}</p>`);
            printWindow.document.write(`<p><strong>Total Komentar:</strong> ${document.getElementById('totalComments').textContent}</p>`);
            printWindow.document.write('</div>');
            printWindow.document.write(document.getElementById('reportTable').outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

    <style>
        /* Laporan Interaktif Button Hover Effect */
        .btn-primary:hover {
            background: #1e40af !important;
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4) !important;
        }
    </style>
</body>
</html>
