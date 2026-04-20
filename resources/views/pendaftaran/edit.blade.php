@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6 max-w-2xl">
        <h1 class="text-3xl font-bold mb-6">Edit Data Pasien</h1>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST"
            class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            {{-- Pasien --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Pasien</label>
                <select name="pasien_id" required class="w-full px-4 py-2 border border-gray-300 rounded">
                    <option value="">Pilih Pasien</option>
                    @foreach ($pasien as $item)
                        <option value="{{ $item->id }}"
                            {{ old('pasien_id', $pendaftaran->pasien_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_lengkap }} ({{ $item->nomor_rekam_medis }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Dokter --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Dokter</label>
                <select name="dokter_id" required class="w-full px-4 py-2 border border-gray-300 rounded">
                    <option value="">Pilih Dokter</option>
                    @foreach ($dokter as $item)
                        <option value="{{ $item->id }}"
                            {{ old('dokter_id', $pendaftaran->dokter_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }} ({{ $item->spesialisasi }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tanggal Daftar --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Tanggal Daftar</label>
                    <input type="datetime-local" name="tanggal_daftar" required
                        class="w-full px-4 py-2 border border-gray-300 rounded"
                        value="{{ old('tanggal_daftar', $pendaftaran->tanggal_daftar->format('Y-m-d\TH:i')) }}">
                </div>
            </div>

            {{-- Keluhan --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Keluhan</label>
                <textarea name="keluhan" required class="w-full px-4 py-2 border border-gray-300 rounded" rows="4"
                    placeholder="Jelaskan keluhan pasien...">{{ old('keluhan', $pendaftaran->keluhan) }}</textarea>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Status Pendaftaran</label>
                <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded">
                    @foreach (['menunggu', 'sedang_diperiksa', 'selesai', 'batal'] as $status)
                        <option value="{{ $status }}"
                            {{ old('status', $pendaftaran->status) == $status ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nomor Antrian --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nomor Antrian</label>
                <input type="number" name="nomor_antrian" class="w-full px-4 py-2 border border-gray-300 rounded"
                    value="{{ old('nomor_antrian', $pendaftaran->nomor_antrian) }}" placeholder="Contoh: 1">
            </div>

            {{-- Catatan Dokter --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Catatan Dokter</label>
                <textarea name="catatan_dokter" class="w-full px-4 py-2 border border-gray-300 rounded" rows="3"
                    placeholder="Catatan pemeriksaan dokter...">{{ old('catatan_dokter', $pendaftaran->catatan_dokter) }}</textarea>
            </div>
            P

            {{-- Biaya --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Biaya Konsultasi</label>
                <input type="number" name="biaya_konsultasi" class="w-full px-4 py-2 border border-gray-300 rounded"
                    step="1000" placeholder="Rp" value="{{ old('biaya_konsultasi', $pendaftaran->biaya_konsultasi) }}">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded">
                    Update
                </button>
                <a href="{{ route('pendaftaran.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
