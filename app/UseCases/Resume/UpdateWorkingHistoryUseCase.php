<?php

namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateWorkingHistoryRequestDTO;
use App\Repositories\Resume\UpdateWorkingHistoryRepository;
use App\UseCases\Resume\Exceptions\UpdateWorkingHistoryUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateWorkingHistoryUseCase
{
    public function __construct(
        public UpdateWorkingHistoryRepository $repository
    )
    {
    }

    public function execute(UpdateWorkingHistoryRequestDTO $requestDTO, string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdateWorkingHistoryUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
