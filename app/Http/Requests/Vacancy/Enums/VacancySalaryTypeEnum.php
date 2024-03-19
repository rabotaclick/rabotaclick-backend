<?php

namespace App\Http\Requests\Vacancy\Enums;

enum VacancySalaryTypeEnum: string
{
    case InHand = 'in_hand';
    case BeforeTaxes = 'before_taxes';
}
