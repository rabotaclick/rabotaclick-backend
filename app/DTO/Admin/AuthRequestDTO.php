<?php

namespace App\DTO\Admin;

readonly class AuthRequestDTO
{
    public function __construct(
        public string $login,
        public string $password
    )
    {
    }
}
