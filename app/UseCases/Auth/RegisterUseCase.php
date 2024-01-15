<?php

namespace App\UseCases\Auth;

use App\DTO\Auth\RegisterRequestDTO;
use App\DTO\User\UserDTO;
use App\Repositories\Auth\Exceptions\RegisterRepositoryException;
use App\Repositories\Auth\RegisterRepository;
use App\UseCases\Auth\Exceptions\RegisterUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class RegisterUseCase
{
    public function __construct(
        private RegisterRepository $repository,
    )
    {
    }

    public function execute(RegisterRequestDTO $requestDTO): UserDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (RegisterRepositoryException $exception) {
            throw new RegisterUseCasesException('Вы уже зарегестрированы', Response::HTTP_UNPROCESSABLE_ENTITY, previous: $exception);
        } catch (\Throwable $exception) {
            throw new RegisterUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, previous: $exception);
        }
    }
}
