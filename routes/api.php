<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\ShowController as UserShow;
use App\Http\Controllers\User\ShowMeController as UserShowMe;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("v1")->group(function () {
   Route::prefix("auth")->group(function () {
      Route::middleware(['throttle:code'])->post("/code", AuthController::class);
      Route::post("/", LoginController::class);
      Route::middleware('auth:sanctum')->post("/register", RegisterController::class);
   });
   Route::prefix("user")->middleware('auth:sanctum')->group(function () {
      Route::get("/me", UserShowMe::class);
      Route::get("/", UserShow::class);
   });
});
