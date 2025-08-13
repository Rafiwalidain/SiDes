<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\residentController;


// auth
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'registerView'])->name('registerView');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/resident', [residentController::class, 'index']);
Route::get('/resident/create', [residentController::class, 'create']);
Route::get('/resident/{id}', [residentController::class, 'edit']);
Route::post('/resident', [residentController::class, 'store']);
Route::put('/resident/{id}', [residentController::class, 'update']);
Route::delete('/resident/{id}', [residentController::class, 'destroy']);
