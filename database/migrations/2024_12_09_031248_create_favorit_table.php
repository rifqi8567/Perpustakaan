<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('favorits', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users'); // Asumsikan tabel pengguna bernama 'users'
        $table->foreignId('buku_id')->constrained('createbukus'); // Tabel buku
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('favorits');
}

};
