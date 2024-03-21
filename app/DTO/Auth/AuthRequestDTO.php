<?php declare(strict_types=1);

namespace App\DTO\Auth;

readonly class AuthRequestDTO
{
    public function __construct(
        public string $phone
    )
    {
    }
}
