@extends('layouts.app')

@section('content')
<style>
.btn-group .btn {
    border-radius: 6px !important;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 2px solid !important;
    background: transparent !important;
    min-width: 80px;
}

.btn-group .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.btn-group .btn-primary {
    color: #0d6efd !important;
    border-color: #0d6efd !important;
}

.btn-group .btn-primary:hover {
    background: #0d6efd !important;
    color: white !important;
}

.btn-group .btn-danger {
    color: #dc3545 !important;
    border-color: #dc3545 !important;
}

.btn-group .btn-danger:hover {
    background: #dc3545 !important;
    color: white !important;
}

.btn-group-vertical {
    width: 100%;
}

.btn-group-vertical .btn {
    border-radius: 6px !important;
    font-weight: 500;
    transition: all 0.3s ease;
    border: 1px solid !important;
    margin-bottom: 2px;
    padding: 0.5rem 1rem !important;
    font-size: 0.875rem !important;
    min-height: 38px !important;
    width: 100% !important;
    display: block !important;
    text-align: center !important;
}

.btn-group-vertical .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.btn-group-vertical .btn-primary {
    background: #5b6fd8 !important;
    border-color: #5b6fd8 !important;
    color: white !important;
}

.btn-group-vertical .btn-success {
    background: #198754 !important;
    border-color: #198754 !important;
    color: white !important;
}

.btn-group-vertical .btn-warning {
    background: #ffc107 !important;
    border-color: #ffc107 !important;
    color: #000 !important;
}

.btn-group-vertical .btn-danger {
    background: #dc3545 !important;
    border-color: #dc3545 !important;
    color: white !important;
}

.btn-group-vertical .btn-secondary {
    background: #6c757d !important;
    border-color: #6c757d !important;
    color: white !important;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pesan Masuk</h1>
                <div class="d-flex gap-2">
                    <span class="badge bg-primary">{{ $messages->total() }} Total Pesan</span>
                    <span class="badge bg-warning">{{ $messages->where('status', 'unread')->count() }} Belum Dibaca</span>
                    <span class="badge bg-success">{{ $messages->where('testimonial_status', 'approved')->count() }} Testimoni Disetujui</span>
                    <span class="badge bg-secondary">{{ $messages->where('testimonial_status', 'pending')->count() }} Menunggu Persetujuan</span>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    @if($messages->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Status</th>
                                        <th>Testimoni</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Pesan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                    <tr class="{{ $message->status == 'unread' ? 'table-warning' : '' }}">
                                        <td>
                                            @if($message->status == 'unread')
                                                <span class="badge bg-warning">Belum Dibaca</span>
                                            @elseif($message->status == 'read')
                                                <span class="badge bg-info">Sudah Dibaca</span>
                                            @else
                                                <span class="badge bg-success">Sudah Dibalas</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $message->getTestimonialStatusBadgeClass() }}">
                                                {{ $message->getTestimonialStatusText() }}
                                            </span>
                                        </td>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;">
                                                {{ Str::limit($message->message, 50) }}
                                            </div>
                                        </td>
                                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group-vertical" role="group" style="min-width: 120px;">
                                                <!-- View Button -->
                                                <a href="{{ route('admin.messages.show', $message->id) }}" 
                                                   class="btn btn-sm btn-primary mb-1">
                                                    <i class="fas fa-eye me-1"></i>Lihat
                                                </a>
                                                
                                                <!-- Testimonial Actions -->
                                                @if($message->testimonial_status == 'pending')
                                                    <form action="{{ route('admin.messages.approve-testimonial', $message->id) }}" 
                                                          method="POST" class="d-inline mb-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success w-100">
                                                            <i class="fas fa-check me-1"></i>Setujui
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.messages.reject-testimonial', $message->id) }}" 
                                                          method="POST" class="d-inline mb-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-warning w-100">
                                                            <i class="fas fa-times me-1"></i>Tolak
                                                        </button>
                                                    </form>
                                                @elseif($message->testimonial_status == 'approved')
                                                    <form action="{{ route('admin.messages.reject-testimonial', $message->id) }}" 
                                                          method="POST" class="d-inline mb-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-warning w-100">
                                                            <i class="fas fa-times me-1"></i>Tolak
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.messages.reset-testimonial', $message->id) }}" 
                                                          method="POST" class="d-inline mb-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-secondary w-100">
                                                            <i class="fas fa-undo me-1"></i>Reset
                                                        </button>
                                                    </form>
                                                @elseif($message->testimonial_status == 'rejected')
                                                    <form action="{{ route('admin.messages.approve-testimonial', $message->id) }}" 
                                                          method="POST" class="d-inline mb-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success w-100">
                                                            <i class="fas fa-check me-1"></i>Setujui
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.messages.reset-testimonial', $message->id) }}" 
                                                          method="POST" class="d-inline mb-1">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-secondary w-100">
                                                            <i class="fas fa-undo me-1"></i>Reset
                                                        </button>
                                                    </form>
                                                @endif
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.messages.destroy', $message->id) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                                        <i class="fas fa-trash me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4">
                            {{ $messages->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada pesan masuk</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
