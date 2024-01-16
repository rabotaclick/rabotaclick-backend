<?php

namespace App\Http\Requests\Enums;

enum OrderByEnum: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}
