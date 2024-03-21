<?php declare(strict_types=1);
namespace App\UseCases\WebHook\CloudPayments;

use App\DTO\WebHook\CloudPayments\PayRequestDTO;
use App\Repositories\WebHook\CloudPayments\PayRepository;

class PayUseCase
{
    public function __construct(
        private PayRepository $repository
    )
    {
    }

    public function execute(PayRequestDTO $requestDTO): int
    {
        try {
            $response = $this->repository->make($requestDTO);
            return $response;
        } catch (\Throwable $exception) {
            return 0;
        }
    }
}
