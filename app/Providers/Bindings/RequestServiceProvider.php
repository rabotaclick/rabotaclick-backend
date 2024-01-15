<?php

namespace App\Providers\Bindings;

use App\Http\Requests\Auth\Contracts\AuthRequestInterface;
use App\Http\Requests\Auth\AuthRequest;
use App\Http\Requests\Auth\Contracts\LoginRequestInterface;
use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(AuthRequestInterface::class, AuthRequest::class);
        $this->app->bind(LoginRequestInterface::class, LoginRequest::class);
        $this->app->bind(RegisterRequestInterface::class, RegisterRequest::class);
    }
}
