<?php declare(strict_types=1);

namespace App\UseCases\Company;

use App\DTO\Company\CompanyDTO;
use App\Repositories\Company\Exceptions\CompanyNotCreatedException;
use App\Repositories\Company\ShowMyRepository;
use App\UseCases\Company\Exceptions\ShowMyUseCasesException;
use App\UseCases\Company\Exceptions\UpdatePhotoUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class ShowMyUseCase
{
    public function __construct(
        private ShowMyRepository $repository,
    )
    {
    }

    public function execute(): CompanyDTO
    {
        try {
            $response = $this->repository->make();
            return $response;
        } catch (CompanyNotCreatedException $exception) {
            throw new UpdatePhotoUseCasesException('Вы еще не создали компанию', Response::HTTP_BAD_REQUEST, $exception);
        } catch (\Throwable $exception) {
            throw new ShowMyUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
