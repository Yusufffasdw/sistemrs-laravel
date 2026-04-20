@extends('layouts.navter')

@section('title', 'Instalasi Gawat Darurat (IGD)')

@section('content')
    <style>
        .page-header {
            background: linear-gradient(rgba(13, 110, 253, 0.8), rgba(13, 110, 253, 0.8)), url('/img/igd-bg.jpg') center/cover;
            padding: 100px 0;
            color: white;
        }

        .service-card {
            border: none;
            border-radius: 15px;
            transition: 0.3s;
        }

        .icon-box {
            width: 60px;
            height: 60px;
            background: #e7f1ff;
            color: #0d6efd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>

    {{-- Header --}}
    <header class="page-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Instalasi Gawat Darurat</h1>
            <p class="lead">Layanan Medis Darurat 24 Jam Non-Stop</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('img/igd-detail.png') }}" class="img-fluid rounded-4 shadow" alt="IGD HEALTY-ID">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Siaga Melayani Keadaan Darurat Anda</h2>
                    <p class="text-muted">Instalasi Gawat Darurat (IGD) HEALTY-ID dilengkapi dengan peralatan medis mutakhir
                        dan tenaga medis yang terlatih khusus untuk menangani kasus gawat darurat secara cepat dan tepat.
                    </p>

                    <div class="row g-4 mt-2">
                        <div class="col-sm-6">
                            <div class="icon-box"><i class="bi bi-clock-history"></i></div>
                            <h5>Respon Cepat</h5>
                            <p class="small text-muted">Tim medis siap sedia dalam hitungan detik untuk kondisi kritis.</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="icon-box"><i class="bi bi-person-heart"></i></div>
                            <h5>Tenaga Ahli</h5>
                            <p class="small text-muted">Dokter dan perawat spesialis gawat darurat bersertifikasi.</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            {{-- Alur Pelayanan --}}
            <div class="text-center mb-5">
                <h3 class="fw-bold">Fasilitas & Layanan IGD</h3>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card service-card shadow-sm p-4 h-100">
                        <h5 class="fw-bold text-primary">Triage 24 Jam</h5>
                        <p class="text-muted small">Sistem pemilahan pasien berdasarkan tingkat kegawatdaruratan medis untuk
                            penanganan prioritas.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card service-card shadow-sm p-4 h-100">
                        <h5 class="fw-bold text-primary">Ruang Resusitasi</h5>
                        <p class="text-muted small">Ruangan khusus yang dilengkapi alat pacu jantung dan bantuan hidup dasar
                            yang lengkap.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card service-card shadow-sm p-4 h-100">
                        <h5 class="fw-bold text-primary">Ambulans Gawat Darurat</h5>
                        <p class="text-muted small">Layanan penjemputan medis dengan peralatan lengkap selama perjalanan
                            menuju rumah sakit.</p>
                    </div>
                </div>
            </div>

            {{-- Call Center Box --}}
            <div class="mt-5 p-4 bg-danger text-white rounded-4 text-center">
                <h4 class="mb-2">Butuh Bantuan Darurat Sekarang?</h4>
                <p class="mb-3">Hubungi Call Center IGD kami yang stand-by 24 jam</p>
                <a href="tel:0211234567" class="btn btn-light btn-lg fw-bold text-danger px-5">
                    <i class="bi bi-telephone-fill me-2"></i> (021) 1234 567
                </a>
            </div>
        </div>
    </section>
@endsection
