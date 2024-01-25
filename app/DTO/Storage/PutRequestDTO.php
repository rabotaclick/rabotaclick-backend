<?php

namespace App\DTO\Storage;

use Illuminate\Http\UploadedFile;

readonly class PutRequestDTO
{
    public function __construct(
        public array|UploadedFile $file_array
    )
    {
    }
}
