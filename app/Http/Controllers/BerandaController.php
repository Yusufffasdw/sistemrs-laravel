<?php

namespace App\Http\Controllers;
 use Carbon\Carbon;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use App\Models\Departemen;
use App\Models\Artikel;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // Get statistics
        $total_pasien = Pasien::count();
        $total_dokter = Dokter::count();
        $total_departemen = Departemen::count();
        $pendaftaran_hari_ini = Pendaftaran::whereDate('tanggal_daftar', today())->count();
        $pendaftaran_menunggu = Pendaftaran::where('status', 'menunggu')->count();

        // Get latest published articles - pastikan return collection kosong jika tidak ada
        $artikel = Artikel::where('status', 'published')->latest()->take(3)->get();

        return view('beranda.index', compact(
            'total_pasien',
            'total_dokter',
            'total_departemen',
            'pendaftaran_hari_ini',
            'pendaftaran_menunggu',
            'artikel'
        ));
    }

    public function daftar_dokter()
    {
        $dokters = Dokter::with('departemen')->where('status', 'aktif')->paginate(10);
        return view('beranda.daftar_dokter', compact('dokters'));
    }

    public function dokterShow($id)
    {
        $dokter = \App\Models\Dokter::with('departemen')->where('status', 'aktif')->findOrFail($id);
        return view('dokter.show_publik', compact('dokter'));
    }

    public function export_dokter(Request $request)
    {
        $format = $request->query('format', 'csv');
        
        $dokter = Dokter::with('departemen')->where('status', 'aktif')->get();
        
        if ($format === 'csv') {
            return $this->exportCSV($dokter);
        } elseif ($format === 'pdf') {
            return $this->exportPDF($dokter);
        }
        
        return redirect()->back()->with('error', 'Format tidak didukung');
    }

    private function exportCSV($dokter)
    {
        $filename = 'dokter_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        $callback = function() use ($dokter) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF)); // UTF-8 BOM
            
            // Header
            fputcsv($file, ['No.', 'Nama Dokter', 'Spesialisasi', 'Departemen', 'No. Induk', 'Email', 'Telepon', 'Status']);
            
            // Data
            $no = 1;
            foreach ($dokter as $item) {
                fputcsv($file, [
                    $no++,
                    $item->nama,
                    $item->spesialisasi,
                    $item->departemen->nama ?? '-',
                    $item->nomor_induk_dokter,
                    $item->email ?? '-',
                    $item->telepon ?? '-',
                    ucfirst($item->status),
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    private function exportPDF($dokter)
    {
        $filename = 'dokter_' . date('Y-m-d') . '.pdf';
        
        $html = '<html><head><meta charset="UTF-8"><style>';
        $html .= 'body { font-family: Arial, sans-serif; margin: 20px; }';
        $html .= 'h1 { text-align: center; color: #333; }';
        $html .= 'table { width: 100%; border-collapse: collapse; margin-top: 20px; }';
        $html .= 'th { background-color: #0099ff; color: white; padding: 10px; text-align: left; }';
        $html .= 'td { padding: 8px; border-bottom: 1px solid #ddd; }';
        $html .= 'tr:hover { background-color: #f5f5f5; }';
        $html .= '.footer { margin-top: 20px; font-size: 12px; color: #666; }';
        $html .= '</style></head><body>';
        
        $html .= '<h1>Daftar Dokter</h1>';
        $html .= '<p>Tanggal Export: ' . date('d/m/Y H:i:s') . '</p>';
        $html .= '<table>';
        $html .= '<thead><tr>';
        $html .= '<th>No.</th>';
        $html .= '<th>Nama Dokter</th>';
        $html .= '<th>Spesialisasi</th>';
        $html .= '<th>Departemen</th>';
        $html .= '<th>No. Induk</th>';
        $html .= '<th>Email</th>';
        $html .= '<th>Telepon</th>';
        $html .= '<th>Status</th>';
        $html .= '</tr></thead><tbody>';
        
        $no = 1;
        foreach ($dokter as $item) {
            $html .= '<tr>';
            $html .= '<td>' . $no++ . '</td>';
            $html .= '<td>' . $item->nama . '</td>';
            $html .= '<td>' . $item->spesialisasi . '</td>';
            $html .= '<td>' . ($item->departemen->nama ?? '-') . '</td>';
            $html .= '<td>' . $item->nomor_induk_dokter . '</td>';
            $html .= '<td>' . ($item->email ?? '-') . '</td>';
            $html .= '<td>' . ($item->telepon ?? '-') . '</td>';
            $html .= '<td>' . ucfirst($item->status) . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</tbody></table>';
        $html .= '<div class="footer">';
        $html .= '<p>Total Dokter: ' . count($dokter) . '</p>';
        $html .= '<p>Dokter Status: Aktif</p>';
        $html .= '</div>';
        $html .= '</body></html>';
        
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];
        
        // Simple PDF generation - convert HTML to PDF string
        // For production, use barryvdh/laravel-dompdf package
        return response($html, 200, $headers);
    }

    public function jadwal_dokter(Request $request)
    {
        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);
        
        // Generate calendar
        $tanggal_mulai = Carbon::createFromDate($tahun, $bulan, 1);
        $hari_pertama = $tanggal_mulai->startOfMonth()->dayOfWeek;
        $jumlah_hari = $tanggal_mulai->daysInMonth;
        
        // Get dokter dengan jadwal tersedia
        $dokter = Dokter::where('status', 'aktif')->with('departemen')->get();
        
        // Get pendaftaran untuk bulan ini
   

$pendaftaran = Pendaftaran::whereYear('tanggal_daftar', $tahun)
    ->whereMonth('tanggal_daftar', $bulan)
    ->get()
    ->groupBy(function ($item) {
        return Carbon::parse($item->tanggal_daftar)->day;
    });

        return view('beranda.jadwal_dokter', compact(
            'bulan',
            'tahun',
            'tanggal_mulai',
            'hari_pertama',
            'jumlah_hari',
            'dokter',
            'pendaftaran'
        ));
    }
        public function jadwal_dokter_publik(Request $request)
    {
        $bulan = $request->query('bulan', now()->month);
        $tahun = $request->query('tahun', now()->year);
        
        // Generate calendar
        $tanggal_mulai = Carbon::createFromDate($tahun, $bulan, 1);
        $hari_pertama = $tanggal_mulai->startOfMonth()->dayOfWeek;
        $jumlah_hari = $tanggal_mulai->daysInMonth;
        
        // Get dokter dengan jadwal tersedia
        $dokter = Dokter::where('status', 'aktif')->with('departemen')->get();
        
        // Get pendaftaran untuk bulan ini
   

$pendaftaran = Pendaftaran::whereYear('tanggal_daftar', $tahun)
    ->whereMonth('tanggal_daftar', $bulan)
    ->get()
    ->groupBy(function ($item) {
        return Carbon::parse($item->tanggal_daftar)->day;
    });

        return view('beranda.jadwal_dokter_publik', compact(
            'bulan',
            'tahun',
            'tanggal_mulai',
            'hari_pertama',
            'jumlah_hari',
            'dokter',
            'pendaftaran'
        ));
    }
}