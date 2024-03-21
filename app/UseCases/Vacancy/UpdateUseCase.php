<?php declare(strict_types=1);

namespace App\UseCases\Vacancy;

use App\DTO\Vacancy\UpdateRequestDTO;
use App\DTO\Vacancy\VacancyDTO;
use App\Repositories\Vacancy\UpdateRepository;
use App\UseCases\Vacancy\Exceptions\UpdateUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateUseCase
{
    public function __construct(
        private UpdateRepository $repository
    )
    {
    }

    public function execute(UpdateRequestDTO $requestDTO, string $id): VacancyDTO
    {
        try {
            $response = $this->repository->make($requestDTO, $id);
            return $response;
        } catch (\Throwable $exception) {
            throw new UpdateUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
