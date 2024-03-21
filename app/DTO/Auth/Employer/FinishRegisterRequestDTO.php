<?php declare(strict_types=1);

namespace App\DTO\Auth\Employer;

readonly class FinishRegisterRequestDTO
{
    public function __construct(
        public string $name,
        public string $surname
    )
    {
    }
}
