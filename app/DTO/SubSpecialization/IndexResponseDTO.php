<?php

namespace App\DTO\SubSpecialization;

use Illuminate\Database\Eloquent\Collection;

readonly class IndexResponseDTO
{
    public function __construct(
        public Collection $subspecializations,
        public int        $totalRowCount
    )
    {
    }
}
