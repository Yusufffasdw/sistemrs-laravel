@extends('layouts.app2')

@section('content')
    <div class="container mx-auto px-4 pt-12 pb-8">
        <div class="max-w-3xl">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">
                Temukan <span class="text-cyan-600">Tenaga Medis</span> Profesional
            </h1>
            <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                Pilih dari daftar dokter spesialis terbaik kami yang siap memberikan pelayanan kesehatan prima.
                Setiap dokter kami telah terverifikasi dan berdedikasi untuk kenyamanan serta kesembuhan Anda.
            </p>

            <div class="mt-6 flex flex-wrap gap-4 text-sm font-medium text-gray-500">
                <div class="flex items-center">
                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2"></span>
                    {{ $dokters->count() }} Dokter Aktif
                </div>
                <div class="flex items-center">
                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                    Pelayanan Terpadu
                </div>
                <div class="flex items-center">
                    <span class="w-2 h-2 rounded-full bg-cyan-500 mr-2"></span>
                    Fasilitas Modern
                </div>
            </div>
        </div>

        <div class="mt-8 border-b border-gray-100"></div>
    </div>

   <div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @foreach($dokters as $dokter)
        <div class="bg-white rounded-2xl shadow-md p-6 flex items-start space-x-5 border border-gray-100 hover:shadow-xl transition-shadow duration-300">
            
            <div class="flex-shrink-0">
                <div class="w-24 h-32 overflow-hidden rounded-xl bg-gray-100">
                    <img 
                        src="{{ $dokter->foto ? asset('storage/'.$dokter->foto) : 'https://ui-avatars.com/api/?name='.urlencode($dokter->nama).'&background=e0f7fa&color=00acc1' }}" 
                        alt="{{ $dokter->nama }}"
                        class="w-full h-full object-cover"
                    >
                </div>
            </div>

            <div class="flex-grow">
                <h2 class="text-lg font-bold text-gray-900 leading-snug line-clamp-2">
                    {{ $dokter->nama }}
                </h2>
                
                <div class="mt-4 space-y-3">
                    <div class="flex items-center text-cyan-600">
                        <span class="p-1.5 bg-cyan-50 rounded-lg mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </span>
                        <p class="text-sm font-semibold tracking-wide uppercase">
                            {{ $dokter->spesialisasi }}
                        </p>
                    </div>

                    <div class="flex items-center text-gray-500">
                        <span class="p-1.5 bg-gray-50 rounded-lg mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        <p class="text-sm">
                            {{ $dokter->departemen->nama ?? 'Mitra Keluarga Kemayoran' }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-100">
                    <a href="{{ route('dokter.show', $dokter->id) }}" class="inline-flex items-center text-cyan-500 font-bold text-sm tracking-wider hover:text-cyan-600 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        LIHAT PROFIL
                    </a>
                </div>
            </div>

        </div>
        @endforeach

    </div>
</div>
@endsection
