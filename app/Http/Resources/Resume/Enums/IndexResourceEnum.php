<?php declare(strict_types=1);
namespace App\Http\Resources\Resume\Enums;

enum IndexResourceEnum: string
{
    case Id = 'id';
    case Profession = 'profession';
    case Birthdate = 'birthdate';
    case User = 'user';
    case UpdatedAt = 'updated_at';
    case Salary = 'salary';
    case WorkExperience = 'work_experience';
    case LastWork = 'last_work';
}
