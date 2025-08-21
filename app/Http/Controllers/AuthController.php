<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return back();
        }

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
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Anda belum login.');
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function registerView()
    {
        if (Auth::check()) {
            return back();
        }

        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return back();
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = 2; // Role default untuk user biasa
        $data['status'] = 'submitted'; // Status awal saat registrasi

        $user = User::create($data);

        // Redirect ke halaman login dengan pesan sukses
        return redirect('/')->with('success', 'Registrasi berhasil! Silakan tunggu konfirmasi dari admin.');
    }
}
