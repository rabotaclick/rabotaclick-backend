<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Contracts;

use App\DTO\Vacancy\StoreRequestDTO;

interface StoreRequestInterface
{
    public function rules(): array;

    public function getValidated(): StoreRequestDTO;
}
