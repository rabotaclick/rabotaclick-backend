<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Enums;

enum VacancyTypeEnum: string
{
    case Standard = 'standard';
    case Premium = 'premium';
}
