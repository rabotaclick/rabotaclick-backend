<?php

namespace App\DTO\Resume;

use Illuminate\Pagination\LengthAwarePaginator;

readonly class IndexResponseDTO
{
    public function __construct(
        public LengthAwarePaginator $resumes,
    )
    {
    }
}
