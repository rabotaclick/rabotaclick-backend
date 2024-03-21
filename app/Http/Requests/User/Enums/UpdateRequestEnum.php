<?php declare(strict_types=1);

namespace App\Http\Requests\User\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateRequestEnum: string implements RequestParamEnumInterface
{
    case Name = 'name';
    case Surname = 'surname';
    case Lastname = 'lastname';
    case Password = 'password';
    case NewPassword = 'new_password';
    case Status = 'status';
    case ChangeEmail = 'change_email';
    case ChangePhone = 'change_phone';
}
