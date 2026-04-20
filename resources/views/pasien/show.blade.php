@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detail Pasien</h1>
        <a href="{{ route('pasien.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-blue-500">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2 text-blue-600">Informasi Pribadi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500">Nama Lengkap</label>
                        <p class="font-medium text-lg text-gray-900">{{ $pasien->nama_lengkap }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">No. Rekam Medis</label>
                        <p class="font-mono font-bold text-lg text-red-600">{{ $pasien->nomor_rekam_medis }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Tempat, Tanggal Lahir</label>
                        <p class="text-gray-900">{{ $pasien->tanggal_lahir }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Jenis Kelamin</label>
                        <p class="text-gray-900">{{ ucfirst($pasien->jenis_kelamin) }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Identitas ({{ $pasien->jenis_identitas }})</label>
                        <p class="text-gray-900">{{ $pasien->nomor_identitas }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Email</label>
                        <p class="text-gray-900">{{ $pasien->email ?? '-' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-500">Alamat</label>
                        <p class="text-gray-900">{{ $pasien->alamat }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-red-500">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2 text-red-600">Riwayat Medis</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-bold text-gray-700">Riwayat Alergi</label>
                        <div class="mt-1 p-3 bg-red-50 text-red-700 rounded border border-red-100">
                            {{ $pasien->riwayat_alergi ?? 'Tidak ada riwayat alergi' }}
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Riwayat Penyakit</label>
                        <div class="mt-1 p-3 bg-gray-50 text-gray-700 rounded border border-gray-200 italic">
                            {{ $pasien->riwayat_penyakit ?? 'Tidak ada riwayat penyakit sebelumnya' }}
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-bold text-gray-700">Keluhan Saat Ini</label>
                        <div class="mt-1 p-3 bg-red-50 text-gray-700 rounded border border-red-100 italic">
                            {{ $pasien->keluhan ?? 'Tidak ada keluhan yang dicatat' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-green-500">
                <h2 class="text-lg font-semibold mb-3 text-green-700">Informasi Asuransi</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-xs text-gray-500 uppercase">Penyedia Asuransi</label>
                        <p class="font-medium">{{ $pasien->asuransi ?? 'Umum / Mandiri' }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 uppercase">Nomor Asuransi</label>
                        <p class="font-medium">{{ $pasien->nomor_asuransi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6 border-l-4 border-yellow-500">
                <h2 class="text-lg font-semibold mb-3 text-yellow-700">Kontak Darurat</h2>
                <div class="space-y-3">
                    <div>
                        <label class="text-xs text-gray-500 uppercase">Nama Kontak</label>
                        <p class="font-medium">{{ $pasien->nama_kontak_darurat ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 uppercase">No. Telepon</label>
                        <p class="font-medium text-blue-600">{{ $pasien->telepon_kontak_darurat ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 flex flex-col space-y-2">
                <a href="{{ route('pasien.edit', $pasien->id) }}" class="text-center bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
                    Edit Data Pasien
                </a>
                <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full text-center bg-red-100 hover:bg-red-200 text-red-700 font-bold py-2 px-4 rounded transition">
                        Hapus Pasien
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection