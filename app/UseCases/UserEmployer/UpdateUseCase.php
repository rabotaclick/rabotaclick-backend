<?php declare(strict_types=1);
namespace App\UseCases\UserEmployer;

use App\DTO\UserEmployer\UpdateRequestDTO;
use App\DTO\UserEmployer\UserEmployerDTO;
use App\Repositories\UserEmployer\Exceptions\InvalidPasswordException;
use App\Repositories\UserEmployer\UpdateRepository;
use App\UseCases\UserEmployer\Exceptions\UpdateUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateUseCase
{
    public function __construct(
        private UpdateRepository $repository
    )
    {
    }

    public function execute(UpdateRequestDTO $requestDTO): UserEmployerDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (InvalidPasswordException $exception) {
            throw new UpdateUseCasesException('Неверный пароль', Response::HTTP_UNAUTHORIZED, $exception);
        } catch (\Throwable $exception) {
            throw new UpdateUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
