<?php declare(strict_types=1);
namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\UpdatePhotoRequestDTO;
use App\Repositories\Resume\UpdatePhotoRepository;
use App\UseCases\Resume\Exceptions\UpdatePhotoUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdatePhotoUseCase
{
    public function __construct(
        private UpdatePhotoRepository $repository
    )
    {
    }

    public function execute(UpdatePhotoRequestDTO $requestDTO, string $id): ResumeDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdatePhotoUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
