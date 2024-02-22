<?php

namespace App\UseCases\UserEmployer;

use App\DTO\UserEmployer\UserEmployerDTO;
use App\Repositories\UserEmployer\ShowMeRepository;
use App\UseCases\UserEmployer\Exceptions\ShowMeUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class ShowMeUseCase
{
    public function __construct(
        private ShowMeRepository $repository,
    )
    {
    }

    public function execute(): UserEmployerDTO
    {
        try {
            $response = $this->repository->make();
            return $response;
        } catch (\Throwable $exception) {
            throw new ShowMeUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
