<?php

use App\Http\Controllers\Auth\LoginPasswordController;
use Illuminate\Support\Facades\Route;
// Auth Applicant
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController as ApplicantLogin;
use App\Http\Controllers\Auth\RegisterController as ApplicantRegister;
// Auth Employer
use App\Http\Controllers\Auth\Employer\RegisterController as EmployerRegister;
use App\Http\Controllers\Auth\Employer\FinishRegisterController as EmployerFinishRegisterController;
use App\Http\Controllers\Auth\Employer\LoginController as EmployerLogin;
// Company
use App\Http\Controllers\Company\StoreController as CompanyStore;
use App\Http\Controllers\Company\UpdateController as CompanyUpdate;
use App\Http\Controllers\Company\UpdatePhotoController as CompanyUpdatePhoto;
use App\Http\Controllers\Company\ShowMyController as CompanyShowMy;
use App\Http\Controllers\Company\ShowController as CompanyShow;
// UserEmployer
use App\Http\Controllers\UserEmployer\ShowMeController as EmployerShowMe;
use App\Http\Controllers\UserEmployer\UpdateController as EmployerUpdate;
// User
use App\Http\Controllers\User\ShowController as UserShow;
use App\Http\Controllers\User\ShowMeController as UserShowMe;
use App\Http\Controllers\User\UpdateController as UserUpdate;
use App\Http\Controllers\User\UpdatePhoneController as UserPhoneUpdate;
use App\Http\Controllers\User\DeleteController as UserDelete;
// Specialization
use App\Http\Controllers\Specialization\IndexController as SpecializationIndex;
// Subspecialization
use App\Http\Controllers\SubSpecialization\IndexController as SubSpecializationIndex;
// Email
use App\Http\Controllers\Email\VerifyController as ApplicantVerifyController;
use App\Http\Controllers\Email\Employer\VerifyController as EmployerVerifyController;
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
use App\Http\Controllers\Resume\UpdatePhotoController as ResumeUpdatePhoto;
// City
use App\Http\Controllers\City\IndexController as CityIndex;
// Country
use App\Http\Controllers\Country\IndexController as CountryIndex;
// Storage
use App\Http\Controllers\Storage\PutController;
// KeySkill
use App\Http\Controllers\KeySkill\IndexController as KeySkillIndex;
// Language
use App\Http\Controllers\Language\IndexController as LanguageIndex;
// Region
use App\Http\Controllers\Region\IndexController as RegionIndex;

Route::prefix('test')->group(function () {
   Route::get('/ping', function () {
       return true;
   });
});

Route::prefix('v1')->group(function () {
    // Authorization and Verification
    Route::prefix('auth')->group(function () {
        Route::middleware(['throttle:one'])->post("/code", AuthController::class);
        Route::post("/", ApplicantLogin::class);
        Route::middleware(['auth:sanctum', 'type.applicant'])->post("/register", ApplicantRegister::class);

        Route::post('/password', LoginPasswordController::class);

        // Employer Auth
        Route::prefix('employer')->group(function () {
            Route::post('/', EmployerLogin::Class);
            Route::middleware(['throttle:one'])->post('/register', EmployerRegister::class);
            Route::middleware(['auth:sanctum', 'type.employer'])->post('/register/finish', EmployerFinishRegisterController::class);
        });
    });
    Route::prefix('email')->group(function () {
        Route::get('/verify/{token}', ApplicantVerifyController::class);
        Route::get('/employer/verify/{token}', EmployerVerifyController::class);
    });
    // Company
    Route::prefix('company')->group(function () {
        Route::get('/{id}', CompanyShow::class);
    });
    // User Employer
    Route::prefix('employer')->middleware(['auth:sanctum', 'type.employer'])->group(function () {
        Route::get('/me', EmployerShowMe::class);
        Route::put('/', EmployerUpdate::class);
        // User Company
        Route::prefix('company')->middleware(['auth:sanctum', 'type.employer'])->group(function () {
            Route::get('/my', CompanyShowMy::class);
            Route::post('/', CompanyStore::class);
            Route::put('/', CompanyUpdate::class);
            Route::put('/photo', CompanyUpdatePhoto::class);
        });
    });
    // User
    Route::prefix('user')->middleware(['auth:sanctum', 'type.applicant'])->group(function () {
        Route::get('/me', UserShowMe::class);
        Route::get('/{id}', UserShow::class);

        Route::middleware(['throttle:three'])->put("/", UserUpdate::class);
        Route::put('/phone', UserPhoneUpdate::class);

        Route::delete('/', UserDelete::class);
        // User Resume
        Route::prefix('resume')->group(function () {
            Route::post('/', ResumeStore::class);
            Route::delete('/{id}', ResumeDelete::class);
            Route::put('/{id}/personal', ResumeUpdatePersonal::class);
            Route::put('/{id}/contacts', ResumeUpdateContacts::class);
            Route::put('/{id}/profession', ResumeUpdateProfession::class);
            Route::put('/{id}/working_history', ResumeUpdateWorkingHistory::class);
            Route::put('/{id}/education', ResumeUpdateEducation::class);
            Route::put('/{id}/languages', ResumeUpdateLanguages::class);
            Route::put('/{id}/photo', ResumeUpdatePhoto::class);
        });

    });
    // Resumes
    Route::prefix('resumes')->group(function () {
        Route::get('/{id}', ResumeShow::class);
        Route::post('/', ResumeIndex::class);
    });
    // Storage
    Route::prefix('storage')->group(function () {
        Route::post('/put', PutController::class);
    });
    // Static Models
    Route::prefix('key_skills')->group(function () {
        Route::get('/', KeySkillIndex::class);
    });
    Route::prefix('cities')->group(function () {
        Route::get('/', CityIndex::class);
    });
    Route::prefix('regions')->group(function () {
        Route::get('/', RegionIndex::class);
    });
    Route::prefix("countries")->group(function () {
        Route::get('/', CountryIndex::class);
    });
    Route::prefix('specializations')->group(function () {
        Route::get('/', SpecializationIndex::class);
    });
    Route::prefix('subspecializations')->group(function () {
        Route::get('/', SubSpecializationIndex::class);
    });
    Route::prefix('languages')->group(function () {
        Route::get('/', LanguageIndex::class);
    });
});
