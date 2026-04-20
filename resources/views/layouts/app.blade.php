<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healty-ID | @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8FAFC; }
        .nav-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem; border-radius: 0.75rem; transition: all 0.2s; color: #6b7280; }
        .nav-link:hover { background-color: #f3f4f6; color: #2563eb; }
        .nav-link.active { background-color: #2563eb; color: white; shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2); }
    </style>
     @stack('styles')
</head>
<body class="flex">

    <aside class="w-64 bg-white border-r border-gray-100 h-screen fixed flex flex-col z-50">
        <div class="p-6">
            <div class="flex items-center gap-3 text-blue-600 mb-10">
                <div class="bg-blue-600 p-2 rounded-xl shadow-lg shadow-blue-200">
                    <i data-lucide="hospital" class="w-6 h-6 text-white"></i>
                </div>
                <span class="text-xl font-bold text-gray-800 tracking-tight">HEALTY-ID</span>
            </div>

           <nav class="space-y-2">
    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] ml-3 mb-4">Utama</p>
    
    <a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="home" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Beranda</span>
    </a>
    
    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="layout-grid" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Dashboard</span>
    </a>

    <a href="{{ route('pasien.index') }}" class="nav-link {{ request()->routeIs('pasien.*') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="users" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Data Calon Pasien</span>
    </a>

    <a href="{{ route('dokter.index') }}" class="nav-link {{ request()->routeIs('dokter.*') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="notebook-pen" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Dokter</span>
    </a>

    <a href="{{ route('departemen.index') }}" class="nav-link {{ request()->routeIs('departemen.*') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="building-2" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Departemen</span>
    </a>

    <a href="{{ route('pendaftaran.index') }}" class="nav-link {{ request()->routeIs('pendaftaran.*') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="stethoscope" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Pasien</span>
    </a>

    <a href="{{ route('beranda.jadwal_dokter') }}" class="nav-link {{ request()->routeIs('beranda.jadwal_dokter') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Jadwal Dokter & Janji temu</span>
    </a>

    <a href="{{ route('artikel.index') }}" class="nav-link {{ request()->routeIs('artikel.*') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="newspaper" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Artikel</span>
    </a>

    <hr class="my-4 border-gray-100">

    <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active shadow-lg shadow-blue-100' : '' }}">
        <i data-lucide="user-plus" class="w-5 h-5"></i>
        <span class="font-semibold text-sm">Daftar Akun</span>
    </a>
</nav>
        </div>

        <div class="mt-auto p-6 border-t border-gray-50">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl transition-all font-semibold text-sm group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 ml-64 min-h-screen flex flex-col">
        
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-40 px-10 flex justify-between items-center">
            <div>
                <h2 class="text-sm font-bold text-gray-800 uppercase tracking-widest">
                    @yield('title', 'Sistem Informasi RS')
                </h2>
            </div>
            
            <div class="flex items-center gap-6">
                <div class="text-right">
                    <p class="text-xs font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin Utama' }}</p>
                    <p class="text-[10px] text-green-500 font-medium">Online</p>
                </div>
                <div class="h-10 w-10 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-200">
                    <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                </div>
            </div>
        </header>

        <main class="p-10">
            <div class="max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-start gap-3 shadow-sm">
                        <i data-lucide="check-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl flex items-start gap-3 shadow-sm">
                        <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <footer class="mt-auto py-6 text-center text-gray-400 text-[10px] uppercase tracking-[0.3em] border-t border-gray-50">
            &copy; 2026 🏥 Healty-ID Medical Management
        </footer>
    </div>

    <script>
        // Inisialisasi Lucide Icons agar muncul
        lucide.createIcons();
    </script>
     @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>