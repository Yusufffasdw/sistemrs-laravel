@extends('layouts.navter')

@section('title', 'Instalasi Rawat Inap')

@section('content')
    <style>
        .header-inap {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('/img/rawat-inap-bg.jpg') center/cover;
            padding: 100px 0;
            color: white;
        }

        .card-kamar {
            border: none;
            border-radius: 20px;
            transition: 0.3s ease;
            overflow: hidden;
        }

        .card-kamar:hover {
            transform: translateY(-10px);
        }

        .fitur-unggulan {
            background-color: #f0f7ff;
            border-radius: 15px;
            padding: 20px;
            border-left: 5px solid #0d6efd;
        }

        .price-tag {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0d6efd;
        }
    </style>

    {{-- Header Section --}}
    <header class="header-inap text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Instalasi Rawat Inap</h1>
            <p class="lead">Pemulihan Optimal dengan Fasilitas Senyaman di Rumah</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6">
                    <h2 class="fw-bold text-primary mb-3">Layanan Rawat Inap Terpadu</h2>
                    <p class="text-muted">Kami menyediakan berbagai pilihan kelas perawatan yang dirancang untuk memberikan
                        ketenangan dan kenyamanan selama masa pemulihan pasien. Didukung oleh tim dokter spesialis dan
                        perawat profesional yang siap melayani 24 jam.</p>

                    <div class="mt-4">
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-check-circle-fill text-success mt-1 me-3 fs-5"></i>
                            <div>
                                <h6 class="fw-bold mb-0">Visit Dokter Spesialis</h6>
                                <p class="small text-muted">Pemantauan kesehatan rutin oleh dokter ahli sesuai bidang medis.
                                </p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start mb-3">
                            <i class="bi bi-check-circle-fill text-success mt-1 me-3 fs-5"></i>
                            <div>
                                <h6 class="fw-bold mb-0">Menu Nutrisi Custom</h6>
                                <p class="small text-muted">Makanan bergizi yang disesuaikan dengan anjuran ahli gizi dan
                                    kondisi pasien.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-kamar shadow-lg">
                        <img src="{{ asset('img/vip-room.jpg') }}" class="img-fluid" alt="Kamar VIP">
                    </div>
                </div>
            </div>

            <h3 class="fw-bold text-center mb-4">Pilihan Kelas Kamar</h3>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-kamar shadow-sm h-100">
                        <div class="p-4 bg-primary text-white text-center">
                            <h4 class="mb-0 fw-bold">KELAS VIP</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-dot"></i> 1 Tempat Tidur Elektrik</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> AC & TV LED 43"</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Sofa Bed untuk Penunggu</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Kamar Mandi Dalam (Water Heater)</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Kulkas & Microwave</li>
                            </ul>
                            <a href="#" class="btn btn-outline-primary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-kamar shadow-sm h-100">
                        <div class="p-4 bg-info text-white text-center">
                            <h4 class="mb-0 fw-bold">KELAS 1</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-dot"></i> 2 Tempat Tidur</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> AC & TV LED</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Kamar Mandi Dalam</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Lemari Pakaian</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Kursi Tunggu</li>
                            </ul>
                            <a href="#" class="btn btn-outline-info w-100 text-info">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-kamar shadow-sm h-100">
                        <div class="p-4 bg-secondary text-white text-center">
                            <h4 class="mb-0 fw-bold">KELAS 2 & 3</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2"><i class="bi bi-dot"></i> 3 - 5 Tempat Tidur</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> AC Central</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Kamar Mandi</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Tirai Penyekat</li>
                                <li class="mb-2"><i class="bi bi-dot"></i> Meja Nakas</li>
                            </ul>
                            <a href="#" class="btn btn-outline-secondary w-100">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Jam Besuk --}}
            <div class="row mt-5">
                <div class="col-12">
                    <div class="fitur-unggulan shadow-sm">
                        <h5 class="fw-bold"><i class="bi bi-info-circle-fill me-2 text-primary"></i> Informasi Jam Besuk
                        </h5>
                        <p class="mb-0 text-muted">Untuk menjaga ketenangan pasien, waktu kunjungan dibatasi pada:</p>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <strong>Siang:</strong> 11.00 - 13.00 WIB
                            </div>
                            <div class="col-md-6">
                                <strong>Sore:</strong> 17.00 - 19.00 WIB
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
