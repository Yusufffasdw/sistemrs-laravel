<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes scaleIn {
            0% { transform: scale(0.9); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-success { animation: scaleIn 0.4s ease-out forwards; }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl border border-gray-100 p-8 text-center animate-success">
        <div class="mb-6 flex justify-center">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>

        <h1 class="text-2xl font-extrabold text-gray-900 mb-2">Data Pasien Disimpan!</h1>
        <p class="text-gray-500 mb-8">Pendaftaran pasien baru telah berhasil diproses ke dalam sistem.</p>

        <div class="bg-gray-50 rounded-2xl p-4 mb-8 text-left border border-gray-100">
            <div class="flex justify-between py-2 border-b border-gray-200">
                <span class="text-xs font-semibold text-gray-400 uppercase">Status</span>
                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 rounded">AKTIF</span>
            </div>
            <div class="flex justify-between py-2">
                <span class="text-xs font-semibold text-gray-400 uppercase">Waktu Simpan</span>
                <span class="text-xs font-medium text-gray-700">{{ now()->format('d M Y, H:i') }}</span>
            </div>
        </div>

        <div class="space-y-3">
            <a href="{{ route('beranda.index') }}" 
                class="block w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-100 transition-all">
                Kembali ke Beranda
            </a>
            <a href="{{ route('pasien.create') }}" 
                class="block w-full py-3 bg-white border border-gray-200 text-gray-600 font-semibold rounded-xl hover:bg-gray-50 transition-all">
                Tambah Pasien Lain
            </a>
        </div>
        
        <p class="mt-8 text-xs text-gray-400">
            ID Referensi: <span class="font-mono">#REG-{{ rand(1000, 9999) }}</span>
        </p>
    </div>

</body>
</html>