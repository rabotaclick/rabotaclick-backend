<?php

namespace App\Http\Requests\User\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdatePhoneRequestEnum: string implements RequestParamEnumInterface
{
    case Code = 'code';
}
