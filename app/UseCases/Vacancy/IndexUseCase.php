<?php

namespace App\UseCases\Vacancy;

use App\DTO\Vacancy\IndexRequestDTO;
use App\DTO\Vacancy\IndexResponseDTO;
use App\Repositories\Vacancy\IndexRepository;
use App\UseCases\Vacancy\Exceptions\IndexUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class IndexUseCase
{
    public function __construct(
        private IndexRepository $repository
    )
    {
    }

    public function execute(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new IndexUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
