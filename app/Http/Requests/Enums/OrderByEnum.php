<?php declare(strict_types=1);

namespace App\Http\Requests\Enums;

enum OrderByEnum: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
