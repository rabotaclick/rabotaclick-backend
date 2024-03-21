<?php declare(strict_types=1);
namespace App\UseCases\WebHook\CloudPayments;

use App\DTO\WebHook\CloudPayments\CheckRequestDTO;
use App\Repositories\WebHook\CloudPayments\CheckRepository;

class CheckUseCase
{
    public function __construct(
        private CheckRepository $repository
    )
    {
    }

    public function execute(CheckRequestDTO $requestDTO): int
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            return 13;
        }
    }
}
