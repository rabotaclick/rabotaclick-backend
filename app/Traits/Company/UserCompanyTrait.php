<?php declare(strict_types=1);

namespace App\Traits\Company;

use App\Repositories\Company\Exceptions\CompanyNotCreatedException;
use Illuminate\Support\Facades\Auth;

trait UserCompanyTrait
{
    private function checkCompany()
    {
        if(is_null(Auth::user()->company)) {
            throw new CompanyNotCreatedException();
        }
    }
}
