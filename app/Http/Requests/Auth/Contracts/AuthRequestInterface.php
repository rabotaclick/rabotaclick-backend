<?php

namespace App\Http\Requests\Auth\Contracts;

use App\DTO\Auth\AuthRequestDTO;

interface AuthRequestInterface
{
    public function rules(): array;

    public function getValidated(): AuthRequestDTO;
}
