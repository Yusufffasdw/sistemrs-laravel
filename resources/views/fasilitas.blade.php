@extends('layouts.navter')

@section('title', 'Fasilitas Kami')

@section('content')
    <div class="bg-light py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h6 class="text-primary fw-bold text-uppercase">Layanan & Fasilitas</h6>
                <h2 class="fw-bold">Komitmen Kami Untuk Kenyamanan Anda</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">
                    HEALTY-ID menyediakan berbagai fasilitas medis terkini dan ruang perawatan yang nyaman untuk mendukung
                    proses penyembuhan pasien secara maksimal.
                </p>
            </div>

            <div class="row g-4 mb-5">
                <h4 class="fw-bold mb-4 border-start border-primary border-4 ps-3">Fasilitas Unggulan</h4>

                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=800&auto=format&fit=crop"
                            class="card-img-top" alt="IGD 24 Jam" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="fw-bold">IGD 24 Jam</h5>
                            <p class="card-text text-muted small">Layanan gawat darurat yang siap siaga 24 jam dengan tenaga
                                medis ahli dan peralatan resusitasi lengkap.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <img src="http://googleusercontent.com/image_collection/image_retrieval/15188718060302842941_2"
                            class="card-img-top" alt="Radiologi Modern" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="fw-bold">Radiologi & Imaging</h5>
                            <p class="card-text text-muted small">Dilengkapi dengan MRI, CT-Scan 128 Slice, dan X-Ray
                                Digital untuk diagnosis yang sangat akurat.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1581056771107-24ca5f033842?q=80&w=800&auto=format&fit=crop"
                            class="card-img-top" alt="Laboratorium" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="fw-bold">Laboratorium Pusat</h5>
                            <p class="card-text text-muted small">Layanan pemeriksaan spesimen otomatis dengan hasil yang
                                cepat, tepat, dan terpercaya.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <h4 class="fw-bold mb-4 border-start border-primary border-4 ps-3">Ruang Perawatan</h4>

                <div class="col-lg-6" data-aos="fade-right">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="row g-0 h-100 align-items-center">
                            <div class="col-md-5 h-100">
                                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=800&auto=format&fit=crop"
                                    class="img-fluid rounded-start h-100" alt="VVIP Room"
                                    style="object-fit: cover; min-height: 200px;">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="fw-bold">Suite VVIP</h5>
                                    <ul class="small text-muted ps-3">
                                        <li>Tempat tidur elektrik premium</li>
                                        <li>Ruang tamu & Dapur pribadi</li>
                                        <li>TV Kabel & WiFi Cepat</li>
                                        <li>Layanan Butler 24 Jam</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="row g-0 h-100 align-items-center">
                            <div class="col-md-5 h-100">
                                <img src="https://images.unsplash.com/photo-1538108197017-c1346673919e?q=80&w=800&auto=format&fit=crop"
                                    class="img-fluid rounded-start h-100" alt="Kamar Kelas 1"
                                    style="object-fit: cover; min-height: 200px;">
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h5 class="fw-bold">Kamar Kelas 1</h5>
                                    <ul class="small text-muted ps-3">
                                        <li>Satu pasien per kamar</li>
                                        <li>AC & Kamar mandi dalam</li>
                                        <li>Sofa bed penunggu</li>
                                        <li>Nutrisi khusus sesuai diet</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 text-center">
                <h4 class="fw-bold mb-2 border-start border-primary border-4 ps-3 text-start">Fasilitas Umum</h4>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-p-circle fs-1 text-primary"></i>
                        <p class="fw-bold mt-2 mb-0">Parkir Luas</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-cup-hot fs-1 text-primary"></i>
                        <p class="fw-bold mt-2 mb-0">Kantin Sehat</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-house-heart fs-1 text-primary"></i>
                        <p class="fw-bold mt-2 mb-0">Musholla</p>
                    </div>
                </div>
                <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="p-4 bg-white rounded shadow-sm h-100">
                        <i class="bi bi-truck fs-1 text-primary"></i>
                        <p class="fw-bold mt-2 mb-0">Ambulans VIP</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
