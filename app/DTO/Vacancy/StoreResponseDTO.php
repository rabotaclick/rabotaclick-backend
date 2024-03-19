<?php

namespace App\DTO\Vacancy;

use App\Models\UserEmployer;

readonly class StoreResponseDTO
{
    public function __construct(
        public string $invoiceID,
        public string $amount,
        public UserEmployer $userEmployer
    )
    {
    }
}
