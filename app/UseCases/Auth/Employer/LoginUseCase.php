<?php declare(strict_types=1);
namespace App\UseCases\Auth\Employer;

use App\DTO\Auth\Employer\LoginRequestDTO;
use App\Repositories\Auth\Employer\Exceptions\InvalidCredentialsException;
use App\Repositories\Auth\Employer\LoginRepository;
use App\UseCases\Auth\Employer\Exceptions\LoginUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class LoginUseCase
{
    public function __construct(
        private LoginRepository $repository,
    )
    {
    }

    public function execute(LoginRequestDTO $requestDTO): string
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (InvalidCredentialsException $exception) {
            throw new LoginUseCasesException('Неверные данные', Response::HTTP_UNAUTHORIZED, $exception);
        } catch (\Throwable $exception) {
            throw new LoginUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
