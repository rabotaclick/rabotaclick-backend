<?php declare(strict_types=1);
namespace App\Http\Requests\WebHook\CloudPayments\Contracts;

use App\DTO\WebHook\CloudPayments\CheckRequestDTO;

interface CheckRequestInterface
{
    public function rules(): array;

    public function getValidated(): CheckRequestDTO;
}
