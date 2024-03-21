<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateWorkingHistoryRequestEnum: string implements RequestParamEnumInterface
{
    case WorkHistories = 'work_histories';
    case KeySkills = 'key_skills';
    case AboutMe = 'about_me';
    case HaveCar = 'have_car';
    case DriverCategories = 'driver_categories';
}
