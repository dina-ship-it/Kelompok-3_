<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use Illuminate\Http\Request;

// untuk Excel
use App\Exports\PengabdianExport;
use Maatwebsite\Excel\Facades\Excel;

class PengabdianController extends Controller
{
    public function index()
    {
        $pengabdian = Pengabdian::orderBy('created_at','desc')->get();
        return view('pengabdian.index', compact('pengabdian'));
    }

    public function create()
    {
        return view('pengabdian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'lokasi' => 'required',
            'deskripsi' => 'nullable',
        ]);

        Pengabdian::create($request->all());
        return redirect()->route('pengabdian.index')->with('success', 'Data pengabdian berhasil ditambahkan.');
    }

    public function edit(Pengabdian $pengabdian)
    {
        return view('pengabdian.edit', compact('pengabdian'));
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'jenis_kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'lokasi' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $pengabdian->update($request->all());
        return redirect()->route('pengabdian.index')->with('success', 'Data pengabdian berhasil diperbarui.');
    }

    public function destroy(Pengabdian $pengabdian)
    {
        $pengabdian->delete();
        return redirect()->route('pengabdian.index')->with('success', 'Data pengabdian berhasil dihapus.');
    }

    /**
     * Export menggunakan maatwebsite/excel -> .xlsx
     */
    public function exportExcel()
    {
        $fileName = 'pengabdian_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new PengabdianExport, $fileName);
    }

    /**
     * Export cepat ke CSV tanpa package
     */
    public function exportCsv()
    {
        $fileName = 'pengabdian_' . date('Ymd_His') . '.csv';

        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename={$fileName}",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        ];

        $columns = ['No','Activity Name','Type','Start Date','End Date','Location','Lecturer','Description','Status'];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            // tulis BOM agar Excel mengenali UTF-8
            fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
            fputcsv($file, $columns);

            $rows = Pengabdian::with('dosen')->orderBy('created_at','desc')->get();

            foreach ($rows as $row) {
                $line = [
                    $row->id,
                    $row->nama_kegiatan ?? '',
                    $row->jenis_kegiatan ?? '',
                    $row->tanggal_mulai ?? '',
                    $row->tanggal_selesai ?? '',
                    $row->lokasi ?? '',
                    optional($row->dosen)->name ?? '',
                    $row->deskripsi ?? '',
                    $row->status ?? '',
                ];
                fputcsv($file, $line);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, $fileName, $headers);
    }
}
