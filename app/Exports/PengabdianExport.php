<?php

namespace App\Exports;

use App\Models\Pengabdian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengabdianExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengabdian::select([
            'id_pengabdian',   // ← GANTI dari 'id' ke 'id_pengabdian'
            'nama_kegiatan',
            'jenis_kegiatan',
            'tanggal_mulai',
            'lokasi',
            'deskripsi',
            'created_at',
            'updated_at',
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID Pengabdian',
            'Nama Kegiatan',
            'Jenis Kegiatan',
            'Tanggal Mulai',
            'Lokasi',
            'Deskripsi',
            'Created At',
            'Updated At',
        ];
    }
}
