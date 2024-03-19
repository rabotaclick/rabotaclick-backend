<?php

namespace App\Repositories\Vacancy;

use App\DTO\Vacancy\VacancyDTO;
use App\Models\Vacancy;

class ShowRepository
{
    public function __construct(
        private Vacancy $vacancy
    )
    {
    }

    public function make(string $id): VacancyDTO
    {
        $this->vacancy = Vacancy::find($id);

        return new VacancyDTO(
            $this->vacancy
        );
    }
}
