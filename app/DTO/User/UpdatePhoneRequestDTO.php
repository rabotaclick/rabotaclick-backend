<?php declare(strict_types=1);

namespace App\DTO\User;

readonly class UpdatePhoneRequestDTO
{
    public function __construct(
        public int $code,
    )
    {
    }
}
