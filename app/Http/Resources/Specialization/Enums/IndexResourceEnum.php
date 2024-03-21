<?php declare(strict_types=1);
namespace App\Http\Resources\Specialization\Enums;

enum IndexResourceEnum: string
{
    case Id = 'id';
    case Title = 'title';
    case Vacancies = 'vacancies';
}
