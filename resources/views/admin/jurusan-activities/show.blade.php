@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Kegiatan Jurusan</h1>
        <div>
            <a href="{{ route('admin.jurusan-activities.edit', $jurusanActivity) }}" class="btn btn-warning">
                <i class="fas fa-edit fa-sm"></i> Edit
            </a>
            <a href="{{ route('admin.jurusan-activities.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Kegiatan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Jurusan:</strong></td>
                                    <td>
                                        <span class="badge bg-primary">{{ $jurusanActivity->jurusan }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Judul:</strong></td>
                                    <td>{{ $jurusanActivity->title }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tipe Kegiatan:</strong></td>
                                    <td>
                                        <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $jurusanActivity->activity_type)) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal:</strong></td>
                                    <td>{{ $jurusanActivity->activity_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($jurusanActivity->is_active)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $jurusanActivity->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Diupdate:</strong></td>
                                    <td>{{ $jurusanActivity->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Deskripsi:</strong></h6>
                            <p class="text-muted">{{ $jurusanActivity->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Gambar Kegiatan</h6>
                </div>
                <div class="card-body text-center">
                    <img src="{{ Storage::url($jurusanActivity->image_path) }}" 
                         alt="{{ $jurusanActivity->title }}" 
                         class="img-fluid rounded">
                    
                    <div class="mt-3">
                        <form action="{{ route('admin.jurusan-activities.toggle-status', $jurusanActivity) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $jurusanActivity->is_active ? 'btn-warning' : 'btn-success' }}">
                                @if($jurusanActivity->is_active)
                                    <i class="fas fa-eye-slash"></i> Nonaktifkan
                                @else
                                    <i class="fas fa-eye"></i> Aktifkan
                                @endif
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.jurusan-activities.destroy', $jurusanActivity) }}" 
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
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
</div>
@endsection
