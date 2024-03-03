<?php

namespace App\UseCases\Country;

use App\DTO\Country\CountriesDTO;
use App\DTO\Country\IndexRequestDTO;
use App\Repositories\Country\IndexRepository;
use App\UseCases\Country\Exceptions\IndexUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class IndexUseCase
{
    public function __construct(
        private IndexRepository $repository
    )
    {
    }

    public function execute(IndexRequestDTO $requestDTO): CountriesDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new IndexUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
