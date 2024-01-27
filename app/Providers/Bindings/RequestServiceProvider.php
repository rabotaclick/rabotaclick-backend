<?php

namespace App\Providers\Bindings;

// Auth
use App\Http\Requests\Auth\Contracts\AuthRequestInterface;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\Contracts\LoginPasswordRequestInterface;
use App\Http\Requests\Auth\Contracts\LoginRequestInterface;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use App\Http\Requests\Auth\LoginPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
// City
use App\Http\Requests\City\Contracts\IndexRequestInterface as CityIndexRequestInterface;
use App\Http\Requests\City\IndexRequest as CityIndexRequest;
// Resume
use App\Http\Requests\Resume\Contracts\StoreRequestInterface as ResumeStoreRequestInterface;
use App\Http\Requests\Resume\Contracts\UpdateContactsRequestInterface as ResumeUpdateContactsRequestInterface;
use App\Http\Requests\Resume\Contracts\UpdatePersonalRequestInterface as ResumeUpdatePersonalRequestInterface;
use App\Http\Requests\Resume\Contracts\UpdateProfessionRequestInterface as ResumeUpdateProfessionRequestInterface;
use App\Http\Requests\Resume\StoreRequest as ResumeStoreRequest;
use App\Http\Requests\Resume\UpdateContactsRequest as ResumeUpdateContactsRequest;
use App\Http\Requests\Resume\UpdatePersonalRequest as ResumeUpdatePersonalRequest;
use App\Http\Requests\Resume\UpdateProfessionRequest as ResumeUpdateProfessionRequest;
use App\Http\Requests\Resume\Contracts\UpdateWorkingHistoryRequestInterface as ResumeUpdateWorkingHistoryRequestInterface;
use App\Http\Requests\Resume\UpdateWorkingHistoryRequest as ResumeUpdateWorkingHistoryRequest;
use App\Http\Requests\Resume\Contracts\UpdateEducationRequestInterface as ResumeUpdateEducationRequestInterface;
use App\Http\Requests\Resume\UpdateEducationRequest as ResumeUpdateEducationRequest;
use App\Http\Requests\Resume\Contracts\UpdateLanguagesRequestInterface as ResumeUpdateLanguagesRequestInterface;
use App\Http\Requests\Resume\UpdateLanguagesRequest as ResumeUpdateLanguagesRequest;
use App\Http\Requests\Resume\Contracts\UpdatePhotoRequestInterface as ResumeUpdatePhotoRequestInterface;
use App\Http\Requests\Resume\UpdatePhotoRequest as ResumeUpdatePhotoRequest;
// User
use App\Http\Requests\User\Contracts\UpdatePhoneRequestInterface as UserUpdatePhoneRequestInterface;
use App\Http\Requests\User\Contracts\UpdateRequestInterface as UserUpdateRequestInterface;
use App\Http\Requests\User\UpdatePhoneRequest as UserUpdatePhoneRequest;
use App\Http\Requests\User\UpdateRequest as UserUpdateRequest;
// Specialization
use App\Http\Requests\Specialization\Contracts\IndexRequestInterface as SpecializationIndexRequestInterface;
use App\Http\Requests\Specialization\IndexRequest as SpecializationIndexRequest;
use Illuminate\Support\ServiceProvider;
// SubSpecialization
use App\Http\Requests\SubSpecialization\Contracts\IndexRequestInterface as SubSpecializationIndexRequestInterface;
use App\Http\Requests\SubSpecialization\IndexRequest as SubSpecializationIndexRequest;
// Storage
use App\Http\Requests\Storage\Contracts\PutRequestInterface;
use App\Http\Requests\Storage\PutRequest;
// KeySkill
use App\Http\Requests\KeySkill\Contracts\IndexRequestInterface as KeySkillIndexRequestInterface;
use App\Http\Requests\KeySkill\IndexRequest as KeySkillIndexRequest;
// Language
use App\Http\Requests\Language\Contracts\IndexRequestInterface as LanguageIndexRequestInterface;
use App\Http\Requests\Language\IndexRequest as LanguageIndexRequest;

class RequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Auth requests
        $this->app->bind(AuthRequestInterface::class, AuthRequest::class);
        $this->app->bind(LoginRequestInterface::class, LoginRequest::class);
        $this->app->bind(RegisterRequestInterface::class, RegisterRequest::class);
        $this->app->bind(LoginPasswordRequestInterface::class, LoginPasswordRequest::class);
        // Specialization requests
        $this->app->bind(SpecializationIndexRequestInterface::class, SpecializationIndexRequest::class);
        // SubSpecialization requests
        $this->app->bind(SubSpecializationIndexRequestInterface::class, SubSpecializationIndexRequest::class);
        // User requests
        $this->app->bind(UserUpdateRequestInterface::class, UserUpdateRequest::class);
        $this->app->bind(UserUpdatePhoneRequestInterface::class, UserUpdatePhoneRequest::class);
        // Resume requests
        $this->app->bind(ResumeStoreRequestInterface::class, ResumeStoreRequest::class);
        $this->app->bind(ResumeUpdatePersonalRequestInterface::class, ResumeUpdatePersonalRequest::class);
        $this->app->bind(ResumeUpdateContactsRequestInterface::class, ResumeUpdateContactsRequest::class);
        $this->app->bind(ResumeUpdateProfessionRequestInterface::class, ResumeUpdateProfessionRequest::class);
        $this->app->bind(ResumeUpdateWorkingHistoryRequestInterface::class, ResumeUpdateWorkingHistoryRequest::class);
        $this->app->bind(ResumeUpdateEducationRequestInterface::class, ResumeUpdateEducationRequest::class);
        $this->app->bind(ResumeUpdateLanguagesRequestInterface::class, ResumeUpdateLanguagesRequest::class);
        $this->app->bind(ResumeUpdatePhotoRequestInterface::class, ResumeUpdatePhotoRequest::class);
        // City requests
        $this->app->bind(CityIndexRequestInterface::class, CityIndexRequest::class);
        // Storage requests
        $this->app->bind(PutRequestInterface::class, PutRequest::class);
        // KeySkill requests
        $this->app->bind(KeySkillIndexRequestInterface::class, KeySkillIndexRequest::class);
        // Language requests
        $this->app->bind(LanguageIndexRequestInterface::class, LanguageIndexRequest::class);
    }
}
