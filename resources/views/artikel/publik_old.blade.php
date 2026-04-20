@extends('layouts.app2') {{-- Sesuaikan dengan layout utama Anda --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Artikel Terbaru</h1>
        <p class="text-gray-600">Temukan informasi dan berita menarik di sini.</p>
    </div>

    {{-- Grid System: 1 kolom di HP, 2 di Tablet, 3 di Desktop --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($artikels as $artikel)
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col h-full">
                {{-- Bagian Gambar --}}
                <div class="relative h-48 w-full overflow-hidden">
                    @if($artikel->gambar)
                        <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-110" 
                             src="{{ asset($artikel->gambar) }}" 
                             alt="{{ $artikel->judul }}">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400 italic">No Image</span>
                        </div>
                    @endif
                    
                    {{-- Badge Kategori --}}
                    @if($artikel->kategori)
                        <span class="absolute top-4 left-4 bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase">
                            {{ $artikel->kategori }}
                        </span>
                    @endif
                </div>

                {{-- Bagian Konten --}}
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <span>{{ $artikel->created_at->format('d M Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $artikel->views }} Kali Dilihat</span>
                    </div>

                    <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                        <a href="{{ route('artikel.show_p', $artikel->slug) }}" class="hover:text-blue-600">
                            {{ $artikel->judul }}
                        </a>
                    </h2>

                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($artikel->konten), 120) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700 italic">
                            Oleh: {{ $artikel->penulis ?? 'Admin' }}
                        </span>
                        <a href="{{ route('artikel.show_p', $artikel->slug) }}" 
                           class="text-blue-600 font-bold text-sm hover:underline">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <p class="text-gray-500 text-xl italic">Belum ada artikel yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12">
        {{ $artikels->links() }}
    </div>
</div>
@endsection