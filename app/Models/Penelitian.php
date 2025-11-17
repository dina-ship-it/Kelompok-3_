<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penelitian extends Model
{
    use HasFactory;

    protected $table = 'penelitians';

    protected $fillable = [
        'judul','bidang','tanggal_mulai','tanggal_selesai','status','dosen_id','mahasiswa_id'
    ];

    // <-- tambahkan ini
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function dosen()
    {
        return $this->belongsTo(\App\Models\User::class, 'dosen_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(\App\Models\User::class, 'mahasiswa_id');
    }
}
