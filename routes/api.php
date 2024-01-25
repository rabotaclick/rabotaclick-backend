<?php

use App\Http\Controllers\Auth\LoginPasswordController;
use Illuminate\Support\Facades\Route;
// Auth
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
// User
use App\Http\Controllers\User\ShowController as UserShow;
use App\Http\Controllers\User\ShowMeController as UserShowMe;
use App\Http\Controllers\User\UpdateController as UserUpdate;
use App\Http\Controllers\User\UpdatePhoneController as UserPhoneUpdate;
use App\Http\Controllers\User\DeleteController as UserDelete;
// Specialization
use App\Http\Controllers\Specialization\IndexController as SpecializationIndex;
// Email
use App\Http\Controllers\Email\VerifyController;
// Resume
use App\Http\Controllers\Resume\StoreController as ResumeStore;
use App\Http\Controllers\Resume\DeleteController as ResumeDelete;
use App\Http\Controllers\Resume\ShowController as ResumeShow;
use App\Http\Controllers\Resume\IndexController as ResumeIndex;
use App\Http\Controllers\Resume\UpdatePersonalController as ResumeUpdatePersonal;
use App\Http\Controllers\Resume\UpdateContactsController as ResumeUpdateContacts;
use App\Http\Controllers\Resume\UpdateProfessionController as ResumeUpdateProfession;
use App\Http\Controllers\Resume\UpdateWorkingHistoryController as ResumeUpdateWorkingHistory;
use App\Http\Controllers\Resume\UpdateEducationController as ResumeUpdateEducation;
use App\Http\Controllers\Resume\UpdateLanguagesController as ResumeUpdateLanguages;
// City
use App\Http\Controllers\City\IndexController as CityIndex;
// Storage
use App\Http\Controllers\Storage\PutController;

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

      Route::prefix('resume')->group(function () {
         Route::post('/', ResumeStore::class);
         Route::get('/{id}', ResumeShow::class);
         Route::get('/', ResumeIndex::class);
         Route::delete('/{id}', ResumeDelete::class);
         Route::put('/{id}/personal', ResumeUpdatePersonal::class);
         Route::put('/{id}/contacts', ResumeUpdateContacts::class);
         Route::put('/{id}/profession', ResumeUpdateProfession::class);
         Route::put('/{id}/working_history', ResumeUpdateWorkingHistory::class);
         Route::put('/{id}/education', ResumeUpdateEducation::class);
         Route::put('/{id}/languages', ResumeUpdateLanguages::class);
         Route::put('/{id}/photo', );
      });

   });
   Route::prefix("cities")->group(function () {
        Route::get('/', CityIndex::class);
   });
   Route::prefix("specializations")->group(function () {

      Route::get("/", SpecializationIndex::class);

   });
   Route::prefix("email")->group(function () {

      Route::get('/verify/{token}', VerifyController::class);

   });
   Route::prefix('storage')->group(function () {
      Route::post('/put', PutController::class);
   });
});
