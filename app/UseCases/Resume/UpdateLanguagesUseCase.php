<?php

namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateLanguagesRequestDTO;
use App\Repositories\Resume\UpdateLanguagesRepository;
use App\UseCases\Resume\Exceptions\UpdateLanguagesUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateLanguagesUseCase
{
    public function __construct(
        private UpdateLanguagesRepository $repository
    )
    {
    }

    public function execute(UpdateLanguagesRequestDTO $requestDTO, string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdateLanguagesUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
