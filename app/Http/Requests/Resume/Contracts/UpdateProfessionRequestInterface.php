<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\UpdateProfessionRequestDTO;

interface UpdateProfessionRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateProfessionRequestDTO;
}
