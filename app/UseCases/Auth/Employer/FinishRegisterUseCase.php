<?php declare(strict_types=1);
namespace App\UseCases\Auth\Employer;

use App\DTO\Auth\Employer\FinishRegisterRequestDTO;
use App\DTO\UserEmployer\UserEmployerDTO;
use App\Repositories\Auth\Employer\Exceptions\FinishRegisterRepositoryException;
use App\Repositories\Auth\Employer\FinishRegisterRepository;
use App\UseCases\Auth\Employer\Exceptions\FinishRegisterUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class FinishRegisterUseCase
{
    public function __construct(
        private FinishRegisterRepository $repository
    )
    {
    }

    public function execute(FinishRegisterRequestDTO $requestDTO): UserEmployerDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (FinishRegisterRepositoryException $exception) {
            throw new FinishRegisterUseCasesException('Вы уже зарегестрированы', Response::HTTP_UNPROCESSABLE_ENTITY, previous: $exception);
        } catch (\Throwable $exception) {
            throw new FinishRegisterUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
