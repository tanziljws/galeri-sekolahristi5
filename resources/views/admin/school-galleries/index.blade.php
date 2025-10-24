@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Navigation Guide -->
    <div class="alert alert-warning mb-4">
        <h6><i class="fas fa-exclamation-triangle"></i> <strong>Admin Panel: Kelola Galeri Sekolah</strong></h6>
        <p class="mb-2">Anda sedang berada di panel untuk mengelola foto galeri sekolah umum.</p>
        <p class="mb-0">
            <strong>Hasil:</strong> Foto yang ditambahkan di sini akan muncul di halaman utama "Galeri Agenda Sekolah".<br>
            <strong>Untuk kegiatan jurusan (PPLG, TJKT, TPFL, TO):</strong> <a href="{{ route('admin.jurusan-activities.index') }}" class="alert-link">Klik di sini</a>
        </p>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Galeri Sekolah</h1>
        <a href="{{ route('admin.school-galleries.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm"></i> Tambah Foto Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Foto Galeri Sekolah</h6>
            <small class="text-muted">Foto ini akan muncul di halaman utama "Galeri Agenda Sekolah"</small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal Event</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $index => $gallery)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ Storage::url($gallery->image_path) }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="img-thumbnail" 
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>{{ $gallery->title }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $gallery->category)) }}</span>
                            </td>
                            <td>{{ $gallery->event_date ? $gallery->event_date->format('d/m/Y') : '-' }}</td>
                            <td>
                                @if($gallery->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.school-galleries.show', $gallery) }}" 
                                       class="btn btn-sm btn-info" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.school-galleries.edit', $gallery) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.school-galleries.toggle-status', $gallery) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-secondary" title="Toggle Status">
                                            <i class="fas fa-toggle-on"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.school-galleries.destroy', $gallery) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada foto galeri sekolah yang ditambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($galleries->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="alert alert-info">
        <h6><i class="fas fa-info-circle"></i> Informasi Penting:</h6>
        <ul class="mb-0">
            <li><strong>Galeri Sekolah:</strong> Foto yang ditambahkan di sini akan muncul di halaman utama "Galeri Agenda Sekolah"</li>
            <li><strong>Kegiatan Jurusan:</strong> Untuk foto kegiatan PPLG, TJKT, TPFL, atau TO, gunakan menu "Kelola Kegiatan Jurusan"</li>
            <li><strong>Pemisahan:</strong> Kedua sistem galeri ini terpisah dan tidak akan tercampur</li>
        </ul>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
