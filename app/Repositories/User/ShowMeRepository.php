<?php

namespace App\Repositories\User;

use App\DTO\User\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ShowMeRepository
{
    public function __construct(
        private User $user
    )
    {
    }

    public function make(): UserDTO
    {
        $this->user = Auth::user();

        return new UserDTO(
            $this->user
        );
    }
}
