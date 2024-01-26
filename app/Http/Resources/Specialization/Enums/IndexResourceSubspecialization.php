<?php

namespace App\Http\Resources\Specialization\Enums;

enum IndexResourceSubspecialization: string
{
    case Id = 'id';
    case Title = 'title';
    case Vacancies = 'vacancies';
    case Subspecializations = 'subspecializations';
}
