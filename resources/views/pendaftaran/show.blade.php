@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Detail Pendaftaran</h1>
            <a href="{{ route('pendaftaran.index') }}"
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-6 pb-6 border-b">
                <h2 class="text-2xl font-bold mb-4">Informasi Pendaftaran</h2>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Tanggal Pendaftaran</label>
                        <p class="text-gray-900">
                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->format('d/m/Y H:i') }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nomor Antrian</label>
                        <p class="text-gray-900">{{ $pendaftaran->nomor_antrian ?? '-' }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Status</label>
                    <span
                        class="px-3 py-1 rounded text-white text-sm font-semibold
                    @if ($pendaftaran->status == 'menunggu') bg-yellow-500
                    @elseif($pendaftaran->status == 'sedang_diperiksa') bg-blue-500
                    @elseif($pendaftaran->status == 'selesai') bg-green-500
                    @elseif($pendaftaran->status == 'batal') bg-red-500 @endif">
                        {{ ucfirst(str_replace('_', ' ', $pendaftaran->status)) }}
                    </span>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Keluhan</label>
                    <p class="text-gray-900">{{ $pendaftaran->keluhan }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Biaya Konsultasi</label>
                    <p class="text-gray-900">
                        @if ($pendaftaran->biaya_konsultasi)
                            Rp {{ number_format($pendaftaran->biaya_konsultasi, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </p>
                </div>

                @if ($pendaftaran->catatan_dokter)
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Catatan Dokter</label>
                        <p class="text-gray-900">{{ $pendaftaran->catatan_dokter }}</p>
                    </div>
                @endif
            </div>

            <div class="mb-6 pb-6 border-b">
                <h2 class="text-2xl font-bold mb-4">Data Pasien</h2>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nama</label>
                        <p class="text-gray-900">{{ $pendaftaran->pasien->nama_lengkap }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">No. Rekam Medis</label>
                        <p class="text-gray-900">{{ $pendaftaran->pasien->nomor_rekam_medis }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nomor Telepon</label>
                        <p class="text-gray-900">{{ $pendaftaran->pasien->nomor_telepon }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <p class="text-gray-900">{{ $pendaftaran->pasien->email ?? '-' }}</p>
                    </div>
                </div>

                <div>
                    <a href="{{ route('pasien.show', $pendaftaran->pasien->id) }}"
                        class="text-blue-500 hover:text-blue-700 underline">
                        Lihat Detail Pasien →
                    </a>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4">Data Dokter</h2>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nama Dokter</label>
                        <p class="text-gray-900">{{ $pendaftaran->dokter->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Spesialisasi</label>
                        <p class="text-gray-900">{{ $pendaftaran->dokter->spesialisasi }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Departemen</label>
                        <p class="text-gray-900">{{ $pendaftaran->dokter->departemen->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email Dokter</label>
                        <p class="text-gray-900">{{ $pendaftaran->dokter->email ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="border-t pt-6">
                <p class="text-sm text-gray-500">
                    Dibuat: {{ $pendaftaran->created_at->format('d/m/Y H:i') }}<br>
                    Diperbarui: {{ $pendaftaran->updated_at->format('d/m/Y H:i') }}
                </p>
            </div>
        </div>
    </div>
@endsection
