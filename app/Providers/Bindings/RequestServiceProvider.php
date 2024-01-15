<?php

namespace App\Providers\Bindings;

use App\Http\Requests\Auth\Contracts\RegisterRequestInterface;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\ServiceProvider;

class RequestServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(RegisterRequestInterface::class, RegisterRequest::class);
    }
}
