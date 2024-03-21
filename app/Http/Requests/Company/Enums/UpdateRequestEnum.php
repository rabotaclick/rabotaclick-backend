<?php declare(strict_types=1);
namespace App\Http\Requests\Company\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateRequestEnum: string implements RequestParamEnumInterface
{
    case Name = 'name';
    case CityId = 'city_id';
    case Website = 'website';
    case SpecializationId = 'specialization_id';
    case Phone = 'phone';
    case Description = 'description';
}
