<?php

namespace App\Repositories\Company;

use App\DTO\Company\CompanyDTO;
use App\DTO\Company\StoreRequestDTO;
use App\DTO\Storage\PutOneRequestDTO;
use App\Models\Company;
use App\Models\CompanyDocument;
use App\Services\StorageService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreRepository
{
    public function __construct(
        private Company $company,
        private StorageService $storageService,
    )
    {
    }

    public function make(StoreRequestDTO $requestDTO): CompanyDTO
    {
        DB::transaction(function () use($requestDTO){
            $this->company->type = $requestDTO->type;
            $this->company->name = $requestDTO->name;
            $this->company->city_id = $requestDTO->city->id;
            $this->company->website = $requestDTO->website;
            $this->company->specialization_id = $requestDTO->specialization->id;
            $this->company->phone = $requestDTO->phone;
            $this->company->description = $requestDTO->description;
            $this->company->save();

            $this->attachDocument($requestDTO->document);
            $this->attachToUser();
        });

        return new CompanyDTO(
            $this->company
        );
    }

    private function attachDocument(UploadedFile|null $document)
    {
        if(isset($document)) {
            $putRequestDTO = new PutOneRequestDTO($document);
            $putResponseDTO = $this->storageService->putOne($putRequestDTO, 'documents/');

            $companyDocument = new CompanyDocument();
            $companyDocument->document_url = $putResponseDTO->url;
            $companyDocument->company_id = $this->company->id;
            $companyDocument->save();
        }
    }

    private function attachToUser()
    {
        $user = Auth::user();
        $user->company_id = $this->company->id;
        $user->save();
    }
}
