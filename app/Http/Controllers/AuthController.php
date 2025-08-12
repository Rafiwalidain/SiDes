<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek status akun
            if ($user->status === 'submitted') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda belum disetujui. Silakan tunggu konfirmasi dari admin.',
                ])->onlyInput('email');
            }

            if ($user->status === 'rejected') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda telah ditolak. Silakan hubungi admin untuk informasi lebih lanjut.',
                ])->onlyInput('email');
            }

            // Redirect sesuai role
            return match ($user->role_id) {
                1 => redirect()->intended('dashboard'),
                2 => redirect()->intended('resident'),
                default => redirect()->intended('dashboard'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
