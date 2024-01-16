<?php

namespace App\Http\Requests\VacancyCategory\Contracts;

use App\DTO\VacancyCategory\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
