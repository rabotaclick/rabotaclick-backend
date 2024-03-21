<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Enums;

enum VacancySalaryTypeEnum: string
{
    case InHand = 'in_hand';
    case BeforeTaxes = 'before_taxes';
}
