<?php declare(strict_types=1);

namespace App\Http\Requests\User\Contracts;

use App\DTO\User\UpdatePhoneRequestDTO;

interface UpdatePhoneRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdatePhoneRequestDTO;
}
