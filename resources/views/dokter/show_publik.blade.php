@extends('layouts.navter')

@section('title', 'Detail Dokter - ' . $dokter->nama)

@section('content')
<style>
    body { background-color: #f0f2f5; }

    .profile-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        max-width: 1150px;
        margin: 50px auto;
        display: flex;
        flex-wrap: wrap;
    }

    /* Sidebar Kiri */
    .profile-sidebar {
        background: #fff;
        width: 320px;
        padding: 35px;
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }

    .doctor-image-wrapper {
        width: 100%;
        aspect-ratio: 1/1;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 25px;
        background: #f8f9fa;
    }

    .doctor-image-wrapper img { width: 100%; height: 100%; object-fit: cover; }

    .sidebar-info h4 { font-weight: 700; color: #222; margin-bottom: 12px; line-height: 1.3; }

    .sidebar-detail { font-size: 0.95rem; color: #666; margin-bottom: 8px; display: flex; align-items: center; }
    .sidebar-detail i { color: #4eb2e9; width: 25px; font-size: 1.1rem; }

    /* Konten Kanan */
    .profile-main { flex: 1; padding: 45px; min-width: 450px; }

    .section-box { margin-bottom: 35px; }

    .section-header { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }

    .icon-box {
        width: 42px; height: 42px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; font-size: 1.2rem;
    }
    .bg-peach { background: #fff3ed; color: #f27c4d; }
    .bg-blue-light { background: #e8f4ff; color: #4eb2e9; }

    .section-label { font-weight: 700; color: #333; font-size: 1.1rem; margin: 0; }

    .content-text { color: #555; font-size: 0.95rem; line-height: 1.6; }
    
    .list-custom { list-style: none; padding-left: 0; margin: 0; }
    .list-custom li { position: relative; padding-left: 20px; margin-bottom: 8px; }
    .list-custom li::before { 
        content: "•"; position: absolute; left: 0; color: #4eb2e9; font-weight: bold; 
    }

    .btn-pilih {
        background-color: #4eb2e9; color: white; border: none;
        padding: 14px; border-radius: 10px; font-weight: 700;
        width: 100%; transition: 0.3s; margin-top: 20px;
    }
    .btn-pilih:hover { background-color: #3a96c7; color: white; transform: translateY(-2px); }

    @media (max-width: 992px) { .profile-sidebar { width: 100%; border-right: none; border-bottom: 1px solid #eee; } }
</style>

<div class="container">
    <div class="profile-container">
        <div class="profile-sidebar">
            <div class="doctor-image-wrapper">
                @if($dokter->foto)
                    <img src="{{ Storage::url($dokter->foto) }}" alt="{{ $dokter->nama }}">
                @else
                    <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                        <i class="bi bi-person-fill text-secondary" style="font-size: 5rem;"></i>
                    </div>
                @endif
            </div>

            <div class="sidebar-info">
                <h4>{{ $dokter->nama }}</h4>
                <div class="sidebar-detail">
                    <i class="bi bi-stethoscope"></i> {{ $dokter->spesialisasi }}
                </div>
                <div class="sidebar-detail">
                    <i class="bi bi-geo-alt"></i> {{ $dokter->departemen->nama ?? 'Umum' }}
                </div>
                @if($dokter->telepon)
                <div class="sidebar-detail">
                    <i class="bi bi-telephone"></i> {{ $dokter->telepon }}
                </div>
                @endif
                <div class="mt-3">
                    @if($dokter->status == 'aktif')
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">● Aktif</span>
                    @else
                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">● Tidak Aktif</span>
                    @endif
                </div>
            </div>

            <button class="btn btn-pilih">Pilih Dokter ini</button>
            <a href="{{ route('daftardokter') }}" class="btn btn-link text-muted mt-3 text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="profile-main">
            <div class="row">
                <div class="col-md-6 section-box">
                    <div class="section-header">
                        <div class="icon-box bg-peach"><i class="bi bi-mortarboard"></i></div>
                        <p class="section-label">Riwayat Pendidikan</p>
                    </div>
                    <div class="content-text">
                        <ul class="list-custom">
                            @foreach(explode("\n", $dokter->riwayat_pendidikan) as $item)
                                @if(trim($item)) <li>{{ $item }}</li> @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 section-box">
                    <div class="section-header">
                        <div class="icon-box bg-blue-light"><i class="bi bi-heart-pulse"></i></div>
                        <p class="section-label">Kondisi Klinis yang Ditangani</p>
                    </div>
                    <div class="content-text">
                        <ul class="list-custom">
                            @foreach(explode("\n", $dokter->kondisi_klinis) as $item)
                                @if(trim($item)) <li>{{ $item }}</li> @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 section-box">
                    <div class="section-header">
                        <div class="icon-box bg-peach"><i class="bi bi-award"></i></div>
                        <p class="section-label">Prestasi & Penghargaan</p>
                    </div>
                    <div class="content-text">
                        <ul class="list-custom">
                            @foreach(explode("\n", $dokter->prestasi_penghargaan) as $item)
                                @if(trim($item)) <li>{{ $item }}</li> @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 section-box">
                    <div class="section-header">
                        <div class="icon-box bg-blue-light"><i class="bi bi-journal-bookmark"></i></div>
                        <p class="section-label">Seminar / Course</p>
                    </div>
                    <div class="content-text">
                        <ul class="list-custom">
                            @foreach(explode("\n", $dokter->seminar) as $item)
                                @if(trim($item)) <li>{{ $item }}</li> @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection