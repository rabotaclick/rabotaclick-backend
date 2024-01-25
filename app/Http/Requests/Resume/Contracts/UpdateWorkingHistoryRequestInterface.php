<?php

namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\UpdateWorkingHistoryRequestDTO;

interface UpdateWorkingHistoryRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateWorkingHistoryRequestDTO;
}
