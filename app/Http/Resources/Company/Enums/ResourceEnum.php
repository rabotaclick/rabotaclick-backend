<?php

namespace App\Http\Resources\Company\Enums;

enum ResourceEnum: string
{
    case Id = 'id';
    case CreatedAt = 'created_at';
    case UpdatedAt = 'updated_at';
    case Type = 'type';
    case Name = 'name';
    case Website = 'website';
    case Phone = 'phone';
    case Description = 'description';
    case City = 'city';
    case Specialization = 'specialization';
    case IsVerified = 'is_verified';
    case Photo = 'photo';

    case Vacancies = 'vacancies';
}
