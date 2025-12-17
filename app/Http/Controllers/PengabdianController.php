<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use Illuminate\Http\Request;

class PengabdianController extends Controller
{
    public function index()
    {
        $pengabdians = Pengabdian::orderBy('tahun', 'desc')->get();
        return view('pengabdian.index', compact('pengabdians'));
    }

    public function create()
    {
        return view('pengabdian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'bidang' => 'required',
            'ketua_pengabdian' => 'required',
            'anggota' => 'required',
            'mahasiswa_dokumentasi' => 'required',
            'tahun' => 'required',
            'status' => 'required',
        ]);

        Pengabdian::create($request->all());

        return redirect()->route('pengabdians.index')
            ->with('success', 'Data pengabdian berhasil ditambahkan');
    }

    public function edit(Pengabdian $pengabdian)
    {
        return view('pengabdian.edit', compact('pengabdian'));
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        $request->validate([
            'judul' => 'required',
            'bidang' => 'required',
            'ketua_pengabdian' => 'required',
            'anggota' => 'required',
            'mahasiswa_dokumentasi' => 'required',
            'tahun' => 'required',
            'status' => 'required',
        ]);

        $pengabdian->update($request->all());

        return redirect()->route('pengabdians.index')
            ->with('success', 'Data pengabdian berhasil diperbarui');
    }

    public function destroy(Pengabdian $pengabdian)
    {
        $pengabdian->delete();

        return redirect()->route('pengabdians.index')
            ->with('success', 'Data pengabdian berhasil dihapus');
    }
}
