<?php

namespace App\DTO\Resume;

use App\Traits\FilterDataTrait;
use Illuminate\Database\Eloquent\Collection;

readonly class UpdateProfessionRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public string|null  $profession = null,
        public array|null   $subspecializations = null,
        public int|null     $salary = null,
        public string|null  $occupation = null,
        public string|null  $schedule = null,
        public string|null  $travel_time = null,
    )
    {
    }

    public function toArray(): array
    {
        $data = [
            'profession' => $this->profession,
            'subspecializations' => $this->subspecializations,
            'salary' => $this->salary,
            'occupation' => $this->occupation,
            'schedule' => $this->schedule,
            'travel_time' => $this->travel_time
        ];

        return $this->filterData($data);
    }
}
