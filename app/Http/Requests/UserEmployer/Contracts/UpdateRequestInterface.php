<?php declare(strict_types=1);
namespace App\Http\Requests\UserEmployer\Contracts;

use App\DTO\UserEmployer\UpdateRequestDTO;

interface UpdateRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateRequestDTO;
}
