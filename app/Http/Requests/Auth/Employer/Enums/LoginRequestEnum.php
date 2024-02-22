<?php

namespace App\Http\Requests\Auth\Employer\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum LoginRequestEnum: string implements RequestParamEnumInterface
{
    case Email = 'email';

    case Password = 'password';
}
