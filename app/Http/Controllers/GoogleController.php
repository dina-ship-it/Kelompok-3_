<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google (simpan intent role di session bila ada)
     * URL contoh: /auth/google/redirect/dosen
     */
    public function redirect(Request $request, $role = null)
    {
        if ($role) {
            $request->session()->put('login_intent', $role);
        } else {
            $request->session()->forget('login_intent');
        }

        return Socialite::driver('google')
            ->with(['prompt' => 'select_account']) // paksa pemilihan akun
            ->redirect();
    }

    /**
     * Callback dari Google setelah user memilih akun
     */
    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login.pilih')
                ->withErrors(['google' => 'Gagal login dengan Google.']);
        }

        // Ambil intent (jika ada) dan hapus dari session
        $intent = $request->session()->pull('login_intent');

        // Cari user berdasarkan email Google
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Jika user sudah ada dan intent berbeda dari role tersimpan -> tampil konfirmasi
            if ($intent && $user->role !== $intent) {
                // simpan data sementara (opsional) jika nanti butuh
                $request->session()->put('google_temp_user', [
                    'name'  => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                ]);

                // simpan info role saat ini & intent supaya view konfirmasi bisa mengakses
                $request->session()->put('current_role', $user->role);
                $request->session()->put('intent_role', $intent);

                return redirect()->route('login.google.confirm_role');
            }

            // Role sama atau tidak ada intent: login dan redirect
            Auth::login($user);
            return $this->redirectByRole($user->role);
        }

        // Jika user belum ada: buat user baru dengan role = intent (jika ada) atau 'mahasiswa'
        $roleToAssign = $intent ?? 'mahasiswa';

        $user = User::create([
            'name'     => $googleUser->getName(),
            'email'    => $googleUser->getEmail(),
            'password' => bcrypt('googlelogin123'), // password dummy aman
            'role'     => $roleToAssign,
        ]);

        Auth::login($user);
        return $this->redirectByRole($user->role);
    }

    /**
     * Tampilkan halaman konfirmasi bila role tersimpan berbeda dari intent
     * View: resources/views/auth/confirm_role.blade.php
     */
    public function confirmRole(Request $request)
    {
        $currentRole = $request->session()->get('current_role');
        $intent = $request->session()->get('intent_role');

        if (!$currentRole || !$intent) {
            return redirect()->route('login.pilih');
        }

        return view('auth.confirm_role', compact('currentRole', 'intent'));
    }

    /**
     * Handle continue action from confirm-role view.
     * If user chooses 'intent' we set session active_role to the intent (temporary).
     * If user chooses 'current' we set active_role to current role.
     */
    public function confirmRoleContinue(Request $request)
    {
        $currentRole = $request->session()->get('current_role');
        $intent = $request->session()->get('intent_role');
        $temp = $request->session()->get('google_temp_user');

        if (!$temp || !isset($temp['email'])) {
            return redirect()->route('login.pilih')->withErrors(['google' => 'Data sesi tidak ditemukan. Silakan ulangi login.']);
        }

        $email = $temp['email'];
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('login.pilih')->withErrors(['google' => 'Akun tidak ditemukan di sistem.']);
        }

        // login user
        Auth::login($user);

        // tentukan active role berdasarkan pilihan user
        $choose = $request->input('choose'); // expected values: 'current' or 'intent'
        if ($choose === 'intent' && $intent) {
            session(['active_role' => $intent]);
        } else {
            session(['active_role' => $currentRole ?? $user->role]);
        }

        // bersihkan temp session yg tidak perlu
        $request->session()->forget(['google_temp_user', 'current_role', 'intent_role', 'login_intent']);

        // redirect ke role yang aktif
        $active = session('active_role', $user->role);
        switch ($active) {
            case 'admin': return redirect()->route('admin.dashboard');
            case 'dosen': return redirect()->route('dosen.dashboard');
            default: return redirect()->route('mahasiswa.dashboard');
        }
    }

    /**
     * Handle cancel action: clear temp session and return to login choice.
     */
    public function confirmRoleCancel(Request $request)
    {
        $request->session()->forget(['google_temp_user', 'current_role', 'intent_role', 'login_intent']);
        return redirect()->route('login.pilih');
    }

    /**
     * Helper: redirect berdasarkan role
     */
    protected function redirectByRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'dosen':
                return redirect()->route('dosen.dashboard');
            default:
                return redirect()->route('mahasiswa.dashboard');
        }
    }
}
