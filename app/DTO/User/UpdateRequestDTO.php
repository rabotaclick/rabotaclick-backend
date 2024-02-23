<?php

namespace App\DTO\User;

use App\Traits\FilterDataTrait;
use Illuminate\Contracts\Support\Arrayable;

readonly class UpdateRequestDTO implements Arrayable
{
    use FilterDataTrait;
    public function __construct(
        public string|null $name = null,
        public string|null $surname = null,
        public string|null $lastname = null,
        public string|null $status = null,
        public string|null $password = null,
        public string|null $new_password = null,
        public string|null $change_email = null,
        public string|null $change_phone = null,
    )
    {
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'surname' => $this->surname,
            'lastname' => $this->lastname,
            'status' => $this->status,
            'change_email' => $this->change_email,
            'change_phone' => $this->change_phone
        ];

        return $this->filterData($data);
    }
}
