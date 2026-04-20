<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'status',
        'last_login',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Hash password saat create
     */
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($admin) {
            if (!empty($admin->password)) {
                $admin->password = Hash::make($admin->password);
            }
        });

        static::updating(function ($admin) {
            if ($admin->isDirty('password') && !empty($admin->password)) {
                $admin->password = Hash::make($admin->password);
            }
        });
    }

    /**
     * Check password
     */
    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    /**
     * Update last login
     */
    public function updateLastLogin()
    {
        $this->update(['last_login' => now()]);
    }
}