<?php declare(strict_types=1);

namespace App\DTO\Auth\Employer;

readonly class RegisterRequestDTO
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }
}
