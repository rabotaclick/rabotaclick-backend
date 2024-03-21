<?php declare(strict_types=1);

namespace App\DTO\Vacancy;

use App\Models\UserEmployer;

readonly class StoreResponseDTO
{
    public function __construct(
        public string $invoiceID,
        public int $amount,
        public UserEmployer $userEmployer
    )
    {
    }
}
