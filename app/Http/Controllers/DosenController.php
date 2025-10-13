<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * 🏠 Dashboard Dosen
     */
    public function dashboard()
    {
        // Contoh statis (bisa diganti dengan Auth::guard('dosen')->user() nanti)
        $namaDosen = 'Dosen Aktif';

        $data = [
            'nama' => $namaDosen,
            'penelitian' => Penelitian::count(),
            'pengabdian' => Pengabdian::count(),
            'prestasi' => Prestasi::count(),
            'publikasi' => 0, // bisa ditambah nanti
        ];

        return view('dosen.dashboard', compact('data'));
    }

    /**
     * 📋 Tampilkan semua data dosen
     */
    public function index()
    {
        $dosens = Dosen::all();
        return view('dosen.index', compact('dosens'));
    }

    /**
     * ➕ Form tambah dosen baru
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * 💾 Simpan data dosen baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|numeric|unique:dosens,nidn',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:dosens,email',
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tahun' => 'required|numeric|min:2000|max:' . date('Y'),
        ]);

        Dosen::create([
            ...$validated,
            'status' => 'Aktif',
            'password' => bcrypt('12345678'),
        ]);

        return redirect()->route('dosen.index')->with('success', '✅ Data dosen berhasil ditambahkan!');
    }

    /**
     * ✏️ Form edit data dosen
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * 🔄 Update data dosen
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => 'required|numeric|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'fakultas' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tahun' => 'required|numeric|min:2000|max:' . date('Y'),
        ]);

        $dosen->update($validated);

        return redirect()->route('dosen.index')->with('success', '✅ Data dosen berhasil diperbarui!');
    }

    /**
     * 🗑️ Hapus data dosen
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', '🗑️ Data dosen berhasil dihapus!');
    }
}
