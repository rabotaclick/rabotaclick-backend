<?php

namespace App\Repositories\Auth;

use App\DTO\Auth\LoginRequestDTO;
use App\Models\User;
use App\Models\UserAuth;
use App\Repositories\Auth\Exceptions\LoginRepositoryException;

class LoginRepository
{
    public function __construct(
        private User $user
    )
    {
    }

    public function make(LoginRequestDTO $requestDTO): string
    {
        $userAuth = UserAuth::findCode($requestDTO->phone, $requestDTO->code);
        $this->user = User::firstOrCreate(
            ['phone' => $userAuth->phone]
        );

        return $this->user
            ->createToken(
                'auth-token',
                expiresAt: now()->addDays(7)
            )
            ->plainTextToken;
    }
}
