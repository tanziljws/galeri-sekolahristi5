@extends('layouts.app')

@section('title', 'Laporan Interaktif Galeri')

@section('page-title', 'Laporan Interaktif Galeri')

@section('content')
<div class="container-fluid">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Galeri
        </a>
    </div>

    <!-- Report Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 20px 20px 0 0;">
            <h5 class="mb-0">
                <i class="fas fa-filter me-2"></i>
                Filter Laporan
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
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
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 15px; border: 2px solid #667eea; background: linear-gradient(135deg, #f0f4ff, #ffffff); box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);">
                <div class="card-body">
                    <i class="fas fa-images fa-3x text-primary mb-3"></i>
                    <h2 class="mb-0 fw-bold" id="totalAlbums">0</h2>
                    <p class="text-muted mb-0 mt-2">Total Album</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 15px; border: 2px solid #10b981; background: linear-gradient(135deg, #f0fdf4, #ffffff); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.2);">
                <div class="card-body">
                    <i class="fas fa-photo-video fa-3x text-success mb-3"></i>
                    <h2 class="mb-0 fw-bold" id="totalPhotos">0</h2>
                    <p class="text-muted mb-0 mt-2">Total Foto</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 15px; border: 2px solid #f59e0b; background: linear-gradient(135deg, #fffbeb, #ffffff); box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2); cursor: pointer; transition: transform 0.2s;" 
                 onclick="showAllLikes()" 
                 onmouseover="this.style.transform='scale(1.05)'" 
                 onmouseout="this.style.transform='scale(1)'">
                <div class="card-body">
                    <i class="fas fa-heart fa-3x text-warning mb-3"></i>
                    <h2 class="mb-0 fw-bold" id="totalLikes">0</h2>
                    <p class="text-muted mb-0 mt-2">Total Likes</p>
                    <small class="text-muted"><i class="fas fa-hand-pointer me-1"></i>Klik untuk detail</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center" style="border-radius: 15px; border: 2px solid #06b6d4; background: linear-gradient(135deg, #ecfeff, #ffffff); box-shadow: 0 4px 15px rgba(6, 182, 212, 0.2); cursor: pointer; transition: transform 0.2s;" 
                 onclick="showAllComments()" 
                 onmouseover="this.style.transform='scale(1.05)'" 
                 onmouseout="this.style.transform='scale(1)'">
                <div class="card-body">
                    <i class="fas fa-comments fa-3x text-info mb-3"></i>
                    <h2 class="mb-0 fw-bold" id="totalComments">0</h2>
                    <p class="text-muted mb-0 mt-2">Total Komentar</p>
                    <small class="text-muted"><i class="fas fa-hand-pointer me-1"></i>Klik untuk detail</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; border-radius: 20px 20px 0 0;">
            <h5 class="mb-0">
                <i class="fas fa-table me-2"></i>
                Detail Laporan Galeri
            </h5>
        </div>
        <div class="card-body" style="padding: 0;">
            <div style="max-height: 500px; overflow-y: auto;">
                <table class="table table-hover mb-0" id="reportTable">
                    <thead style="position: sticky; top: 0; background: white; z-index: 10; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <tr>
                            <th style="padding: 15px;">No</th>
                            <th style="padding: 15px;">Judul Album</th>
                            <th style="padding: 15px;">Kategori</th>
                            <th style="padding: 15px;">Jumlah Foto</th>
                            <th style="padding: 15px;">Likes</th>
                            <th style="padding: 15px;">Komentar</th>
                            <th style="padding: 15px;">Status</th>
                            <th style="padding: 15px;">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody">
                        <tr>
                            <td colspan="8" class="text-center" style="padding: 50px;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-3 text-muted">Memuat data laporan...</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
            <button type="button" class="btn btn-success btn-lg me-3" onclick="downloadReportPDF()" style="border-radius: 12px; padding: 12px 30px;">
                <i class="fas fa-file-pdf me-2"></i>
                Download PDF
            </button>
            <button type="button" class="btn btn-primary btn-lg" onclick="printReport()" style="border-radius: 12px; padding: 12px 30px;">
                <i class="fas fa-print me-2"></i>
                Cetak Laporan
            </button>
        </div>
    </div>
</div>

<!-- Comments Modal -->
<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; border-radius: 20px 20px 0 0;">
                <h5 class="modal-title" id="commentsModalLabel">
                    <i class="fas fa-comments me-2"></i>
                    Komentar - <span id="albumTitle"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; max-height: 500px; overflow-y: auto;">
                <div id="commentsContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Memuat komentar...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 2px solid #e5e7eb;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                    <i class="fas fa-times me-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Likes Modal -->
<div class="modal fade" id="likesModal" tabindex="-1" aria-labelledby="likesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #ec4899, #db2777); color: white; border-radius: 20px 20px 0 0;">
                <h5 class="modal-title" id="likesModalLabel">
                    <i class="fas fa-heart me-2"></i>
                    Likes - <span id="albumTitleLikes"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; max-height: 500px; overflow-y: auto;">
                <div id="likesContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-danger" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Memuat likes...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 2px solid #e5e7eb;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                    <i class="fas fa-times me-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Comments Modal -->
<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="background: linear-gradient(135deg, #06b6d4, #0891b2); color: white; border-radius: 20px 20px 0 0;">
                <h5 class="modal-title" id="commentsModalLabel">
                    <i class="fas fa-comments me-2"></i>
                    Komentar - <span id="albumTitleComments"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 2rem; max-height: 500px; overflow-y: auto;">
                <div id="commentsContent">
                    <div class="text-center py-5">
                        <div class="spinner-border text-info" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-3 text-muted">Memuat komentar...</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 2px solid #e5e7eb;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">
                    <i class="fas fa-times me-2"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    // Load report data on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadReportData();
    });

    // Listen to filter changes
    document.getElementById('reportPeriod').addEventListener('change', loadReportData);
    document.getElementById('reportCategory').addEventListener('change', loadReportData);
    document.getElementById('reportStatus').addEventListener('change', loadReportData);

    let reportData = [];

    function loadReportData() {
        const period = document.getElementById('reportPeriod').value || 'all';
        const category = document.getElementById('reportCategory').value || 'all';
        const status = document.getElementById('reportStatus').value || 'all';

        // Show loading
        document.getElementById('reportTableBody').innerHTML = `
            <tr>
                <td colspan="8" class="text-center" style="padding: 50px;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat data laporan...</p>
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
                    <td colspan="8" class="text-center text-muted" style="padding: 50px;">
                        <i class="fas fa-inbox fa-4x mb-3 d-block" style="opacity: 0.3;"></i>
                        <h5>Tidak ada data untuk ditampilkan</h5>
                        <p>Coba ubah filter untuk melihat data lainnya</p>
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = data.map((item, index) => `
            <tr style="transition: all 0.3s ease;">
                <td style="padding: 15px;">${index + 1}</td>
                <td style="padding: 15px; font-weight: 500;">${item.title}</td>
                <td style="padding: 15px;">
                    <span class="badge bg-${getCategoryColor(item.category)}" style="padding: 6px 12px; font-size: 0.85rem;">
                        ${getCategoryLabel(item.category)}
                    </span>
                </td>
                <td style="padding: 15px; text-align: center;">
                    <span class="badge bg-secondary" style="padding: 6px 12px;">${item.photos_count}</span>
                </td>
                <td style="padding: 15px;">
                    ${item.likes_count > 0 ? 
                        `<a href="#" onclick="showLikes(${item.id}, '${item.title}', event)" class="text-decoration-none">
                            <i class="fas fa-heart text-danger me-1"></i>
                            <strong class="text-danger">${item.likes_count}</strong>
                        </a>` 
                        : 
                        `<i class="fas fa-heart text-muted me-1"></i>
                        <strong class="text-muted">0</strong>`
                    }
                </td>
                <td style="padding: 15px;">
                    ${item.comments_count > 0 ? 
                        `<a href="#" onclick="showComments(${item.id}, '${item.title}', event)" class="text-decoration-none">
                            <i class="fas fa-comment text-info me-1"></i>
                            <strong class="text-info">${item.comments_count}</strong>
                        </a>` 
                        : 
                        `<i class="fas fa-comment text-muted me-1"></i>
                        <strong class="text-muted">0</strong>`
                    }
                </td>
                <td style="padding: 15px;">
                    <span class="badge bg-${item.status == 1 ? 'success' : 'secondary'}" style="padding: 6px 12px;">
                        ${item.status == 1 ? 'Aktif' : 'Tidak Aktif'}
                    </span>
                </td>
                <td style="padding: 15px;">${formatDate(item.created_at)}</td>
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
                <td colspan="8" class="text-center text-danger" style="padding: 50px;">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3 d-block"></i>
                    <h5>${message}</h5>
                </td>
            </tr>
        `;
    }

    // Show comments modal
    function showComments(galeryId, albumTitle, event) {
        event.preventDefault();
        
        // Set album title
        document.getElementById('albumTitle').textContent = albumTitle;
        
        // Show loading
        document.getElementById('commentsContent').innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat komentar...</p>
            </div>
        `;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('commentsModal'));
        modal.show();
        
        // Fetch comments from API
        fetch(`/api/galeri/${galeryId}/comments`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    displayComments(data.data);
                } else {
                    showCommentsError('Gagal memuat komentar');
                }
            })
            .catch(error => {
                console.error('Error loading comments:', error);
                showCommentsError('Terjadi kesalahan saat memuat komentar');
            });
    }

    function displayComments(comments) {
        const container = document.getElementById('commentsContent');
        
        if (comments.length === 0) {
            container.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3" style="opacity: 0.3;"></i>
                    <h5 class="text-muted">Belum ada komentar</h5>
                    <p class="text-muted">Album ini belum memiliki komentar</p>
                </div>
            `;
            return;
        }

        container.innerHTML = comments.map((comment, index) => `
            <div class="card mb-3" style="border-radius: 12px; border: 1px solid #e5e7eb; transition: all 0.3s ease;">
                <div class="card-body">
                    <div class="d-flex align-items-start mb-2">
                        <div class="flex-shrink-0">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #06b6d4, #0891b2); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 1.2rem;">
                                ${comment.name.charAt(0).toUpperCase()}
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-0 fw-bold">${comment.name}</h6>
                                    <small class="text-muted">
                                        <i class="far fa-clock me-1"></i>
                                        ${formatDateTime(comment.created_at)}
                                    </small>
                                </div>
                                <span class="badge bg-${comment.status === 'approved' ? 'success' : comment.status === 'rejected' ? 'danger' : 'warning'}" style="font-size: 0.75rem;">
                                    ${comment.status === 'approved' ? 'Disetujui' : comment.status === 'rejected' ? 'Ditolak' : 'Pending'}
                                </span>
                            </div>
                            ${comment.foto_title ? `
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-image me-1"></i>
                                        Foto: <strong>${comment.foto_title}</strong>
                                    </small>
                                </div>
                            ` : ''}
                            <div class="mt-3">
                                <p class="mb-0" style="line-height: 1.6;">${comment.comment}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
    }

    function showCommentsError(message) {
        document.getElementById('commentsContent').innerHTML = `
            <div class="text-center py-5">
                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                <h5 class="text-danger">${message}</h5>
            </div>
        `;
    }

    function formatDateTime(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { 
            day: '2-digit', 
            month: 'short', 
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    // Show likes modal
    function showLikes(galeryId, albumTitle, event) {
        event.preventDefault();
        
        // Set album title
        document.getElementById('albumTitleLikes').textContent = albumTitle;
        
        // Show loading
        document.getElementById('likesContent').innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat likes...</p>
            </div>
        `;
        
        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('likesModal'));
        modal.show();
        
        // Fetch likes from API
        fetch(`/api/galeri/${galeryId}/likes`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    displayLikes(data.data);
                } else {
                    showLikesError('Gagal memuat likes');
                }
            })
            .catch(error => {
                console.error('Error loading likes:', error);
                showLikesError('Terjadi kesalahan saat memuat likes');
            });
    }

    function displayLikes(likes) {
        const container = document.getElementById('likesContent');
        
        if (likes.length === 0) {
            container.innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-heart-broken fa-4x text-muted mb-3" style="opacity: 0.3;"></i>
                    <h5 class="text-muted">Belum ada likes</h5>
                    <p class="text-muted">Album ini belum mendapat like</p>
                </div>
            `;
            return;
        }

        // Group likes by foto
        const likesByFoto = {};
        likes.forEach(like => {
            const fotoTitle = like.foto_title || 'Tanpa Judul';
            if (!likesByFoto[fotoTitle]) {
                likesByFoto[fotoTitle] = [];
            }
            likesByFoto[fotoTitle].push(like);
        });

        container.innerHTML = Object.keys(likesByFoto).map(fotoTitle => `
            <div class="mb-4">
                <h6 class="fw-bold mb-3" style="color: #ec4899; border-bottom: 2px solid #ec4899; padding-bottom: 8px;">
                    <i class="fas fa-image me-2"></i>
                    ${fotoTitle}
                    <span class="badge bg-danger ms-2">${likesByFoto[fotoTitle].length} likes</span>
                </h6>
                <div class="row g-2">
                    ${likesByFoto[fotoTitle].map(like => `
                        <div class="col-md-6">
                            <div class="card" style="border-radius: 10px; border: 1px solid #fce7f3; background: linear-gradient(135deg, #fff5f7, #ffffff); transition: all 0.3s ease;">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #ec4899, #db2777); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                <i class="fas fa-heart"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="fw-bold" style="color: #ec4899;">${like.user_name || 'Anonymous'}</div>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>
                                                ${formatDateTime(like.created_at)}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
        `).join('');
    }

    function showLikesError(message) {
        document.getElementById('likesContent').innerHTML = `
            <div class="text-center py-5">
                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                <h5 class="text-danger">${message}</h5>
            </div>
        `;
    }

    // Download PDF function
    function downloadReportPDF() {
        // Create printable content
        const element = document.createElement('div');
        element.style.padding = '30px';
        element.style.fontFamily = 'Arial, sans-serif';
        element.innerHTML = `
            <div style="text-align: center; margin-bottom: 40px; border-bottom: 3px solid #1e40af; padding-bottom: 20px;">
                <h1 style="color: #1e40af; margin-bottom: 10px; font-size: 28px;">Laporan Galeri Sekolah</h1>
                <h2 style="color: #666; font-size: 20px; font-weight: normal;">SMK Negeri 4 Kota Bogor</h2>
                <p style="color: #999; margin-top: 10px;">Tanggal: ${new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</p>
            </div>
            
            <div style="margin-bottom: 40px;">
                <h3 style="color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 10px; margin-bottom: 20px;">Statistik Galeri</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 15px; background: #f0f4ff; border: 1px solid #ddd; width: 25%;"><strong>Total Album:</strong></td>
                        <td style="padding: 15px; background: #f0f4ff; border: 1px solid #ddd; width: 25%; text-align: center; font-size: 20px; color: #667eea;"><strong>${document.getElementById('totalAlbums').textContent}</strong></td>
                        <td style="padding: 15px; background: #f0fdf4; border: 1px solid #ddd; width: 25%;"><strong>Total Foto:</strong></td>
                        <td style="padding: 15px; background: #f0fdf4; border: 1px solid #ddd; width: 25%; text-align: center; font-size: 20px; color: #10b981;"><strong>${document.getElementById('totalPhotos').textContent}</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 15px; background: #fffbeb; border: 1px solid #ddd;"><strong>Total Likes:</strong></td>
                        <td style="padding: 15px; background: #fffbeb; border: 1px solid #ddd; text-align: center; font-size: 20px; color: #f59e0b;"><strong>${document.getElementById('totalLikes').textContent}</strong></td>
                        <td style="padding: 15px; background: #ecfeff; border: 1px solid #ddd;"><strong>Total Komentar:</strong></td>
                        <td style="padding: 15px; background: #ecfeff; border: 1px solid #ddd; text-align: center; font-size: 20px; color: #06b6d4;"><strong>${document.getElementById('totalComments').textContent}</strong></td>
                    </tr>
                </table>
            </div>
            
            <div>
                <h3 style="color: #1e40af; border-bottom: 2px solid #1e40af; padding-bottom: 10px; margin-bottom: 20px;">Detail Laporan Galeri</h3>
                ${document.getElementById('reportTable').outerHTML}
            </div>
        `;

        const opt = {
            margin: 15,
            filename: `Laporan_Galeri_${new Date().getTime()}.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

        html2pdf().set(opt).from(element).save();
    }

    // Show all likes from all galleries
    function showAllLikes() {
        document.getElementById('albumTitleLikes').textContent = 'Semua Album';
        document.getElementById('likesContent').innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat semua likes...</p>
            </div>
        `;
        
        const likesModal = new bootstrap.Modal(document.getElementById('likesModal'));
        likesModal.show();
        
        // Get all gallery IDs from current report data
        const galeryIds = reportData.map(item => item.id);
        
        // Fetch all likes
        Promise.all(galeryIds.map(id => 
            fetch(`/api/galeri/${id}/likes`).then(res => res.json())
        ))
        .then(responses => {
            const allLikes = [];
            responses.forEach((data, index) => {
                if (data.success && data.data.length > 0) {
                    data.data.forEach(like => {
                        allLikes.push({
                            ...like,
                            album: reportData[index].title
                        });
                    });
                }
            });
            
            if (allLikes.length === 0) {
                document.getElementById('likesContent').innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-heart-broken fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada likes</h5>
                    </div>
                `;
            } else {
                document.getElementById('likesContent').innerHTML = allLikes.map(like => `
                    <div class="card mb-3" style="border-left: 4px solid #ec4899;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1"><i class="fas fa-images text-primary me-2"></i>${like.album}</h6>
                                    <p class="mb-1 text-muted small"><i class="fas fa-photo-video me-1"></i>${like.foto_file || 'Foto'}</p>
                                    <p class="mb-0 text-muted small"><i class="fas fa-network-wired me-1"></i>IP: ${like.ip_address}</p>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted"><i class="far fa-clock me-1"></i>${new Date(like.created_at).toLocaleString('id-ID')}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                `).join('');
            }
        })
        .catch(error => {
            console.error('Error loading all likes:', error);
            showLikesError('Gagal memuat data likes');
        });
    }

    // Show all comments from all galleries
    function showAllComments() {
        document.getElementById('albumTitleComments').textContent = 'Semua Album';
        document.getElementById('commentsContent').innerHTML = `
            <div class="text-center py-5">
                <div class="spinner-border text-info" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Memuat semua komentar...</p>
            </div>
        `;
        
        const commentsModal = new bootstrap.Modal(document.getElementById('commentsModal'));
        commentsModal.show();
        
        // Get all gallery IDs from current report data
        const galeryIds = reportData.map(item => item.id);
        
        // Fetch all comments
        Promise.all(galeryIds.map(id => 
            fetch(`/api/galeri/${id}/comments`).then(res => res.json())
        ))
        .then(responses => {
            const allComments = [];
            responses.forEach((data, index) => {
                if (data.success && data.data.length > 0) {
                    data.data.forEach(comment => {
                        allComments.push({
                            ...comment,
                            album: reportData[index].title
                        });
                    });
                }
            });
            
            // Sort by date descending
            allComments.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
            
            if (allComments.length === 0) {
                document.getElementById('commentsContent').innerHTML = `
                    <div class="text-center py-5">
                        <i class="fas fa-comment-slash fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada komentar</h5>
                    </div>
                `;
            } else {
                document.getElementById('commentsContent').innerHTML = allComments.map(comment => `
                    <div class="card mb-3" style="border-left: 4px solid #06b6d4;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <h6 class="mb-1"><i class="fas fa-images text-primary me-2"></i>${comment.album}</h6>
                                    <p class="mb-0 text-muted small"><i class="fas fa-photo-video me-1"></i>${comment.foto_file || 'Foto'}</p>
                                </div>
                                <small class="text-muted"><i class="far fa-clock me-1"></i>${new Date(comment.created_at).toLocaleString('id-ID')}</small>
                            </div>
                            <div class="border-top pt-2">
                                <p class="mb-1"><strong><i class="fas fa-user me-1"></i>${comment.name}</strong></p>
                                <p class="mb-1 text-muted small"><i class="fas fa-envelope me-1"></i>${comment.email}</p>
                                <p class="mb-0 mt-2">${comment.comment}</p>
                            </div>
                        </div>
                    </div>
                `).join('');
            }
        })
        .catch(error => {
            console.error('Error loading all comments:', error);
            document.getElementById('commentsContent').innerHTML = `
                <div class="text-center py-5">
                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Gagal memuat data komentar</h5>
                    <p class="text-muted">${error.message}</p>
                </div>
            `;
        });
    }

    // Print function
    function printReport() {
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Laporan Galeri Sekolah</title>');
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: Arial, sans-serif; padding: 30px; }');
        printWindow.document.write('h1, h2, h3 { color: #1e40af; }');
        printWindow.document.write('h1 { text-align: center; border-bottom: 3px solid #1e40af; padding-bottom: 15px; }');
        printWindow.document.write('h2 { text-align: center; color: #666; font-weight: normal; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-top: 20px; }');
        printWindow.document.write('th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }');
        printWindow.document.write('th { background-color: #1e40af; color: white; font-weight: bold; }');
        printWindow.document.write('tr:nth-child(even) { background-color: #f9fafb; }');
        printWindow.document.write('.stats { margin: 30px 0; padding: 20px; background: #f0f4ff; border-radius: 10px; border: 2px solid #667eea; }');
        printWindow.document.write('.stats table td { padding: 15px; font-size: 16px; }');
        printWindow.document.write('.badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h1>Laporan Galeri Sekolah</h1>');
        printWindow.document.write('<h2>SMK Negeri 4 Kota Bogor</h2>');
        printWindow.document.write(`<p style="text-align: center; color: #999;">Tanggal: ${new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</p>`);
        printWindow.document.write('<div class="stats">');
        printWindow.document.write('<h3>Statistik Galeri</h3>');
        printWindow.document.write('<table style="border: none;"><tr>');
        printWindow.document.write(`<td style="border: none;"><strong>Total Album:</strong> ${document.getElementById('totalAlbums').textContent}</td>`);
        printWindow.document.write(`<td style="border: none;"><strong>Total Foto:</strong> ${document.getElementById('totalPhotos').textContent}</td>`);
        printWindow.document.write(`</tr><tr>`);
        printWindow.document.write(`<td style="border: none;"><strong>Total Likes:</strong> ${document.getElementById('totalLikes').textContent}</td>`);
        printWindow.document.write(`<td style="border: none;"><strong>Total Komentar:</strong> ${document.getElementById('totalComments').textContent}</td>`);
        printWindow.document.write('</tr></table>');
        printWindow.document.write('</div>');
        printWindow.document.write('<h3>Detail Laporan Galeri</h3>');
        printWindow.document.write(document.getElementById('reportTable').outerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>

<style>
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .badge.bg-purple {
        background-color: #9333ea !important;
    }
    
    /* Smooth animations */
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    /* Comment link hover */
    .table td a {
        transition: all 0.2s ease;
    }
    
    .table td a:hover {
        transform: scale(1.1);
        display: inline-block;
    }
    
    /* Comment card hover */
    #commentsContent .card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }
    
    /* Likes card hover */
    #likesContent .card:hover {
        box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
        transform: translateY(-2px);
        border-color: #ec4899 !important;
    }
</style>
@endsection
