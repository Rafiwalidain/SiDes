<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function accountRequests()
    {
        $users = User::where('status', 'submitted')->get();


        return view('pages.account-requests.index', [
            'users' => $users
        ]);
    }

    public function accountApproval(Request $request, $userId)
    {
        $for = $request->input('for');

        $user = User::findOrFail($userId);

        if ($for == 'approve') {
            $user->status = 'approved';
            $message = 'Akun berhasil disetujui.';
        } elseif ($for == 'reject') {
            $user->status = 'rejected';
            $message = 'Akun berhasil ditolak.';
        } elseif ($for == 'activate') {
            $user->status = 'approved'; // aktifkan = approved
            $message = 'Akun berhasil diaktifkan.';
        } elseif ($for == 'deactivate') {
            $user->status = 'rejected'; // non-aktifkan = rejected (atau buat status baru 'inactive')
            $message = 'Akun berhasil dinonaktifkan.';
        } else {
            return back()->with('error', 'Aksi tidak dikenal.');
        }

        $user->save();

        return back()->with('success', $message);
    }

    public function accountList()
    {
        $users = User::where('role_id', 2)
            ->whereIn('status', ['approved', 'rejected']) // hanya ambil yang statusnya approved atau rejected
            ->get();

        return view('pages.account-list.index', [
            'users' => $users
        ]);
    }

    public function profile_view()
    {
        return view('pages.profile.index');
    }

    public function edit_profile(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
        ]);

        $user = User::findOrFail($userId);
        $user->name = $request->input('name');
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function change_password_view()
    {
        return view('pages.profile.change-password');
    }

    public function change_password(Request $request, $userId)
    {
        $request->validate([
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'old_password.min' => 'Password lama minimal 8 karakter.',
            'new_password.min' => 'Password baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak sesuai.',
        ]);

        $user = User::findOrFail($userId);

        $oldPasswordValid = Hash::check($request->input('old_password'), $user->password);
        if (!$oldPasswordValid) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
        } elseif ($request->input('old_password') === $request->input('new_password')) {
            return back()->withErrors(['new_password' => 'Password baru tidak boleh sama dengan password lama.']);
        }

        $user->password = $request->input('new_password'); // Pastikan untuk mengenkripsi password jika perlu
        $user->save();

        return back()->with('success', 'Password berhasil diubah.');
    }
}
