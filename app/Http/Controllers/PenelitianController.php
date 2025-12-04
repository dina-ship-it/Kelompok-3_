<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penelitian;
use App\Models\Dosen;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PenelitianController extends Controller
{
    public function index(Request $request)
    {
        $penelitians = Penelitian::orderBy('created_at', 'desc')->paginate(10);
        return view('penelitian.index', compact('penelitians'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        return view('penelitian.create', compact('dosens'));
    }

    public function store(Request $request)
    {
        // validation
        $data = $request->validate([
            'dosen_id'       => 'nullable|integer|exists:dosens,id',
            'ketua_manual'   => 'nullable|string|max:255',
            'judul'          => 'required|string|max:255',
            'bidang'         => 'nullable|string|max:255',
            'tanggal_mulai'  => 'nullable|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'status'         => 'nullable|string|max:50',
            'peneliti'       => 'nullable|string',
            'mahasiswa_dok'  => 'nullable|string|max:255',
            'tahun'          => 'nullable|integer',
        ]);

        // must choose either lecturer or manual name
        if (empty($data['dosen_id']) && empty($data['ketua_manual'])) {
            return back()
                ->withErrors(['ketua_manual' => 'Please select a lecturer or type the principal investigator name.'])
                ->withInput();
        }

        // if manual is filled, ignore dosen_id; if using dosen, clear manual
        if (!empty($data['ketua_manual'])) {
            $data['dosen_id'] = null;
        } else {
            $data['ketua_manual'] = null;
        }

        Penelitian::create($data);

        return redirect()->route('penelitian.index')->with('success', 'Research has been added successfully.');
    }

    public function show(Penelitian $penelitian)
    {
        return view('penelitian.show', compact('penelitian'));
    }

    public function edit(Penelitian $penelitian)
    {
        $dosens = Dosen::all();
        return view('penelitian.edit', compact('penelitian', 'dosens'));
    }

    public function update(Request $request, Penelitian $penelitian)
    {
        $data = $request->validate([
            'dosen_id'       => 'nullable|integer|exists:dosens,id',
            'ketua_manual'   => 'nullable|string|max:255',
            'judul'          => 'required|string|max:255',
            'bidang'         => 'nullable|string|max:255',
            'tanggal_mulai'  => 'nullable|date',
            'tanggal_selesai'=> 'nullable|date|after_or_equal:tanggal_mulai',
            'status'         => 'nullable|string|max:50',
            'peneliti'       => 'nullable|string',
            'mahasiswa_dok'  => 'nullable|string|max:255',
            'tahun'          => 'nullable|integer',
        ]);

        if (empty($data['dosen_id']) && empty($data['ketua_manual'])) {
            return back()
                ->withErrors(['ketua_manual' => 'Please select a lecturer or type the principal investigator name.'])
                ->withInput();
        }

        if (!empty($data['ketua_manual'])) {
            $data['dosen_id'] = null;
        } else {
            $data['ketua_manual'] = null;
        }

        $penelitian->update($data);

        return redirect()->route('penelitian.index')->with('success', 'Research has been updated successfully.');
    }

    public function destroy(Penelitian $penelitian)
    {
        $penelitian->delete();
        return redirect()->route('penelitian.index')->with('success', 'Research has been deleted.');
    }

    public function export(Request $request)
    {
        return $this->exportCsv();
    }

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
