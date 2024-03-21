<?php declare(strict_types=1);

namespace App\DTO\Storage;

readonly class PutOneResponseDTO
{
    public function __construct(
        public string $url
    )
    {
    }
}
