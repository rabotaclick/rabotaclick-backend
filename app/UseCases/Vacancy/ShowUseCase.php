<?php declare(strict_types=1);
namespace App\UseCases\Vacancy;

use App\DTO\Vacancy\VacancyDTO;
use App\Repositories\Vacancy\ShowRepository;
use App\UseCases\Vacancy\Exceptions\ShowUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class ShowUseCase
{
    public function __construct(
        private ShowRepository $repository
    )
    {
    }

    public function execute(string $id): VacancyDTO
    {
        try {
            $response = $this->repository->make($id);
            return $response;
        } catch (\Throwable $exception) {
            throw new ShowUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
