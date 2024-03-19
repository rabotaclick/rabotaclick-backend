<?php

namespace App\UseCases\Auth\Employer;

use App\DTO\Auth\Employer\RegisterRequestDTO;
use App\Repositories\Auth\Employer\RegisterRepository;
use App\UseCases\Auth\Employer\Exceptions\RegisterUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class RegisterUseCase
{
    public function __construct(
        private RegisterRepository $repository,
    )
    {
    }

    public function execute(RegisterRequestDTO $requestDTO): string
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new RegisterUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
