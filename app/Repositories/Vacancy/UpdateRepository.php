<?php declare(strict_types=1);

namespace App\Repositories\Vacancy;

use App\DTO\Vacancy\UpdateRequestDTO;
use App\DTO\Vacancy\VacancyDTO;
use App\Models\Vacancy;
use App\Traits\PermissionTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateRepository
{
    use PermissionTrait;
    public function __construct(
        private Vacancy $vacancy
    )
    {
    }

    public function make(UpdateRequestDTO $requestDTO, string $id): VacancyDTO
    {
        $this->vacancy = Vacancy::find($id);
        $this->checkPermission(Auth::user(), 'update', $this->vacancy);
        DB::transaction(function() use($requestDTO) {
            $this->vacancy->update($requestDTO->toArray());
            $this->attachSubspecializations($requestDTO->subspecializations);
            $this->attachKeySkills($requestDTO->key_skills);
        });
        return new VacancyDTO(
            $this->vacancy
        );
    }

    private function attachSubspecializations($subspecializations)
    {
        foreach ($subspecializations as $subspecialization) {
            $this->vacancy->subspecializations()->syncWithoutDetaching($subspecialization);
        }
    }
    private function attachKeySkills($key_skills)
    {
        foreach ($key_skills as $key_skill) {
            $this->vacancy->key_skills()->syncWithoutDetaching($key_skill);
        }
    }
}
