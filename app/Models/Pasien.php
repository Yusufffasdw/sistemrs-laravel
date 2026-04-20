<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    
    protected $fillable = [
        'nomor_rekam_medis',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'nomor_telepon',
        'email',
        'nomor_identitas',
        'jenis_identitas',
        'asuransi',
        'nomor_asuransi',
        'nama_kontak_darurat',
        'telepon_kontak_darurat',
        'riwayat_alergi',
        'riwayat_penyakit',
        'keluhan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = [
        'umur',
        'umur_formatted',
    ];

    /**
     * Relationships
     */
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    /**
     * Accessors - menghitung umur otomatis
     */
    public function getUmurAttribute()
    {
        if (!$this->tanggal_lahir) {
            return null;
        }
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    public function getUmurFormattedAttribute()
    {
        $umur = $this->umur;
        if ($umur === null) {
            return '-';
        }
        return $umur . ' tahun';
    }

    /**
     * Scopes - untuk query yang reusable
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%{$search}%")
              ->orWhere('nomor_rekam_medis', 'like', "%{$search}%")
              ->orWhere('nomor_telepon', 'like', "%{$search}%")
              ->orWhere('nomor_identitas', 'like', "%{$search}%");
        });
    }

    public function scopeHasAsuransi($query)
    {
        return $query->whereNotNull('asuransi');
    }

    public function scopeLakiLaki($query)
    {
        return $query->where('jenis_kelamin', 'laki-laki');
    }

    public function scopePerempuan($query)
    {
        return $query->where('jenis_kelamin', 'perempuan');
    }
}
