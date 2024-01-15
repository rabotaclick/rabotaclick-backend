<?php

namespace App\UseCases\User;

use App\DTO\User\UserDTO;
use App\Repositories\User\ShowMeRepository;
use App\UseCases\User\Exceptions\ShowMeUseCaseException;
use Symfony\Component\HttpFoundation\Response;

class ShowMeUseCase
{
    public function __construct(
        private ShowMeRepository $repository
    )
    {
    }

    public function execute(): UserDTO
    {
        try {
            $response = $this->repository->make();
            return $response;
        } catch (\Throwable $e) {
            throw new ShowMeUseCaseException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, previous: $exception);
        }
    }
}
