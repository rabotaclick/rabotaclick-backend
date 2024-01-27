<?php

namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
