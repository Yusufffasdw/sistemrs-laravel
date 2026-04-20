@extends('layouts.navter')

@section('title', 'Artikel Kesehatan')

@section('content')
    @php
        $semua_artikel = [
            [
                'judul' => '5 Cara Menjaga Kesehatan Jantung di Usia Muda',
                'kategori' => 'Tips Hidup Sehat',
                'tgl' => '10 Feb 2024',
                'img' => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800',
                'isi' =>
                    'Menjaga kesehatan jantung harus dimulai sejak dini. Hindari rokok, kurangi konsumsi garam berlebih, dan pastikan Anda melakukan aktivitas fisik minimal 30 menit setiap hari untuk menjaga elastisitas pembuluh darah.',
            ],
            [
                'judul' => 'Pentingnya Sayuran Hijau untuk Daya Tahan Tubuh',
                'kategori' => 'Nutrisi',
                'tgl' => '08 Feb 2024',
                'img' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=800',
                'isi' =>
                    'Sayuran seperti bayam dan brokoli mengandung antioksidan tinggi yang membantu sistem imun melawan radikal bebas. Mengonsumsi sayur setiap hari terbukti menurunkan risiko penyakit kronis.',
            ],
            [
                'judul' => 'Mengenal Gejala DBD dan Cara Penanganannya',
                'kategori' => 'Info Medis',
                'tgl' => '05 Feb 2024',
                'img' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=800',
                'isi' =>
                    'Demam Berdarah Dengue (DBD) ditandai dengan demam tinggi mendadak. Penting untuk menjaga hidrasi tubuh dan segera melakukan cek trombosit jika demam tidak turun dalam 3 hari.',
            ],
            [
                'judul' => 'Manfaat Tidur 8 Jam bagi Kesehatan Mental',
                'kategori' => 'Psikologi',
                'tgl' => '01 Feb 2024',
                'img' => 'https://images.unsplash.com/photo-1511295742364-917e70351634?w=800',
                'isi' =>
                    'Kurang tidur dapat menyebabkan gangguan kecemasan dan penurunan fokus. Tidur yang cukup membantu otak melakukan "pembersihan" racun yang menumpuk selama beraktivitas.',
            ],
            [
                'judul' => 'Bahaya Duduk Terlalu Lama bagi Tulang Belakang',
                'kategori' => 'Ortopedi',
                'tgl' => '28 Jan 2024',
                'img' => 'https://images.unsplash.com/photo-1550624559-4bae041e90df?w=800',
                'isi' =>
                    'Gaya hidup sedenter atau terlalu banyak duduk dapat memicu saraf terjepit. Pastikan melakukan peregangan setiap 2 jam sekali saat bekerja di depan laptop.',
            ],
            [
                'judul' => 'Pentingnya Vaksinasi Dewasa yang Sering Terlupakan',
                'kategori' => 'Pencegahan',
                'tgl' => '20 Jan 2024',
                'img' => 'https://images.unsplash.com/photo-1632833230661-4fa31d75ad91?w=800',
                'isi' =>
                    'Vaksin bukan hanya untuk anak-anak. Orang dewasa juga membutuhkan booster seperti vaksin Influenza dan Pneumonia untuk perlindungan ekstra di masa tua.',
            ],
        ];
    @endphp

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Pusat Edukasi Kesehatan</h2>
            <p class="text-muted">Informasi terpercaya untuk hidup lebih sehat bersama HEALTY-ID</p>
        </div>

        <div class="row g-4">
            @foreach ($semua_artikel as $art)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        <img src="{{ $art['img'] }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary-subtle text-primary">{{ $art['kategori'] }}</span>
                                <small class="text-muted">{{ $art['tgl'] }}</small>
                            </div>
                            <h5 class="fw-bold mb-3">{{ $art['judul'] }}</h5>
                            <p class="text-muted small mb-4">{{ $art['isi'] }}</p>
                            <a href="#" class="text-primary fw-bold text-decoration-none small">Baca Selengkapnya <i
                                    class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Newsletter Simple --}}
        <div class="mt-5 p-5 bg-light rounded-4 text-center border">
            <h4 class="fw-bold">Dapatkan Tips Kesehatan Mingguan</h4>
            <p class="text-muted">Daftarkan email Anda untuk menerima informasi kesehatan terbaru langsung di inbox.</p>
            <div class="row justify-content-center mt-4">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Alamat Email Anda">
                        <button class="btn btn-primary px-4">Langganan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
