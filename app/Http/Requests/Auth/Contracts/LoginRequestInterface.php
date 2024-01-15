<?php

namespace App\Http\Requests\Auth\Contracts;

use App\DTO\Auth\LoginRequestDTO;

interface LoginRequestInterface
{
    public function rules(): array;

    public function getValidated(): LoginRequestDTO;
}
