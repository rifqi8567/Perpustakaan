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
            $table->string('tahun_diterbitkan');
            $table->string('jumlah_halaman');
            $table->string('upload_file')->nullable();
            $table->string('upload_gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('createbukus');
    }
};
