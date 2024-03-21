<?php declare(strict_types=1);
namespace App\UseCases\SubSpecialization;

use App\DTO\SubSpecialization\IndexRequestDTO;
use App\DTO\SubSpecialization\IndexResponseDTO;
use App\Repositories\SubSpecialization\IndexRepository;
use App\UseCases\SubSpecialization\Exceptions\IndexUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class IndexUseCase
{
    public function __construct(
        private IndexRepository $repository,
    )
    {
    }

    public function execute(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new IndexUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
