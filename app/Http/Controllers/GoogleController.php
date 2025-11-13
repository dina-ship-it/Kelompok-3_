<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Callback dari Google
     */
    public function callback()
    {
        try {

            // Ambil data user dari Google
            $googleUser = Socialite::driver('google')->user();
            $email = $googleUser->getEmail();

            if (!$email) {
                return redirect()->route('login.pilih')->with('error', 'Email tidak ditemukan dari Google.');
            }

            // Email admin
            $adminEmails = [
                'dina@mhs.politala.ac.id',
            ];

            $isAdmin = in_array($email, $adminEmails);

            // Create atau update user
            $user = User::firstOrNew(['email' => $email]);
            $user->name = $googleUser->getName();
            $user->google_id = $googleUser->getId();
            $user->avatar = $googleUser->getAvatar();
            $user->password = Hash::make(Str::random(40));

            if (empty($user->role)) {
                $user->role = $isAdmin ? 'admin' : 'student';
            }

            $user->save();

            Log::info("LOGIN GOOGLE BERHASIL", [
                'email' => $user->email,
                'role' => $user->role,
            ]);

            // Login
            Auth::login($user, true);
            request()->session()->regenerate();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            if ($user->role === 'mahasiswa' || $user->role === 'student') {
                return redirect()->route('mahasiswa.dashboard');
            }

            if ($user->role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            }

            return redirect('/');

        } catch (\Throwable $e) {

            Log::error("Google callback error: ".$e->getMessage());

            return redirect()->route('login.pilih')
                ->with('error', 'Login Google gagal: '.$e->getMessage());
        }
    }
}
