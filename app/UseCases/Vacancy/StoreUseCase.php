<?php declare(strict_types=1);
namespace App\UseCases\Vacancy;

use App\DTO\Vacancy\StoreRequestDTO;
use App\DTO\Vacancy\StoreResponseDTO;
use App\DTO\Vacancy\VacancyDTO;
use App\Repositories\Vacancy\StoreRepository;
use App\UseCases\Vacancy\Exceptions\StoreUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class StoreUseCase
{
    public function __construct(
        private StoreRepository $repository,
    )
    {
    }

    public function execute(StoreRequestDTO $requestDTO): StoreResponseDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new StoreUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
