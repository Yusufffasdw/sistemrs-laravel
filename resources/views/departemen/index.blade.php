@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Data Departemen</h1>
        <a href="{{ route('departemen.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Departemen
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Nama Departemen</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Telepon</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($departemen as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold">{{ $item->nama }}</td>
                        <td class="px-6 py-4">{{ substr($item->deskripsi ?? '-', 0, 50) }}</td>
                        <td class="px-6 py-4">{{ $item->telepon ?? '-' }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="{{ route('departemen.show', $item->id) }}" class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded text-sm inline-block">
                                Lihat
                            </a>
                            <form action="{{ route('departemen.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah anda yakin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data departemen</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $departemen->links() }}
    </div>
</div>
@endsection