@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Detail Departemen</h1>
        <a href="{{ route('departemen.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="grid grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Nama Departemen</label>
                <p class="text-gray-900 text-lg font-semibold">{{ $departemen->nama }}</p>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2">Telepon</label>
                <p class="text-gray-900">{{ $departemen->telepon ?? '-' }}</p>
            </div>
        </div>

        @if($departemen->deskripsi)
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <p class="text-gray-900">{{ $departemen->deskripsi }}</p>
        </div>
        @endif

       
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Dokter di Departemen Ini</h2>

        @if($departemen->dokter->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Nama Dokter</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Spesialisasi</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departemen->dokter as $dokter)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $dokter->nama }}</td>
                                <td class="px-6 py-4">{{ $dokter->spesialisasi }}</td>
                                <td class="px-6 py-4">{{ $dokter->email ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                        @if($dokter->status == 'aktif') bg-green-500
                                        @else bg-red-500
                                        @endif">
                                        {{ ucfirst($dokter->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Tidak ada dokter di departemen ini</p>
        @endif
    </div>
</div>
@endsection