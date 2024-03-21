<?php declare(strict_types=1);
namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdatePersonalRequestDTO;
use App\Repositories\Resume\UpdatePersonalRepository;
use App\UseCases\Resume\Exceptions\UpdatePersonalUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdatePersonalUseCase
{
    public function __construct(
        private UpdatePersonalRepository $repository
    )
    {
    }

    public function execute(UpdatePersonalRequestDTO $requestDTO, string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdatePersonalUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
