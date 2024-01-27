<?php

namespace App\UseCases\KeySkill;

use App\DTO\KeySkill\IndexRequestDTO;
use App\DTO\KeySkill\IndexResponseDTO;
use App\Repositories\KeySkill\IndexRepository;
use App\UseCases\KeySkill\Exceptions\IndexUseCasesException;
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
            throw new IndexUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
