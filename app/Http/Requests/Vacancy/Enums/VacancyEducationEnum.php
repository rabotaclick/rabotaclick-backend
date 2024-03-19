<?php

namespace App\Http\Requests\Vacancy\Enums;

enum VacancyEducationEnum: string
{
    case NotRequired = 'not_required';
    case High = 'high';
    case College = 'college';
}
