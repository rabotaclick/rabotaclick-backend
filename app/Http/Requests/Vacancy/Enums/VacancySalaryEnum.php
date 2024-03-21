<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Enums;

enum VacancySalaryEnum: string
{
    case tenK = '10000';
    case fiftyK = '50000';
    case hundredK = '100000';
    case hundredHalfK = '150000';
    case twoHundredK = '200000';
}
