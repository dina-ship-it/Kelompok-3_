<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $table = 'penelitians';

    // Columns that can be mass-assigned
    protected $fillable = [
        'dosen_id',
        'ketua_manual',    // manual lead lecturer name
        'judul',
        'bidang',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'peneliti',        // research members
        'mahasiswa_dok',   // documentation student
        'tahun',
    ];

    // Relation to Dosen model
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
}
