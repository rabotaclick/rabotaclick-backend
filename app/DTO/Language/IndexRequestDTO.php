<?php

namespace App\DTO\Language;

readonly class IndexRequestDTO
{
    public function __construct(
        public string|null $search = null,
    )
    {
    }
}
