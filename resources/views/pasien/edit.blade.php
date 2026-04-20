<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Calon Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Data Calon Pasien</h1>
                <p class="mt-2 text-sm text-gray-600">Perbarui informasi medis pasien dengan teliti.</p>
            </div>
            <a href="{{ route('pasien.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                &larr; Kembali ke List
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

        <form action="{{ route('pasien.update', $pasien->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT') <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2 border-b pb-4">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Informasi Pribadi
                </h2>
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none"
                            placeholder="Contoh: Budi Santoso" value="{{ old('nama_lengkap', $pasien->nama_lengkap) }}">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}">
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                            <option value="laki-laki" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="perempuan" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Identitas</label>
                        <select name="jenis_identitas" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                            <option value="KTP" {{ old('jenis_identitas', $pasien->jenis_identitas) == 'KTP' ? 'selected' : '' }}>KTP</option>
                            <option value="SIM" {{ old('jenis_identitas', $pasien->jenis_identitas) == 'SIM' ? 'selected' : '' }}>SIM</option>
                            <option value="Paspor" {{ old('jenis_identitas', $pasien->jenis_identitas) == 'Paspor' ? 'selected' : '' }}>Paspor</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Identitas (NIK)</label>
                        <input type="text" name="nomor_identitas" required 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            placeholder="16 digit nomor identitas" value="{{ old('nomor_identitas', $pasien->nomor_identitas) }}">
                    </div>

                    <div class="sm:col-span-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Domisili</label>
                        <textarea name="alamat" required rows="3"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            placeholder="Alamat lengkap sesuai KTP">{{ old('alamat', $pasien->alamat) }}</textarea>
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
                            value="{{ old('nomor_telepon', $pasien->nomor_telepon) }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('email', $pasien->email) }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Penyedia Asuransi</label>
                        <input type="text" name="asuransi" placeholder="Contoh: BPJS / Prudential"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('asuransi', $pasien->asuransi) }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nomor Asuransi</label>
                        <input type="text" name="nomor_asuransi" 
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none"
                            value="{{ old('nomor_asuransi', $pasien->nomor_asuransi) }}">
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm border border-gray-100 rounded-2xl p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2 border-b pb-4">
                    <span class="w-2 h-6 bg-red-500 rounded-full"></span>
                    Catatan Medis Penting
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Keluhan Utama</label>
                        <textarea name="keluhan" rows="2"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-300 transition-all outline-none"
                            placeholder="Keluhan saat ini">{{ old('keluhan', $pasien->keluhan) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Riwayat Alergi</label>
                        <textarea name="riwayat_alergi" rows="2"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-300 transition-all outline-none"
                            placeholder="Sebutkan alergi obat atau makanan jika ada">{{ old('riwayat_alergi', $pasien->riwayat_alergi) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Riwayat Penyakit</label>
                        <textarea name="riwayat_penyakit" rows="2"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-red-300 transition-all outline-none"
                            placeholder="Contoh: Hipertensi, Diabetes, dsb">{{ old('riwayat_penyakit', $pasien->riwayat_penyakit) }}</textarea>
                    </div>
                </div>
            </div>


            <div class="flex items-center justify-end gap-4 pb-12">
                <a href="{{ route('pasien.index') }}" 
                    class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-all">
                    Batal
                </a>
                <button type="submit" 
                    class="px-10 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all transform hover:scale-105 active:scale-95">
                    Update Data Pasien
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>