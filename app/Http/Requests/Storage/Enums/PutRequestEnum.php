<?php

namespace App\Http\Requests\Storage\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum PutRequestEnum: string implements RequestParamEnumInterface
{
    case Files = 'files';
}
