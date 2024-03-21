<?php declare(strict_types=1);
namespace App\UseCases\Email\Employer;

use App\Repositories\Email\Employer\VerifyRepository;
use App\UseCases\Email\Employer\Exceptions\VerifyUseCasesException;
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
        } catch (\Throwable $exception) {
            throw new VerifyUseCasesException('Сервис временно недоступен' . $exception, Response::HTTP_SERVICE_UNAVAILABLE, $exception);
        }
    }
}
