<?php

namespace App\DTO\VacancyCategory;

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
