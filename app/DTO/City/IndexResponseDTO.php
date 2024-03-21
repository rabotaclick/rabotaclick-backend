<?php declare(strict_types=1);

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
