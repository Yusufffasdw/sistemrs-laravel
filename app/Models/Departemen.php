<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';    protected $fillable = ['nama', 'deskripsi', 'telepon'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationships
     */
    public function dokter()
    {
        return $this->hasMany(Dokter::class);
    }

    /**
     * Scopes
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
            ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }

    /**
     * Helper Methods
     */
    public function getTotalDokterAktif()
    {
        return $this->dokter()->where('status', 'aktif')->count();
    }
}
