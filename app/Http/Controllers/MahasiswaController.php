<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Penelitian;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    // =============================
    // 🏠 Dashboard Mahasiswa
    // =============================
    public function dashboard()
    {
        $penelitians = Penelitian::whereNotNull('mahasiswa_dok')
            ->orderBy('tahun', 'desc')
            ->get();

        $fotoCount  = Dokumentasi::where('jenis', 'foto')->count();
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
    // 📤 Upload Dokumentasi PER PENELITIAN
    // =============================

    public function createDokumentasi(Penelitian $penelitian)
    {
        return view('mahasiswa.upload_dokumentasi', compact('penelitian'));
    }

    public function storeDokumentasi(Request $request, Penelitian $penelitian)
    {
        $data = $request->validate([
            'jenis'      => 'required|in:foto,video',
            'file'       => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:20480',
            'drive_link' => 'nullable|url|max:255',
        ]);

        // Minimal salah satu harus ada
        if (!$request->hasFile('file') && !$request->filled('drive_link')) {
            return back()
                ->withErrors(['file' => 'Silakan upload file atau isi link Google Drive.'])
                ->withInput();
        }

        // 🔥 AMBIL MAHASISWA DARI USER LOGIN
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            return back()->withErrors([
                'mahasiswa' => 'Data mahasiswa untuk akun ini belum terdaftar.'
            ]);
        }

        // Upload file jika ada
        $path = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('dokumentasi', 'public');
        }

        // SIMPAN DOKUMENTASI (INI SUDAH BENAR FK-NYA)
        Dokumentasi::create([
            'penelitian_id' => $penelitian->id,
            'mahasiswa_id'  => $mahasiswa->id, // ✅ INI KUNCI UTAMA
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
