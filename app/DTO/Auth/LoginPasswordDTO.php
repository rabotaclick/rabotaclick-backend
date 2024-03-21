<?php declare(strict_types=1);

namespace App\DTO\Auth;

readonly class LoginPasswordDTO
{
    public function __construct(
        public string $login,
        public string $password,
    )
    {
    }
}
