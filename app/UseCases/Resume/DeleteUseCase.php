<?php

namespace App\UseCases\Resume;

use App\OpenApi\Responses\Public\ServiceUnavailableErrorResponse;
use App\OpenApi\SecuritySchemes\BearerToken;
use App\Repositories\Resume\DeleteRepository;
use App\UseCases\Resume\Exceptions\DeleteUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class DeleteUseCase
{
    public function __construct(
        private DeleteRepository $repository
    )
    {
    }
    public function execute(string $id): bool
    {
        try {
            $response = $this->repository->make($id);
            return $response;
        } catch (\Throwable $exception) {
            throw new DeleteUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
