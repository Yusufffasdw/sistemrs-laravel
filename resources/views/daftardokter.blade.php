@extends('layouts.navter')

@section('title', 'Daftar Dokter')

@section('content')
    @php
        // Data Static
        $dokter = [
            ['nama' => 'Dr. Ahmad Rizki', 'spesialisasi' => 'Dokter Umum', 'no_induk' => 'DOK001', 'status' => 'Aktif'],
            [
                'nama' => 'Dr. Siti Aminah, Sp.A',
                'spesialisasi' => 'Spesialis Anak',
                'no_induk' => 'DOK002',
                'status' => 'Aktif',
            ],
            [
                'nama' => 'Dr. Budi Santoso, Sp.KG',
                'spesialisasi' => 'Spesialis Gigi',
                'no_induk' => 'DOK003',
                'status' => 'Aktif',
            ],
            [
                'nama' => 'Dr. Maya Indah, Sp.M',
                'spesialisasi' => 'Spesialis Mata',
                'no_induk' => 'DOK004',
                'status' => 'Aktif',
            ],
            [
                'nama' => 'Dr. Andi Wijaya, Sp.JP',
                'spesialisasi' => 'Spesialis Jantung',
                'no_induk' => 'DOK005',
                'status' => 'Aktif',
            ],
            [
                'nama' => 'Dr. Dewi Lestari, Sp.OG',
                'spesialisasi' => 'Spesialis Kandungan',
                'no_induk' => 'DOK006',
                'status' => 'Aktif',
            ],
        ];
    @endphp

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Daftar Dokter Ahli</h2>
            <p class="text-muted">Tenaga medis profesional HEALTY-ID</p>
            <hr class="mx-auto" style="width: 50px; height: 3px; background: #0d6efd;">
        </div>

        <div class="row g-4">
            @foreach ($dokter as $d)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm p-3" style="border-radius: 20px; transition: 0.3s;">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 45px; height: 45px;">
                                    <i class="bi bi-person-vcard fs-5"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="mb-0 fw-bold">{{ $d['nama'] }}</h6>
                                    <small class="text-muted">{{ $d['no_induk'] }}</small>
                                </div>
                            </div>
                            <p class="mb-1 text-muted">Spesialisasi:</p>
                            <h6 class="fw-bold">{{ $d['spesialisasi'] }}</h6>
                            <div class="mt-3">
                                <span class="badge bg-success-subtle text-success border border-success px-3">●
                                    {{ $d['status'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .card:hover {
            transform: translateY(-10px);
        }
    </style>
@endsection
