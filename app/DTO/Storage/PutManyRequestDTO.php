<?php

namespace App\DTO\Storage;

use Illuminate\Http\UploadedFile;

readonly class PutManyRequestDTO
{
    public function __construct(
        public array|UploadedFile $file_array
    )
    {
    }
}
