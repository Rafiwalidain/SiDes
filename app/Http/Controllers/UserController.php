<?php

namespace App\Http\Controllers;

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
}
