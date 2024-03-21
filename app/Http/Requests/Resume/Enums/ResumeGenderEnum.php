<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

enum ResumeGenderEnum: string
{
    case Male = 'male';

    case Female = 'female';
}
