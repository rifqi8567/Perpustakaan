<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    /** @use HasFactory<\Database\Factories\LombaFactory> */
    use HasFactory;
    protected $fillable = [
        'judul',
        'subtitle',
        'deskripsi',
        'kuotes',
        'hadiah',
    ];
}
