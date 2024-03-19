<?php

namespace App\Http\Requests\WebHook\CloudPayments\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum PayRequestEnum: string implements RequestParamEnumInterface
{
    case TransactionId = 'TransactionId';
}
