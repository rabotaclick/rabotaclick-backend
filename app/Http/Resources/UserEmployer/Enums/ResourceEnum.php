<?php declare(strict_types=1);
namespace App\Http\Resources\UserEmployer\Enums;

enum ResourceEnum: string
{
    case Id = 'id';
    case Name = 'name';
    case Surname = 'surname';
    case Lastname = 'lastname';
    case Phone = 'phone';
    case Email = 'email';
    case Company = 'company';
    case CreatedAt = 'created_at';
    case UpdatedAt = 'updated_at';
}
