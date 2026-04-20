<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('spesialisasi');
            $table->foreignId('departemen_id')->constrained('departemen')->onDelete('restrict');
            $table->string('nomor_induk_dokter')->unique();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('prestasi_penghargaan')->nullable();
            $table->text('kondisi_klinis')->nullable();
            $table->text('seminar')->nullable();
            $table->string('foto')->nullable(); // ← tambah ini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokter');
    }
};