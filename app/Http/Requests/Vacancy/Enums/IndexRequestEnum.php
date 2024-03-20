<?php

namespace App\Http\Requests\Vacancy\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum IndexRequestEnum: string implements RequestParamEnumInterface
{
    case Search = 'search';
    case OrderBy = 'orderBy';
    case Column = 'column';
    case Date = 'date';
    case Salary = 'salary';
    case IssetSalary = 'isset_salary';
    case CityId = 'city_id';
    case Subspecializations = 'subspecializations';
    case Education = 'education';
    case WorkExperience = 'work_experience';
    case Occupation = 'occupation';
    case Schedule = 'schedule';
}
