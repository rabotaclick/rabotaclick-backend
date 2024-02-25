<?php

namespace App\DTO\Company;

readonly class UpdatePhotoRequestDTO
{
    public function __construct(
        public string|null $url = null
    )
    {
    }
}
