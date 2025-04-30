<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class createbuku extends Model
{
    use HasFactory;

    protected $table = 'createbukus'; // Ubah nama tabel di sini

    protected $fillable = [
        'judul_buku',
        'nama_penerbit',
        'tahun_diterbitkan',
        'jumlah_halaman',
        'upload_file',
        'upload_gambar'
    ];

    public function favorit()
    {
        return $this->hasMany(Favorit::class, 'buku_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'buku_id');
    }
}
