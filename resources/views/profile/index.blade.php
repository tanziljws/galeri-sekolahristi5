@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header -->
            <div class="mb-4">
                <h2 class="fw-bold text-primary">
                    <i class="fas fa-user-circle me-2"></i>Profil Saya
                </h2>
                <p class="text-muted">Kelola informasi profil dan keamanan akun Anda</p>
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
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                         alt="Profile Photo" 
                                         class="rounded-circle img-thumbnail"
                                         style="width: 200px; height: 200px; object-fit: cover;"
                                         id="profilePhotoPreview">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto"
                                         style="width: 200px; height: 200px; font-size: 4rem;"
                                         id="profilePhotoPreview">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Upload Form -->
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="name" value="{{ $user->name }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                
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

                            @if($user->profile_photo)
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
                                           value="{{ old('name', $user->name) }}" 
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
                                           value="{{ old('email', $user->email) }}" 
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

            <!-- Back Button -->
            <div class="mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function previewPhoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const preview = document.getElementById('profilePhotoPreview');
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    preview.innerHTML = `<img src="${e.target.result}" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;">`;
                }
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
