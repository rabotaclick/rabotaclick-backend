<?php

namespace App\DTO\WebHook\CloudPayments;

readonly class PayRequestDTO
{
    public function __construct(
        public string $transaction_id,
    )
    {
    }
}
