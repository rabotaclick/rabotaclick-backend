<?php declare(strict_types=1);

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
