@extends('layouts.navter')

@section('title', 'Artikel Kesehatan')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Pusat Edukasi Kesehatan</h2>
            <p class="text-muted">Informasi terpercaya untuk hidup lebih sehat</p>
        </div>

        @if(isset($artikels) && $artikels->count() > 0)
        <div class="row g-4">
            @foreach ($artikels as $art)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                        @if($art->gambar)
                            <img src="{{ asset($art->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $art->judul }}">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between mb-2">
                                @if($art->kategori)
                                    <span class="badge bg-primary-subtle text-primary">{{ $art->kategori }}</span>
                                @endif
                                <small class="text-muted">{{ $art->tanggal_formatted }}</small>
                            </div>
                            <h5 class="fw-bold mb-3">{{ $art->judul }}</h5>
                            <p class="text-muted small mb-4">{{ Str::limit(strip_tags($art->konten), 150) }}</p>
                            <a href="{{ route('artikel.show_p', $art) }}" class="text-primary fw-bold text-decoration-none small">
                                Baca Selengkapnya <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $artikels->links() }}
        </div>
        @else
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle me-2"></i>
            Belum ada artikel yang tersedia saat ini.
        </div>
        @endif

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
