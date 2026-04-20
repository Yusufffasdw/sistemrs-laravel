<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal_daftar',
        'keluhan',
        'status',
        'nomor_antrian',
        'catatan_dokter',
        'biaya_konsultasi',
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'biaya_konsultasi' => 'decimal:2',
    ];

    protected $appends = [
        'tanggal_daftar_formatted',
        'biaya_konsultasi_formatted',
    ];

    /* ================= RELATION ================= */

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    /* ================= ACCESSOR ================= */

    public function getTanggalDaftarFormattedAttribute()
    {
        return $this->tanggal_daftar
            ? $this->tanggal_daftar->format('d/m/Y H:i')
            : '-';
    }

    public function getBiayaKonsultasiFormattedAttribute()
    {
        return $this->biaya_konsultasi
            ? 'Rp ' . number_format($this->biaya_konsultasi, 0, ',', '.')
            : 'Rp 0';
    }

    /* ================= SCOPE ================= */

    public function scopeToday($query)
    {
        return $query->whereDate('tanggal_daftar', today());
    }
}
