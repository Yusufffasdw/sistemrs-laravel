<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departemen;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\User;
use App\Models\Artikel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // Seed Users
        // =====================
        $users = [
            [
                'name'     => 'yzn',
                'email'    => 'a@a',
                'password' => Hash::make('12345678'),
            ],
            [
                'name'     => '',
                'email'    => 'admin@healty-id.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name'     => 'Dr. Admin',
                'email'    => 'dokter@healty-id.com',
                'password' => Hash::make('dokter123'),
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(['email' => $user['email']], $user);
        }

        $this->command->info('✅ Users seeded!');

        // =====================
        // Seed Departemen
        // =====================
        $departemen = [
            ['nama' => 'Poli Umum',      'deskripsi' => 'Pelayanan kesehatan umum'],
            ['nama' => 'Poli Anak',      'deskripsi' => 'Pelayanan kesehatan anak'],
            ['nama' => 'Poli Gigi',      'deskripsi' => 'Pelayanan kesehatan gigi dan mulut'],
            ['nama' => 'Poli Mata',      'deskripsi' => 'Pelayanan kesehatan mata'],
            ['nama' => 'Poli Jantung',   'deskripsi' => 'Pelayanan kesehatan jantung dan pembuluh darah'],
            ['nama' => 'Poli Kandungan', 'deskripsi' => 'Pelayanan kesehatan ibu dan kandungan'],
        ];

        foreach ($departemen as $d) {
            Departemen::firstOrCreate(['nama' => $d['nama']], $d);
        }

        $this->command->info('✅ Departemen seeded!');

        // =====================
        // Seed Dokter
        // =====================
        $dokter = [
            [
                'nama'               => 'Dr. Ahmad Rizki',
                'spesialisasi'       => 'Dokter Umum',
                'departemen'         => 'Poli Umum',
                'nomor_induk_dokter' => 'DOK001',
                'telepon'            => '081234567801',
                'email'              => 'ahmad.rizki@hospital.com',
                'status'             => 'aktif',
            ],
            [
                'nama'               => 'Dr. Siti Aminah, Sp.A',
                'spesialisasi'       => 'Spesialis Anak',
                'departemen'         => 'Poli Anak',
                'nomor_induk_dokter' => 'DOK002',
                'telepon'            => '081234567802',
                'email'              => 'siti.aminah@hospital.com',
                'status'             => 'aktif',
            ],
            [
                'nama'               => 'Dr. Budi Santoso, Sp.KG',
                'spesialisasi'       => 'Spesialis Gigi',
                'departemen'         => 'Poli Gigi',
                'nomor_induk_dokter' => 'DOK003',
                'telepon'            => '081234567803',
                'email'              => 'budi.santoso@hospital.com',
                'status'             => 'aktif',
            ],
            [
                'nama'               => 'Dr. Maya Indah, Sp.M',
                'spesialisasi'       => 'Spesialis Mata',
                'departemen'         => 'Poli Mata',
                'nomor_induk_dokter' => 'DOK004',
                'telepon'            => '081234567804',
                'email'              => 'maya.indah@hospital.com',
                'status'             => 'aktif',
            ],
            [
                'nama'               => 'Dr. Andi Wijaya, Sp.JP',
                'spesialisasi'       => 'Spesialis Jantung',
                'departemen'         => 'Poli Jantung',
                'nomor_induk_dokter' => 'DOK005',
                'telepon'            => '081234567805',
                'email'              => 'andi.wijaya@hospital.com',
                'status'             => 'aktif',
            ],
            [
                'nama'               => 'Dr. Dewi Lestari, Sp.OG',
                'spesialisasi'       => 'Spesialis Kandungan',
                'departemen'         => 'Poli Kandungan',
                'nomor_induk_dokter' => 'DOK006',
                'telepon'            => '081234567806',
                'email'              => 'dewi.lestari@hospital.com',
                'status'             => 'aktif',
            ],
        ];

        foreach ($dokter as $d) {
            $dept = Departemen::where('nama', $d['departemen'])->first();

            if (! $dept) {
                $this->command->warn("⚠️  Departemen '{$d['departemen']}' tidak ditemukan, skip dokter {$d['nama']}.");
                continue;
            }

            Dokter::firstOrCreate(
                ['nomor_induk_dokter' => $d['nomor_induk_dokter']],
                [
                    'nama'               => $d['nama'],
                    'spesialisasi'       => $d['spesialisasi'],
                    'departemen_id'      => $dept->id,
                    'telepon'            => $d['telepon'],
                    'email'              => $d['email'],
                    'status'             => $d['status'],
                ]
            );
        }

        $this->command->info('✅ Dokter seeded!');

        // =====================
        // Seed Pasien
        // =====================
        $pasien = [
            [
                'nomor_rekam_medis'      => '000001',
                'nama_lengkap'           => 'Rina Kusuma',
                'tanggal_lahir'          => '1990-05-15',
                'jenis_kelamin'          => 'perempuan',
                'alamat'                 => 'Jl. Merdeka No. 123, Jakarta',
                'nomor_telepon'          => '081234567890',
                'email'                  => 'rina.kusuma@email.com',
                'nomor_identitas'        => '3171234567890001',
                'jenis_identitas'        => 'KTP',
                'asuransi'               => 'BPJS Kesehatan',
                'nomor_asuransi'         => '0001234567890',
                'nama_kontak_darurat'    => 'Budi Kusuma',
                'telepon_kontak_darurat' => '081234567891',
                'riwayat_alergi'         => 'Alergi seafood',
                'riwayat_penyakit'       => 'Tidak ada',
            ],
            [
                'nomor_rekam_medis'      => '000002',
                'nama_lengkap'           => 'Agus Setiawan',
                'tanggal_lahir'          => '1985-08-20',
                'jenis_kelamin'          => 'laki-laki',
                'alamat'                 => 'Jl. Sudirman No. 456, Bandung',
                'nomor_telepon'          => '081234567892',
                'email'                  => 'agus.setiawan@email.com',
                'nomor_identitas'        => '3271234567890002',
                'jenis_identitas'        => 'KTP',
                'asuransi'               => null,
                'nomor_asuransi'         => null,
                'nama_kontak_darurat'    => 'Sri Setiawan',
                'telepon_kontak_darurat' => '081234567893',
                'riwayat_alergi'         => 'Tidak ada',
                'riwayat_penyakit'       => 'Hipertensi',
            ],
            [
                'nomor_rekam_medis'      => '000003',
                'nama_lengkap'           => 'Putri Handayani',
                'tanggal_lahir'          => '1995-03-10',
                'jenis_kelamin'          => 'perempuan',
                'alamat'                 => 'Jl. Asia Afrika No. 789, Surabaya',
                'nomor_telepon'          => '081234567894',
                'email'                  => 'putri.handayani@email.com',
                'nomor_identitas'        => '3571234567890003',
                'jenis_identitas'        => 'KTP',
                'asuransi'               => 'Prudential',
                'nomor_asuransi'         => '0003456789012',
                'nama_kontak_darurat'    => 'Ibu Handayani',
                'telepon_kontak_darurat' => '081234567895',
                'riwayat_alergi'         => 'Alergi debu',
                'riwayat_penyakit'       => 'Asma',
            ],
            [
                'nomor_rekam_medis'      => '000004',
                'nama_lengkap'           => 'Dedi Prasetyo',
                'tanggal_lahir'          => '2000-12-25',
                'jenis_kelamin'          => 'laki-laki',
                'alamat'                 => 'Jl. Gatot Subroto No. 321, Medan',
                'nomor_telepon'          => '081234567896',
                'email'                  => 'dedi.prasetyo@email.com',
                'nomor_identitas'        => '1271234567890004',
                'jenis_identitas'        => 'KTP',
                'asuransi'               => 'BPJS Kesehatan',
                'nomor_asuransi'         => '0004567890123',
                'nama_kontak_darurat'    => 'Ayah Prasetyo',
                'telepon_kontak_darurat' => '081234567897',
                'riwayat_alergi'         => 'Tidak ada',
                'riwayat_penyakit'       => 'Tidak ada',
            ],
            [
                'nomor_rekam_medis'      => '000005',
                'nama_lengkap'           => 'Lina Marlina',
                'tanggal_lahir'          => '1988-07-18',
                'jenis_kelamin'          => 'perempuan',
                'alamat'                 => 'Jl. Diponegoro No. 654, Semarang',
                'nomor_telepon'          => '081234567898',
                'email'                  => 'lina.marlina@email.com',
                'nomor_identitas'        => '3371234567890005',
                'jenis_identitas'        => 'KTP',
                'asuransi'               => null,
                'nomor_asuransi'         => null,
                'nama_kontak_darurat'    => 'Suami Marlina',
                'telepon_kontak_darurat' => '081234567899',
                'riwayat_alergi'         => 'Alergi antibiotik',
                'riwayat_penyakit'       => 'Diabetes',
            ],
        ];

        foreach ($pasien as $p) {
            Pasien::firstOrCreate(['nomor_rekam_medis' => $p['nomor_rekam_medis']], $p);
        }

        $this->command->info('✅ Pasien seeded!');

        // =====================
        // Seed Pendaftaran
        // =====================
        $today     = Carbon::today();
        $yesterday = Carbon::yesterday();
        $tomorrow  = Carbon::tomorrow();

        // Lookup by identifier unik agar tidak bergantung pada ID hardcoded
        $pasienMap = Pasien::pluck('id', 'nomor_rekam_medis');
        $dokterMap = Dokter::pluck('id', 'nomor_induk_dokter');

        $pendaftaran = [
            [
                'nomor_rekam_medis'  => '000001',
                'nomor_induk_dokter' => 'DOK001',
                'tanggal_daftar'     => $today->copy()->setTime(9, 0),
                'keluhan'            => 'Demam dan batuk sejak 3 hari',
                'status'             => 'selesai',
                'nomor_antrian'      => 1,
                'catatan_dokter'     => 'Pasien diberikan obat penurun panas dan antibiotik',
                'biaya_konsultasi'   => 150000,
            ],
            [
                'nomor_rekam_medis'  => '000002',
                'nomor_induk_dokter' => 'DOK005',
                'tanggal_daftar'     => $today->copy()->setTime(10, 0),
                'keluhan'            => 'Nyeri dada dan sesak napas',
                'status'             => 'sedang_diperiksa',
                'nomor_antrian'      => 1,
                'catatan_dokter'     => null,
                'biaya_konsultasi'   => 300000,
            ],
            [
                'nomor_rekam_medis'  => '000003',
                'nomor_induk_dokter' => 'DOK002',
                'tanggal_daftar'     => $today->copy()->setTime(11, 0),
                'keluhan'            => 'Anak demam tinggi',
                'status'             => 'menunggu',
                'nomor_antrian'      => 1,
                'catatan_dokter'     => null,
                'biaya_konsultasi'   => 200000,
            ],
            [
                'nomor_rekam_medis'  => '000004',
                'nomor_induk_dokter' => 'DOK001',
                'tanggal_daftar'     => $yesterday->copy()->setTime(14, 0),
                'keluhan'            => 'Sakit kepala',
                'status'             => 'selesai',
                'nomor_antrian'      => 2,
                'catatan_dokter'     => 'Pasien diberikan obat pereda nyeri',
                'biaya_konsultasi'   => 100000,
            ],
            [
                'nomor_rekam_medis'  => '000005',
                'nomor_induk_dokter' => 'DOK006',
                'tanggal_daftar'     => $tomorrow->copy()->setTime(8, 0),
                'keluhan'            => 'Kontrol kehamilan rutin',
                'status'             => 'menunggu',
                'nomor_antrian'      => 1,
                'catatan_dokter'     => null,
                'biaya_konsultasi'   => 250000,
            ],
        ];

        foreach ($pendaftaran as $pd) {
            $pasienId = $pasienMap[$pd['nomor_rekam_medis']] ?? null;
            $dokterId = $dokterMap[$pd['nomor_induk_dokter']] ?? null;

            if (! $pasienId || ! $dokterId) {
                $this->command->warn(
                    "⚠️  Pasien '{$pd['nomor_rekam_medis']}' atau Dokter '{$pd['nomor_induk_dokter']}' tidak ditemukan, skip."
                );
                continue;
            }

            Pendaftaran::create([
                'pasien_id'        => $pasienId,
                'dokter_id'        => $dokterId,
                'tanggal_daftar'   => $pd['tanggal_daftar'],
                'keluhan'          => $pd['keluhan'],
                'status'           => $pd['status'],
                'nomor_antrian'    => $pd['nomor_antrian'],
                'catatan_dokter'   => $pd['catatan_dokter'],
                'biaya_konsultasi' => $pd['biaya_konsultasi'],
            ]);
        }

        $this->command->info('✅ Pendaftaran seeded!');

        // =====================
        // Seed Artikel
        // =====================
        $artikel = [
            [
                'judul'    => 'Faktor yang Mempengaruhi Pertumbuhan Tinggi Badan Anak',
                'slug'     => 'faktor-pertumbuhan-tinggi-badan-anak',
                'konten'   => 'Pertumbuhan tinggi badan dipengaruhi oleh nutrisi, olahraga, dan kualitas tidur. Protein dan kalsium membantu pembentukan tulang yang kuat. Vitamin D membantu penyerapan kalsium secara optimal.

Olahraga seperti berenang dan basket dapat merangsang pertumbuhan tulang. Aktivitas fisik yang rutin membantu perkembangan tubuh secara maksimal.

Tidur cukup sangat penting karena hormon pertumbuhan aktif saat malam hari. Kombinasi pola makan sehat dan gaya hidup aktif mendukung pertumbuhan tinggi badan.',
                'gambar'   => 'tinggi-badan.jpg',
                'kategori' => 'Tumbuh Kembang',
                'status'   => 'published',
                'penulis'  => 'Healthy ID',
            ],
            [
                'judul'    => 'Pentingnya Mengonsumsi Makanan Sehat Setiap Hari',
                'slug'     => 'pentingnya-makanan-sehat',
                'konten'   => 'Makanan sehat mengandung nutrisi lengkap seperti protein, vitamin, dan mineral. Nutrisi tersebut membantu menjaga daya tahan tubuh dan energi harian.

Sayuran, buah, ikan, dan telur sangat dianjurkan untuk dikonsumsi setiap hari. Hindari makanan tinggi gula dan lemak berlebih.

Dengan pola makan seimbang, risiko penyakit dapat dikurangi dan tubuh menjadi lebih bugar.',
                'gambar'   => 'makanan-sehat.jpg',
                'kategori' => 'Gizi dan Nutrisi',
                'status'   => 'published',
                'penulis'  => 'Healthy ID',
            ],
            [
                'judul'    => 'Cara Menjaga Kesehatan Gigi Sejak Dini',
                'slug'     => 'cara-menjaga-kesehatan-gigi',
                'konten'   => 'Menjaga kesehatan gigi dimulai dengan menyikat gigi dua kali sehari menggunakan pasta gigi berfluoride.

Kurangi konsumsi makanan manis karena dapat menyebabkan gigi berlubang dan plak.

Periksa gigi secara rutin setiap enam bulan untuk menjaga kesehatan mulut.',
                'gambar'   => 'gigi.jpg',
                'kategori' => 'Kesehatan Gigi',
                'status'   => 'published',
                'penulis'  => 'Healthy ID',
            ],
            [
                'judul'    => 'Manfaat Minum Air Putih yang Cukup',
                'slug'     => 'manfaat-minum-air-putih',
                'konten'   => 'Air putih membantu menjaga keseimbangan cairan tubuh dan mendukung metabolisme.

Kekurangan cairan dapat menyebabkan lemas dan sulit berkonsentrasi.

Biasakan minum minimal delapan gelas per hari untuk menjaga kesehatan tubuh.',
                'gambar'   => 'air-putih.jpg',
                'kategori' => 'Kesehatan Umum',
                'status'   => 'published',
                'penulis'  => 'Healthy ID',
            ],
            [
                'judul'    => 'Manfaat Olahraga Rutin untuk Tubuh',
                'slug'     => 'manfaat-olahraga-rutin',
                'konten'   => 'Olahraga rutin membantu menjaga kebugaran dan kesehatan jantung.

Aktivitas seperti jogging, bersepeda, atau senam meningkatkan daya tahan tubuh.

Lakukan olahraga minimal 30 menit setiap hari untuk hasil optimal.',
                'gambar'   => 'olahraga.jpg',
                'kategori' => 'Gaya Hidup Sehat',
                'status'   => 'published',
                'penulis'  => 'Healthy ID',
            ],
            [
                'judul'    => 'Pentingnya Tidur Cukup bagi Kesehatan',
                'slug'     => 'pentingnya-tidur-cukup',
                'konten'   => 'Tidur cukup membantu memperbaiki sel tubuh dan meningkatkan sistem imun.

Kurang tidur dapat menyebabkan stres dan gangguan konsentrasi.

Orang dewasa disarankan tidur 7-9 jam setiap malam untuk kesehatan optimal.',
                'gambar'   => 'tidur.jpg',
                'kategori' => 'Kesehatan Umum',
                'status'   => 'published',
                'penulis'  => 'Healthy ID',
            ],
        ];

        foreach ($artikel as $a) {
            Artikel::firstOrCreate(['slug' => $a['slug']], $a);
        }

        $this->command->info('✅ Artikel seeded!');
        $this->command->info('🎉 Database seeded successfully!');
    }
}