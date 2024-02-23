<?php

namespace App\Http\Requests\UserEmployer\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateRequestEnum: string implements RequestParamEnumInterface
{
    case Name = 'name';
    case Surname = 'surname';
    case Lastname = 'lastname';
    case Password = 'password';
    case NewPassword = 'new_password';
}
