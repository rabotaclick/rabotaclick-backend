<?php declare(strict_types=1);
namespace App\UseCases\Admin;

use App\DTO\Admin\AuthRequestDTO;
use App\Repositories\Admin\AuthRepository;
use App\Repositories\Admin\Exceptions\InvalidCredentialsException;
use App\UseCases\Admin\Exceptions\AuthUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class AuthUseCase
{
    public function __construct(
        private AuthRepository $repository
    )
    {
    }

    public function execute(AuthRequestDTO $requestDTO): bool
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (InvalidCredentialsException $exception) {
            throw new AuthUseCasesException('Неверные данные', Response::HTTP_UNAUTHORIZED, $exception);
        } catch (\Throwable $exception) {
            throw new AuthUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
