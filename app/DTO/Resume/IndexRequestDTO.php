<?php

namespace App\DTO\Resume;

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

        public City|null        $city = null,

        public string|null      $ready_to_move = null,

        public array|null       $work_history_specializations = null,
        public string|null      $user_status = null,

        public array|null       $age = null,
        public bool|null        $isset_age = null,

        public string|null      $occupation = null,
        public string|null      $schedule = null,
        public string|null      $work_experience = null,

        public array|null       $subspecializations = null,

        public string|null      $gender = null,
        public bool|null        $isset_gender,

        public array|null       $salary = null,
        public bool|null        $isset_salary = null,

        public string|null      $education = null,
    )
    {
    }
}
