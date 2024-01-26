<?php

namespace App\DTO\Resume;

readonly class UpdatePhotoRequestDTO
{
    public function __construct(
        public string|null $url = null
    )
    {
    }
}
