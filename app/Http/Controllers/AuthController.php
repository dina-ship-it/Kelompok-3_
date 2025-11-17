<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ===============================
    // PILIH LOGIN
    // ===============================
    public function pilihLogin()
    {
        return view('auth.pilih_login');
    }

    // ===============================
    // ADMIN LOGIN
    // ===============================
    public function showAdminLoginForm()
    {
        return view('auth.login_admin');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');

        // coba login dengan Auth Laravel
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // cek role user
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // jika role bukan admin → logout
            Auth::logout();
            return redirect()->route('login.pilih')
                ->withErrors(['email' => 'Akun ini tidak memiliki akses admin.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // ===============================
    // DOSEN LOGIN
    // ===============================
    public function showDosenLoginForm()
    {
        return view('auth.login_dosen');
    }

    public function dosenLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            }

            Auth::logout();
            return redirect()->route('login.pilih')
                ->withErrors(['email' => 'Akun ini bukan akun dosen.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // ===============================
    // MAHASISWA LOGIN
    // ===============================
    public function showMahasiswaLoginForm()
    {
        return view('auth.login_mahasiswa');
    }

    public function mahasiswaLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }

            Auth::logout();
            return redirect()->route('login.pilih')
                ->withErrors(['email' => 'Akun ini bukan mahasiswa.']);
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    // ===============================
    // LOGOUT
    // ===============================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.pilih')
            ->with('success', 'Anda berhasil logout.');
    }
}
