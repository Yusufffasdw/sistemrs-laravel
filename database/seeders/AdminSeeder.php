<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create default admin
        Admin::create([
            'username' => 'admin',
            'password' => 'admin123', // Will be hashed automatically
            'nama_lengkap' => 'Administrator',
            'status' => 'aktif',
        ]);

        // Optional: Create more admins
        Admin::create([
            'username' => 'dokter_admin',
            'password' => 'password123',
            'nama_lengkap' => 'Admin Dokter',
            'status' => 'aktif',
        ]);
    }
}