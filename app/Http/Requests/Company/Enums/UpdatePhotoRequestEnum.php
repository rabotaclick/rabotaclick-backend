<?php

namespace App\Http\Requests\Company\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdatePhotoRequestEnum: string implements RequestParamEnumInterface
{
    case Url = 'url';
}
