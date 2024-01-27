<?php

namespace App\Http\Requests\Language\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum IndexRequestEnum: string implements RequestParamEnumInterface
{
    case Search = 'search';
}
