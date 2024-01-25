<?php

namespace App\DTO\Storage;

readonly class PutResponseDTO
{
    public function __construct(
        public array $urls,
    )
    {
    }
}
