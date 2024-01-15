<?php

namespace App\DTO\User;

use App\Models\User;

readonly class UserDTO
{
    public function __construct(
        public User $user
    )
    {
    }
}
