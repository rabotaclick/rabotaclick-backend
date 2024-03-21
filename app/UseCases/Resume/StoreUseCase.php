<?php declare(strict_types=1);
namespace App\UseCases\Resume;

use App\DTO\Resume\ResumeDTO;
use App\DTO\Resume\StoreRequestDTO;
use App\Repositories\Resume\Exceptions\TooManyResumesException;
use App\Repositories\Resume\StoreRepository;
use App\UseCases\Resume\Exceptions\StoreUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class StoreUseCase
{
    public function __construct(
        private StoreRepository $repository,
    )
    {
    }

    public function execute(StoreRequestDTO $requestDTO): ResumeDTO
    {
        try {
            $this->repository->checkUserLimits();
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (TooManyResumesException $exception) {
            throw new StoreUseCasesException('У вас максимальное количество резюме', Response::HTTP_UNPROCESSABLE_ENTITY, $exception);
        } catch (\Throwable $exception) {
            throw new StoreUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
