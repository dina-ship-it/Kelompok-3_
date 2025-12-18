<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Hitung bobot kriteria secara otomatis
     */
    public function hitungOtomatis()
    {
        $kriterias = Kriteria::all();

        // Contoh logika sederhana (silakan sesuaikan AHP / bobotmu)
        $jumlah = $kriterias->count();

        if ($jumlah == 0) {
            return redirect()->back()->with('error', 'Data kriteria masih kosong');
        }

        foreach ($kriterias as $kriteria) {
            $kriteria->bobot = 1 / $jumlah; // contoh pembagian rata
            $kriteria->save();
        }

        return redirect()
            ->route('tpk.kriteria.index')
            ->with('success', 'Bobot kriteria berhasil dihitung otomatis');
    }
}
