<?php

namespace App\UseCases\VacancyCategory;

use App\DTO\VacancyCategory\IndexRequestDTO;
use App\DTO\VacancyCategory\IndexResponseDTO;
use App\Repositories\VacancyCategory\IndexRepository;
use App\UseCases\VacancyCategory\Exceptions\IndexUseCasesException;
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
