<?php

namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\UpdatePhotoRequestDTO;

interface UpdatePhotoRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdatePhotoRequestDTO;
}
