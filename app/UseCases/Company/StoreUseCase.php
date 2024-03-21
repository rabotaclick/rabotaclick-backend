<?php declare(strict_types=1);

namespace App\UseCases\Company;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\StoreRequestDTO;
use App\Repositories\Company\StoreRepository;
use App\UseCases\Company\Exceptions\StoreUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class StoreUseCase
{
    public function __construct(
        private StoreRepository $repository
    )
    {
    }

    public function execute(StoreRequestDTO $requestDTO): CompanyDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            throw new StoreUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
