<?php declare(strict_types=1);

namespace App\DTO\WebHook\CloudPayments;

readonly class PayRequestDTO
{
    public function __construct(
        public string $transaction_id,
    )
    {
    }
}
