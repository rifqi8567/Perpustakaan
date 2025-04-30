<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CreateBuku;  // Pastikan nama model sesuai dengan nama file

class Favorit extends Model
{
    // Menambahkan user_id ke dalam array $fillable
    protected $fillable = [
        'user_id',  // Menambahkan kolom user_id
        'buku_id',  // Jika Anda ingin mengizinkan mass assignment untuk buku_id juga
    ];

    // Definisikan relasi dengan model CreateBuku
    public function buku()
    {
        return $this->belongsTo(CreateBuku::class, 'buku_id');
    }
}
