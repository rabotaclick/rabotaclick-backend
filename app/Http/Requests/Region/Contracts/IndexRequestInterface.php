<?php declare(strict_types=1);

namespace App\Http\Requests\Region\Contracts;

use App\DTO\Region\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
