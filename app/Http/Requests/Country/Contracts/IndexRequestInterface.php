<?php

namespace App\Http\Requests\Country\Contracts;

use App\DTO\Country\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
