@extends('layouts.navter')

@section('title', 'Visi dan Misi')

@section('content')
    <style>
        .visi-misi-card {
            border: none;
            border-radius: 20px;
            background: #f8f9fa;
            padding: 40px;
            height: 100%;
        }

        .quote-icon {
            font-size: 3rem;
            color: #0d6efd;
            opacity: 0.2;
        }
    </style>

    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Visi, Misi & Nilai</h2>
                <p class="text-muted">Panduan Kami dalam Memberikan Pelayanan Terbaik</p>
            </div>

            <div class="row g-4">
                {{-- VISI --}}
                <div class="col-lg-5">
                    <div class="visi-misi-card shadow-sm text-center">
                        <i class="bi bi-eye-fill fs-1 text-primary mb-3"></i>
                        <h3 class="fw-bold">VISI</h3>
                        <p class="fst-italic fs-5 text-muted">"Menjadi institusi layanan kesehatan pilihan utama masyarakat
                            yang unggul dalam teknologi, profesionalisme, dan kasih sayang."</p>
                    </div>
                </div>

                {{-- MISI --}}
                <div class="col-lg-7">
                    <div class="visi-misi-card shadow-sm">
                        <h3 class="fw-bold mb-4"><i class="bi bi-list-check me-2 text-primary"></i> MISI KAMI</h3>
                        <ul class="list-unstyled">
                            <li class="d-flex mb-3">
                                <i class="bi bi-patch-check-fill text-primary me-3 mt-1"></i>
                                <span>Menyelenggarakan pelayanan kesehatan yang bermutu tinggi dan mengutamakan keselamatan
                                    pasien.</span>
                            </li>
                            <li class="d-flex mb-3">
                                <i class="bi bi-patch-check-fill text-primary me-3 mt-1"></i>
                                <span>Mengembangkan sumber daya manusia yang kompeten, berintegritas, dan berjiwa
                                    melayani.</span>
                            </li>
                            <li class="d-flex mb-3">
                                <i class="bi bi-patch-check-fill text-primary me-3 mt-1"></i>
                                <span>Mengimplementasikan teknologi medis terkini untuk ketepatan diagnosis dan
                                    terapi.</span>
                            </li>
                            <li class="d-flex mb-3">
                                <i class="bi bi-patch-check-fill text-primary me-3 mt-1"></i>
                                <span>Mewujudkan lingkungan kerja yang sehat, harmonis, dan sejahtera.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- NILAI DASAR --}}
            <div class="mt-5 p-5 bg-primary text-white rounded-4 shadow">
                <div class="row text-center">
                    <h4 class="fw-bold mb-4">NILAI DASAR (CORE VALUES)</h4>
                    <div class="col-md-3">
                        <h5 class="fw-bold">INTEGRITAS</h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="fw-bold">EMPATI</h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="fw-bold">INOVASI</h5>
                    </div>
                    <div class="col-md-3">
                        <h5 class="fw-bold">KOLABORASI</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
