<?php

namespace App\Http\Requests\KeySkill\Contracts;

use App\DTO\KeySkill\IndexRequestDTO;

interface IndexRequestInterface
{
    public function rules(): array;

    public function getValidated(): IndexRequestDTO;
}
