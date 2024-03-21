<?php declare(strict_types=1);

namespace App\DTO\Vacancy;

use App\Models\City;

readonly class IndexRequestDTO
{
    public function __construct(
        public int              $first,
        public int              $page,

        public string|null      $search = null,
        public string           $orderBy,
        public string           $column,
        public string           $date,

        public string|null       $salary = null,
        public bool|null        $isset_salary = null,

        public City|null        $city = null,

        public array|null       $subspecializations = null,

        public string|null      $education = null,

        public string|null      $work_experience = null,
        public string|null      $occupation = null,
        public string|null      $schedule = null,
    )
    {

    }
}
