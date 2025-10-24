@extends('layouts.public')

@section('page-title', $post->judul)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
                <div class="text-muted mb-4">
                    {{ optional($post->kategori)->judul }} • {{ $post->created_at->format('d M Y') }} • Oleh {{ optional($post->petugas)->username }}
                </div>

                <article class="mb-5" style="line-height:1.8; font-size:1.05rem;">
                    {!! nl2br(e($post->isi)) !!}
                </article>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <strong>Berita Terbaru</strong>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($latest as $item)
                            <li class="list-group-item">
                                <a href="{{ route('berita.show', $item->id) }}" class="text-decoration-none">{{ $item->judul }}</a>
                                <div class="small text-muted">{{ $item->created_at->format('d M Y') }}</div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


