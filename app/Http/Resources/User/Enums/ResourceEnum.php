<?php

namespace App\Http\Resources\User\Enums;
enum ResourceEnum: string
{
    case Id = 'id';
    case Name = 'name';
    case Surname = 'surname';
    case Lastname = 'lastname';
    case Status = 'status';
    case Phone = 'phone';
    case Email = 'email';
    case ChangeEmail = 'change_email';
    case ChangePhone = 'change_phone';
    case CreatedAt = 'created_at';
    case UpdatedAt = 'updated_at';
    case Resumes = 'resumes';

    case HasPassword = 'has_password';
}
