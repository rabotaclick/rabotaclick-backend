<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Enums;

enum VacancyEducationEnum: string
{
    case NotRequired = 'not_required';
    case High = 'high';
    case College = 'college';
}
