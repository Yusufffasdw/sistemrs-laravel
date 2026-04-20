@extends('layouts.navter')

@section('title', 'Beranda - HEALTY-ID')

@section('styles')
    <style>
        /* HERO */
        .hero {
            position: relative;
            height: 85vh;
            background: #2563eb;
            /* Fallback color */
            background-image: url('{{ asset('img/homers.png') }}');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4));
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.3);
        }

        /* FITUR */
        .fitur-section {
            margin-top: -60px;
            position: relative;
            z-index: 5;
        }

        .fitur-card {
            background: #fff;
            border-radius: 20px;
            padding: 35px 25px;
            min-height: 240px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            flex-direction: column;
            justify-content: center;
            border: none;
        }

        .fitur-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
        }

        .fitur-card .icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            margin-bottom: 20px;
        }

        /* KENAPA KAMI */
        .kenapa-kami {
            margin-top: 80px;
            padding: 80px 0;
        }

        .judul-besar {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            color: #1e3a8a;
            margin-bottom: 20px;
        }

        .deskripsi {
            font-size: 18px;
            line-height: 1.8;
            color: #4b5563;
        }

        .card-putih {
            background: #fff;
            border-radius: 24px;
            padding: 15px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
        }

        .img-placeholder {
            width: 100%;
            height: 400px;
            background-color: #e5e7eb;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
        }

        /* ARTIKEL */
        .card-artikel {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: 0.3s ease;
            background: #fff;
        }

        .artikel-img-wrapper {
            height: 220px;
            background-color: #f3f4f6;
            position: relative;
        }

        .artikel-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            text-decoration: none;
            transition: 0.2s;
        }

        .artikel-title:hover {
            color: #2563eb;
        }

        /* GALLERY */
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            height: 280px;
            background-color: #e5e7eb;
        }

        /* PARTNER SLIDER */
        .partner-slider {
            overflow: hidden;
            padding: 20px 0;
            width: 100%;
            position: relative;
        }

        .partner-track {
            display: flex;
            width: max-content;
            animation: scrollPartner 30s linear infinite;
        }

        /* Tambahkan ini untuk memastikan tidak ada kebocoran layout di level body */
        body {
            overflow-x: hidden;
        }

        @keyframes scrollPartner {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .partner-logo {
            background: #fff;
            margin: 0 15px;
            padding: 20px;
            border-radius: 12px;
            min-width: 150px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
    </style>
@endsection

@section('content')

    {{-- HERO --}}
    <section class="hero">
        <div class="overlay"></div>
        <div class="container hero-content text-center text-white" data-aos="zoom-out">
            <h1 class="fw-bold display-3 mb-3">PULIHKAN KESEHATANMU<br>BERSAMA HEALTY-ID</h1>
            <p class="lead mb-0 fs-4 opacity-90">Pelayanan medis profesional dengan fasilitas teknologi terdepan.</p>
            <p class="lead mb-0 fs-4 opacity-90">I wish you healing here hehe 🥺🥺🥺</p>
        </div>
    </section>

    {{-- FITUR --}}
    <section class="fitur-section">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-5" data-aos="fade-up" data-aos-delay="100">
                    <div class="fitur-card shadow-lg text-center">
                        <div class="icon bg-info shadow-info mx-auto">
                            <i class="bi bi-calendar2-check"></i>
                        </div>
                        <h4 class="fw-bold">Jadwal Dokter</h4>
                        <p class="text-muted fs-6 px-lg-5">Temukan spesialis yang tepat dan cek waktu praktik mereka secara
                            real-time.</p>
                        <div class="mt-3">
                            <a href="{{ route('beranda.jadwal_dokter_publik') }}"
                                class="btn btn-info text-white rounded-pill px-4 fw-bold">Cek Jadwal</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-5" data-aos="fade-up" data-aos-delay="300">
                    <div class="fitur-card shadow-lg text-center">
                        <div class="icon bg-primary shadow-primary mx-auto">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <h4 class="fw-bold">Pendaftaran Online</h4>
                        <p class="text-muted fs-6 px-lg-5">Lewati antrean fisik. Daftar dari rumah dan datanglah saat waktu
                            giliran Anda.</p>
                        <div class="mt-3">
                            <a href="{{ route('pasien.create') }}" class="btn btn-primary rounded-pill px-4 fw-bold">Daftar
                                Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TENTANG KAMI --}}
    <section class="kenapa-kami">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h6 class="text-primary fw-bold text-uppercase mb-3">Tentang Kami</h6>
                    <h2 class="judul-besar">Solusi Kesehatan Terpadu Untuk Keluarga</h2>
                    <p class="deskripsi mb-4">
                        HEALTY-ID bukan sekadar rumah sakit, kami adalah mitra perjalanan kesehatan Anda. Dengan
                        mengintegrasikan sistem digital, kami memastikan setiap pasien mendapatkan penanganan cepat tanpa
                        hambatan birokrasi yang rumit.
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="fw-semibold">Dokter Spesialis Ahli</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span class="fw-semibold">Fasilitas Modern</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card-putih">
                        <img src="{{ asset('img/about-facility.png') }}" alt="Fasilitas HEALTY-ID" class="img-fluid rounded-3">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Artikel Kesehatan Section -->
    @if (isset($artikel) && $artikel->count() > 0)
        <div class="bg-light py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h3 class="section-title d-inline-block">Artikel & Tips Kesehatan</h3>
                    <p class="text-muted">Informasi kesehatan terkini untuk Anda dan keluarga</p>
                </div>

                <div class="row g-4">
                    @foreach ($artikel as $item)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                @if ($item->gambar)
                                    <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="{{ $item->judul }}"
                                        style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-primary"
                                        style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-file-text text-white" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    @if ($item->kategori)
                                        <span class="badge bg-primary mb-2">{{ $item->kategori }}</span>
                                    @endif
                                    <h5 class="card-title fw-bold">{{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                                    </h5>
                                    <p class="card-text text-muted small">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-eye me-1"></i> {{ $item->views ?? 0 }} views
                                        </small>
                                        <a href="{{ route('artikel.show_p',$item) }}" class="text-blue-600 font-bold text-sm hover:underline">
                                            Baca Selengkapnya →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('artikel.publik') }}" class="btn btn-primary rounded-pill px-4">Lihat Semua
                        Artikel</a>
                </div>
            </div>
        </div>
    @endif


    {{-- GALLERY --}}
    <section class="gallery-section py-5">
        <div class="container py-5">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-primary fw-bold text-uppercase">Fasilitas</h6>
                <h2 class="fw-bold">Eksplorasi Lingkungan Kami</h2>
                <center>
                    <div style="width: 50px; height: 3px; background: #2563eb; margin-top: 15px;"></div>
                </center>
            </div>

            <div class="row g-4">
                @php
                    $facilities = [
                        ['name' => 'Ruang Emergency', 'img' => 'facility-1.png'],
                        ['name' => 'Laboratorium', 'img' => 'facility-2.png'],
                        ['name' => 'Ruang Operasi', 'img' => 'facility-3.png'],
                        ['name' => 'Ruang Rawat Inap', 'img' => 'facility-4.png'],
                        ['name' => 'Apotek', 'img' => 'facility-5.png'],
                        ['name' => 'Ruang Konsultasi', 'img' => 'facility-6.png'],
                    ];
                @endphp
                @foreach($facilities as $facility)
                    <div class="col-md-4 col-sm-6" data-aos="zoom-in">
                        <div class="gallery-item" style="background-image: url('{{ asset('img/gallery/' . $facility['img']) }}'); background-size: cover; background-position: center;">
                            <div class="position-absolute bottom-0 start-0 p-3 text-white fw-bold"
                                style="background: linear-gradient(transparent, rgba(0,0,0,0.7)); width: 100%;">
                                {{ $facility['name'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- MITRA --}}
    <section class="py-5 bg-white border-top">
        <div class="container py-4">
            <div class="text-center mb-5">
                <h5 class="fw-bold text-secondary">Mitra Strategis & Asuransi</h5>
            </div>

            <div class="partner-slider">
                <div class="partner-track">
                    @php
                        $partners = ['bpjs', 'allianz', 'prudential', 'axa', 'manulife', 'sinarmas', 'aia', 'cigna', 'astra', 'mega'];
                    @endphp
                    {{-- Loop Partner Logos --}}
                    @foreach($partners as $partner)
                        <div class="partner-logo">
                            <img src="{{ asset('img/partners/' . $partner . '.png') }}" alt="{{ ucfirst($partner) }}" class="img-fluid" style="max-height: 50px; max-width: 120px;">
                        </div>
                    @endforeach
                    {{-- Duplicate for Infinite Scroll --}}
                    @foreach($partners as $partner)
                        <div class="partner-logo">
                            <img src="{{ asset('img/partners/' . $partner . '.png') }}" alt="{{ ucfirst($partner) }}" class="img-fluid" style="max-height: 50px; max-width: 120px;">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection