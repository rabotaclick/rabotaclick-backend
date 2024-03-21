<?php declare(strict_types=1);

namespace App\Http\Requests\Auth\Employer\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum FinishRegisterRequestEnum: string implements RequestParamEnumInterface
{
    case Name = 'name';

    case Surname = 'surname';
}
