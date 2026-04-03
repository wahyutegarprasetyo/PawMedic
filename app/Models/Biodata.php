<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'biodata';

    protected $fillable = [
        'nama_pemilik',
        'nama_kucing',
        'umur_kucing',
        'jenis_kelamin',
        'berat_badan',
        'ras_kucing',
        'alamat',
        'no_telepon'
    ];
}
