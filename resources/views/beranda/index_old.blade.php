@extends('layouts.app2')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    :root {
        --mk-blue: #00569c; /* Biru Khas Medis */
        --mk-light-blue: #e6f0f9;
        --mk-orange: #f39200;
        --text-dark: #333333;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background-color: #ffffff;
        color: var(--text-dark);
    }

    /* Hero Banner - Elegant & Direct */
    .hero-section {
        background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), 
                    url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=2053&ixlib=rb-4.0.3') center/cover;
        padding: 100px 0;
        border-bottom: 5px solid var(--mk-blue);
    }

    .hero-title {
        font-weight: 700;
        color: var(--mk-blue);
        font-size: 2.8rem;
        margin-bottom: 20px;
    }

    /* Floating Quick Access - Tombol Cepat di Bawah Hero */
    .quick-access {
        margin-top: -50px;
        position: relative;
        z-index: 10;
    }

    .access-card {
        background: white;
        border: none;
        border-top: 4px solid var(--mk-orange);
        border-radius: 8px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: 0.3s;
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .access-card:hover {
        transform: translateY(-5px);
        background: var(--mk-light-blue);
    }

    .access-card i {
        font-size: 2.5rem;
        color: var(--mk-blue);
        margin-bottom: 15px;
    }

    .access-card h5 {
        color: var(--mk-blue);
        font-weight: 600;
        font-size: 1.1rem;
    }

    /* Section Styling */
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 40px;
        font-weight: 700;
        color: var(--mk-blue);
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: var(--mk-orange);
    }

    /* Buttons */
    .btn-mk {
        background-color: var(--mk-blue);
        color: white;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: 0.3s;
        border: none;
    }

    .btn-mk:hover {
        background-color: #003d6e;
        color: white;
        box-shadow: 0 5px 15px rgba(0,86,156,0.3);
    }

    .info-box {
        background: var(--mk-light-blue);
        border-radius: 15px;
        padding: 30px;
    }
</style>

<div class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="hero-title">Kesehatan Anda Adalah Prioritas Kami.</h1>
                <p class="lead mb-4">Kami menghadirkan layanan medis kelas dunia dengan sentuhan personal yang hangat untuk Anda dan keluarga.</p>
                <a href="{{ route('pasien.create') }}" class="btn-mk">
                    <i class="bi bi-calendar-check me-2"></i> Buat Janji Temu
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container quick-access">
    <div class="row g-4 justify-content-center">
        <div class="col-6 col-md-3">
            <a href="{{ route('pasien.create') }}" class="access-card">
                <i class="bi bi-person-plus"></i>
                <h5>Daftar Pasien</h5>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('daftardokter') }}" class="access-card">
                <i class="bi bi-search"></i>
                <h5>Cari Dokter</h5>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="{{ route('artikel.index') }}" class="access-card">
                <i class="bi bi-hospital"></i>
                <h5>Lokasi RS</h5>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="#" class="access-card">
                <i class="bi bi-droplet"></i>
                <h5>Medical Check-up</h5>
            </a>
        </div>
    </div>
</div>

<div class="container py-5 mt-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <h3 class="section-title">Mengapa Memilih Kami?</h3>
            <p>Sistem digital kami dirancang untuk mempermudah perjalanan medis Anda. Mulai dari pendaftaran online hingga akses riwayat medis, semuanya kini ada di ujung jari Anda.</p>
            <div class="row mt-4">
                <div class="col-6">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-clock-history text-primary me-2 fs-4"></i>
                        <span>Tanpa Antre</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-shield-check text-primary me-2 fs-4"></i>
                        <span>Data Aman</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="info-box shadow-sm">
                <h5 class="fw-bold mb-3"><i class="bi bi-info-circle me-2"></i> Bantuan Cepat</h5>
                <p class="small text-muted">Punya pertanyaan seputar layanan kami? Tim kami siap membantu Anda 24/7.</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-primary">Call Center: 1500-XXX</span>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="section-title d-inline-block">Layanan Unggulan Kami</h3>
            <p class="text-muted">Kami menyediakan berbagai spesialisasi medis dengan dukungan teknologi terkini.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-heart-pulse-fill fs-1 text-danger"></i>
                    </div>
                    <h5 class="fw-bold">Pusat Jantung</h5>
                    <p class="small text-muted">Layanan kardiologi komprehensif mulai dari pencegahan hingga rehabilitasi pasca operasi.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-person-hearts fs-1 text-warning"></i>
                    </div>
                    <h5 class="fw-bold">Kesehatan Anak</h5>
                    <p class="small text-muted">Perawatan kesehatan anak dengan lingkungan yang ramah dan dokter spesialis yang berpengalaman.</p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-scan fs-1 text-primary"></i>
                    </div>
                    <h5 class="fw-bold">Radiologi Modern</h5>
                    <p class="small text-muted">Diagnostik akurat dengan teknologi MRI, CT-Scan, dan X-Ray generasi terbaru.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 text-white">
    <div class="row g-4 bg-primary rounded-4 p-5 text-center shadow-lg">
        <div class="col-6 col-md-3">
            <h2 class="fw-bold">50+</h2>
            <p class="mb-0">Dokter Spesialis</p>
        </div>
        <div class="col-6 col-md-3">
            <h2 class="fw-bold">100k+</h2>
            <p class="mb-0">Pasien Terlayani</p>
        </div>
        <div class="col-6 col-md-3">
            <h2 class="fw-bold">24/7</h2>
            <p class="mb-0">Layanan IGD</p>
        </div>
        <div class="col-6 col-md-3">
            <h2 class="fw-bold">15+</h2>
            <p class="mb-0">Penghargaan Medis</p>
        </div>
    </div>
</div>

<!-- Artikel Kesehatan Section -->
@if(isset($artikel) && $artikel->count() > 0)
<div class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="section-title d-inline-block">Artikel & Tips Kesehatan</h3>
            <p class="text-muted">Informasi kesehatan terkini untuk Anda dan keluarga</p>
        </div>
        
        <div class="row g-4">
            @foreach($artikel as $item)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($item->gambar)
                    <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="bg-primary" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-file-text text-white" style="font-size: 4rem;"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        @if($item->kategori)
                        <span class="badge bg-primary mb-2">{{ $item->kategori }}</span>
                        @endif
                        <h5 class="card-title fw-bold">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}</h5>
                        <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-eye me-1"></i> {{ $item->views ?? 0 }} views
                            </small>
                           <a href="" 
                           class="text-blue-600 font-bold text-sm hover:underline">
                            Baca Selengkapnya →
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('artikel.publik') }}" class="btn btn-primary rounded-pill px-4">Lihat Semua Artikel</a>
        </div>
    </div>
</div>
@endif

<div class="container py-5 text-center">
    <div class="py-5 border-top">
        <h2 class="fw-bold mb-3">Siap Untuk Konsultasi?</h2>
        <p class="mb-4">Daftarkan diri Anda secara online untuk mendapatkan nomor antrean tanpa harus menunggu lama.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('pasien.create') }}" class="btn-mk">Daftar Sekarang</a>
            <a href="#" class="btn btn-outline-secondary rounded-pill px-4">Lihat Jadwal Dokter</a>
        </div>
    </div>
</div>

@endsection