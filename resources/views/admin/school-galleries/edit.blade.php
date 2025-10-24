@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Foto Galeri Sekolah</h1>
        <a href="{{ route('admin.school-galleries.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Foto Galeri Sekolah</h6>
            <small class="text-muted">Foto ini akan muncul di halaman utama "Galeri Agenda Sekolah"</small>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.school-galleries.update', $schoolGallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $schoolGallery->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $key => $category)
                                    <option value="{{ $key }}" {{ old('category', $schoolGallery->category) == $key ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="event_date" class="form-label">Tanggal Event</label>
                            <input type="date" class="form-control @error('event_date') is-invalid @enderror" 
                                   id="event_date" name="event_date" value="{{ old('event_date', $schoolGallery->event_date ? $schoolGallery->event_date->format('Y-m-d') : '') }}">
                            <div class="form-text">Kosongkan jika tidak ada tanggal event tertentu</div>
                            @error('event_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Foto</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description', $schoolGallery->description) }}</textarea>
                            <div class="form-text">Opsional, untuk menjelaskan foto</div>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            <div>
                                <img src="{{ Storage::url($schoolGallery->image_path) }}" 
                                     alt="{{ $schoolGallery->title }}" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <div id="imagePreview" class="d-none">
                                <label class="form-label">Preview Foto Baru</label>
                                <img id="preview" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save fa-sm"></i> Update Foto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="alert alert-warning">
        <h6><i class="fas fa-exclamation-triangle"></i> Perhatian:</h6>
        <ul class="mb-0">
            <li>Foto yang diedit di sini akan tetap muncul di halaman utama "Galeri Agenda Sekolah"</li>
            <li>Untuk foto kegiatan jurusan (PPLG, TJKT, TPFL, TO), gunakan menu "Kelola Kegiatan Jurusan"</li>
            <li>Kedua sistem galeri ini terpisah dan tidak akan tercampur</li>
        </ul>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('d-none');
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').classList.add('d-none');
        }
    });
</script>
@endpush
