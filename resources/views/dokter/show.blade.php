@extends('layouts.app')

@section('title', 'Admin Dashboard - Detail Dokter')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Breadcrumb & Actions --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Manajemen Profil Dokter</h1>
            <p class="text-sm text-gray-500 mt-1">Melihat data lengkap dan riwayat medis tenaga ahli.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dokter.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                <i data-lucide="chevron-left" class="w-4 h-4 mr-2"></i> Kembali
            </a>
            {{-- Perubahan Warna: Indigo ke Oren --}}
            <a href="{{ route('dokter.edit', $dokter->id) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-orange-500 hover:bg-orange-600 transition">
                <i data-lucide="edit-3" class="w-4 h-4 mr-2"></i> Edit Profil
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Profil Singkat --}}
        <div class="xl:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                {{-- Perubahan: Linear Gradient diganti Biru Solid --}}
                <div class="h-32 bg-blue-600"></div>
                <div class="px-6 pb-6">
                    <div class="relative -mt-16 mb-4 flex justify-center">
                        <div class="p-1 bg-white rounded-2xl shadow-sm">
                            <div class="w-32 h-32 rounded-xl overflow-hidden bg-gray-500 border border-gray-100 flex items-center justify-center">
                                @if($dokter->foto)
                                    <img src="{{ Storage::url($dokter->foto) }}" alt="{{ $dokter->nama }}" class="w-full h-full object-cover">
                                @else
                                    <i data-lucide="user" class="w-16 h-16 text-gray-300"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="text-xl font-bold text-gray-900">{{ $dokter->nama }}</h2>
                        <p class="text-sm font-medium text-blue-600">{{ $dokter->spesialisasi }}</p>
                        <div class="mt-4 flex flex-wrap justify-center gap-2">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                ID: {{ $dokter->nomor_induk_dokter }}
                            </span>
                            @if($dokter->status == 'aktif')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Non-Aktif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-100 px-6 py-4 space-y-4 bg-gray-50/50">
                    <div class="flex items-center text-sm">
                        <i data-lucide="mail" class="w-4 h-4 text-gray-400 mr-3"></i>
                        <span class="text-gray-600 truncate">{{ $dokter->email ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i data-lucide="phone" class="w-4 h-4 text-gray-400 mr-3"></i>
                        <span class="text-gray-600">{{ $dokter->telepon ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center text-sm">
                        <i data-lucide="building" class="w-4 h-4 text-gray-400 mr-3"></i>
                        <span class="text-gray-600">{{ $dokter->departemen->nama ?? 'Umum' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Detail Riwayat & Konten --}}
        <div class="xl:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                
                <div class="border-b border-gray-200 px-6">
                    <nav class="-mb-px flex space-x-8">
                        <button class="border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm">
                            Data Profesional
                        </button>
                    </nav>
                </div>

                <div class="p-8 space-y-10">
                    
                    <section>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-amber-50 rounded-lg">
                                <i data-lucide="graduation-cap" class="w-5 h-5 text-amber-600"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Riwayat Pendidikan</h3>
                        </div>
                        <div class="ml-10 text-gray-600 text-sm leading-relaxed bg-gray-50 p-4 rounded-xl border border-gray-100">
                            @if($dokter->riwayat_pendidikan)
                                {!! nl2br(e($dokter->riwayat_pendidikan)) !!}
                            @else
                                <span class="italic text-gray-400">Data belum diisi.</span>
                            @endif
                        </div>
                    </section>

                    <section>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-blue-50 rounded-lg">
                                <i data-lucide="activity" class="w-5 h-5 text-blue-600"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Keahlian Klinis</h3>
                        </div>
                        <div class="ml-10 grid grid-cols-1 gap-2">
                            @if($dokter->kondisi_klinis)
                                @foreach(explode("\n", $dokter->kondisi_klinis) as $item)
                                    @if(trim($item))
                                    <div class="flex items-start gap-2 text-sm text-gray-600">
                                        <i data-lucide="check-circle-2" class="w-4 h-4 text-green-500 mt-0.5"></i>
                                        {{ $item }}
                                    </div>
                                    @endif
                                @endforeach
                            @else
                                <span class="ml-10 italic text-gray-400 text-sm">Belum ada data keahlian.</span>
                            @endif
                        </div>
                    </section>

                    <section>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-purple-50 rounded-lg">
                                <i data-lucide="award" class="w-5 h-5 text-purple-600"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Prestasi & Penghargaan</h3>
                        </div>
                        <div class="ml-10 bg-blue-50/50 p-4 rounded-xl border border-blue-100 border-dashed">
                            <p class="text-sm text-gray-700 italic">
                                {{ $dokter->prestasi_penghargaan ?? 'Tidak ada data penghargaan.' }}
                            </p>
                        </div>
                    </section>

                    <section>
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-emerald-50 rounded-lg">
                                <i data-lucide="file-text" class="w-5 h-5 text-emerald-600"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900">Seminar & Pelatihan</h3>
                        </div>
                        <div class="ml-10 text-sm text-gray-600">
                            {{ $dokter->seminar ?? 'Belum ada data riwayat seminar.' }}
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection