<?php

namespace App\Http\Requests\Resume\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum UpdateContactsRequestEnum: string implements RequestParamEnumInterface
{
    case Phone = 'phone';
    case Email = 'email';
    case PreferredContact = 'preferred_contact';
}
