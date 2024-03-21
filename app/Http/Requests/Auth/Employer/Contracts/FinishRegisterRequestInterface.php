<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Employer\Contracts;

use App\DTO\Auth\Employer\FinishRegisterRequestDTO;

interface FinishRegisterRequestInterface
{
    public function rules(): array;

    public function getValidated(): FinishRegisterRequestDTO;
}
