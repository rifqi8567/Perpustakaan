<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('createbukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->string('nama_penerbit');
            $table->year('tahun_diterbitkan');
            $table->integer('jumlah_halaman');
            $table->string('upload_gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('createbuku');
    }
};
