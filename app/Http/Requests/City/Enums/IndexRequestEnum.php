<?php declare(strict_types=1);

namespace App\Http\Requests\City\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum IndexRequestEnum: string implements RequestParamEnumInterface
{
    case Search = 'search';
    case Letter = 'letter';
}
