<?php

namespace App\Http\Requests\Vacancy\Contracts;

use App\DTO\Vacancy\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
