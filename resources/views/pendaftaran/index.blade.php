@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-800">Pendaftaran Pasien</h1>
                <p class="text-gray-500 text-sm">Kelola antrian dan status pemeriksaan pasien.</p>
            </div>
            <a href="{{ route('pendaftaran.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-lg shadow transition duration-200">
                + Pendaftaran Baru
            </a>
        </div>

        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">
            <table class="w-full text-left">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase">Antrian</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase">Pasien & Dokter</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase text-center">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-600 uppercase text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($pendaftaran as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <span class="text-lg font-bold text-blue-700">#{{ $item->nomor_antrian ?? '-' }}</span>
                                <div class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d/m/Y H:i') }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm font-bold text-gray-900">{{ $item->pasien->nama_lengkap }}</div>
                                <div class="text-xs text-gray-500 italic">dr. {{ $item->dokter->nama }}</div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                @php
                                    $colors = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-700',
                                        'sedang_diperiksa' => 'bg-blue-100 text-blue-700',
                                        'selesai' => 'bg-green-100 text-green-700',
                                        'batal' => 'bg-red-100 text-red-700',
                                    ];
                                    $colorClass = $colors[$item->status] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-wider {{ $colorClass }}">
                                    {{ str_replace('_', ' ', $item->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('pendaftaran.show', $item->id) }}"
                                        class="w-16 text-center bg-emerald-500 hover:bg-emerald-600 text-white py-1.5 rounded text-xs font-semibold shadow-sm transition">
                                        Lihat
                                    </a>

                                    <a href="{{ route('pendaftaran.edit', $item->id) }}"
                                        class="w-16 text-center bg-amber-500 hover:bg-amber-600 text-white py-1.5 rounded text-xs font-semibold shadow-sm transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('pendaftaran.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus data ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-16 text-center bg-red-500 hover:bg-red-600 text-white py-1.5 rounded text-xs font-semibold shadow-sm transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">Belum ada data pendaftaran.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $pendaftaran->links() }}
        </div>
    </div>
@endsection