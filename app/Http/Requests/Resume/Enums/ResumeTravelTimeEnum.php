<?php declare(strict_types=1);
namespace App\Http\Requests\Resume\Enums;

enum ResumeTravelTimeEnum: string
{
    case Dontcare = 'dontcare';
    case Hour = 'hour';
    case Hourhalf = 'hourhalf';
}
