<?php

namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateEducationRequestDTO;
use App\Repositories\Resume\UpdateEducationRepository;
use App\UseCases\Resume\Exceptions\UpdateEducationUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateEducationUseCase
{
    public function __construct(
        private UpdateEducationRepository $repository
    )
    {
    }

    public function execute(UpdateEducationRequestDTO $requestDTO, string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdateEducationUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
