@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Data Dokter</h1>
        <a href="{{ route('dokter.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Dokter
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Nama</th>
                    <th class="px-6 py-3 text-left font-semibold">Spesialisasi</th>
                    <th class="px-6 py-3 text-left font-semibold">Departemen</th>
                    <th class="px-6 py-3 text-left font-semibold">No. Induk</th>
                    <th class="px-6 py-3 text-left font-semibold">Email</th>
                    <th class="px-6 py-3 text-left font-semibold">Status</th>
                    <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokter as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $item->nama }}</td>
                        <td class="px-6 py-4">{{ $item->spesialisasi }}</td>
                        <td class="px-6 py-4">
                            {{ $item->departemen->nama ?? '-' }}
                        </td>
                        <td class="px-6 py-4">{{ $item->nomor_induk_dokter }}</td>
                        <td class="px-6 py-4">{{ $item->email ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded text-white text-xs font-semibold
                                {{ $item->status == 'aktif' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center space-x-1">
                            <a href="{{ route('dokter.show', $item->id) }}"
                                class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded text-xs">
                                Lihat
                            </a>

                            <a href="{{ route('dokter.edit', $item->id) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white py-1 px-3 rounded text-xs">
                                Edit
                            </a>

                            <form action="{{ route('dokter.destroy', $item->id) }}"
                                method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-xs">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data dokter
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        
    </div>
</div>
@endsection
