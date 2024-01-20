<?php

namespace App\Http\Requests\Resume\Enums;

enum ResumeTravelTimeEnum: string
{
    case Dontcare = 'dontcare';
    case Hour = 'hour';
    case Hourhalf = 'hourhalf';
}
