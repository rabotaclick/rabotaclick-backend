<?php

namespace App\Http\Requests\Vacancy\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum StoreRequestEnum: string implements RequestParamEnumInterface
{
    case Title = 'title';
    case SalaryType = 'salary_type';
    case SalaryFrom = 'salary_from';
    case SalaryTo = 'salary_to';
    case WorkExperience = 'work_experience';
    case Occupation = 'occupation';
    case GPC = 'gpc';
    case WorkType = 'work_type';
    case Schedule = 'schedule';
    case Subspecializations = 'subspecializations';
    case KeySkills = 'key_skills';
    case CityId = 'city_id';
    case Responsibilities = 'responsibilities';
    case Requirements = 'requirements';
    case Conditions = 'conditions';
    case Education = 'education';
    case ContactName = 'contact_name';
    case ContactSurname = 'contact_surname';
    case ContactLastname = 'contact_lastname';
    case ContactPhone = 'contact_phone';
    case ContactEmail = 'contact_email';
    case Letter = 'letter';
    case VacancyType = 'vacancy_type';
}
