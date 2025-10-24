@extends('layouts.app')

@section('title', 'Manajemen Admin | Web Galeri Sekolah')

@section('page-title', 'Manajemen Admin')

@section('content')
<div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Page Header -->
    <div class="card mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-2">Manajemen Admin</h1>
                    <p class="text-muted mb-0">Kelola data administrator sistem</p>
                </div>
                <a href="{{ route('admin.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>
                    Tambah Admin
                </a>
            </div>
        </div>
            </div>

            <!-- Table Container -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-users me-2"></i>
                Daftar Administrator
            </h6>
        </div>
        <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash me-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<style>
/* Custom styling untuk halaman admin dengan kontras yang jelas */
.card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid #e2e8f0;
}

/* Enhanced text contrast for page title */
.h2 {
    color: #0f172a !important;
    font-weight: 900 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.text-muted {
    color: #475569 !important;
    font-weight: 600 !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

/* Card header text styling */
.card-header h6 {
    color: #0f172a !important;
    font-weight: 800 !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.table thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border: none;
    padding: 1rem;
    font-weight: 800;
    color: #0f172a !important;
    text-transform: uppercase;
    font-size: 0.875rem;
    letter-spacing: 0.05em;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.table tbody td {
    padding: 1rem;
    border: none;
    border-bottom: 1px solid #e2e8f0;
    vertical-align: middle;
    color: #1f2937 !important;
    font-weight: 600;
}

.table tbody tr:hover {
    background: #f8fafc;
}

.table tbody tr:hover td {
    color: #0f172a !important;
}

.table tbody tr:last-child td {
    border-bottom: none;
}

.btn-group .btn {
    margin-right: 0.25rem;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

/* Button text contrast */
.btn-primary {
    color: white !important;
    font-weight: 600;
}

.btn-warning {
    color: white !important;
    font-weight: 600;
}

.btn-danger {
    color: white !important;
    font-weight: 600;
}
</style>
@endsection
