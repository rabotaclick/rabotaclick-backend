<?php declare(strict_types=1);
namespace App\Http\Requests\Company\Contracts;

use App\DTO\Company\StoreRequestDTO;

interface StoreRequestInterface
{
    public function rules(): array;

    public function getValidated(): StoreRequestDTO;
}
