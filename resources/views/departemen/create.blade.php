@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-3xl font-bold mb-6">Tambah Departemen Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departemen.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Departemen</label>
            <input type="text" name="nama" required class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Contoh: Kardiologi" value="{{ old('nama') }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="deskripsi" class="w-full px-4 py-2 border border-gray-300 rounded" rows="4" placeholder="Jelaskan departemen ini...">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Telepon</label>
            <input type="text" name="telepon" class="w-full px-4 py-2 border border-gray-300 rounded" placeholder="Contoh: 0274-123456" value="{{ old('telepon') }}">
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                Simpan
            </button>
            <a href="{{ route('departemen.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection