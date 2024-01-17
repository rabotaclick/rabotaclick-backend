<?php

namespace App\UseCases\User;

use App\DTO\User\UpdateRequestDTO;
use App\DTO\User\UserDTO;
use App\Repositories\User\Exceptions\InvalidEmailException;
use App\Repositories\User\Exceptions\InvalidPhoneException;
use App\Repositories\User\Exceptions\UpdateRepositoryException;
use App\Repositories\User\UpdateRepository;
use App\UseCases\User\Exceptions\UpdateUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class UpdateUseCase
{
    public function __construct(
        private UpdateRepository $repository
    )
    {
    }

    public function execute(UpdateRequestDTO $requestDTO): UserDTO
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (InvalidEmailException $exception) {
            throw new UpdateUseCasesException('Новый электронный адрес совпадает со старым', Response::HTTP_UNPROCESSABLE_ENTITY, $exception);
        } catch (InvalidPhoneException $exception) {
            throw new UpdateUseCasesException('Новый телефон совпадает со старым', Response::HTTP_UNPROCESSABLE_ENTITY, $exception);
        } catch (\Throwable $exception) {
            throw new UpdateUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
