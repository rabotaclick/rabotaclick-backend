<?php

namespace App\DTO\Auth\Employer;

readonly class LoginRequestDTO
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }
}
