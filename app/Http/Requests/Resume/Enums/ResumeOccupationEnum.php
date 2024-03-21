<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

enum ResumeOccupationEnum: string
{
    case FullTime = 'full-time';
    case PartTime = 'part-time';
    case Project = 'project';
    case Volunteer = 'volunteer';
    case Internship = 'internship';
}
