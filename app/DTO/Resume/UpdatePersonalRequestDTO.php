<?php

namespace App\DTO\Resume;

use App\Models\City;
use App\Models\Country;
use App\Traits\FilterDataTrait;
use Carbon\Carbon;
use function PHPUnit\Framework\isNull;

readonly class UpdatePersonalRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public string|null  $surname = null,
        public string|null  $name = null,
        public string|null  $lastname = null,
        public Carbon|null  $birthdate = null,
        public string|null  $gender = null,
        public City|null    $city = null,
        public string|null  $ready_to_move = null,
        public string|null  $business_trips = null,
        public Country|null $citizenship = null,
        public Country|null $work_permit = null,
    )
    {
    }

    public function toArray(): array
    {
        $data = [
            'surname' => $this->surname,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'birthdate' => $this->birthdate->format('Y-m-d'),
            'gender' => $this->gender,
            'city_id' => $this->city->id ?? null,
            'ready_to_move' => $this->ready_to_move,
            'business_trips' => $this->business_trips,
            'citizenship_country_id' => $this->citizenship->id ?? null,
            'work_permit_country_id' => $this->work_permit->id ?? null,
        ];

        return $this->filterData($data);
    }
}
