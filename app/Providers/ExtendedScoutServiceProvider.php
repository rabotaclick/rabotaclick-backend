<?php

namespace App\Providers;

use App\Custom\Scout\Commands\ExtendedSyncIndexSettingsCommand;
use Laravel\Scout\Console\DeleteAllIndexesCommand;
use Laravel\Scout\Console\DeleteIndexCommand;
use Laravel\Scout\Console\FlushCommand;
use Laravel\Scout\Console\ImportCommand;
use Laravel\Scout\Console\IndexCommand;
use Laravel\Scout\ScoutServiceProvider;

class ExtendedScoutServiceProvider extends ScoutServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FlushCommand::class,
                ImportCommand::class,
                IndexCommand::class,
                ExtendedSyncIndexSettingsCommand::class,
                DeleteIndexCommand::class,
                DeleteAllIndexesCommand::class,
            ]);

            $this->publishes([
                __DIR__.'/../config/scout.php' => $this->app['path.config'].DIRECTORY_SEPARATOR.'scout.php',
            ]);
        }
    }
}
