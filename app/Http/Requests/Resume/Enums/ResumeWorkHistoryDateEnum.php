<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

enum ResumeWorkHistoryDateEnum: string
{
    case AllTime = 'all_time';
    case Year = 'year';
    case ThreeYears = 'three_years';
    case SixYears = 'six_years';

}
