<?php

namespace App\Http\Requests\Vacancy\Enums;

enum VacancyScheduleEnum: string
{
    case Full = 'full';
    case Shift = 'shift';
    case Flexible = 'flexible';
    case Remote = 'remote';
    case Rotation = 'rotation';
}
