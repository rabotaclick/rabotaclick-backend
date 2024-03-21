<?php declare(strict_types=1);
namespace App\Http\Resources\Vacancy\Enums;

enum IndexResourceEnum: string
{
    case Id = 'id';
    case CreatedAt = 'created_at';
    case Company = 'company';
    case Title = 'title';
    case SalaryFrom = 'salary_from';
    case SalaryTo = 'salary_to';
    case WorkExperience = 'work_experience';
}
