<?php declare(strict_types=1);
namespace App\UseCases\User;

use App\DTO\User\UserDTO;
use App\Repositories\User\ShowMeRepository;
use App\UseCases\User\Exceptions\ShowMeUseCasesException;
use Symfony\Component\HttpFoundation\Response;

class ShowMeUseCase
{
    public function __construct(
        private ShowMeRepository $repository
    )
    {
    }

    public function execute(): UserDTO
    {
        try {
            $response = $this->repository->make();
            return $response;
        } catch (\Throwable $exception) {
            throw new ShowMeUseCasesException('Сервис временно недоступен', Response::HTTP_SERVICE_UNAVAILABLE, previous: $exception);
        }
    }
}
