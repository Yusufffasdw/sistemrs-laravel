@extends('layouts.navter')

@section('title', 'Daftar Dokter')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Daftar Dokter Ahli</h2>
            <p class="text-muted">Tenaga medis profesional Rumah Sakit</p>
            <hr class="mx-auto" style="width: 50px; height: 3px; background: #0d6efd; border:none; opacity:1;">
        </div>

        @if(isset($dokters) && $dokters->count() > 0)
        <div class="row g-4">
            @foreach ($dokters as $d)
                <div class="col-lg-4 col-md-6">
                    <div class="card card-dokter border-0 shadow-lg h-100 p-2">
                        <div class="card-body p-3">
                            <div class="row g-0 align-items-center">
                                <div class="col-4">
                                    <div class="dokter-img-container rounded-3 overflow-hidden bg-light d-flex align-items-center justify-content-center shadow-sm">
                                        @if($d->foto)
                                            <img src="{{ Storage::url($d->foto) }}" alt="Foto {{ $d->nama }}" class="img-fluid h-100 w-100 object-fit-cover">
                                        @else
                                            <i class="bi bi-person-fill fs-1 text-secondary"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-8 geser-teks d-flex flex-column justify-content-start">
                                    <h6 class="fw-bold mb-2 text-dark leading-tight" style="min-height: 40px;">
                                        {{ $d->nama }}
                                    </h6>
                                    
                                    <div class="d-flex align-items-center mb-1 text-muted">
                                        <i class="bi bi-stethoscope text-info me-2"></i>
                                        <small class="fw-medium">{{ $d->spesialisasi }}</small>
                                    </div>

                                    <div class="d-flex align-items-center text-muted mb-1">
                                        <i class="bi bi-geo-alt text-info me-2"></i>
                                        <small>{{ $d->departemen->nama ?? 'Unit Umum' }}</small>
                                    </div>

                                    @if($d->telepon)
                                    <div class="d-flex align-items-center text-muted">
                                        <i class="bi bi-telephone text-info me-2"></i>
                                        <small>{{ $d->telepon }}</small>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 pt-3 d-flex justify-content-between align-items-center border-top">
                                <a href="{{ route('beranda.dokter_show', $d->id) }}" class="text-decoration-none d-flex align-items-center text-primary fw-bold small">
                                    <i class="bi bi-info-circle me-1"></i> LIHAT PROFIL
                                </a>
                                <a href="#" class="btn btn-outline-primary px-3 py-2 fw-bold" style="border-radius: 10px; font-size: 0.8rem; border-width: 2px;">
                                    Pilih Jadwal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $dokters->links() }}
        </div>
        @else
        <div class="alert alert-info text-center border-0 shadow-sm">
            <i class="bi bi-info-circle me-2"></i> Belum ada data dokter.
        </div>
        @endif
    </div>

    <style>
        .card-dokter {
            border-radius: 15px;
            transition: 0.3s;
            background: #fff;
        }

        .card-dokter:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
        }

        .dokter-img-container {
            aspect-ratio: 1/1;
            width: 100%;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        /* --- INI KUNCI GESERNYA --- */
        .geser-teks {
            padding-left: 35px !important; /* Silakan tambah angkanya (misal 45px) kalau mau lebih jauh lagi */
        }

        .text-info {
            color: #00bcd4 !important;
        }

        .leading-tight {
            line-height: 1.25;
        }

        /* Responsive agar di HP tidak terlalu jauh gesernya */
        @media (max-width: 576px) {
            .geser-teks {
                padding-left: 15px !important;
            }
        }
    </style>
@endsection