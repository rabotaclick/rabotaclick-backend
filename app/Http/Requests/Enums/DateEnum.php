<?php declare(strict_types=1);

namespace App\Http\Requests\Enums;

enum DateEnum: string
{
    case Day = 'day';
    case ThreeDays = 'three_days';
    case Week = 'week';
    case Month = 'month';
    case Year = 'year';
}
