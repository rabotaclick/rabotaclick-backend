<?php

namespace App\Http\Requests\Vacancy\Enums;

enum VacancyOccupationEnum: string
{
    case FullTime = 'full-time';
    case PartTime = 'part-time';
    case Project = 'project';
    case Volunteer = 'volunteer';
    case Internship = 'internship';
}
