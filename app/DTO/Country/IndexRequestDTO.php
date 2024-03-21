<?php declare(strict_types=1);

namespace App\DTO\Country;

readonly class IndexRequestDTO
{
    public function __construct(
        public string|null $search = null,
    )
    {

    }
}
