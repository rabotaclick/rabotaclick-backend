<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\UpdateLanguagesRequestDTO;

interface UpdateLanguagesRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateLanguagesRequestDTO;
}
