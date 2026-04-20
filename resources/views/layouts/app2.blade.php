<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Sakit Mitra Sehat')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-900">

   <nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-6 py-3 flex justify-between items-center">
        <a href="/" class="flex items-center gap-3 no-underline group">
            <div class="bg-blue-600 p-2 rounded-lg group-hover:bg-blue-700 transition-colors">
                <span class="text-xl">🏥</span>
            </div>
            <div class="flex flex-col">
                <span class="font-bold text-xl tracking-tight text-blue-900 leading-none">Mitra Sehat</span>
                <span class="text-[10px] uppercase tracking-widest text-blue-600 font-semibold">Hospital Center</span>
            </div>
        </a>

        <div class="hidden md:flex items-center space-x-1">
            <a href="/" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline">
                Beranda
            </a>
            <a href="#layanan" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline">
                Layanan
            </a>
            <a href="{{ route('beranda.jadwal_dokter_publik') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline">
                Jadwal Dokter
            </a>
            <a href="/cek-antrian" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all no-underline">
                Cek Antrian
            </a>
        </div>

        <div class="flex items-center gap-4">
            <a href="/hubungi-kami" class="hidden lg:block text-sm font-medium text-gray-500 hover:text-blue-600 no-underline">
                Bantuan 24 Jam
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-green-700 transition-all no-underline flex items-center gap-2">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-gray-600 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-gray-700 transition-all no-underline flex items-center gap-2">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                
            @endauth
            
            <a href="/daftar" class="bg-blue-600 text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-200 transition-all no-underline flex items-center gap-2">
                <i class="bi bi-calendar-plus"></i> Daftar Pasien
            </a>
        </div>
    </div>
</nav>

    <main>
        @yield('content')
    </main>

    <footer id="kontak" class="bg-white border-t pt-20 pb-10 mt-20">
        <div class="container mx-auto px-6 grid md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-2 font-bold text-2xl text-blue-600 mb-6">
                    <span>🏥</span>
                    <span class="text-blue-900">Mitra Sehat</span>
                </div>
                <p class="text-gray-500 leading-relaxed italic">"Pusat Kesembuhan & Kepedulian Keluarga Anda."</p>
            </div>
            <div>
                <h5 class="font-bold text-gray-900 mb-6">Layanan</h5>
                <ul class="space-y-4 text-gray-600">
                    <li><a href="#" class="hover:text-blue-600">Instalasi Gawat Darurat</a></li>
                    <li><a href="#" class="hover:text-blue-600">Laboratorium Klinik</a></li>
                    <li><a href="#" class="hover:text-blue-600">Medical Check-Up</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-gray-900 mb-6">Bantuan</h5>
                <ul class="space-y-4 text-gray-600">
                    <li><a href="#" class="hover:text-blue-600">Prosedur BPJS</a></li>
                    <li><a href="#" class="hover:text-blue-600">Asuransi Rekanan</a></li>
                    <li><a href="#" class="hover:text-blue-600">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold text-gray-900 mb-6">Alamat</h5>
                <p class="text-gray-600 leading-relaxed">
                    Jl. Kesehatan No. 123<br>
                    Yogyakarta, Indonesia 55123<br>
                    <strong>WhatsApp:</strong> 0812-3456-7890
                </p>
            </div>
        </div>
        <div class="container mx-auto px-6 border-t mt-16 pt-8 text-center text-gray-400 text-sm italic">
            &copy; 2026 Rumah Sakit Mitra Sehat. Dibuat dengan cinta untuk kesehatan Indonesia.
        </div>
    </footer>

    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>