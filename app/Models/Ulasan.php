<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasans';
    protected $fillable = [
        'nama',
        'nama_kucing',
        'hasil_diagnosis',
        'rating',
        'komentar'
    ];
}
