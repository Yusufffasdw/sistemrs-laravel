<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'kategori',
        'status',
        'penulis',
        'views',
    ];

    protected $casts = [
        'views' => 'integer',
    ];

    protected $appends = [
        'tanggal_formatted',
    ];

    /**
     * Boot method untuk auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
                
                // Cek jika slug sudah ada, tambahkan angka
                $count = 1;
                $originalSlug = $artikel->slug;
                while (static::where('slug', $artikel->slug)->exists()) {
                    $artikel->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }

    /**
     * Accessor
     */
    public function getTanggalFormattedAttribute()
    {
        return $this->created_at ? $this->created_at->format('d/m/Y H:i') : '-';
    }

    /**
     * Scope untuk artikel published
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope untuk search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('konten', 'like', "%{$search}%")
              ->orWhere('penulis', 'like', "%{$search}%");
        });
    }

    /**
     * Scope berdasarkan kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}