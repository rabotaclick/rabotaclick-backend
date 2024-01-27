<?php

namespace App\DTO\Specialization;

use App\Http\Requests\Enums\OrderByEnum;

readonly class IndexRequestDTO
{
    public function __construct(
        public int $first,
        public int $page,
        public OrderByEnum $orderBy,
        public string $column,
        public bool $withSubspecializations
    )
    {
    }
}
