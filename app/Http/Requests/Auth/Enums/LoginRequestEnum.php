<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum LoginRequestEnum: string implements RequestParamEnumInterface
{
    case Code = 'code';
    case Phone = 'phone';
}
