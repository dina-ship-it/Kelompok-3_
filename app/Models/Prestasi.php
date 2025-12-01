<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';

    protected $fillable = [
        'code',
        'nama',
        'nama_prestasi',
        'skor_sinta',
        'skor_sinta_3yr',
        'jumlah_buku',
        'jumlah_hibah',
        'publikasi_scholar',
    ];
}
