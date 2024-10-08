<?php declare(strict_types=1);
namespace App\UseCases\Storage;

use App\DTO\Storage\PutManyRequestDTO;
use App\DTO\Storage\PutManyResponseDTO;
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

    public function execute(PutManyRequestDTO $requestDTO): PutManyResponseDTO
    {
        try {
            $response = $this->storageService->putMany($requestDTO, 'photos/');
            return $response;
        } catch (\Throwable $exception) {
            throw new PutUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
