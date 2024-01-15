<?php

namespace App\UseCases\Auth;

use App\DTO\Auth\AuthRequestDTO;
use App\Repositories\Auth\AuthRepository;
use App\UseCases\Auth\Exceptions\AuthUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class AuthUseCase
{
    public function __construct(
        private AuthRepository $repository
    )
    {
    }

    public function execute(AuthRequestDTO $requestDTO): string
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new AuthUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, previous: $exception);
        }
    }
}
