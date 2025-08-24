<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function accountRequests()
    {
        $users = \App\Models\User::where('status', 'submitted')->get();


        return view('pages.account-requests.index', [
            'users' => $users
        ]);
    }

    public function accountApproval(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->status = $request->input('for') == 'approve' ? 'approved' : 'rejected';
        $user->save();

        return back()->with('success', 'Akun berhasil ' . ($user->status == 'approved' ? 'disetujui' : 'ditolak') . '.');
    }
}
