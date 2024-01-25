<?php

namespace App\Http\Requests\Storage\Contracts;

use App\DTO\Storage\PutRequestDTO;

interface PutRequestInterface
{
    public function rules(): array;

    public function getValidated(): PutRequestDTO;
}
