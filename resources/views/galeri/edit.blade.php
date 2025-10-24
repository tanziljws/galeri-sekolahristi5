@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-dark">
                <i class="fas fa-edit me-2 text-warning"></i>
                Edit Album: {{ $galery->judul ?? ($galery->post ? $galery->post->judul : 'Gallery') }}
            </h1>
            <p class="text-muted mb-0">Update album foto kegiatan SMK Negeri 4 Kota Bogor</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('galeri.show', $galery->id) }}" class="btn btn-outline-info">
                <i class="fas fa-eye me-2"></i>
                Lihat Album
            </a>
            <a href="{{ route('galeri.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke Galeri
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Form Edit Album
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('galeri.update', $galery->id) }}" method="POST" enctype="multipart/form-data" id="galeriForm">
                        @csrf
                        @method('PUT')
                        
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
                                           name="post_title"
                                           class="form-control @error('post_title') is-invalid @enderror"
                                           value="{{ old('post_title', $galery->judul ?? ($galery->post ? $galery->post->judul : '')) }}"
                                           placeholder="Contoh: Lab PPLG, Kegiatan PMR, Upacara Bendera"
                                           maxlength="255" required>
                                    @error('post_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                           value="{{ old('position', $galery->position) }}" 
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
                                        <option value="1" {{ old('status', $galery->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('status', $galery->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
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
                                        <option value="umum" {{ old('category', $galery->category) == 'umum' ? 'selected' : '' }}>Umum (Galeri Sekolah)</option>
                                        <option value="prestasi" {{ old('category', $galery->category) == 'prestasi' ? 'selected' : '' }}>Prestasi (Galeri Prestasi)</option>
                                        <option value="ekstrakurikuler" {{ old('category', $galery->category) == 'ekstrakurikuler' ? 'selected' : '' }}>Ekstrakurikuler</option>
                                        <option value="upacara" {{ old('category', $galery->category) == 'upacara' ? 'selected' : '' }}>Upacara</option>
                                        <option value="maulid-nabi" {{ old('category', $galery->category) == 'maulid-nabi' ? 'selected' : '' }}>Maulid Nabi</option>
                                        <option value="p5" {{ old('category', $galery->category) == 'p5' ? 'selected' : '' }}>P5 (Projek Penguatan Profil Pelajar Pancasila)</option>
                                        <option value="adiwiyata" {{ old('category', $galery->category) == 'adiwiyata' ? 'selected' : '' }}>Adiwiyata</option>
                                        <option value="neospragma" {{ old('category', $galery->category) == 'neospragma' ? 'selected' : '' }}>Neospragma</option>
                                        <option value="pmr" {{ old('category', $galery->category) == 'pmr' ? 'selected' : '' }}>PMR (Palang Merah Remaja)</option>
                                        <option value="pramuka" {{ old('category', $galery->category) == 'pramuka' ? 'selected' : '' }}>Pramuka</option>
                                        <option value="osis" {{ old('category', $galery->category) == 'osis' ? 'selected' : '' }}>OSIS</option>
                                        <option value="pplg" {{ old('category', $galery->category) == 'pplg' ? 'selected' : '' }}>PPLG (Pengembangan Perangkat Lunak & Gim)</option>
                                        <option value="tjkt" {{ old('category', $galery->category) == 'tjkt' ? 'selected' : '' }}>TJKT (Teknik Jaringan Komputer & Telekomunikasi)</option>
                                        <option value="tpfl" {{ old('category', $galery->category) == 'tpfl' ? 'selected' : '' }}>TPFL (Teknik Pengelasan & Fabrikasi Logam)</option>
                                        <option value="to" {{ old('category', $galery->category) == 'to' ? 'selected' : '' }}>TO (Teknik Otomotif)</option>
                                        <option value="transforkrab" {{ old('category', $galery->category) == 'transforkrab' ? 'selected' : '' }}>Transforkrab</option>
                                        <option value="lainnya" {{ old('category', $galery->category) == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                Foto Kegiatan
                            </label>
                            <div id="fotoContainer">
                                @foreach($galery->fotos as $index => $foto)
                                <div class="foto-item border rounded p-4 mb-3 bg-light">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Upload Foto Baru (Opsional)</label>
                                                <input type="file" 
                                                       class="form-control" 
                                                       name="fotos[{{ $index }}][file]" 
                                                       accept="image/*">
                                                <div class="form-text">
                                                    <i class="fas fa-info-circle me-1"></i>
                                                    Format: JPG, PNG, GIF (Max: 10MB)
                                                </div>
                                                <input type="hidden" name="fotos[{{ $index }}][existing_file]" value="{{ $foto->file }}">
                                                <input type="hidden" name="fotos[{{ $index }}][id]" value="{{ $foto->id }}">
                                                <input type="hidden" name="fotos[{{ $index }}][keep]" value="1">
                                            </div>
                                            
                                            @if($foto->file)
                                            <div class="mb-3">
                                                <label class="form-label">Foto Saat Ini:</label>
                                                <div class="border rounded p-3 bg-white">
                                                    <img src="{{ asset('storage/galeri/' . $foto->file) }}" 
                                                         alt="Foto {{ $index + 1 }}" 
                                                         class="img-thumbnail" 
                                                         style="max-width: 150px; max-height: 100px;">
                                                    <div class="small text-muted mt-2">
                                                        <i class="fas fa-file-image me-1"></i>
                                                        {{ $foto->file }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Keterangan Foto Individual (Opsional)</label>
                                                <small class="text-muted d-block mb-2">
                                                    Deskripsi khusus untuk foto ini saja
                                                </small>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="fotos[{{ $index }}][judul]" 
                                                       value="{{ $foto->judul }}"
                                                       placeholder="Contoh: Siswa sedang praktikum, Ruang server, Peralatan lab">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" 
                                                class="btn btn-sm btn-danger"
                                                onclick="if(confirm('Yakin ingin menghapus foto ini secara permanen? Tindakan ini tidak dapat dibatalkan.')) { 
                                                    const form = document.createElement('form');
                                                    form.method = 'POST';
                                                    form.action = '{{ route('galeri.foto.destroy', ['galery' => $galery->id, 'foto' => $foto->id]) }}';
                                                    const csrf = document.createElement('input');
                                                    csrf.type = 'hidden';
                                                    csrf.name = '_token';
                                                    csrf.value = '{{ csrf_token() }}';
                                                    const method = document.createElement('input');
                                                    method.type = 'hidden';
                                                    method.name = '_method';
                                                    method.value = 'DELETE';
                                                    form.appendChild(csrf);
                                                    form.appendChild(method);
                                                    document.body.appendChild(form);
                                                    form.submit();
                                                }">
                                            <i class="fas fa-trash me-1"></i>
                                            Hapus Foto Ini
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <button type="button" class="btn btn-outline-primary" id="addFoto">
                                <i class="fas fa-plus me-2"></i>
                                Tambah Foto Baru
                            </button>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="submit" class="btn btn-warning btn-lg" id="submitBtn">
                                <i class="fas fa-save me-2"></i>
                                Update Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Album
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-primary">
                            <i class="fas fa-calendar me-2"></i>
                            Dibuat Pada
                        </h6>
                        <p class="small text-muted mb-0">
                            @php
                                try {
                                    echo $galery->created_at ? $galery->created_at->format('d M Y H:i') : 'N/A';
                                } catch (\Exception $e) {
                                    echo 'N/A';
                                }
                            @endphp
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">
                            <i class="fas fa-clock me-2"></i>
                            Terakhir Update
                        </h6>
                        <p class="small text-muted mb-0">
                            @php
                                try {
                                    echo $galery->updated_at ? $galery->updated_at->format('d M Y H:i') : 'N/A';
                                } catch (\Exception $e) {
                                    echo 'N/A';
                                }
                            @endphp
                        </p>
                    </div>
                    
                    @if($galery->post)
                    <div class="mb-3">
                        <h6 class="text-primary">
                            <i class="fas fa-user me-2"></i>
                            Dibuat Oleh
                        </h6>
                        <p class="small text-muted mb-0">
                            {{ $galery->post->petugas ? $galery->post->petugas->username : 'N/A' }}
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">
                            <i class="fas fa-tag me-2"></i>
                            Kategori
                        </h6>
                        <span class="badge bg-info">
                            {{ $galery->post->kategori ? $galery->post->kategori->judul : 'N/A' }}
                        </span>
                    </div>
                    @else
                    <div class="mb-3">
                        <p class="small text-muted mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Album ini tidak terkait dengan post
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        Tips Edit Album
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-success">
                            <i class="fas fa-check-circle me-2"></i>
                            Foto Baru
                        </h6>
                        <p class="small text-muted mb-0">
                            Upload foto baru untuk mengganti foto yang ada, atau biarkan kosong untuk mempertahankan foto lama.
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-success">
                            <i class="fas fa-check-circle me-2"></i>
                            Keterangan
                        </h6>
                        <p class="small text-muted mb-0">
                            Update keterangan foto untuk memberikan informasi yang lebih akurat tentang kegiatan.
                        </p>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-success">
                            <i class="fas fa-check-circle me-2"></i>
                            Urutan
                        </h6>
                        <p class="small text-muted mb-0">
                            Atur ulang posisi album jika ingin mengubah urutan tampilan di halaman galeri.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm mt-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Perhatian
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="small text-muted mb-0">
                        <li>Foto yang dihapus tidak bisa dikembalikan</li>
                        <li>Upload foto baru akan mengganti foto lama</li>
                        <li>Pastikan foto baru berkualitas baik</li>
                        <li>Backup foto penting sebelum dihapus</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let fotoIndex = {{ $galery->fotos->count() }};

document.getElementById('addFoto').addEventListener('click', function() {
    const container = document.getElementById('fotoContainer');
    const newFoto = document.createElement('div');
    newFoto.className = 'foto-item border rounded p-4 mb-3 bg-light';
    newFoto.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Upload Foto</label>
                    <input type="file" 
                           class="form-control" 
                           name="fotos[${fotoIndex}][file]" 
                           accept="image/*"
                           required>
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Format: JPG, PNG, GIF (Max: 10MB)
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Keterangan Foto (Opsional)</label>
                    <input type="text" 
                           class="form-control" 
                           name="fotos[${fotoIndex}][judul]" 
                           placeholder="Contoh: Siswa sedang praktikum di bengkel">
                </div>
            </div>
        </div>
        <div class="text-end">
            <button type="button" class="btn btn-sm btn-danger remove-foto">
                <i class="fas fa-trash me-1"></i>
                Hapus Foto
            </button>
        </div>
    `;
    container.appendChild(newFoto);
    fotoIndex++;
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-foto')) {
        const fotoItems = document.querySelectorAll('.foto-item');
        if (fotoItems.length > 1) {
            e.target.closest('.foto-item').remove();
        } else {
            alert('Minimal harus ada 1 foto dalam album!');
        }
    }
});

// Form submit handler - with detailed debugging
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('galeriForm');
    const submitBtn = document.getElementById('submitBtn');
    
    console.log('DOM loaded');
    console.log('Form action:', editForm ? editForm.action : 'No form');
    console.log('Form method:', editForm ? editForm.method : 'No form');
    
    if (editForm && submitBtn) {
        editForm.addEventListener('submit', function(e) {
            console.log('=== FORM SUBMITTING ===');
            console.log('Form action:', this.action);
            console.log('Form method:', this.method);
            
            // Debug: Log all form data
            const formData = new FormData(this);
            console.log('=== FORM DATA ===');
            for (let [key, value] of formData.entries()) {
                if (key.includes('fotos')) {
                    console.log(key, '=', value);
                }
            }
            
            // Count fotos
            let fotoCount = 0;
            let fotoIds = [];
            for (let [key, value] of formData.entries()) {
                if (key.match(/fotos\[\d+\]\[id\]/)) {
                    fotoCount++;
                    fotoIds.push(value);
                }
            }
            console.log('Total fotos with ID:', fotoCount);
            console.log('Foto IDs:', fotoIds);
            console.log('===================');
            
            // Alert user about foto count
            if (fotoCount === 0) {
                alert('PERINGATAN: Tidak ada foto yang akan dikirim! Semua foto akan terhapus!');
                e.preventDefault();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Update Album';
                return false;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
            
            // Let form submit normally - don't prevent default
        });
    }
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

.badge {
    font-size: 0.75rem;
    padding: 0.5em 0.75em;
    border-radius: 20px;
}
</style>
@endsection
