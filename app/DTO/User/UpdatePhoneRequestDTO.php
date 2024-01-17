<?php

namespace App\DTO\User;

readonly class UpdatePhoneRequestDTO
{
    public function __construct(
        public int $code,
    )
    {
    }
}
