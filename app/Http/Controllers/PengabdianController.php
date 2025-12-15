<?php

namespace App\Http\Controllers;

use App\Models\Pengabdian;
use App\Models\Dosen;
use Illuminate\Http\Request;

class PengabdianController extends Controller
{
    public function index()
    {
        $items = Pengabdian::with('ketua')->latest()->paginate(15);
        return view('pengabdian.index', compact('items')); // changed
    }

    public function create()
    {
        $dosens = Dosen::orderBy('nama')->get();
        return view('pengabdian.create', compact('dosens')); // changed
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ketua_dosen_id' => 'required|exists:dosens,id',
            'judul' => 'required|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'nullable|string|max:100',
            'anggota' => 'nullable|string',
            'mahasiswa_penanggung_jawab' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4|integer',
        ]);

        Pengabdian::create($data);

        return redirect()->route('pengabdian.index')->with('success', 'Data pengabdian berhasil disimpan.'); // changed
    }

    public function show(Pengabdian $pengabdian)
    {
        $pengabdian->load('ketua');
        return view('pengabdian.show', compact('pengabdian')); // changed
    }

    public function edit(Pengabdian $pengabdian)
    {
        $dosens = Dosen::orderBy('nama')->get();
        return view('pengabdian.edit', compact('pengabdian', 'dosens')); // changed
    }

    public function update(Request $request, Pengabdian $pengabdian)
    {
        $data = $request->validate([
            'ketua_dosen_id' => 'required|exists:dosens,id',
            'judul' => 'required|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status' => 'nullable|string|max:100',
            'anggota' => 'nullable|string',
            'mahasiswa_penanggung_jawab' => 'nullable|string|max:255',
            'tahun' => 'nullable|digits:4|integer',
        ]);

        $pengabdian->update($data);

        return redirect()->route('pengabdian.index')->with('success', 'Data pengabdian berhasil diupdate.'); // changed
    }

    public function destroy(Pengabdian $pengabdian)
    {
        $pengabdian->delete();
        return redirect()->route('pengabdian.index')->with('success', 'Data pengabdian berhasil dihapus.'); // changed
    }
}
