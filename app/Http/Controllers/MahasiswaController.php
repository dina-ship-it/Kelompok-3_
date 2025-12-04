<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Penelitian;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // =============================
    // 🏠 Dashboard Mahasiswa
    // =============================
    public function dashboard()
    {
        // Ambil SEMUA penelitian yang sudah punya mahasiswa dokumentasi
        $penelitians = Penelitian::whereNotNull('mahasiswa_dok')
            ->orderBy('tahun', 'desc')
            ->get();

        // Hitung jumlah dokumentasi dari tabel "dokumentasis"
        // (saat ini dihitung untuk semua dokumentasi, bukan per user)
        $fotoCount = Dokumentasi::where('jenis', 'foto')->count();
        $videoCount = Dokumentasi::where('jenis', 'video')->count();
        $total      = $fotoCount + $videoCount;

        return view('mahasiswa.dashboard', compact(
            'fotoCount',
            'videoCount',
            'total',
            'penelitians'
        ));
    }

    // =============================
    // 📤 Upload Dokumentasi (umum, yang lama – masih boleh dipakai kalau perlu)
    // =============================
    public function storeUpload(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file'  => 'required|file|mimes:jpg,jpeg,png,mp4|max:20480', // max 20MB
        ]);

        // Simpan file ke storage
        $path = $request->file('file')->store('dokumentasi', 'public');

        // Contoh kalau mau simpan juga ke tabel dokumentasi (opsional)
        // Dokumentasi::create([
        //     'penelitian_id' => null,
        //     'mahasiswa_id'  => Auth::id(),
        //     'jenis'         => 'foto', // atau 'video' kalau mau dibedakan
        //     'file_path'     => $path,
        // ]);

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', '✅ Upload dokumentasi berhasil!');
    }

    // =============================
    // 📤 Upload Dokumentasi PER PENELITIAN
    // =============================

    // Form upload dokumentasi untuk 1 penelitian tertentu
    public function createDokumentasi(Penelitian $penelitian)
    {
        return view('mahasiswa.upload_dokumentasi', compact('penelitian'));
    }

    // Simpan dokumentasi untuk 1 penelitian tertentu (FILE + LINK DRIVE)
    public function storeDokumentasi(Request $request, Penelitian $penelitian)
    {
        $data = $request->validate([
            'jenis'      => 'required|in:foto,video',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:20480', // 20 MB
            'drive_link' => 'nullable|url|max:255',
        ]);

        // Minimal harus ada salah satu: file ATAU link Google Drive
        if (!$request->hasFile('file') && !$request->filled('drive_link')) {
            return back()
                ->withErrors(['file' => 'Silakan upload file atau isi link Google Drive.'])
                ->withInput();
        }

        // Upload file jika ada
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumentasi', 'public');
        }

        // Simpan ke tabel dokumentasis
        Dokumentasi::create([
            'penelitian_id' => $penelitian->id,
            'mahasiswa_id'  => Auth::id(),
            'jenis'         => $data['jenis'],
            'file_path'     => $path,
            'drive_link'    => $data['drive_link'] ?? null,
        ]);

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', '✅ Dokumentasi untuk penelitian "' . $penelitian->judul . '" berhasil diupload!');
    }

    // =============================
    // 📋 CRUD Mahasiswa
    // =============================

    public function index()
    {
        $mahasiswa = Mahasiswa::latest()->get();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim'      => 'required|unique:mahasiswas',
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:mahasiswas',
            'fakultas' => 'required|string|max:100',
            'prodi'    => 'required|string|max:100',
            'angkatan' => 'required|digits:4',
            'status'   => 'required|in:Aktif,Tidak Aktif',
        ]);

        Mahasiswa::create($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', '✅ Data mahasiswa berhasil ditambahkan!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validated = $request->validate([
            'nim'      => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'fakultas' => 'required|string|max:100',
            'prodi'    => 'required|string|max:100',
            'angkatan' => 'required|digits:4',
            'status'   => 'required|in:Aktif,Tidak Aktif',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('mahasiswa.index')
            ->with('success', '✅ Data mahasiswa berhasil diperbarui!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')
            ->with('success', '🗑️ Data mahasiswa berhasil dihapus!');
    }
}
