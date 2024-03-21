<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Employer\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum LoginRequestEnum: string implements RequestParamEnumInterface
{
    case Email = 'email';

    case Password = 'password';
}
