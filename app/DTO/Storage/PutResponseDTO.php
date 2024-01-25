<?php

namespace App\DTO\Storage;

class PutResponseDTO
{
    public function __construct(
        public array $urls,
    )
    {
    }
}
