@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Foto Galeri Sekolah</h1>
        <div>
            <a href="{{ route('admin.school-galleries.edit', $schoolGallery) }}" class="btn btn-warning">
                <i class="fas fa-edit fa-sm"></i> Edit
            </a>
            <a href="{{ route('admin.school-galleries.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Foto</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Judul:</strong></td>
                                    <td>{{ $schoolGallery->title }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kategori:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $schoolGallery->category)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Event:</strong></td>
                                    <td>{{ $schoolGallery->event_date ? $schoolGallery->event_date->format('d/m/Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($schoolGallery->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $schoolGallery->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Diupdate:</strong></td>
                                    <td>{{ $schoolGallery->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Deskripsi:</strong></h6>
                            <p class="text-muted">{{ $schoolGallery->description ?: 'Tidak ada deskripsi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($schoolGallery->image_path) }}" 
                         alt="{{ $schoolGallery->title }}" 
                         class="img-fluid rounded">
                    
                    <div class="mt-3">
                        <form action="{{ route('admin.school-galleries.toggle-status', $schoolGallery) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $schoolGallery->is_active ? 'btn-warning' : 'btn-success' }}">
                                @if($schoolGallery->is_active)
                                    <i class="fas fa-eye-slash"></i> Nonaktifkan
                                @else
                                    <i class="fas fa-eye"></i> Aktifkan
                                @endif
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.school-galleries.destroy', $schoolGallery) }}" 
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="alert alert-info">
        <h6><i class="fas fa-info-circle"></i> Informasi:</h6>
        <ul class="mb-0">
            <li>Foto ini akan muncul di halaman utama "Galeri Agenda Sekolah"</li>
            <li>Untuk foto kegiatan jurusan (PPLG, TJKT, TPFL, TO), gunakan menu "Kelola Kegiatan Jurusan"</li>
            <li>Kedua sistem galeri ini terpisah dan tidak akan tercampur</li>
        </ul>
    </div>
</div>
@endsection
