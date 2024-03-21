<?php declare(strict_types=1);

namespace App\DTO\Resume;

readonly class UpdatePhotoRequestDTO
{
    public function __construct(
        public string|null $url = null
    )
    {
    }
}
