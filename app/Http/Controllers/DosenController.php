<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $dosens = Dosen::all(); // ambil semua data dosen
        return view('dosen.dashboard', compact('dosens'));
    }

    // TAMPILKAN SEMUA DATA
    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    // FORM TAMBAH DATA
    public function create()
    {
        $dosen = new Dosen();
        $button = 'Simpan';
        return view('dosen.create', compact('dosen', 'button'));
    }

    // SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens',
            'nama' => 'required',
            'email' => 'required|email|unique:dosens',
            'fakultas' => 'required',
            'prodi' => 'required',
            'jabatan' => 'required',
            'tahun' => 'required',
            'status' => 'required',
        ]);

        Dosen::create($request->all());
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    // FORM EDIT
    public function edit(Dosen $dosen)
    {
        $button = 'Update';
        return view('dosen.edit', compact('dosen', 'button'));
    }

    // UPDATE DATA
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required',
            'email' => 'required|email|unique:dosens,email,' . $dosen->id,
            'fakultas' => 'required',
            'prodi' => 'required',
            'jabatan' => 'required',
            'tahun' => 'required',
            'status' => 'required',
        ]);

        $dosen->update($request->all());
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    // HAPUS DATA
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}
