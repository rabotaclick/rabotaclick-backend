<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum RegisterRequestEnum: string implements RequestParamEnumInterface
{
    case Name = 'name';
    case Surname = 'surname';
}
