<?php

namespace App\DTO\Region;

use Illuminate\Database\Eloquent\Collection;

readonly class IndexResponseDTO
{
    public function __construct(
        public Collection $regions,
        public int $totalRowCount
    )
    {
    }
}
