<?php

namespace App\DTO\WebHook\CloudPayments;

readonly class CheckRequestDTO
{
    public function __construct(
        public string $invoice_id,
        public string $account_id,
        public string $date_time,
        public int $amount,
        public string $transaction_id,
    )
    {
    }
}
