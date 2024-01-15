<?php

namespace App\Providers\Bindings;

use App\Helpers\Contracts\EnumHelperInterface;
use App\Helpers\Contracts\EventDispatcherInterface;
use App\Helpers\Contracts\RequestFilterHelperInterface;
use App\Helpers\EnumHelper;
use App\Helpers\RequestFilterHelper;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\EventDispatcher\EventDispatcher;

class HelperServiceProvider extends ServiceProvider
{
    public const PARAM_REQUEST_PARAMS = 'requestParams';

    public function register(): void
    {
        $this->app->bind(EnumHelperInterface::class, EnumHelper::class);

        $this->app->bind(
            RequestFilterHelperInterface::class,
            fn(Application $app, array $params) => new RequestFilterHelper($params[self::PARAM_REQUEST_PARAMS])
        );

        $this->app->bind(EventDispatcherInterface::class, EventDispatcher::class);
    }
}
