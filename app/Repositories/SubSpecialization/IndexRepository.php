<?php declare(strict_types=1);
namespace App\Repositories\SubSpecialization;

use App\DTO\SubSpecialization\IndexRequestDTO;
use App\DTO\SubSpecialization\IndexResponseDTO;
use App\Models\Subspecialization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IndexRepository
{
    public function __construct(
        private Builder|Collection|null $subspecialization = null
    )
    {
    }

    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $this->subspecializations = Subspecialization::query();

        $this->search($requestDTO);

        $totalRowCount = $this->subspecializations->count();
        $this->subspecializations = $this->subspecializations->get();

        return new IndexResponseDTO(
            $this->subspecializations,
            $totalRowCount
        );
    }

    private function search(IndexRequestDTO $requestDTO)
    {
        if(isset($requestDTO->search)) {
            $this->subspecializations = $this->subspecializations
                ->where("title", "ILIKE", "%".$requestDTO->search."%");
        }
    }
}
