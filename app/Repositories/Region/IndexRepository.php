<?php declare(strict_types=1);
namespace App\Repositories\Region;

use App\DTO\Region\IndexRequestDTO;
use App\DTO\Region\IndexResponseDTO;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IndexRepository
{
    public function __construct(
        private Builder|Collection|null $regions = null
    )
    {
    }

    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $this->regions = Region::query();

        $this->search($requestDTO);

        $totalRowCount = $this->regions->count();

        $this->regions = $this->regions->get();

        return new IndexResponseDTO(
            $this->regions,
            $totalRowCount
        );
    }

    private function search(IndexRequestDTO $requestDTO)
    {
        if(isset($requestDTO->search)) {
            $this->regions = $this->regions->where('name', 'ILIKE', '%'.$requestDTO->search.'%');
        }
    }
}
