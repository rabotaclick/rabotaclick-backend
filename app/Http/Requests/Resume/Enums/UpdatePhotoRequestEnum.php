<?php

namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdatePhotoRequestEnum: string implements RequestParamEnumInterface
{
    case Url = 'url';
}
