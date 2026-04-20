<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PasienController extends Controller
{
    /**
     * Display a listing with search and filter
     */
    public function index(Request $request)
    {
        $query = Pasien::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('nomor_rekam_medis', 'like', "%{$search}%")
                    ->orWhere('nomor_telepon', 'like', "%{$search}%")
                    ->orWhere('nomor_identitas', 'like', "%{$search}%");
            });
        }

        // Filter by gender
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter by insurance
        if ($request->filled('has_asuransi')) {
            if ($request->has_asuransi === '1') {
                $query->whereNotNull('asuransi');
            } else {
                $query->whereNull('asuransi');
            }
        }

        $pasien = $query->latest()->paginate(10)->withQueryString();

        return view('pasien.index', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        return view('pasien.create');
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                [
                    'nama_lengkap' => 'required|string|max:255',
                    'tanggal_lahir' => 'required|date|before:' . now()->toDateString(),
                    'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                    'alamat' => 'required|string',
                    'nomor_telepon' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                    'email' => 'nullable|email|unique:pasien,email,NULL,id',
                    'nomor_identitas' => 'required|unique:pasien|min:16|max:16',
                    'jenis_identitas' => 'required|in:KTP,SIM,Paspor,Lainnya',
                    'asuransi' => 'nullable|string|max:100',
                    'nomor_asuransi' => 'nullable|string|max:50',
                    'nama_kontak_darurat' => 'nullable|string|max:255',
                    'telepon_kontak_darurat' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                    'riwayat_alergi' => 'nullable|string',
                    'riwayat_penyakit' => 'nullable|string',
                    'keluhan' => 'nullable|string',
                ],
                [
                    'nama_lengkap.required' => 'Nama lengkap wajib diisi',
                    'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                    'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
                    'alamat.required' => 'Alamat wajib diisi',
                    'nomor_telepon.required' => 'Nomor telepon wajib diisi',
                    'nomor_telepon.regex' => 'Format nomor telepon tidak valid',
                    'email.email' => 'Format email tidak valid',
                    'email.unique' => 'Email sudah terdaftar',
                    'nomor_identitas.required' => 'Nomor identitas wajib diisi',
                    'nomor_identitas.unique' => 'Nomor identitas sudah terdaftar',
                    'nomor_identitas.min' => 'Nomor KTP harus 16 digit',
                    'nomor_identitas.max' => 'Nomor KTP harus 16 digit',
                    'jenis_identitas.required' => 'Jenis identitas wajib dipilih',
                ],
            );

            // Gunakan database transaction dengan lock
            DB::beginTransaction();

            // Gunakan lockForUpdate untuk concurrency safety
            $lastNumber = DB::table('pasien')->lockForUpdate()->max('nomor_rekam_medis');

            $newNumber = str_pad(intval($lastNumber ?? 0) + 1, 6, '0', STR_PAD_LEFT);
            $validated['nomor_rekam_medis'] = $newNumber;

            // Pastikan kolom punya unique constraint di migration:
            // $table->string('nomor_rekam_medis')->unique();

            Pasien::create($validated);

            DB::commit();

            return redirect()
                ->route('pasien.sukses')
                ->with('success', 'Pasien berhasil didaftarkan dengan nomor rekam medis: ' . $newNumber);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating pasien: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mendaftarkan pasien')->withInput();
        }
    }

    /**
     * Display the specified resource
     */
    public function show(Pasien $pasien)
    {
        $pasien->load('pendaftaran.dokter');
        return view('pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Pasien $pasien)
    {
        try {
            $validated = $request->validate(
                [
                    'nama_lengkap' => 'required|string|max:255',
                    'tanggal_lahir' => 'required|date|before:today',
                    'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                    'alamat' => 'required|string',
                    'nomor_telepon' => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                    'email' => 'nullable|email|unique:pasien,email,' . $pasien->id,
                    'nomor_identitas' => 'required|unique:pasien,nomor_identitas,' . $pasien->id . '|min:16|max:16',
                    'jenis_identitas' => 'required|in:KTP,SIM,Paspor,Lainnya',
                    'asuransi' => 'nullable|string|max:100',
                    'nomor_asuransi' => 'nullable|string|max:50',
                    'nama_kontak_darurat' => 'nullable|string|max:255',
                    'telepon_kontak_darurat' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                    'riwayat_alergi' => 'nullable|string',
                    'riwayat_penyakit' => 'nullable|string',
                    'keluhan' => 'nullable|string',
                ],
                [
                    'nama_lengkap.required' => 'Nama lengkap wajib diisi',
                    'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
                    'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini',
                    'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
                    'alamat.required' => 'Alamat wajib diisi',
                    'nomor_telepon.required' => 'Nomor telepon wajib diisi',
                    'nomor_telepon.regex' => 'Format nomor telepon tidak valid',
                    'email.email' => 'Format email tidak valid',
                    'email.unique' => 'Email sudah terdaftar',
                    'nomor_identitas.required' => 'Nomor identitas wajib diisi',
                    'nomor_identitas.unique' => 'Nomor identitas sudah terdaftar',
                    'nomor_identitas.min' => 'Nomor KTP harus 16 digit',
                    'nomor_identitas.max' => 'Nomor KTP harus 16 digit',
                ],
            );

            DB::beginTransaction();

            $pasien->update($validated);

            DB::commit();

            return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating pasien: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data pasien')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Pasien $pasien)
    {
        try {
            DB::beginTransaction();

            // Check if pasien has pendaftaran
            if ($pasien->pendaftaran()->count() > 0) {
                return back()->with('error', 'Pasien tidak dapat dihapus karena memiliki riwayat pendaftaran');
            }

            $pasien->delete();

            DB::commit();

            return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting pasien: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus pasien');
        }
    }

    /**
     * Show success page
     */
    public function sukses()
    {
        return view('pasien.sukses');
    }

    /**
     * Export pasien data to CSV
     */
    public function export()
    {
        $pasien = Pasien::all();
        $filename = 'data_pasien_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($pasien) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'No. Rekam Medis',
                'Nama Lengkap',
                'Tanggal Lahir',
                'Jenis Kelamin',
                'Alamat',
                'No. Telepon',
                'Email',
                'No. Identitas',
                'Jenis Identitas',
                'Asuransi',
                'No. Asuransi',
                'Kontak Darurat', // ADD
                'Telepon Kontak', // ADD
                'Riwayat Alergi', // ADD
                'Riwayat Penyakit', // ADD
            ]);

            foreach ($pasien as $p) {
                fputcsv($file, [$p->nomor_rekam_medis, $p->nama_lengkap, $p->tanggal_lahir, $p->jenis_kelamin, $p->alamat, $p->nomor_telepon, $p->email, $p->nomor_identitas, $p->jenis_identitas, $p->asuransi, $p->nomor_asuransi, $p->nama_kontak_darurat ?? '-', $p->telepon_kontak_darurat ?? '-', $p->riwayat_alergi ?? '-', $p->riwayat_penyakit ?? '-']);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
