<?php

namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateContactsRequestDTO;
use App\Repositories\Resume\UpdateContactsRepository;
use App\UseCases\Resume\Exceptions\UpdateContactsUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateContactsUseCase
{
    public function __construct(
        private UpdateContactsRepository $repository,
    )
    {
    }

    public function execute(UpdateContactsRequestDTO $requestDTO, string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdateContactsUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
