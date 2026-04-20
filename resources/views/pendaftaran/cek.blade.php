@extends('layouts.app2')

@section('content')

<h3 class="fw-bold text-center mb-4">Cek Nomor Antrian</h3>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form method="GET">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            ID Pendaftaran
                        </label>
                        <input type="text" name="keyword"
                               class="form-control"
                               value="{{ request('keyword') }}"
                               placeholder="Masukkan ID pendaftaran">
                    </div>
                    <button class="btn btn-primary w-100">
                        Cek Antrian
                    </button>
                </form>

                @if($data)
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Pasien:</strong> {{ $data->pasien->nama }}
                        </li>
                        <li class="list-group-item">
                            <strong>Dokter:</strong> {{ $data->dokter->nama }}
                        </li>
                        <li class="list-group-item">
                            <strong>No Antrian:</strong>
                            <span class="badge bg-success">
                                {{ $data->nomor_antrian }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <strong>Status:</strong>
                            {{ ucfirst($data->status) }}
                        </li>
                    </ul>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
