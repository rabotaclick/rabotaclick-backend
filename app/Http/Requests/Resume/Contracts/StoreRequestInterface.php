<?php

namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\StoreRequestDTO;

interface StoreRequestInterface
{
    public function rules(): array;

    public function getValidated(): StoreRequestDTO;
}
