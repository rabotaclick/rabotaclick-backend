<?php

namespace App\DTO\Resume;

use App\Traits\FilterDataTrait;
use Illuminate\Database\Eloquent\Collection;

readonly class UpdateWorkingHistoryRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public array|null       $work_histories = null,
        public array|null       $key_skills = null,
        public string|null      $about_me = null,
        public bool|null        $have_car = null,
        public array|null       $driver_categories = null
    )
    {
    }

    public function toArray()
    {
        $data = [
            "about_me" => $this->about_me,
            "have_car" => $this->have_car,
        ];

        return $this->filterData($data);
    }
}
