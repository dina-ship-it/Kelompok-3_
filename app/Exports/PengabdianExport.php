<?php

namespace App\Exports;

use App\Models\Pengabdian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class PengabdianExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        // Pilih kolom yang ingin diexport — sesuaikan kalau beda
        return Pengabdian::select([
            'id',
            'activity_name',
            'type',
            'start_date',
            'location',
            'description',
            'created_at',
            'updated_at'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Activity Name',
            'Type',
            'Start Date',
            'Location',
            'Description',
            'Created At',
            'Updated At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold header
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        // Auto-size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Border di seluruh area
        $lastRow = Pengabdian::count() + 1;
        $sheet->getStyle("A1:H{$lastRow}")
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(Border::BORDER_THIN);

        return [];
    }
}
