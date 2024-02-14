<?php

namespace App\DTO\UserEmployer;

use App\Models\UserEmployer;

readonly class UserEmployerDTO
{
    public function __construct(
        public UserEmployer $userEmployer
    )
    {
    }
}
