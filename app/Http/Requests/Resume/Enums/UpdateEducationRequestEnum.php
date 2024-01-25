<?php

namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateEducationRequestEnum: string implements RequestParamEnumInterface
{
    case EducationPlaces = 'education_places';
}
