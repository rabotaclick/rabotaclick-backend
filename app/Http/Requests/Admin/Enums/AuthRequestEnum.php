<?php

namespace App\Http\Requests\Admin\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum AuthRequestEnum: string implements RequestParamEnumInterface
{
    case Login = 'login';

    case Password = 'password';
}
