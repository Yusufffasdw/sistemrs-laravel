<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('restrict');
            $table->foreignId('dokter_id')->constrained('dokter')->onDelete('restrict');
            $table->dateTime('tanggal_daftar');
            $table->text('keluhan');
            $table->enum('status', ['menunggu', 'sedang_diperiksa', 'selesai', 'batal'])->default('menunggu');
            $table->integer('nomor_antrian')->nullable();
            $table->text('catatan_dokter')->nullable();
            $table->decimal('biaya_konsultasi', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};