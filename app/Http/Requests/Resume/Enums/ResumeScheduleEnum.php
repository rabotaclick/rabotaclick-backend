<?php

namespace App\Http\Requests\Resume\Enums;

enum ResumeScheduleEnum: string
{
    case Full = 'full';
    case Shift = 'shift';
    case Flexible = 'flexible';
    case Remote = 'remote';
    case Rotation = 'rotation';
}
