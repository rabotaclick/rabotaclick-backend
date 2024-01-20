<?php

namespace App\Http\Requests\Resume\Enums;

enum ResumeOccupationEnum: string
{
    case FullTime = 'full-time';
    case PartTime = 'part-time';
    case Project = 'project';
    case Volunteer = 'volunteer';
    case Internship = 'internship';
}
