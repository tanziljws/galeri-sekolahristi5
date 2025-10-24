@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-dark">
                <i class="fas fa-plus me-2 text-primary"></i>
                Buat Album Baru
            </h1>
            <p class="text-muted mb-0">Tambah album foto kegiatan SMK Negeri 4 Kota Bogor</p>
        </div>
        <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Galeri
        </a>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-images me-2"></i>
                        Form Album Baru
                    </h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan:</h6>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data" id="galeriForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-edit me-1 text-primary"></i>
                                        Judul Album Kegiatan
                                    </label>
                                    <small class="text-muted d-block mb-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Ini adalah judul untuk seluruh album, bukan untuk foto individual
                                    </small>
                                    <input type="text" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           name="judul" 
                                           id="judulInput"
                                           value="{{ old('judul') }}" 
                                           placeholder="Contoh: Lab PPLG, Kegiatan Adiwiyata, Upacara Bendera"
                                           maxlength="255"
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Ketik sendiri keterangan kegiatan yang akan difoto
                                        <span id="charCount" class="ms-2 text-muted">(0/255 karakter)</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-sort-numeric-up me-1 text-primary"></i>
                                        Posisi
                                    </label>
                                    <input type="number" 
                                           class="form-control @error('position') is-invalid @enderror" 
                                           name="position" 
                                           value="{{ old('position', 1) }}" 
                                           min="1" 
                                           required>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-toggle-on me-1 text-primary"></i>
                                        Status
                                    </label>
                                    <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">
                                        <i class="fas fa-graduation-cap me-1 text-primary"></i>
                                        Kategori Galeri
                                    </label>
                                    <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                        <option value="">Pilih kategori...</option>
                                        <option value="umum" {{ old('category') == 'umum' ? 'selected' : '' }}>Umum (Galeri Sekolah)</option>
                                        <option value="prestasi" {{ old('category') == 'prestasi' ? 'selected' : '' }}>Prestasi (Galeri Prestasi)</option>
                                        <option value="ekstrakurikuler" {{ old('category') == 'ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler</option>
                                        <option value="upacara" {{ old('category') == 'upacara' ? 'selected' : '' }}>Upacara</option>
                                        <option value="maulid-nabi" {{ old('category') == 'maulid-nabi' ? 'selected' : '' }}>Maulid Nabi</option>
                                        <option value="p5" {{ old('category') == 'p5' ? 'selected' : '' }}>P5 (Projek Penguatan Profil Pelajar Pancasila)</option>
                                        <option value="adiwiyata" {{ old('category') == 'adiwiyata' ? 'selected' : '' }}>Adiwiyata</option>
                                        <option value="neospragma" {{ old('category') == 'neospragma' ? 'selected' : '' }}>Neospragma</option>
                                        <option value="pmr" {{ old('category') == 'pmr' ? 'selected' : '' }}>PMR (Palang Merah Remaja)</option>
                                        <option value="pramuka" {{ old('category') == 'pramuka' ? 'selected' : '' }}>Pramuka</option>
                                        <option value="osis" {{ old('category') == 'osis' ? 'selected' : '' }}>OSIS</option>
                                        <option value="pplg" {{ old('category') == 'pplg' ? 'selected' : '' }}>PPLG (Pengembangan Perangkat Lunak & Gim)</option>
                                        <option value="tjkt" {{ old('category') == 'tjkt' ? 'selected' : '' }}>TJKT (Teknik Jaringan Komputer & Telekomunikasi)</option>
                                        <option value="tpfl" {{ old('category') == 'tpfl' ? 'selected' : '' }}>TPFL (Teknik Pengelasan & Fabrikasi Logam)</option>
                                        <option value="to" {{ old('category') == 'to' ? 'selected' : '' }}>TO (Teknik Otomotif)</option>
                                        <option value="transforkrab" {{ old('category') == 'transforkrab' ? 'selected' : '' }}>Transforkrab</option>
                                        <option value="lainnya" {{ old('category') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        <strong>Umum:</strong> Akan muncul di halaman utama galeri<br>
                                        <strong>Prestasi:</strong> Akan muncul di section khusus prestasi<br>
                                        <strong>Jurusan:</strong> Akan muncul di halaman jurusan masing-masing
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-camera me-1 text-primary"></i>
                                Foto Kegiatan (boleh lebih dari satu)
                            </label>
                            
                            <!-- Upload Area with Drag & Drop -->
                            <div id="dropZone" class="border-2 border-dashed rounded p-5 text-center bg-light" style="border-color: #cbd5e1; cursor: pointer; transition: all 0.3s;">
                                <div class="mb-3">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <h5 class="text-dark">Drag & Drop foto di sini</h5>
                                    <p class="text-muted mb-3">atau klik untuk memilih file</p>
                                    <button type="button" class="btn btn-primary" onclick="document.getElementById('fotoInput').click()">
                                        <i class="fas fa-folder-open me-2"></i>
                                        Pilih Foto
                                    </button>
                                </div>
                                <input type="file" class="d-none" id="fotoInput" name="fotos[]" accept="image/*" multiple>
                                <div class="form-text mt-3">
                                    <i class="fas fa-info-circle me-1"></i>
                                    <strong>Format:</strong> JPG, PNG | 
                                    <strong>Ukuran maksimal:</strong> 20MB per file | 
                                    <strong>Jumlah maksimal:</strong> 20 file
                                </div>
                            </div>

                            <!-- Preview Area -->
                            <div id="previewContainer" class="row g-3 mt-3" style="display: none;">
                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">
                                            <i class="fas fa-images me-2 text-primary"></i>
                                            Preview Foto (<span id="photoCount">0</span> foto)
                                        </h6>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearAllPhotos()">
                                            <i class="fas fa-trash me-1"></i>
                                            Hapus Semua
                                        </button>
                                    </div>
                                </div>
                                <div id="previewGrid" class="col-12">
                                    <div class="row g-3"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>
                                Simpan Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
let selectedFiles = [];

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('galeriForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const fileInput = document.getElementById('fotoInput');
    const dropZone = document.getElementById('dropZone');
    const judulInput = document.getElementById('judulInput');
    const charCount = document.getElementById('charCount');
    const previewContainer = document.getElementById('previewContainer');
    const previewGrid = document.querySelector('#previewGrid .row');
    const photoCount = document.getElementById('photoCount');
    
    // Character counter for judul input
    function updateCharCount() {
        const currentLength = judulInput.value.length;
        const maxLength = 255;
        charCount.textContent = `(${currentLength}/${maxLength} karakter)`;
        
        if (currentLength > maxLength * 0.9) {
            charCount.className = 'ms-2 text-warning';
        } else if (currentLength > maxLength * 0.8) {
            charCount.className = 'ms-2 text-info';
        } else {
            charCount.className = 'ms-2 text-muted';
        }
    }
    
    updateCharCount();
    judulInput.addEventListener('input', updateCharCount);
    
    // Drag & Drop handlers
    dropZone.addEventListener('click', () => fileInput.click());
    
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#4f46e5';
        dropZone.style.backgroundColor = '#eef2ff';
    });
    
    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#cbd5e1';
        dropZone.style.backgroundColor = '#f8fafc';
    });
    
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.style.borderColor = '#cbd5e1';
        dropZone.style.backgroundColor = '#f8fafc';
        
        const files = e.dataTransfer.files;
        handleFiles(files);
    });
    
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });
    
    function handleFiles(files) {
        if (files.length === 0) return;
        
        // Add new files to selectedFiles array
        for (let file of files) {
            if (file.type.startsWith('image/')) {
                selectedFiles.push(file);
            }
        }
        
        updatePreview();
    }
    
    function updatePreview() {
        if (selectedFiles.length === 0) {
            previewContainer.style.display = 'none';
            return;
        }
        
        previewContainer.style.display = 'block';
        photoCount.textContent = selectedFiles.length;
        previewGrid.innerHTML = '';
        
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const col = document.createElement('div');
                col.className = 'col-md-3 col-sm-4 col-6';
                
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                const sizeClass = fileSizeMB > 20 ? 'text-danger' : 'text-muted';
                
                col.innerHTML = `
                    <div class="card shadow-sm h-100 photo-preview-card">
                        <div class="position-relative">
                            <img src="${e.target.result}" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 m-2">
                                <button type="button" class="btn btn-sm btn-danger" onclick="removePhoto(${index})" title="Hapus foto">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="position-absolute bottom-0 start-0 m-2">
                                <span class="badge bg-dark">${index + 1}</span>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <p class="small mb-0 text-truncate" title="${file.name}">
                                <i class="fas fa-file-image me-1"></i>
                                ${file.name}
                            </p>
                            <p class="small mb-0 ${sizeClass}">
                                <i class="fas fa-weight me-1"></i>
                                ${fileSizeMB} MB
                            </p>
                        </div>
                    </div>
                `;
                
                previewGrid.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
        
        // Update file input with current files
        updateFileInput();
    }
    
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }
    
    window.removePhoto = function(index) {
        selectedFiles.splice(index, 1);
        updatePreview();
    };
    
    window.clearAllPhotos = function() {
        if (confirm('Hapus semua foto yang dipilih?')) {
            selectedFiles = [];
            updatePreview();
        }
    };
    
    // Form submission handler
    form.addEventListener('submit', function(e) {
        if (judulInput.value.length > 255) {
            e.preventDefault();
            alert('Judul/keterangan kegiatan tidak boleh lebih dari 255 karakter. Silakan singkat judul Anda.');
            judulInput.focus();
            return false;
        }
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>

<style>
.foto-item {
    transition: all 0.3s ease;
    border-radius: 8px;
}

.foto-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.card {
    border-radius: 12px;
    overflow: hidden;
}

.card-header {
    border-radius: 12px 12px 0 0;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dee2e6;
}

.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
}

#charCount {
    font-weight: 500;
    font-size: 0.85rem;
}

.text-warning {
    color: #f59e0b !important;
}

.text-info {
    color: #3b82f6 !important;
}

/* Drop Zone Styles */
#dropZone {
    min-height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#dropZone:hover {
    border-color: #4f46e5 !important;
    background-color: #f8fafc !important;
}

/* Photo Preview Card Styles */
.photo-preview-card {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.photo-preview-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15) !important;
    border-color: #4f46e5;
}

.photo-preview-card img {
    transition: transform 0.3s ease;
}

.photo-preview-card:hover img {
    transform: scale(1.05);
}

.photo-preview-card .btn-danger {
    opacity: 0.9;
    transition: opacity 0.2s ease;
}

.photo-preview-card:hover .btn-danger {
    opacity: 1;
}

.border-2 {
    border-width: 2px !important;
}

.border-dashed {
    border-style: dashed !important;
}

/* Animation for preview cards */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.photo-preview-card {
    animation: fadeInUp 0.3s ease;
}
</style>
@endsection
