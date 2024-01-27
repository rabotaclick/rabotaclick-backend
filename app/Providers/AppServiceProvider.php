<?php

namespace App\Providers;

use App\Custom\Scout\ExtendedMeiliSearchEngine;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Meilisearch\Client as MeilisearchClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $container = resolve(EngineManager::class)->getContainer();
        resolve(EngineManager::class)->extend('extendedmeilisearch', function () use($container) {
            return new ExtendedMeiliSearchEngine(
                $container->make(MeilisearchClient::class),
                config('scout.soft_delete', false)
            );
        });
    }
}
