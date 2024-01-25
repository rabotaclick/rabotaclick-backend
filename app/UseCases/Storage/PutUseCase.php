<?php

namespace App\UseCases\Storage;

use App\DTO\Storage\PutRequestDTO;
use App\DTO\Storage\PutResponseDTO;
use App\Services\StorageService;
use App\UseCases\Storage\Exceptions\PutUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class PutUseCase
{
    public function __construct(
        private StorageService $storageService
    )
    {
    }

    public function execute(PutRequestDTO $requestDTO): PutResponseDTO
    {
        try {
            $response = $this->storageService->put($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new PutUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
