<?php

namespace App\Custom\Scout;

use Laravel\Scout\Searchable;

trait ExtendedSearchable
{
    use Searchable {
        Searchable::search as parentSearch;
    }

    public static function search($query = '', $callback = null)
    {
        return app(\App\Custom\Scout\Builder::class, [
            'model' => new static,
            'query' => $query,
            'callback' => $callback,
            'softDelete' => static::usesSoftDelete() && config('scout.soft_delete', false),
        ]);
    }
}
