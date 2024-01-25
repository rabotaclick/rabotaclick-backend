<?php

namespace App\Repositories\Auth;

use App\DTO\Auth\LoginRequestDTO;
use App\DTO\Auth\RegisterRequestDTO;
use App\DTO\User\UserDTO;
use App\Models\User;
use App\Models\UserAuth;
use App\Repositories\Auth\Exceptions\RegisterRepositoryException;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isNull;

class RegisterRepository
{
    public function __construct(
        private User $user
    )
    {
    }

    public function make(RegisterRequestDTO $requestDTO): UserDTO
    {
        $this->user = Auth::user();
        if(isset($this->user->name) || isset($this->user->surname)) {
            throw new RegisterRepositoryException();
        }
        $this->user->name = $requestDTO->name;
        $this->user->surname = $requestDTO->surname;
        $this->user->save();

        return new UserDTO($this->user);
    }
}
