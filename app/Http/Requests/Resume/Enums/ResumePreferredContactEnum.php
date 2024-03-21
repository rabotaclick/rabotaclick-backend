<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

enum ResumePreferredContactEnum: string
{
    case Phone = 'phone';
    case Email = 'email';
}
