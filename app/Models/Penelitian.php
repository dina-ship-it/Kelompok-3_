<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    protected $table = 'penelitians'; // sesuaikan jika nama tabel berbeda

    protected $fillable = [
        'dosen_id',
        'judul',
        'bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'peneliti',
        'tahun',
        // tambahkan kolom lain jika perlu
    ];
}
