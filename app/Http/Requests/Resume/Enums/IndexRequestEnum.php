<?php

namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum IndexRequestEnum: string implements RequestParamEnumInterface
{
    case Search = 'search';
    case OrderBy = 'orderBy';
    case Column = 'column';
    case Date = 'date';
    case CityId = 'city_id';
    case ReadyToMove = 'ready_to_move';
    case WorkHistorySpecializations = 'work_history_specializations';
    case UserStatus = 'user_status';
    case Age = 'age';
    case IssetAge = 'isset_age';
    case Occupation = 'occupation';
    case Schedule = 'schedule';
    case WorkExperience = 'work_experience';
    case Subspecializations = 'subspecializations';
    case Gender = 'gender';
    case IssetGender = 'isset_gender';
    case Salary = 'salary';
    case IssetSalary = 'isset_salary';
    case Education = 'education';
}
