<?php

namespace App\DTO\Auth;

readonly class LoginRequestDTO
{
    public function __construct(
        public string $code,
        public string $phone
    )
    {
    }
}
