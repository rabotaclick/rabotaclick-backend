<?php

namespace App\Repositories\Auth;

use App\DTO\Auth\LoginRequestDTO;
use App\Models\User;
use App\Models\UserAuth;
use App\Repositories\Auth\Exceptions\LoginRepositoryException;
use Illuminate\Support\Facades\DB;

class LoginRepository
{
    public function __construct(
        private User $user
    )
    {
    }

    public function make(LoginRequestDTO $requestDTO): string
    {
        DB::transaction(function () use($requestDTO) {
            $userAuth = UserAuth::findCode($requestDTO->phone, $requestDTO->code);
            $this->user = User::firstOrCreate(
                ['phone' => $userAuth->phone]
            );
            $userAuth->delete();
        });

        return $this->user
            ->createToken(
                'auth-token',
                expiresAt: now()->addDays(7)
            )
            ->plainTextToken;
    }
}
