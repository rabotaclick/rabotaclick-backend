<?php

namespace App\DTO\Auth;

readonly class RegisterRequestDTO
{
    public function __construct(
        public string $name,
        public string $surname
    )
    {
    }
}
