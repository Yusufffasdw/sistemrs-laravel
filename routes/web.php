<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Public Routes (Frontend Pages)
|--------------------------------------------------------------------------
*/
// Homepage
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');

// Halaman Dokter & Jadwal (Public)
Route::get('/jadwaldokter', [BerandaController::class, 'jadwal_dokter_publik'])->name('beranda.jadwal_dokter_publik');
Route::get('/daftardokter', [BerandaController::class, 'daftar_dokter'])->name('daftardokter');
Route::get('/daftardokter/{id}', [BerandaController::class, 'dokterShow'])->name('beranda.dokter_show');

// Pendaftaran Pasien (Public - tanpa login)
Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
Route::get('/pasien/sukses', [PasienController::class, 'sukses'])->name('pasien.sukses');

// Halaman Instalasi
Route::get('/instalasi-igd', function () { 
    return view('igd'); 
})->name('instalasi.igd');

Route::get('/fasilitas', function () { 
    return view('fasilitas'); 
})->name('fasilitas');

Route::get('/instalasi-rawat-inap', function () { 
    return view('rawat-inap'); 
})->name('instalasi.inap');



// Halaman Tentang Kami
Route::get('/sejarah', function () { 
    return view('sejarah'); 
})->name('sejarah');

Route::get('/visi-misi', function () { 
    return view('visimisi'); 
})->name('visi-misi');

// Artikel Routes (Public)
Route::get('/artikel', [ArtikelController::class, 'publik'])->name('artikel');
Route::get('/artikel/publik', [ArtikelController::class, 'publik'])->name('artikel.publik');
Route::get('/artikel/{artikel}/p', [ArtikelController::class, 'show_p'])->name('artikel.show_p');

/*
|--------------------------------------------------------------------------
| Protected Routes (Dashboard & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Jadwal Dokter Internal (untuk admin)
    Route::get('/beranda/jadwal-dokter', [BerandaController::class, 'jadwal_dokter'])->name('beranda.jadwal_dokter');
    Route::get('/beranda/export-dokter', [BerandaController::class, 'export_dokter'])->name('beranda.export_dokter');

    // Pasien Routes (Admin Area - kecuali create, store, sukses yang sudah public)
    Route::get('/pasien/export', [PasienController::class, 'export'])->name('pasien.export');
    Route::resource('pasien', PasienController::class)->except(['create', 'store']);

    // Dokter Routes
    Route::get('/dokter/export', [DokterController::class, 'export'])->name('dokter.export');
    Route::get('/dokter/by-departemen/{departemenId}', [DokterController::class, 'getByDepartemen'])->name('dokter.byDepartemen');
    Route::resource('dokter', DokterController::class);

    // Departemen Routes
    Route::resource('departemen', DepartemenController::class);

    // Pendaftaran Routes
    Route::get('/pendaftaran/export', [PendaftaranController::class, 'export'])->name('pendaftaran.export');
    Route::get('/pendaftaran/antrian-today/{dokterId}', [PendaftaranController::class, 'getAntrianToday'])->name('pendaftaran.antrianToday');
    Route::patch('/pendaftaran/{pendaftaran}/status', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
    Route::resource('pendaftaran', PendaftaranController::class);

    // Artikel Routes (Admin only - create, edit, delete, export)
    Route::prefix('artikel')->name('artikel.')->group(function () {
        Route::get('/admin', [ArtikelController::class, 'index'])->name('index');
        Route::get('/create', [ArtikelController::class, 'create'])->name('create');
        Route::post('/', [ArtikelController::class, 'store'])->name('store');
        Route::get('/{artikel}', [ArtikelController::class, 'show'])->name('show');
        Route::get('/{artikel}/edit', [ArtikelController::class, 'edit'])->name('edit');
        Route::put('/{artikel}', [ArtikelController::class, 'update'])->name('update');
        Route::delete('/{artikel}', [ArtikelController::class, 'destroy'])->name('destroy');
        Route::get('/export/excel', [ArtikelController::class, 'export'])->name('export');
    });

    /*
    |--------------------------------------------------------------------------
    | AJAX Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('ajax')->group(function () {
        Route::get('/dokter/departemen/{id}', [DokterController::class, 'getByDepartemen']);
        Route::get('/antrian/today/{dokterId}', [PendaftaranController::class, 'getAntrianToday']);
    });
});