<?php

namespace App\Http\Requests\Company\Enums;

enum CompanyTypeEnum: string
{
    case Individual = 'individual';
    case Project = 'project';
    case Person = 'person';
    case SelfEmployed = 'self-employed';
    case Recruiter = 'recruiter';
    case Agency = 'agency';
}
