<?php

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
}
