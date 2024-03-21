<?php declare(strict_types=1);
namespace App\UseCases\Resume;

use App\DTO\Resume\IndexRequestDTO;
use App\DTO\Resume\IndexResponseDTO;
use App\Repositories\Resume\IndexRepository;
use App\UseCases\Resume\Exceptions\IndexUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class IndexUseCase
{
    public function __construct(
        private IndexRepository $repository
    )
    {
    }

    public function execute(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new IndexUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
