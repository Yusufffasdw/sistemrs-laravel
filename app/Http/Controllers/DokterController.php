<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    /**
     * Display a listing with search and filter
     */
    public function index(Request $request)
    {
        $query = Dokter::with('departemen');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('spesialisasi', 'like', "%{$search}%")
                  ->orWhere('nomor_induk_dokter', 'like', "%{$search}%");
            });
        }

        // Filter by departemen
        if ($request->filled('departemen_id')) {
            $query->where('departemen_id', $request->departemen_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $dokter = $query->latest()->paginate(10)->withQueryString();
        $departemen = Departemen::all();
        
        return view('dokter.index', compact('dokter', 'departemen'));
    }

    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        $departemen = Departemen::all();
        return view('dokter.create', compact('departemen'));
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'spesialisasi' => 'required|string|max:255',
                'departemen_id' => 'required|exists:departemen,id',
                'nomor_induk_dokter' => 'required|unique:dokter|max:20',
                'telepon' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                'email' => 'nullable|email|unique:dokter,email',
                'status' => 'required|in:aktif,nonaktif',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'riwayat_pendidikan' => 'nullable|string',
                'prestasi_penghargaan' => 'nullable|string',
                'kondisi_klinis' => 'nullable|string',
                'seminar' => 'nullable|string',
            ], [
                'nama.required' => 'Nama dokter wajib diisi',
                'spesialisasi.required' => 'Spesialisasi wajib diisi',
                'departemen_id.required' => 'Departemen wajib dipilih',
                'departemen_id.exists' => 'Departemen tidak ditemukan',
                'nomor_induk_dokter.required' => 'Nomor induk dokter wajib diisi',
                'nomor_induk_dokter.unique' => 'Nomor induk dokter sudah terdaftar',
                'telepon.regex' => 'Format nomor telepon tidak valid',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'status.required' => 'Status wajib dipilih',
                'foto.image' => 'File harus berupa gambar',
                'foto.mimes' => 'Format foto harus jpg, jpeg, png, atau webp',
                'foto.max' => 'Ukuran foto maksimal 2MB',
            ]);

            DB::beginTransaction();

            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('dokter', 'public');
            }

            Dokter::create($validated);

            DB::commit();

            return redirect()->route('dokter.index')
                           ->with('success', 'Dokter berhasil ditambahkan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating dokter: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan dokter')->withInput();
        }
    }

    /**
     * Display the specified resource
     */
    public function show($id)
    {
        $dokter = Dokter::with(['departemen', 'pendaftaran.pasien'])->findOrFail($id);
        return view('dokter.show', compact('dokter'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $departemen = Departemen::all();
        return view('dokter.edit', compact('dokter', 'departemen'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'spesialisasi' => 'required|string|max:255',
                'departemen_id' => 'required|exists:departemen,id',
                'nomor_induk_dokter' => 'required|unique:dokter,nomor_induk_dokter,' . $dokter->id . '|max:20',
                'telepon' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
                'email' => 'nullable|email|unique:dokter,email,' . $dokter->id,
                'status' => 'required|in:aktif,nonaktif',
                'riwayat_pendidikan' => 'nullable|string',
                'prestasi_penghargaan' => 'nullable|string',
                'kondisi_klinis' => 'nullable|string',
                'seminar' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ], [
                'nama.required' => 'Nama dokter wajib diisi',
                'spesialisasi.required' => 'Spesialisasi wajib diisi',
                'departemen_id.required' => 'Departemen wajib dipilih',
                'departemen_id.exists' => 'Departemen tidak ditemukan',
                'nomor_induk_dokter.required' => 'Nomor induk dokter wajib diisi',
                'nomor_induk_dokter.unique' => 'Nomor induk dokter sudah terdaftar',
                'telepon.regex' => 'Format nomor telepon tidak valid',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'status.required' => 'Status wajib dipilih',
                'foto.image' => 'File harus berupa gambar',
                'foto.mimes' => 'Format foto harus jpg, jpeg, png, atau webp',
                'foto.max' => 'Ukuran foto maksimal 2MB',
            ]);

            DB::beginTransaction();

            if ($request->hasFile('foto')) {
                if ($dokter->foto) {
                    Storage::disk('public')->delete($dokter->foto);
                }
                $validated['foto'] = $request->file('foto')->store('dokter', 'public');
            }

            $dokter->update($validated);

            DB::commit();

            return redirect()->route('dokter.index')
                           ->with('success', 'Data dokter berhasil diperbarui');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating dokter: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui data dokter')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        try {
            DB::beginTransaction();

            // Check if dokter has pendaftaran
            if ($dokter->pendaftaran()->count() > 0) {
                return back()->with('error', 'Dokter tidak dapat dihapus karena memiliki riwayat pendaftaran');
            }

            if ($dokter->foto) {
                Storage::disk('public')->delete($dokter->foto);
            }

            $dokter->delete();

            DB::commit();

            return redirect()->route('dokter.index')
                           ->with('success', 'Dokter berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting dokter: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus dokter');
        }
    }

    /**
     * Export dokter data to CSV
     */
    public function export()
    {
        $dokter = Dokter::with('departemen')->get();
        $filename = 'data_dokter_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($dokter) {
            $file = fopen('php://output', 'w');
            fputcsv($file, [
                'Nomor Induk Dokter',
                'Nama',
                'Spesialisasi',
                'Departemen',
                'Telepon',
                'Email',
                'Status',
            ]);

            foreach ($dokter as $d) {
                fputcsv($file, [
                    $d->nomor_induk_dokter,
                    $d->nama,
                    $d->spesialisasi,
                    $d->departemen->nama ?? '-',
                    $d->telepon,
                    $d->email,
                    $d->status,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Get jadwal dokter by departemen (for AJAX)
     */
    public function getByDepartemen($departemenId)
    {
        $dokter = Dokter::where('departemen_id', $departemenId)
                       ->where('status', 'aktif')
                       ->get(['id', 'nama', 'spesialisasi']);

        return response()->json($dokter);
    }
}
