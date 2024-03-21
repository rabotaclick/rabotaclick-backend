<?php declare(strict_types=1);

namespace App\Repositories\Auth\Employer;

use App\DTO\Auth\Employer\LoginRequestDTO;
use App\Models\UserEmployer;
use App\Repositories\Auth\Employer\Exceptions\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;

class LoginRepository
{
    public function __construct(
        private UserEmployer $userEmployer,
    )
    {
    }

    public function make(LoginRequestDTO $requestDTO): string
    {
        if(!Auth::guard('employer')
            ->attempt([
                'email' => $requestDTO->email,
                'password' => $requestDTO->password
            ])) {
            throw new InvalidCredentialsException();
        }
        $this->userEmployer = Auth::guard('employer')->user();
        return $this->userEmployer
            ->createToken(
                'auth-token',
                ['role:employer'],
                now()->addDays(7)
            )
            ->plainTextToken;
    }
}
