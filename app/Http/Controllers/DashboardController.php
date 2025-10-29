<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Penelitian;
use App\Models\Pengabdian;
use App\Models\Prestasi;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'lecturers' => Dosen::count(),
            'students' => Mahasiswa::count(),
            'research' => Penelitian::count(),
            'service' => Pengabdian::count(),
            'achievement' => Prestasi::count(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}
