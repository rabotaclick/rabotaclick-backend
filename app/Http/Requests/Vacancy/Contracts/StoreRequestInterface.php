<?php

namespace App\Http\Requests\Vacancy\Contracts;

use App\DTO\Vacancy\StoreRequestDTO;

interface StoreRequestInterface
{
    public function rules(): array;

    public function getValidated(): StoreRequestDTO;
}
