<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // ===============================
    // REDIRECT KE GOOGLE (SSO)
    // ===============================
    public function redirect()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])   // ← SELALU MUNCUL PILIH AKUN
            ->redirect();
    }

    // ===============================
    // CALLBACK DARI GOOGLE
    // ===============================
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login.pilih')
                ->withErrors(['google' => 'Gagal login dengan Google.']);
        }

        // CARI USER BERDASARKAN EMAIL GOOGLE
        $user = User::where('email', $googleUser->getEmail())->first();

        // JIKA TIDAK ADA → BUAT USER BARU
        if (!$user) {
            $user = User::create([
                'name'     => $googleUser->getName(),
                'email'    => $googleUser->getEmail(),
                'password' => bcrypt('googlelogin123'), // password dummy
                'role'     => 'mahasiswa',              // default role
            ]);
        }

        // LOGIN KE SISTEM
        Auth::login($user);

        // ARAHKAN SESUAI ROLE
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'dosen':
                return redirect()->route('dosen.dashboard');

            default:
                return redirect()->route('mahasiswa.dashboard');
        }
    }
}
