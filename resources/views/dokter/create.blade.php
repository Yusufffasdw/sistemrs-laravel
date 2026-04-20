@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-3xl font-bold mb-6">Tambah Dokter Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('dokter.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Nama Dokter</label>
                <input type="text" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded" value="{{ old('nama') }}">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Spesialisasi</label>
                <input type="text" name="spesialisasi" required class="w-full px-4 py-2 border border-gray-300 rounded" value="{{ old('spesialisasi') }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Departemen</label>
                <select name="departemen_id" required class="w-full px-4 py-2 border border-gray-300 rounded">
                    <option value="">Pilih Departemen</option>
                    @foreach ($departemen as $item)
                        <option value="{{ $item->id }}" {{ old('departemen_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">No. Induk Dokter</label>
                <input type="text" name="nomor_induk_dokter" required class="w-full px-4 py-2 border border-gray-300 rounded" value="{{ old('nomor_induk_dokter') }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Telepon</label>
                <input type="text" name="telepon" class="w-full px-4 py-2 border border-gray-300 rounded" value="{{ old('telepon') }}">
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded" value="{{ old('email') }}">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Status</label>
            <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded">
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <!-- Kolom Tambahan (Tidak Wajib) -->
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Riwayat Pendidikan <span class="text-sm text-gray-500">(Opsional)</span></label>
            <textarea name="riwayat_pendidikan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Contoh: S1 Kedokteran Universitas Indonesia, Spesialis Penyakit Dalam RS Cipto">{{ old('riwayat_pendidikan') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Prestasi & Penghargaan <span class="text-sm text-gray-500">(Opsional)</span></label>
            <textarea name="prestasi_penghargaan" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Contoh: Best Doctor Award 2023, Penelitian Terbaik Kardiologi">{{ old('prestasi_penghargaan') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kondisi Klinis yang Ditangani <span class="text-sm text-gray-500">(Opsional)</span></label>
            <textarea name="kondisi_klinis" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Contoh: Jantung Koroner, Hipertensi, Diabetes">{{ old('kondisi_klinis') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Seminar & Pelatihan <span class="text-sm text-gray-500">(Opsional)</span></label>
            <textarea name="seminar" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Contoh: Seminar Kardiologi Internasional 2023, Workshop Minimal Invasive Surgery">{{ old('seminar') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Foto Dokter <span class="text-sm text-gray-500">(Opsional, maks 2MB)</span></label>
            <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png,image/webp"
                class="w-full px-4 py-2 border border-gray-300 rounded bg-white">
            <p class="text-xs text-gray-400 mt-1">Format: JPG, JPEG, PNG, WEBP</p>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Simpan
            </button>
            <a href="{{ route('dokter.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection