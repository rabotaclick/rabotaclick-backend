<?php

namespace App\Custom\Scout;

use Laravel\Scout\Builder;
use Laravel\Scout\Engines\MeilisearchEngine;

class ExtendedMeiliSearchEngine extends MeilisearchEngine
{
    /**
     * Get the filter array for the query.
     *
     * @param  \Laravel\Scout\Builder  $builder
     * @return string
     */
    protected function filters(Builder $builder)
    {
        $wheres = $builder->wheres;

        $filters = null;

        foreach ($wheres as $key => $value) {
            $expression = $value['operator'] == 'TO'
                ? "{$key} {$value['value'][0]} {$value['operator']} {$value['value'][1]}"
                : "{$key}{$value['operator']}{$value['value']}";

            $filters = is_null($filters) ? $expression : "{$filters} AND {$expression}";
        }

        return $filters;
    }
}
