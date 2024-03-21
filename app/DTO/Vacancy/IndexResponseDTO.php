<?php declare(strict_types=1);

namespace App\DTO\Vacancy;

use Illuminate\Pagination\LengthAwarePaginator;

readonly class IndexResponseDTO
{
    public function __construct(
        public LengthAwarePaginator $vacancies
    )
    {

    }
}
