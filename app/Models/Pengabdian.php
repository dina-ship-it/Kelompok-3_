<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    use HasFactory;

    protected $table = 'pengabdian';

    protected $fillable = [
        'judul',
        'bidang',
        'ketua_pengabdian',
        'anggota',
        'mahasiswa_dokumentasi',
        'tahun',
        'status',
    ];
}
