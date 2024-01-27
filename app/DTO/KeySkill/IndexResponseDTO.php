<?php

namespace App\DTO\KeySkill;

use Illuminate\Database\Eloquent\Collection;

readonly class IndexResponseDTO
{
    public function __construct(
        public Collection $key_skills,
        public int $totalRowCount
    )
    {
    }
}
