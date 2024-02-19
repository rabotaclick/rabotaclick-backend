<?php

namespace App\Http\Requests\Storage\Contracts;

use App\DTO\Storage\PutManyRequestDTO;

interface PutRequestInterface
{
    public function rules(): array;

    public function getValidated(): PutManyRequestDTO;
}
