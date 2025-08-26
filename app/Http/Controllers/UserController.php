<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
