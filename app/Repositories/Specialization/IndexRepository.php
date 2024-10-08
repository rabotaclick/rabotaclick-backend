<?php declare(strict_types=1);
namespace App\Repositories\Specialization;

use App\DTO\Specialization\IndexRequestDTO;
use App\DTO\Specialization\IndexResponseDTO;
use App\Models\Specialization;

class IndexRepository
{
    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $specialization = Specialization::orderBy($requestDTO->column, $requestDTO->orderBy->value);

        $totalRowCount = $specialization->count();

        $specialization = $specialization->paginate($requestDTO->first, ["*"], page: $requestDTO->page);

        $specialization->appends(['first' => $requestDTO->first]);

        return new IndexResponseDTO(
            $specialization,
            $totalRowCount,
            $requestDTO->withSubspecializations
        );
    }
}
