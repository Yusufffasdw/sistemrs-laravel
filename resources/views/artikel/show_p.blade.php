@extends('layouts.navter')

@section('content')
<div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('artikel.index') }}" class="text-decoration-none">Artikel</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
            <h2 class="fw-bold m-0">📄 Detail Artikel</h2>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('artikel.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden">
                @if($artikel->gambar)
                    <img src="{{ asset($artikel->gambar) }}" class="card-img-top" style="height: 350px; object-fit: cover;" alt="Cover">
                @endif
                <div class="card-body p-4">
                    <div class="mb-3">
                        @if($artikel->status == 'published')
                            <span class="badge bg-success-soft text-success px-3 py-2">● Published</span>
                        @else
                            <span class="badge bg-warning-soft text-warning px-3 py-2">● Draft</span>
                        @endif
                        <span class="ms-2 text-muted small"><i class="far fa-calendar-alt me-1"></i> {{ $artikel->tanggal_formatted }}</span>
                    </div>

                    <h3 class="fw-bold mb-4">{{ $artikel->judul }}</h3>
                    
                    <div class="article-content text-dark lh-base" style="white-space: pre-wrap; font-size: 1.05rem;">
                        {{ $artikel->konten }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="fw-bold m-0">Informasi Publikasi</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Penulis</span>
                            <span class="fw-semibold text-end">{{ $artikel->penulis ?? 'Admin' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Kategori</span>
                            <span class="badge bg-info-soft text-info">{{ $artikel->kategori ?? 'Umum' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Total Views</span>
                            <span class="fw-bold text-primary"><i class="fas fa-eye me-1"></i> {{ $artikel->views }}</span>
                        </li>
                        <li class="list-group-item py-3">
                            <span class="text-muted small d-block mb-1">Permalink / Slug</span>
                            <code class="small text-break">{{ $artikel->slug }}</code>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted small">Update Terakhir</span>
                            <span class="small text-end text-muted">{{ $artikel->updated_at->format('d M Y, H:i') }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Menambahkan nuansa modern pada badge */
    .bg-success-soft { background-color: #e8f5e9; }
    .bg-warning-soft { background-color: #fff3e0; }
    .bg-info-soft { background-color: #e3f2fd; }
    .card { border-radius: 12px; }
    .list-group-item { border-color: #f8f9fa; }
</style>
@endsection