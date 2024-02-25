<?php

namespace App\Repositories\Company;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\UpdateRequestDTO;
use App\Models\Company;
use App\Repositories\Company\Exceptions\CompanyNotCreatedException;
use Illuminate\Support\Facades\Auth;

class UpdateRepository
{
    public function __construct(
        private Company $company
    )
    {
    }

    public function make(UpdateRequestDTO $requestDTO): CompanyDTO
    {
        $this->checkCompany();
        $this->company = Auth::user()->company;
        $this->company->update($requestDTO->toArray());

        return new CompanyDTO(
            $this->company
        );
    }

    private function checkCompany()
    {
        if(is_null(Auth::user()->company)) {
            throw new CompanyNotCreatedException();
        }
    }
}
