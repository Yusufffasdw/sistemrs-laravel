<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Statistik utama
        $stats = [
            'total_pasien' => Pendaftaran::count(),
            'antrean_hari_ini' => Pendaftaran::whereDate('tanggal_daftar', Carbon::today())->count(),
            'dokter_aktif' => Dokter::where('status', 'aktif')->count(),
            'kamar_tersedia' => 45, // ganti sesuai tabel kamar
        ];

        // 5 Dokter terbaru
        $dokter_terbaru = Dokter::with('departemen')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        // 5 Antrian terbaru hari ini
        $antrian_hari_ini = Pendaftaran::with('pasien','dokter')
                                ->whereDate('tanggal_daftar', Carbon::today())
                                ->orderBy('nomor_antrian', 'asc')
                                ->take(5)
                                ->get();

        // Kalau antrian kosong → tampil dummy data (untuk demo)
        if($antrian_hari_ini->isEmpty()){
            $antrian_hari_ini = collect([
                (object)[
                    'pasien' => (object)['nama' => 'Ahmad'],
                    'dokter' => (object)['nama' => 'Dr. Budi'],
                    'nomor_antrian' => 1,
                    'status' => 'menunggu',
                ],
                (object)[
                    'pasien' => (object)['nama' => 'Siti'],
                    'dokter' => (object)['nama' => 'Dr. Andi'],
                    'nomor_antrian' => 2,
                    'status' => 'selesai',
                ],
                (object)[
                    'pasien' => (object)['nama' => 'Rina'],
                    'dokter' => (object)['nama' => 'Dr. Joko'],
                    'nomor_antrian' => 3,
                    'status' => 'menunggu',
                ],
            ]);
        }

        // Grafik pendaftaran mingguan (dummy, bisa diganti query dari DB)
        $chart_labels = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $chart_data = [10,12,8,15,20,5,7];

        return view('dashboard.index', compact(
            'stats',
            'dokter_terbaru',
            'antrian_hari_ini',
            'chart_labels',
            'chart_data'
        ));
    }
}
