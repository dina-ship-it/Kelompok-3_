<?php

namespace App\Exports;

use App\Models\Penelitian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PenelitianExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Penelitian::select([
            'id',
            'dosen_id',
            'mahasiswa_id',
            'judul',
            'bidang',
            'tanggal_mulai',
            'tanggal_selesai',
            'status',
            'dokumentasi',
            'created_at',
            'updated_at'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Dosen ID',
            'Mahasiswa ID',
            'Judul',
            'Bidang',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Status',
            'Dokumentasi',
            'Created At',
            'Updated At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold untuk header
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);

        // Auto-width semua kolom
        foreach (range('A','K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Tambahkan BORDER (garis-garis tabel)
        $lastRow = Penelitian::count() + 1; // +1 untuk header

        $sheet->getStyle("A1:K{$lastRow}")
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(Border::BORDER_THIN);

        return [];
    }
}
