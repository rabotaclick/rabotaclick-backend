<?php

namespace App\Http\Requests\Auth\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum RegisterRequestEnum: string implements RequestParamEnumInterface
{
    case Phone = 'phone';
}
