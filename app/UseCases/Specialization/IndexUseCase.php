<?php declare(strict_types=1);
namespace App\UseCases\Specialization;

use App\DTO\Specialization\IndexRequestDTO;
use App\DTO\Specialization\IndexResponseDTO;
use App\Repositories\Specialization\IndexRepository;
use App\UseCases\Specialization\Exceptions\IndexUseCasesException;
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
            throw new IndexUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, previous: $exception);
        }
    }
}
