<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::view('/pulse/auth', 'pulse.auth')->name('pulse_auth');
Route::post('/admin/auth', AuthController::class);
