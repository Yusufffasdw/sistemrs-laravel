<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pasien Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tambah Pasien Baru</h1>
                <p class="mt-2 text-sm text-gray-600">Pastikan semua informasi medis diisi dengan akurat.</p>
            </div>
            <a href="{{ route('beranda.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                &larr; Kembali ke Beranda
            </a>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
                <div class="flex">
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('pasien.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2 border-b pb-4">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Informasi Pribadi
                </h2>
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none"
                            placeholder="Contoh: Budi Santoso" value="{{ old('nama_lengkap') }}">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('tanggal_lahir') }}">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                            <option value="">Pilih Gender</option>
                            <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Identitas</label>
                        <select name="jenis_identitas" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                            <option value="">Pilih</option>
                            <option value="KTP" {{ old('jenis_identitas') == 'KTP' ? 'selected' : '' }}>KTP</option>
                            <option value="SIM" {{ old('jenis_identitas') == 'SIM' ? 'selected' : '' }}>SIM</option>
                            <option value="Paspor" {{ old('jenis_identitas') == 'Paspor' ? 'selected' : '' }}>Paspor</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Identitas (NIK)</label>
                        <input type="text" name="nomor_identitas" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            placeholder="16 digit nomor identitas" value="{{ old('nomor_identitas') }}">
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Domisili</label>
                        <textarea name="alamat" required rows="3"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            placeholder="Alamat lengkap sesuai KTP">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2 border-b pb-4">
                    <span class="w-2 h-6 bg-green-500 rounded-full"></span>
                    Kontak & Asuransi
                </h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('nomor_telepon') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('email') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Penyedia Asuransi</label>
                        <input type="text" name="asuransi" placeholder="Contoh: BPJS / Prudential"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('asuransi') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Asuransi</label>
                        <input type="text" name="nomor_asuransi" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('nomor_asuransi') }}">
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2 border-b pb-4">
                    <span class="w-2 h-6 bg-red-500 rounded-full"></span>
                    Catatan Medis Penting
                </h2>
                 <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Keluhan</label>
                        <textarea name="keluhan" rows="2"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-300 transition-all outline-none"
                            placeholder="Contoh: Demam, pusing, gatal di bagian tubuh">{{ old('keluhan') }}</textarea>
                    </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Riwayat Alergi</label>
                        <textarea name="riwayat_alergi" rows="2"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-300 transition-all outline-none"
                            placeholder="Sebutkan alergi obat atau makanan jika ada">{{ old('riwayat_alergi') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Riwayat Penyakit</label>
                        <textarea name="riwayat_penyakit" rows="2"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-300 transition-all outline-none"
                            placeholder="Contoh: Hipertensi, Diabetes, dsb">{{ old('riwayat_penyakit') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pb-12">
                <a href="{{ route('beranda') }}" 
                    class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-all">
                    Batal
                </a>
                <button type="submit" 
                    class="px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-200 transition-all transform hover:scale-105 active:scale-95">
                    Simpan Data Pasien
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>