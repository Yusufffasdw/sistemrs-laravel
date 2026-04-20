<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Pendaftaran;
use App\Models\Departemen;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    
    // Pasien API
    Route::get('pasien', function () {
        return Pasien::with('pendaftaran')->paginate(10);
    });
    
    Route::get('pasien/{id}', function ($id) {
        return Pasien::with('pendaftaran')->findOrFail($id);
    });
    
    Route::get('pasien/search/{query}', function ($query) {
        return Pasien::search($query)->get();
    });
    
    // Dokter API
    Route::get('dokter', function () {
        return Dokter::with('departemen')->paginate(10);
    });
    
    Route::get('dokter/{id}', function ($id) {
        return Dokter::with('departemen')->findOrFail($id);
    });
    
    Route::get('dokter/departemen/{id}', function ($id) {
        return Dokter::where('departemen_id', $id)
                     ->where('status', 'aktif')
                     ->get();
    });
    
    Route::get('dokter/search/{query}', function ($query) {
        return Dokter::search($query)->get();
    });
    
    // Pendaftaran API
    Route::get('pendaftaran', function () {
        return Pendaftaran::with(['pasien', 'dokter'])->paginate(10);
    });
    
    Route::get('pendaftaran/{id}', function ($id) {
        return Pendaftaran::with(['pasien', 'dokter'])->findOrFail($id);
    });
    
    Route::get('pendaftaran/today/{dokterId}', function ($dokterId) {
        $today = \Carbon\Carbon::today();
        $antrian = Pendaftaran::where('dokter_id', $dokterId)
                             ->whereDate('tanggal_daftar', $today)
                             ->count();
        
        return response()->json([
            'total' => $antrian,
            'next_number' => $antrian + 1,
        ]);
    });
    
    // Departemen API
    Route::get('departemen', function () {
        return Departemen::with('dokter')->get();
    });
    
    Route::get('departemen/{id}', function ($id) {
        return Departemen::with('dokter')->findOrFail($id);
    });
    
    // Dashboard Statistics API
    Route::get('dashboard/stats', function () {
        return response()->json([
            'total_pasien' => Pasien::count(),
            'total_dokter' => Dokter::where('status', 'aktif')->count(),
            'total_departemen' => Departemen::count(),
            'total_pendaftaran_today' => Pendaftaran::whereDate('tanggal_daftar', today())->count(),
            'pending_appointments' => Pendaftaran::where('status', 'menunggu')->count(),
            'completed_appointments' => Pendaftaran::where('status', 'selesai')->count(),
        ]);
    });
});
