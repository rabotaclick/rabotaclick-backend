<?php

namespace App\DTO\Specialization;

use Illuminate\Pagination\LengthAwarePaginator;

readonly class IndexResponseDTO
{
    public function __construct(
        public LengthAwarePaginator $collection,
        public int  $totalRowCount,
        public bool $withSubspecializations
    )
    {
    }
}
