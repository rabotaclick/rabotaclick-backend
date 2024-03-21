<?php declare(strict_types=1);
namespace App\Repositories\Language;

use App\DTO\Language\IndexRequestDTO;
use App\DTO\Language\IndexResponseDTO;
use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IndexRepository
{
    public function __construct(
        private Builder|Collection|null $languages = null
    )
    {
    }

    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $this->languages = Language::query();

        $this->search($requestDTO);

        $totalRowCount = $this->languages->count();

        $this->languages = $this->languages->get();

        return new IndexResponseDTO(
            $this->languages,
            $totalRowCount
        );
    }

    public function search(IndexRequestDTO $requestDTO)
    {
        if(isset($requestDTO->search)) {
            $this->languages = $this->languages->where('name', 'ILIKE', '%'.$requestDTO->search.'%');
        }
    }
}
