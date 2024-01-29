<?php

namespace App\Http\Requests\Admin\Contracts;

use App\DTO\Admin\AuthRequestDTO;

interface AuthRequestInterface
{
    public function rules(): array;

    public function getValidated(): AuthRequestDTO;
}
