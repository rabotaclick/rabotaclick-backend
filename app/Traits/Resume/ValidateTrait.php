<?php

namespace App\Traits\Resume;

use Illuminate\Support\Facades\Validator;

trait ValidateTrait
{
    public function validateId(string $id)
    {
        Validator::make(['id' => $id], [
            'id' => 'required|uuid|exists:resumes,id',
        ])->validate();
    }
}
