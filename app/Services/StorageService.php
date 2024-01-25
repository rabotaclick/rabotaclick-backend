<?php

namespace App\Services;

use App\DTO\Storage\PutRequestDTO;
use App\DTO\Storage\PutResponseDTO;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    public function __construct(
        public array $urls = []
    )
    {
    }

    public function put(PutRequestDTO $requestDTO): PutResponseDTO
    {
        $disk = "photos/";
        foreach ($requestDTO->file_array as $file) {
            $imagePath = $disk . $file->getFilename() . ".webp";
            Storage::disk('s3')->put($imagePath, file_get_contents($file));
            $this->urls[] = Storage::disk('s3')->url($imagePath);
        }

        return new PutResponseDTO(
            $this->urls
        );
    }
}
