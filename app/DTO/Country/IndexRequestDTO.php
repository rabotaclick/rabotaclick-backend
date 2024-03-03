<?php

namespace App\DTO\Country;

readonly class IndexRequestDTO
{
    public function __construct(
        public string|null $search = null,
    )
    {

    }
}
