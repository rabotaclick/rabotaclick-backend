<?php declare(strict_types=1);
namespace App\Http\Resources\Company\Enums;

enum GuestResourceEnum: string
{
    case Id = 'id';
    case Type = 'type';
    case Name = 'name';
    case Website = 'website';
    case Description = 'description';
    case City = 'city';
    case Specialization = 'specialization';
    case Photo = 'photo';
}
