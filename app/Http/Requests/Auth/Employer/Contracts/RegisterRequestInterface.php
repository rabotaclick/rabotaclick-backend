<?php

namespace App\Http\Requests\Auth\Employer\Contracts;

use App\DTO\Auth\Employer\RegisterRequestDTO;

interface RegisterRequestInterface
{
    public function rules(): array;

    public function getValidated(): RegisterRequestDTO;
}
