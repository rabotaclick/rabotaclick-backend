<?php

namespace App\Repositories\City;

use App\DTO\City\IndexRequestDTO;
use App\DTO\City\IndexResponseDTO;
use App\Models\City;

class IndexRepository
{
    public function __construct(
        private mixed $cities = null
    )
    {
    }

    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $this->cities = City::query();

        if(isset($requestDTO->search)) {
            $this->search($requestDTO);
        }
        if (isset($requestDTO->letter)) {
            $this->letterize($requestDTO);
        }

        $this->paginate($requestDTO);
        $totalRowCount = $this->cities->count();

        return new IndexResponseDTO(
            $this->cities,
            $totalRowCount
        );
    }

    private function search($requestDTO)
    {
        $this->cities = $this->cities->where('name', 'ILIKE', '%'.$requestDTO->search.'%');
    }

    private function letterize($requestDTO)
    {
        $letter = mb_strtoupper($requestDTO->letter);
        $this->cities = $this->cities->whereRaw("UPPER(SUBSTRING(name, 1, 1)) = ?", [$letter]);
    }

    private function paginate($requestDTO)
    {
        $this->cities = $this->cities->paginate($requestDTO->first, ["*"], page: $requestDTO->page);
        $this->cities->appends(['first' => $requestDTO->first]);
    }
}
