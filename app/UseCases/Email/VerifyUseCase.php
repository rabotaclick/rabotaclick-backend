<?php declare(strict_types=1);
namespace App\UseCases\Email;

use App\Repositories\Email\VerifyRepository;
use App\UseCases\Email\Exceptions\VerifyUseCasesException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class VerifyUseCase
{
    public function __construct(
        private VerifyRepository $repository
    )
    {
    }

    public function execute(string $token): string
    {
        try {
            $response = $this->repository->make($token);
            return $response;
        } catch (ModelNotFoundException $notFoundException) {
            throw new VerifyUseCasesException('Неверный токен', Response::HTTP_UNPROCESSABLE_ENTITY, $notFoundException);
        } catch (\Throwable $exception) {
            throw new VerifyUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
