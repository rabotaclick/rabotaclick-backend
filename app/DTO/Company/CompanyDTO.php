<?php declare(strict_types=1);

namespace App\DTO\Company;

use App\Models\Company;

readonly class CompanyDTO
{
    public function __construct(
        public Company $company
    )
    {

    }
}
