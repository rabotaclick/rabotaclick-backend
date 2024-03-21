<?php declare(strict_types=1);

namespace App\DTO\Language;

use Illuminate\Database\Eloquent\Collection;

readonly class IndexResponseDTO
{
    public function __construct(
        public Collection $languages,
        public int $totalRowCount,
    )
    {
    }
}
