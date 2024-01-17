<?php

use App\Http\Controllers\Auth\LoginPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\ShowController as UserShow;
use App\Http\Controllers\User\ShowMeController as UserShowMe;
use App\Http\Controllers\User\UpdateController as UserUpdate;
use App\Http\Controllers\User\UpdatePhoneController as UserPhoneUpdate;
use App\Http\Controllers\User\DeleteController as UserDelete;
use App\Http\Controllers\VacancyCategory\IndexController as VacancyCategoryIndex;
use App\Http\Controllers\Email\VerifyController;

Route::prefix("v1")->group(function () {
   Route::prefix("auth")->group(function () {

      Route::middleware(['throttle:code'])->post("/code", AuthController::class);
      Route::post("/", LoginController::class);
      Route::middleware('auth:sanctum')->post("/register", RegisterController::class);

      Route::post("/password", LoginPasswordController::class);

   });
   Route::prefix("user")->middleware('auth:sanctum')->group(function () {

      Route::get("/me", UserShowMe::class);
      Route::get("/{id}", UserShow::class);

      Route::middleware(['throttle:user_update'])->put("/", UserUpdate::class);
      Route::put("/phone", UserPhoneUpdate::class);

      Route::delete("/", UserDelete::class);

   });
   Route::prefix("vacancy")->group(function () {

      Route::get("/categories", VacancyCategoryIndex::class);

   });
   Route::prefix("email")->group(function () {

      Route::get('/verify/{token}', VerifyController::class);

   });
});
