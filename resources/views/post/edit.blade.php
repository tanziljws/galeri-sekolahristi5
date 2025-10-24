@extends('layouts.app')

@section('page-title', 'Edit Post')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Post: {{ $post->judul }}
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

                    <form action="{{ route('post.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Post</label>
                                    <input type="text" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" 
                                           name="judul" 
                                           value="{{ old('judul', $post->judul) }}" 
                                           placeholder="Masukkan judul post" 
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="isi" class="form-label">Isi Post</label>
                                    <textarea class="form-control @error('isi') is-invalid @enderror" 
                                              id="isi" 
                                              name="isi" 
                                              rows="12" 
                                              placeholder="Tulis isi post Anda di sini..." 
                                              required>{{ old('isi', $post->isi) }}</textarea>
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
                                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $post->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                                            <option value="{{ $p->id }}" {{ old('petugas_id', $post->petugas_id) == $p->id ? 'selected' : '' }}>
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
                                        <option value="Published" {{ old('status', $post->status) == 'Published' ? 'selected' : '' }}>Published</option>
                                        <option value="Draft" {{ old('status', $post->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-info-circle me-2"></i>
                                            Informasi Post
                                        </h6>
                                        <ul class="list-unstyled small mb-0">
                                            <li class="mb-1">
                                                <strong>Dibuat:</strong> {{ $post->created_at->format('d M Y H:i') }}
                                            </li>
                                            <li class="mb-1">
                                                <strong>Terakhir Update:</strong> {{ $post->updated_at->format('d M Y H:i') }}
                                            </li>
                                            <li class="mb-1">
                                                <strong>Kategori:</strong> {{ $post->kategori->judul }}
                                            </li>
                                            <li>
                                                <strong>Penulis:</strong> {{ $post->petugas->username }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save me-2"></i>
                                Update Post
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
