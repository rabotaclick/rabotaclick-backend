<?php declare(strict_types=1);

namespace App\Http\Requests\Admin\Contracts;

use App\DTO\Admin\AuthRequestDTO;

interface AuthRequestInterface
{
    public function rules(): array;

    public function getValidated(): AuthRequestDTO;
}
