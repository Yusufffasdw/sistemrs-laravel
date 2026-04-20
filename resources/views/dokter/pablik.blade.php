@extends('layouts.app2')

@section('content')
<style>
    body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .card-dokter {
        border-radius: 16px;
        transition: all 0.3s ease;
        background-color: #ffffff;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        padding: 20px;
        border: none;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .card-dokter:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
    }

    /* Wadah Foto */
    .dokter-photo {
        width: 100px;
        height: 100px;
        min-width: 100px;
        min-height: 100px;
        border-radius: 12px;
        overflow: hidden;
        background-color: #e9ecef;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .dokter-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* Wadah Teks */
    .dokter-info {
        margin-left: 25px;
        text-align: left;
        flex-grow: 1;
        min-width: 0; /* penting! biar teks tidak overflow keluar card */
    }

    .dokter-info h5 {
        margin: 0 0 4px 0;
        font-size: 1.1rem;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .text-spesialis {
        color: #6c757d;
        font-size: 0.95rem;
        margin-bottom: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .badge-dept {
        display: inline-block;
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 20px;
        background-color: #e7f1ff;
        color: #0d6efd;
        font-weight: 600;
        margin-bottom: 12px;
    }

    .btn-detail {
        border-radius: 20px;
        padding: 6px 20px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1px solid #0d6efd;
        color: #0d6efd;
        text-decoration: none;
        transition: 0.3s;
        display: inline-block;
    }

    .btn-detail:hover {
        background-color: #0d6efd;
        color: #fff;
    }

    /* Responsif untuk HP */
    @media (max-width: 576px) {
        .card-dokter {
            flex-direction: column;
            text-align: center;
        }
        .dokter-info {
            margin-left: 0;
            margin-top: 15px;
            text-align: center;
        }
        .dokter-info h5,
        .text-spesialis {
            white-space: normal;
        }
    }
</style>

<div class="container py-4">
    <div class="row">
        @foreach ($dokter as $item)
        <div class="col-lg-6">
            <div class="card-dokter shadow-sm">
                <div class="dokter-photo">
                    @if($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}">
                    @else
                        <span style="font-size: 3rem;">👨‍⚕️</span>
                    @endif
                </div>

                <div class="dokter-info">
                    <h5 class="fw-bold">{{ $item->nama }}</h5>
                    <p class="text-spesialis mb-1">{{ $item->spesialisasi }}</p>
                    
                    <div class="badge-dept">
                        {{ $item->departemen->nama ?? 'Umum' }}
                    </div>

                    <div>
                        <a href="{{ route('dokter.show', $item->id) }}" class="btn-detail">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection