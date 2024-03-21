<?php declare(strict_types=1);

namespace App\DTO\Resume;

readonly class UpdateEducationRequestDTO
{
    public function __construct(
        public array|null $education_places = null,
    )
    {
    }
}
