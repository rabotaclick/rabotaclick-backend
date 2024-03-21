<?php declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidateTrait
{
    public function validateResumeId(string $id): void
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid|exists:resumes,id',
        ])->validate();
    }

    public function validateCompanyId(string $id): void
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid|exists:companies,id',
        ])->validate();
    }

    public function validateVacancyId(string $id): void
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid|exists:vacancies,id',
        ])->validate();
    }
}
