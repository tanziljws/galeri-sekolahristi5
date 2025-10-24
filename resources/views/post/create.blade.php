@extends('layouts.app')

@section('page-title', 'Tambah Berita Baru')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-plus me-2"></i>
                        Tambah Berita Baru
                    </h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Berita</label>
                                    <input type="text" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" 
                                           name="judul" 
                                           value="{{ old('judul') }}" 
                                           placeholder="Masukkan judul berita" 
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="isi" class="form-label">Isi Berita</label>
                                    <textarea class="form-control @error('isi') is-invalid @enderror" 
                                              id="isi" 
                                              name="isi" 
                                              rows="12" 
                                              placeholder="Tulis isi berita Anda di sini..." 
                                              required>{{ old('isi') }}</textarea>
                                    @error('isi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Gunakan format HTML untuk styling teks (bold, italic, dll.)
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="kategori_id" class="form-label">Kategori</label>
                                    <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                            id="kategori_id" 
                                            name="kategori_id" 
                                            required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategoris as $kategori)
                                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                {{ $kategori->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="petugas_id" class="form-label">Penulis</label>
                                    <select class="form-select @error('petugas_id') is-invalid @enderror" 
                                            id="petugas_id" 
                                            name="petugas_id" 
                                            required>
                                        <option value="">Pilih Penulis</option>
                                        @foreach($petugas as $p)
                                            <option value="{{ $p->id }}" {{ old('petugas_id') == $p->id ? 'selected' : '' }}>
                                                {{ $p->username }} ({{ $p->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('petugas_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="">Pilih Status</option>
                                        <option value="Published" {{ old('status') == 'Published' ? 'selected' : '' }}>Published</option>
                                        <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_jadwal" class="form-label">Tanggal Jadwal (Opsional)</label>
                                    <input type="date" 
                                           class="form-control @error('tanggal_jadwal') is-invalid @enderror" 
                                           id="tanggal_jadwal" 
                                           name="tanggal_jadwal" 
                                           value="{{ old('tanggal_jadwal') }}">
                                    <div class="form-text">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Isi jika ini adalah berita tentang kegiatan yang akan datang
                                    </div>
                                    @error('tanggal_jadwal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-lightbulb me-2"></i>
                                            Tips Menulis Berita
                                        </h6>
                                        <ul class="list-unstyled small mb-0">
                                            <li class="mb-1">
                                                <i class="fas fa-check text-success me-1"></i>
                                                Gunakan judul yang menarik
                                            </li>
                                            <li class="mb-1">
                                                <i class="fas fa-check text-success me-1"></i>
                                                Tulis konten yang informatif
                                            </li>
                                            <li class="mb-1">
                                                <i class="fas fa-check text-success me-1"></i>
                                                Pilih kategori yang sesuai
                                            </li>
                                            <li>
                                                <i class="fas fa-check text-success me-1"></i>
                                                Review sebelum publish
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                Simpan Berita
                            </button>
                            <a href="{{ route('post.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus, .form-select:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
}

textarea {
    resize: vertical;
    min-height: 300px;
}

.card.bg-light {
    border: 1px solid #e9ecef;
}
</style>
@endsection
