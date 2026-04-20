@extends('layouts.app')

@section('title', 'Admin Dashboard - Edit Dokter')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Breadcrumb --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Profil Dokter</h1>
            <p class="text-sm text-gray-500 mt-1">Perbarui informasi profesional dan data medis dokter.</p>
        </div>
        <a href="{{ route('dokter.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
            <i data-lucide="chevron-left" class="w-4 h-4 mr-2"></i> Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i data-lucide="alert-circle" class="h-5 h-5 text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-red-700 font-bold">Terjadi kesalahan input:</p>
                    <ul class="mt-1 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            {{-- Header Form --}}
            <div class="h-24 bg-blue-600 flex items-center px-8">
                <h2 class="text-white font-bold text-lg flex items-center gap-2">
                    <i data-lucide="user-cog" class="w-5 h-5"></i>
                    Informasi Dasar
                </h2>
            </div>

            <div class="p-8 space-y-6">
                {{-- Baris 1: Nama & Spesialisasi --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            value="{{ old('nama', $dokter->nama) }}" placeholder="dr. Nama Dokter, Sp.X">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Bidang Spesialisasi</label>
                        <input type="text" name="spesialisasi" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            value="{{ old('spesialisasi', $dokter->spesialisasi) }}" placeholder="Contoh: Penyakit Dalam">
                    </div>
                </div>

                {{-- Baris 2: Departemen & No. Induk --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Unit Departemen</label>
                        <select name="departemen_id" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none appearance-none bg-no-repeat bg-right"
                            style="background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C/polyline%3E%3C/svg%3E'); background-position: right 1rem center; background-size: 1em;">
                            <option value="">Pilih Departemen</option>
                            @foreach ($departemen as $item)
                                <option value="{{ $item->id }}" {{ old('departemen_id', $dokter->departemen_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">No. Induk Dokter (NID)</label>
                        <input type="text" name="nomor_induk_dokter" required
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            value="{{ old('nomor_induk_dokter', $dokter->nomor_induk_dokter) }}">
                    </div>
                </div>

                {{-- Baris 3: Kontak --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                            </span>
                            <input type="text" name="telepon"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                value="{{ old('telepon', $dokter->telepon) }}">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email Aktif</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                            </span>
                            <input type="email" name="email"
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                                value="{{ old('email', $dokter->email) }}">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status Keanggotaan</label>
                        <div class="flex gap-4">
                            <label class="flex-1">
                                <input type="radio" name="status" value="aktif" class="hidden peer" {{ old('status', $dokter->status) == 'aktif' ? 'checked' : '' }}>
                                <div class="text-center py-2 border rounded-xl cursor-pointer transition-all peer-checked:bg-green-50 peer-checked:border-green-500 peer-checked:text-green-700 border-gray-200 text-gray-500">
                                    Aktif
                                </div>
                            </label>
                            <label class="flex-1">
                                <input type="radio" name="status" value="nonaktif" class="hidden peer" {{ old('status', $dokter->status) == 'nonaktif' ? 'checked' : '' }}>
                                <div class="text-center py-2 border rounded-xl cursor-pointer transition-all peer-checked:bg-red-50 peer-checked:border-red-500 peer-checked:text-red-700 border-gray-200 text-gray-500">
                                    Non-Aktif
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100 my-4">

                {{-- Detail Profesional --}}
                <div class="space-y-6">
                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-amber-500"></i> Riwayat Pendidikan
                        </label>
                        <textarea name="riwayat_pendidikan" rows="3" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                            placeholder="Tuliskan riwayat pendidikan...">{{ old('riwayat_pendidikan', $dokter->riwayat_pendidikan) }}</textarea>
                    </div>

                    <div>
                        <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                            <i data-lucide="activity" class="w-4 h-4 text-blue-500"></i> Keahlian Klinis
                        </label>
                        <textarea name="kondisi_klinis" rows="3" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all"
                            placeholder="Tuliskan kondisi klinis yang ditangani...">{{ old('kondisi_klinis', $dokter->kondisi_klinis) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                                <i data-lucide="award" class="w-4 h-4 text-purple-500"></i> Prestasi
                            </label>
                            <textarea name="prestasi_penghargaan" rows="3" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">{{ old('prestasi_penghargaan', $dokter->prestasi_penghargaan) }}</textarea>
                        </div>
                        <div>
                            <label class="flex items-center gap-2 text-sm font-bold text-gray-700 mb-2">
                                <i data-lucide="file-text" class="w-4 h-4 text-emerald-500"></i> Seminar
                            </label>
                            <textarea name="seminar" rows="3" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">{{ old('seminar', $dokter->seminar) }}</textarea>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100 my-4">

                {{-- Unggah Foto --}}
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                    <label class="block text-sm font-bold text-gray-700 mb-4">Pas Foto Dokter</label>
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        @if($dokter->foto)
                            <div class="relative group">
                                <img src="{{ Storage::url($dokter->foto) }}" alt="Foto"
                                    class="w-28 h-28 object-cover rounded-2xl border-4 border-white shadow-md transition group-hover:opacity-75">
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-xs text-white font-bold bg-black/40 rounded-2xl">
                                    Foto Saat Ini
                                </div>
                            </div>
                        @endif
                        <div class="flex-1 w-full">
                            <input type="file" name="foto" accept="image/*"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer border border-dashed border-gray-300 p-2 rounded-2xl bg-white">
                            <p class="text-xs text-gray-400 mt-2 italic">* Format: JPG, PNG, WEBP. Maksimum ukuran file 2MB.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Form / Tombol Aksi --}}
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('dokter.index') }}" 
                   class="px-6 py-2.5 text-sm font-bold text-gray-700 hover:text-gray-900 transition">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center px-8 py-2.5 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-xl shadow-lg shadow-orange-200 transition-all transform hover:-translate-y-0.5 active:scale-95">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection