<?php declare(strict_types=1);
namespace App\UseCases\Region;

use App\DTO\Region\IndexRequestDTO;
use App\DTO\Region\IndexResponseDTO;
use App\Repositories\Region\IndexRepository;
use App\UseCases\Region\Exceptions\IndexUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class IndexUseCase
{
    public function __construct(
        private IndexRepository $repository,
    )
    {
    }

    public function execute(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new IndexUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
