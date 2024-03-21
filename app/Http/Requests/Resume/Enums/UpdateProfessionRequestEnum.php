<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateProfessionRequestEnum: string implements RequestParamEnumInterface
{
    case Profession = 'profession';
    case Subspecializations = 'subspecializations';
    case Salary = 'salary';
    case Occupation = 'occupation';
    case Schedule = 'schedule';
    case TravelTime = 'travel_time';
}
