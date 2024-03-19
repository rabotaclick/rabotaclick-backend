<?php

namespace App\Http\Requests\WebHook\CloudPayments\Contracts;

use App\DTO\WebHook\CloudPayments\PayRequestDTO;

interface PayRequestInterface
{
    public function rules(): array;

    public function getValidated(): PayRequestDTO;
}
