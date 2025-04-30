<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    // protected $fillable = ['buku_id', 'user_id', 'review', 'rating'];
    

    public function book()
    {
        return $this->belongsTo(createbuku::class, 'buku_id', 'id');
    }

    // Model Review
       // Definisikan relasi dengan model User
     // Relasi dengan model User
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id'); // Pastikan menggunakan user_id
     }
     protected $fillable = [
        'review_text',
        'rating',
        'buku_id',
        'user_id',
        'rating',
        'review',
     ];
}
