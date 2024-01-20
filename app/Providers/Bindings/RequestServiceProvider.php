<?php

namespace App\Providers\Bindings;

use App\Http\Requests\Auth\Contracts\AuthRequestInterface;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\Contracts\LoginPasswordRequestInterface;
use App\Http\Requests\Auth\Contracts\LoginRequestInterface;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use App\Http\Requests\Auth\LoginPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Resume\Contracts\StoreRequestInterface as ResumeStoreRequestInterface;
use App\Http\Requests\Resume\StoreRequest as ResumeStoreRequest;
use App\Http\Requests\User\Contracts\UpdatePhoneRequestInterface as UserUpdatePhoneRequestInterface;
use App\Http\Requests\User\Contracts\UpdateRequestInterface as UserUpdateRequestInterface;
use App\Http\Requests\User\UpdatePhoneRequest as UserUpdatePhoneRequest;
use App\Http\Requests\User\UpdateRequest as UserUpdateRequest;
use App\Http\Requests\Specialization\Contracts\IndexRequestInterface as SpecializationIndexRequestInterface;
use App\Http\Requests\Specialization\IndexRequest as SpecializationIndexRequest;
use Illuminate\Support\ServiceProvider;

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
    }
}
