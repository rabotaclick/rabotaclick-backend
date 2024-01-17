<?php

namespace App\DTO\User;

use Illuminate\Contracts\Support\Arrayable;

readonly class UpdateRequestDTO implements Arrayable
{
    public function __construct(
        public string|null $name = null,
        public string|null $surname = null,
        public string|null $lastname = null,
        public string|null $password = null,
        public string|null $change_email = null,
    )
    {
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'surname' => $this->surname,
            'lastname' => $this->lastname,
            'password' => $this->password,
            'change_email' => $this->change_email,
        ];
    }
}
