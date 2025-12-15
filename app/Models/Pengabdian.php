<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengabdian extends Model
{
    protected $table = 'pengabdians';

    protected $fillable = [
        'ketua_dosen_id',
        'judul',
        'bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'anggota',
        'mahasiswa_penanggung_jawab',
        'tahun',
    ];

    public function ketua()
    {
        return $this->belongsTo(\App\Models\Dosen::class, 'ketua_dosen_id');
    }
}
