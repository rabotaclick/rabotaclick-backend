<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateEducationRequestEnum: string implements RequestParamEnumInterface
{
    case EducationPlaces = 'education_places';
}
