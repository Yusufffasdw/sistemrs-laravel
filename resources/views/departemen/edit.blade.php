
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-2xl">
    <h1 class="text-3xl font-bold mb-6">Edit Departemen</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <h3 class="font-bold">Terdapat kesalahan:</h3>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('departemen.update', $departemen->id) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT') <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Departemen</label>
            <input type="text" name="nama" required 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 outline-none" 
                placeholder="Contoh: Kardiologi" 
                value="{{ old('nama', $departemen->nama) }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="deskripsi" 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 outline-none" 
                rows="4" 
                placeholder="Jelaskan departemen ini...">{{ old('deskripsi', $departemen->deskripsi) }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Telepon</label>
            <input type="text" name="telepon" 
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500 outline-none" 
                placeholder="Contoh: 0274-123456" 
                value="{{ old('telepon', $departemen->telepon) }}">
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded transition-all transform hover:scale-105">
                Update Departemen
            </button>
            <a href="{{ route('departemen.index') }}" 
                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded transition-all">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection