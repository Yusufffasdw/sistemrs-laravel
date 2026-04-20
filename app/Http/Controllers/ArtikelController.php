<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index(Request $request)
    {
        $query = Artikel::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        $artikel = $query->latest()->paginate(10)->withQueryString();
        
        // Get unique categories for filter
        $kategori_list = Artikel::select('kategori')
            ->distinct()
            ->whereNotNull('kategori')
            ->pluck('kategori');

        return view('artikel.index', compact('artikel', 'kategori_list'));
    }
    /**
     * Show the form for creating a new resource
     */
    public function create()
    {
        return view('artikel.create');
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'konten' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:draft,published',
                'penulis' => 'nullable|string|max:255',
            ], [
                'judul.required' => 'Judul artikel wajib diisi',
                'konten.required' => 'Konten artikel wajib diisi',
                'status.required' => 'Status artikel wajib dipilih',
                'gambar.image' => 'File harus berupa gambar',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
            ]);

            DB::beginTransaction();

            // Handle image upload
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $imageName = time() . '_' . Str::slug($validated['judul']) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/artikel'), $imageName);
                $validated['gambar'] = 'images/artikel/' . $imageName;
            }

            Artikel::create($validated);

            DB::commit();

            return redirect()->route('artikel.index')->with('success', 'Artikel berhasil ditambahkan');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating artikel: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan artikel')->withInput();
        }
    }

    /**
     * Display the specified resource
     */
    public function show(Artikel $artikel)
    {
        // Increment views
        $artikel->incrementViews();
        
        return view('artikel.show', compact('artikel'));
    }

    /**
     * Show the form for editing the specified resource
     */
    public function edit(Artikel $artikel)
    {
        return view('artikel.edit', compact('artikel'));
    }

    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Artikel $artikel)
    {
        try {
            $validated = $request->validate([
                'judul' => 'required|string|max:255',
                'konten' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'kategori' => 'nullable|string|max:100',
                'status' => 'required|in:draft,published',
                'penulis' => 'nullable|string|max:255',
            ], [
                'judul.required' => 'Judul artikel wajib diisi',
                'konten.required' => 'Konten artikel wajib diisi',
                'status.required' => 'Status artikel wajib dipilih',
                'gambar.image' => 'File harus berupa gambar',
                'gambar.max' => 'Ukuran gambar maksimal 2MB',
            ]);

            DB::beginTransaction();

            // Handle image upload
            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
                    unlink(public_path($artikel->gambar));
                }

                $image = $request->file('gambar');
                $imageName = time() . '_' . Str::slug($validated['judul']) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/artikel'), $imageName);
                $validated['gambar'] = 'images/artikel/' . $imageName;
            }

            // Update slug if title changed
            if ($artikel->judul !== $validated['judul']) {
                $validated['slug'] = Str::slug($validated['judul']);
                
                // Check if slug exists
                $count = 1;
                $originalSlug = $validated['slug'];
                while (Artikel::where('slug', $validated['slug'])->where('id', '!=', $artikel->id)->exists()) {
                    $validated['slug'] = $originalSlug . '-' . $count;
                    $count++;
                }
            }

            $artikel->update($validated);

            DB::commit();

            return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating artikel: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui artikel')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage
     */
    public function destroy(Artikel $artikel)
    {
        try {
            DB::beginTransaction();

            // Delete image if exists
            if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
                unlink(public_path($artikel->gambar));
            }

            $artikel->delete();

            DB::commit();

            return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting artikel: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus artikel');
        }
    }

    /**
     * Export artikel to CSV
     */
    public function export(Request $request)
    {
        $query = Artikel::query();

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kategori')) {
            $query->byKategori($request->kategori);
        }

        $artikel = $query->get();
        $filename = 'data_artikel_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($artikel) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Judul', 'Slug', 'Kategori', 'Penulis', 'Status', 'Views', 'Tanggal']);

            foreach ($artikel as $a) {
                fputcsv($file, [
                    $a->judul,
                    $a->slug,
                    $a->kategori ?? '-',
                    $a->penulis ?? '-',
                    $a->status,
                    $a->views,
                    $a->tanggal_formatted
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function publik()
{
    $artikels = Artikel::latest()->paginate(10); 
    return view('artikel.publik', compact('artikels'));
}
  public function show_p(Artikel $artikel)
    {
        // Increment views
        $artikel->incrementViews();
        
        return view('artikel.show_p', compact('artikel'));
    }
}
