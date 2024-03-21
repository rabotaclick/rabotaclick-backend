<?php declare(strict_types=1);

namespace App\Repositories\Company;

use App\DTO\Company\CompanyDTO;
use App\Models\Company;
use App\Traits\Company\UserCompanyTrait;
use Illuminate\Support\Facades\Auth;

class ShowMyRepository
{
    use UserCompanyTrait;
    public function __construct(
        private Company $company
    )
    {
    }

    public function make(): CompanyDTO
    {
        $this->checkCompany();
        $this->company = Auth::user()->company;

        return new CompanyDTO(
            $this->company
        );
    }
}
