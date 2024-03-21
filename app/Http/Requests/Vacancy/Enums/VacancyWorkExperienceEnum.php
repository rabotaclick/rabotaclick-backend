<?php declare(strict_types=1);
namespace App\Http\Requests\Vacancy\Enums;

enum VacancyWorkExperienceEnum: string
{
    case Zero = 'zero';
    case OneToThree = 'one_to_three';
    case ThreeToSix = 'three_to_six';
    case MoreThanSix = 'more_than_six';
}
