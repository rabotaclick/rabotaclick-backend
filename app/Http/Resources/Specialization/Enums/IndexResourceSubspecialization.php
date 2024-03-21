<?php declare(strict_types=1);
namespace App\Http\Resources\Specialization\Enums;

enum IndexResourceSubspecialization: string
{
    case Id = 'id';
    case Title = 'title';
    case Vacancies = 'vacancies';
    case Subspecializations = 'subspecializations';
}
