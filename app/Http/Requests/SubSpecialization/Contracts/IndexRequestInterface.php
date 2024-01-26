<?php

namespace App\Http\Requests\SubSpecialization\Contracts;

use App\DTO\SubSpecialization\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
