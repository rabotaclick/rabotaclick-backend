<?php

namespace App\Http\Requests\Vacancy\Enums;

enum VacancyWorkTypeEnum: string
{
    case FullJob = 'full_job';
    case PartJob = 'part_job';
}
