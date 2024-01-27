<?php

namespace App\DTO\KeySkill;

readonly class IndexRequestDTO
{
    public function __construct(
        public string|null $search = null
    )
    {
    }
}
