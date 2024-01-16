<?php

namespace App\Http\Requests\VacancyCategory\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum IndexRequestEnum: string implements RequestParamEnumInterface
{
    case OrderBy = 'orderBy';
    case Column = 'column';
}
