<?php

namespace App\Exports;

use App\Models\Penelitian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class PenelitianExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    /**
     * Ambil data penelitian (sesuaikan field dengan tabelmu)
     */
    public function collection()
    {
        // contoh kolom: judul, peneliti (nama), tahun, sumber_dana, status
        return Penelitian::select('judul', 'peneliti', 'tahun', 'sumber_dana', 'status')->get();
    }

    /**
     * Header Excel
     */
    public function headings(): array
    {
        return [
            'Judul Penelitian',
            'Peneliti',
            'Tahun',
            'Sumber Dana',
            'Status',
        ];
    }

    /**
     * Styling lembar Excel
     */
    public function styles(Worksheet $sheet)
    {
        // buat header tebal, ukuran, dan rata-tengah
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $sheet->getStyle('A1:E1')->getFont()->setSize(12);
        $sheet->getStyle('A1:E1')->getAlignment()->setHorizontal('center');

        // beri latar header warna lembut
        $sheet->getStyle('A1:E1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFDDEEFF');

        // border dan alignment untuk semua sel (A1 sampai kolom terakhir + lastRow)
        $lastRow = $sheet->getHighestRow(); // setelah data dipindahkan akan mengembalikan jumlah baris
        if ($lastRow < 1) {
            $lastRow = 1;
        }

        $range = "A1:E{$lastRow}";
        $sheet->getStyle($range)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FFB0B0B0'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        // atur tinggi baris
        for ($i = 1; $i <= $lastRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(22);
        }

        return [];
    }

    /**
     * Nama sheet
     */
    public function title(): string
    {
        return 'Data Penelitian';
    }
}
