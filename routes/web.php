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
})->middleware('role:Admin,User');

Route::get('/resident', [residentController::class, 'index'])->middleware('role:Admin');
Route::get('/resident/create', [residentController::class, 'create'])->middleware('role:Admin');
Route::get('/resident/{id}', [residentController::class, 'edit'])->middleware('role:Admin');
Route::post('/resident', [residentController::class, 'store'])->middleware('role:Admin');
Route::put('/resident/{id}', [residentController::class, 'update'])->middleware('role:Admin');
Route::delete('/resident/{id}', [residentController::class, 'destroy'])->middleware('role:Admin');
