<?php

namespace App\Http\Requests\Company\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum StoreRequestEnum: string implements RequestParamEnumInterface
{
    case Type = 'type';
    case Name = 'name';
    case CityId = 'city_id';
    case Website = 'website';
    case SpecializationId = 'specialization_id';
    case Phone = 'phone';
    case Description = 'description';
    case Document = 'document';
}
