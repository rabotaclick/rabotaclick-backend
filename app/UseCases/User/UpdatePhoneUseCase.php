<?php declare(strict_types=1);
namespace App\UseCases\User;

use App\DTO\User\UpdatePhoneRequestDTO;
use App\DTO\User\UserDTO;
use App\Repositories\User\UpdatePhoneRepository;
use App\UseCases\User\Exceptions\UpdatePhoneUseCasesException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class UpdatePhoneUseCase
{
    public function __construct(
        private UpdatePhoneRepository $repository,
    )
    {
    }

    public function execute(UpdatePhoneRequestDTO $requestDTO): UserDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (ModelNotFoundException $notFoundException) {
            throw new UpdatePhoneUseCasesException('Неверный код', Response::HTTP_UNPROCESSABLE_ENTITY, $notFoundException);
        } catch (\Throwable $exception) {
            throw new UpdatePhoneUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
