<?php

namespace App\Exports;

use App\Models\Penelitian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PenelitianExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function collection()
    {
        // Ambil kolom yang dibutuhkan
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
            'updated_at',
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // jumlah baris data + header
                $rowCount = Penelitian::count() + 1;
                if ($rowCount < 1) {
                    $rowCount = 1;
                }

                $highestCol = 'K'; // kalau kolom berubah sesuaikan huruf
                $fullRange = "A1:{$highestCol}{$rowCount}";

                // 1) Header style: bold, putih, center, background biru
                $sheet->getStyle('A1:K1')->getFont()->setBold(true)
                      ->getColor()->setARGB('FFFFFFFF'); // putih

                $sheet->getStyle('A1:K1')->getAlignment()
                      ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                      ->setVertical(Alignment::VERTICAL_CENTER);

                $sheet->getStyle('A1:K1')->getFill()
                      ->setFillType(Fill::FILL_SOLID)
                      ->getStartColor()->setARGB('FF1E64D6'); // biru (ganti kode warna jika mau)

                // 2) Border untuk semua sel pada range
                $sheet->getStyle($fullRange)->getBorders()->getAllBorders()
                      ->setBorderStyle(Border::BORDER_THIN);

                // 3) Wrap text untuk semua sel (berguna untuk deskripsi/dokumentasi)
                $sheet->getStyle($fullRange)->getAlignment()->setWrapText(true);

                // 4) Baris header lebih tinggi
                $sheet->getRowDimension(1)->setRowHeight(26);

                // 5) Freeze header (baris 1)
                $sheet->freezePane('A2');

                // 6) Jika perlu, sesuaikan format tanggal (opsional)
                // contoh: kolom F (Tanggal Mulai) & G (Tanggal Selesai) diatur format yyyy-mm-dd
                $sheet->getStyle('F2:G' . $rowCount)
                      ->getNumberFormat()
                      ->setFormatCode('yyyy-mm-dd');

                // 7) Pastikan kolom terakhir tidak terlalu sempit (opsional padding)
                foreach (range('A','K') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
