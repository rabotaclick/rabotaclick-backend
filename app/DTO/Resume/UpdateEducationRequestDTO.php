<?php

namespace App\DTO\Resume;

readonly class UpdateEducationRequestDTO
{
    public function __construct(
        public array|null $education_places = null,
    )
    {
    }
}
