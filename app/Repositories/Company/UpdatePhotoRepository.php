<?php

namespace App\Repositories\Company;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\UpdatePhotoRequestDTO;
use App\Models\Company;
use App\Models\CompanyPhoto;
use App\Models\ResumePhoto;
use App\Repositories\Company\Exceptions\CompanyNotCreatedException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdatePhotoRepository
{
    public function __construct(
        private Company $company
    )
    {
    }

    public function make(UpdatePhotoRequestDTO $requestDTO): CompanyDTO
    {
        $this->checkCompany();
        $this->company = Auth::user()->company;

        DB::transaction(function () use($requestDTO) {
            $this->manipulateCompanyPhoto($requestDTO);
        });

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

    private function manipulateCompanyPhoto(UpdatePhotoRequestDTO $requestDTO)
    {
        if(is_null($requestDTO->url)) {
            $this->company->photo()->delete();
        } else {
            $photo = CompanyPhoto::firstOrNew(["company_id" => $this->company->id]);
            $photo->url = $requestDTO->url;
            $photo->save();
        }
    }
}
