<?php

namespace App\Repositories\KeySkill;

use App\DTO\KeySkill\IndexRequestDTO;
use App\DTO\KeySkill\IndexResponseDTO;
use App\Models\KeySkill;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class IndexRepository
{
    public function __construct(
        private Builder|Collection|null $key_skills = null
    )
    {
    }
    public function make(IndexRequestDTO $requestDTO): IndexResponseDTO
    {
        $this->key_skills = KeySkill::query();
        $this->search($requestDTO);
        $totalRowCount = $this->key_skills->count();
        $this->key_skills = $this->key_skills->get();

        return new IndexResponseDTO(
            $this->key_skills,
            $totalRowCount
        );
    }

    private function search(IndexRequestDTO $requestDTO): void
    {
        if(isset($requestDTO->search)) {
            $this->key_skills = $this->key_skills->where("title", "ILIKE", "%". $requestDTO->search . "%");
        }
    }
}
