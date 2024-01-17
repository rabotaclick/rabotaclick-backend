<?php

namespace App\UseCases\Auth;

use App\DTO\Auth\LoginRequestDTO;
use App\Repositories\Auth\LoginRepository;
use App\UseCases\Auth\Exceptions\LoginUseCasesException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class LoginUseCase
{
    public function __construct(
        private LoginRepository $repository
    )
    {
    }

    public function execute(LoginRequestDTO $requestDTO): string
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (ModelNotFoundException $notFoundException) {
            throw new LoginUseCasesException('Неверный код', Response::HTTP_BAD_REQUEST, previous: $notFoundException);
        } catch (\Throwable $exception) {
            throw new LoginUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, previous: $exception);
        }
    }
}
