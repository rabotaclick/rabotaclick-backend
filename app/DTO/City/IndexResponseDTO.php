<?php

namespace App\DTO\City;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

readonly class IndexResponseDTO
{
    public function __construct(
        public LengthAwarePaginator $collection,
        public int  $totalRowCount
    )
    {
    }
}
