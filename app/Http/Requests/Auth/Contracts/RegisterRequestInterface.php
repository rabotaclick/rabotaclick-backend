<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Contracts;

use App\DTO\Auth\RegisterRequestDTO;

interface RegisterRequestInterface
{
    public function rules(): array;

    public function getValidated(): RegisterRequestDTO;
}
