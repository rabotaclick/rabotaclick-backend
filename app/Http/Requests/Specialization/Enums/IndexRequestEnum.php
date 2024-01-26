<?php

namespace App\Http\Requests\Specialization\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum IndexRequestEnum: string implements RequestParamEnumInterface
{
    case OrderBy = 'orderBy';
    case Column = 'column';

    case WithSubspecializations = 'with_subspecializations';
}
