<?php

namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateLanguagesRequestEnum: string implements RequestParamEnumInterface
{
    case MainLanguageId = 'main_language_id';
    case Languages = 'languages';
}
