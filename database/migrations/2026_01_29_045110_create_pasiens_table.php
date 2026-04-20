<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_rekam_medis');
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('email')->nullable();
            $table->string('nomor_identitas', 16)->unique();
            $table->enum('jenis_identitas', ['KTP', 'SIM', 'Paspor', 'Lainnya'])->default('KTP');
            $table->string('asuransi')->nullable();
            $table->string('nomor_asuransi')->nullable();
            $table->string('nama_kontak_darurat')->nullable();
            $table->string('telepon_kontak_darurat')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->text('riwayat_penyakit')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};