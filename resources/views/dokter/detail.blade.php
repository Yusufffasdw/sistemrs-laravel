@extends('layouts.app2')

@section('content')
<style>
    /* Background halaman */
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Card utama */
    .card {
        border-radius: 18px;
        overflow: hidden;
    }

    .card-body {
        background: #ffffff;
    }

    /* Icon dokter */
    .fs-1 {
        font-size: 4rem;
    }

    /* Nama dokter */
    h3 {
        color: #2c3e50;
        margin-bottom: 6px;
    }

    /* Badge departemen */
    .badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    /* Tabel detail */
    table {
        margin-top: 20px;
    }

    table th {
        color: #555;
        font-weight: 600;
        padding: 10px 0;
    }

    table td {
        color: #333;
        padding: 10px 0;
    }

    table tr {
        border-bottom: 1px solid #eee;
    }

    table tr:last-child {
        border-bottom: none;
    }

    /* Badge status */
    .bg-success {
        background-color: #28a745 !important;
        padding: 6px 14px;
        font-size: 0.8rem;
        border-radius: 20px;
    }

    /* Tombol kembali */
    .btn-secondary {
        border-radius: 20px;
        padding: 8px 20px;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card shadow-sm border-0">
            <div class="card-body p-5">

                <div class="text-center mb-4">
                    <div class="fs-1 mb-2">👨‍⚕️</div>
                    <h3 class="fw-bold">{{ $dokter->nama }}</h3>
                    <span class="badge bg-primary">
                        {{ $dokter->departemen->nama ?? '-' }}
                    </span>
                </div>

                <table class="table table-borderless">
                    <tr>
                        <th width="30%">Spesialisasi</th>
                        <td>{{ $dokter->spesialisasi }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Induk</th>
                        <td>{{ $dokter->nomor_induk_dokter }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $dokter->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $dokter->telepon ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-success">
                                {{ ucfirst($dokter->status) }}
                            </span>
                        </td>
                    </tr>
                </table>

                <div class="text-center mt-4">
                    <a href="{{ route('daftardokter') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
