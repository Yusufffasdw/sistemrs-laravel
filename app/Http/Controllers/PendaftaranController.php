<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Pasien;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    /**
     * Display a listing with search and filter
     */
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['pasien', 'dokter.departemen']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_antrian', 'like', "%{$search}%")
                    ->orWhereHas('pasien', function ($q) use ($search) {
                        $q->where('nama_lengkap', 'like', "%{$search}%")->orWhere('nomor_rekam_medis', 'like', "%{$search}%");
                    })
                    ->orWhereHas('dokter', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_daftar', $request->tanggal);
        }

        // Filter by dokter
        if ($request->filled('dokter_id')) {
            $query->where('dokter_id', $request->dokter_id);
        }

        $pendaftaran = $query->latest('tanggal_daftar')->paginate(10)->withQueryString();
        $dokter = Dokter::where('status', 'aktif')->get();

        return view('pendaftaran.index', compact('pendaftaran', 'dokter'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        $pasien = Pasien::all();
        $dokter = Dokter::where('status', 'aktif')->with('departemen')->get();
        return view('pendaftaran.create', compact('pasien', 'dokter'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'pasien_id' => 'required|exists:pasien,id',
                'dokter_id' => 'required|exists:dokter,id',
                'tanggal_daftar' => 'required|date',
                'keluhan' => 'required|string',
                'biaya_konsultasi' => 'nullable|numeric',
            ]);

            // ✅ pastikan tanggal jadi Carbon
            $tanggalDaftar = Carbon::parse($validated['tanggal_daftar']);

            // ✅ ambil antrian terakhir (per dokter & per hari)
            // Tambahkan database lock
            DB::beginTransaction();

            $lastAntrian = Pendaftaran::whereDate('tanggal_daftar', $tanggalDaftar->toDateString())
                ->where('dokter_id', $validated['dokter_id'])
                ->lockForUpdate()
                ->max('nomor_antrian');

            $validated['nomor_antrian'] = ($lastAntrian ?? 0) + 1;
            
            Pendaftaran::create($validated);

            DB::commit();

            return redirect()->route('pendaftaran.index')->with('success', 'Pasien berhasil didaftarkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating pendaftaran: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mendaftarkan pasien')->withInput();
        }
    }

    /**
     * Display the specified resource
     */
    public function show(Pendaftaran $pendaftaran)
    {
        $pendaftaran->load(['pasien', 'dokter.departemen']);
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        $pasien = Pasien::all();
        $dokter = Dokter::where('status', 'aktif')->with('departemen')->get();
        return view('pendaftaran.edit', compact('pendaftaran', 'pasien', 'dokter'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        try {
            $validated = $request->validate(
                [
                    'pasien_id' => 'required|exists:pasien,id',
                    'dokter_id' => 'required|exists:dokter,id',
                    'tanggal_daftar' => 'required|date_format:Y-m-d\TH:i',
                    'keluhan' => 'required|string',
                    'status' => 'required|in:menunggu,sedang_diperiksa,selesai,batal',
                    'catatan_dokter' => 'nullable|string',
                    'biaya_konsultasi' => 'nullable|numeric|min:0',
                ],
                [
                    'pasien_id.required' => 'Pasien wajib dipilih',
                    'pasien_id.exists' => 'Pasien tidak ditemukan',
                    'dokter_id.required' => 'Dokter wajib dipilih',
                    'dokter_id.exists' => 'Dokter tidak ditemukan',
                    'tanggal_daftar.required' => 'Tanggal dan jam pendaftaran wajib diisi',
                    'keluhan.required' => 'Keluhan wajib diisi',
                    'status.required' => 'Status wajib dipilih',
                    'biaya_konsultasi.numeric' => 'Biaya konsultasi harus berupa angka',
                    'biaya_konsultasi.min' => 'Biaya konsultasi tidak boleh negatif',
                ],
            );

            DB::beginTransaction();

            // If dokter or tanggal changed, recalculate nomor_antrian
            if ($pendaftaran->dokter_id != $validated['dokter_id'] || Carbon::parse($pendaftaran->tanggal_daftar)->format('Y-m-d') != Carbon::parse($validated['tanggal_daftar'])->format('Y-m-d')) {
                $tanggalDaftar = Carbon::parse($validated['tanggal_daftar']);
                $lastAntrian = Pendaftaran::whereDate('tanggal_daftar', $tanggalDaftar->format('Y-m-d'))->where('dokter_id', $validated['dokter_id'])->where('id', '!=', $pendaftaran->id)->max('nomor_antrian');

                $validated['nomor_antrian'] = ($lastAntrian ?? 0) + 1;
            }

            $pendaftaran->update($validated);

            DB::commit();

            return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating pendaftaran: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui pendaftaran')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        try {
            DB::beginTransaction();

            // Only allow deletion if status is 'menunggu' or 'batal'
            if (!in_array($pendaftaran->status, ['menunggu', 'batal'])) {
                return back()->with('error', 'Hanya pendaftaran dengan status menunggu atau batal yang dapat dihapus');
            }

            $pendaftaran->delete();

            DB::commit();

            return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting pendaftaran: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus pendaftaran');
        }
    }

    /**
     * Update status pendaftaran
     */
    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:menunggu,sedang_diperiksa,selesai,batal',
                'catatan_dokter' => 'nullable|string',
            ]);

            DB::beginTransaction();

            $pendaftaran->update($validated);

            DB::commit();

            return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating status: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui status');
        }
    }

    /**
     * Export pendaftaran data to CSV
     */
    public function export(Request $request)
    {
        $query = Pendaftaran::with(['pasien', 'dokter']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_daftar', $request->tanggal);
        }

        $pendaftaran = $query->get();
        $filename = 'data_pendaftaran_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($pendaftaran) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No. Antrian', 'Tanggal Daftar', 'Nama Pasien', 'No. Rekam Medis', 'Nama Dokter', 'Keluhan', 'Status', 'Biaya Konsultasi']);

            foreach ($pendaftaran as $p) {
                fputcsv($file, [$p->nomor_antrian, $p->tanggal_daftar, $p->pasien->nama_lengkap ?? '-', $p->pasien->nomor_rekam_medis ?? '-', $p->dokter->nama ?? '-', $p->keluhan, $p->status, $p->biaya_konsultasi]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get antrian info for today by dokter (for AJAX)
     */
    public function getAntrianToday($dokterId)
    {
        $today = Carbon::today();
        $antrian = Pendaftaran::where('dokter_id', $dokterId)->whereDate('tanggal_daftar', $today)->count();

        return response()->json([
            'total' => $antrian,
            'next_number' => $antrian + 1,
        ]);
    }
}