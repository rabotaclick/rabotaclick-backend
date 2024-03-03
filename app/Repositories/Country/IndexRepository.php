<?php

namespace App\Repositories\Country;

use App\DTO\Country\CountriesDTO;
use App\DTO\Country\IndexRequestDTO;
use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;

class IndexRepository
{
    public function __construct(
        private mixed $countries = null
    )
    {
    }

    public function make(IndexRequestDTO $requestDTO): CountriesDTO
    {
        $this->countries = Country::query();
        $this->search($requestDTO);
        $totalRowCount = $this->countries->count();
        $this->countries = $this->countries->get();

        return new CountriesDTO(
            $this->countries,
            $totalRowCount
        );
    }

    private function search(IndexRequestDTO $requestDTO)
    {
        if(isset($requestDTO->search)) {
            $this->countries = $this->countries->where('name','ILIKE', '%'.$requestDTO->search.'%');
        }
    }
}
