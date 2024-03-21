<?php declare(strict_types=1);

namespace App\DTO\Company;

use App\Models\City;
use App\Models\Specialization;
use App\Traits\FilterDataTrait;

readonly class UpdateRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public string|null          $name = null,
        public City|null            $city = null,
        public string|null          $website = null,
        public Specialization|null  $specialization = null,
        public string|null          $phone = null,
        public string|null          $description = null,
    )
    {
    }

    public function toArray()
    {
        $data = [
            'name' => $this->name,
            'city_id' => $this->city->id,
            'website' => $this->website,
            'specialization_id' => $this->specialization->id,
            'phone' => $this->phone,
            'description' => $this->description
        ];

        return $this->filterData($data);
    }
}
