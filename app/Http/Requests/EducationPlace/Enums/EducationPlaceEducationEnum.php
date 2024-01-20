<?php

namespace App\Http\Requests\EducationPlace\Enums;

enum EducationPlaceEducationEnum: string
{
    case Secondary = 'secondary';
    case SecondarySpecialized = 'secondary_specialized';
    case IncompleteHigher = 'incomplete_higher';
    case Higher = 'higher';
    case Bachelor = 'bachelor';
    case Master = 'master';
    case Candidate = 'candidate';
    case Doctor = 'doctor';
}
