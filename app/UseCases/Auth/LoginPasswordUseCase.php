<?php

namespace App\UseCases\Auth;

use App\DTO\Auth\LoginPasswordDTO;
use App\Repositories\Auth\Exceptions\InvalidCredentialsException;
use App\Repositories\Auth\LoginPasswordRepository;
use App\UseCases\Auth\Exceptions\LoginPasswordUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class LoginPasswordUseCase
{
    public function __construct(
        private LoginPasswordRepository $repository
    )
    {
    }

    public function execute(LoginPasswordDTO $requestDTO): string
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (InvalidCredentialsException $exception) {
            throw new InvalidCredentialsException('Неверные данные', Response::HTTP_UNAUTHORIZED, $exception);
        } catch (\Throwable $exception) {
            throw new LoginPasswordUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
