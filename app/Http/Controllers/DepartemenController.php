<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartemenController extends Controller
{
    public function index()
    {
        $departemen = Departemen::paginate(10);
        return view('departemen.index', compact('departemen'));
    }

    public function create()
    {
        return view('departemen.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|unique:departemen',
                'deskripsi' => 'nullable|string',
                'telepon' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            ], [
                'nama.required' => 'Nama departemen wajib diisi',
                'nama.unique' => 'Nama departemen sudah ada',
                'telepon.regex' => 'Format nomor telepon tidak valid',
            ]);

            DB::beginTransaction();

            Departemen::create($validated);

            DB::commit();

            return redirect()->route('departemen.index')
                           ->with('success', 'Departemen berhasil ditambahkan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating departemen: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan departemen')->withInput();
        }
    }

    public function show(Departemen $departemen)
    {
        $departemen->load('dokter');
        return view('departemen.show', compact('departemen'));
    }


    public function edit(Departemen $departemen)
    {
        return view('departemen.edit', compact('departemen'));
    }


    public function update(Request $request, Departemen $departemen)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|unique:departemen,nama,' . $departemen->id,
                'deskripsi' => 'nullable|string',
                'telepon' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15',
            ], [
                'nama.required' => 'Nama departemen wajib diisi',
                'nama.unique' => 'Nama departemen sudah ada',
                'telepon.regex' => 'Format nomor telepon tidak valid',
            ]);

            DB::beginTransaction();

            $departemen->update($validated);

            DB::commit();

            return redirect()->route('departemen.index')
                           ->with('success', 'Departemen berhasil diperbarui');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating departemen: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui departemen')->withInput();
        }
    }

    public function destroy(Departemen $departemen)
    {
        try {
            DB::beginTransaction();

            // Check jika departemen punya dokter
            if ($departemen->dokter()->count() > 0) {
                return back()->with('error', 'Departemen tidak dapat dihapus karena masih memiliki dokter');
            }

            $departemen->delete();

            DB::commit();

            return redirect()->route('departemen.index')
                           ->with('success', 'Departemen berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting departemen: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus departemen');
        }
    }
}