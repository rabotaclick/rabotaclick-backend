<?php

namespace App\Http\Requests\Resume\Enums;

enum ResumePreferredContactEnum: string
{
    case Phone = 'phone';
    case Email = 'email';
}
