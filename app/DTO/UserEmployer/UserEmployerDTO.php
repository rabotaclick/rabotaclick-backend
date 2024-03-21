<?php declare(strict_types=1);

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
