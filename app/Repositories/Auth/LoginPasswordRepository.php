<?php declare(strict_types=1);

namespace App\Repositories\Auth;

use App\DTO\Auth\LoginPasswordDTO;
use App\Models\User;
use App\Repositories\Auth\Exceptions\InvalidCredentialsException;
use App\Repositories\Auth\Exceptions\RegisterRepositoryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginPasswordRepository
{
    public function __construct(
        private User $user,
    )
    {
    }

    public function make(LoginPasswordDTO $requestDTO): string
    {
        try {
            $credentials = $this->generateCredentials($requestDTO);
            if(!Auth::attempt($credentials)) {
                throw new InvalidCredentialsException();
            }
        } catch (\RuntimeException $exception) {
            throw new InvalidCredentialsException();
        }

        $this->user = Auth::user();
        return $this->user
            ->createToken(
                'auth-token',
                ['role:applicant'],
                now()->addDays(7)
            )
            ->plainTextToken;
    }

    private function generateCredentials($requestDTO): array
    {
        $credentials = [
            'login' => $requestDTO->login,
            'password' => $requestDTO->password
        ];
        if(filter_var($requestDTO->login, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $credentials['login'];
            unset($credentials['login']);
        } else {
            $credentials['phone'] = $credentials['login'];
            unset($credentials['login']);
        }
        return $credentials;
    }
}
