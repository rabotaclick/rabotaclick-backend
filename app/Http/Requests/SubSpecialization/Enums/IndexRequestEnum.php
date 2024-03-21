<?php declare(strict_types=1);
namespace App\Http\Requests\SubSpecialization\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum IndexRequestEnum: string implements RequestParamEnumInterface
{
    case Search = 'search';
}
