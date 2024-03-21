<?php declare(strict_types=1);

namespace App\DTO\Vacancy;

use App\Models\Vacancy;

readonly class VacancyDTO
{
    public function __construct(
        public Vacancy $vacancy
    )
    {
    }
}
