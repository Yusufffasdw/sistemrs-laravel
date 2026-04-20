<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    
    protected $fillable = [
        'nama',
        'spesialisasi',
        'departemen_id',
        'nomor_induk_dokter',
        'telepon',
        'email',
        'status',
        'riwayat_pendidikan',
        'prestasi_penghargaan',
        'kondisi_klinis',
        'seminar',
        'foto',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'is_active',
        'nama_with_spesialisasi',
    ];

    /**
     * Relationships
     */
    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    /**
     * Accessors
     */
    public function getIsActiveAttribute()
    {
        return $this->status === 'aktif';
    }

    public function getNamaWithSpesialisasiAttribute()
    {
        return $this->nama . ' - ' . $this->spesialisasi;
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeNonActive($query)
    {
        return $query->where('status', 'nonaktif');
    }

    public function scopeByDepartemen($query, $departemenId)
    {
        return $query->where('departemen_id', $departemenId);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('spesialisasi', 'like', "%{$search}%")
              ->orWhere('nomor_induk_dokter', 'like', "%{$search}%");
        });
    }

    /**
     * Helper Methods
     */
    public function getTotalPendaftaranToday()
    {
        return $this->pendaftaran()
                    ->whereDate('tanggal_daftar', today())
                    ->count();
    }

    public function getPendingPendaftaran()
    {
        return $this->pendaftaran()
                    ->where('status', 'menunggu')
                    ->count();
    }
}