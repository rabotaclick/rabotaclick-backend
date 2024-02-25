<?php

namespace App\UseCases\Company;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\UpdateRequestDTO;
use App\Repositories\Company\Exceptions\CompanyNotCreatedException;
use App\Repositories\Company\UpdateRepository;
use App\UseCases\Company\Exceptions\UpdateUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateUseCase
{
    public function __construct(
        private UpdateRepository $repository,
    )
    {
    }

    public function execute(UpdateRequestDTO $requestDTO): CompanyDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (CompanyNotCreatedException $exception) {
            throw new CompanyNotCreatedException('Вы еще не создали компанию', Response::HTTP_BAD_REQUEST, $exception);
        } catch (\Throwable $exception) {
            throw new UpdateUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
