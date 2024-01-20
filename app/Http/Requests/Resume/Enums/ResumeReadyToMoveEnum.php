<?php

namespace App\Http\Requests\Resume\Enums;

enum ResumeReadyToMoveEnum: string
{
    case No = 'no';
    case Yes = 'yes';
    case Want = 'want';
}
