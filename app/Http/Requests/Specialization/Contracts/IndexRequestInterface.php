<?php

namespace App\Http\Requests\Specialization\Contracts;

use App\DTO\Specialization\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
