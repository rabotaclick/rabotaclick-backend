<?php declare(strict_types=1);
namespace App\Http\Requests\Language\Contracts;

use App\DTO\Language\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
