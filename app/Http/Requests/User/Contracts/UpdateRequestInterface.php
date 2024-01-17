<?php

namespace App\Http\Requests\User\Contracts;

use App\DTO\User\UpdateRequestDTO;

interface UpdateRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateRequestDTO;
}
