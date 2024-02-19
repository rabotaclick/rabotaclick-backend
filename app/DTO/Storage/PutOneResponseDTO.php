<?php

namespace App\DTO\Storage;

readonly class PutOneResponseDTO
{
    public function __construct(
        public string $url
    )
    {
    }
}
