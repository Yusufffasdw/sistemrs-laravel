<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HEALTY-ID - RS Terpadu')</title>

    @yield('meta')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* === NAVBAR === */
        .navbar {
            background-color: #ffffff;
            transition: all 0.3s ease;
            padding-top: 6px;
            padding-bottom: 6px;
        }

        .navbar.scrolled {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-size: 1.05rem;
        }

        .navbar .nav-link {
            color: #333;
            font-weight: 500;
            transition: color 0.2s ease;
            padding: 6px 10px;
            font-size: 0.95rem;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: #0d6efd;
        }

        .btn-outline-primary {
            border: 1.5px solid #0d6efd;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 5px 14px;
            border-radius: 50px;
        }

        .btn-outline-primary:hover {
            background-color: #0d6efd;
            color: #fff !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
        }

        .dropdown-item {
            font-size: 0.9rem;
        }

        /* === FOOTER === */
        footer {
            background-color: #f8f9fa;
            color: #444;
            padding-top: 60px;
            padding-bottom: 20px;
            border-top: 1px solid #eee;
        }

        .footer-logo {
            height: 45px;
            margin-bottom: 20px;
        }

        .footer-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 25px;
            position: relative;
        }

        .footer-title::after {
            content: '';
            width: 30px;
            height: 2px;
            background: #0d6efd;
            position: absolute;
            bottom: -8px;
            left: 0;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            text-decoration: none;
            color: #666;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .footer-links a:hover {
            color: #0d6efd;
            padding-left: 5px;
        }

        .contact-info li {
            display: flex;
            gap: 12px;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .contact-info i {
            color: #0d6efd;
            font-size: 1.1rem;
        }

        .social-links {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .social-icon {
            width: 35px;
            height: 35px;
            background: #0d6efd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-decoration: none;
            transition: 0.3s;
        }

        .social-icon:hover {
            background: #0a58ca;
            transform: translateY(-3px);
            color: #fff;
        }

        .copyright {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 0.85rem;
            color: #888;
        }

        @media (max-width: 991px) {
            .navbar-nav { gap: 0.3rem; }
        }
    </style>

    @yield('styles')
</head>

<body>

{{-- === NAVBAR === --}}
<nav class="navbar navbar-expand-lg sticky-top bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="{{ route('beranda') }}">
            <img src="/img/logors.jpeg" alt="Logo" style="height:40px; margin-right:8px;">
            {{-- <span>HEALTY-ID</span> --}}
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto align-items-center fw-semibold gap-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Home</a>
                </li>

                {{-- Dropdown Tentang Kami --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Tentang Kami</a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('sejarah') }}">Sejarah Singkat</a></li>
                        <li><a class="dropdown-item" href="{{ route('visi-misi') }}">Visi dan Misi</a></li>
                    </ul>
                </li>

                {{-- Dropdown Layanan --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Layanan Kami</a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('instalasi.igd') }}">IGD</a></li>
                        <li><a class="dropdown-item" href="{{ route('instalasi.inap') }}">Rawat Inap</a></li>
                        
                    </ul>
                </li>

                {{-- Dropdown Dokter --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dokter</a>
                    <ul class="dropdown-menu border-0 shadow-sm">
                        <li><a class="dropdown-item" href="{{ route('beranda.jadwal_dokter_publik') }}">Jadwal Dokter</a></li>
                        <li><a class="dropdown-item" href="{{ route('daftardokter') }}">Daftar Dokter</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class="nav-link" href="{{ route('fasilitas') }}">Fasilitas</a></li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('artikel.publik') ? 'active' : '' }}" href="{{ route('artikel.publik') }}">Artikel</a>
                </li>
            </ul>

            {{-- Bagian Tombol Kanan (Pendaftaran & Login) --}}
            <div class="d-flex flex-column flex-lg-row align-items-center gap-2 mt-3 mt-lg-0">
                {{-- Tombol Pendaftaran (Bisa diakses siapa saja) --}}
                <a href="{{ route('pasien.create') }}" class="btn btn-primary rounded-pill px-4 d-flex align-items-center gap-1">
                    <i class="bi bi-person-plus"></i> Pendaftaran
                </a>

                {{-- Auth Logic --}}
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-success rounded-pill px-4 d-flex align-items-center gap-2">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill px-4 d-flex align-items-center gap-2">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                @endauth
                      
            </div>
        </div>
    </div>
</nav>
    {{-- === KONTEN UTAMA === --}}
    <div class="main-content">
        @yield('content')
    </div>

    {{-- === FOOTER === --}}
    <footer>
        <div class="container" data-aos="fade-up">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <img src="/img/logors.jpeg" alt="Logo HEALTY-ID" class="footer-logo">
                    <p class="text-muted small mt-2">
                        Pelayanan kesehatan terbaik dengan fasilitas modern dan tenaga medis profesional. Kesehatan Anda adalah prioritas kami.
                    </p>
                    <h6 class="fw-bold small mb-3 text-primary text-uppercase">Ikuti Media Sosial Kami</h6>
                    <div class="social-links">
                        <a href="https://instagram.com/zuannkt29" class="social-icon" title="Instagram Admin 1"><i class="bi bi-instagram"></i></a>
                        <a href="https://instagram.com/yzenverse" class="social-icon" title="Instagram Admin 2"><i class="bi bi-instagram"></i></a>
                        <a href="https://instagram.com/m4s1pul" class="social-icon" title="Instagram Admin 3"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('instalasi.igd') }}">Gawat Darurat</a></li>
                        <li><a href="{{ route('instalasi.inap') }}">Rawat Inap</a></li>
                       
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Tautan</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('beranda') }}">Beranda</a></li>
                        <li><a href="{{ route('sejarah') }}">Sejarah Kami</a></li>
                        <li><a href="{{ route('beranda.jadwal_dokter_publik') }}">Jadwal Dokter</a></li>
                        <li><a href="{{ route('artikel.publik') }}">Artikel Kesehatan</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Kontak Kami</h5>
                    <ul class="contact-info list-unstyled">
                        <li><i class="bi bi-geo-alt-fill"></i> <span>Jl. Kesehatan No. 123, Kedungurang</span></li>
                        <li><i class="bi bi-telephone-fill"></i> <span>(021) 1234-5678</span></li>
                        <li><i class="bi bi-whatsapp"></i> <span>+62 812-3456-7890</span></li>
                        <li><i class="bi bi-envelope-fill"></i> <span>info@healty-id.com</span></li>
                    </ul>
                </div>
            </div>

            <div class="row copyright">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; {{ date('Y') }} HEALTY-ID. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p>Designed Oktz <i class="bi bi-heart-fill text-danger"></i> for Health.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Inisialisasi AOS
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        // Efek shadow navbar saat scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>