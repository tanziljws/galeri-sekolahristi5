@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Detail Pesan</h1>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-envelope me-2"></i>Pesan dari {{ $message->name }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Nama:</strong> {{ $message->name }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Email:</strong> {{ $message->email }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Status:</strong> 
                                    @if($message->status == 'unread')
                                        <span class="badge bg-warning">Belum Dibaca</span>
                                    @elseif($message->status == 'read')
                                        <span class="badge bg-info">Sudah Dibaca</span>
                                    @else
                                        <span class="badge bg-success">Sudah Dibalas</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <strong>Tanggal:</strong> {{ $message->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <strong>Pesan:</strong>
                                <div class="mt-2 p-3 bg-light rounded">
                                    {{ $message->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-trash me-2"></i>Hapus Pesan
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Hapus pesan ini secara permanen dari sistem.</p>
                            <form action="{{ route('admin.messages.destroy', $message->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus pesan ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100">
                                    <i class="fas fa-trash me-2"></i>Hapus Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
