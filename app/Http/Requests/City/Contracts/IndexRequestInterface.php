<?php

namespace App\Http\Requests\City\Contracts;

use App\DTO\City\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
