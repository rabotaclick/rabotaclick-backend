<?php

namespace App\Http\Resources\Vacancy\Enums;

enum ResourceEnum: string
{
    case Id = 'id';
    case CreatedAt = 'created_at';
    case UpdatedAt = 'updated_at';
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
    case City = 'city';
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
    case Type = 'type';
    case Company = 'company';
}
