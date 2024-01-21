<?php

namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\UpdatePersonalRequestDTO;

interface UpdatePersonalRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdatePersonalRequestDTO;
}
