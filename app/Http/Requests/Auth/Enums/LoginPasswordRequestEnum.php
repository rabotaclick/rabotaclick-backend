<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum LoginPasswordRequestEnum: string implements RequestParamEnumInterface
{
    case Login = 'login';

    case Password = 'password';
}
