<?php

namespace App\UseCases\User;

use App\Repositories\User\DeleteRepository;
use App\UseCases\User\Exceptions\DeleteUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class DeleteUseCase
{
    public function __construct(
        private DeleteRepository $repository,
    )
    {
    }

    public function execute(): string
    {
        try {
            $response = $this->repository->make();
            return $response;
        } catch (\Throwable $exception) {
            throw new DeleteUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
