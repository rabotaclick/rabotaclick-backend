<?php declare(strict_types=1);
namespace App\Repositories\Company;

use App\DTO\Company\CompanyDTO;
use App\Models\Company;

class ShowRepository
{
    public function __construct(
        private Company $company
    )
    {
    }

    public function make(string $id): CompanyDTO
    {
        $this->company = Company::find($id);

        return new CompanyDTO(
            $this->company
        );
    }
}
