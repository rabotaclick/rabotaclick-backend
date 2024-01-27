<?php

namespace App\Custom\Scout\Commands;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Console\SyncIndexSettingsCommand;
use Laravel\Scout\EngineManager;

class ExtendedSyncIndexSettingsCommand extends SyncIndexSettingsCommand
{
    public function handle(EngineManager $manager)
    {
        $engine = $manager->engine();

        $driver = config('scout.driver');

        if($driver == 'extendedmeilisearch') {
            $driver = 'meilisearch';
        }

        if (! method_exists($engine, 'updateIndexSettings')) {
            return $this->error('The "'.$driver.'" engine does not support updating index settings.');
        }

        try {
            $indexes = (array) config('scout.'.$driver.'.index-settings', []);

            if (count($indexes)) {
                foreach ($indexes as $name => $settings) {
                    if (! is_array($settings)) {
                        $name = $settings;

                        $settings = [];
                    }

                    if (class_exists($name)) {
                        $model = new $name;
                    }

                    if (isset($model) &&
                        config('scout.soft_delete', false) &&
                        in_array(SoftDeletes::class, class_uses_recursive($model))) {
                        $settings['filterableAttributes'][] = '__soft_deleted';
                    }

                    $engine->updateIndexSettings($indexName = $this->indexName($name), $settings);

                    $this->info('Settings for the ['.$indexName.'] index synced successfully.');
                }
            } else {
                $this->info('No index settings found for the "'.$driver.'" engine.');
            }
        } catch (Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
