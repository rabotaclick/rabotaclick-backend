<?php

namespace App\DTO\City;

use App\Http\Requests\Enums\OrderByEnum;

readonly class IndexRequestDTO
{
    public function __construct(
        public int $first,
        public int $page,
        public string|null $search = null,
        public string|null $letter = null,
    )
    {
    }
}
