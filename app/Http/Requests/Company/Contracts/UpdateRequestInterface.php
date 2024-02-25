<?php

namespace App\Http\Requests\Company\Contracts;

use App\DTO\Company\UpdateRequestDTO;

interface UpdateRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateRequestDTO;
}
