@extends('layouts.navter')

@section('title', 'Beranda')

@section('styles')
    <style>
        /* HERO */
        .hero {
            position: relative;
            height: 85vh;
            background: url('/img/homers.png') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero .overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
        }

        /* FITUR */
        .fitur-section {
            margin-top: -60px;
            position: relative;
            z-index: 5;
        }

        .fitur-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px 22px;
            min-height: 240px;
            transition: 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .fitur-card:hover {
            transform: translateY(-5px);
        }

        .fitur-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 14px;
            font-size: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        /* KENAPA KAMI */
        .kenapa-kami {
            margin-top: 80px;
            padding-top: 20px;
            padding-bottom: 40px;
        }

        .judul-besar {
            font-size: 42px;
            font-weight: 800;
            letter-spacing: 2px;
            color: #0d6efd;
            margin: 0;
        }

        .deskripsi {
            margin-top: 15px;
            font-size: 17px;
            line-height: 1.8;
            color: #555;
        }

        .card-putih {
            background: #fff;
            border-radius: 12px;
            padding: 12px;
            overflow: hidden;
        }

        .img-homers {
            width: 100%;
            height: 360px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* ARTIKEL */
        .artikel-section {
            padding: 80px 0;
            background-color: #ffffff;
        }

        .card-artikel {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: 0.3s ease;
            background: #fff;
        }

        .card-artikel:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
        }

        .artikel-img-wrapper {
            height: 200px;
            overflow: hidden;
            position: relative;
        }

        .artikel-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-kategori {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 5px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .artikel-title {
            font-size: 1.2rem;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 12px;
            color: #212529;
            text-decoration: none;
            display: block;
        }

        .btn-baca {
            font-weight: 600;
            color: #0d6efd;
            text-decoration: none;
            font-size: 14px;
        }

        /* GALLERY */
        .gallery-section {
            padding: 80px 0;
            background-color: #f8f9fa;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            height: 250px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent, rgba(13, 110, 253, 0.7));
            display: flex;
            align-items: flex-end;
            padding: 20px;
            opacity: 0;
            transition: 0.3s ease;
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-overlay span {
            color: #fff;
            font-weight: 600;
            font-size: 18px;
        }

        /* IDER WRAPPER */
        .partner-slider {
            overflow: hidden;
            background: transparent;
            padding: 20px 0;
        }

        .textheader {
            color: #0d6efd;
        }

        /* TRACK BERJALAN */
        .partner-track {
            display: flex;
            width: max-content;
            animation: scrollPartner 25s linear infinite;
        }

        /* PAUSE SAAT HOVER */
        .partner-slider:hover .partner-track {
            animation-play-state: paused;
        }

        /* LOGO CARD */
        .partner-logo {
            background: #fff;
            margin: 0 16px;
            padding: 18px 28px;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 160px;
            height: 100px;
        }

        .partner-logo img {
            max-height: 60px;
            max-width: 100%;
            object-fit: contain;
        }

        /* ANIMASI */
        @keyframes scrollPartner {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .partner-logo img {
            max-height: 60px;
            max-width: 100%;
            object-fit: contain;
            /* DEFAULT: ABU-ABU */
            filter: grayscale(100%);
            opacity: 0.7;
            /* ANIMASI */
            transition: all 0.4s ease;
        }

        /* HOVER: WARNA + ZOOM */
        .partner-logo:hover img {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.15);
        }
    </style>
@endsection

@section('content')

    {{-- HERO --}}
    <section class="hero">
        <div class="overlay"></div>
        <div class="hero-content text-center text-white" data-aos="zoom-in">
            <h1 class="fw-bold display-4">SELAMAT DATANG DI HEALTY-ID</h1>
            <p class="lead">Melayani dengan Sepenuh Hati untuk Kesembuhan dan Kenyamanan Anda</p>
        </div>
    </section>

    {{-- FITUR --}}
    <section class="fitur-section">
        <div class="container">
            <div class="row g-4">
                {{-- JADWAL DOKTER --}}
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="fitur-card shadow text-center p-4">
                        <div class="icon bg-info mx-auto mb-3">
                            <i class="bi bi-calendar2-week-fill"></i>
                        </div>
                        <h4 class="fw-bold mt-2">Jadwal Dokter</h4>
                        <p class="text-muted mb-4 fs-5">Lihat jadwal praktek dokter yang tersedia hari ini</p>
                        <a href="{{ route('beranda.jadwal_dokter_publik') }}" class="btn btn-info btn-sm text-white px-3">Lihat Jadwal</a>
                    </div>
                </div>

                {{-- PENDAFTARAN ONLINE --}}
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="fitur-card shadow text-center p-4">
                        <div class="icon bg-danger mx-auto mb-3">
                            <i class="bi bi-clipboard2-pulse-fill"></i>
                        </div>
                        <h4 class="fw-bold mt-2">Pendaftaran Online</h4>
                        <p class="text-muted mb-4 fs-5">Daftar berobat tanpa harus antri di lokasi</p>
                        <a href="#" class="btn btn-danger btn-sm px-3">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- KENAPA MEMILIH KAMI --}}
    <section class="kenapa-kami">
        <div class="container">
            <div class="row align-items-center kenapa-row">
                <div class="col-md-6" data-aos="fade-right">
                    <small class="text-uppercase text-muted fw-bold">Kenapa memilih kami</small>
                    <h2 class="judul-besar">HEALTY-ID</h2>
                    <p class="deskripsi">
                        HEALTY-ID hadir sebagai platform layanan kesehatan modern yang mengutamakan kecepatan, kenyamanan,
                        dan kualitas pelayanan. Kami percaya bahwa setiap pasien berhak mendapatkan pelayanan terbaik.
                    </p>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="card-putih shadow-lg">
                        <img src="{{ asset('img/homers.png') }}" class="img-homers">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ARTIKEL --}}
    <section class="artikel-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
                <div>
                    <small class="text-primary fw-bold text-uppercase">Edukasi Kesehatan</small>
                    <h2 class="fw-bold mb-0">Artikel Kesehatan Terbaru</h2>
                </div>
                <a href="{{ route('artikel') }}" class="btn btn-outline-primary rounded-pill px-4">Lihat Semua</a>
            </div>

            <div class="row g-4">
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card card-artikel shadow-sm h-100">
                        <div class="artikel-img-wrapper">
                            <span class="badge-kategori bg-primary text-white">Tips Hidup Sehat</span>
                            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=800&q=80"
                                alt="Yoga">
                        </div>
                        <div class="card-body p-4">
                            <small class="text-muted d-block mb-2"><i class="bi bi-calendar3 me-1"></i> 10 Feb 2024</small>
                            <h5 class="artikel-title">5 Cara Menjaga Kesehatan Jantung di Usia Muda</h5>
                            <p class="text-muted small">Menjaga pola makan dan olahraga rutin adalah kunci utama jantung...
                            </p>
                            <hr>
                            <a href="#" class="btn-baca">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card card-artikel shadow-sm h-100">
                        <div class="artikel-img-wrapper">
                            <span class="badge-kategori bg-success text-white">Nutrisi</span>
                            <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=800&q=80"
                                alt="Food">
                        </div>
                        <div class="card-body p-4">
                            <small class="text-muted d-block mb-2"><i class="bi bi-calendar3 me-1"></i> 08 Feb 2024</small>
                            <h5 class="artikel-title">Pentingnya Sayuran Hijau untuk Tubuh</h5>
                            <p class="text-muted small">Sayuran hijau kaya akan vitamin C dan antioksidan yang membantu...
                            </p>
                            <hr>
                            <a href="#" class="btn-baca">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card card-artikel shadow-sm h-100">
                        <div class="artikel-img-wrapper">
                            <span class="badge-kategori bg-info text-white">Info Medis</span>
                            <img src="https://images.unsplash.com/photo-1584622650111-993a426fbf0a?auto=format&fit=crop&w=800&q=80"
                                alt="Lab">
                        </div>
                        <div class="card-body p-4">
                            <small class="text-muted d-block mb-2"><i class="bi bi-calendar3 me-1"></i> 05 Feb 2024</small>
                            <h5 class="artikel-title">Mengenal Gejala DBD dan Penanganannya</h5>
                            <p class="text-muted small">Waspadai fase kritis pada demam berdarah yang sering tidak
                                disadari...</p>
                            <hr>
                            <a href="#" class="btn-baca">Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- GALLERY --}}
    <section class="gallery-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-down">
                <small class="text-primary fw-bold text-uppercase">Fasilitas Kami</small>
                <h2 class="fw-bold">Galeri Ruangan HEALTY-ID</h2>
                <hr class="mx-auto" style="width: 60px; height: 4px; color: #0d6efd;">
            </div>

            <div class="row g-4">
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="gallery-item">
                        <img src="{{ asset('img/ruang-inap.jpg') }}" alt="Rawat Inap">
                        <div class="gallery-overlay"><span>Ruang Rawat Inap VIP</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="gallery-item">
                        <img src="{{ asset('img/ruang-operasi.jpg') }}" alt="Operasi">
                        <div class="gallery-overlay"><span>Fasilitas Bedah Modern</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="gallery-item">
                        <img src="{{ asset('img/lobby.jpg') }}" alt="Lobby">
                        <div class="gallery-overlay"><span>Lobby Utama</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="gallery-item">
                        <img src="{{ asset('img/ruang-inap.jpg') }}" alt="Rawat Inap">
                        <div class="gallery-overlay"><span>Ruang Rawat Inap VIP</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="gallery-item">
                        <img src="{{ asset('img/ruang-operasi.jpg') }}" alt="Operasi">
                        <div class="gallery-overlay"><span>Fasilitas Bedah Modern</span></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="gallery-item">
                        <img src="{{ asset('img/lobby.jpg') }}" alt="Lobby">
                        <div class="gallery-overlay"><span>Lobby Utama</span></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION MITRA KERJASAMA SLIDER -->
    <section class="py-5 bg-light">
        <div class="container">

            <!-- HEADER -->
            <div class="text-center mb-4">
                <h2 class="textheader fw-bold">Mitra Kerjasama Kami</h2>
                <p class="text-muted">
                    Kami bekerja sama dengan berbagai mitra dan perusahaan asuransi
                    untuk kemudahan pelayanan kesehatan Anda
                </p>
            </div>

        </div>

       
        <div class="partner-slider">
            <div class="partner-track">

                
                <div class="partner-logo"><img src="{{ asset('img/spon.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon2.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon3.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon4.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon5.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon6.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon7.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon8.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon9.png') }}"></div>

                <div class="partner-logo"><img src="{{ asset('img/spon.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon2.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon3.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon4.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon5.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon6.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon7.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon8.png') }}"></div>
                <div class="partner-logo"><img src="{{ asset('img/spon9.png') }}"></div>

            </div>
        </div>
    </section>

@endsection
