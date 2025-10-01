<?php

// app/Http/Controllers/LecturerController.php
namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::all();
        return view('lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        return view('lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nidn' => 'required|unique:lecturers',
            'email' => 'required|email|unique:lecturers',
            'department' => 'required',
        ]);

        Lecturer::create($request->all());
        return redirect()->route('lecturers.index')->with('success', 'Dosen berhasil ditambahkan!');
    }

    public function edit(Lecturer $lecturer)
    {
        return view('lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required',
            'nidn' => 'required|unique:lecturers,nidn,' . $lecturer->id,
            'email' => 'required|email|unique:lecturers,email,' . $lecturer->id,
            'department' => 'required',
        ]);

        $lecturer->update($request->all());
        return redirect()->route('lecturers.index')->with('success', 'Dosen berhasil diperbarui!');
    }

    public function destroy(Lecturer $lecturer)
    {
        $lecturer->delete();
        return redirect()->route('lecturers.index')->with('success', 'Dosen berhasil dihapus!');
    }
}
