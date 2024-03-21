<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Enums;

enum VacancyWorkTypeEnum: string
{
    case FullJob = 'full_job';
    case PartJob = 'part_job';
}
