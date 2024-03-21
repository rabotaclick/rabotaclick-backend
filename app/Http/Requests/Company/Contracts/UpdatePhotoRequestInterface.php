<?php declare(strict_types=1);
namespace App\Http\Requests\Company\Contracts;

use App\DTO\Company\UpdatePhotoRequestDTO;

interface UpdatePhotoRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdatePhotoRequestDTO;
}
