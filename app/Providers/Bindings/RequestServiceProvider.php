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
// User
use App\Http\Requests\User\Contracts\UpdatePhoneRequestInterface as UserUpdatePhoneRequestInterface;
use App\Http\Requests\User\Contracts\UpdateRequestInterface as UserUpdateRequestInterface;
use App\Http\Requests\User\UpdatePhoneRequest as UserUpdatePhoneRequest;
use App\Http\Requests\User\UpdateRequest as UserUpdateRequest;
// Specialization
use App\Http\Requests\Specialization\Contracts\IndexRequestInterface as SpecializationIndexRequestInterface;
use App\Http\Requests\Specialization\IndexRequest as SpecializationIndexRequest;
use Illuminate\Support\ServiceProvider;
// Storage
use App\Http\Requests\Storage\Contracts\PutRequestInterface;
use App\Http\Requests\Storage\PutRequest;

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
        // User requests
        $this->app->bind(UserUpdateRequestInterface::class, UserUpdateRequest::class);
        $this->app->bind(UserUpdatePhoneRequestInterface::class, UserUpdatePhoneRequest::class);
        // Resume requests
        $this->app->bind(ResumeStoreRequestInterface::class, ResumeStoreRequest::class);
        $this->app->bind(ResumeUpdatePersonalRequestInterface::class, ResumeUpdatePersonalRequest::class);
        $this->app->bind(ResumeUpdateContactsRequestInterface::class, ResumeUpdateContactsRequest::class);
        $this->app->bind(ResumeUpdateProfessionRequestInterface::class, ResumeUpdateProfessionRequest::class);
        $this->app->bind(ResumeUpdateWorkingHistoryRequestInterface::class, ResumeUpdateWorkingHistoryRequest::class);
        // City requests
        $this->app->bind(CityIndexRequestInterface::class, CityIndexRequest::class);
        // Storage requests
        $this->app->bind(PutRequestInterface::class, PutRequest::class);
    }
}
