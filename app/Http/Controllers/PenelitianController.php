<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;

// Jika Anda menggunakan maatwebsite/excel, uncomment import berikut:
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\PenelitianExport;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // contoh pagination 10
        $penelitians = Penelitian::orderBy('created_at', 'desc')->paginate(10);

        return view('penelitian.index', compact('penelitians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penelitian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // contoh validasi sederhana — sesuaikan field dengan tabel Anda
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'peneliti' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer',
            // tambahkan aturan lain sesuai kolom
        ]);

        Penelitian::create($data);

        return redirect()->route('penelitian.index')->with('success', 'Penelitian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penelitian $penelitian)
    {
        return view('penelitian.show', compact('penelitian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penelitian $penelitian)
    {
        return view('penelitian.edit', compact('penelitian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penelitian $penelitian)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'peneliti' => 'nullable|string|max:255',
            'tahun' => 'nullable|integer',
        ]);

        $penelitian->update($data);

        return redirect()->route('penelitian.index')->with('success', 'Penelitian berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penelitian $penelitian)
    {
        $penelitian->delete();
        return redirect()->route('penelitian.index')->with('success', 'Penelitian berhasil dihapus.');
    }

    /**
     * Export: smart method — jika maatwebsite/excel tersedia, gunakan itu.
     * Jika tidak, fallback ke CSV streaming.
     */
    public function export(Request $request)
    {
        // Jika paket Maatwebsite terpasang dan Anda sudah membuat export class:
        // return Excel::download(new PenelitianExport, 'penelitian-' . now()->format('Ymd_His') . '.xlsx');

        // Jika tidak ada paket, fallback ke CSV:
        return $this->exportCsv();
    }

    /**
     * Stream CSV export dari tabel penelitians (otomatis ambil semua kolom).
     */
    public function exportCsv(): StreamedResponse
    {
        $model = new Penelitian();
        $table = $model->getTable(); // biasanya 'penelitians'
        $columns = Schema::getColumnListing($table);

        $filename = 'penelitian-' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($columns) {
            $out = fopen('php://output', 'w');

            // optional: tulis BOM untuk UTF-8 agar Excel membaca karakter dengan benar
            // fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            // header kolom
            fputcsv($out, $columns);

            Penelitian::chunk(200, function ($rows) use ($out, $columns) {
                foreach ($rows as $row) {
                    $line = [];
                    foreach ($columns as $col) {
                        // cast to string agar fputcsv tidak error pada objek
                        $value = data_get($row, $col);
                        if (is_array($value) || is_object($value)) {
                            $value = json_encode($value);
                        }
                        $line[] = $value;
                    }
                    fputcsv($out, $line);
                }
            });

            fclose($out);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
