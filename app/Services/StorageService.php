<?php declare(strict_types=1);

namespace App\Services;

use App\DTO\Storage\PutManyRequestDTO;
use App\DTO\Storage\PutManyResponseDTO;
use App\DTO\Storage\PutOneRequestDTO;
use App\DTO\Storage\PutOneResponseDTO;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    public function putOne(PutOneRequestDTO $requestDTO, string $disk): PutOneResponseDTO
    {
        $file = $requestDTO->file;
        $filePath = $disk . $file->getFilename() . $file->getClientOriginalExtension();
        Storage::disk('s3')->put($filePath, file_get_contents($file));
        $url = Storage::disk('s3')->url($filePath);

        return new PutOneResponseDTO(
            $url
        );

    }
    public function putMany(PutManyRequestDTO $requestDTO, string $disk): PutManyResponseDTO
    {
        $urls = [];
        foreach ($requestDTO->file_array as $file) {
            $filePath = $disk . $file->getFilename() . $file->getClientOriginalExtension();
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $urls[] = Storage::disk('s3')->url($filePath);
        }

        return new PutManyResponseDTO(
            $urls
        );
    }
}
