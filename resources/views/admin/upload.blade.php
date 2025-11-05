<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Upload Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .upload-area:hover {
            border-color: #007bff;
            background-color: #f8f9fa;
        }
        .upload-area.dragover {
            border-color: #007bff;
            background-color: #e3f2fd;
        }
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin: 10px;
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
        }
        .sidebar {
            background: #f8f9fa;
            min-height: 100vh;
            padding: 20px 0;
        }
        .sidebar .nav-link {
            color: #495057;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="text-center mb-4">
                    <h4><i class="fas fa-cog me-2"></i>Admin Panel</h4>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="/admin/galeri/upload">
                        <i class="fas fa-upload me-2"></i>Upload Foto
                    </a>
                    <a class="nav-link" href="/admin/galeri/dashboard">
                        <i class="fas fa-chart-bar me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="/admin/galeri/reports">
                        <i class="fas fa-chart-line me-2"></i>Laporan Interaktif
                    </a>
                    <a class="nav-link" href="/galeri-foto">
                        <i class="fas fa-eye me-2"></i>Lihat Galeri
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <div class="container-fluid py-4">
                    <!-- Header -->
                    <div class="hero text-white py-4 mb-4 rounded">
                        <div class="container">
                            <h1><i class="fas fa-upload me-3"></i>Upload Foto Baru</h1>
                            <p class="mb-0">Tambah foto baru ke galeri sekolah dengan mudah</p>
                        </div>
                    </div>

                    <!-- Upload Form -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Form Upload Foto</h5>
                                </div>
                                <div class="card-body">
                                    <form id="uploadForm" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <!-- Album Information -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="post_title" class="form-label">Judul/Keterangan Kegiatan *</label>
                                                <input type="text" class="form-control" id="post_title" name="post_title" 
                                                       placeholder="Contoh: PMR, Maulid Nabi, Neospragma" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="category" class="form-label">Kategori *</label>
                                                <select class="form-select" id="category" name="category" required>
                                                    <option value="">Pilih kategori...</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ strtolower($category->judul) }}">
                                                            {{ $category->judul }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Kategori diambil dari Kategori Post
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Photo Upload Area -->
                                        <div class="mb-4">
                                            <label class="form-label">Upload Foto *</label>
                                            <div class="upload-area" id="uploadArea">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                <h5>Drag & Drop foto di sini</h5>
                                                <p class="text-muted">atau klik untuk memilih file</p>
                                                <input type="file" id="photos" name="photos[]" multiple accept="image/*" style="display: none;">
                                                <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('photos').click()">
                                                    <i class="fas fa-folder-open me-2"></i>Pilih Foto
                                                </button>
                                            </div>
                                            
                                            <!-- Preview Area -->
                                            <div id="previewArea" class="mt-3" style="display: none;">
                                                <h6>Preview Foto:</h6>
                                                <div id="imagePreviews" class="d-flex flex-wrap"></div>
                                            </div>
                                        </div>

                                        <!-- Photo Captions -->
                                        <div id="captionsArea" style="display: none;">
                                            <h6>Keterangan Foto:</h6>
                                            <div id="captionsContainer"></div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="fas fa-save me-2"></i>Upload Foto
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Stats Sidebar -->
                        <div class="col-lg-4">
                            <div class="stats-card mb-4">
                                <h5><i class="fas fa-chart-bar me-2"></i>Statistik Galeri</h5>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <h3 id="totalPhotos">0</h3>
                                        <small>Total Foto</small>
                                    </div>
                                    <div class="col-6">
                                        <h3 id="totalAlbums">0</h3>
                                        <small>Total Album</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Panduan Upload</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Format: JPG, PNG, GIF
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Ukuran maks: 10MB per foto
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Bisa upload multiple foto sekaligus
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-check text-success me-2"></i>
                                            Berikan keterangan yang jelas
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load stats on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadStats();
        });

        // Load statistics
        function loadStats() {
            fetch('/api/admin/stats')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('totalPhotos').textContent = data.data.total_photos;
                        document.getElementById('totalAlbums').textContent = data.data.total_albums;
                    }
                })
                .catch(error => console.error('Error loading stats:', error));
        }

        // File upload handling
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('photos');
        const previewArea = document.getElementById('previewArea');
        const imagePreviews = document.getElementById('imagePreviews');
        const captionsArea = document.getElementById('captionsArea');
        const captionsContainer = document.getElementById('captionsContainer');

        // Drag and drop functionality
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            handleFiles(files);
        });

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            if (files.length === 0) return;

            // Clear previous previews
            imagePreviews.innerHTML = '';
            captionsContainer.innerHTML = '';

            // Show preview area
            previewArea.style.display = 'block';
            captionsArea.style.display = 'block';

            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    // Create preview
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const previewDiv = document.createElement('div');
                        previewDiv.innerHTML = `
                            <img src="${e.target.result}" class="preview-image" alt="Preview ${index + 1}">
                            <div class="text-center">
                                <small class="text-muted">Foto ${index + 1}</small>
                            </div>
                        `;
                        imagePreviews.appendChild(previewDiv);

                        // Create caption input
                        const captionDiv = document.createElement('div');
                        captionDiv.className = 'mb-3';
                        captionDiv.innerHTML = `
                            <label class="form-label">Keterangan Foto ${index + 1}</label>
                            <input type="text" class="form-control" name="captions[]" 
                                   placeholder="Masukkan keterangan foto ${index + 1}">
                        `;
                        captionsContainer.appendChild(captionDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Form submission
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengupload...';
            submitBtn.disabled = true;

            fetch('/admin/galeri/store', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('Foto berhasil diupload! Mengalihkan...', 'success');
                    // Redirect to galeri page after 1 second
                    setTimeout(() => {
                        window.location.href = '/admin/galeri';
                    }, 1000);
                } else {
                    showAlert('Gagal upload foto: ' + data.message, 'danger');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Terjadi kesalahan saat upload', 'danger');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });

        // Show alert function
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.style.position = 'fixed';
            alertDiv.style.top = '20px';
            alertDiv.style.right = '20px';
            alertDiv.style.zIndex = '9999';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(alertDiv);

            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);
        }
    </script>
</body>
</html>
