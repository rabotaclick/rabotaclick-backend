<?php declare(strict_types=1);
namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdateProfessionRequestDTO;
use App\Repositories\Resume\UpdateProfessionRepository;
use App\UseCases\Resume\Exceptions\UpdateProfessionUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateProfessionUseCase
{
    public function __construct(
        private UpdateProfessionRepository $repository,
    )
    {
    }

    public function execute(UpdateProfessionRequestDTO $requestDTO, string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdateProfessionUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
