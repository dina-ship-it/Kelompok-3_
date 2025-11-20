<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        // validasi input termasuk dosen_id
        $data = $request->validate([
            'dosen_id'       => 'required|integer|exists:dosens,id', // ubah jika nama tabel dosen berbeda atau tidak pakai exists
            'judul'          => 'required|string|max:255',
            'bidang'         => 'nullable|string|max:255',
            'tanggal_mulai'  => 'nullable|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'status'         => 'nullable|string|max:50',
            'peneliti'       => 'nullable|string|max:255',
            'tahun'          => 'nullable|integer',
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
            'dosen_id'       => 'required|integer|exists:dosens,id',
            'judul'          => 'required|string|max:255',
            'bidang'         => 'nullable|string|max:255',
            'tanggal_mulai'  => 'nullable|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'status'         => 'nullable|string|max:50',
            'peneliti'       => 'nullable|string|max:255',
            'tahun'          => 'nullable|integer',
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
        return $this->exportCsv();
    }

    /**
     * Stream CSV export dari tabel penelitians (otomatis ambil semua kolom).
     */
    public function exportCsv(): StreamedResponse
    {
        $model = new Penelitian();
        $table = $model->getTable();
        $columns = Schema::getColumnListing($table);

        $filename = 'penelitian-' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($columns) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $columns);

            Penelitian::chunk(200, function ($rows) use ($out, $columns) {
                foreach ($rows as $row) {
                    $line = [];
                    foreach ($columns as $col) {
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
