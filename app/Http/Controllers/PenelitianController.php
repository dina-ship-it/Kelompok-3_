<?php

namespace App\Http\Controllers;

use App\Models\Penelitian;
use Illuminate\Http\Request;

// ✅ Tambahan untuk export Excel
use App\Exports\PenelitianExport;
use Maatwebsite\Excel\Facades\Excel;

class PenelitianController extends Controller
{
    // ===============================
    // 📋 TAMPILKAN DATA PENELITIAN
    // ===============================
    public function index()
    {
        $penelitian = Penelitian::all();
        return view('penelitian.index', compact('penelitian'));
    }

    // ===============================
    // ➕ FORM TAMBAH PENELITIAN
    // ===============================
    public function create()
    {
        return view('penelitian.create');
    }

    // ===============================
    // 💾 SIMPAN DATA BARU
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
        ]);

        Penelitian::create($request->all());

        return redirect()->route('penelitian.index')->with('success', 'Data penelitian berhasil ditambahkan!');
    }

    // ===============================
    // ✏️ FORM EDIT
    // ===============================
    public function edit($id)
    {
        $penelitian = Penelitian::findOrFail($id);
        return view('penelitian.edit', compact('penelitian'));
    }

    // ===============================
    // 🔄 UPDATE DATA
    // ===============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:Aktif,Selesai,Dibatalkan',
        ]);

        $penelitian = Penelitian::findOrFail($id);
        $penelitian->update($request->all());

        return redirect()->route('penelitian.index')->with('success', 'Data penelitian berhasil diperbarui!');
    }

    // ===============================
    // 🗑️ HAPUS DATA
    // ===============================
    public function destroy($id)
    {
        $penelitian = Penelitian::findOrFail($id);
        $penelitian->delete();

        return redirect()->route('penelitian.index')->with('success', 'Data penelitian berhasil dihapus!');
    }

    // ===============================
    // 📊 EXPORT KE EXCEL
    // ===============================
    public function export()
    {
        $fileName = 'Data_Penelitian_' . date('Ymd_His') . '.xlsx';
        return Excel::download(new PenelitianExport, $fileName);
    }
}
