<?php declare(strict_types=1);

namespace App\DTO\Auth;

readonly class LoginRequestDTO
{
    public function __construct(
        public int $code,
        public string $phone
    )
    {
    }
}
