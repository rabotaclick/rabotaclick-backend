<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Employer\Contracts;

use App\DTO\Auth\Employer\LoginRequestDTO;

interface LoginRequestInterface
{
    public function rules(): array;

    public function getValidated(): LoginRequestDTO;
}
