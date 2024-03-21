<?php declare(strict_types=1);

namespace App\DTO\Storage;

readonly class PutManyResponseDTO
{
    public function __construct(
        public array $urls,
    )
    {
    }
}
