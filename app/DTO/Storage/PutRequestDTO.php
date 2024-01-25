<?php

namespace App\DTO\Storage;

use Illuminate\Http\UploadedFile;

class PutRequestDTO
{
    public function __construct(
        public array|UploadedFile $file_array
    )
    {
    }
}
