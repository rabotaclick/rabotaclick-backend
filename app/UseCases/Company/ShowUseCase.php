<?php declare(strict_types=1);

namespace App\UseCases\Company;

use App\DTO\Company\CompanyDTO;
use App\Repositories\Company\ShowRepository;
use App\UseCases\Company\Exceptions\ShowUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class ShowUseCase
{
    public function __construct(
        private ShowRepository $repository,
    )
    {
    }

    public function execute(string $id): CompanyDTO
    {
        try {
            $response = $this->repository->make($id);
            return $response;
        } catch (\Throwable $exception) {
            throw new ShowUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
