<?php

namespace App\DTO\UserEmployer;

use App\Traits\FilterDataTrait;

readonly class UpdateRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public string|null  $name,
        public string|null  $surname,
        public string|null  $lastname,
        public string|null  $password,
        public string|null  $new_password,
    )
    {
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'surname' => $this->surname,
            'lastname' => $this->lastname,
        ];

        return $this->filterData($data);
    }
}
