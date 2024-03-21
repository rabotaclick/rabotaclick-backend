<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Contracts;

use App\DTO\Resume\UpdateContactsRequestDTO;

interface UpdateContactsRequestInterface
{
    public function rules(): array;

    public function getValidated(): UpdateContactsRequestDTO;
}
