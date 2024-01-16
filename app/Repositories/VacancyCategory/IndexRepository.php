<?php

namespace App\Repositories\VacancyCategory;

use App\DTO\VacancyCategory\IndexRequestDTO;
use App\DTO\VacancyCategory\IndexResponseDTO;
use App\Models\VacancyCategory;
use Illuminate\Support\Collection;

class IndexRepository
{
    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $vacancyCategory = VacancyCategory::orderBy($requestDTO->column, $requestDTO->orderBy->value);

        $totalRowCount = $vacancyCategory->count();

        $vacancyCategory = $vacancyCategory->paginate($requestDTO->first, ["*"], page: $requestDTO->page);

        $vacancyCategory->appends(['first' => $requestDTO->first]);

        return new IndexResponseDTO(
            $vacancyCategory,
            $totalRowCount
        );
    }
}
