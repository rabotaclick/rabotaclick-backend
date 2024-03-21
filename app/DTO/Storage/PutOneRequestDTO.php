<?php declare(strict_types=1);

namespace App\DTO\Storage;

use Illuminate\Http\UploadedFile;

readonly class PutOneRequestDTO
{
    public function __construct(
        public UploadedFile $file
    )
    {
    }
}
