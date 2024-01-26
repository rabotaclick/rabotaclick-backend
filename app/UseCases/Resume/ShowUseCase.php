<?php

namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\Repositories\Resume\ShowRepository;
use App\UseCases\Resume\Exceptions\ShowUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class ShowUseCase
{
    public function __construct(
        private ShowRepository $repository
    )
    {
    }

    public function execute(string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($id);
            return $response;
        } catch (\Throwable $exception) {
            throw new ShowUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
