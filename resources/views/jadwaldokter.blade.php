@extends('layouts.navter')

@section('title', 'Jadwal Dokter')

@section('content')
    @php
        $jadwal = [
            [
                'nama' => 'Dr. Ahmad Rizki',
                'spesialis' => 'Dokter Umum',
                'jam_sen_rab' => '08:00 - 14:00',
                'jam_kam_sab' => '13:00 - 18:00',
            ],
            [
                'nama' => 'Dr. Siti Aminah, Sp.A',
                'spesialis' => 'Spesialis Anak',
                'jam_sen_rab' => '10:00 - 15:00',
                'jam_kam_sab' => '08:00 - 12:00',
            ],
            [
                'nama' => 'Dr. Budi Santoso, Sp.KG',
                'spesialis' => 'Spesialis Gigi',
                'jam_sen_rab' => '09:00 - 14:00',
                'jam_kam_sab' => 'Libur',
            ],
            [
                'nama' => 'Dr. Maya Indah, Sp.M',
                'spesialis' => 'Spesialis Mata',
                'jam_sen_rab' => '13:00 - 17:00',
                'jam_kam_sab' => '10:00 - 15:00',
            ],
            [
                'nama' => 'Dr. Andi Wijaya, Sp.JP',
                'spesialis' => 'Spesialis Jantung',
                'jam_sen_rab' => '08:00 - 12:00',
                'jam_kam_sab' => '13:00 - 17:00',
            ],
            [
                'nama' => 'Dr. Dewi Lestari, Sp.OG',
                'spesialis' => 'Spesialis Kandungan',
                'jam_sen_rab' => '15:00 - 20:00',
                'jam_kam_sab' => '09:00 - 13:00',
            ],
        ];
    @endphp

    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Jadwal Praktek</h2>
            <p class="text-muted">Temukan waktu yang tepat untuk konsultasi Anda</p>
        </div>

        <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="py-3 ps-4">Dokter</th>
                            <th>Spesialisasi</th>
                            <th>Senin - Rabu</th>
                            <th>Kamis - Sabtu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $j)
                            <tr>
                                <td class="py-3 ps-4 fw-bold">{{ $j['nama'] }}</td>
                                <td><span class="text-primary fw-medium">{{ $j['spesialis'] }}</span></td>
                                <td><i class="bi bi-clock me-1 text-info"></i> {{ $j['jam_sen_rab'] }}</td>
                                <td>
                                    @if ($j['jam_kam_sab'] == 'Libur')
                                        <span class="badge bg-danger">Libur</span>
                                    @else
                                        <i class="bi bi-clock me-1 text-info"></i> {{ $j['jam_kam_sab'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 text-center">
            <p class="small text-muted italic">* Pendaftaran online maksimal dilakukan 1 hari sebelum jadwal praktek.</p>
            <a href="#" class="btn btn-primary px-4 py-2" style="border-radius: 10px;">Daftar Sekarang</a>
        </div>
    </div>
@endsection
