@extends('layouts.navter')

@section('title', 'Sejarah Singkat')

@section('content')
    <style>
        .sejarah-header {
            background: linear-gradient(rgba(13, 110, 253, 0.8), rgba(13, 110, 253, 0.8)), url('/img/hospital-old.jpg') center/cover;
            padding: 80px 0;
            color: white;
        }

        .timeline {
            border-left: 3px solid #0d6efd;
            padding-left: 20px;
            position: relative;
        }

        .timeline-item {
            margin-bottom: 30px;
            position: relative;
        }

        .timeline-item::before {
            content: "";
            width: 15px;
            height: 15px;
            background: #0d6efd;
            border-radius: 50%;
            position: absolute;
            left: -29px;
            top: 5px;
        }
    </style>

    <header class="sejarah-header text-center">
        <div class="container">
            <h1 class="fw-bold">Sejarah HEALTY-ID</h1>
            <p>Dedikasi Melayani Negeri Sejak Awal Berdiri</p>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <img src="{{ asset('img/homers.png') }}" class="img-fluid rounded-4 shadow" alt="Gedung RS">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold text-primary">Awal Mula Perjalanan</h2>
                    <p class="text-muted">HEALTY-ID didirikan dengan semangat untuk menghadirkan layanan kesehatan yang
                        manusiawi dan berbasis teknologi. Berawal dari sebuah klinik kecil, kini kami telah bertransformasi
                        menjadi pusat kesehatan rujukan utama.</p>

                    <div class="timeline mt-4">
                        <div class="timeline-item">
                            <h6 class="fw-bold text-primary">2010 - Peletakan Batu Pertama</h6>
                            <p class="small text-muted">Dimulainya pembangunan gedung utama dengan visi pelayanan kesehatan
                                terpadu.</p>
                        </div>
                        <div class="timeline-item">
                            <h6 class="fw-bold text-primary">2015 - Transformasi Digital</h6>
                            <p class="small text-muted">Menjadi RS pertama di wilayah ini yang menerapkan rekam medis
                                elektronik penuh.</p>
                        </div>
                        <div class="timeline-item">
                            <h6 class="fw-bold text-primary">2023 - Akreditasi Paripurna</h6>
                            <p class="small text-muted">Menerima penghargaan tertinggi dalam standar pelayanan kesehatan
                                nasional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
