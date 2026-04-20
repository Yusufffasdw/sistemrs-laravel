@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800">Data Calon Pasien</h1>
                <p class="text-gray-500 text-sm">Kelola informasi data diri dan rekam medis pasien.</p>
            </div>
            <a href="{{ route('pasien.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-lg shadow-sm transition duration-200">
                + Tambah Pasien
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm rounded-r-lg">
                <span class="font-medium">Berhasil!</span> {{ $message }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">No. RM</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">Identitas Pasien</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider">Telepon</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">Asuransi</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pasien as $item)
                        <tr class="hover:bg-blue-50/30 transition duration-150">
                            <td class="px-6 py-4 font-mono text-sm font-semibold text-blue-600">
                                {{ $item->nomor_rekam_medis }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">{{ $item->nama_lengkap }}</div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">
                                    {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $item->nomor_telepon }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded text-[10px] font-bold {{ $item->asuransi ? 'bg-indigo-100 text-indigo-700' : 'bg-gray-100 text-gray-500' }}">
                                    {{ $item->asuransi ?? 'UMUM' }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('pasien.show', $item->id) }}"
                                        class="w-16 text-center bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded text-xs font-bold transition">
                                        Lihat
                                    </a>

                                    <a href="{{ route('pasien.edit', $item->id) }}"
                                        class="w-16 text-center bg-amber-500 hover:bg-amber-600 text-white py-1.5 rounded text-xs font-bold transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('pasien.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus data pasien ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-16 text-center bg-red-500 hover:bg-red-600 text-white py-1.5 rounded text-xs font-bold transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">
                                Belum ada data pasien yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $pasien->links() }}
        </div>
    </div>
@endsection