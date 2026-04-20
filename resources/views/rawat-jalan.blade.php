@extends('layouts.navter')

@section('title', 'Instalasi Rawat Jalan')

@section('content')
    <style>
        .header-jalan {
            background: linear-gradient(rgba(13, 110, 253, 0.7), rgba(13, 110, 253, 0.7)), url('/img/rawat-jalan-bg.jpg') center/cover;
            padding: 100px 0;
            color: white;
        }

        .poli-card {
            border: none;
            border-radius: 15px;
            background: #ffffff;
            transition: all 0.3s ease;
            border-bottom: 4px solid #0d6efd;
        }

        .poli-card:hover {
            background: #0d6efd;
            color: white !important;
            transform: translateY(-5px);
        }

        .poli-card:hover .icon-poli {
            color: white;
        }

        .icon-poli {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 15px;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin: 0 auto 15px;
        }
    </style>

    {{-- Header --}}
    <header class="header-jalan text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Instalasi Rawat Jalan</h1>
            <p class="lead">Layanan Poliklinik Spesialis Terpadu & Nyaman</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            {{-- Intro --}}
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="fw-bold">Layanan Poliklinik Kami</h2>
                    <p class="text-muted">Instalasi Rawat Jalan HEALTY-ID melayani konsultasi medis, tindakan tanpa rawat
                        inap, dan rehabilitasi medik dengan berbagai pilihan dokter spesialis yang berpengalaman.</p>
                </div>
            </div>

            {{-- Alur Pendaftaran --}}
            <div class="row g-4 mb-5 text-center">
                <h4 class="fw-bold mb-4">Alur Pendaftaran Pasien</h4>
                <div class="col-md-3">
                    <div class="step-number">1</div>
                    <h6>Registrasi</h6>
                    <p class="small text-muted">Melalui Online atau Mesin Mandiri di Lobby</p>
                </div>
                <div class="col-md-3">
                    <div class="step-number">2</div>
                    <h6>Cek Tanda Vital</h6>
                    <p class="small text-muted">Pemeriksaan suhu, tensi, dan berat badan oleh perawat</p>
                </div>
                <div class="col-md-3">
                    <div class="step-number">3</div>
                    <h6>Konsultasi Dokter</h6>
                    <p class="small text-muted">Pemeriksaan detail oleh dokter spesialis pilihan</p>
                </div>
                <div class="col-md-43 col-md-3">
                    <div class="step-number">4</div>
                    <h6>Farmasi & Kasir</h6>
                    <p class="small text-muted">Pengambilan obat dan penyelesaian administrasi</p>
                </div>
            </div>

            {{-- Daftar Poli --}}
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="poli-card shadow-sm p-4 text-center h-100">
                        <i class="bi bi-person-hearts icon-poli"></i>
                        <h5 class="fw-bold">Poliklinik Anak</h5>
                        <p class="small">Kesehatan bayi, anak, dan tumbuh kembang remaja.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="poli-card shadow-sm p-4 text-center h-100">
                        <i class="bi bi-heart-pulse icon-poli"></i>
                        <h5 class="fw-bold">Poliklinik Jantung</h5>
                        <p class="small">Layanan jantung dan pembuluh darah dengan alat EKG modern.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="poli-card shadow-sm p-4 text-center h-100">
                        <i class="bi bi-capsule icon-poli"></i>
                        <h5 class="fw-bold">Poliklinik Gigi</h5>
                        <p class="small">Perawatan gigi rutin, bedah mulut, dan ortodonti.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="poli-card shadow-sm p-4 text-center h-100">
                        <i class="bi bi-eye icon-poli"></i>
                        <h5 class="fw-bold">Poliklinik Mata</h5>
                        <p class="small">Pemeriksaan penglihatan, katarak, dan kesehatan mata lainnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="poli-card shadow-sm p-4 text-center h-100">
                        <i class="bi bi-hospital icon-poli"></i>
                        <h5 class="fw-bold">Penyakit Dalam</h5>
                        <p class="small">Penanganan diabetes, hipertensi, dan organ dalam lainnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="poli-card shadow-sm p-4 text-center h-100">
                        <i class="bi bi-gender-female icon-poli"></i>
                        <h5 class="fw-bold">Kandungan (Obgyn)</h5>
                        <p class="small">Pemeriksaan kehamilan, USG 4D, dan kesehatan reproduksi.</p>
                    </div>
                </div>
            </div>

            {{-- Call to Action --}}
            <div class="mt-5 text-center bg-light p-5 rounded-4 border">
                <h4 class="fw-bold">Ingin Menghindari Antrean Panjang?</h4>
                <p class="text-muted">Gunakan layanan pendaftaran online kami untuk mendapatkan nomor antrean lebih awal.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('beranda.jadwal_dokter_publik') }}" class="btn btn-outline-primary px-4">Lihat Jadwal Dokter</a>
                    <a href="#" class="btn btn-primary px-4 shadow">Daftar Online Sekarang</a>
                </div>
            </div>
        </div>
    </section>
@endsection
