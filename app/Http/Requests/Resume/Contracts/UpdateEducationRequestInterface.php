<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\UpdateEducationRequestDTO;

interface UpdateEducationRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateEducationRequestDTO;
}
