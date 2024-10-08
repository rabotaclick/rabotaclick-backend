<?php declare(strict_types=1);

namespace App\Http\Requests\Enums;

use App\Http\Requests\Contracts\RequestParamEnumInterface;

enum PaginationRequestEnum: string implements RequestParamEnumInterface
{
    case First = 'first';

    case Page = 'page';
}
