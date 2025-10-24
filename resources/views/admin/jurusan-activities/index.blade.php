@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Navigation Guide -->
    <div class="alert alert-primary mb-4">
        <h6><i class="fas fa-info-circle"></i> <strong>Admin Panel: Kelola Kegiatan Jurusan</strong></h6>
        <p class="mb-2">Anda sedang berada di panel untuk mengelola foto kegiatan jurusan (PPLG, TJKT, TPFL, TO).</p>
        <p class="mb-0">
            <strong>Hasil:</strong> Foto yang ditambahkan di sini akan muncul di halaman jurusan masing-masing.<br>
            <strong>Untuk galeri sekolah umum:</strong> <a href="{{ route('admin.school-galleries.index') }}" class="alert-link">Klik di sini</a>
        </p>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Kegiatan Jurusan</h1>
        <a href="{{ route('admin.jurusan-activities.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm"></i> Tambah Kegiatan Baru
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kegiatan Jurusan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Jurusan</th>
                            <th>Judul</th>
                            <th>Tipe Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $index => $activity)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ Storage::url($activity->image_path) }}" 
                                     alt="{{ $activity->title }}" 
                                     class="img-thumbnail" 
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $activity->jurusan }}</span>
                            </td>
                            <td>{{ $activity->title }}</td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($activity->activity_type) }}</span>
                            </td>
                            <td>{{ $activity->activity_date->format('d/m/Y') }}</td>
                            <td>
                                @if($activity->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.jurusan-activities.show', $activity) }}" 
                                       class="btn btn-sm btn-info" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.jurusan-activities.edit', $activity) }}" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.jurusan-activities.toggle-status', $activity) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-secondary" title="Toggle Status">
                                            <i class="fas fa-toggle-on"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.jurusan-activities.destroy', $activity) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
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
                            <td colspan="8" class="text-center">Belum ada kegiatan jurusan yang ditambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($activities->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $activities->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="alert alert-info">
        <h6><i class="fas fa-info-circle"></i> Informasi Penting:</h6>
        <ul class="mb-0">
            <li><strong>Kegiatan Jurusan:</strong> Foto yang ditambahkan di sini akan muncul di halaman jurusan masing-masing (PPLG, TJKT, TPFL, TO)</li>
            <li><strong>Galeri Sekolah:</strong> Untuk foto kegiatan umum sekolah, gunakan menu "Kelola Galeri Sekolah"</li>
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
