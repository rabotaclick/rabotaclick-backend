<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Contracts;

use App\DTO\Vacancy\UpdateRequestDTO;

interface UpdateRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateRequestDTO;
}
