<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\residentController;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/resident', [residentController::class, 'index']);
Route::get('/resident/create', [residentController::class, 'create']);
Route::get('/resident/{id}', [residentController::class, 'edit']);
Route::post('/resident', [residentController::class, 'store']);
Route::put('/resident/{id}', [residentController::class, 'update']);
Route::delete('/resident/{id}', [residentController::class, 'destroy']);
