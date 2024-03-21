<?php declare(strict_types=1);
namespace App\Http\Requests\Storage\Contracts;

use App\DTO\Storage\PutManyRequestDTO;

interface PutRequestInterface
{
    public function rules(): array;

    public function getValidated(): PutManyRequestDTO;
}
