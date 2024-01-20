<?php

namespace App\Http\Requests\User\Enums;

enum UpdateRequestStatusEnum: string
{
    case Active = 'active';
    case Considering = 'considering';
    case Offered = 'offered';
    case AlreadyGot = 'already_got';
    case NotLooking = 'not_looking';
}
