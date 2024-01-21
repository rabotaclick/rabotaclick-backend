<?php

namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdatePersonalRequestEnum: string implements RequestParamEnumInterface
{
    case Surname = 'surname';
    case Name = 'name';
    case Lastname = 'lastname';
    case Birthdate = 'birthdate';
    case Gender = 'gender';
    case CityId = 'city_id';
    case ReadyToMove = 'ready_to_move';
    case BusinessTrips = 'business_trips';
    case CitizenshipCountryId = 'citizenship_country_id';
    case WorkPermitCountryId = 'work_permit_country_id';
}
